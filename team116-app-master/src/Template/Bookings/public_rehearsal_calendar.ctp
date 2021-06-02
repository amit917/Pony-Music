<!--<body id="page-top">-->
<!--"><a class='nav-link' href='staff_add_rehearsal?date=<?/*=$arDate[0]*/?>&timestamp=<?/*= $arAMTime[0]*/?><?/*= $arRoomS1[$i]*/?>&price=<?/*=$room[2]*/?>'>"
-->
<style>
    table, th, td {
        text-align: center;
    }
    table {
        width: 100%;
        table-layout: fixed;
    }
    th, td {
        vertical-align: middle;
    }
    tr.noBorder th {
        border: 0;
        vertical-align: middle;
        border-bottom: 0;
    }
    h2 {
        margin: 0;
    }
</style>

<?php


$arRoomS1=array();
$arRoomS2=array();
$arRoomS3=array();
$arRoomS4=array();
$arRoomS5=array();
$arRoomS6=array();
$arRoomS7=array();
$arRoomId1=array();
$arRoomId2=array();
$arRoomId3=array();
$arRoomId4=array();
$arRoomId5=array();
$arRoomId6=array();
$arRoomId7=array();
$arAMCharge=array();
$arPMCharge=array();
$arAMTime=array();
$arPMTime=array();
$conn=\Cake\Datasource\ConnectionManager::get('default');
$stmt=$conn->execute(' select * from sessions');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arAMTime, $room[1] . "-" . $room[2]);
    array_push($arPMTime, $room[4] . "-" . $room[5]);
    array_push($arAMCharge,$room[3]);
    array_push($arPMCharge,$room[6]);
endforeach;

$stmt=$conn->execute(' select id,room_number from rooms where session_id=1');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS1,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId1,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=2');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS2,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId2,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=3');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS3,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId3,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=4');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS4,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId4,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=5');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS5,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId5,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=6');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS6,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId6,$room[0]);

endforeach;
$stmt=$conn->execute(' select id,room_number from rooms where session_id=7');
foreach ($rows = $stmt->fetchAll() as $room):
    array_push($arRoomS7,"&roomId=".$room[0]."&roomNumber=".$room[1]);
    array_push($arRoomId7,$room[0]);

