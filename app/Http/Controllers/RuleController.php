<?php

namespace App\Http\Controllers;

use App\Rule;
use App\CouponRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\CustomClass\MyNumeral;

class RuleController extends Controller
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
        return view('admin.setting.setting', ['rules' => Rule::all(), 'coupon' => CouponRule::first()]);
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
            'card_name' => 'required',
            'value' => 'required',
            'point' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $formatter = MyNumeral::formatter();

            $rule = new Rule;
            $rule->card_name = $request->card_name;
            $rule->value = $formatter->unformat($request->value);;
            $rule->point = $formatter->unformat($request->point);;
            $rule->save();

            DB::commit();

            return redirect()->route('rule.index')->with('message', 'New data added');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('rule.index')->with('message', 'New data error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        $rule = Rule::findOrFail($rule->id);

        return view('admin.setting.show', ['data' => $rule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'card_name' => 'required',
            'value' => 'required',
            'point' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $formatter = MyNumeral::formatter();

            $rule = Rule::findOrFail($rule->id);
            $rule->card_name = $request->card_name;
            $rule->value = $formatter->unformat($request->value);;
            $rule->point = $formatter->unformat($request->point);;
            $rule->save();

            DB::commit();

            return redirect()->route('rule.index')->with('message', 'Data updated');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('rule.index')->with('message', 'Update error');
        }
    }

    public function couponRule(Request $request, $id)
    {
        $request->validate([
            'point' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $formatter = MyNumeral::formatter();

            $rule = CouponRule::findOrFail($id);
            $rule->point = $formatter->unformat($request->point);
            $rule->save();

            DB::commit();

            return redirect()->route('rule.index')->with('message', 'Data updated');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('rule.index')->with('message', 'Update error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rule)
    {
        $id = $rule->id;
        $rule = Rule::has('customers')->where('id', $id)->first();
        
        if(!$rule == null){
            return redirect()->route('rule.index')->with('message', 'Delete failed, some customer is using this data');
        }

        $rule = Rule::findOrFail($id);
        $rule->delete();

        return redirect()->route('rule.index')->with('message', 'Data deleted');
    }
}
