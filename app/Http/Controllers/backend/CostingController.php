<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Costing;
use App\Models\CostingInventory;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class CostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cost = Costing::with('vendor_names')->get();
        return view('backend.costing.list',compact('cost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Vendor::get();
        $product = Product::get();
        $invoice_id = Costing::get()->count()+1;
        // $results = preg_split('/[^0-9]/', $invoice_no);
        $invoice_no=sprintf("%s%06s", "SL", $invoice_id);
        return view('backend.costing.create',compact('vendor','product','invoice_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validatorData = Validator::make($request->all(), [
                'invoice_no' => "required|unique:costings,invoice_no",
                'invoice_date' => 'nullable',
                'attachment' => 'nullable',
                'vendor_name' => 'nullable',
                'product_name' => 'nullable',
                'price' => 'nullable',
                'quantity' => 'nullable',
                'subtotal' => 'nullable',
                'grand_total' => 'nullable',
                'paid_amount' => 'nullable',
                'due' => 'nullable',
                'payment_note' => 'nullable',
            ]);

            $errors = $validatorData->errors();
            $data=$validatorData->validated();
            if ($validatorData->fails()) 
            {
                return redirect()->route('purchase-costing-create',compact('errors'))
                    ->withErrors($validatorData)
                    ->withInput();
            }

            $model = new Costing();

            if ($files = $request->file('attachment')) {
                $fileName = $files->getClientOriginalName();
                $fileName = str_replace(' ', '-', $fileName);
                $files->move(storage_path('/app/public/uploads/attachment/'), $fileName);
                $model['attachment'] = $fileName;
            }

            $product_name = json_encode($request->product_name);
            $price = json_encode($request->price);
            $quantity = json_encode($request->quantity);
            $subtotal = json_encode($request->subtotal);

            if (empty($request->paid_amount)) {
                $paid_amount = 0;
            }else{
                $paid_amount = $request->paid_amount;
            }

            if (empty($request->due)) {
                $due = 0;
            }else{
                $due = $request->due;
            }

            $model->invoice_no = $request->invoice_no;
            $model->invoice_date = $request->invoice_date;
            $model->vendor_name = $request->vendor_name;
            $model->product_name = $product_name;
            $model->price = $price;
            $model->quantity = $quantity;
            $model->subtotal = $subtotal;
            $model->grand_total = $request->grand_total;
            $model->paid_amount = $paid_amount;
            $model->due = $due;
            $model->payment_note = $request->payment_note;
            $model->save();

            for ($i = 0; $i < count($request->product_name); $i++) {
                $value = $request->product_name[$i];
                $nameToVal = Product::where('name',$value)->get()->pluck('id')->first();
                if ($nameToVal!="") {
                    $product = Product::findOrFail($nameToVal);;
                    $product->stock = $request->quantity[$i]+$product->stock;
                    $product->unit_price = $request->price[$i];
                    $product->save();
                    
                }else{
                    $newProduct = new Product();
                    $newProduct->name = $value;
                    $newProduct->unit = 'pcs';
                    $newProduct->unit_price = $request->price[$i];
                    $newProduct->stock = $request->quantity[$i];
                    $newProduct->save();
                }
            }

            for ($i = 0; $i < count($request->product_name); $i++) {
                $answers[] = [
                 'costing_id' => $model->id,   
                 'invoice_no' => $request->invoice_no,
                 'product_name' => $request->product_name[$i],
                 'price' => $request->price[$i],
                 'quantity' => $request->quantity[$i],
                 'subtotal' => $request->subtotal[$i],
                ];
            }
             CostingInventory::insert($answers);

            $status = 'success';
            $message = 'Data is successfully saved';    
        } catch (\Exception $exception) {
            $status = 'warning';
            $message = $exception->getMessage();
        }
        
        return redirect()->route('purchase-costing-list')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costing  $costing
     * @return \Illuminate\Http\Response
     */
    public function show(Costing $costing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Costing  $costing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $costing = Costing::findOrFail($id);
        $costingInventory = CostingInventory::where('costing_id',$id)->get();
        $vendor = Vendor::get();
        $product = Product::get();
        return view('backend.costing.edit',compact('costing','vendor','product','costingInventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Costing  $costing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validatorData = Validator::make($request->all(), [
                'invoice_no' => "required",
                'invoice_date' => 'nullable',
                'attachment' => 'nullable',
                'vendor_name' => 'nullable',
                'product_name' => 'nullable',
                'price' => 'nullable',
                'quantity' => 'nullable',
                'subtotal' => 'nullable',
                'grand_total' => 'nullable',
                'paid_amount' => 'nullable',
                'due' => 'nullable',
                'payment_note' => 'nullable',
            ]);

            $errors = $validatorData->errors();
            $data=$validatorData->validated();
            if ($validatorData->fails()) 
            {
                return redirect()->route('purchase-costing-edit',compact('errors'))
                    ->withErrors($validatorData)
                    ->withInput();
            }

            $model = Costing::findOrFail($id);

            if ($files = $request->file('attachment')) {
                $fileName = $files->getClientOriginalName();
                $fileName = str_replace(' ', '-', $fileName);
                $files->move(storage_path('/app/public/uploads/attachment/'), $fileName);
                $model['attachment'] = $fileName;
            }

            $product_name = json_encode($request->product_name);
            $price = json_encode($request->price);
            $quantity = json_encode($request->quantity);
            $subtotal = json_encode($request->subtotal);

            $model->invoice_no = $request->invoice_no;
            $model->invoice_date = $request->invoice_date;
            $model->vendor_name = $request->vendor_name;
            $model->product_name = $product_name;
            $model->price = $price;
            $model->quantity = $quantity;
            $model->subtotal = $subtotal;
            $model->grand_total = $request->grand_total;
            $model->paid_amount = $request->paid_amount;
            $model->due = $request->due;
            $model->payment_note = $request->payment_note;
            $model->save();
            

            for ($i = 0; $i < count($request->product_name); $i++) {

                $value=$request->product_name[$i];
                $nameToVal = Product::where('name',$value)->get()->pluck('id')->first();
                $invoice_no=$request->invoice_no;
                $oldQuantity=CostingInventory::where('product_name',$nameToVal)->where('invoice_no',$invoice_no)->get()->pluck('quantity')->first();

                $product = Product::findOrFail($nameToVal);
                if ($oldQuantity<$request->quantity[$i]) {
                    $updateQuantity = $request->quantity[$i]-$oldQuantity;
                    $product->stock = $updateQuantity+$product->stock;
                    $product->unit_price = $request->price[$i];
                    $product->save();
                }elseif($oldQuantity>$request->quantity[$i]){
                    $updateQuantity = $oldQuantity-$request->quantity[$i];
                    $product->stock = ($product->stock)-($updateQuantity);
                    $product->unit_price = $request->price[$i];
                    $product->save();
                }else{
                    $product->stock = $request->quantity[$i]+$product->stock;
                    $product->unit_price = $request->price[$i];
                    $product->save();
                }
            }
                $p_id = $model->id;
                $costingInventory = CostingInventory::where('costing_id',$p_id)->delete();

                for ($i = 0; $i < count($request->product_name); $i++) {
                    $answers[] = [
                     'costing_id' => $model->id,   
                     'invoice_no' => $request->invoice_no,
                     'product_name' => $request->product_name[$i],
                     'price' => $request->price[$i],
                     'quantity' => $request->quantity[$i],
                     'subtotal' => $request->subtotal[$i],
                    ];
                }
                CostingInventory::insert($answers);
                
                $status = 'success';
                $message = 'Data is successfully updated';    
            } catch (\Exception $exception) {
                $status = 'warning';
                $message = $exception->getMessage();
            }
            
            return redirect()->route('purchase-costing-list')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costing  $costing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $costing = Costing::findOrFail($id);
        $costing->delete();

        return redirect()->route('purchase-costing-list')->with('danger', 'Data is successfully deleted');
    }

    public function pname(Request $request)
    {
        $product= Product::latest()->get()->pluck('name');
        return response()->json($product);
    }

    public function pname2(Request $request)
    {
        $product= Product::latest()->get();
        return response()->json($product);
    }
}
