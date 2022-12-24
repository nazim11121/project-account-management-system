<?php

namespace App\Http\Controllers\backend;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::get();
        return view('backend.vendor.list',compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create');
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
            'company_name' => 'nullable',
            'contact_person_name' => 'required',
            'designation' => 'nullable',
            'mobile' => 'required',
            'email' => 'nullable',
            'address' => 'nullable',
            'website' => 'nullable',
            'details' => 'nullable',
        ]);

        $vendor = Vendor::create($validatedData);
           
        return redirect()->route('vendor-list')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'company_name' => 'nullable',
            'contact_person_name' => 'required',
            'designation' => 'nullable',
            'mobile' => 'required',
            'email' => 'nullable',
            'address' => 'nullable',
            'website' => 'nullable',
            'details' => 'nullable',
        ]);

        Vendor::whereId($id)->update($validatedData);
           
        return redirect()->route('vendor-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendor-list')->with('danger', 'Data is successfully deleted');
    }
}
