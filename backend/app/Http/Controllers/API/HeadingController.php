<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Heading;
use App\Subheading;
use App\RateAndScore;
use DB;

class HeadingController extends Controller
{
    public function index()
    {
        $headings = Heading::all();
        return response()->json($headings, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function showHeading($groupID)
    {
        $heading = Heading::where('group_id', $groupID)->with('group')
                ->with('subHeading')
                ->get();

        return response()->json($heading , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    public function showRateAndScore($groupID)
    {
        $rateAndScore = RateAndScore::all();
        $heading = Heading::where('group_id', $groupID)->with('group')
                ->with('subHeading')
                ->get();

        return response()->json($rateAndScore , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function rateAndScore($id,$groupID)
    {
        $rateAndScore = RateAndScore::where('br_id', $groupID)->whereMonth('date', today()->month)->get();

        return response()->json($rateAndScore , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}
