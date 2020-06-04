<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Motorcycle;
use App\CheckingMotorcycles;
use DB;

class CheckingMotorcyclesController extends Controller
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

    public function ChekedMotorcycle($branchID)
    {
        $cheked = DB::table('checking_motorcycles')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', today()->month)
                    ->count();

        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedMotorcycle($branchID)
    {
        $alldata = DB::table('checking_motorcycles')
                    ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', today()->month)
                    ->select('checking_motorcycles.*','motorcycles.*')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showvolume($branchID)
    {
        
         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();
        
        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);       
    }

    public function showvolumeChekedMotorcycle($branchID)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.status', '=', '1')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();
        
        return response()->json($ChekedMotorcycle , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);       
    }

    public function outstanding($branchID)
    {
        
         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.comment', '=', 'ยึดค้างส่ง')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();
        
        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);       
    }

    public function unready($branchID)
    {
        
         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.comment', '=', 'ไม่พร้อมขาย')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();
        
        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);       
    }
}
