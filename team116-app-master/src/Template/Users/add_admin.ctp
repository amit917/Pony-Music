<div class="card">
    <div class="card-header card-header-rose">
        <h4>Add Admin</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($user); ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('fname', ['class' => 'form-control', 'label' => 'First Name *:',
                    'type' => 'text', 'placeholder' => 'First Name', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('lname', ['class' => 'form-control', 'label' => 'Last Name *:', 'type'
                    => 'text',
                    'placeholder' => 'Last Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('phone', ['class' => 'form-control', 'label' => 'Phone (10 digits) *:',
                    'type' => 'tel', 'placeholder' => 'Phone', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email *:', 'type'
                    => 'email',
                    'placeholder' => 'Email', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Password *:',
                    'type' => 'password', 'placeholder' => 'Password', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md" hidden>
                <div class="form-group">
                    <?= $this->Form->control('type', ['class' => 'form-control', 'label' => 'Type *:',
                    'type' => 'test', 'placeholder' => 'Password', 'value' => 'Admin', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Staff', ['controller' => 'staffs', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>