<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;

class BranchController extends Controller
{
    public function index()
    {
         $branches = branch::all();
         return response()->json($branches, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
         //return response()->json($zones);
        //return $this->showAllTransform("load data banks successfully" , $zones , 200);
    }

    public function unCheked()
    {
        $unCheked = DB::table('branches')
                    ->join('concludes','concludes.br_id','!=','branches.br_id' )
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->select('branches.br_id','branches.branchName')
                    ->get();
        return response()->json($unCheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
        
        //->whereMonth('concludes.date', '=', today()->month)

    }
    
    public function Cheked()
    {
        $cheked = DB::table('branches')
                    ->join('concludes','concludes.br_id','=','branches.br_id' )
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->select('branches.br_id','branches.branchName')
                    ->get();
        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}

