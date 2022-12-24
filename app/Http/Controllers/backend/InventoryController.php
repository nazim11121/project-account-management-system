<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Client;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::with('clients')->get();
        return view('backend.inventory.list',compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::get();
        return view('backend.inventory.create',compact('client'));
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
            'client_name' => 'required',
            'assign_date' => 'nullable',
            'submission_date' => 'nullable',
            'status' => 'nullable',
            'total_cost' => 'nullable',
            'total_price' => 'required',
            'address' => 'nullable',
            'description' => 'nullable',
            'file' => 'nullable',
        ]);

        if ($files = $request->file('file')) {
            $fileName = $files->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $files->move(storage_path('/app/public/uploads/project/'), $fileName);
            $validatedData['file'] = $fileName;
        }

        $inventory = Inventory::create($validatedData);
           
        return redirect()->route('project-list')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::get();
        $inventory = Inventory::findOrFail($id);
        return view('backend.inventory.edit',compact('inventory','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'client_name' => 'required',
            'assign_date' => 'nullable',
            'submission_date' => 'nullable',
            'status' => 'nullable',
            'total_cost' => 'nullable',
            'total_price' => 'required',
            'address' => 'nullable',
            'description' => 'nullable',
            'file' => 'nullable',
        ]);

        if ($files = $request->file('file')) {
            $fileName = $files->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $files->move(storage_path('/app/public/uploads/project/'), $fileName);
            $validatedData['file'] = $fileName;
        }

        Inventory::whereId($id)->update($validatedData);
           
        return redirect()->route('project-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('project-list')->with('danger', 'Data is successfully deleted');
    }
}
