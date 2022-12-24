<?php

namespace App\Http\Controllers\backend\ledger;

use App\Models\LedgerType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LedgerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ledgerType = LedgerType::get();
        return view('backend.ledger.ledgerType.index',compact('ledgerType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ledger.ledgerType.create');
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
            'type_name' => 'nullable',
            'code' => 'nullable',
        ]);

        $ledgerType = LedgerType::create($validatedData);
           
        return redirect()->route('ledger-ledgerType-index')->with('success', 'Data is successfully saved');
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
        $ledgerType = LedgerType::findOrFail($id);
        return view('backend.ledger.ledgerType.edit',compact('ledgerType'));
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
            'type_name' => 'nullable',
            'code' => 'nullable',
        ]);

        LedgerType::whereId($id)->update($validatedData);
           
        return redirect()->route('ledger-ledgerType-index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LedgerGroup  $ledgerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ledgerType = LedgerType::findOrFail($id);
        $ledgerType->delete();

        return redirect()->route('ledger-ledgerType-index')->with('success', 'Data is successfully deleted');
    }
}
