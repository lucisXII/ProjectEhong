<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('zone','API\ZoneController@index');

Route::get('branchs/unCheked','API\BranchController@unCheked');
Route::get('branchs/Cheked','API\BranchController@Cheked');
Route::get('branchs/showBranch/{branchID}','API\BranchController@showBranch');

Route::get('conclude/{branchID}','API\ConcludeController@confirm');

Route::get('group','API\GroupController@index');
Route::get('heading','API\HeadingController@index');
Route::get('subheading/{groupID}','API\SubheadingController@showlist');

Route::get('totalcost/{branchID}','API\TotalcostController@showTotalcost');

Route::get('showMotorcycle/{branchID}','API\MotorcycleController@showMotorcycle');
Route::get('showvolumeMotorcycle/{branchID}','API\MotorcycleController@showvolumeMotorcycle');

Route::get('showSpares/{branchID}','API\SparesController@showSpares');
Route::get('showAmountSpares/{branchID}','API\SparesController@showAmountSpares');
Route::get('showNumberSpares/{branchID}','API\SparesController@showNumberSpares');

Route::get('showTool/{branchID}','API\ToolController@showTool');
Route::get('showAmountTool/{branchID}','API\ToolController@showAmountTool');
Route::get('showNumberTool/{branchID}','API\ToolController@showNumberTool');

Route::post('addcost/{tcostID}/costs','API\CostController@store');
Route::get('checkedCost/{branchID}','API\CostController@ChekedCost');

Route::get('chekedMotorcycle/{branchID}','API\CheckingMotorcyclesController@ChekedMotorcycle');

Route::get('ChekedSpares/{branchID}','API\CheckingSparesController@ChekedSpares');

Route::get('ChekedTool/{branchID}','API\CheckingToolController@ChekedTool');

Route::get('ChekedRateAndScore/{branchID}/{groupID}','API\RateAndScoreController@ChekedRateAndScore');