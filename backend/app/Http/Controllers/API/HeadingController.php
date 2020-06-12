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
        $heading = DB::table('headings')
                ->join('groups','groups.group_id','=','headings.group_id')
                ->where('groups.group_id', '=', $groupID)
                ->select('headings.*')
                ->get();

        return response()->json($heading , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }
}
