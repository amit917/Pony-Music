<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-rose card-header-primary">
                <h4 class="card-title">
                    <?= $clients->client_fname." ".$clients->client_lname ?>
                </h4>
                <p class="card-category">

                </p>
            </div>
            <div class="card-body">
                <dt>Name:</dt>
                <dd><?= $clients->client_fname." ".$clients->client_lname ?></dd>
                <dt>Phone:</dt>
                <dd><?= $clients->client_phone ?></dd>
                <dt>Email:</dt>
                <dd><?= $clients->client_email ?></dd>

                <?= $this->Form->button('Edit'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-rose card-header-primary">
                <h4 class="card-title">Bookings</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-hover" id="clientBookingsTable">
                    <thead class="text-info">
                    <th>Type</th>
                    <th>Total Charge</th>
                    <th>Room</th>
                    <th>Actions</th>


                    </thead>
                    <tbody>
                    <?php foreach($client_list as $client): ?>
<td><?= $client->$booking_id?></td>
<?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
