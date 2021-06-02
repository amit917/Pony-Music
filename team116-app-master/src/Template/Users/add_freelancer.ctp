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
                <h4 class="card-title">Freelancer Sign Up</h4>
            </div>
            <div class="card-body">
                <br>

                <?= $this->Form->create($user,['name'=>'searchF','onsubmit'=>'return validateForm()']);
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
                <h5>Freelancer Details</h5>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('fname', ['label' => 'First Name *', 'required' => true]); ?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('lname', ['label' => 'Last Name *', 'required' => true]); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('phone', ['type' => 'tel', 'label' => 'Phone *', 'required' =>
                            true]);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('email', ['type' => 'email', 'label' => 'Email (optional)']);?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('password' ,['label' => 'password']);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('confirm_password' ,['type'=>'password','label' => 'confirm_password']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('type', ['type' => 'hidden','value'=>'freelancer']);?>
                    </div>
                </div>
                <div class="category form-category">* Required fields</div>
                <br>
                <hr>
            </div>
            <div class="card-footer ">
                <div>
                    <h6><a href="login">back</a></h6><br>

                    <h6><a href="add">reset</a></h6>
                </div>



                <?php echo $this->Form->submit('Submit', ['class'=>'btn btn-rose'])?>
                <?php echo $this->Form->end() ?>

            </div>


        </div>
    </div>
</div>



<script>


    function validateForm() {

        var fName = document.forms["searchF"]["fname"].value;
        var lName = document.forms["searchF"]["lname"].value;

        //It returns -1 if the argument passed a negative number.
        var cPhone = document.forms["searchF"]["phone"].value;

        var cEmail = document.forms["searchF"]["email"].value;
        var cpasswd = document.forms["searchF"]["password"].value;
        var nPasswd = document.forms["searchF"]["confirm_password"].value;
        if ( fName.length>=10 && fName.length<=2 || lName.length>=10 && lName.length<=2)  {
            alert("please input valid name");
            return false;
        }
        else if(cPhone.length!==10){
            alert("please input correct phone number");
            return false;

        }
        if(cEmail== null || cEmail == ""){
            alert("please input email address!");
            document.forms["searchF"]["client_email"].focus();
            return false;
        }
        var regExp = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
        if(!regExp.test(cEmail)){
            alert("please check your email address!");
            document.forms["searchF"]["client_email"].focus();
            return false;
        }
        if(cpasswd!==nPasswd){
            alert("please check your password!");
            document.forms["searchF"]["password"].focus();
            return false;

        }


    }
</script>

