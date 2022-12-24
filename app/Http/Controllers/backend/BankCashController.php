<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankCash;
use App\Models\Profit;

class BankCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankCash = BankCash::get();
        return view('backend.BankCash.list',compact('bankCash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bankCash.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'current_balance' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable',
            'voucher_no' => 'nullable',
        ]);

        $status = 0;
        if($request->status){
            $status = 1;
        }

        $voucher = Profit::get()->pluck('voucher_no')->last();
        if (empty($voucher)) {
            $voucher_id = Profit::get()->count()+1;
            $voucher_no=sprintf("%s%06s", "SL", $voucher_id);
        }else{
            $voucher_no = ++$voucher;
        }
        
        $validatedData['status']=$status;
        $validatedData['voucher_no']=$voucher_no;
        $bankCash = BankCash::create($validatedData);

        $date = date('d-m-Y');
        $validatedData['date']=$date;
        $validatedData['total']=$request->current_balance;
        $validatedData['source']=$bankCash->id;
        $validatedData['type']='cr';
        $bankCash = Profit::create($validatedData);
           
        return redirect()->route('account-bank-cash-list')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankCash  $bankCash
     * @return \Illuminate\Http\Response
     */
    public function show(BankCash $bankCash)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankCash  $bankCash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankCash = BankCash::findOrFail($id);
        return view('backend.bankCash.edit',compact('bankCash'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankCash  $bankCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'current_balance' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable',
            'voucher_no' => 'nullable',
        ]);

        $status = 0;
        if($request->status){
            $status = 1;
        }

        $validatedData['status']=$status;

        BankCash::whereId($id)->update($validatedData);

        $BankCashVoucher = BankCash::find($id);
        $id2 = Profit::where('voucher_no',$BankCashVoucher->voucher_no)->get()->pluck('id')->first();
        $profitData['source']=$id;
        $profitData['total']=$request->current_balance;
        Profit::whereId($id2)->update($profitData);
           
        return redirect()->route('account-bank-cash-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankCash  $bankCash
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankCash = BankCash::findOrFail($id);
        $bankCash->delete();

        return redirect()->route('account-bank-cash-list')->with('danger', 'Data is successfully deleted');
    }
}
