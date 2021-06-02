<table id="searchClientsTable" class="table table-striped table-no-bordered table-hover" cellspacing="0"
       width="100%" style="width:100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($clients as $client): ?>
    <tr>
        <td><?= $client->id ?></td>
        <td><?= $client->client_fname ?></td>
        <td><?= $client->client_lname ?></td>
        <td><?= $client->client_phone ?></td>
        <td><?= $client->client_email ?></td>



    </tr>
    <?php endforeach; ?>

    </tbody>
</table>