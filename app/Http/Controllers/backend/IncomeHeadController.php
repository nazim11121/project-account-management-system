<?php

namespace App\Http\Controllers\backend;

use App\Models\IncomeHead;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomeHead = IncomeHead::get();
        return view('backend.incomeHead.list',compact('incomeHead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.incomeHead.create');
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

        $incomeHead = IncomeHead::create($validatedData);
           
        return redirect()->route('account-income-head-list')->with('success', 'Data is successfully saved');
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
        $incomeHead = IncomeHead::findOrFail($id);
        return view('backend.incomeHead.edit',compact('incomeHead'));
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
            'name' => 'nullable',
            'code' => 'nullable',
            'description' => 'nullable',
        ]);

        IncomeHead::whereId($id)->update($validatedData);
           
        return redirect()->route('account-income-head-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeHead  $incomeHead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incomeHead = IncomeHead::findOrFail($id);
        $incomeHead->delete();

        return redirect()->route('account-income-head-list')->with('danger', 'Data is successfully deleted');
    }
}
