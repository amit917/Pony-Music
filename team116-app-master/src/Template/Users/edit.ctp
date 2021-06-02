<div class="card">
    <div class="card-header card-header-rose">
        <h4>Edit Freelancer</h4>
    </div>
    <div class="card-body">
        <p> Delete doesn't work yet</p>
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
            <div class="col-md">
                <div class="form-group" hidden>
                       <?= $this->Form->control('type', ['class' => 'form-control', 'label' => 'Type *:',
            'type' => 'text', 'placeholder' => 'Type', 'value' => 'Freelancer', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
             <hr class="mb-4">
        <div>
            <?= $this->Html->link('Back to Freelancers', ['action' => 'index'], ['class' => 'btn btn-default float-left']) ?>
           
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary float-right']) ?>
            <?= $this->Form->end() ?>
    <?= $this->Form->postLink(__('Delete'), ['controller' => 'users','action' => 'delete',
            $user->id],
            ['class'=>'btn btn-danger float-left', 'confirm' => __('Are you sure you want to delete'.' '.$user->fname.' '.$user->lname.'?', $user->id)]) ?>
        </div>
    </div>
    
    
    <div class="card-footer">
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
        if (fName.length >= 10 && fName.length <= 2 || lName.length >= 10 && lName.length <= 2) {
            alert("please input valid name");
            return false;
        } else if (cPhone.length !== 10) {
            alert("please input correct phone number");
            return false;

        }
        if (cEmail == null || cEmail == "") {
            alert("please input email address!");
            document.forms["searchF"]["client_email"].focus();
            return false;
        }
        var regExp = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
        if (!regExp.test(cEmail)) {
            alert("please check your email address!");
            document.forms["searchF"]["client_email"].focus();
            return false;
        }
        if (cpasswd !== nPasswd) {
            alert("please check your password!");
            document.forms["searchF"]["password"].focus();
            return false;

        }


    }
</script>