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

    public function showRateAndScore($branchID ,$groupID)
    {
        // return $branchID;
        // $rateAndScore = Subheading::with('rateAndScore')->get();

        return $heading = Heading::where('group_id', $groupID)->with('group')
                ->with(['subHeading.rateAndScore' => function ($query) use ($branchID) {
                    $query->whereMonth('date', today()->month)->where('br_id', $branchID);
                }])
                ->get();

                // $deliveries = Delivery::with('order.product')
                // ->whereHas('order', function($query) use ($customerID) {
                //     $query->whereUserId($customerID);
                // })
                // ->orderBy('date')
                // ->get();
        // $users = App\User::with(['posts' => function ($query) {
        //     $query->where('title', 'like', '%first%');
        // }])->get();
        // $rateAndScore = RateAndScore::all();
        // $heading = Heading::where('group_id', $groupID)->with('group')
        //         ->with('subHeading')
        //         ->get();

        // return response()->json($rateAndScore , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        // ,JSON_UNESCAPED_UNICODE);
    }

    public function rateAndScore($id,$groupID)
    {
        $rateAndScore = RateAndScore::where('br_id', $groupID)->whereMonth('date', today()->month)->get();

        return response()->json($rateAndScore , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}
