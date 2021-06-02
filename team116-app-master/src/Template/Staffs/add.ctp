<div class="card">
    <div class="card-header card-header-rose">
        <h4>Add Staff</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($staff); ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('staff_fname', ['class' => 'form-control', 'label' => 'First Name *:',
                    'type' => 'text', 'placeholder' => 'First Name', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('staff_lname', ['class' => 'form-control', 'label' => 'Last Name *:', 'type'
                    => 'text',
                    'placeholder' => 'Last Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('staff_phone', ['class' => 'form-control', 'label' => 'Phone (10 digits) *:',
                    'type' => 'tel', 'placeholder' => 'Phone', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('staff_email', ['class' => 'form-control', 'label' => 'Email *:', 'type'
                    => 'email',
                    'placeholder' => 'Email', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('staff_code', ['class' => 'form-control', 'label' => 'Staff Code (4 characters max.) *:',
                    'type' => 'tel', 'placeholder' => 'Staff Code', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Staff', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>