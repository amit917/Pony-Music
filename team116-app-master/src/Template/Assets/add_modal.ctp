<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add an Asset</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?= $this->Form->create($newAsset, ['id' => 'addAssetForm']);
            $myTemplates = [
            'inputContainer' => '
            <div class="form-group">{{content}}</div>
            ',
            'label' => '<label class="bmd-label-floating">{{text}}</label>',
            'input' => '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}}/>',
            'select' => '<select name="{{name}}" class="form-control selectpicker" data-style="btn btn-link" {{attrs}}>{{content}}</select>',
            'textarea' => '<textarea class="form-control"
                                     placeholder="If you would like to add any notes to this booking, please write in this field."
                                     rows="2" {{attrs}}>{{value}}</textarea>'
            ];
            $this->Form->setTemplates($myTemplates);?>
            <div class="row">
                <div class="col-md">
                    <?= $this->Form->control('asset_type', ['label' => 'Type *', 'required' => true]); ?>
                </div>
                <div class="col-md">
                    <?= $this->Form->control('asset_name', ['label' => 'Name *', 'required' => true]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <?= $this->Form->control('asset_rehearsal_charge', ['type' => 'number', 'label' => 'Rehearsal Price
                    *', 'required' =>
                    true]);?>
                </div>


                <div class="col-md">
                    <?= $this->Form->select('asset_availability', [0, 1], ['empty' => '(choose one)']); ?>

                </div>

            </div>
            <div class="category form-category">* Required fields</div>


        </div>
        <div class="modal-footer">
            <?php echo $this->Form->submit('Save', ['class'=>'btn btn-success pull-right', 'id' => 'saveButton'])?>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#saveButton').on('click', function () {

            var form = $('#addAssetForm');

            let formData = $(form).serialize();


            $.ajax({
                type: 'POST',
                async: true,
                url: "<?php echo $this->Url->build(['controller' => 'assets', 'action' => 'save_modal']); ?>",
                data: formData,
                success: function () {
                    location.reload();

                },
            });
        });
    })
</script>

