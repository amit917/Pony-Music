<div class="card">
    <div class="card-header card-header-warning">
        <h4>Recording Client Details</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($event); ?>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('display_name', ['class' => 'form-control', 'label' => 'Display Name:',
                    'type'
                    => 'text', 'placeholder'
                    => 'Display Name', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('band_name', ['class' => 'form-control', 'label' => 'Band Name:', 'type'
                    => 'text',
                    'placeholder' => 'Band Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_fname', ['class' => 'form-control', 'label' => 'First Name:',
                    'type'
                    => 'text', 'placeholder'
                    => 'First Name', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_lname', ['class' => 'form-control', 'label' => 'Last Name:', 'type'
                    => 'text',
                    'placeholder' => 'Last Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">

                    <?= $this->Form->control('client_phone', ['class' => 'form-control', 'label' => 'Phone:', 'type' =>
                    'tel', 'placeholder' => 'Phone',
                    'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_email', ['class' => 'form-control', 'label' => 'Email:', 'type' =>
                    'email', 'placeholder' => 'Email',
                    'required' => true]); ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('start_event', ['class' => 'form-control', 'label' => 'Start Date:', 'type'
                    =>
                    'date', 'placeholder' => 'Start Date',
                    'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('end_event', ['class' => 'form-control datetimepicker-input', 'label' => 'End Date:', 'type' =>
                    'date', 'placeholder' => 'End Date',
                    'required' => true]); ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <?= $this->Form->control('notes', ['class' => 'form-control', 'label' => 'Notes:', 'type' =>
            'textarea', 'placeholder' => 'Notes', 'rows' => 20]); ?>
        </div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Recording Clients',['action' => 'index'],['class'=>'btn btn-default']);?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>