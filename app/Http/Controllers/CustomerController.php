<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use App\Nationality;
use App\Rule;
use App\CouponRedeem;
use App\CouponRule;
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
        return view('admin.kustomer.customer', ['nationalities' => Nationality::all(), 'rules' => Rule::all()]);
    }

    public function customerDT(Request $request)
    {
        $col = array('customer_code', 'name', 'mobile', '', '', 'commence_on', 'expires_on','');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];
        $alt = ($range == false) ? '':$range[2];

        $query = Customer::with(['rule', 'transactions']);

        if($range){
            if($alt == 'false'){
                $query->whereDate('commence_on', '>=', $start)
                      ->whereDate('commence_on', '<=', $end);
            }else{
                $query->whereDate('expires_on', '>=', $start)
                      ->whereDate('expires_on', '<=', $end);
            }
        }

        if(!empty($request->search['value'])){
            if(!$range){
                $query->where(function($q) use($request) {
                        $q->where('customer_code', 'like', '%'.$request->search['value'].'%')
                          ->orWhere('name', 'like', '%'.$request->search['value'].'%')
                          ->orWhere('mobile', 'like', '%'.$request->search['value'].'%');
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
            $redeemed = CouponRedeem::where('customer_id', $r->id)->get();
            $couponrule = CouponRule::first();
            $point = $r->transactions->sum('point') - ($redeemed->count() * $couponrule->point);
            
            $data[] = array(
                '<div class="text-center">'.Str::limit($r->customer_code, 20).'</div>', 
                '<div class="text-center">'.$r->name.'</div>',
                '<div class="text-center">'.$r->mobile.'</div>',
                '<div class="text-center">'.$r->rule->card_name.'</div>',
                '<div class="text-center">'.$point.'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d', $r->commence_on)->Timezone('GMT+8')->format('d/m/Y').'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d', $r->expires_on)->Timezone('GMT+8')->format('d/m/Y').'</div>',
                '<div class="text-center">
                    <a href="'.route('customer.edit', $r->id).'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
                    <form method="post" action="'.route('customer.destroy', $r->id).'" style="display:inline-block;">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-danger confirm" title="Hapus"><i class="fas fa-trash"></i> Delete</button>
                    </form>
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
            'rule_id' => 'required',
            'customer_code' => 'required|unique:customers,customer_code',
            'commence_on' => 'required',
            'expires_on' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $customer = new Customer;

            $file = $request->file('profile');
            if(!empty($file)){
                $name = Str::random(40).'.'.$file->getClientOriginalExtension();
                $path = 'img/profile/'.$name;

                Image::make($file)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path);

                $customer->profile = $name;
            }

            $customer->customer_code = $request->customer_code;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->rule_id = $request->rule_id;
            $customer->postal_code = $request->postal_code;
            $customer->fax = $request->fax;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->sex = $request->sex;
            $customer->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date)->Timezone('GMT+8')->format('Y-m-d');
            $customer->nationality = $request->nationality;
            $customer->commence_on = Carbon::createFromFormat('d/m/Y', $request->commence_on)->Timezone('GMT+8')->format('Y-m-d');
            $customer->expires_on = Carbon::createFromFormat('d/m/Y', $request->expires_on)->Timezone('GMT+8')->format('Y-m-d');
            $customer->save();

            DB::commit();

            return redirect()->route('customer.index')->with('message', 'Data added');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('customer.index')->with('message', 'Data error');
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

        return view('admin.kustomer.edit', ['data' => $customer, 'nationalities' => Nationality::all(), 'rules' => Rule::all()]);
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
            'rule_id' => 'required',
            //'customer_code' => 'required|unique:customers,customer_code',
            'commence_on' => 'required',
            'expires_on' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($customer->id);

            //resize and upload picture
            if($request->hasFile('profile')){
                //remove old file
                if($customer->profile != NULL){
                    $oldpath = 'img/profile/'.$customer->profile;
                    if(file_exists($oldpath)){
                        unlink($oldpath);
                    }
                }

                //upload new file
                $file = $request->file('profile');
                if(!empty($file)){
                    $name = Str::random(40).'.'.$file->getClientOriginalExtension();
                    $path = 'img/profile/'.$name;

                    Image::make($file)->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($path);

                    $customer->profile = $name;
                }
            }

            $customer->customer_code = $request->customer_code;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->rule_id = $request->rule_id;
            $customer->postal_code = $request->postal_code;
            $customer->fax = $request->fax;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->sex = $request->sex;
            $customer->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date)->Timezone('GMT+8')->format('Y-m-d');
            $customer->nationality = $request->nationality;
            $customer->commence_on = Carbon::createFromFormat('d/m/Y', $request->commence_on)->Timezone('GMT+8')->format('Y-m-d');
            $customer->expires_on = Carbon::createFromFormat('d/m/Y', $request->expires_on)->Timezone('GMT+8')->format('Y-m-d');
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
        if($customer->profile != NULL){
            $oldpath = 'img/profile/'.$customer->profile;
            if(file_exists($oldpath)){
                unlink($oldpath);
            }
        }

        //remove any associate data from this customer
        $transaction = Transaction::where('customer_id', $customer->id);
        $transaction->delete();

        $coupon = CouponRedeem::where('customer_id', $customer->id);
        $coupon->delete();

        //remove data from database
        $customer->delete();

        return redirect()->route('customer.index')->with('message', 'Data berhasil dihapus');
    }
}
