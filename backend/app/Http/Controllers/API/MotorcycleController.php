<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Motorcycle;
use DB;

class MotorcycleController extends Controller
{
    public function showMotorcycle($branchID)
    {
         //$motorcycles = motorcycle::all();

         $motorcycles = DB::table('motorcycles')
                ->where('br_id', '=', $branchID)
                ->where('status', '=', '1')
                ->select('motorcycles.*')
                ->get();
        
        return response()->json($motorcycles, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE); 
         
    }
    public function showvolumeMotorcycle($branchID)
    {
         //$motorcycles = motorcycle::all();
        
         $motorcycles = DB::table('motorcycles')
                ->where('br_id', '=', $branchID)
                ->where('status', '=', '1')
                ->select('motorcycles.*')
                ->get();
        
        $count = count($motorcycles);
        
        //$amount = 0;
        //foreach ($motorcycles as  $count) {
        //    $amount = $amount+1;
        //}
        
        return response()->json($count, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE); 
         
    }
}
