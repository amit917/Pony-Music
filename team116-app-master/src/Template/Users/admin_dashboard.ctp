
<?php

if(empty($_GET['year'])){
    $str=date("Ymd");
    $dStr=date('d-m-Y');
    $day=date('D', strtotime($str));
    $d=date('d');
    $m=date('m');
    $y=date('Y');
    $sd=daysInmonth1($y,$m);

}
else{
    $y=$_GET['year'];
    $m=$_GET['month'];
    $d=$_GET['day'];
    if($m[0]==0){
        $m=substr($m,1);
    }
    if($m<10){
        $m='0'.$m;
    }



    if($d<10){

            $str=$y.$m.'0'.$d;


    }
    else{

       $str=$y.$m.$d;

    }
    $sd=daysInmonth1($y,$m);
    $dStr=$d.'-'.$m.'-'.$y;
    if($d<10){
        $dStr=$m.'-0'.$d.'-'.$y;
    }
    $day=date('D', strtotime($str));





}








function daysInmonth1($year,$month)
{

    $day = '01';
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    $result = date('t', $timestamp);
    return $result;

}

echo $this->Form->create();


$pday = $d - 1;
$pm=$m;
$py=$y;

if ($pday < 1) {

    $pm-=1;
    if($pm<1){
        $pm=12;
        $py-=1;
    }
    $pday=daysInmonth1($py,$pm);



}
$cpDate=$y.$pm.$pday;

echo $this->Html->link('prev day'

    , "/users/admin_dashboard?year=$py&month=$pm&day=$pday", array('class' => 'btn btn-primary btn-round'));


$nday = $d +1;
$nm=$m;
$ny=$y;

if ($nday >$sd ) {

    $nm+=1;
    if($nm>12){
        $nm=1;
        $ny+=1;

    }
    $nday=1;



}
$cnDate=$y.$nm.$nday;
echo $this->Html->link('Today','/users/admin_dashboard', array('class' => 'btn btn-primary btn-round'));


echo $this->Html->link('next day'

    , "/users/admin_dashboard?year=$ny&month=$nm&day=$nday", array('class' => 'btn btn-primary btn-round'));


?>
<?php echo $this->Form->button('All', ['type' => 'submit', 'value' =>
    'all', 'name'=>'btn','class'=>'btn btn-rose'])?>
<?php echo $this->Form->button('booked', ['type' => 'submit', 'value' =>
    'booked', 'name'=>'btn','class'=>'btn btn-success'])?>
<?php echo $this->Form->button('canceled', ['type' => 'submit', 'value' =>
    'canceled', 'name'=>'btn','class'=>'btn btn-danger'])?>
<?php echo $this->Form->button('processing', ['type' => 'submit', 'value' =>
    'processing', 'name'=>'btn','class'=>'btn btn-info'])?>
    <?php echo $this->Form->button('Canceled W/O Refund List', ['type' => 'submit', 'value' =>
    'CanceledW/ORefundList', 'name'=>'btn','class'=>'btn btn-warning'])?>






