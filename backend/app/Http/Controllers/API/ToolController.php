<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tool;
use App\CheckingTool;
use DB;

class ToolController extends Controller
{
    public function showTool($branchID)
    {
         $tools = DB::table('tools')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->select('tools.*')
                ->get();

        return response()->json($tools, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountTool($branchID)
    {
        $tools = DB::table('tools')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->select('tools.*')
                ->get();

        $amount = 0.00;

        foreach ($tools as  $tool) {
            $sum = 0.00;
            $sum = $tool->remain * $tool->costprice;
            $amount = $amount + $sum;
        }

       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberTool($branchID)
    {
        $sum = DB::table('tools')
                ->where('br_id', '=', $branchID)
                ->where('remain', '>', '0')
                ->sum('tools.remain');

       return response()->json($sum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request) {
        $user_id = \Auth::id();
        foreach($request->tools as $tool){
            $addTools = CheckingTool::create([
                'tool_id' => $tool['tool_id'] ,
                'br_id' => $tool['br_id'],
                'user_id' => $user_id,
                'remain'=> $tool['remain'],
                'check'=> $tool['score'],
                'date'=> date('Y-m-d')
            ]);
            $addTools->save();
        }
    }
}
