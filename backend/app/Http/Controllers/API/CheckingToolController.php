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
        $user_id = \Auth::id();
        foreach($request->tools as $tool){
            $addTools = CheckingTool::create([
                'tool_id' => $tool['tool_id'] ,
                'br_id' => $tool['br_id'],
                'user_id' => $user_id,
                'remain'=> $tool['remain'],
                'check'=> $tool['score'],
                //'comment'=> $tool['comment'],
                'date'=> date('Y-m-d')
            ]);
            $addTools->save();
        }
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
    public function update(Request $request)
    {
        return $user_id = \Auth::id();
        // foreach($request->tools as $tool){
        //     $checkingTool = CheckingTool::findOrFail($tool['ct_id']);
        //     $checkingTool->user_id = $user_id;
        //     $checkingTool->check = $tool['check'];
        //     // $checkingTool->comment = $tool->comment;
        //     $checkingTool->date = date('Y-m-d');
        //     $checkingTool->save();
        // }
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

        if ($cheked > 0 ) {
            $cheked = 1;
        }
        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedTools($branchID)
    {
        $alldata = DB::table('checking_tools')
                    ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', today()->month)
                    ->select('checking_tools.*','tools.code','tools.name')
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

    //ดูข้อมูลย้อนหลัง
    public function alldataChekedToolsOld($branchID,$month,$year)
    {
        $alldata = DB::table('checking_tools')
                    ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', $month)
                    ->whereYear('checking_tools.date', '=', $year)
                    ->select('checking_tools.*','tools.code','tools.name')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountToolremainOld($branchID,$month,$year)
    {
        $chekedTools = DB::table('checking_tools')
                        ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', $month)
                        ->whereYear('checking_tools.date', '=', $year)
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

    public function showAmountChekedToolsOld($branchID,$month,$year)
    {
        $chekedTools = DB::table('checking_tools')
                        ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', $month)
                        ->whereYear('checking_tools.date', '=', $year)
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

    public function showNumberToolremainOld($branchID,$month,$year)
    {
        $chekedTools = DB::table('checking_tools')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', $month)
                        ->whereYear('checking_tools.date', '=', $year)
                        ->sum('checking_tools.remain');

       return response()->json($chekedTools, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberChekedToolsOld($branchID,$month,$year)
    {
        $chekedTools = DB::table('checking_tools')
                        ->where('checking_tools.br_id', '=', $branchID)
                        ->whereMonth('checking_tools.date', '=', $month)
                        ->whereYear('checking_tools.date', '=', $year)
                        ->sum('checking_tools.check');

       return response()->json($chekedTools , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }
}
