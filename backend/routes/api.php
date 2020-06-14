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

Route::post('register','API\CheckingSparesController@create');

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

Route::get('showTools/{branchID}','API\ToolController@showTool');
Route::get('showAmountTool/{branchID}','API\ToolController@showAmountTool');
Route::get('showNumberTool/{branchID}','API\ToolController@showNumberTool');

Route::post('addCost/{id}','API\CostController@store')->middleware('auth:api');
Route::patch('updateCost/{id}','API\CostController@update');
// Route::post('addcost/{tcostID}/costs','API\CostController@store');
Route::get('checkedCost/{branchID}','API\CostController@ChekedCost');
Route::get('alldataChekedCost/{branchID}','API\CostController@alldataChekedCost');
//API เพิ่ม 13/06
Route::get('showAgreement/{branchID}','API\CostController@showAgreement');

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

Route::get('ShowHeadReportPDF/{branchID}','API\ReportController@ShowHeadReportPDF');
Route::get('ShowHeadReportPDFdate/{branchID}','API\ReportController@ShowHeadReportPDFdate');
Route::get('ShowUserPDF/{branchID}','API\ReportController@ShowNameUserPDF');
Route::get('ShowScoreGroupPDF/{branchID}','API\ReportController@ShowScoreGroupPDF');
Route::get('ShowScoreSumPDF/{branchID}','API\ReportController@ShowScoreSumPDF');
Route::get('ShowBranchExcel','API\ReportController@ShowBranchExcel');
Route::get('ShowScoreExcel','API\ReportController@ShowScoreExcel');
Route::get('ShowMonthExcel','API\ReportController@ShowMonthExcel');

//ดูข้อมูลย้อนหลัง
Route::get('branchs/Search/result/{year}/{month}','API\BranchController@search');
//แสดงข้อมูลสาขาย้อนหลัง -> มอเตอร์ไซต์
Route::get('watchAlldataChekedMotorcycle/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchAlldataChekedMotorcycle');
Route::get('watchShowvolume/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchShowvolume');
Route::get('watchShowvolumeChekedMotorcycle/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchShowvolumeChekedMotorcycle');
Route::get('watchOutstanding/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchOutstanding');
Route::get('watchUnready/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchUnready');
//แสดงข้อมูลสาขาย้อนหลัง -> อะไหล่
