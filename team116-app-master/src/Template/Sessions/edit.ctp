<div class="card">
    <div class="card-header card-header-success">
        <h4><?= $cardTitle. ' ' .'Session Times'; ?></h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($session) ?>
        <h5>Night</h5>
        <div class="row">
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('session_night_start' ,['class' => 'form-control','type' => 'time', 'label' => 'Start:','placeholder' => 'Start','required' =>
                    true]);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('session_night_end' ,['class' => 'form-control','type' => 'time','label' => 'End:','placeholder' => 'End', 'required'
                    =>
                    true]);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('session_night_charge', ['class' => 'form-control','type' => 'number', 'label' => 'Price ($):','placeholder' => 'Price',
                    'required' =>
                    true]);?>
                </div>
            </div>
        </div>
     <hr class="mb-4">
        <h5>Day</h5>
        <div class="row">
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('session_day_start', ['class' => 'form-control','type' => 'time','label' => 'Start:', 'placeholder' => 'Start','required'
                    =>
                    true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group bmd-form-group">
                    <?= $this->Form->control('session_day_end', ['class' => 'form-control','type' => 'time','label' => 'End:', 'placeholder' => 'End','required' =>
                    true]);
                    ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('session_day_charge', ['class' => 'form-control','type' => 'number', 'label' => 'Price ($):','placeholder' => 'Price',
                    'required' =>
                    true]);?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= $this->Html->link('Back to Sessions', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>