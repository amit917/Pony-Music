<div class="card card-nav-tabs">
    <div class="card-header card-header-rose">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                        <a class="nav-link active" href="#all" data-toggle="tab">
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#staff" data-toggle="tab">
                            Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#admin" data-toggle="tab">
                            Admins
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div align="center">
            <?= $this->Html->link('Add Staff Member', ['action' => 'add'], ['class'=>'btn btn-primary btn-round btn-sm']) ?>
            <?= $this->Html->link('Add Admin', ['controller' => 'users', 'action' => 'add_admin'], ['class'=>'btn btn-primary btn-round btn-sm']) ?>
        </div>
        <div id="statusFilter"></div>
        <div class="tab-content">
             <div class="tab-pane active" id="all">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="allTable">
                        <thead>
                        <tr>
                            <th class="text-left">User Type</th>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="td-actions text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($staffs as $staff): ?>
                        <tr>
                            <td class="text-left"><?= "Staff" ?></td>
                            <td class="text-left"><?= $staff->staff_fname ?></td>
                            <td class="text-left"><?= $staff->staff_lname ?></td>
                            <td class="text-left"><?= $staff->staff_phone ?></td>
                            <td class="text-left"><?= $staff->staff_email ?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link(__('View/Edit'), ['controller' => 'staffs', 'action' =>'edit', $staff->id], ['class'=>'btn-warning
                                btn-sm']) ?>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php foreach ($admins as $curr): ?>
                        <tr>
                            <td class="text-left"><?= "Admin"?></td>
                            <td class="text-left"><?= $curr->fname ?></td>
                            <td class="text-left"><?= $curr->lname ?></td>
                            <td class="text-left"><?= $curr->phone?></td>
                            <td class="text-left"><?= $curr->email?></td>
                            <td class="td-actions text-right">
                                <?= $this->Html->link('View/Edit', ['controller' => 'users', 'action' => 'edit_admin', $curr->id],
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
            <div class="tab-pane" id="staff">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="staffTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Staff Code</th>
                            <th class="td-actions text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($staffs as $staff): ?>
                        <tr>
                            <td class="text-left"><?= $staff->staff_fname ?></td>
                            <td class="text-left"><?= $staff->staff_lname ?></td>
                            <td class="text-left"><?= $staff->staff_phone ?></td>
                            <td class="text-left"><?= $staff->staff_email ?></td>
                            <td class="text-left"><?= $staff->staff_code ?></td>
                               <td class="td-actions text-right" style="width:1%; white-space: nowrap;">
                                <?= $this->Html->link(__('View/Edit'), ['controller' => 'staffs', 'action' =>'edit', $staff->id], ['class'=>'btn-warning
                                btn-sm']) ?>
                               
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="admin">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless" id="adminTable">
                        <thead>
                        <tr>
                            <th class="text-left">First Name</th>
                            <th class="text-left">Last Name</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Created On</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($admins as $curr): ?>
                        <tr>
                            <td class="text-left"><?= $curr->fname ?></td>
                            <td class="text-left"><?= $curr->lname ?></td>
                            <td class="text-left"><?= $curr->phone?></td>
                            <td class="text-left"><?= $curr->email?></td>
                            <td class="text-left"><?= $curr->created?></td>
                            <td class="td-actions text-right" style="width:1%; white-space: nowrap;">
                                <?= $this->Html->link('View/Edit', ['controller' => 'users', 'action' => 'edit_admin', $curr->id],
                                ['class'=>'btn-warning
                                btn-sm'])
                                ?></td>
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
            'pageLength': 25,
            'columnDefs': [
                {'orderable': false, 'targets': [0, 3, 4, 5]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'all_list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
        $("#staffTable").DataTable({
            'pageLength': 25,
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
        $("#adminTable").DataTable({
            'pageLength': 25,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4, 5]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'admin_list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
    });
</script>