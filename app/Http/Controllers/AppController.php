<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClass\MyNumeral;
use App\Transaction;
use App\Rule;
use App\Customer;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function history(Request $request, $id = null)
    {
        /*
        $formatter = MyNumeral::formatter();
        $col = array('created_at', 'value', 'point', 'description');

        $Transaction = Transaction::where('customer_id', $id)
                                  ->orderBy($col[$request->order[0]['column']], $request->order[0]['dir'])
                                  ->offset($request->start)
                                  ->limit($request->length)
                                  ->get();

        //total record
        $total = $Transaction->count();
        //total record with search value
        $filter = (!empty($request->search['value'])) ? 
            $Transaction->count()
            :
            $total;

        $data = [];
        foreach ($Transaction as $r) {
            $data[] = array(
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s').'</div>',
                '<div class="text-center">'.$formatter->format($r->value, '0,0').'</div>',
                '<div class="text-center">'.$r->point.'</div>',
                '<div class="text-center">'.$r->description.'</div>'
            );
        }

        return response()->json([
            'draw' => (int)$request->draw++,
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $data
        ]);*/

        $Transaction = Transaction::where('customer_id', $request->customer_id)
                                  ->orderBy('created_at', 'desc')
                                  ->get();

        return view('public.ajax.history', ['transaction' => $Transaction]);
    }

    public function search(Request $request)
    {
        $Customer = Customer::with('transactions')
                            ->where('customer_code', 'like', '%'.$request->search.'%')
                            ->orWhere('name', 'like', '%'.$request->search.'%')
                            ->orWhere('phone', 'like', '%'.$request->search.'%')
                            ->get();

        return response()->json([
            'transaksi' => (count($Customer) > 0) ? $Customer[0]->transactions->count(): 0,
            'nilai' => (count($Customer) > 0) ? $Customer[0]->transactions->sum('value'): 0,
            'point' => (count($Customer) > 0) ? $Customer[0]->transactions->sum('point'): 0,
            'data' => $Customer
        ]);
    }

    public function redeem(Request $request)
    {
        $Rule = Rule::find(1);
        $value = $Rule->value;
        $point = $Rule->point;
        $mod = $request->amount % $value;
        $redeem = floor((($request->amount - $mod) / $value) * $point); 

        if($request->amount < $value){
            $status = false;
            $msg = 'Gagal menyimpan transaksi. Nilai transaksi tidak boleh lebih kecil dari '.$value;
        }else{
            $Transaction = new Transaction;
            $Transaction->customer_id = $request->customer_id;
            $Transaction->value = $request->amount;
            $Transaction->point = $redeem;
            $Transaction->save();

            $status = true;
            $msg = 'Transaksi berhasil tersimpan';
        }

        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);
    }
}
