<?php

namespace App\Http\Controllers\backend\ledger;

use App\Models\LedgerGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedgerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ledgerGroup = LedgerGroup::get();
        return view('backend.ledger.ledgerGroup.index',compact('ledgerGroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ledger.ledgerGroup.create');
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
            'group_name' => 'nullable',
            'code' => 'nullable',
        ]);

        $ledgerGroup = LedgerGroup::create($validatedData);
           
        return redirect()->route('ledger-ledgerGroup-index')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerGroup $ledgerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ledgerGroup = LedgerGroup::findOrFail($id);
        return view('backend.ledger.ledgerGroup.edit',compact('ledgerGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'group_name' => 'nullable',
            'code' => 'nullable',
        ]);

        LedgerGroup::whereId($id)->update($validatedData);
           
        return redirect()->route('ledger-ledgerGroup-index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ledgerGroup = LedgerGroup::findOrFail($id);
        $ledgerGroup->delete();

        return redirect()->route('ledger-ledgerGroup-index')->with('success', 'Data is successfully deleted');
    }
}