<?php echo $this->Form->end() ?>
<?php
if($status=="CanceledW/ORefundList"){?>
<div class="card">
    <div class="card-header card-header-info">
        <h4>Cancelled without Refund List</h4>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="backlineTable">
                <thead>
                <tr>
                    <th>Rooms</th>
                    <th>Booking Date</th>
                    <th>Display Name</th>
                    <th>Band Name</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Extra</th>
                    <th>Total Charge</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $conn=\Cake\Datasource\ConnectionManager::get('default');

                $rooms=$conn->execute("select room_number from rooms where session_id=1");



                foreach($rows=$rooms->fetchAll() as $room):
                $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and b.status='canceled' group by b.id");


                ?>
                    <tr>

                    <th><?= $room[0]; $count=0?></th>



                    <?php foreach($rows=$stmt->fetchAll() as $record): ;
                    $dList=explode('-',$record[6]);
                    



                    if($count>0){
                        ?>
                        <th></th>
                        <?php
                    }

                ;?>
                    <td><?= $dList[2].'/'.$dList[1].'/'.$dList[0] ?></td>

                    <td><?= $record[11] ?></td>
                    <td><?= $record[12] ?></td>

                    <th><?= $record[0].' '. $record[1] ?></th>
                    <td><?= $record[2] ?></td>
                    <td><?= $record[10] ?></td>

                    <?php if($record[5]!=null){

                        $assets=$conn->execute("select asset_name from assets_bookings
                inner join bookings b on assets_bookings.booking_id = b.id
                inner join assets a on assets_bookings.asset_id = a.id
                where booking_id=$record[5]");


                        ?>

                        <td><?php foreach ($assets->fetchAll() as $asset):

                            echo $asset[0]."<br/>";
                        endforeach; ?>
                        </td><?php

                    }
                    else{
                        ?>
                        <td> </td>
                        <?php
                    }?>




                    <td>$<?= $record[4]; ?></td>
                    <?php if($record[9]=="completed"){

                        echo "<td><a class='btn btn-success' href='../../Bookings/rehearsal_booking_detail?BookingId=$record[8]'> Booked</a> </td>";

                    }
                    elseif ($record[9]=="refunded"){
                        echo "<td><a class='btn btn-danger' href='#0'> $record[9]</a> </td>";

                    }
                    elseif ($record[9]=="processing"){
                        echo "<td><a class='btn btn-info' href='#0'> processing </a></td>";

                    }
                    elseif ($record[9]=="canceled"){
                        echo "<td><a class='btn btn-warning' href='#0'> canceled w/o refund </a></td>";

                    }
                $count++?>




                    </tr>



                <?php endforeach; ?>









                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


              
<?php }
else{
            ?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">

            <?php echo "<h2> $dStr $day (Night)</h2>";?>
            Today Rehearsal Booking

        </h4>
        <p class="card-category">

        </p>
    </div>


    <div class="card-body table-responsive">
        <table class="table table-hover" id="allClientsTable">
            <thead class="text-info">
            <th>Rooms</th>
            <th>Display Name</th>
            <th>Band Name</th>
            <th>First Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Extra</th>
            <th>Total Charge</th>
            <th>Status</th>



            </thead>
            <tbody>

            <?php
            $conn=\Cake\Datasource\ConnectionManager::get('default');
            $rooms=$conn->execute("select room_number from rooms where session_id=1");

            ?>
            <?php

            foreach($rows=$rooms->fetchAll() as $room):

            ?>

                <?php
            if($status=="booked"){
                $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and booking_date_from=$str and booking_session='PM' and b.status='completed' group by b.id");
            }
            elseif($status=="canceled"){
                    $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and booking_date_from=$str and booking_session='PM' and (b.status='canceled' or b.status='refunded') group by b.id");
                }
            elseif($status=="processing"){
                $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id

            where  room_number=$room[0] and booking_date_from=$str and booking_session='PM' and b.status='processing' group by b.id");
            }
            
            else{
                $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and booking_date_from=$str and booking_session='PM' group by b.id");


            }
                ?>


            <tr>

                <th><?= $room[0]; $count=0?></th>



                <?php foreach($rows=$stmt->fetchAll() as $record): ;



                if($count>0){
                    ?>
                    <th></th>
                    <?php
                }

            ;?>

                <td><?= $record[11] ?></td>
                <td><?= $record[12] ?></td>

                <th><?= $record[0] ?></th>
                <td><?= $record[2] ?></td>
                <td><?= $record[10] ?></td>

                <?php if($record[5]!=null){

                $assets=$conn->execute("select asset_name from assets_bookings
                inner join bookings b on assets_bookings.booking_id = b.id
                inner join assets a on assets_bookings.asset_id = a.id
                where booking_id=$record[5]");


                ?>

                <td><?php foreach ($assets->fetchAll() as $asset):

                        echo $asset[0]."<br/>";
                    endforeach; ?>
                </td><?php

                }
                else{
                    ?>
                    <td> </td>
                <?php
                }?>




                <td>$<?= $record[4]; ?></td>
                <?php if($record[9]=="completed"){

                    echo "<td><a class='btn btn-success' href='../../Bookings/rehearsal_booking_detail?BookingId=$record[8]'> Booked</a> </td>";

                }
                elseif ($record[9]=="refunded"){
                    echo "<td><a class='btn btn-danger' href='#0'> $record[9]</a> </td>";

                }
                elseif ($record[9]=="processing"){
                    echo "<td><a class='btn btn-info' href='#0'> processing </a></td>";

                }
                elseif ($record[9]=="canceled"){
                    echo "<td><a class='btn btn-warning' href='#0'> canceled w/o refund </a></td>";

                }
                $count++?>




            </tr>



            <?php endforeach; ?>









            <?php endforeach; ?>






            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">

            <?php echo "<h2> $dStr $day (DAY)</h2>";?>
            Today Rehearsal Booking

        </h4>
        <p class="card-category">

        </p>
    </div>


    <div class="card-body table-responsive">
        <table class="table table-hover" id="allClientsTable">
            <thead class="text-info">
            <th>Rooms</th>
            <th>Display Name</th>
            <th>Band Name</th>
            <th>First Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Extra</th>
            <th>Total Charge</th>
            <th>Status</th>



            </thead>
            <tbody>

            <?php
            $conn=\Cake\Datasource\ConnectionManager::get('default');
            $rooms=$conn->execute("select room_number from rooms where session_id=1");

            ?>
            <?php

            foreach($rows=$rooms->fetchAll() as $room):

                ?>

                <?php
                if($status=="booked"){
                    $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and booking_date_from=$str and booking_session='AM' and b.status='completed' group by b.id");
                }
                elseif($status=="canceled"){
                    $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id






            where  room_number=$room[0] and booking_date_from=$str and booking_session='AM' and (b.status='canceled' or b.status='refunded') group by b.id");
                }
                elseif($status=="processing"){
                    $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id

            where  room_number=$room[0] and booking_date_from=$str and booking_session='AM' and b.status='processing' group by b.id");
                }
                else{
                    $stmt=$conn->execute("select
            client_fname,client_lname,client_phone,room_number,booking_total_charge,ab.booking_id,booking_date_from,booking_session,b.id,status,client_email,b.display_name,b2.band_name from
            rooms r
            inner join bookings b on r.id = b.room_id
            inner join bookings_clients bc on b.id = bc.booking_id
            left join clients c on bc.client_id = c.id
            left join assets_bookings ab on b.id = ab.booking_id
            left join assets a on ab.asset_id = a.id
            left join bands_clients bc2 on c.id = bc2.client_id
            left join bands b2 on bc2.band_id = b2.id
            where  room_number=$room[0] and booking_date_from=$str and booking_session='AM' group by b.id");


                }
                ?>


                <tr>

                <th><?= $room[0]; $count=0?></th>



                <?php foreach($rows=$stmt->fetchAll() as $record): ;



                if($count>0){
                    ?>
                    <th></th>
                    <?php
                }

            ;?>

                <td><?= $record[11] ?></td>
                <td><?= $record[12] ?></td>

                <th><?= $record[0] ?></th>
                <td><?= $record[2] ?></td>
                <td><?= $record[10] ?></td>

                <?php if($record[5]!=null){

                    $assets=$conn->execute("select asset_name from assets_bookings
                inner join bookings b on assets_bookings.booking_id = b.id
                inner join assets a on assets_bookings.asset_id = a.id
                where booking_id=$record[5]");


                    ?>

                    <td><?php foreach ($assets->fetchAll() as $asset):

                        echo $asset[0]."<br/>";
                    endforeach; ?>
                    </td><?php

                }
                else{
                    ?>
                    <td> </td>
                    <?php
                }?>




                <td>$<?= $record[4]; ?></td>
                <?php if($record[9]=="completed"){

                    echo "<td><a class='btn btn-success' href='../../Bookings/rehearsal_booking_detail?BookingId=$record[8]'> Booked</a> </td>";

                }
                elseif ($record[9]=="refunded"){
                    echo "<td><a class='btn btn-danger' href='#0'> $record[9]</a> </td>";

                }
                elseif ($record[9]=="processing"){
                    echo "<td><a class='btn btn-info' href='#0'> processing </a></td>";

                }
                elseif ($record[9]=="canceled"){
                    echo "<td><a class='btn btn-warning' href='#0'> canceled w/o refund </a></td>";

                }
            $count++?>




                </tr>



            <?php endforeach; ?>









            <?php endforeach; ?>






            </tbody>
        </table>
    </div>
</div>

<?php }?>


