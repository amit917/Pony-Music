<table id="allAssetsTable" class="table table-striped table-no-bordered table-hover" cellspacing="0"
       width="100%" style="width:100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($bookings as $booking): ?>
    <tr>
        <td><?= $booking->id ?></td>
        <td><?= $booking->booking_type ?></td>




    </tr>
    <?php endforeach; ?>

    </tbody>
</table>