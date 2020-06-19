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

Route::get('branchs/branchlist','API\BranchController@index');
Route::get('branchs/unCheked','API\BranchController@unCheked');
Route::get('branchs/cheked','API\BranchController@Cheked');
Route::get('branchs/showBranch/{branchID}','API\BranchController@showBranch');

Route::get('conclude/{branchID}','API\ConcludeController@confirm');
Route::post('addconclude','API\ConcludeController@store');

Route::get('group','API\GroupController@index');
Route::get('heading','API\HeadingController@index');
Route::get('subheading/{groupID}','API\SubheadingController@showlist');
Route::get('FullscoreGroup/{groupID}','API\SubheadingController@showFullscoreGroup');
Route::get('showheading/{groupID}','API\HeadingController@showHeading');
Route::get('showrate/{groupID}','API\HeadingController@showRateAndScore');

Route::get('alldataCheckedHeading/{groupID}','API\HeadingController@rateAndScore');

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
Route::patch('updateCost/{id}','API\CostController@update')->middleware('auth:api');
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
//เพิ่ม insert,update Motorcycles
Route::post('addCheckingMotorcycles','API\CheckingMotorcyclesController@store')->middleware('auth:api');
Route::patch('updateCheckingMotorcycles','API\CheckingMotorcyclesController@update')->middleware('auth:api');

Route::get('ChekedSpares/{branchID}','API\CheckingSparesController@ChekedSpares');
Route::get('alldataChekedSpares/{branchID}','API\CheckingSparesController@alldataChekedSpares');
Route::get('showAmountSparesremain/{branchID}','API\CheckingSparesController@showAmountSparesremain');
Route::get('showAmountChekedSpares/{branchID}','API\CheckingSparesController@showAmountChekedSpares');
Route::get('showNumberSparesremain/{branchID}','API\CheckingSparesController@showNumberSparesremain');
Route::get('showNumberChekedSpares/{branchID}','API\CheckingSparesController@showNumberChekedSpares');
//เพิ่ม insert,update Spares
Route::post('addCheckingSpares','API\CheckingSparesController@store')->middleware('auth:api');
Route::patch('updateCheckingSpares','API\CheckingSparesController@update')->middleware('auth:api');

Route::get('chekedTools/{branchID}','API\CheckingToolController@ChekedTool');
Route::get('alldataChekedTools/{branchID}','API\CheckingToolController@alldataChekedTools');
Route::get('showAmountToolremain/{branchID}','API\CheckingToolController@showAmountToolremain');
Route::get('showAmountChekedTools/{branchID}','API\CheckingToolController@showAmountChekedTools');
Route::get('showNumberToolremain/{branchID}','API\CheckingToolController@showNumberToolremain');
Route::get('showNumberChekedTools/{branchID}','API\CheckingToolController@showNumberChekedTools');
//เพิ่ม insert,update Tool
Route::post('addCheckingTool','API\CheckingToolController@store')->middleware('auth:api');
Route::patch('updateCheckingTool','API\CheckingToolController@update')->middleware('auth:api');

Route::get('ChekedRateAndScore/{branchID}/{groupID}','API\RateAndScoreController@ChekedRateAndScore');
Route::get('ChekedRateAndScoreLast/{branchID}','API\RateAndScoreController@ChekedRateAndScoreLast');
Route::get('showAlldataRates/{branchID}/{groupID}','API\RateAndScoreController@showalldataRates');
Route::get('showRatesFullScore/{branchID}/{groupID}','API\RateAndScoreController@showRatesFullScore');
Route::get('showGroupChecked/{branchID}','API\RateAndScoreController@showGroupChecked');
//เพิ่ม insert,update RateAndScore
Route::post('addRateAndScore/{id}','API\RateAndScoreController@store')->middleware('auth:api');
Route::patch('updateRateAndScore/{id}','API\RateAndScoreController@update')->middleware('auth:api');

Route::get('ShowHeadReportPDF/{branchID}','API\ReportController@ShowHeadReportPDF');
Route::get('ShowHeadReportPDFdate/{branchID}','API\ReportController@ShowHeadReportPDFdate');
Route::get('ShowUserPDF/{branchID}','API\ReportController@ShowNameUserPDF');
Route::get('ShowScoreGroupPDF/{branchID}','API\ReportController@ShowScoreGroupPDF');
Route::get('ShowScoreSumPDF/{branchID}','API\ReportController@ShowScoreSumPDF');

// Route::get('ShowBranchExcel','API\ReportController@ShowBranchExcel');
// Route::get('ShowScoreExcel','API\ReportController@ShowScoreExcel');
// Route::get('ShowMonthExcel','API\ReportController@ShowMonthExcel');
Route::get('ShowScoreExcelforMonth','API\ReportController@ShowScoreExcelforMonth');
Route::get('ShowScoreExcelforMonthPercent','API\ReportController@ShowScoreExcelforMonthPercent');

