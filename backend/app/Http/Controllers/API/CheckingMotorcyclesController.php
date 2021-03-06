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
        $user_id = \Auth::id();
        foreach($request->motorcycles as $motorcycle){
            if ($motorcycle['active'] != 0) {
                $addmotorcycle = CheckingMotorcycles::create([
                    'm_id' => $motorcycle['m_id'] ,
                    'br_id' => $motorcycle['br_id'],
                    'user_id' => $user_id,
                    'status'=> $motorcycle['active'],
                    'unready'=> $motorcycle['unready'],
                    'date'=> date('Y-m-d')
                ]);
                $addmotorcycle->save();
            }
            else {
                $addmotorcycle = CheckingMotorcycles::create([
                    'm_id' => $motorcycle['m_id'] ,
                    'br_id' => $motorcycle['br_id'],
                    'user_id' => $user_id,
                    'status'=> 'false',
                    'unready'=> $motorcycle['unready'],
                    'date'=> date('Y-m-d')
                ]);
                $addmotorcycle->save();
            }
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
        foreach($request->motorcycles as $motorcycle){
            if ($motorcycle['status'] != 0) {
                $updatemotorcycle = CheckingMotorcycles::findOrFail($motorcycle['cm_id']);
                $updatemotorcycle->user_id = $user_id;
                $updatemotorcycle->status = $motorcycle['status'];
                $updatemotorcycle->unready = $motorcycle['unready'];
                $updatemotorcycle->date = date('Y-m-d');
                $updatemotorcycle->save();
            } else {
                $updatemotorcycle = CheckingMotorcycles::findOrFail($motorcycle['cm_id']);
                $updatemotorcycle->user_id = $user_id;
                $updatemotorcycle->status = 'false';
                $updatemotorcycle->unready = $motorcycle['unready'];
                $updatemotorcycle->date = date('Y-m-d');
                $updatemotorcycle->save();
            }

        }
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
        if($cheked > 0){
                $cheked = 1;
        }

        return response()->json($cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function alldataChekedMotorcycle($branchID)
    {
        $alldata = DB::table('checking_motorcycles')
                    ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', today()->month)
                    ->select('checking_motorcycles.*','motorcycles.name','motorcycles.brand','motorcycles.color','motorcycles.condition')
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
                            ->where('checking_motorcycles.status', '=', 'true')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();

        return response()->json($ChekedMotorcycle , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function outstanding($branchID)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.unready', '=', '1')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();

        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function unready($branchID)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.unready', '=', '2')
                            ->whereMonth('checking_motorcycles.date', '=', today()->month)
                            ->count();

        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    //ดูข้อมูลย้อนหลัง

    public function watchAlldataChekedMotorcycle($branchID,$month,$year)
    {
        $alldata = DB::table('checking_motorcycles')
                    ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', $month)
                    ->whereYear('checking_motorcycles.date', '=', $year)
                    ->select('checking_motorcycles.*','motorcycles.name','motorcycles.brand','motorcycles.color','motorcycles.condition')
                    ->get();

        return response()->json($alldata, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function watchShowvolume($branchID,$month,$year)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->whereMonth('checking_motorcycles.date', '=', $month)
                            ->whereYear('checking_motorcycles.date', '=', $year)
                            ->count();

        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function watchShowvolumeChekedMotorcycle($branchID,$month,$year)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.status', '=', 'true')
                            ->whereMonth('checking_motorcycles.date', '=', $month)
                            ->whereYear('checking_motorcycles.date', '=', $year)
                            ->count();

        return response()->json($ChekedMotorcycle , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function watchOutstanding($branchID,$month,$year)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.unready', '=', '1')
                            ->whereMonth('checking_motorcycles.date', '=', $month)
                            ->whereYear('checking_motorcycles.date', '=', $year)
                            ->count();

        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function watchUnready($branchID,$month,$year)
    {

         $ChekedMotorcycle = DB::table('checking_motorcycles')
                            ->where('checking_motorcycles.br_id', '=', $branchID)
                            ->where('checking_motorcycles.unready', '=', '2')
                            ->whereMonth('checking_motorcycles.date', '=', $month)
                            ->whereYear('checking_motorcycles.date', '=', $year)
                            ->count();

        return response()->json($ChekedMotorcycle, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}
