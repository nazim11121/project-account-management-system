<?php

namespace App\Http\Controllers\backend\ledger;

use App\Models\LedgerName;
use App\Models\LedgerType;
use App\Models\LedgerGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedgerNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ledgerName = LedgerName::get();
        return view('backend.ledger.ledgerName.index',compact('ledgerName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ledger_type = LedgerType::get();
        $ledger_group = LedgerGroup::get();
        return view('backend.ledger.ledgerName.create',compact('ledger_type','ledger_group'));
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
            'code' => 'nullable',
        ]);

        $ledgerName = LedgerName::create($validatedData);
           
        return redirect()->route('ledger-ledgerName-index')->with('success', 'Data is successfully saved');
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
        $ledgerName = LedgerName::findOrFail($id);
        $ledger_type = LedgerType::get();
        $ledger_group = LedgerGroup::get();
        return view('backend.ledger.ledgerName.edit',compact('ledgerName','ledger_type','ledger_group'));
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
            'name' => 'nullable',
            'code' => 'nullable',
        ]);

        LedgerName::whereId($id)->update($validatedData);
           
        return redirect()->route('ledger-ledgerName-index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ledgerName = LedgerName::findOrFail($id);
        $ledgerName->delete();

        return redirect()->route('ledger-ledgerName-index')->with('success', 'Data is successfully deleted');
    }
}
