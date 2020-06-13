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
        // $cost = Cost::create([
        //     'br_id' => $totalcost->br_id,
        //     'user_id' => '2',
        //     'totalamount' => $totalcost->totalamount,
        //     'storefront' => $totalcost->storefront,
        //     'checkmoney' => $request->money,
        //     'receipt' => $request->bill,
        //     'agreement' => $request->agreement,
        //     'date' => timestamp('created_at'),
        //     'comment' => $request->comment,
        // ]);


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
}
