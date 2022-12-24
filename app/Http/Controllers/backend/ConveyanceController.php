<?php

namespace App\Http\Controllers\backend;

use App\Models\Salary;
use App\Models\Profit;
use App\Models\ExpenseHead;
use App\Models\Employee;
use App\Models\BankCash;
use App\Models\Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConveyanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = Profit::where('expense_head', 5)->where('type', 'dr')->orderBy('voucher_no','ASC')->get();
        return view('backend.conveyance.list',compact('salary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $expenseHead = ExpenseHead::get();
        $employee = Employee::get();
        $bankCash = BankCash::get();
        $voucher_id = Profit::get()->count()+1;
        $voucher_no=sprintf("%s%06s", "SL", $voucher_id);
        return view('backend.conveyance.create',compact('expenseHead','employee','bankCash','voucher_no'));
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
                'voucher_no' => "required|unique:Expenses,voucher_no",
                'expense_date' => 'required',
                'expense_head' => 'required',
                'project_name' => 'nullable',
                'receiver' => 'nullable',
                'expense_details' => 'nullable',
                'amount' => 'required',
                'total' => 'required',
                'source' => 'required',
                'attachment' => 'nullable',
                'payment_note' => 'nullable',
                'type' => 'nullable',
            ]);

            $errors = $validatorData->errors();
            $data=$validatorData->validated();
            if ($validatorData->fails()) 
            {
                return redirect()->route('account-conveyance-create',compact('errors'))
                    ->withErrors($validatorData)
                    ->withInput();
            }

            $model = new Profit();

            if ($files = $request->file('attachment')) {
                $fileName = $files->getClientOriginalName();
                $fileName = str_replace(' ', '-', $fileName);
                $files->move(storage_path('/app/public/uploads/expense/'), $fileName);
                $model['attachment'] = $fileName;
            }

            $expense_details = json_encode($request->expense_details);
            $amount = json_encode($request->amount);

            $model->voucher_no = $request->voucher_no;
            $model->date = $request->expense_date;
            $model->expense_head = $request->expense_head;
            $model->project_name = $request->project_name;
            $model->receiver = $request->receiver;
            $model->description = $expense_details;
            $model->amount = $amount;
            $model->total = $request->total;
            $model->source = $request->source;
            $model->payment_note = $request->payment_note;
            $model->type = 'dr';
            $model->save();

            $bankCashUpdate = BankCash::find($request->source);           
            $bankCashUpdate->current_balance=$bankCashUpdate->current_balance-$request->total;
            $bankCashUpdate->save();

            $status = 'success';
            $message = 'Data is successfully saved';    
        } catch (\Exception $exception) {
            $status = 'warning';
            $message = $exception->getMessage();
        }
        
        return redirect()->route('account-conveyance-list')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conveyance = Profit::findOrFail($id);
        $conveyance->delete();

        $bankCashUpdate = BankCash::find($conveyance->source);           
        $bankCashUpdate->current_balance=$bankCashUpdate->current_balance+$conveyance->total;
        $bankCashUpdate->save();

        return redirect()->route('account-conveyance-list')->with('danger', 'Data is successfully deleted');
    }

    public function ename(Request $request)
    {
        $employee= Employee::latest()->get()->pluck('name');
        return response()->json($employee);
    }  

    public function pjname(Request $request)
    {
        $project_name= Inventory::latest()->get()->pluck('name');
        return response()->json($project_name);
    }   
}
