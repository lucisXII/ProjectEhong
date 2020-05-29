<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Zone;

class ZoneController extends Controller
{
    public function index()
    {
         $zones = Zone::all();
         return response()->json($zones, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
         //return response()->json($zones);
        //return $this->showAllTransform("load data banks successfully" , $zones , 200);
    }

}
