<?php
    $gender = $_POST['gender2'];
    $precondition = $_POST['precondition1'];
    $age = $_POST['age2'];
    $state = $_POST['state2'];
$dbServername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname ="statewise";
$conn = mysqli_connect($dbServername, $dbuser, $dbpass, $dbname) or die("Connection failed:". $conn -> error);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

       
    $sql="SELECT age_group, cases, deaths, PreConditionDeaths FROM covid_data WHERE state='$state' and gender='$gender'";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if (mysqli_num_rows($result)> 0) {
       while($row = mysqli_fetch_assoc($result)){
       $datas[] = $row;
       }
    }
    $total_cases = $datas[0]['cases']+$datas[1]['cases']+$datas[2]['cases']+$datas[3]['cases']+$datas[4]['cases']+$datas[5]['cases']+$datas[6]['cases'];    
    $withoutpre_deaths = $datas[0]['deaths']+$datas[1]['deaths']+$datas[2]['deaths']+$datas[3]['deaths']+$datas[4]['deaths']+$datas[5]['deaths']+$datas[6]['deaths'];
    $total_deaths= $datas[0]['PreConditionDeaths']+$datas[1]['PreConditionDeaths']+$datas[2]['PreConditionDeaths']+$datas[3]['PreConditionDeaths']+$datas[4]['PreConditionDeaths']+$datas[5]['PreConditionDeaths']+$datas[6]['PreConditionDeaths'];
    $frac_pre_deaths = $withoutpre_deaths/$total_deaths;
    $frac_PreCondition_Deaths = 1-$frac_pre_deaths;
    $age_group0 = $datas[0]['cases'];
    $age_group1 = $datas[1]['cases'];
    $age_group2 = $datas[2]['cases'];
    $age_group3 = $datas[3]['cases'];
    $age_group4 = $datas[4]['cases'];
    $age_group5 = $datas[5]['cases'];
    $age_group6 = $datas[6]['cases'];
    $p0 = $age_group0/$total_cases;
    $p1 = $age_group1/$total_cases;
    $p2 = $age_group2/$total_cases;
    $p3 = $age_group3/$total_cases;
    $p4 = $age_group4/$total_cases;
    $p5 = $age_group5/$total_cases;
    $p6 = $age_group6/$total_cases;
    $deaths0 = $datas[0]['deaths'];
    $deaths1 = $datas[1]['deaths'];
    $deaths2 = $datas[2]['deaths'];
    $deaths3 = $datas[3]['deaths'];
    $deaths4 = $datas[4]['deaths'];
    $deaths5 = $datas[5]['deaths'];
    $deaths6 = $datas[6]['deaths'];
    $nopre_total= $deaths0 + $deaths1 + $deaths2 + $deaths3 + $deaths4 + $deaths5 + $deaths6;
    $total0 = $datas[0]['PreConditionDeaths'];
    $total1 = $datas[1]['PreConditionDeaths'];
    $total2 = $datas[2]['PreConditionDeaths'];
    $total3 = $datas[3]['PreConditionDeaths'];
    $total4 = $datas[4]['PreConditionDeaths'];
    $total5 = $datas[5]['PreConditionDeaths'];
    $total6 = $datas[6]['PreConditionDeaths'];
    $total = $total0 + $total1 + $total2 + $total3 + $total4 + $total5 + $total6;
    $predeaths0 = $total0 - $deaths0;
    $predeaths1 = $total1 - $deaths1;
    $predeaths2 = $total2 - $deaths2;
    $predeaths3 = $total3 - $deaths3;
    $predeaths4 = $total4 - $deaths4;
    $predeaths5 = $total5 - $deaths5;
    $predeaths6 = $total6 - $deaths6;
    $total_predeaths = $predeaths0 + $predeaths1 + $predeaths2 + $predeaths3 + $predeaths4 + $predeaths5 + $predeaths6;
    $msql="SELECT cases, PreConditionDeaths FROM covid_data WHERE state='$state' and gender='Male'";
    $result1 = mysqli_query($conn, $msql);
    $value = array();
    if (mysqli_num_rows($result1) > 0) {
       while($row = mysqli_fetch_assoc($result1)){
       $value[] = $row;
       }
    }
    $total_malecases = $value[0]['cases']+ $value[1]['cases']+ $value[2]['cases']+ $value[3]['cases']+ $value[4]['cases']+ $value[5]['cases']+ $value[6]['cases']; 
    $total_maledeaths = $value[0]['PreConditionDeaths']+ $value[1]['PreConditionDeaths']+ $value[2]['PreConditionDeaths']+ $value[3]['PreConditionDeaths']+ $value[4]['PreConditionDeaths']+ $value[5]['PreConditionDeaths']+ $value[6]['PreConditionDeaths'];
    $fsql="SELECT cases, PreConditionDeaths FROM covid_data WHERE state='$state' and gender='Female'";
    $result2 = mysqli_query($conn, $fsql);
    $fvalue = array();
    if (mysqli_num_rows($result2) > 0) {
       while($row = mysqli_fetch_assoc($result2)){
       $fvalue[] = $row;
       }
    }
    $total_femalecases = $fvalue[0]['cases']+ $fvalue[1]['cases']+ $fvalue[2]['cases']+ $fvalue[3]['cases']+ $fvalue[4]['cases']+ $fvalue[5]['cases']+ $fvalue[6]['cases']; 
    $total_femaledeaths = $fvalue[0]['PreConditionDeaths']+ $fvalue[1]['PreConditionDeaths']+ $fvalue[2]['PreConditionDeaths']+ $fvalue[3]['PreConditionDeaths']+ $fvalue[4]['PreConditionDeaths']+ $fvalue[5]['PreConditionDeaths']+ $fvalue[6]['PreConditionDeaths'];
    $total_case = $total_malecases + $total_femalecases;
    $total_death = $total_maledeaths +  $total_femaledeaths;
    $probability_malecases = $total_malecases/$total_case;     
    $probability_maledeaths = $total_maledeaths/$total_death;
    $probability_femalecases = $total_femalecases/$total_case;
    $probability_femaledeaths = $total_femaledeaths/$total_death;
    if($gender=="male")
        {
        $gender_totalcases = $total_malecases;
        $gender_totaldeaths = $total_maledeaths;
        $vi_gender = $probability_malecases;
        $si_gender = $probability_maledeaths;
        }else{
            $gender_totalcases = $total_femalecases;
            $gender_totaldeaths = $total_femaledeaths;
            $vi_gender = $probability_femalecases;
            $si_gender = $probability_femaledeaths;
 
        }

    if(($p0>$p1)&&($p0>$p2)&&($p0>$p3)&&($p0>$p4)&&($p0>$p5)&&($p0>$p6)){
        $pmax = $p0;
    }else if(($p1>$p0)&&($p1>$p2)&&($p1>$p3)&&($p1>$p4)&&($p1>$p5)&&($p1>$p6)){
        $pmax= $p1;
    }else if(($p2>$p0)&&($p2>$p1)&&($p2>$p3)&&($p2>$p4)&&($p2>$p5)&&($p2>$p6)){
        $pmax= $p2;
    }else if(($p3>$p0)&&($p3>$p1)&&($p3>$p2)&&($p3>$p4)&&($p3>$p5)&&($p3>$p6)){
        $pmax= $p3;
    }else if(($p4>$p0)&&($p4>$p2)&&($p4>$p3)&&($p4>$p5)&&($p4>$p1)&&($p4>$p6)){
        $pmax= $p4;
    }else if(($p5>$p0)&&($p5>$p2)&&($p5>$p3)&&($p5>$p4)&&($p5>$p1)&&($p5>$p6)){
        $pmax= $p5;
    }else {
        $pmax= $p6;
    }
    if((($p0<$p1)&&($p0<$p2)&&($p0<$p3)&&($p0<$p4)&&($p0<$p5)&&($p0<$p6))||($p0==0)){
        $pmin = $p0;
    }else if((($p1<$p0)&&($p1<$p2)&&($p1<$p3)&&($p1<$p4)&&($p1<$p5)&&($p1<$p6))||($p1==0)){
        $pmin= $p1;
    }else if((($p2<$p0)&&($p2<$p1)&&($p2<$p3)&&($p2<$p4)&&($p2<$p5)&&($p2<$p6))||($p2==0)){
        $pmin= $p2;
    }else if((($p3<$p0)&&($p3<$p1)&&($p3<$p2)&&($p3<$p4)&&($p3<$p5)&&($p3<$p6))||($p3==0)){
        $pmin= $p3;
    }else if((($p4<$p0)&&($p4<$p2)&&($p4<$p3)&&($p4<$p5)&&($p4<$p1)&&($p4<$p6))||($p4==0)){
        $pmin= $p4;
    }else if((($p5<$p0)&&($p5<$p2)&&($p5<$p3)&&($p5<$p4)&&($p5<$p1)&&($p5<$p6))||($p5==0)){
        $pmin= $p5;
    }else {
        $pmin= $p6;
    }
    $d0 = $predeaths0/$total;
    $d1 = $predeaths1/$total;
    $d2 = $predeaths2/$total;
    $d3 = $predeaths3/$total;
    $d4 = $predeaths4/$total;
    $d5 = $predeaths5/$total;
    $d6 = $predeaths6/$total;
    if(($d0>$d1)&&($d0>$d2)&&($d0>$d3)&&($d0>$d4)&&($d0>$d5)&&($d0>$d6)){
        $dmax = $d0;
    }else if(($d1>$d0)&&($d1>$d2)&&($d1>$d3)&&($d1>$d4)&&($d1>$d5)&&($d1>$d6)){
        $dmax = $d1;
    }else if(($d2>$d0)&&($d2>$d1)&&($d2>$d3)&&($d2>$d4)&&($d2>$d5)&&($d2>$d6)){
        $dmax = $d2;
    }else if(($d3>$d1)&&($d3>$d2)&&($d3>$d0)&&($d3>$d4)&&($d3>$d5)&&($d3>$d6)){
        $dmax = $d3;
    }else if(($d4>$d1)&&($d4>$d2)&&($d4>$d0)&&($d4>$d3)&&($d4>$d5)&&($d4>$d6)){
        $dmax = $d4;
    }else if(($d5>$d1)&&($d5>$d2)&&($d5>$d3)&&($d5>$d4)&&($d5>$d0)&&($d5>$d6)){
        $dmax = $d5;
    }else {
        $dmax = $d6;
    }
    if((($d0<$d1)&&($d0<$d2)&&($d0<$d3)&&($d0<$d4)&&($d0<$d5)&&($d0<$d6))||($d0==0)){
        $dmin = $d0;
    }else if((($d1<$d0)&&($d1<$d2)&&($d1<$d3)&&($d1<$d4)&&($d1<$d5)&&($d1<$d6))||($d1==0)){
        $dmin = $d1;
    }else if((($d2<$d1)&&($d2<$d0)&&($d2<$d3)&&($d2<$d4)&&($d2<$d5)&&($d2<$d6))||($d2==0)){
        $dmin = $d2;
    }else if((($d3<$d1)&&($d3<$d2)&&($d3<$d0)&&($d3<$d4)&&($d3<$d5)&&($d3<$d6))||($d3==0)){
        $dmin = $d3;
    }else if((($d4<$d1)&&($d4<$d2)&&($d4<$d0)&&($d4<$d3)&&($d4<$d5)&&($d4<$d6))||($d4==0)){
        $dmin = $d4;
    }else if((($d5<$d1)&&($d5<$d2)&&($d5<$d0)&&($d5<$d4)&&($d5<$d3)&&($d5<$d6))||($d5==0)){
        $dmin = $d5;
    }else {
        $dmin = $d6;
    }
    $sql2 = "SELECT total FROM population WHERE state = '$state'";
    $result3 = mysqli_query($conn, $sql2);
    $res3 = mysqli_fetch_array($result3);
    $fvalue4 = $res3['total'];
    $state_exposure = $gender_totalcases/$fvalue4;
    $pre1_condition = $total_predeaths/$total;
    $no_condition = 1 - $pre1_condition;
    if ($precondition=="no"){
    $condition = $no_condition;
    }else{
        $condition = $pre1_condition;
    }
    
    $vi_raw = $pmax*$vi_gender + $state_exposure;
    $si_raw = $dmax*$si_gender*$condition;
    $vi_min = $pmin*$vi_gender + $state_exposure;
    $si_min = $dmin*$si_gender*$condition;
    $vi_range = $vi_raw - $vi_min;
    $v_range = $vi_range/10;
    $si_range = $si_raw - $si_min;
    $s_range = $si_range/10;
    $vi1 = $vi_min + $v_range;
    $vi2 = $vi1 + $v_range;
    $vi3 = $vi2 + $v_range;
    $vi4 = $vi3 + $v_range;
    $vi5 = $vi4 + $v_range;
    $vi6 = $vi5 + $v_range;
    $vi7 = $vi6 + $v_range;
    $vi8 = $vi7 + $v_range;
    $vi9 = $vi8 + $v_range;
    $si1 = $si_min + $s_range;
    $si2 = $si1 + $s_range;
    $si3 = $si2 + $s_range;
    $si4 = $si3 + $s_range;
    $si5 = $si4 + $s_range;
    $si6 = $si5 + $s_range;
    $si7 = $si6 + $s_range;
    $si8 = $si7 + $s_range;
    $si9 = $si8 + $s_range;
    $si10 = $si9 + $s_range;    
    
    $vci_max = $vi_raw*$si_raw*1000;
    $vci_min = $vi_min*$si_min*1000;
    $vci_dif = $vci_max - $vci_min;
    $vci_diff = $vci_dif/3;
    $vci_soon = $vci_min + $vci_diff;
    $vci_sooner = $vci_soon + $vci_diff;
    $vci_urgent = $vci_sooner + $vci_diff;
    if(($age>=0)&&($age<=17)){
        $vi_user = $p0*$vi_gender + $state_exposure;
        $si_user = $d0*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }

    }else if(($age>17)&&($age<=29)){
        $vi_user = $p1*$vi_gender + $state_exposure;
        $si_user = $d1*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }else if(($age>29)&&($age<=49)){
        $vi_user = $p2*$vi_gender + $state_exposure;
        $si_user = $d2*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }else if(($age>49)&&($age<=64)) {
        $vi_user = $p3*$vi_gender + $state_exposure;
        $si_user = $d3*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }else if(($age>65)&&($age<=74)){
        $vi_user = $p4*$vi_gender + $state_exposure;
        $si_user = $d4*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }else if(($age>75)&&($age<=84)){
        $vi_user = $p5*$vi_gender + $state_exposure;
        $si_user = $d5*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
            $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }else if($age>84){
        $vi_user = $p6*$vi_gender + $state_exposure;
        $si_user = $d6*$si_gender*$condition;
        if(($vi_user>=$vi_min)&&($vi_user<=$vi1)){
            $vi_index = 1;
        }else if(($vi_user>$vi1)&&($vi_user<=$vi2)){
            $vi_index = 2;
        }else if(($vi_user>$vi2)&&($vi_user<=$vi3)){
            $vi_index = 3;
        }else if(($vi_user>$vi3)&&($vi_user<=$vi4)){
            $vi_index = 4;
        }else if(($vi_user>$vi4)&&($vi_user<=$vi5)){
            $vi_index = 5;
        }else if(($vi_user>$vi5)&&($vi_user<=$vi6)){
            $vi_index = 6;
        }else if(($vi_user>$vi6)&&($vi_user<=$vi7)){
            $vi_index = 7;
        }else if(($vi_user>$vi7)&&($vi_user<=$vi8)){
            $vi_index = 8;
        }else if(($vi_user>$vi8)&&($vi_user<=$vi9)){
            $vi_index = 9;
        }else if($vi_user>$vi9){
            $vi_index = 10;
        }
        if(($si_user>=$si_min)&&($si_user<=$si1)){
            $si_index = 1;
        }else if(($si_user>$si1)&&($si_user<=$si2)){
            $si_index = 2;
        }else if(($si_user>$si2)&&($si_user<=$si3)){
            $si_index = 3;
        }else if(($si_user>$si3)&&($si_user<=$si4)){
            $si_index = 4;
        }else if(($si_user>$si4)&&($si_user<=$si5)){
            $si_index = 5;
        }else if(($si_user>$si5)&&($si_user<=$si6)){
            $si_index = 6;
        }else if(($si_user>$si6)&&($si_user<=$si7)){
            $si_index = 7;
        }else if(($si_user>$si7)&&($si_user<=$si8)){
            $si_index = 8;
        }else if(($si_user>$si8)&&($si_user<=$si9)){
         $si_index = 9;
        }else if($si_user>$si9){
            $si_index = 10;
        }
    }
    $vci_user = $vi_user*$si_user*1000;
    if(($vci_user>=$vci_min)&&($vci_user<=$vci_soon)){
    $status = "Soon";
    }else if(($vci_user>$vci_soon)&&($vci_user<=$vci_sooner)){
    $status = "Sooner";
    }else {
    $status = "Soonest";
    }
echo $status;
    mysqli_close($conn);
?>