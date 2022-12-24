<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::get();
        return view('backend.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
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
            'unit' => 'nullable',
            'unit_price' => 'nullable',
            'stock' => 'required',
            'description' => 'nullable',
            'file' => 'nullable',
        ]);

        if ($files = $request->file('file')) {
            $fileName = $files->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $files->move(storage_path('/app/public/uploads/product/'), $fileName);
            $validatedData['file'] = $fileName;
        }

        $product = Product::create($validatedData);
           
        return redirect()->route('product-list')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
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
        $product = Product::findOrFail($id);
        return view('backend.product.edit',compact('product'));
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
            'unit' => 'nullable',
            'unit_price' => 'nullable',
            'stock' => 'required',
            'description' => 'nullable',
            'file' => 'nullable',
        ]);

        if ($files = $request->file('file')) {
            $fileName = $files->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);
            $files->move(storage_path('/app/public/uploads/product/'), $fileName);
            $validatedData['file'] = $fileName;
        }

        Product::whereId($id)->update($validatedData);
           
        return redirect()->route('product-list')->with('warning', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product-list')->with('danger', 'Data is successfully deleted');
    }
}
