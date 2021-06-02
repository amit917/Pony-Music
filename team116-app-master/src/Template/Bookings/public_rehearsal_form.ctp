<?php
$roomId=$_GET["roomId"];
$roomNumber=$_GET["roomNumber"];
$roomPrice=$_GET["price"];
$roomDate=$_GET["date"];
$roomTimestamp=$_GET["timestamp"];

$a=explode(':',$roomTimestamp);
$c=explode('-',$a[2]);
$b=$a[0].":".$a[1].'-'.$c[1].':'.$a[3];
if($a[0]>=12){
    $a[0]=$a[0]-12;
   
    $c[1]=$c[1]-12;
    $b= $a[0].":".$a[1].'pm'.'-'.$c[1].':'.$a[3].'pm';
}
elseif($a[0]<12){
    if($c[1]<12){
         $b= $a[0].":".$a[1].'am'.'-'.$c[1].':'.$a[3].'am';
        
    }
    else{
        $c[1]=$c[1]-12;
        $b= $a[0].":".$a[1].'am'.'-'.$c[1].':'.$a[3].'pm';
        
    }
   
    
   
}
$d=explode('-',$roomDate);
$e=$d[2].'-'.$d[1].'-'.$d[0];
//date("W",strtotime($d[0].'/'.$d[1].'/'.$d[2]));



?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4>Add a Rehearsal Booking</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($bookings,['name'=>'searchF']); ?>
        <h4>Client Details</h4>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('display_name', ['class' => 'form-control', 'label' => 'Booking Display
                    Name *:',
                    'type' => 'text', 'placeholder' => 'Booking Display Name', 'required' => true]);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('band_name', ['class' => 'form-control', 'label' => 'Band Name *:',
                    'type' => 'text', 'placeholder' => 'Band Name', 'required' => true]);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_fname', ['label' => 'First Name *:',
                    'id'=>'client_fname','required' => true, 'class' => 'form-control',
                    'type' => 'text', 'placeholder' => 'First Name', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_lname', ['label' => 'Last Name *:',
                    'id'=>'client_lname', 'class' => 'form-control',
                    'type' => 'text', 'placeholder' => 'Last Name', 'required' => true]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_phone', ['class' => 'form-control', 'type' => 'phone', 'label' =>
                    'Phone (10 digits) *:', 'placeholder' => 'Phone', 'required' =>
                    true]);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_email', ['class' => 'form-control', 'type' => 'email', 'label' =>
                    'Email *:', 'placeholder' => 'Email', 'required' =>
                    true]);?>
                </div>
            </div>
        </div>
        <div class="category form-category">* Required fields</div>
        <hr class="mb-4">
        <h4>Booking Information</h4>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('Time', ['type' => 'text','label'=>'Booking Time:','value' => "$b", 'class'
                    =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('Date', ['type' => 'text','label'=>'Booking Date:',
                    'value' => "$e",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('booking_total_charge', ['id'=>'btc','type' =>
                    'number','label'=>'Rehearsal Room Price ($):', 'value' => "$roomPrice",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('session_time', ['type' => 'hidden','value' =>
                    "$roomTimestamp", 'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('booking_date_from', ['type' =>
                    'hidden','label'=>'Booking Date', 'value' => "$roomDate",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('room_id', ['type' => 'hidden', 'value' =>
                    "$roomId",'class' =>
                    'form-control']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('booking_date_to', ['type' => 'hidden', 'value' =>
                    "$roomDate",'class' =>
                    'form-control']);?>
                </div>
            </div>
            
        </div>
        <hr class="mb-4">
        <h4>Backline</h4>
        <p>Please check the backline you would like to add to your rehearsal booking.<br>Backline items hidden are unavailable, you were to slow to make your booking and someone else beat you to it.</p>
        <div class="row mb-3">
            
            <div class="col-md">
                
                <h5 class="mb-3">Drums</h5>
                <?php if(isset($drum_list)){?>
                <?php foreach ($drum_list as $drum): ?>
                <div class="input-group">
                    <?= $this->Form->control($drum['id'], [
                    'type' => 'checkbox',
                    'value' => $drum['id'].":".$drum['asset_name']." $".$drum['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$drum['asset_name']." $".$drum['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
                 <?php } 
            else{
            echo "out of stock";}?>
            </div>
           
           
            <div class="col-md">
                
                <h5 class="mb-3">Amplifiers</h5>
                 <?php if(isset($amp_list)){?>
                <?php foreach ($amp_list as $amp): ?>
                <div class="input-group">
                    <?= $this->Form->control($amp['id'], [
                    'type' => 'checkbox',
                    'value' => $amp['id'].":".$amp['asset_name']." $".$amp['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$amp['asset_name']." $".$amp['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
                <?php } 
            else{
            echo "out of stock";}?>
            </div>
            
            <div class="col-md">
                 
                <h5 class="mb-3">Other</h5>
                <?php if(isset($other_list)){?>
                
                <?php foreach ($other_list as $other): ?>
                <div class="input-group">
                    <?= $this->Form->control($other['id'], [
                    'type' => 'checkbox',
                    'value' => $other['id'].":".$other['asset_name']." $".$other['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$other['asset_name']." $".$other['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
                <?php } 
            else{
            echo "out of stock";}?>
            </div>
            
        </div>
        <hr class="mb-4">
        <h5>Notes</h5>
        <p>If you would like to leave a note for Pony Music staff, please add your comments to the text area below.</p>
        <div class="row">
            <div class="col-md">
                <?= $this->Form->control('note', ['type' => 'textarea','class' => 'form-control', 'label' => false,
                'placeholder' => 'Notes']); ?>
            </div>
        </div>

    </div>
    <div class="card-footer ">
        <input type="button" class="btn btn-primary" onclick="validateForm()" onclick="myFunction()"
               value="submit">
    </div>
</div>


<script>
    function myFunction() {
        $("#myModal").modal("show");

        var instruments = document.forms[0];
        var txt = "";
        var i;
        let sum = 0;
        for (i = 0; i < instruments.length; i++) {
            if (instruments[i].checked) {
                let insName = instruments[i].value.split(":");
                let price = insName[1].split("$");
                sum += parseInt(price[1], 10);
                txt = txt + "<h5>" + insName[1] + "</h5>";
            }
        }

        let btc = document.getElementById("btc").value;

        sum += parseInt(btc, 10);

        txt = txt + "<h3>Total price: $" + sum + "</h3>";

        document.getElementById("demo").innerHTML = txt;


        /*document.cookie="txt="+txt;*/


    }
</script>
<div class="modal" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php



                            echo "<h5> Rehearsal room price: $".$roomPrice."</h4>";

                echo "<p id='demo'></p>";
                ?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col">   <?php echo $this->Form->submit('Checkout', ['name'=>'btn','class'=>'btn btn-primary'])?>
                    </div>


                </div>


                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<script>


    function validateForm() {

        var fName = document.forms["searchF"]["client_fname"].value;
        var lName = document.forms["searchF"]["client_lname"].value;


        //It returns -1 if the argument passed a negative number.
        var cPhone = document.forms["searchF"]["client_phone"].value;

        var cEmail = document.forms["searchF"]["client_email"].value;
        var phoneno=/^\d{10}$/;

        if (fName.length >= 10 && fName.length <= 2 || lName.length >= 10 && lName.length <= 2) {
            alert("please input valid name");
            return false;
        } 
        if (cPhone.length !== 10) {
            alert("please input correct phone number");
            return false;

        }
        else if(!cPhone.match(phoneno)) {
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
        myFunction()


    }
</script>