// Route::get('ShowBranchExcel100','API\ReportController@ShowBranchExcel100');
// Route::get('ShowMonthExcel100','API\ReportController@ShowMonthExcel100');
Route::get('ShowMonthExcel100ForYear','API\ReportController@ShowMonthExcel100ForYear');
Route::get('ShowBranchExcel100ForYear','API\ReportController@ShowBranchExcel100ForYear');

//-------------------- [ดูข้อมูลย้อนหลัง] ------------------------
// Route::get('branchs/Search/result/{year}/{month}','API\BranchController@search');
Route::post('branchs/search','API\BranchController@search');
Route::get('branchs/search/result','API\BranchController@result');

//แสดงข้อมูลสาขาย้อนหลัง -> มอเตอร์ไซต์
Route::get('watchAlldataChekedMotorcycle/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchAlldataChekedMotorcycle');
Route::get('watchShowvolume/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchShowvolume');
Route::get('watchShowvolumeChekedMotorcycle/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchShowvolumeChekedMotorcycle');
Route::get('watchOutstanding/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchOutstanding');
Route::get('watchUnready/{branchID}/{month}/{year}','API\CheckingMotorcyclesController@watchUnready');
//แสดงข้อมูลสาขาย้อนหลัง -> อะไหล่
Route::get('alldataChekedSparesOld/{branchID}/{month}/{year}','API\CheckingSparesController@alldataChekedSparesOld');
Route::get('showAmountSparesremainOld/{branchID}/{month}/{year}','API\CheckingSparesController@showAmountSparesremainOld');
Route::get('showAmountChekedSparesOld/{branchID}/{month}/{year}','API\CheckingSparesController@showAmountChekedSparesOld');
Route::get('showNumberSparesremainOld/{branchID}/{month}/{year}','API\CheckingSparesController@showNumberSparesremainOld');
Route::get('showNumberChekedSparesOld/{branchID}/{month}/{year}','API\CheckingSparesController@showNumberChekedSparesOld');
//แสดงข้อมูลสาขาย้อนหลัง -> เครื่องมือ
Route::get('alldataChekedToolsOld/{branchID}/{month}/{year}','API\CheckingToolController@alldataChekedToolsOld');
Route::get('showAmountToolremainOld/{branchID}/{month}/{year}','API\CheckingToolController@showAmountToolremainOld');
Route::get('showAmountChekedToolsOld/{branchID}/{month}/{year}','API\CheckingToolController@showAmountChekedToolsOld');
Route::get('showNumberToolremainOld/{branchID}/{month}/{year}','API\CheckingToolController@showNumberToolremainOld');
Route::get('showNumberChekedToolsOld/{branchID}/{month}/{year}','API\CheckingToolController@showNumberChekedToolsOld');
//แสดงข้อมูลรายการคะแนนที่ตรวจ
Route::get('showAlldataRatesOld/{branchID}/{groupID}/{month}/{year}','API\RateAndScoreController@showalldataRatesOld');
Route::get('showRatesFullScoreOld/{branchID}/{groupID}/{month}/{year}','API\RateAndScoreController@showRatesFullScoreOld');
//แสดงรายการชำระค่างวดย้อนหลัง
Route::get('alldataChekedCostOld/{branchID}/{month}/{year}','API\CostController@alldataChekedCostOld');
Route::get('showAgreement/{branchID}/{month}/{year}','API\CostController@showAgreementOld');
//แสดงรายงาน PDF ย้อนหลัง
Route::get('ShowHeadReportPDFOld/{branchID}/{month}/{year}','API\ReportController@ShowHeadReportPDFOld');
Route::get('ShowHeadReportPDFdateOld/{branchID}/{month}/{year}','API\ReportController@ShowHeadReportPDFdateOld');
Route::get('ShowUserPDFOld/{branchID}/{month}/{year}','API\ReportController@ShowNameUserPDFOld');
Route::get('ShowScoreGroupPDFOld/{branchID}/{month}/{year}','API\ReportController@ShowScoreGroupPDFOld');
Route::get('ShowScoreSumPDFOld/{branchID}/{month}/{year}','API\ReportController@ShowScoreSumPDFOld');
Route::get('showAgreementOld/{branchID}/{month}/{year}','API\CostController@showAgreementOld');
//แสดงรายงาน Excel ย้อนหลัง
Route::get('ShowScoreExcelforMonthOld/{month}/{year}','API\ReportController@ShowScoreExcelforMonthOld');
Route::get('ShowScoreExcelforMonthPercentOld/{month}/{year}','API\ReportController@ShowScoreExcelforMonthPercentOld');
//แสดงรายงาน Excel 100% ย้อนหลัง
Route::get('ShowMonthExcel100ForYearOld/{year}','API\ReportController@ShowMonthExcel100ForYearOld');
Route::get('ShowBranchExcel100forYearOld/{year}','API\ReportController@ShowBranchExcel100forYearOld');

Route::get('logout', 'API\BranchController@logout')->middleware('auth:api');
