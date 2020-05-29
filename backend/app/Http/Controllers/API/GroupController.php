<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
