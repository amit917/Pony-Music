<?php
$roomId=$_GET["roomId"];
$roomNumber=$_GET["roomNumber"];
$roomPrice=$_GET["price"];
$roomDate=$_GET["date"];
$roomTimestamp=$_GET["timestamp"];
$a=explode(':',$roomTimestamp);
$c=explode('-',$a[2]);
$b=$a[0].":".$a[1].'-'.$c[1].':'.$a[3];
$d=explode('-',$roomDate);
$e=$d[1].'-'.$d[2].'-'.$d[0];



?>
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">Add a Booking</h4>
            </div>
            <div class="card-body">
                <br>


                <?= $this->Form->create($bookings,['name'=>'searchF']);
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
                <h5>Client Details</h5>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('display_name', [ 'label' => 'Booking Display Name *', 'required' =>
                            true]);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('band_name', [ 'label' => 'Band Name *']);?>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('client_fname', ['label' => 'First Name *', 'required' => true]); ?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('client_lname', ['label' => 'Last Name *', 'required' => true]); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('client_phone', ['type' => 'tel', 'label' => 'Phone *', 'required' =>
                            true]);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('client_email', ['type' => 'email', 'label' => 'Email *', 'required' =>
                            true]);?>
                    </div>

                </div>
                <div class="category form-category">* Required fields</div>
                <br>
                <hr>

                <h5>Booking Information</h5>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('Time', ['type' => 'text','label'=>'Booking Time','value' => "$b", 'class' =>
                            'form-control','readonly']);?>
                    </div>
                    <div class="col-md"><?= $this->Form->control('Date', ['type' => 'text','label'=>'Booking Date', 'value' => "$e",'class' =>
                            'form-control','readonly']);?>
                    </div>

                    <div class="col-md"><?= $this->Form->control('booking_total_charge', ['id'=>'btc','type' => 'number', 'value' => "$roomPrice",'class' =>
                            'form-control','readonly']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md"><?= $this->Form->control('session_time', ['type' => 'hidden','value' => "$roomTimestamp", 'class' =>
                            'form-control','readonly']);?>
                    </div>
                    <div class="col-md"><?= $this->Form->control('booking_date_from', ['type' => 'hidden','label'=>'Booking Date', 'value' => "$roomDate",'class' =>
                            'form-control','readonly']);?>
                    </div>



                    <div class="col-md"><?= $this->Form->control('room_id', ['type' => 'hidden', 'value' => "$roomId",'class' =>
                            'form-control']);?>
                    </div>
                    <div class="col-md"><?= $this->Form->control('booking_date_to', ['type' => 'hidden', 'value' => "$roomDate",'class' =>
                            'form-control']);?>
                    </div>

                </div>

                <br>
                <h5>Backline</h5>
                <div class="row">
                    <div class="col">
                        <?php $assetList = array();

                        foreach ($assets as $index=>$asset):?>
                            <?= $this->Form->control($asset, ['name'=>'instruments[]','value'=>$index.":".$asset,'type' => 'checkbox']);?>

                        <?php endforeach; ?>
                    </div>

                </div>


                <br>

                <h5>Notes</h5>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('notes', ['type' => 'text','class' => 'form-control']); ?>
                    </div>
                </div>


            </div>
            <div class="card-footer ">

                <input type="button" onclick="validateForm()" onclick="myFunction()" value="submit">


            </div>

        </div>



        <!-- End of Booking Form card -->

        <!-- Booking summary card start -->


        <!-- Booking summary card end -->
    </div>
</div>
<script>
    function myFunction()
    {
        $("#myModal").modal("show");

        var instruments = document.forms[0];
        var txt = "";
        var i;
        let sum=0;
        for (i = 0; i < instruments.length; i++) {
            if (instruments[i].checked) {
                let insName=instruments[i].value.split(":");
                let price=insName[1].split("$");
                sum+=parseInt(price[1],10);
                txt = txt +"<h5>"+ insName[1] + "</h5>";
            }
        }

        let btc=document.getElementById("btc").value;

        sum+=parseInt(btc,10);

        txt = txt +"<h3>Total price: $"+sum+"</h3>";

        document.getElementById("demo").innerHTML = txt;





        /*document.cookie="txt="+txt;*/


    }
</script>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Checkout</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->

            <div class="row">
                <div class="col-md-11">

                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">event_note</i>
                            </div>
                            <h4 class="card-title">Booking detail</h4>
                        </div>
                        <div class="card-body">

                            <?php



                            echo "<h4> Rehearsal room price: $".$roomPrice."</h4><br>";

                            echo "<p id='demo'></p>";
                            ?>


                            <?php echo $this->Form->submit('Checkout', ['class'=>'btn btn-rose'])?>
                            <?php echo $this->Form->end() ?>



                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>


<script>


    function validateForm() {

        var fName = document.forms["searchF"]["client_fname"].value;
        var lName = document.forms["searchF"]["client_lname"].value;


        //It returns -1 if the argument passed a negative number.
        var cPhone = document.forms["searchF"]["client_phone"].value;

        var cEmail = document.forms["searchF"]["client_email"].value;

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
        myFunction()



    }
</script>
