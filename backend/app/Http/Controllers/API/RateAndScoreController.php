<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RateAndScore;
use App\Subheading;
use DB;

class RateAndScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$alldata = RateAndScore::all();
       // return response()->json($zones, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        //,JSON_UNESCAPED_UNICODE);
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
    public function store(Request $request, $id)
    {
        $user_id = \Auth::id();
        foreach($request->headings as $RateAndScores){
            foreach ($RateAndScores['sub_heading'] as $score) {
                $addScore = RateAndScore::create([
                    'sh_id' => $score['sh_id'] ,
                    'br_id' => $id,
                    'user_id' => $user_id,
                    'score'=> $score['get'],
                    'date'=> date('Y-m-d')
                ]);
                $addScore->save();
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
    public function update($branchID, $groupID, Request $request)
    {
        $user_id = \Auth::id();
        foreach($request->headings as $RateAndScores){
            foreach ($RateAndScores['sub_heading'] as $score) {
                if ($score['get'] != null) {
                    $updateScore = $score['get'];
                } else {
                    $updateScore = $score['rate_and_score']['score'];
                }
                $updateRateAndScores = RateAndScore::findOrFail($score['rate_and_score']['rs_id']);
                $updateRateAndScores->user_id = $user_id;
                $updateRateAndScores->score = $updateScore;
                $updateRateAndScores->date = date('Y-m-d');
                $updateRateAndScores->save();
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

    public function ChekedRateAndScore($branchID,$groupID)
    {
        $groups = DB::table('rate_and_scores')
                    ->join('subheadings','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->join('headings','subheadings.hd_id','=','headings.hd_id' )
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->select('headings.group_id')
                    ->distinct()
                    ->get();

        $Cheked = 0;
        if(count($groups) != 0){

            foreach ($groups as  $group) {
                if($group->group_id == $groupID){
                    $Cheked = 1;
                }
           }
            return response()->json($Cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
            ,JSON_UNESCAPED_UNICODE);

        }else{
           return response()->json(count($groups), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
            ,JSON_UNESCAPED_UNICODE);
        }
    }
    public function showGroupChecked($branchID)
    {
        // $groupslist = DB::table('groups')
        //             ->select('group_id.group_id')
        //             ->get();

        return $groups = DB::table('rate_and_scores')
                    ->join('subheadings','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->join('headings','subheadings.hd_id','=','headings.hd_id' )
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->select('headings.group_id')
                    ->distinct()
                    ->get();

        $array = array();
        for($i=0 ; $i < 6; $i++){
            $array[$i] = 0;
        }
        //return $groups;
        foreach ($groups as  $group){
            $check = 0;
            $num = 0;
            for($i=1 ; $i < 7; $i++){
                if($group->group_id == $i){
                    $array[$i-1] = 1;
                }
            }
        }
        return response()->json($array, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    public function showalldataRates($branchID,$groupID)
    {
        $list = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                ->where('groups.group_id', '=', $groupID)
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', today()->month)
                ->select('rate_and_scores.*','subheadings.*','headings.*')
                ->get();

        return response()->json($list, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showRatesFullScore($branchID,$groupID)
    {
        $lists = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                ->where('groups.group_id', '=', $groupID)
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', today()->month)
                ->select('rate_and_scores.*')
                ->get();

        $sum = 0.00;

        foreach ($lists as  $list) {
            $sum = $sum + $list->score;
        }

        return response()->json($sum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ChekedRateAndScoreLast($branchID)
    {
        $groups = DB::table('rate_and_scores')
                    ->join('subheadings','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->join('headings','subheadings.hd_id','=','headings.hd_id' )
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->select('headings.group_id')
                    ->distinct()
                    ->get();

        $Cheked = 0;
        if(count($groups) == 6){

            $Cheked = 1;
            return response()->json($Cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
            ,JSON_UNESCAPED_UNICODE);

        }else{
           return response()->json($Cheked, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
            ,JSON_UNESCAPED_UNICODE);
        }
    }

    //ดูข้อมูลย้อนหลัง
    public function showalldataRatesOld($branchID,$groupID,$month,$year)
    {
        $list = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                ->where('groups.group_id', '=', $groupID)
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', $month)
                ->whereYear('rate_and_scores.date', '=', $year)
                ->select('rate_and_scores.*')
                ->get();

        return response()->json($list, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showRatesFullScoreOld($branchID,$groupID,$month,$year)
    {
        $lists = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                ->where('groups.group_id', '=', $groupID)
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', $month)
                ->whereYear('rate_and_scores.date', '=', $year)
                ->select('rate_and_scores.*')
                ->get();

        $sum = 0.00;

        foreach ($lists as  $list) {
            $sum = $sum + $list->score;
        }

        return response()->json($sum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

}
