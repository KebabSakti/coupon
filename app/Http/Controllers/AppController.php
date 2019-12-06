<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClass\MyNumeral;
use App\Transaction;
use App\Rule;
use App\Customer;
use App\CouponRule;
use Carbon\Carbon;
use App\CouponRedeem;

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
        $today = Carbon::now()->Timezone('GMT+8')->format('Y-m-d');

        $Customer = Customer::with(['transactions', 'rule'])
                            ->where('customer_code', $request->search)
                            ->whereDate('expires_on', '>=', $today)
                            ->get();

        if(count($Customer) > 0){
            $redeemed = CouponRedeem::where('customer_id', $Customer[0]->id)->get();
            $couponrule = CouponRule::first();
            $point = $Customer[0]->transactions->sum('point') - ($redeemed->count() * $couponrule->point);
        }else{
            $point = 0;
        }

        return response()->json([
            'point' => $point,
            'data' => $Customer->toArray(),
            'coupon_rule' => CouponRule::first()->toArray()
        ]);
    }

    public function redeem(Request $request)
    {
        
    }
}
