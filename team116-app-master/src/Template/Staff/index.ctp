<div class="card">
    <div class="card-header card-header-rose">
        <h4>Staff</h4>
    </div>
    <div class="card-body">
        <div align="center">
            <?= $this->Html->link('Add Staff', ['action' => 'add'], ['class'=>'btn btn-primary btn-round btn-sm']) ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="staffTable">
                <thead>
                <tr>
                    <th class="text-left">First Name</th>
                    <th class="text-left">Last Name</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Email</th>
                    <th class="text-right">Staff Code</th>
                    <th class="td-actions text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($staffs as $staff): ?>
                <tr>
                    <td><?= $staff->staff_fname ?></td>
                    <td><?= $staff->staff_lname ?></td>
                    <td><?= $staff->staff_phone ?></td>
                    <td><?= $staff->staff_email ?></td>
                    <td><?= $staff->staff_code ?></td>
                    <td class="td-actions text-right">
                        <?= $this->Html->link(__('View/Edit'), ['controller' => 'staffs', 'action' =>'edit', $staff->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'users','action' => 'delete',
                        $staff->id],
                        ['class'=>'btn-danger
                        btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#staffTable").DataTable({
            'pageLength': 10,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'staff_list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
    });
</script>