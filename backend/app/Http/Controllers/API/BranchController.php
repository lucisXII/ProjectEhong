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

        $cheked = DB::table('branches')
                ->join('concludes','concludes.br_id','=','branches.br_id' )
                ->whereMonth('concludes.date', '=', today()->month)
                ->whereNull('branches.close_date')
                ->select('branches.br_id','branches.branchName')
                ->get();
        
        $branches = DB::table('branches')
                ->whereNull('branches.close_date')
                ->select('branches.br_id','branches.branchName')
                ->get();

        $count =  count($branches);
        $unCheked = array();
        $i = 0;
        $j = 0;
        foreach($branches as $branche){
            $j = 0;
            foreach($cheked  as $check){
                if($branche->br_id == $check->br_id){
                    $j = 1;
                    //return $check;
                }
            }

            if($j == 0){
                $unCheked[$i][0] = $branche->br_id;
                $unCheked[$i][1] = $branche->branchName;
               $i++;
            }
        }
        //return $unCheked;
        // $unCheked = DB::table('branches')
        //             ->join('concludes','concludes.br_id','!=','branches.br_id' )
        //             ->whereMonth('concludes.date', '!=', today()->month)
        //             ->whereNull('branches.close_date')
        //             ->select('branches.br_id','branches.branchName')
        //             ->distinct()
        //             ->get();
        return response()->json($unCheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
        
        //->whereMonth('concludes.date', '=', today()->month)

    }
    
    public function Cheked()
    {
        $cheked = DB::table('branches')
                    ->join('concludes','concludes.br_id','=','branches.br_id' )
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->whereNull('branches.close_date')
                    ->select('branches.br_id','branches.branchName')
                    ->get();
        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showBranch($branchID)
    {
        // $branch = DB::table('branches')
        //             ->where('branches.br_id', '=', $branchID)
        //             ->select('branches.*')
        //             ->get();
        $branch = Branch::where('br_id', $branchID)->firstOrFail();

        return response()->json($branch, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function search($year,$month)
    {
        $showBranch = DB::table('branches')
                        ->join('concludes','concludes.br_id','=','branches.br_id' )
                        ->whereMonth('concludes.date', '=', $month)
                        ->whereYear('concludes.date', '=', $year)
                        ->whereNull('branches.close_date')
                        ->select('branches.br_id','branches.branchName')
                        ->get();

        return response()->json($showBranch, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}

