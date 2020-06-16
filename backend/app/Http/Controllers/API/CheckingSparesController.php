<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spares;
use App\CheckingSpares;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
class CheckingSparesController extends Controller
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
        User::create([
            'name' => 'Pirada maley',
	        'email' => 'Pirada@gmail.com',
	        'username' => 'Pirada',
	        'status' => '1',
	        'position' => 'Member',
            'address' => 'Kalasin',
            'phone' => '0987475232',
	        'password' => Hash::make('123456') // password
        ]);
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
        foreach($request->spares as $spare){
            $addSpares = CheckingSpares::create([
                's_id' => $spare['s_id'] ,
                'br_id' => $spare['br_id'],
                'user_id' => $user_id ,
                'remain'=> $spare['remain'],
                'check'=> $spare['score'],
                //'comment'=> $spare['comment'],
                'date'=> date('Y-m-d')
            ]);
            $addSpares->save();
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
        $user_id = \Auth::id();
        foreach($request->spares as $spare){
            $checkingSpare = CheckingSpares::findOrFail($spare['cs_id']);
            $checkingSpare->user_id = $user_id;
            $checkingSpare->check = $spare['check'];
            $checkingSpare->date = date('Y-m-d');
            $checkingSpare->save();
        }

        return $checkingSpare;
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

    public function ChekedSpares($branchID)
    {
        $cheked = DB::table('checking_spares')
                    ->where('checking_spares.br_id', '=', $branchID)
                    ->whereMonth('checking_spares.date', '=', today()->month)
                    ->count();

        if($cheked > 0){
             $cheked = 1;
        }

        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedSpares($branchID)
    {
        $alldata = DB::table('checking_spares')
                    ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                    ->where('checking_spares.br_id', '=', $branchID)
                    ->whereMonth('checking_spares.date', '=', today()->month)
                    ->select('checking_spares.*','spares.code','spares.name')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountSparesremain($branchID)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', today()->month)
                        ->select('checking_spares.remain','spares.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedSpares as  $chekedSpare) {
            $sum = 0.00;
            $sum = $chekedSpare->remain * $chekedSpare->costprice;
            $amount = $amount + $sum;
        }

       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountChekedSpares($branchID)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', today()->month)
                        ->select('checking_spares.check','spares.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedSpares as  $chekedSpare) {
            $sum = 0.00;
            $sum = $chekedSpare->check * $chekedSpare->costprice;
            $amount = $amount + $sum;
        }
        //echo  $amount;
       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberSparesremain($branchID)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', today()->month)
                        ->sum('checking_spares.remain');

       return response()->json( $chekedSpares, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberChekedSpares($branchID)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', today()->month)
                        ->sum('checking_spares.check');

       return response()->json( $chekedSpares, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    //ดูข้อมูลย้อนหลัง
    public function alldataChekedSparesOld($branchID,$month,$year)
    {
        $alldata = DB::table('checking_spares')
                    ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                    ->where('checking_spares.br_id', '=', $branchID)
                    ->whereMonth('checking_spares.date', '=', $month)
                    ->whereYear('checking_spares.date', '=', $year)
                    ->select('checking_spares.*','spares.code','spares.name')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountSparesremainOld($branchID,$month,$year)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', $month)
                        ->whereYear('checking_spares.date', '=', $year)
                        ->select('checking_spares.remain','spares.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedSpares as  $chekedSpare) {
            $sum = 0.00;
            $sum = $chekedSpare->remain * $chekedSpare->costprice;
            $amount = $amount + $sum;
        }

       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showAmountChekedSparesOld($branchID,$month,$year)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', $month)
                        ->whereYear('checking_spares.date', '=', $year)
                        ->select('checking_spares.check','spares.costprice')
                        ->get();

        $amount = 0.00;

        foreach ($chekedSpares as  $chekedSpare) {
            $sum = 0.00;
            $sum = $chekedSpare->check * $chekedSpare->costprice;
            $amount = $amount + $sum;
        }

       return response()->json($amount, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberSparesremainOld($branchID,$month,$year)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', $month)
                        ->whereYear('checking_spares.date', '=', $year)
                        ->sum('checking_spares.remain');

       return response()->json( $chekedSpares, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }

    public function showNumberChekedSparesOld($branchID,$month,$year)
    {
        $chekedSpares = DB::table('checking_spares')
                        ->where('checking_spares.br_id', '=', $branchID)
                        ->whereMonth('checking_spares.date', '=', $month)
                        ->whereYear('checking_spares.date', '=', $year)
                        ->sum('checking_spares.check');

       return response()->json( $chekedSpares, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
       ,JSON_UNESCAPED_UNICODE);
    }
}
