<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>


<div class="card">
    <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
            <i class="material-icons">speaker</i>
        </div>
        <h4 class="card-title">Add a Client</h4>
    </div>
    <div class="card-body">
        <br>


        <?= $this->Form->create($client);
        $myTemplates = [
        'inputContainer' => '
        <div class="form-group">{{content}}</div>
        ',
        'label' => '<label class="bmd-label-floating">{{text}}</label>',
        'input' => '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}}/>',
        'select' => '<select name="{{name}}" class="form-control" {{attrs}}>{{content}}</select>',
        'textarea' => '<textarea class="form-control"
                                 placeholder="If you would like to add any notes to this booking, please write in this field."
                                 rows="2" {{attrs}}>{{value}}</textarea>'
        ];
        $this->Form->setTemplates($myTemplates);?>

        <div>
            <?= $this->Form->control('client_fname', ['label' => 'First Name *', 'required' => true]); ?>
        </div>
        <div>
            <?= $this->Form->control('client_lname', ['label' => 'Last Name *', 'required' => true]); ?>
        </div>


        <div>
            <?= $this->Form->control('client_phone', ['type' => 'number', 'label' => 'Phone *',
            'required' =>
            true]);?>
        </div>
        <div>
            <?= $this->Form->control('client_email', ['label' => 'Email (optional)']);?>
        </div>
        <br>

        <div class="category form-category">* Required fields</div>


    </div>
    <div class="card-footer ">


        <?php echo $this->Html->link('Back',['action'=>'index'],['class'=>'btn btn-default']);?>
        <?php echo $this->Form->button('Add', ['class'=>'btn btn-success pull-right'])?>
        <?php echo $this->Form->end() ?>
    </div>

</div>


