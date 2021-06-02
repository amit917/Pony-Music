<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">Forgot Password</h4>
            </div>
            <div class="card-body">
                <br>

                <?= $this->Form->create();
                $myTemplates = [
                    'inputContainer' => '
                <div class="form-group">{{content}}</div>
                ',
                    'label' => '<label class="bmd-label-floating">{{text}}</label>',
                    'input' => '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}}/>',
                    'textarea' => '<textarea class="form-control"
                                         placeholder="If you would like to add any notes to this booking, please write in this field."
                                         rows="2" {{attrs}}>{{value}}</textarea>'
                ];
                $this->Form->setTemplates($myTemplates);?>


                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('email', ['type' => 'email','label' => 'Email *', 'required' => true]); ?>
                    </div>

                </div>


            <div class="card-footer ">

                <?php echo $this->Html->link('login', ['action'=>'login'],['class'=>'btn btn-rose'])?>




                <?php echo $this->Form->submit('Reset password', ['class'=>'btn btn-rose'])?>
                <?php echo $this->Form->end() ?>

            </div>


        </div>
    </div>
</div>



