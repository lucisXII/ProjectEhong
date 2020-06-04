<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tool;
use App\CheckingTool;
use DB;

class CheckingToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function ChekedTool($branchID)
    {
        $cheked = DB::table('checking_tools')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', today()->month)
                    ->count();

        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedTools($branchID)
    {
        $alldata = DB::table('checking_tools')
                    ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', today()->month)
                    ->select('checking_tools.*','tools.*')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountToolremain($branchID)
    {     
        $chekedTools = DB::table('checking_tools')
                        ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', today()->month)
                        ->select('checking_tools.remain','tools.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedTools as  $chekedTool) {
            $sum = 0.00;
            $sum =  $chekedTool->remain *  $chekedTool->costprice;
            $amount = $amount + $sum;
        }
          
       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }

    public function showAmountChekedTools($branchID)
    {     
        $chekedTools = DB::table('checking_tools')
                        ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', today()->month)
                        ->select('checking_tools.check','tools.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedTools as  $chekedTool) {
            $sum = 0.00;
            $sum =  $chekedTool->check *  $chekedTool->costprice;
            $amount = $amount + $sum;
        }
          
       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }

    public function showNumberToolremain($branchID)
    {     
        $chekedTools = DB::table('checking_tools')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', today()->month)
                        ->sum('checking_tools.remain');

       return response()->json($chekedTools, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }

    public function showNumberChekedTools($branchID)
    {     
        $chekedTools = DB::table('checking_tools')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', today()->month)
                        ->sum('checking_tools.check');

       return response()->json($chekedTools , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);    
    }
}
