<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">

            Rehearsal Bookings List

        </h4>
        <p class="card-category">

        </p>
    </div>


    <div class="card-body table-responsive">
        <table class="table table-hover" id="allClientsTable">
            <thead class="text-info">
            <th>Rehearsal Rooms</th>
            <th>Booking Date</th>
            <th>Booking Session</th>
            <th>Band Name</th>
            <th>Extra Assets</th>
            <th>Booking Charge</th>
            <th>More</th>



            </thead>
            <tbody>

                <?php
                $conn=\Cake\Datasource\ConnectionManager::get('default');
                $details=$conn->execute("select * from bookings 
                                    inner join bookings_clients bc on bookings.id = bc.booking_id
                                    inner join clients c on bc.client_id = c.id
                                    inner join rooms r on bookings.room_id = r.id
                                    inner join room_usages ru on r.id = ru.room_id
                                    where user_id=$userId");
                foreach ($details->fetchAll() as $detail):
                    echo"<tr>";

                echo "<th>".$detail[17]."</th>";
                echo "<th>".$detail[3]."</th>";
                    echo "<th>".$detail[23]."</th>";
                    echo "<th>".$detail[12].$detail[13]."</th>";
                     $assets=$conn->execute("select asset_name from assets_bookings 
                                                inner join bookings b on assets_bookings.booking_id = b.id
                                                inner join assets a on assets_bookings.asset_id = a.id
                                                where booking_id=$detail[0]");
                     echo "<th>";


                 foreach ($assets->fetchAll() as $asset):

                     echo $asset[0]."<br>";
                 endforeach;
                 echo"</td>";
                    echo "<th>".$detail[2]."</th>";
                    echo"<th> Edit </th>";

                    echo"</tr>";

                endforeach;


                ?>

            </tbody>
        </table>
    </div>
</div>
