<div class="card card-nav-tabs">
    <div class="card-header card-header-warning">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#all" data-toggle="tab">
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#confirmed" data-toggle="tab">
                            Confirmed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pending" data-toggle="tab">
                            Pending
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cancelled" data-toggle="tab">
                            Cancelled
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="statusFilter"></div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="allTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Display Name</th>
                            <th class="text-left">Band Name</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-left">Notes</th>
                            <th class="text-left">Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($allBookings as $curr): ?>
                        <tr>
                            <td class="text-left"><?= $curr->client_fname ?></td>
                            <td class="text-left"><?= $curr->client_lname ?></td>
                            <td class="text-left"><?= $curr->client_phone?></td>
                            <td class="text-left"><?= $curr->client_email?></td>
                            <td class="text-left"><?= $curr->display_name?></td>
                            <td class="text-left"><?= $curr->band_name?></td>
                            <td class="text-left"><?= $curr->start_event?></td>
                            <td class="text-left"><?= $curr->end_event?></td>
                            <td class="text-left"><?= $curr->notes?></td>
                            <?php if ($curr['status'] == 'Confirmed'): ?>
                            <td class="text-left bg-success"><?= $curr->status?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'events', 'action' => 'view',
                                $curr->id],
                                ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
                            <?php elseif ($curr['status'] == 'Pending'): ?>
                            <td class="text-left bg-warning"><?= $curr->status?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'quotes', 'action' => 'view',
                                $curr->id],
                                ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
                            <?php elseif ($curr['status'] == 'Cancelled'): ?>
                            <td class="text-left bg-danger"><?= $curr->status?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'cancelled_bookings', 'action' =>
                                'view', $curr->id],
                                ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="confirmed">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="confirmedTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Display Name</th>
                            <th class="text-left">Band Name</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-left">Notes</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($confirmed as $curr): ?>
                        <tr>
                            <td class="text-left"><?= $curr->client_fname ?></td>
                            <td class="text-left"><?= $curr->client_lname ?></td>
                            <td class="text-left"><?= $curr->client_phone?></td>
                            <td class="text-left"><?= $curr->client_email?></td>
                            <td class="text-left"><?= $curr->display_name?></td>
                            <td class="text-left"><?= $curr->band_name?></td>
                            <td class="text-left"><?= $curr->start_event?></td>
                            <td class="text-left"><?= $curr->end_event?></td>
                            <td class="text-left"><?= $curr->notes?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['action' => 'view', $curr->id],
                                ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="pending">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="pendingTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Display Name</th>
                            <th class="text-left">Band Name</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-left">Notes</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pending as $curr): ?>
                        <tr>
                            <td class="text-left"><?= $curr->client_fname ?></td>
                            <td class="text-left"><?= $curr->client_lname ?></td>
                            <td class="text-left"><?= $curr->client_phone?></td>
                            <td class="text-left"><?= $curr->client_email?></td>
                            <td class="text-left"><?= $curr->display_name?></td>
                            <td class="text-left"><?= $curr->band_name?></td>
                            <td class="text-left"><?= $curr->start_event?></td>
                            <td class="text-left"><?= $curr->end_event?></td>
                            <td class="text-left"><?= $curr->notes?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'quotes', 'action' => 'view',
                                $curr->id], ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="cancelled">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="cancelledTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Display Name</th>
                            <th class="text-left">Band Name</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-left">Notes</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cancelled as $curr): ?>
                        <tr>
                            <td class="text-left"><?= $curr->client_fname ?></td>
                            <td class="text-left"><?= $curr->client_lname ?></td>
                            <td class="text-left"><?= $curr->client_phone?></td>
                            <td class="text-left"><?= $curr->client_email?></td>
                            <td class="text-left"><?= $curr->display_name?></td>
                            <td class="text-left"><?= $curr->band_name?></td>
                            <td class="text-left"><?= $curr->start_event?></td>
                            <td class="text-left"><?= $curr->end_event?></td>
                            <td class="text-left"><?= $curr->notes?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'cancelled_bookings', 'action' =>
                                'view',
                                $curr->id], ['class'=>'btn-warning
                                btn-sm'])
                                ?>
                            </td>
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
        $("#allTable").DataTable({
            initComplete: function () {
                this.api().columns([9]).every(function () {
                    var column = this;
                    var select = $('<select><option value="">Show All</option></select>')
                        .appendTo( $(column.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
            'pageLength': 100,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5, 8, 9, 10]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'all_recordings',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }
            ]
        });
        $("#confirmedTable").DataTable({
            'pageLength': 50,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5, 8, 9]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'confirmed_recordings',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ]
        });
        $("#pendingTable").DataTable({
            'pageLength': 50,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5, 8, 9]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'pending_recordings',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ]
        });
        $("#cancelledTable").DataTable({
            'pageLength': 50,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5, 8, 9]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'cancelled_recordings',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ]
        });
    });
</script>