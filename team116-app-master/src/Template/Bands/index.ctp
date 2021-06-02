<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band[]|\Cake\Collection\CollectionInterface $bands
 */
?>



<div style="overflow: hidden" class="row">
    <div class="col-md">
    <?= $this->Form->control('Search'); ?>
    </div>
    <div class="col-md">
    <?= $this->Html->link('Add Band', ['action' => 'add'], ['class' => 'btn btn-info float-right']) ?>
    </div>
</div>
<div>
    <div class="card">
        <div class="card-header card-header-info card-header-primary">
            <h4 class="card-title text-center">
                Band List
            </h4>

        </div>
        <div class="card-body">

            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="table-content">
                <table id="allAssetsTable" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                       width="100%" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="td-actions text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($bands as $band): ?>
                    <tr>
                        <td><?= $band->id ?></td>
                        <td><?= $band->band_name ?></td>

                        <td class="td-actions text-right">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $band->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $band->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $band->id], ['confirm' =>
                            __('Are you sure you want to delete'.$band->band_name.'?', $band->id)]) ?>
                        </td>

                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    $('document').ready(function () {
        $('#search').keyup(function () {
            var searchkey = $(this).val();
            searchTags(searchkey);
        });

        function searchTags(keyword) {
            var data = keyword;
            $.ajax({
                method: 'GET',
                url: "<?php echo $this->Url->build(['controller' => 'Bands', 'action' => 'Search']); ?>",
                data: {keyword: data},
                success: function (response) {
                    $('.table-content').html(response);
                }
            });
        };
    });
</script>

