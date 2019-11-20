<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\CustomClass\MyNumeral;

class TransactionController extends Controller
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
        return view('admin.transaksi.transaction');
    }

    public function transactionDT(Request $request)
    {
        $formatter = MyNumeral::formatter();

        $col = array('name', '', '', '', '', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = Customer::with('transactions')->has('transactions');

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
                '<div class="text-center">'.$r->name.'</div>',
                '<div class="text-center">'.$r->phone.'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->count(), '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->sum('value'), '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->sum('point'), '0,0').'</div>',
                '<div class="text-center">
                    <a href="'.route('transaction.show', $r->id).'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $customer = Customer::find($transaction->id);

        dd($customer);

        return view('admin.transaksi.show', ['id' => $transaction->id, 'data' => $customer]);
    }

    /*
    public function showDT(Transaction $transaction, Request $request)
    {
        $formatter = MyNumeral::formatter();

        $col = array('value', 'point', 'created_at', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = Transaction::where('customer_id', $transaction->id);

        if($range){
            $query->whereDate('created_at', '>=', $start)
                  ->whereDate('created_at', '<=', $end);
        }

        if(!empty($request->search['value'])){
            if(!$range){
                $query->where(function($q) use($request) {
                    $q->where('value', 'like', '%'.$request->search['value'].'%')
                      ->orWhere('point', 'like', '%'.$request->search['value'].'%');
                });
            }
        }

        $transaction = $query->orderBy($col[$request->order[0]['column']], $request->order[0]['dir'])
                             ->offset($request->start)
                             ->limit($request->length)
                             ->get();
        
        //total record
        $total = $query->get()->count();
        //total record with search value
        $filter = (!empty($request->search['value'])) ? 
            $transaction->count()
            :
            $total;

        $data = [];
        foreach ($transaction as $r) {
            $data[] = array(
                '<div class="text-center">'.$formatter->format($r->value, '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->point, '0,0').'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s').'</div>',
                '<div class="text-center">
                    <a href="'.route('transaction.del', $r->id).'" class="btn btn-sm btn-danger confirm" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
                </div>',
            );
        }

        return response()->json([
            'draw' => (int)$request->draw++,
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $data
        ]);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //return redirect()->route('transaction.index')->with('message', 'Transaksi berhasil dihapus');
    }

    /*
    public function del(Transaction $transaction)
    {
        $transaction = Transaction::findOrFail($transaction->id);

        $transaction->delete();

        return redirect()->route('transaction.index')->with('message', 'Transaksi berhasil dihapus');
    }*/
}
