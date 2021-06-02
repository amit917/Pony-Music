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
<td><a class='btn btn-default' href='../../Bookings/cancel_booking_list'> Canceled W/O Refund List</a> </td>
