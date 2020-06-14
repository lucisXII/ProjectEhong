<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Totalcost;
use App\Branch;
use App\Cost;
use DB;

class CostController extends Controller
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
    public function store($id, Request $request)
    {
        $user_id = \Auth::id();
        $totalcost = Totalcost::findOrFail($id);
        $cost = new Cost([
            'br_id' => $totalcost->br_id,
            'user_id' => $user_id,
            'totalamount' => $totalcost->totalamount,
            'storefront' => $totalcost->storefront,
            'checkmoney' => $request->money,
            'receipt' => $request->bill,
            'agreement' => $request->agreement,
            'date' => date('Y-m-d'),
            'comment' => $request->comment,
        ]);
        $cost->save();

        return response()->json($cost, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
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
        // $totalcost = Totalcost::findOrFail($id);
        $cost = Cost::findOrFail($id);
        $cost->checkmoney = $request->money;
        $cost->comment = $request->comment;
        $cost->receipt = $request->bill;
        $cost->agreement = $request->agreement;
        $cost->save();
        return $cost;
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

    public function ChekedCost($branchID)
    {
        $cheked = DB::table('costs')
                    ->where('costs.br_id', '=', $branchID)
                    ->whereMonth('costs.date', '=', today()->month)
                    ->count();

        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedCost($branchID)
    {
        // $alldata = DB::table('costs')
        //             ->where('costs.br_id', '=', $branchID)
        //             ->whereMonth('costs.date', '=', today()->month)
        //             ->get();

        $cost = Cost::where('br_id', $branchID)->whereMonth('date', today()->month)->firstOrFail();

        return response()->json($cost, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAgreement($branchID)
    {
        $show = DB::table('costs')
                        ->where('costs.br_id', '=', $branchID)
                        ->whereMonth('costs.date', '=', today()->month)
                        ->select('costs.agreement')
                        ->get();

        //$cost = Cost::where('br_id', $branchID)->whereMonth('date', today()->month)->firstOrFail();

        return response()->json($show, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    //ดูข้อมูลย้อนหลัง
    public function alldataChekedCostOld($branchID,$month,$year)
    {
        $cost = Cost::where('br_id', $branchID)->whereMonth('date',$month)
                                                ->whereYear('date',$year)->firstOrFail();

        return response()->json($cost, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAgreementOld($branchID,$month,$year)
    {
        $show = DB::table('costs')
                        ->where('costs.br_id', '=', $branchID)
                        ->whereMonth('costs.date', '=', $month)
                        ->whereYear('costs.date', '=', $year)
                        ->select('costs.agreement')
                        ->get();

        return response()->json($show, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
    
}
