<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kustomer.customer');
    }

    public function customerDT(Request $request)
    {
        $col = array('customer_code', 'name', 'phone', 'address', 'created_at', 'updated_at', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = DB::table('customers');

        if($range){
            $query->whereDate('created_at', '>=', $start)
                  ->whereDate('created_at', '<=', $end);
        }

        if(!empty($request->search['value'])){
            if(!$range){
                $query->where(function($q) use($request) {
                        $q->where('customer_code', 'like', '%'.$request->search['value'].'%')
                          ->orWhere('name', 'like', '%'.$request->search['value'].'%')
                          ->orWhere('phone', 'like', '%'.$request->search['value'].'%')
                          ->orWhere('address', 'like', '%'.$request->search['value'].'%');
                });
            }
        }

        $customer = $query->orderBy($col[$request->order[0]['column']], $request->order[0]['dir'])
                          ->offset($request->start)
                          ->limit($request->length)
                          ->get();
        
        //total record
        $total = $query->get()->count();
        //total record with search value
        $filter = (!empty($request->search['value'])) ? 
            $customer->count()
            :
            $total;

        $data = [];
        foreach ($customer as $r) {
            $data[] = array(
                '<div class="text-center">'.Str::limit($r->customer_code, 20).'</div>', 
                '<div class="text-center">'.$r->name.'</div>',
                '<div class="text-center">'.$r->phone.'</div>',
                '<div class="text-center">'.Str::limit($r->address, 20).'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s').'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d H:i:s', $r->updated_at)->Timezone('GMT+8')->format('d/m/Y H:i:s').'</div>',
                '<div class="text-center">
                    <a href="'.route('customer.edit', $r->id).'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
                </div>',
            );
        }

        return response()->json([
            'draw' => (int)$request->draw++,
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $customer = new Customer;

            $file = $request->file('profile');
            $name = Str::random(40).'.'.$file->getClientOriginalExtension();
            $path = 'img/profile/'.$name;

            if(!empty($file)){
                Image::make($file)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);

                $customer->profile = $name;
            }

            $customer->customer_code = mt_rand(100000000000, 999999999999);
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();

            return redirect()->route('customer.index')->with('message', 'Data berhasil ditambahkan');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('customer.index')->with('message', 'Data gagal tersimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customer = Customer::findOrFail($customer->id);

        return view('admin.kustomer.edit', ['data' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($customer->id);

            if($request->hasFile('profile')){
                $file = $request->file('profile');
                $name = Str::random(40).'.'.$file->getClientOriginalExtension();
                $path = 'img/profile/'.$name;

                if(!empty($file)){
                    Image::make($file)->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($path);

                    $customer->profile = $name;
                }

                //remove old file
                $oldpath = 'img/profile/'.$customer->profile;
                if(File::exists(asset($oldpath))){
                    unlink($oldpath);
                }
            }

            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();

            return redirect()->route('customer.index')->with('message', 'Data berhasil di update');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('customer.index')->with('message', 'Data gagal di update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer = Customer::findOrFail($customer->id);

        //remove old file
        $oldpath = 'img/profile/'.$customer->profile;
        if(File::exists(asset($oldpath))){
            unlink($oldpath);
        }

        //remove any associate data from this customer
        $transaction = Transaction::where('customer_id', $customer->id);
        $transaction->delete();

        //remove data from database
        $customer->delete();

        return redirect()->route('customer.index')->with('message', 'Data berhasil dihapus');
    }
}
