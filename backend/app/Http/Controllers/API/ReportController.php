<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Conclude;
use App\Branch;

class ReportController extends Controller
{
    public function ShowHeadReportPDF($branchID)
    {
        $headReport = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->join('zones','zones.zone_id','=','branches.zone_id' )
                    ->join('leaders','leaders.zone_id','=','zones.zone_id' )
                    ->where('concludes.br_id', '=', $branchID)
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->select('branches.branchName','leaders.leaderName')
                    ->get();
        return response()->json($headReport, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowNameUserPDF($branchID)
    {
        $userMotorcycles = DB::table('checking_motorcycles')
                    ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', today()->month)
                    ->select('checking_motorcycles.user_id')
                    ->distinct()
                    ->get();

        $userSpares = DB::table('checking_spares')
                    ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                    ->where('checking_spares.br_id', '=', $branchID)
                    ->whereMonth('checking_spares.date', '=', today()->month)
                    ->select('checking_spares.user_id')
                    ->distinct()
                    ->get();

        $userTools = DB::table('checking_tools')
                    ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', today()->month)
                    ->select('checking_tools.user_id')
                    ->distinct()
                    ->get();

        $userCosts  = DB::table('costs')
                    ->where('costs.br_id', '=', $branchID)
                    ->whereMonth('costs.date', '=', today()->month)
                    ->select('costs.user_id')
                    ->distinct()
                    ->get();

        $userRates = DB::table('rate_and_scores')
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->select('rate_and_scores.user_id')
                    ->distinct()
                    ->get();

        //เพิ่ม user ทั้งหมดลงใน array ตัวเดียวกัน
        $userID=array();
        foreach ($userMotorcycles as  $userMotorcycle){
            array_push($userID,$userMotorcycle->user_id);
        }
        foreach ($userSpares as  $userSpare){
            array_push($userID,$userSpare->user_id);
        }
        foreach ($userTools as  $userTool){
            array_push($userID,$userTool->user_id);
        }
        foreach ($userCosts as  $userCost){
            array_push($userID,$userCost->user_id);
        }
        foreach ($userRates as   $userRate){
            array_push($userID, $userRate->user_id);
        }

        //คัด user ที่ซ้ำกันออก
        $user=array($userID[0]);
        //return $userID[5];
        for($j=0; $j< count($userID) ;$j++){
            $check = 0;
            $num = count($user);
            $num2 = 0;
            for($i=0; $i< $num ;$i++){
                if($userID[$j] != $user[$i]){
                   $check = 1;
                   $num2 = $userID[$j];
                }else{
                    $check = 0;
                }
            }
            if($check == 1){
                $check2 = 0;
                for($k=0; $k< $num ;$k++){
                    if($user[$k] ==  $num2){
                        $check2 = 1;
                    }
                }
                if($check2 == 0){
                    array_push($user,$num2);
                }
             }
        }
        //return $user;
        //เพิ่มชื่อของ user ลงใน array
        $userName=array();
        $names1 = DB::table('users')
                ->where('users.user_id', '=', $user[0])
                ->select('users.name')
                ->get();
        foreach ($names1 as  $name){
            array_push($userName,$name->name);
        }

        for($i=1; $i< count($user) ;$i++){

            $names2 = DB::table('users')
                ->where('users.user_id', '=', $user[$i])
                ->select('users.name')
                ->get();

            foreach ($names2 as  $name){
                $check = 0;
                for($j=0; $j < count($userName) ;$j++){

                    if($name->name != $userName[$j]){
                        $check = 1;
                    }else{
                        $check = 0;
                    }
                }
                if($check == 1){
                    array_push($userName,$name->name);
                }
            }
        }
        //return $userName;
        return response()->json($userName, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    //คะแนนแต่ละหมวดงาน 1-6
    public function ShowScoreGroupPDF($branchID)
    {
        $groupSum = array();
        for($i=1; $i< 7 ;$i++){

            $sum = DB::table('groups')
                    ->join('headings','headings.group_id','=', 'groups.group_id')
                    ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                    ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->where('groups.group_id', '=', $i)
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', today()->month)
                    ->sum('rate_and_scores.score');

            array_push($groupSum,$sum);

        }//return $groupSum;
        return response()->json($groupSum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowScoreSumPDF($branchID)
    {
        $sums = array();
        $sum = DB::table('rate_and_scores')
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', today()->month)
                ->sum('rate_and_scores.score');

        $divide = DB::table('subheadings')
                ->sum('subheadings.score');

        $percent = ($sum*100)/$divide;
        $percent = number_format((float)$percent, 2, '.', '');

        array_push($sums,$sum);
        array_push($sums,$percent);

        return response()->json($sums, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowHeadReportPDFdate($branchID)
    {
        $ReportDate = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->join('zones','zones.zone_id','=','branches.zone_id' )
                    ->join('leaders','leaders.zone_id','=','zones.zone_id' )
                    ->where('concludes.br_id', '=', $branchID)
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->select('concludes.date','branches.branchName','leaders.leaderName')
                    ->get();
        $date = array();

        foreach ($ReportDate as  $ReportDate2 ) {
            //$strDate =  $mount->date;
            $strDay= date("j",strtotime($ReportDate2->date));
            $strMonth= date("่m",strtotime($ReportDate2->date));
            $strYear = date("Y",strtotime($ReportDate2->date))+543;
            $strHour= date("H",strtotime($ReportDate2->date));
            $strMinute= date("i",strtotime($ReportDate2->date));
           $strSeconds= date("s",strtotime($ReportDate2->date));
            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");

            for($i=1; $i<= 12 ;$i++) {
                if(strpos($strMonth, ''.$i) !== false){
                    $strMonthThai = $strMonthCut[$i];
                }
            }
        } //เวลา $strHour:$strMinute
        $date = "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear";
        return response()->json($date , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
        // return "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear เวลา $strHour:$strMinute";
        }
    //}

    // ------------------------ [ Report Excel ] --------------------- ไม่ใช้
    // public function ShowBranchExcel()
    // {
    //     $branch= DB::table('branches')
    //                 ->whereNull('branches.close_date')
    //                 ->select('branches.br_id','branches.branchName')
    //                 ->get();

    //     return response()->json($branch, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
    //     ,JSON_UNESCAPED_UNICODE);

    // }

    // public function ShowScoreExcel()
    // {
    //     $mounts = DB::table('concludes')
    //                 ->join('branches','branches.br_id','=','concludes.br_id' )
    //                 ->whereYear('concludes.date', '=', today()->year)
    //                 //->whereMonth('concludes.date', '=', '6')
    //                 ->select('concludes.date')
    //                 ->orderbyDESC('concludes.date')
    //                 ->get();

    //     $m = array();
    //     foreach ($mounts as  $mount) {
    //         $strDate =  $mount->date;
    //         $strMonth= date("่m",strtotime($strDate));
    //         array_push($m,$strMonth);
    //     }

    //     $zero1 = count($m);
    //     $numMount = array($m[$zero1-1]);
    //     for($j=$zero1-1; $j > -1 ;$j--) {
    //         $check = 0;
    //         for($i=0; $i< count($numMount) ;$i++){

    //             if($numMount[$i] != $m[$j]){
    //                 $check = 1;
    //             }else{
    //                  $check = 0;
    //             }
    //         }
    //         if($check == 1){
    //             array_push($numMount,$m[$j]);
    //         }
    //     }

    //     $zero = count($numMount);
    //     $start = 1;
    //     for($i=1; $i<= 12 ;$i++) {
    //         if(strpos($numMount[0], ''.$i) !== false){
    //             $start = $i;
    //         }
    //     }

    //     $array = array();
    //     for($i=0; $i < count($numMount) ;$i++) {
    //         $array[$i][0]=$numMount[$i];
    //     }


    //     $check = 0;
    //     $num = $start;
    //     for($i=$start; $i<= 12 ;$i++) {
    //         $scores = DB::table('concludes')
    //                 ->join('branches','branches.br_id','=','concludes.br_id' )
    //                 ->whereYear('concludes.date', '=', today()->year)
    //                 ->whereMonth('concludes.date', '=',  $num)
    //                 ->select('concludes.score','concludes.br_id')
    //                 ->orderby('concludes.br_id', 'ASC')
    //                 ->get();

    //         $branchs= DB::table('branches')
    //                 ->whereNull('branches.close_date')
    //                 ->select('branches.br_id')
    //                 ->get();


    //         if(count($scores) == 1){
    //             $x = 1;
    //             foreach ($scores as  $score) {
    //                 foreach ($branchs as  $branch){
    //                     if($branch->br_id != $score->br_id){
    //                            $array[$check][$x]=0;
    //                     }else{
    //                         $array[$check][$x]=$score->score;
    //                     }
    //                     $x++;
    //                 }
    //             }
    //             $check++;
    //         }else if(count($scores) > 1){
    //             $x1 = 0;
    //             foreach ($scores as  $score) {
    //                 if($x1 == 0){
    //                     $x = 1;
    //                     foreach ($branchs as  $branch){
    //                         if($branch->br_id != $score->br_id){
    //                             $array[$check][$x]=0;
    //                         }else{
    //                             $array[$check][$x]=$score->score;
    //                         }
    //                         $x++;
    //                     }
    //                  }
    //                  else{
    //                     foreach ($scores as  $score) {
    //                         $a = 1;
    //                         foreach ($branchs as  $branch){
    //                             if($branch->br_id == $score->br_id){
    //                                 $array[$check][$a]=$score->score;
    //                             }
    //                             $a++;
    //                         }
    //                     }
    //                 }
    //                 $x1 = 1;
    //             }
    //             $check++;
    //         }
    //         $num++;
    //     }
    //     //return $array;
    //     return response()->json($array, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
    //     ,JSON_UNESCAPED_UNICODE);
    // }

    // public function ShowMonthExcel()
    // {
    //     $mounts = DB::table('concludes')
    //             ->join('branches','branches.br_id','=','concludes.br_id' )
    //             ->whereYear('concludes.date', '=', today()->year)
    //             ->select('concludes.date')
    //             ->orderbyDESC('concludes.date')
    //             ->get();

    //     $m = array();
    //     foreach ($mounts as  $mount) {
    //     $strDate =  $mount->date;
    //     $strMonth= date("่m",strtotime($strDate));
    //     array_push($m,$strMonth);
    //     }

    //     $zero1 = count($m);
    //     $numMount = array($m[$zero1-1]);
    //     for($j=$zero1-1; $j > -1 ;$j--) {
    //         $check = 0;
    //         for($i=0; $i< count($numMount) ;$i++){

    //             if($numMount[$i] != $m[$j]){
    //                 $check = 1;
    //             }else{
    //                 $check = 0;
    //             }
    //         }
    //         if($check == 1){
    //             array_push($numMount,$m[$j]);
    //         }
    //     }
    //    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    //     $nameMonth = array();
    //     $start = 0;
    //     $end = 12;
    //     $numend = count($numMount);

    //     for($i=1; $i<= 12 ;$i++) {
    //         if(strpos($numMount[0], ''.$i) !== false){
    //             $start = $i;
    //         }
    //         if(strpos($numMount[$numend-1], ''.$i) !== false){
    //             $end = $i;
    //         }
    //     }
    //     for($i=$start; $i<= $end ;$i++) {
    //         array_push($nameMonth,$strMonthCut[$i]);
    //     }
    //     return $nameMonth ;
    // }

    //----------------- [ Report Excel ]  API ใหม่ -------------
    public function ShowScoreExcelforMonth()
    {
        // $scores = DB::table('concludes')
        //             ->join('branches','branches.br_id','=','concludes.br_id' )
        //             ->whereMonth('concludes.date', '=', today()->month)
        //             ->whereYear('concludes.date', '=', today()->year)
        //             //->whereMonth('concludes.date', '=', '6')
        //             ->select('branches.branchName','concludes.score')
        //             ->orderby('concludes.br_id', 'ASC')
        //             ->get();
        $scores = Conclude::whereMonth('date', today()->month)
                            ->whereYear('date', today()->year)->with('branch')
                            ->get();
        
        $percent = array();
        foreach($scores as $score){
            $num = ($score->score * 100 )/175;
            $num2 = number_format((float)$num, 2, '.', '');
            $score['percent'] = $num2;
            array_push($percent,$score);
        }

        return response()->json($scores, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }
    public function ShowScoreExcelforMonthPercent()
    {
        $scores = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereMonth('concludes.date', '=', today()->month)
                    ->whereYear('concludes.date', '=', today()->year)
                    //->whereMonth('concludes.date', '=', '6')
                    ->select('concludes.score')
                    ->orderby('concludes.br_id', 'ASC')
                    ->get();

        $percent = array();

        foreach($scores as $score){
            $num = ($score->score * 100 )/175;
            array_push($percent,number_format((float)$num, 2, '.', ''));
        }
        
        return response()->json($percent, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    // ------------------------ [Report Excel สาขา 100 คะแนน] --------------------- ไม่ใช้
    // public function ShowBranchExcel100()
    // {
    //     $mounts = DB::table('concludes')
    //                 ->join('branches','branches.br_id','=','concludes.br_id' )
    //                 ->whereYear('concludes.date', '=', today()->year)
    //                 ->select('concludes.date')
    //                 ->orderbyDESC('concludes.date')
    //                 ->get();

    //     $m = array();
    //     foreach ($mounts as  $mount) {
    //         $strDate =  $mount->date;
    //         $strMonth= date("่m",strtotime($strDate));
    //         array_push($m,$strMonth);
    //     }

    //     $zero1 = count($m);
    //     $numMount = array($m[$zero1-1]);
    //     for($j=$zero1-1; $j > -1 ;$j--) {
    //         $check = 0;
    //         for($i=0; $i< count($numMount) ;$i++){

    //             if($numMount[$i] != $m[$j]){
    //                 $check = 1;
    //             }else{
    //                 $check = 0;
    //             }
    //          }
    //         if($check == 1){
    //             array_push($numMount,$m[$j]);
    //         }
    //     }

    //     $zero = count($numMount);
    //     $start = 1;
    //     for($i=1; $i<= 12 ;$i++) {
    //         if(strpos($numMount[0], ''.$i) !== false){
    //             $start = $i;
    //         }
    //     }

    //     $end = 1;
    //     for($i=1; $i<= 12 ;$i++) {
    //         if(strpos($numMount[$zero-1], ''.$i) !== false){
    //             $end = $i;
    //         }
    //     }

    //     $ScoreFull = DB::table('subheadings')->sum('subheadings.score');
    //     $ScoreFull2 = $ScoreFull * $zero ;

    //     $branchs = DB::table('concludes')
    //                 ->join('branches','branches.br_id','=','concludes.br_id' )
    //                 ->whereYear('concludes.date', '=', today()->year)
    //                 ->Where('concludes.score', '=', $ScoreFull)
    //                 ->select('branches.br_id')
    //                 ->orderby('branches.br_id', 'ASC')
    //                 ->distinct()
    //                 ->get();

    //     $array = array();
    //     $x = 0;
    //     foreach($branchs as $branch){
    //         $array[$x][0] = $branch->br_id;
    //         $x++;
    //     }

    //     for($i=0; $i< count($array) ;$i++){
    //         $array[$i][1] = 0;
    //     }

    //     //return $array;
    //     $branchsScore = DB::table('concludes')
    //                 ->join('branches','branches.br_id','=','concludes.br_id' )
    //                 ->whereYear('concludes.date', '=', today()->year)
    //                 ->Where('concludes.score', '=', $ScoreFull)
    //                 ->select('branches.br_id','concludes.score')
    //                 ->orderby('branches.br_id', 'ASC')
    //                 //->distinct()
    //                 ->get();


    //     foreach( $branchsScore as  $branchScore) {
    //         for($i=0; $i< count($array) ;$i++){
    //             if($array[$i][0] == $branchScore->br_id){
    //                 $array[$i][1] = $array[$i][1] + $branchScore->score;
    //             }
    //         }
    //     }
    //     //return $array;
    //     $branchID = array();
    //     $j = 0;
    //     for($i=0; $i< count($array) ;$i++){
    //         if($array[$i][1] == $ScoreFull2){
    //             $branchID[$j][0] = $array[$i][0];
    //             $j++;
    //         }
    //     }


    //     for($i=0; $i< count($branchID) ;$i++){
    //         $branchs2 = DB::table('branches')
    //                     ->where('branches.br_id','=', $branchID[$i][0])
    //                     ->select('branches.branchName')
    //                     ->get();

    //         foreach($branchs2 as $branch2){
    //             $branchID[$i][1] = $branch2->branchName;
    //         }
    //     }
    //    return response()->json($branchID, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
    //     ,JSON_UNESCAPED_UNICODE);

    // }
    // //------------ API เก่า ---------------
    // public function ShowMonthExcel100()
    // {
    //     $mounts = DB::table('concludes')
    //             ->join('branches','branches.br_id','=','concludes.br_id' )
    //             ->whereYear('concludes.date', '=',today()->year)
    //             ->select('concludes.date')
    //             ->orderbyDESC('concludes.date')
    //             ->get();

    //     $m = array();
    //     foreach ($mounts as  $mount) {
    //     $strDate =  $mount->date;
    //     $strMonth= date("่m",strtotime($strDate));
    //     array_push($m,$strMonth);
    //     }

    //     $zero1 = count($m);
    //     $numMount = array($m[$zero1-1]);
    //     for($j=$zero1-1; $j > -1 ;$j--) {
    //         $check = 0;
    //         for($i=0; $i< count($numMount) ;$i++){

    //             if($numMount[$i] != $m[$j]){
    //                 $check = 1;
    //             }else{
    //                 $check = 0;
    //             }
    //         }
    //         if($check == 1){
    //             array_push($numMount,$m[$j]);
    //         }
    //     }
    //     $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    //     $nameMonth = array();
    //     $start = 0;
    //     $end = 12;
    //     $numend = count($numMount);

    //     for($i=1; $i<= 12 ;$i++) {
    //         if(strpos($numMount[0], ''.$i) !== false){
    //             $start = $i;
    //         }
    //         if(strpos($numMount[$numend-1], ''.$i) !== false){
    //             $end = $i;
    //         }
    //     }
    //     for($i=$start; $i<= $end ;$i++) {
    //         array_push($nameMonth,$strMonthCut[$i]);
    //     }
    //     return response()->json($nameMonth, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
    //     ,JSON_UNESCAPED_UNICODE);
    // }

    //------------ [Report Excel สาขา 100 คะแนน] API เพิ่มใหม่ ---------------
    public function ShowMonthExcel100ForYear()
    {
        $mounts = DB::table('concludes')
                ->join('branches','branches.br_id','=','concludes.br_id' )
                ->whereYear('concludes.date', '=',today()->year)
                ->select('concludes.date')
                ->orderbyDESC('concludes.date')
                ->get();

        $m = array();
        foreach ($mounts as  $mount) {
        $strDate =  $mount->date;
        $strMonth= date("่m",strtotime($strDate));
        array_push($m,$strMonth);
        }

        $zero1 = count($m);
        $numMount = array($m[$zero1-1]);
        for($j=$zero1-1; $j > -1 ;$j--) {
            $check = 0;
            for($i=0; $i< count($numMount) ;$i++){

                if($numMount[$i] != $m[$j]){
                    $check = 1;
                }else{
                    $check = 0;
                }
            }
            if($check == 1){
                array_push($numMount,$m[$j]);
            }
        }
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
        $nameMonth = array();
        $start = 0;
        $end = 12;
        $numend = count($numMount);
        $z = 0;
        //if($numend >1){
            for($i=1; $i<= 12 ;$i++) {
                if(strpos($numMount[0], ''.$i) !== false){
                    array_push($nameMonth,$strMonthCut[$i]);
                }
                if(strpos($numMount[$numend-1], ''.$i) !== false){
                    array_push($nameMonth,$strMonthCut[$i]);
                }
            }
        // }else{

        //     array_push($nameMonth,$strMonthCut[12]);

        // }

        // if(count($nameMonth) == 1){
        //     $note = "เริ่มและสิ้นสุด เดือน$nameMonth[0]";
        // }else{
            $z = count($nameMonth)-1;
            $note = "ตั้งแต่ เดือน$nameMonth[0] ถึง เดือน$nameMonth[$z]";
        // }

 
        return response()->json($note, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowBranchExcel100forYear()
    {
        $mounts = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    ->select('concludes.date')
                    ->orderbyDESC('concludes.date')
                    ->get();

        $m = array();
        foreach ($mounts as  $mount) {
            $strDate =  $mount->date;
            $strMonth= date("่m",strtotime($strDate));
            array_push($m,$strMonth);
        }

        $zero1 = count($m);
        $numMount = array($m[$zero1-1]);
        for($j=$zero1-1; $j > -1 ;$j--) {
            $check = 0;
            for($i=0; $i< count($numMount) ;$i++){

                if($numMount[$i] != $m[$j]){
                    $check = 1;
                }else{
                    $check = 0;
                }
             }
            if($check == 1){
                array_push($numMount,$m[$j]);
            }
        }

        $zero = count($numMount);
        $start = 1;
        for($i=1; $i<= 12 ;$i++) {
            if(strpos($numMount[0], ''.$i) !== false){
                $start = $i;
            }
        }

        $end = 1;
        for($i=1; $i<= 12 ;$i++) {
            if(strpos($numMount[$zero-1], ''.$i) !== false){
                $end = $i;
            }
        }

        $ScoreFull = DB::table('subheadings')->sum('subheadings.score');
        $ScoreFull2 = $ScoreFull * $zero ;

        $branchs = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    ->Where('concludes.score', '=', $ScoreFull)
                    ->select('branches.br_id')
                    ->orderby('branches.br_id', 'ASC')
                    ->distinct()
                    ->get();

        $array = array();
        $x = 0;
        foreach($branchs as $branch){
            $array[$x][0] = $branch->br_id;
            $x++;
        }

        for($i=0; $i< count($array) ;$i++){
            $array[$i][1] = 0;
        }

        //return $array;
        $branchsScore = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    ->Where('concludes.score', '=', $ScoreFull)
                    ->select('branches.br_id','concludes.score')
                    ->orderby('branches.br_id', 'ASC')
                    //->distinct()
                    ->get();


        foreach( $branchsScore as  $branchScore) {
            for($i=0; $i< count($array) ;$i++){
                if($array[$i][0] == $branchScore->br_id){
                    $array[$i][1] = $array[$i][1] + $branchScore->score;
                }
            }
        }
        //return $array;
        $branchID = array();
        $j = 0;
        for($i=0; $i< count($array) ;$i++){
            if($array[$i][1] == $ScoreFull2){
                $branchID[$j][0] = $array[$i][0];
                $j++;
            }
        }

        $branchName = array();
        // $first = 0;
        // for($i=0; $i< count($branchID) ;$i++){
        //     $branchs3 = DB::table('branches')
        //                 ->join('zones','zones.zone_id','=','branches.zone_id' )
        //                 ->where('branches.br_id','=', $branchID[$i][0])
        //                 ->select('zones.zoneName')
        //                 ->get();
        //     //return $branchs3;
        //     foreach($branchs3 as $branch3){
        //         $check = 0;
        //         if($first == 0){
        //             $branchName[0][0] = $branch3->zoneName;
        //         }
        //         else{
        //             for($j=0; $j< count($branchName) ;$j++){

        //                 if(strpos($branchName[$j][0],$branch3->zoneName) !== false){
        //                     $check = 1;
        //                 }
        //             }

        //             if($check == 0){
        //                 $branchName[count($branchName)][0] = $branch3->zoneName;
        //             }
        //         }
        //     }
            
        //     $first = 1;
        // }
        //return  $branchName;
        $j = 0;
        for($i=0; $i< count($branchID) ;$i++){
            $branchs2 = DB::table('branches')
                        ->join('zones','zones.zone_id','=','branches.zone_id' )
                        ->where('branches.br_id','=', $branchID[$i][0])
                        ->select('branches.branchName','zones.zoneName')
                        ->get();

            // foreach($branchs2 as $branch2){
            //     $check = 0;
            //     $num = 0;
            //     for($j=0; $j< count($branchName) ;$j++){
            //         if(strpos($branchName[$j][0],$branch2->zoneName) !== false){
            //             $branchName[$j][count($branchName[$j])] = $branch2->branchName;
            //         }
            //     }
            // }

            foreach($branchs2 as $branch2){
                $branchName[$j][0] = $branch2->branchName;
                $branchName[$j][1] = $branch2->zoneName;
                $j++;
            }
        }
       return response()->json( $branchName , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    //----------------------------------------- ดูข้อมูลย้อนหลัง ---------------------------------------------

    //ดูข้อมูลย้อนหลัง รายงาน PDF
    public function ShowHeadReportPDFOld($branchID,$month,$year)
    {
        $headReport = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->join('zones','zones.zone_id','=','branches.zone_id' )
                    ->join('leaders','leaders.zone_id','=','zones.zone_id' )
                    ->where('concludes.br_id', '=', $branchID)
                    ->whereMonth('concludes.date', '=', $month)
                    ->whereYear('concludes.date', '=', $year)
                    ->select('branches.branchName','leaders.leaderName')
                    ->get();
        return response()->json($headReport, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowNameUserPDFOld($branchID,$month,$year)
    {
        $userMotorcycles = DB::table('checking_motorcycles')
                    ->join('motorcycles','motorcycles.m_id','=', 'checking_motorcycles.m_id')
                    ->where('checking_motorcycles.br_id', '=', $branchID)
                    ->whereMonth('checking_motorcycles.date', '=', $month)
                    ->whereYear('checking_motorcycles.date', '=', $year)
                    ->select('checking_motorcycles.user_id')
                    ->distinct()
                    ->get();

        $userSpares = DB::table('checking_spares')
                    ->join('spares','spares.s_id','=', 'checking_spares.s_id')
                    ->where('checking_spares.br_id', '=', $branchID)
                    ->whereMonth('checking_spares.date', '=', $month)
                    ->whereYear('checking_spares.date', '=', $year)
                    ->select('checking_spares.user_id')
                    ->distinct()
                    ->get();

        $userTools = DB::table('checking_tools')
                    ->join('tools','tools.tool_id','=', 'checking_tools.tool_id')
                    ->where('checking_tools.br_id', '=', $branchID)
                    ->whereMonth('checking_tools.date', '=', $month)
                    ->whereYear('checking_tools.date', '=', $year)
                    ->select('checking_tools.user_id')
                    ->distinct()
                    ->get();

        $userCosts  = DB::table('costs')
                    ->where('costs.br_id', '=', $branchID)
                    ->whereMonth('costs.date', '=', $month)
                    ->whereYear('costs.date', '=', $year)
                    ->select('costs.user_id')
                    ->distinct()
                    ->get();

        $userRates = DB::table('rate_and_scores')
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', $month)
                    ->whereYear('rate_and_scores.date', '=', $year)
                    ->select('rate_and_scores.user_id')
                    ->distinct()
                    ->get();

        //เพิ่ม user ทั้งหมดลงใน array ตัวเดียวกัน
        $userID=array();
        foreach ($userMotorcycles as  $userMotorcycle){
            array_push($userID,$userMotorcycle->user_id);
        }
        foreach ($userSpares as  $userSpare){
            array_push($userID,$userSpare->user_id);
        }
        foreach ($userTools as  $userTool){
            array_push($userID,$userTool->user_id);
        }
        foreach ($userCosts as  $userCost){
            array_push($userID,$userCost->user_id);
        }
        foreach ($userRates as   $userRate){
            array_push($userID, $userRate->user_id);
        }

        //คัด user ที่ซ้ำกันออก
        $user=array($userID[0]);
        //return $userID[5];
        for($j=0; $j< count($userID) ;$j++){
            $check = 0;
            $num = count($user);
            $num2 = 0;
            for($i=0; $i< $num ;$i++){
                if($userID[$j] != $user[$i]){
                   $check = 1;
                   $num2 = $userID[$j];
                }else{
                    $check = 0;
                }
            }
            if($check == 1){
                $check2 = 0;
                for($k=0; $k< $num ;$k++){
                    if($user[$k] ==  $num2){
                        $check2 = 1;
                    }
                }
                if($check2 == 0){
                    array_push($user,$num2);
                }
             }
        }
        //return $user;
        //เพิ่มชื่อของ user ลงใน array
        $userName=array();
        $names1 = DB::table('users')
                ->where('users.user_id', '=', $user[0])
                ->select('users.name')
                ->get();
        foreach ($names1 as  $name){
            array_push($userName,$name->name);
        }

        for($i=1; $i< count($user) ;$i++){

            $names2 = DB::table('users')
                ->where('users.user_id', '=', $user[$i])
                ->select('users.name')
                ->get();

            foreach ($names2 as  $name){
                $check = 0;
                for($j=0; $j < count($userName) ;$j++){

                    if($name->name != $userName[$j]){
                        $check = 1;
                    }else{
                        $check = 0;
                    }
                }
                if($check == 1){
                    array_push($userName,$name->name);
                }
            }
        }
        //return $userName;
        return response()->json($userName, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    //คะแนนแต่ละหมวดงาน 1-6
    public function ShowScoreGroupPDFOld($branchID,$month,$year)
    {
        $groupSum = array();
        for($i=1; $i< 7 ;$i++){

            $sum = DB::table('groups')
                    ->join('headings','headings.group_id','=', 'groups.group_id')
                    ->join('subheadings','subheadings.hd_id','=', 'headings.hd_id')
                    ->join('rate_and_scores','rate_and_scores.sh_id','=','subheadings.sh_id' )
                    ->where('groups.group_id', '=', $i)
                    ->where('rate_and_scores.br_id', '=', $branchID)
                    ->whereMonth('rate_and_scores.date', '=', $month)
                    ->whereYear('rate_and_scores.date', '=', $year)
                    ->sum('rate_and_scores.score');

            array_push($groupSum,$sum);

        }//return $groupSum;
        return response()->json($groupSum, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowScoreSumPDFOld($branchID,$month,$year)
    {
        $sums = array();
        $sum = DB::table('rate_and_scores')
                ->where('rate_and_scores.br_id', '=', $branchID)
                ->whereMonth('rate_and_scores.date', '=', $month)
                ->whereYear('rate_and_scores.date', '=', $year)
                ->sum('rate_and_scores.score');

        $divide = DB::table('subheadings')
                ->sum('subheadings.score');

        $percent = ($sum*100)/$divide;
        $percent = number_format((float)$percent, 2, '.', '');

        array_push($sums,$sum);
        array_push($sums,$percent);

        return response()->json($sums, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowHeadReportPDFdateOld($branchID,$month,$year)
    {
        $ReportDate = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->join('zones','zones.zone_id','=','branches.zone_id' )
                    ->join('leaders','leaders.zone_id','=','zones.zone_id' )
                    ->where('concludes.br_id', '=', $branchID)
                    ->whereMonth('concludes.date', '=', $month)
                    ->whereYear('concludes.date', '=', $year)
                    ->select('concludes.date','branches.branchName','leaders.leaderName')
                    ->get();
        $date = array();

        foreach ($ReportDate as  $ReportDate2 ) {
            //$strDate =  $mount->date;
            $strDay= date("j",strtotime($ReportDate2->date));
            $strMonth= date("่m",strtotime($ReportDate2->date));
            $strYear = date("Y",strtotime($ReportDate2->date))+543;
            $strHour= date("H",strtotime($ReportDate2->date));
            $strMinute= date("i",strtotime($ReportDate2->date));
            $strSeconds= date("s",strtotime($ReportDate2->date));
            $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");

            for($i=1; $i<= 12 ;$i++) {
                if(strpos($strMonth, ''.$i) !== false){
                    $strMonthThai = $strMonthCut[$i];
                }
            }//เวลา $strHour:$strMinute
            $date = "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear ";
            return response()->json($date , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
            ,JSON_UNESCAPED_UNICODE);
        }
    }
     //----------------- [ Report Excel ]  API ใหม่ -------------
     public function ShowScoreExcelforMonthOld($month,$year)
     {
        $scores = Conclude::whereMonth('date', $month)
                        ->whereYear('date', $year)->with('branch')
                        ->get();

        $percent = array();
        foreach($scores as $score){
            $num = ($score->score * 100 )/175;
            $num2 = number_format((float)$num, 2, '.', '');
            $score['percent'] = $num2;
            array_push($percent,$score);
        }
 
         return response()->json($scores, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
         ,JSON_UNESCAPED_UNICODE);
     }

     public function ShowScoreExcelforMonthPercentOld($month,$year)
     {
         $scores = DB::table('concludes')
                     ->join('branches','branches.br_id','=','concludes.br_id' )
                     ->whereMonth('concludes.date', '=', $month)
                     ->whereYear('concludes.date', '=', $year)
                     //->whereMonth('concludes.date', '=', '6')
                     ->select('concludes.score')
                     ->orderby('concludes.br_id', 'ASC')
                     ->get();
 
         $percent = array();
 
         foreach($scores as $score){
             $num = ($score->score * 100 )/175;
             array_push($percent,number_format((float)$num, 2, '.', ''));
         }
         
         return response()->json($percent, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
         ,JSON_UNESCAPED_UNICODE);
     }
 

    //------------ [Report Excel สาขา 100 คะแนน] API เพิ่มใหม่ ---------------
    public function ShowMonthExcel100ForYearOld($year)
    {
        $mounts = DB::table('concludes')
                ->join('branches','branches.br_id','=','concludes.br_id' )
                ->whereYear('concludes.date', '=',$year)
                ->select('concludes.date')
                ->orderbyDESC('concludes.date')
                ->get();

        $m = array();
        foreach ($mounts as  $mount) {
        $strDate =  $mount->date;
        $strMonth= date("่m",strtotime($strDate));
        array_push($m,$strMonth);
        }

        $zero1 = count($m);
        $numMount = array($m[$zero1-1]);
        for($j=$zero1-1; $j > -1 ;$j--) {
            $check = 0;
            for($i=0; $i< count($numMount) ;$i++){

                if($numMount[$i] != $m[$j]){
                    $check = 1;
                }else{
                    $check = 0;
                }
            }
            if($check == 1){
                array_push($numMount,$m[$j]);
            }
        }
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
        $nameMonth = array();
        $start = 0;
        $end = 12;
        $numend = count($numMount);
        $z = 0;
        //if($numend >1){
            for($i=1; $i<= 12 ;$i++) {
                if(strpos($numMount[0], ''.$i) !== false){
                    array_push($nameMonth,$strMonthCut[$i]);
                }
                if(strpos($numMount[$numend-1], ''.$i) !== false){
                    array_push($nameMonth,$strMonthCut[$i]);
                }
            }
        // }else{

        //     array_push($nameMonth,$strMonthCut[12]);

        // }

        // if(count($nameMonth) == 1){
        //     $note = "เริ่มและสิ้นสุด เดือน$nameMonth[0]";
        // }else{
            $z = count($nameMonth)-1;
            $note = "ตั้งแต่ เดือน$nameMonth[0] ถึง เดือน$nameMonth[$z]";
        // }

 
        return response()->json($note, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowBranchExcel100forYearOld($year)
    {
        $mounts = DB::table('concludes')
        ->join('branches','branches.br_id','=','concludes.br_id' )
        ->whereYear('concludes.date', '=', $year)
        ->select('concludes.date')
        ->orderbyDESC('concludes.date')
        ->get();

        $m = array();
        foreach ($mounts as  $mount) {
        $strDate =  $mount->date;
        $strMonth= date("่m",strtotime($strDate));
        array_push($m,$strMonth);
        }

        $zero1 = count($m);
        $numMount = array($m[$zero1-1]);
        for($j=$zero1-1; $j > -1 ;$j--) {
        $check = 0;
        for($i=0; $i< count($numMount) ;$i++){

            if($numMount[$i] != $m[$j]){
                $check = 1;
            }else{
                $check = 0;
            }
        }
        if($check == 1){
            array_push($numMount,$m[$j]);
        }
        }

        $zero = count($numMount);
        $start = 1;
        for($i=1; $i<= 12 ;$i++) {
        if(strpos($numMount[0], ''.$i) !== false){
            $start = $i;
        }
        }

        $end = 1;
        for($i=1; $i<= 12 ;$i++) {
        if(strpos($numMount[$zero-1], ''.$i) !== false){
            $end = $i;
        }
        }

        $ScoreFull = DB::table('subheadings')->sum('subheadings.score');
        $ScoreFull2 = $ScoreFull * $zero ;

        $branchs = DB::table('concludes')
                ->join('branches','branches.br_id','=','concludes.br_id' )
                ->whereYear('concludes.date', '=', $year)
                ->Where('concludes.score', '=', $ScoreFull)
                ->select('branches.br_id')
                ->orderby('branches.br_id', 'ASC')
                ->distinct()
                ->get();

        $array = array();
        $x = 0;
        foreach($branchs as $branch){
        $array[$x][0] = $branch->br_id;
        $x++;
        }

        for($i=0; $i< count($array) ;$i++){
        $array[$i][1] = 0;
        }

        $branchsScore = DB::table('concludes')
                ->join('branches','branches.br_id','=','concludes.br_id' )
                ->whereYear('concludes.date', '=', $year)
                ->Where('concludes.score', '=', $ScoreFull)
                ->select('branches.br_id','concludes.score')
                ->orderby('branches.br_id', 'ASC')
                //->distinct()
                ->get();


        foreach( $branchsScore as  $branchScore) {
        for($i=0; $i< count($array) ;$i++){
            if($array[$i][0] == $branchScore->br_id){
                $array[$i][1] = $array[$i][1] + $branchScore->score;
            }
        }
        }

        $branchID = array();
        $j = 0;
        for($i=0; $i< count($array) ;$i++){
        if($array[$i][1] == $ScoreFull2){
            $branchID[$j][0] = $array[$i][0];
            $j++;
        }
        }

        $branchName = array();
        $j = 0;
        for($i=0; $i< count($branchID) ;$i++){
        $branchs2 = DB::table('branches')
                    ->join('zones','zones.zone_id','=','branches.zone_id' )
                    ->where('branches.br_id','=', $branchID[$i][0])
                    ->select('branches.branchName','zones.zoneName')
                    ->get();

        foreach($branchs2 as $branch2){
            $branchName[$j][0] = $branch2->branchName;
            $branchName[$j][1] = $branch2->zoneName;
            $j++;
        }
        }
        return response()->json( $branchName , 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

}

