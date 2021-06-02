<div class="card">
    <div class="card-header card-header-danger">
        <h4>Rehearsal Clients</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="clientsTable">
                <thead>
                <tr>
                    <th class="text-left">First Name</th>
                    <th class="text-left">Last Name</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Band</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($clients as $client): ?>
                <tr>
                    <td class="text-left"><?= $client->client_fname ?></td>
                    <td class="text-left"><?= $client->client_lname ?></td>
                    <td class="text-left"><?= $client->client_phone?></td>
                    <td class="text-left"><?= $client->client_email?></td>
                    <?php if (!empty($client->bands[0])): ?>
                    <td class="text-left"><?= $client->bands[0]['band_name']?></td>
                    <td class="td-actions text-right" style="width:1%; white-space: nowrap;">
                        <?= $this->Html->link('View', ['action' => 'view', $client->id], ['class'=>'btn-primary
                        btn-sm']) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $client->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id],
                        ['class'=>'btn-danger
                        btn-sm','confirm' =>
                        __('Are you sure you want to delete'.' '.$client->client_fname.' '.$client->client_lname.'?',
                        $client->id)]) ?>

                    </td>
                    <?php elseif (empty($client->bands[0])): ?>
                    <td class="text-left"></td>
                    <td class="td-actions text-right" style="width:1%; white-space: nowrap;">
                        <?= $this->Html->link('View', ['action' => 'view', $client->id], ['class'=>'btn-primary
                        btn-sm']) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $client->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->id],
                        ['class'=>'btn-danger
                        btn-sm','confirm' =>
                        __('Are you sure you want to delete'.' '.$client->client_fname.' '.$client->client_lname.'?',
                        $client->id)]) ?>
                    </td>
                    <?php endif; ?>

                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#clientsTable').DataTable({
            'pageLength': 50,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Pony Music Clients + Bookings',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
    });

</script>


