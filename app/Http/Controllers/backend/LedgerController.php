<?php

namespace App\Http\Controllers\backend;

use App\Models\Profit;
use App\Models\Expense;
use App\Models\BankCash;
use App\Models\Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
        if ($request->account_name!='') {

            $projectName=$request->project_name;
            $accountName=$request->account_name;
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $from = date('Y-m-d',strtotime(date_create_from_format("d/m/Y", $request->start_date)->format("Y-m-d")));            
            $to = date('Y-m-d',strtotime(date_create_from_format("d/m/Y", $request->end_date)->format("Y-m-d")));

            if ( $projectName=='0' &&  $accountName=='0') {

                $ledger = Profit::query()
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)
                    ->orderBy('type','ASC')
                    ->get();

                $deposite = Profit::where('type', 'cr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');  
                $expense = Profit::where('type', 'dr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');

                if($deposite=='0'){
                    $balance = '0';
                }else{
                    $balance = $deposite-$expense;
                }

            }elseif($projectName=='0' &&  $accountName!='0'){

                $ledger = Profit::query()
                ->where('source', $request->account_name)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->orderBy('type','ASC')
                ->get();

                $deposite = Profit::where('source', $request->account_name)->where('type', 'cr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');
                $expense = Profit::where('source', $request->account_name)->where('type', 'dr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');

                if($deposite=='0'){
                    $balance = '0';
                }else{
                    $balance = $deposite-$expense;
                }

            }elseif($accountName=='0' && $projectName!='0'){

                $ledger = Profit::query()
                ->where('project_name', $request->project_name)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->orderBy('type','ASC')
                ->get();

                $deposite = Profit::where('project_name', $request->project_name)->where('type', 'cr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');
                $expense = Profit::where('project_name', $request->project_name)->where('type', 'dr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');

                if($deposite=='0'){
                    $balance = '0';
                }else{
                    $balance = $deposite-$expense;
                }

            }else{

                $ledger = Profit::query()
                ->where('project_name', $request->project_name)
                ->where('source', $request->account_name)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->orderBy('type','ASC')
                ->get();
                
                $deposite = Profit::where('project_name', $request->project_name)->where('source', $request->account_name)->where('type', 'cr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');
                $expense = Profit::where('project_name', $request->project_name)->where('source', $request->account_name)->where('type', 'dr')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('total');

                if($deposite=='0'){
                    $balance = '0';
                }else{
                    $balance = $deposite-$expense;
                }
                
            }

            $bankCash = BankCash::get();
              
            return view('backend.ledger.search',compact('bankCash','balance','ledger','start_date','end_date','accountName','projectName','deposite','expense'));
        }

        $bankCash = BankCash::get();
        $ledger =[];
        $balance='0';
        $deposite='0';
        $expense='0';
        return view('backend.ledger.search',compact('bankCash','ledger','balance','expense','deposite'));
    }

    public function details(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $from = date('Y-m-d',strtotime(date_create_from_format("d/m/Y", $request->start_date)->format("Y-m-d")));
     
        $to = date('Y-m-d',strtotime(date_create_from_format("d/m/Y", $request->end_date)->format("Y-m-d")));

        $profit = Profit::query()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        $expense = Expense::query()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();  

        return view('backend.report.details',compact('profit','expense','start_date','end_date'));        
    }

    public function project_name(Request $request)
    {
        $project= Inventory::latest()->get()->pluck('name');
        return response()->json($project);
    }
}
