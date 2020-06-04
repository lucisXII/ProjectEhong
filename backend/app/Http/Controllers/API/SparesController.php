<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spares;
use DB;

class SparesController extends Controller
{
    public function showSpares($branchID)
    {
         $spares = DB::table('spares')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->select('spares.*')
                ->get();
        
        return response()->json($spares, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);     
    }

    public function showAmountSpares($branchID)
    {     
        $spares = DB::table('spares')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->select('spares.*')
                ->get();

        $amount = 0.00;

        foreach ($spares as  $spare) {
            $sum = 0.00;
            $sum = $spare->remain * $spare->costprice;
            $amount = $amount + $sum;
        }
        //echo  $amount;   
       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }

    public function showNumberSpares($branchID)
    {     
        $sum= DB::table('spares')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->sum('spares.remain');

        /*$num = 0.00;

        foreach ($spares as  $spare) {
            $num = $num + $spare->remain;
        }*/
        
       return response()->json($sum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }
}
