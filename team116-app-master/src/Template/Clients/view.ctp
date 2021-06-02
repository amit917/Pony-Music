<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4>Client Details</h4>
            </div>
            <div class="card-body">
                <dt>Name:</dt>
                <dd><?= $client->client_fname." ".$client->client_lname ?></dd>
                <dt>Phone:</dt>
                <dd><?= $client->client_phone ?></dd>
                <dt>Email:</dt>
                <dd><?= $client->client_email ?></dd>
                <dt>Band:</dt>
                <dd><?php foreach ($bandsList as $band): ?>
                    <?= $band->band_name ?><br>
                    <?php endforeach; ?>
                </dd>
            </div>
            <div class="card-footer">
                <?= $this->Html->link('Edit Profile', ['action'=>'edit', $client->id], ['class'=>'btn btn-primary'])?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4>Rehearsal Bookings</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="clientBookingsTable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Charge</th>
                            <th>Room</th>

                            <th>Status</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($bookingsList as $booking): ?>
                        <tr>
                            
                            <td><?= $booking->booking_date_from ?></td>
                            <td><?= "$".$booking->booking_total_charge ?></td>
                                         <td><?= $room_number[0]['room_number'] ?></td>
                            <?php
                            $id=$booking->id;
                            $status=$booking->status;
                            if($status=="completed"){
                              echo "<td><a class='btn btn-success' href='../../Bookings/rehearsal_booking_detail?BookingId=$id'> Booked</a> </td>";
                            }
                            
                            
                            ?>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $("#clientBookingsTable").DataTable({
            'dom': 't',
            'pageLength': 25,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3]}]
        });
    });
</script>




