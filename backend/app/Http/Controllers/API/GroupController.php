<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Group;
use DB;

class GroupController extends Controller
{
    public function index()
    {
         $groups = Group::all();

         return response()->json($groups, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
         ,JSON_UNESCAPED_UNICODE);

    }

    public function indexChecked($branchID)
    {
         $groups = Group::all();
         $check = $this->showGroupChecked($branchID);
        //  return $check;

         $groupData = array();
         foreach ($groups as $group) {
             if (in_array($group->group_id, $check) > 0) {
                $status = 1;
             } else {
                $status = 0;
             }
             $group['status'] = $status;
            array_push($groupData, $group);
         }
         return response()->json($groupData, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
         ,JSON_UNESCAPED_UNICODE);

    }

    public function showGroupChecked($branchID)
    {
        $groups = DB::table('rate_and_scores')
                    ->join('subheadings','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->join('headings','subheadings.hd_id','=','headings.hd_id' )
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->select('headings.group_id')
                    ->distinct()
                    ->get();
        $array = array();
        foreach ($groups as $group){
            array_push($array, $group->group_id);
        }
        return $array;

    }
}
