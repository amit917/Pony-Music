<div class="card">
    <div class="card-header card-header-danger">
        <h4>Edit Client Details</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($client); ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_fname', ['class' => 'form-control','label' => 'First Name:',
                    'placeholder' => 'First Name', 'type'
                    => 'text','required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_lname', ['class' => 'form-control','label' => 'Last Name:',
                    'placeholder' => 'Last Name', 'type'
                    => 'text','required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_phone', ['class' => 'form-control','label' => 'Phone (10 digits):',
                    'placeholder' => 'Phone (10 digits)', 'type'
                    => 'tel','required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_email', ['class' => 'form-control','label' => 'Email:',
                    'placeholder' => 'Email', 'type'
                    => 'email','required' => true]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Rehearsal Clients ',['action' => 'index'],['class'=>'btn btn-default']);?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>