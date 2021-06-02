<div class="card">
    <div class="card-header card-header-rose">
        <h4>Staff Member Details</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($staff) ?>
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
        <hr class="mb-4">
        <div>
            <?= $this->Html->link('Back to Staff', ['action' => 'index'], ['class' => 'btn btn-default float-left']) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary float-right']) ?>
            <?= $this->Form->end() ?>
            <?= $this->Form->postLink(__('Delete'), ['controller' => 'staffs','action' => 'delete',
                                $staff->id],
                                ['class'=>'btn btn-danger
                                float-left', 'confirm' => __('Are you sure you want to delete'.' '.$staff->staff_fname.' '.$staff->staff_lname.'?', $staff->id)]) ?> 
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


    }
</script>