endforeach;
if(empty($_GET["key"])){
    date_default_timezone_set("Australia/Melbourne");
    $toDate=date('d');
    $toYear=date('y');
    $toMonth=date('m');
    
    


    $cpToMonth=$toMonth;

    $fullYear="20".$toYear;

    $daysinM=daysInmonth1($toYear,$toMonth);
    $str = date('w');
    if($str==0){
        $str=7;
    }

    $tempToday = $toDate-$str+1;
    if($tempToday<0){
        $toMonth=$toMonth-1;
        $cpToMonth=$toMonth;
        if($cpToMonth<10){
            $cpToMonth="0".$cpToMonth;

        }

        $daysinM=daysInmonth1($toYear,$toMonth);
        $tempToday=$tempToday+$daysinM;


    }

    $currentDate = date("Y/m/d");

    $Cdate = new DateTime($currentDate);
    $week = $Cdate->format("W");

    $numberOfWeeks=getIsoWeeksInYear($toYear);
    $ptoYear=$toYear;
    $ntoYear=$toYear;
    $fullYear="20".$toYear;
    $arDate = array();



    $fullMonth=date('F', strtotime($fullYear.'W'.$week));

    for ($i = 1; $i <= 7; $i++) {
        if ($tempToday <= $daysinM) {
            if($week<2&&$tempToday>20){

                if($tempToday<10){

                    $tDayMonth=(20).($toYear-1)."-".(12).'-0'.$tempToday;
                }
                else{
                    $tDayMonth=(20).($toYear-1)."-".(12).'-'.$tempToday;
                }

                array_push($arDate, $tDayMonth);
                $tempToday++;
            }
            elseif($week>50&&$cpToMonth<10){

                if($tempToday<10){
                    if($cpToMonth==2){
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;

                    }
                    else{
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;

                    }

                }
                else{
                    if($cpToMonth==2){
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-'.$tempToday;

                    }
                    else{
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-'.$tempToday;
                    }

                }

                array_push($arDate, $tDayMonth);
                $tempToday++;

            }
            else{

                if($tempToday<10){
                    if($cpToMonth==2)
                    {
                        $tDayMonth=$fullYear."-".$cpToMonth.'-0'.$tempToday;
                    }
                    else
                    {
                        $tDayMonth=$fullYear."-".$cpToMonth.'-0'.$tempToday;
                    }

                }
                else{
                    if($cpToMonth==2)
                    {

                        $tDayMonth=$fullYear."-".$cpToMonth.'-'.$tempToday;
                    }
                    else
                    {
                        $tDayMonth=$fullYear."-".$cpToMonth.'-'.$tempToday;

                    }
                }
                array_push($arDate, $tDayMonth);
                $tempToday++;

            }
        } else {
            $tempToday = 1;
            $cpToMonth+=1;

            if($cpToMonth>12){
                $cpToMonth=1;
            }
            if($week<4&&$cpToMonth>1){
                $cpToMonth-=1;

            }
            if($week>50&&$cpToMonth<5){

                if($tempToday<10){
                    if($cpToMonth==2){
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;
                    }
                    else{
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;

                    }

                }
                else{
                    if($cpToMonth==2) {
                        $tDayMonth = (20) . ($toYear + 1) . "-" . $cpToMonth . '-' . $tempToday;
                    }
                    else{
                        $tDayMonth = (20) . ($toYear + 1) . "-" . $cpToMonth . '-' . $tempToday;
                    }
                }
                array_push($arDate, $tDayMonth);
                $tempToday++;

            }
            else{

                if($tempToday<10){
                    if($cpToMonth==2){
                        $tDayMonth=$fullYear.'-'.$cpToMonth.'-0'.$tempToday;
                    }
                    else{
                        $tDayMonth=$fullYear.'-'.$cpToMonth.'-0'.$tempToday;
                    }

                }
                else{
                    if($cpToMonth==2){
                        $tDayMonth=$fullYear.'-'.$cpToMonth.'-'.$tempToday;

                    }
                    else{
                        $tDayMonth=$fullYear.'-'.$cpToMonth.'-'.$tempToday;
                    }



                }
                $tempToday++;
                array_push($arDate,$tDayMonth);
            }
        };


    }



}
else {
    date_default_timezone_set("Australia/Melbourne");

    $week = $_GET["key"];
    $toYear = $_GET["year"];



    $numberOfWeeks = getIsoWeeksInYear($toYear);
    $ptoYear = $toYear;
    $ntoYear = $toYear;
    $arAMTime=array();
    $arAMCharge=array();
    $arPMCharge=array();
    $arPMTime=array();
    $arDate = array();

    $fullYear = "20" . $toYear;

    if ($week > 5 && $week < 10) {
        $fullMonth = "February";
        $toMonth = 2;
        $cpToMonth=$toMonth;
    } else {
        $fullMonth = date('F', strtotime($fullYear . 'W' . $week));
        $toMonth = date('n', strtotime($fullYear . 'W' . $week));
        $cpToMonth=$toMonth;


    }
    $daysinM = daysInmonth1($toYear, $cpToMonth);
    $week_start = new DateTime();
    $week_start->setISODate($toYear, $week);
    $Udate = $week_start->format("y-m-d");


    $str = date('w', strtotime("$Udate"));
    $toDate = $week_start->format('d');
    $cpToYear = $week_start->format('y');
    $tempToday = $toDate - $str + 1;
    $arDate = array();




    for ($i = 1; $i <= 7; $i++) {
        if ($tempToday <= $daysinM) {
            if($week<2&&$tempToday>20){
                if($tempToday<10){
                    $tDayMonth=(20).($toYear-1)."-".(12).'-0'.$tempToday;
                }
                else{
                    $tDayMonth=(20).($toYear-1)."-".(12).'-'.$tempToday;
                }
                array_push($arDate, $tDayMonth);

                $tempToday++;
            }
            elseif($week>50&&$cpToMonth<5){
                if($tempToday<10){
                    if($cpToMonth<10){
                        $tDayMonth=(20).($toYear+1)."-0".$cpToMonth.'-0'.$tempToday;

                    }
                    else{
                        $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;

                    }

                }
                else{
                    if($cpToMonth<10){
                        $tDayMonth=$fullYear."-0".$cpToMonth.'-'.$tempToday;

                    }
                    else{$tDayMonth=$fullYear."-".$cpToMonth.'-'.$tempToday;}

                }
                array_push($arDate, $tDayMonth);

                $tempToday++;

            }
            else{

                if($tempToday<10){
                    if($cpToMonth<10){
                        $tDayMonth=$fullYear."-0".$cpToMonth.'-0'.$tempToday;

                    }
                    else{
                        $tDayMonth=$fullYear."-".$cpToMonth.'-0'.$tempToday;
                    }


                }
                else{
                    if($cpToMonth<10){
                        $tDayMonth=$fullYear."-0".$cpToMonth.'-'.$tempToday;

                    }
                    else{$tDayMonth=$fullYear."-".$cpToMonth.'-'.$tempToday;}

                }

                array_push($arDate, $tDayMonth);

                $tempToday++;

            }



        } else {
            $tempToday = 1;
            $cpToMonth+=1;

            if($cpToMonth>12){
                $cpToMonth=1;

            }
            if($week<4&&$cpToMonth>1){
                $cpToMonth-=1;

            }

            if($week>50&&$cpToMonth<5){
                if($tempToday<10){
                    if($cpToMonth<10){
                        $tDayMonth=(20).($toYear+1)."-0".$cpToMonth.'-0'.$tempToday;

                    }
                    else{ $tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-0'.$tempToday;}


                }
                else{
                    if($cpToMonth<10){
                        $tDayMonth=(20).($toYear+1)."-0".$cpToMonth.'-0'.$tempToday;

                    }
                    else{$tDayMonth=(20).($toYear+1)."-".$cpToMonth.'-'.$tempToday;}



                }
                array_push($arDate, $tDayMonth);

                $tempToday++;

            }
            else{
                if($tempToday<10){
                    if($cpToMonth<10) {
                        $tDayMonth = $fullYear . '-0' . $cpToMonth . '-0' . $tempToday;
                    }
                    else{
                        $tDayMonth = $fullYear . '-' . $cpToMonth . '-0' . $tempToday;
                    }
                }
                else{
                    if($cpToMonth<10) {
                        $tDayMonth=$fullYear.'-0'.$cpToMonth.'-'.$tempToday;
                    }
                    else{
                        $tDayMonth=$fullYear.'-'.$cpToMonth.'-'.$tempToday;

                    }
                }
                $tempToday++;
                array_push($arDate,$tDayMonth);

            }


        };








    }


    $arRoomS1=array();
    $arRoomS2=array();
    $arRoomS3=array();
    $arRoomS4=array();
    $arRoomS5=array();
    $arRoomS6=array();
    $arRoomS7=array();
    $arAMCharge=array();
    $arPMCharge=array();
    $arAMTime=array();
    $arPMTime=array();
    $conn=\Cake\Datasource\ConnectionManager::get('default');
    $stmt=$conn->execute(' select * from sessions');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arAMTime, $room[1] . "-" . $room[2]);
        array_push($arPMTime, $room[4] . "-" . $room[5]);
    endforeach;
    $stmt=$conn->execute(' select session_day_charge,session_night_charge from sessions');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arAMCharge,$room[0]);
        array_push($arPMCharge,$room[1]);
    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=1');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS1,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=2');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS2,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=3');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS3,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=4');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS4,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=5');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS5,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=6');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS6,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;
    $stmt=$conn->execute(' select id,room_number from rooms where session_id=7');
    foreach ($rows = $stmt->fetchAll() as $room):
        array_push($arRoomS7,"&roomId=".$room[0]."&roomNumber=".$room[1]);

    endforeach;


}

