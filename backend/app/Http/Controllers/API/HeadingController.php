<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Heading;
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

    public function rateAndScore($groupID)
    {
        $heading = Heading::where('group_id', $groupID)->with('group')
                ->with('subHeading')->with('rateAndScore')
                ->get();

        return response()->json($heading , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}
