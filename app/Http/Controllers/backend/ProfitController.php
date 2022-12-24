<?php

namespace App\Http\Controllers\backend;

use App\Models\Profit;
use App\Models\IncomeHead;
use App\Models\Client;
use App\Models\BankCash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profit = Profit::where('type', 'cr')->orderBy('voucher_no','ASC')->get();
        return view('backend.profit.list',compact('profit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $incomeHead = IncomeHead::get();
        $client = Client::get();
        $bankCash = BankCash::get();
        $voucher_id = Profit::get()->count()+1;
        $voucher_no=sprintf("%s%06s", "SL", $voucher_id);
        return view('backend.profit.create',compact('incomeHead','client','bankCash','voucher_no'));
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
                'voucher_no' => "required|unique:profits,voucher_no",
                'income_date' => 'required',
                'income_head' => 'required',
                'giver' => 'nullable',
                'amount' => 'required',
                'source' => 'required',
                'attachment' => 'nullable',
                'payment_note' => 'nullable',
                'description' => 'nullable',
                'type' => 'nullable',
                'project_name' => 'nullable',
            ]);

            $errors = $validatorData->errors();
            $data=$validatorData->validated();
            if ($validatorData->fails()) 
            {
                return redirect()->route('account-profit-create',compact('errors'))
                    ->withErrors($validatorData)
                    ->withInput();
            }

            $model = new Profit();

            if ($files = $request->file('attachment')) {
                $fileName = $files->getClientOriginalName();
                $fileName = str_replace(' ', '-', $fileName);
                $files->move(storage_path('/app/public/uploads/profit/'), $fileName);
                $model['attachment'] = $fileName;
            }

            $model->voucher_no = $request->voucher_no;
            $model->date = $request->income_date;
            $model->income_head = $request->income_head;
            $model->giver = $request->giver;
            $model->total = $request->amount;
            $model->source = $request->source;
            $model->payment_note = $request->payment_note;
            $model->description = $request->description;
            $model->project_name = $request->project_name;
            $model->type = 'cr';
            $model->save();

            $fundUpdate = BankCash::find($request->source);           
            $fundUpdate->current_balance=$fundUpdate->current_balance+$request->amount;
            $fundUpdate->save();

            $status = 'success';
            $message = 'Data is successfully saved';    
        } catch (\Exception $exception) {
            $status = 'warning';
            $message = $exception->getMessage();
        }
        
        return redirect()->route('account-profit-list')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function show(Profit $profit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function edit(Profit $profit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profit $profit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $profit = Profit::findOrFail($id);
        $fundUpdate = BankCash::find($profit->source);           
        $fundUpdate->current_balance=$fundUpdate->current_balance-$profit->total;
        $fundUpdate->save();                
        $profit->delete();

        return redirect()->route('account-profit-list')->with('danger', 'Data is successfully deleted');
    }

    public function cname(Request $request)
    {
        $client= Client::latest()->get()->pluck('name');
        return response()->json($client);
    }
}
