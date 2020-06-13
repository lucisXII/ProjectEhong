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

Route::get('register','API\CheckingSparesController@create');

Route::get('zone','API\ZoneController@index');
Route::get('zone/{id}','API\ZoneController@show');
Route::post('zone/add','API\ZoneController@store');

Route::get('branchs/unCheked','API\BranchController@unCheked');
Route::get('branchs/cheked','API\BranchController@Cheked');
Route::get('branchs/showBranch/{branchID}','API\BranchController@showBranch');

Route::get('conclude/{branchID}','API\ConcludeController@confirm');

Route::get('group','API\GroupController@index');
Route::get('heading','API\HeadingController@index');
Route::get('subheading/{groupID}','API\SubheadingController@showlist');
Route::get('FullscoreGroup/{groupID}','API\SubheadingController@showFullscoreGroup');
Route::get('showheading/{groupID}','API\HeadingController@showHeading');

Route::get('totalcost/{branchID}','API\TotalcostController@showTotalcost');

Route::get('showMotorcycle/{branchID}','API\MotorcycleController@showMotorcycle');
Route::get('showvolumeMotorcycle/{branchID}','API\MotorcycleController@showvolumeMotorcycle');

Route::get('showSpares/{branchID}','API\SparesController@showSpares');
Route::get('showAmountSpares/{branchID}','API\SparesController@showAmountSpares');
Route::get('showNumberSpares/{branchID}','API\SparesController@showNumberSpares');

Route::get('showTool/{branchID}','API\ToolController@showTool');
Route::get('showAmountTool/{branchID}','API\ToolController@showAmountTool');
Route::get('showNumberTool/{branchID}','API\ToolController@showNumberTool');

Route::post('addCost/{id}','API\CostController@store')->middleware('auth:api');
// Route::post('addcost/{tcostID}/costs','API\CostController@store');
Route::get('checkedCost/{branchID}','API\CostController@ChekedCost');
Route::get('alldataChekedCost/{branchID}','API\CostController@alldataChekedCost');

Route::get('chekedMotorcycle/{branchID}','API\CheckingMotorcyclesController@ChekedMotorcycle');
Route::get('alldatachekedMotorcycle/{branchID}','API\CheckingMotorcyclesController@alldataChekedMotorcycle');
Route::get('showvolume/{branchID}','API\CheckingMotorcyclesController@showvolume');
Route::get('showvolumeChekedMotorcycle/{branchID}','API\CheckingMotorcyclesController@showvolumeChekedMotorcycle');
Route::get('outstanding/{branchID}','API\CheckingMotorcyclesController@outstanding');
Route::get('unready/{branchID}','API\CheckingMotorcyclesController@unready');

Route::get('ChekedSpares/{branchID}','API\CheckingSparesController@ChekedSpares');
Route::get('alldataChekedSpares/{branchID}','API\CheckingSparesController@alldataChekedSpares');
Route::get('showAmountSparesremain/{branchID}','API\CheckingSparesController@showAmountSparesremain');
Route::get('showAmountChekedSpares/{branchID}','API\CheckingSparesController@showAmountChekedSpares');
Route::get('showNumberSparesremain/{branchID}','API\CheckingSparesController@showNumberSparesremain');
Route::get('showNumberChekedSpares/{branchID}','API\CheckingSparesController@showNumberChekedSpares');

Route::get('chekedTools/{branchID}','API\CheckingToolController@ChekedTool');

Route::get('ChekedRateAndScore/{branchID}/{groupID}','API\RateAndScoreController@ChekedRateAndScore');
Route::get('alldataChekedTools/{branchID}','API\CheckingToolController@alldataChekedTools');
Route::get('showAmountToolremain/{branchID}','API\CheckingToolController@showAmountToolremain');
Route::get('showAmountChekedTools/{branchID}','API\CheckingToolController@showAmountChekedTools');
Route::get('showNumberToolremain/{branchID}','API\CheckingToolController@showNumberToolremain');
Route::get('showNumberChekedTools/{branchID}','API\CheckingToolController@showNumberChekedTools');

Route::get('showAlldataRates/{branchID}/{groupID}','API\RateAndScoreController@showalldataRates');
Route::get('showRatesFullScore/{branchID}/{groupID}','API\RateAndScoreController@showRatesFullScore');
