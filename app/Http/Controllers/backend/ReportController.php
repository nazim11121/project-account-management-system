<?php

namespace App\Http\Controllers\backend;

use App\Models\Profit;
use App\Models\Expense;
use App\Models\BankCash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('backend.report.search');
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
                ->where('type','cr')
                ->get();
        $expense = Profit::query()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->where('type','dr')
                ->get();  

        return view('backend.report.details',compact('profit','expense','start_date','end_date'));        
    }
}
