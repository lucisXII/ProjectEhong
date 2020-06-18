<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Conclude;

class ConcludeController extends Controller
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
        $id = $request->id;
        // เพิ่มคะแนนเต็ม
        $scoresCheck = DB::table('rate_and_scores')
                        ->where('rate_and_scores.br_id', '=', $id)
                        ->whereMonth('rate_and_scores.date', '=', today()->month)
                        ->sum('rate_and_scores.score');
        //เพิ่มข้อมูล
        $conclude = new Conclude([
            'br_id' => $id,
            'score' => $scoresCheck
        ]);
        $conclude->save();
        // return $conclude;
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

    public function confirm($branchID)
    {
        //$branchID
        $status = DB::table('concludes')
                    //->join('concludes','concludes.br_id','!=','branches.br_id' )
                    ->where('concludes.br_id', '=', $branchID)
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->count();
        return response()->json($status, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);


        //$status = Concludes::where(['status' => '1', 'slug' => $id])->firstOrFail();

    }
}
