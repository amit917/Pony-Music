<div class="card">
    <div class="card-header card-header-info">
        <h4>Edit Asset Details</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($asset) ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('types', ['class' => 'form-control', 'label' => 'Category *:',
                    'type' => 'select', 'placeholder' => 'Category', 'default' => $current_asset_category, 'empty' => $current_asset_category,'options' => $not_current_type, 'required' => true]); ?>
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
                    <?= $this->Form->control('asset_rehearsal_charge', ['class' => 'form-control', 'label' => 'Price ($) *:',
                    'type' => 'text', 'placeholder' => 'Price', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('quantity', ['class' => 'form-control', 'label' => 'Quantity *:', 'type'
                    => 'number',
                    'placeholder' => 'Quantity', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Backline', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>