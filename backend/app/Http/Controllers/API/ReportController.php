<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Conclude;

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
        for($j=0; $j< count($userID) ;$j++){
            $check = 0;
            $num = count($user);
            for($i=0; $i< $num ;$i++){
                if($userID[$j] != $user[$i]){
                   $check = 1;
                }else{
                    $check = 0;
                }
            }
            if($check == 1){
                array_push($user,$userID[$j]);
             }
        }
        
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
            return "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear เวลา $strHour:$strMinute";    
        }     
    }

    public function ShowBranchExcel()
    {
        $branch= DB::table('branches')
                    ->whereNull('branches.close_date')
                    ->select('branches.br_id','branches.branchName')
                    ->get();
        
        return response()->json($branch, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }

    public function ShowScoreExcel()
    {
        $mounts = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    //->whereMonth('concludes.date', '=', '6')
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

        $array = array();
        for($i=0; $i < count($numMount) ;$i++) {
            $array[$i][0]=$numMount[$i];
        }


        $check = 0;
        $num = $start;
        for($i=$start; $i< 12 ;$i++) {
            $scores = DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    ->whereMonth('concludes.date', '=',  $num)
                    ->select('concludes.score','concludes.br_id')
                    ->orderby('concludes.br_id', 'ASC')
                    ->get();
            
            $branchs= DB::table('branches')
                    ->whereNull('branches.close_date')
                    ->select('branches.br_id')
                    ->get();
            

            if(count($scores) == 1){
                $x = 1;
                foreach ($scores as  $score) {
                    foreach ($branchs as  $branch){
                        if($branch->br_id != $score->br_id){
                               $array[$check][$x]=0;    
                        }else{
                            $array[$check][$x]=$score->score;
                        }
                        $x++;
                    }  
                }
                $check++;
            }else if(count($scores) > 1){
                $x1 = 0;
                foreach ($scores as  $score) {
                    if($x1 == 0){
                        $x = 1;
                        foreach ($branchs as  $branch){
                            if($branch->br_id != $score->br_id){
                                $array[$check][$x]=0;    
                            }else{
                                $array[$check][$x]=$score->score;
                            }
                            $x++;
                        }
                     }
                     else{
                        foreach ($scores as  $score) {
                            $a = 1;
                            foreach ($branchs as  $branch){
                                if($branch->br_id == $score->br_id){
                                    $array[$check][$a]=$score->score;    
                                }
                                $a++;
                            }  
                        }
                    }
                    $x1 = 1;
                }
                $check++;
            }
            $num++;
        } 
        //return $array;   
        return response()->json($array, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);
    }

    public function ShowMonthExcel()
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
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $nameMonth = array();
        $start = 0;
        
        for($i=1; $i<= 12 ;$i++) {
            if(strpos($numMount[0], ''.$i) !== false){
                $start = $i;
            }
        }

        for($i=$start; $i<= 12 ;$i++) {
            array_push($nameMonth,$strMonthCut[$i]);
        } 
        return $nameMonth ;

    }
    
    //สาขา 100 คะแนน
    public function ShowBranchExcel2()
    {
        $branch= DB::table('concludes')
                    ->join('branches','branches.br_id','=','concludes.br_id' )
                    ->whereYear('concludes.date', '=', today()->year)
                    ->select('branches.br_id')
                    ->orderbyDESC('concludes.date')
                    ->get();
        
        return response()->json($branch, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']
        ,JSON_UNESCAPED_UNICODE);

    }
    
}

