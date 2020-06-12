<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subheading;
use DB;

class SubheadingController extends Controller
{
    public function showlist($groupID)
    {
        $list = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->where('groups.group_id', '=', $groupID)
                ->select('subheadings.*')
                ->get();

        return response()->json($list, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    public function showFullscoreGroup($groupID)
    {
        $lists = DB::table('groups')
                ->join('headings','headings.group_id','=', 'groups.group_id')
                ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                ->where('groups.group_id', '=', $groupID)
                ->select('subheadings.score')
                ->get();

        $sum = 0.00;

        foreach ($lists as  $list) {
            $sum = $sum + $list->score;
        }

        return response()->json($sum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
}
