<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;
use App\Transaction;
use App\CouponRedeem;
use PDF;

class PointController extends Controller
{
    public function index()
    {
        return view('admin.redeem.index');
    }

    public function redeemPoint(Request $request)
    {
        $Rule = Rule::find($request->rule_id);
        $value = $Rule->value;
        $point = $Rule->point;
        $mod = $request->amount % $value;
        $redeem = floor((($request->amount - $mod) / $value) * $point); 

        if($request->amount < $value){
            $status = false;
            $msg = 'Failed to redeem, transaction amount must higher than '.$value;
        }else{
            $Transaction = new Transaction;
            $Transaction->customer_id = $request->customer_id;
            $Transaction->value = $request->amount;
            $Transaction->point = $redeem;
            $Transaction->save();

            $status = true;
            $msg = 'Redeem point success';
        }

        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);
    }
    
    public function redeemCoupon(Request $request)
    {
        $point = $request->point;
        for($i=1; $i<=$request->coupon_count; $i++){
            $coupon = mt_rand(100000000, 999999999);
            
            $couponredeem = new CouponRedeem;
            $couponredeem->customer_id = $request->customer_id;
            $couponredeem->point = $request->coupon_point;
            $couponredeem->coupon_code = $coupon;
            $couponredeem->save();

            $point -= $request->coupon_point;
        }

        return response()->json([
            'status' => true,
            'msg' => 'Redeem copun reward success'
        ]);
    }

    public function printCoupon($customer_id)
    {
        $coupon = CouponRedeem::with('customer')
                              ->where('customer_id', $customer_id)
                              ->where('is_expired', false)
                              ->get();

        $pdf = PDF::loadView('admin.redeem.print', ['coupon' => $coupon])
                  ->setPaper('A4', 'portrait')
                  ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                  
        return $pdf->stream();
    }
}
