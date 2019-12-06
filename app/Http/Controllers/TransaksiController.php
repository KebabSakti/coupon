<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MyNumeral;
use Carbon\Carbon;
use App\Transaction;
use App\Customer;
use App\CouponRedeem;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.transaksi.transaksi');
    }

    public function indexData(Request $request)
    {
        $formatter = MyNumeral::formatter();

        $col = array('customer_code', 'name', 'mobile', '', '', '', '');

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
            $data[] = array(
                '<div class="text-center">'.$r->customer_code.'</div>',
                '<div class="text-center">'.$r->name.'</div>',
                '<div class="text-center">'.$r->phone.'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->count(), '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->sum('value'), '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->transactions->sum('point'), '0,0').'</div>',
                '<div class="text-center">
                    <a href="'.route('admin.transaksi.detail', $r->id).'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
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

    public function couponData(Request $request)
    {
        $formatter = MyNumeral::formatter();

        $col = array('customer_code', 'name', 'mobile', '', '', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = Customer::with('coupons')->has('coupons');

        if($range){
            $query->whereDate('created_at', '>=', $start)
                  ->whereDate('created_at', '<=', $end);
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
            $data[] = array(
                '<div class="text-center">'.$r->customer_code.'</div>',
                '<div class="text-center">'.$r->name.'</div>',
                '<div class="text-center">'.$r->phone.'</div>',
                '<div class="text-center">'.$formatter->format($r->coupons->count(), '0,0').'</div>',
                '<div class="text-center">'.$formatter->format($r->coupons->sum('point'), '0,0').'</div>',
                '<div class="text-center">
                    <a href="'.route('admin.transaksi.coupon.detail', $r->id).'" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-info"></i> Detail</a>
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

    public function detail($id)
    {
        $customer = Customer::findOrFail($id);

        return view('admin.transaksi.detail', ['id' => $id, 'data' => $customer]);
    }

    public function couponDetail($id)
    {
        $customer = Customer::findOrFail($id);

        return view('admin.transaksi.coupon', ['id' => $id, 'data' => $customer]);
    }

    public function detailData(Request $request, $id)
    {
        $formatter = MyNumeral::formatter();

        $col = array('value', 'point', 'created_at', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = Transaction::where('customer_id', $id);

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
                    <a href="'.route('admin.transaksi.hapus', $r->id).'" class="btn btn-sm btn-danger confirm" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
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

    public function couponDetailData(Request $request, $id)
    {
        $formatter = MyNumeral::formatter();

        $col = array('', 'created_at', '');

        $range = (strstr($request->search['value'], '|') == false) ? false:explode('|', $request->search['value']);
        $start = ($range == false) ? '':$range[0];
        $end = ($range == false) ? '':$range[1];

        $query = CouponRedeem::where('customer_id', $id);

        if($range){
            $query->whereDate('created_at', '>=', $start)
                  ->whereDate('created_at', '<=', $end);
        }

        if(!empty($request->search['value'])){
            if(!$range){
                $query->where(function($q) use($request) {
                    $q->where('coupon_code', 'like', '%'.$request->search['value'].'%');
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
                '<div class="text-center">'.$r->coupon_code.'</div>',
                '<div class="text-center">'.Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->Timezone('GMT+8')->format('d/m/Y H:i:s').'</div>',
                '<div class="text-center">
                    <a href="'.route('admin.transaksi.coupon.hapus', $r->id).'" class="btn btn-sm btn-danger confirm" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
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

    public function hapus($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()->back()->with('message', 'Data deleted');
    }

    public function hapusCoupon($id)
    {
        $transaction = CouponRedeem::findOrFail($id);

        $transaction->delete();

        return redirect()->back()->with('message', 'Data deleted');
    }
}
