<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-info">
                <h4>Asset Details</h4>
            </div>
            <div class="card-body">
                <dt>Category:</dt>
                <dd><?= $asset->asset_type ?></dd>
                <dt>Item Name:</dt>
                <dd> <?= $asset->asset_name ?></dd>
                <dt>Rehearsal Price:</dt>
                <dd><?= "$".$asset->asset_rehearsal_charge ?></dd>
                <dt>Quantity on Hand:</dt>
                <dd><?= $asset->quantity ?></dd>

            </div>
            <div class="card-footer">
                <?= $this->Html->link('Edit Details', ['action'=>'edit', $asset->id], ['class'=>'btn btn-primary'])?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-info">
                <h4>Related Bookings</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="relatedBookingsTable">
                        <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Booking Date</th>
                            <th>Booking Session</th>
                            <th>Band Name</th>
                            <th>Booking Name</th>
                        </thead>
                        <tbody>
                        <?php foreach ($asset->bookings as $bookings): ?>
                        <tr>
                            <?php $bDate=explode('/',$bookings->booking_date_from);
                            $m=$bDate[0];
                            $d=$bDate[1];
                            $y=$bDate[2];
                            $conn=\Cake\Datasource\ConnectionManager::get('default');
                            $sql=$conn->execute("select b.band_name from clients inner join bands_clients bc on clients.id = bc.client_id 
    inner join bands b on bc.band_id = b.id 
    inner join bookings_clients c on clients.id = c.client_id 
    inner join bookings bo on c.booking_id = bo.id
    where bo.id=$bookings->id");
                            $stmt = $conn->execute("select room_number from rooms where id=$bookings->room_id");
                            
                           
                            
                            ?>
                            <td><?= $stmt->fetch()[0]; ?></td>
                            <td><?= $d.'/'.$m.'/'.$y ?></td>
                            <td><?= $bookings->booking_session ?></td>
                            <td><?= $sql->fetch()[0]; ?></td>
                            <td><?= $bookings->display_name ?></td>
                            
                            
                            
                            
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
        $("#relatedBookingsTable").DataTable({
            'pageLength': 25,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3]}]
        });
    });
</script>