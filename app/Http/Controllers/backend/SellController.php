<?php

namespace App\Http\Controllers\backend;

use App\Models\Sell;
use App\Models\Client;
use App\Models\Inventory;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sell = Sell::with('customer_names','project_names','employee_names')->get();
        return view('backend.sell.index',compact('sell'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Client::get();
        $project = Inventory::get();
        $employee = Employee::get();
        return view('backend.sell.create',compact('customer','project','employee'));
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
            'customer_name' => 'nullable',
            'project_name' => 'nullable',
            'employee_name' => 'nullable',
            'sell_amount' => 'nullable',
            'sell_date' => 'nullable',
        ]);

        $sell = Sell::create($validatedData);
           
        return redirect()->route('account-sell-index')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sell = Sell::findOrFail($id);
        $customer = Client::get();
        $project = Inventory::get();
        $employee = Employee::get();
        return view('backend.sell.edit',compact('sell','customer','project','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'nullable',
            'project_name' => 'nullable',
            'employee_name' => 'nullable',
            'sell_date' => 'nullable',
        ]);

        Sell::whereId($id)->update($validatedData);
           
        return redirect()->route('account-sell-index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sell = Sell::findOrFail($id);
        $sell->delete();

        return redirect()->route('account-sell-index')->with('success', 'Data is successfully deleted');
    }
}
