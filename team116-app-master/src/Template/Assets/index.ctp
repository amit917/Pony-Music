<div class="card">
    <div class="card-header card-header-info">
        <h4>Backline</h4>
    </div>
    <div class="card-body">
        <div align="center">
            <?= $this->Html->link('Add Asset', ['action' => 'add'], ['class'=>'btn btn-primary btn-round btn-sm']) ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="backlineTable">
                <thead>
                <tr>
                    <th class="text-left">Category</th>
                    <th class="text-left">Item Name</th>
                    <th class="text-right">Rehearsal Price</th>
                    <th class="text-right">Quantity</th>
                    <th class="td-actions text-right">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($assets as $type): ?>
                <tr>
                    <?php foreach($type['assets'] as $curr): ?>
                    <td class="text-left"><?= $type->asset_type ?></td>
                    <td class="text-left"><?= $curr->asset_name ?></td>
                    <td class="text-right"><?= "$".$curr->asset_rehearsal_charge ?></td>
                    <td class="text-right"><?= $curr->quantity ?></td>
                   <td class="td-actions text-right" style="width:1%; white-space: nowrap;">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $curr->id], ['class'=>'btn-primary
                        btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $curr->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $curr->id],
                        ['class'=>'btn-danger
                        btn-sm','confirm' =>
                        __('Are you sure you want to delete'.' '.$curr->asset_name.'?', $curr->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#backlineTable").DataTable({
            'pageLength': 25,
            'columnDefs': [
                {'orderable': false, 'targets': [2, 3, 4]}],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'backline_list',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
    });
</script>
