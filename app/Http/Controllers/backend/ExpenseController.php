<?php

namespace App\Http\Controllers\backend;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::get();
        return view('backend.expense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expense.create');
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
            'name' => 'nullable',
            'amount' => 'nullable',
            'category' => 'nullable',
            'method' => 'nullable',
            'description' => 'nullable',
        ]);

        $expense = Expense::create($validatedData);
           
        return redirect()->route('account-expense-index')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $expenses = Expense::findOrFail($id);
        return view('backend.expense.edit',compact('expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'amount' => 'nullable',
            'category' => 'nullable',
            'method' => 'nullable',
            'description' => 'nullable',
        ]);

        Expense::whereId($id)->update($validatedData);
           
        return redirect()->route('account-expense-index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenses = Expense::findOrFail($id);
        $expenses->delete();

        return redirect()->route('account-expense-index')->with('success', 'Data is successfully deleted');
    }
}
