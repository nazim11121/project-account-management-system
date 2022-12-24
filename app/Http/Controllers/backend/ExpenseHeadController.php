<?php

namespace App\Http\Controllers\backend;

use App\Models\ExpenseHead;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseHead = ExpenseHead::get();
        return view('backend.expenseHead.list',compact('expenseHead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expenseHead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'nullable',
            'description' => 'nullable',
        ]);

        $expenseHead = ExpenseHead::create($validatedData);
           
        return redirect()->route('account-expense-head-list')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeHead  $incomeHead
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeHead $incomeHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeHead  $incomeHead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenseHead = ExpenseHead::findOrFail($id);
        return view('backend.expenseHead.edit',compact('expenseHead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeHead  $incomeHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'nullable',
            'description' => 'nullable',
        ]);

        ExpenseHead::whereId($id)->update($validatedData);
           
        return redirect()->route('account-expense-head-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeHead  $incomeHead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseHead = ExpenseHead::findOrFail($id);
        $expenseHead->delete();

        return redirect()->route('account-expense-head-list')->with('danger', 'Data is successfully deleted');
    }
}