function getIsoWeeksInYear($year) {
    $date = new DateTime;
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
}

function daysInmonth1($year,$month)
{

    $day = '01';

    /*if (!checkdate($month, $day, $year)) return 'error';*/

    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    $result = date('t', $timestamp);
    return $result;

}




function showDate($weekNumber,$fullYear,$arDate){

    if($weekNumber>5&&$weekNumber<10){
        $fullMonth=2;
    }
    else{
        $fullMonth=date('n', strtotime($fullYear.'W'.$weekNumber));
    }
    $daysinM=daysInmonth1($fullYear,$fullMonth);
    $week_start = new DateTime();
    $week_start->setISODate($fullYear,$weekNumber);
    $Udate=$week_start->format("y-m-d");

    $str = date('w',strtotime("$Udate"));
    $sDate=$week_start->format('d');
    $tempToday = $sDate-$str+1;

    $listdate=array();


    echo "<th><b>Date</b> </th>";
    for($i=0;$i<7;$i++){
        $pieces = explode("-", $arDate[$i]);
        echo "<th><b>".$pieces[2]."/".$pieces[1]."</b></th>";
        if($tempToday<$daysinM){
            $tempToday++;
        }else{
            $tempToday=1;

        };

    }
    return $listdate;


}
function checkUsage($year,$date,$roomId,$sessionId,$sessionType,$arDate,$arAMTime,$arRoomS1,$room,$i){
    $fee=explode('.',$room)[0];
    $conn=\Cake\Datasource\ConnectionManager::get('default');



    $colour="bgcolor='#66ffcc'> <a class='nav-link'
href='../../bookings/public_rehearsal_form?date=$arDate&timestamp=$arAMTime$arRoomS1&price=$room'>$ $fee </a>
";
    $count=1;
    for($i=0;$i<sizeof($date);$i++) {

        $y = explode('-',$date[$i])[0];
        $m = explode('-',$date[$i])[1];
        $d = explode('-',$date[$i])[2];
        $t = $y . $m . $d;
        $TodayDate=date("Ymd");

        if($t<$TodayDate){

            $count++;
        }


    }
    if($sessionId<$count){
        $colour="bgcolor='#CACACA'>";

    }
    
    $TodayDate=date("Y-m-d");
  
    
   
    if($arDate==$TodayDate){
        
        
        
        $sql=$conn->execute("select * from sessions where id=$sessionId");
    
        foreach($sql as $row){
            $sql=$row[1];
        }
        $sTime=explode(':',$sql);
        $sTime=implode("",$sTime);

        $cTime=explode(":",date("H:i:s"));
   

        $cTime=implode("",$cTime);
    

        if($sTime<$cTime){
            $colour="bgcolor='#CACACA'>";
        }
    }
    


    for($i=0;$i<sizeof($date);$i++) {
        $conn=\Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute("select room_usages.room_id,room_usages_date,room_usages.id,display_name from room_usages inner join bookings b on room_usages.booking_id = b.id
where room_usages.room_id=$roomId AND room_usages_session='AM' AND b.status='completed'");

        foreach ($reval = $stmt->fetchAll() as $id) {
            if ($id[1]==$date[$i]) {
                $time = strtotime($date[$i]);
                $str = date('w',$time);
                if($str==0){
                    $str=7;
                }
                if($str==$sessionId){
                    $colour = "bgcolor='#CACACA'>$id[3]<br> Booked";

                }
            }

        }
    }
    return  $colour;



}
function checkUsagePM($date,$roomId,$sessionId,$arDate,$arAMTime,$arRoomS1,$room){
    $fee=explode('.',$room)[0];
    $conn=\Cake\Datasource\ConnectionManager::get('default');




    $colour="bgcolor='#66ffcc'><a class='nav-link'
href='../../bookings/public_rehearsal_form?date=$arDate&timestamp=$arAMTime$arRoomS1&price=$room'>$ $fee </a>";
    $count=1;
    for($i=0;$i<sizeof($date);$i++) {

        $y = explode('-',$date[$i])[0];
        $m = explode('-',$date[$i])[1];
        $d = explode('-',$date[$i])[2];
        $t = $y . $m . $d;
        $TodayDate=date("Ymd");

        if($t<$TodayDate){

            $count++;
        }


    }
    if($sessionId<$count){
        $colour="bgcolor='#CACACA'>";

    }
    $TodayDate=date("Y-m-d");
  
    
   
    if($arDate==$TodayDate){
        
        
       
        $sql=$conn->execute("select * from sessions where id=$sessionId");
    
        foreach($sql as $row){
            $sql=$row[4];
        }
        $sTime=explode(':',$sql);
        $sTime=implode("",$sTime);

        $cTime=explode(":",date("H:i:s"));
   

        $cTime=implode("",$cTime);
    

        if($sTime<$cTime){
            $colour="bgcolor='#CACACA'>";
        }
    }

    for($i=0;$i<sizeof($date);$i++) {
        
        $stmt = $conn->execute("select room_usages.room_id,room_usages_date,room_usages.id,display_name from room_usages inner join bookings b on room_usages.booking_id = b.id
where room_usages.room_id=$roomId AND room_usages_session='PM' AND b.status='completed'");

        foreach ($reval = $stmt->fetchAll() as $id) {
            if ($id[1]==$date[$i]) {



                $time = strtotime($date[$i]);
                $str = date('w',$time);
                if($str==0){
                    $str=7;
                }
                if($str==$sessionId){



                    $colour = "bgcolor='#CACACA'>$id[3]<br> Booked";


                }
            }

        }
    }
    return  $colour;



}

?>
        <table class="table table-bordered table-responsive-sm fixedWidth" id="calendar">

            <thead>
                  <tr class="noBorder">
        <th colspan="8">
            <h2 class="card-title" id="monthAndYear"><?php echo $fullMonth." ";echo $fullYear;
                        ?></h2>
        </th>
    </tr>
            <tr class="noBorder">
                <form method="post" action="iteration2_test_calendar.ctp?key=">
                <th></th>
                <th colspan="2">  <?php
                    $pWeek=$week-1;

                    if($pWeek<1){
                        $ptoYear=$toYear;
                        $ptoYear-=1;

                        $pWeek=getIsoWeeksInYear($ptoYear);
                    }

                    echo $this->Html->link('Previous week', ['controller'=>'bookings','action'=>"public_rehearsal_calendar?key=$pWeek&year=$ptoYear"], array('class' => 'btn btn-primary btn-round btn-sm'));

                    ?>
                </th>
                <th colspan="2"> <?php echo $this->Html->link('today', "/bookings/public_rehearsal_calendar", array('class' => 'btn btn-default btn-round btn-sm'));?></th>
                <th colspan="2"> <?php
                    $nWeek=$week+1;
                    if($nWeek>$numberOfWeeks+1){
                    $nWeek=1;
                    $ntoYear=$toYear;
                    $ntoYear+=1;

                    }

                    echo $this->Html->link('Next week', ['controller'=>'bookings','action'=>"public_rehearsal_calendar?key=$nWeek&year=$ntoYear"], array('class' => 'btn btn-primary btn-round btn-sm'));

                    ?>
                </th>
                <th></th>

















                </form>
            </tr>
            <tr>
                <th>



                </th>

                <th><b>Mon</b></th>
                <th><b>Tue</b></th>
                <th><b>Wed</b></th>
                <th><b>Thu</b></th>
                <th><b>Fri</b></th>
                <th><b>Sat</b></th>
                <th><b>Sun</b></th>
            </tr>
            <tr>
                <?php $listDate=showDate($week,$fullYear,$arDate); ?>
            </tr>
            <tbody class="fixedWidth" id="calendar-body">
            </tbody>
            <th >Night Time</th>
            <?php
            $stmt=$conn->execute(' select * from sessions');
            ?>
            <?php foreach($rows=$stmt->fetchAll() as $time): 
            $a=explode(':',$time[4]);
            $q=explode(':',$time[5]);
         
            if($a[0]>12){
                $a[0]=$a[0]-12;
                $b=$a[0].':'.$a[1].'pm';
            }
            else{
                $b=$a[0].':'.$a[1].'am';
                
            }
            if($q[0]>12){
                $q[0]=$q[0]-12;
                $c=$q[0].':'.$q[1].'pm';
            }
            else{
                $c=$q[0].':'.$q[1].'am';
            }
            
            
           


            ?>
            
            
            


                <th ><?=  $b ?>-<?= $c ?></th>





            <?php endforeach; ?>


            <?php
            $stmt=$conn->execute('select t.id,room_number,session_night_charge from sessions inner join rooms t on sessions.id = t.session_id where t.session_id=1');
            ?>
            <?php foreach($rows=$stmt->fetchAll() as $i=>$room): ?>
                <tr>
                    <th>Room<?= $room[1] ?></th>


                    <td  <?= checkUsagePM($arDate,$arRoomId1[$i],'1',$arDate[0],$arPMTime[0],$arRoomS1[$i],$room[2]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId2[$i],'2',$arDate[1],$arPMTime[1],$arRoomS2[$i],$arPMCharge[1]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId3[$i],'3',$arDate[2],$arPMTime[2],$arRoomS3[$i],$arPMCharge[2]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId4[$i],'4',$arDate[3],$arPMTime[3],$arRoomS4[$i],$arPMCharge[3]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId5[$i],'5',$arDate[4],$arPMTime[4],$arRoomS5[$i],$arPMCharge[4]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId6[$i],'6',$arDate[5],$arPMTime[5],$arRoomS6[$i],$arPMCharge[5]) ;?>
                    </td>
                    <td  <?= checkUsagePM($arDate,$arRoomId7[$i],'7',$arDate[6],$arPMTime[6],$arRoomS7[$i],$arPMCharge[6]) ;?>
                    </td>

                </tr>

            <?php endforeach; ?>
            <tr bgcolor="#ba55d3">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>



                </th>

                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>
            <tr>
                <?php $listDate=showDate($week,$fullYear,$arDate); ?>
            </tr>
            <tbody id="calendar-body">
            </tbody>

            <th >Day Time</th>
            <?php
            $stmt=$conn->execute(' select * from sessions');
            
            ?>
            <?php foreach($rows=$stmt->fetchAll() as $time): 
            $a=explode(':',$time[1]);
            $q=explode(':',$time[2]);
         
            if($a[0]>12){
                $a[0]=$a[0]-12;
                $b=$a[0].':'.$a[1].'pm';
            }
            else{
                $b=$a[0].':'.$a[1].'am';
                
            }
            if($q[0]>12){
                $q[0]=$q[0]-12;
                $c=$q[0].':'.$q[1].'pm';
            }
            else{
                $c=$q[0].':'.$q[1].'am';
            }?>
                <th ><?= $b ?>-<?= $c ?></th>
            <?php endforeach; ?>

            <?php
            $stmt=$conn->execute('select t.id,room_number,session_day_charge,session_id from sessions inner join rooms t on sessions.id = t.session_id where  t.session_id=1');
            ?>
            <?php foreach($rows=$stmt->fetchAll() as $i=>$room): ?>



                <tr>
                    <th  >Room<?= $room[1] ?></th>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId1[$i],'1','AM',$arDate[0],$arAMTime[0],$arRoomS1[$i],$room[2],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId2[$i],'2','AM',$arDate[1],$arAMTime[1],$arRoomS2[$i],$arAMCharge[1],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId3[$i],'3','AM',$arDate[2],$arAMTime[2],$arRoomS3[$i],$arAMCharge[2],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId4[$i],'4','AM',$arDate[3],$arAMTime[3],$arRoomS4[$i],$arAMCharge[3],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId5[$i],'5','AM',$arDate[4],$arAMTime[4],$arRoomS5[$i],$arAMCharge[4],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId6[$i],'6','AM',$arDate[5],$arAMTime[5],$arRoomS6[$i],$arAMCharge[5],$i) ;?>
                    </td>
                    <td  <?= checkUsage($toYear,$arDate,$arRoomId7[$i],'7','AM',$arDate[6],$arAMTime[6],$arRoomS7[$i],$arAMCharge[6],$i) ;?>
                    </td>
                </tr>


            <?php endforeach;?>








            </thead>


        </table>







