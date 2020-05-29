<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Totalcost;
use DB;

class TotalcostController extends Controller
{
    public function showTotalcost($branchID)
    {
         //$totalcosts = totalcost::all();

         $totalcosts = DB::table('totalcosts')
                ->where('br_id', '=', $branchID)
                ->select('totalcosts.*')
                ->get();
        
        return response()->json($totalcosts, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE); 
         
    }
}
