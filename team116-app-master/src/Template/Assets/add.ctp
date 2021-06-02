<div class="modal" tabindex="-1" role="dialog" id="addAssetTypeModal">

</div>

<div class="card">
    <div class="card-header card-header-info">
        <h4>Add Asset</h4>
    </div>
    <div class="card-body">
        <div hidden>
            <br>
            <p>If you would like to add a new backline category, please create it BEFORE filling out the form below.
                Once doing so, you will be able to select it from the dropdown menu.</p>
            <div align="center">
                <button id="addAssetTypeModalButton" type="button" class="btn btn-primary btn-round btn-sm"
                        data-toggle="modal"
                        data-target="#addAssetTypeModal">
                    Add a New Category
                </button>
            </div>
            <hr class="mb-4">
        </div>
        <?= $this->Form->create($asset) ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('types', ['class' => 'form-control', 'label' => 'Category *:',
                    'type' => 'select', 'placeholder' => 'Category', 'empty' => false, 'required' =>
                    true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('asset_name', ['class' => 'form-control', 'label' => 'Item Name *:', 'type'
                    => 'text',
                    'placeholder' => 'Item Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('asset_rehearsal_charge', ['class' => 'form-control', 'label' => 'Price
                    ($) *:',
                    'type' => 'text', 'placeholder' => 'Price', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('quantity', ['class' => 'form-control', 'label' => 'Quantity *:',
                    'type'
                    => 'number',
                    'placeholder' => 'Quantity', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Backline', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary float-right']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#addAssetTypeModalButton').on('click', function () {
            $('.modal').show();
            $.ajax({
                type: 'get',
                async: true,
                url: "<?php echo $this->Url->build(['controller' => 'asset_types', 'action' => 'add_modal']); ?>",
                success: function (response) {
                    $('.modal').html(response);
                }
            });
        });
    })
</script>
