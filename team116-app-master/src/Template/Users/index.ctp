<div class="card">
    <div class="card-header card-header-rose">
        <h4>Freelancers</h4>
    </div>
    <div class="card-body">
        <div align="center">
            <?= $this->Html->link('Add Freelancer', ['action' => 'add'], ['class'=>'btn btn-primary btn-round btn-sm']) ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="staffTable">
                <thead>
                <tr>
                    <th class="text-left">Email</th>
                    <th class="text-left">Name</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Sign Up Date</th>
                    <th class="td-actions text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="text-left"><?= $user->email ?></td>
                    <td class="text-left"><?= $user->fname.' '.$user->lname ?></td>
                    <td class="text-left"><?= $user->phone ?></td>
                    <td class="text-left"><?= $user->type ?></td>
                    <td class="text-left"><?= $user->created ?></td>


                         <td class="td-actions text-right" style="width:1%; white-space: nowrap;">

                        <?= $this->Html->link(__('View/Edit'), ['controller' => 'users','action' => 'edit',
                        $user->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                     
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
                    title: 'freelancer_list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
    });
</script>