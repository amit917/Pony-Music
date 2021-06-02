<?php
$BookingId=$_GET['BookingId'];
$conn = \Cake\Datasource\ConnectionManager::get('default');
$delete=$conn->execute("delete from request_assets_bookings where bookings_id=$BookingId");


function checkAssets($a,$b){

$conn = \Cake\Datasource\ConnectionManager::get('default');


$sql=$conn->execute("select * from assets_bookings where asset_id=$a and booking_id=$b");
$abc=$sql->fetch();


if($abc){

return 'checked';
}
else{
return'';
}
}


?>


<div class="card text-left">
    <div class="card-header card-header-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#0">Booking Detail</a>

            </li>


        </ul>
    </div>
    <div class="card-body">

        <?php



        $stmt = $conn
            ->execute(" select
        display_name,client_fname,client_lname,client_phone,client_email,booking_session,booking_date_from,booking_total_charge,staff_code,room_number,bookings.id,ru.id,band_name
        from bookings inner join rooms r on bookings.room_id = r.id inner join bookings_clients bc on bookings.id =
        bc.booking_id inner join clients c on bc.client_id = c.id inner join room_usages ru on bookings.id =
        ru.booking_id inner join bands_clients b on c.id = b.client_id
                      inner join bands b2 on b.band_id = b2.id
        where
        bookings.id=$BookingId");
        $fullDetail=$stmt->fetch();
    
        $a=explode('-',$fullDetail[6])[0];
        $b=explode('-',$fullDetail[6])[1];
        $c=explode('-',$fullDetail[6])[2];
        $fullDetail[6]=$c.'-'.$b.'-'.$a;
        


        ?>
        <br>


        <?= $this->Form->create($bookings,['name'=>'searchF']);?>
        <h5>Client Details</h5>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('display_name', ['class' => 'form-control', 'label' => 'Display Name
                    *:','value'=>"$fullDetail[0]",'readonly','required' =>
                    true]);?>

                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('band_name', ['class' => 'form-control', 'label' => 'Band Name
                    *:','value'=>"$fullDetail[12]",'readonly']);?>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_fname', ['class' => 'form-control', 'label' => 'First Name
                    *:','value'=>"$fullDetail[1]",'readonly', 'required' => true]); ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_lname', ['class' => 'form-control', 'label' => 'Last Name
                    *:','value'=>"$fullDetail[2]",'readonly',
                    'required' => true]); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_phone', ['class' => 'form-control', 'type' =>
                    'tel','value'=>"$fullDetail[3]", 'label' => 'Phone (10 digits) *:','readonly', 'required' =>
                    true]);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <?= $this->Form->control('client_email', ['class' => 'form-control', 'type' =>
                    'email','value'=>"$fullDetail[4]", 'label' => 'Email
                    *:','readonly', 'required' =>
                    true]);?>
                </div>
            </div>

        </div>
        <div class="category form-category">* Required fields</div>
        <br>
        <hr>

        <h5>Booking Information</h5>
        <div class="row">
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('session_time', ['class' => 'form-control', 'label' =>
                    'Session Time:','type' =>
                    'text','value' => "$fullDetail[5]",
                    'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                
                <div class="form-group"><?= $this->Form->control('booking_date_from', ['class' => 'form-control',
                    'label' => 'Booking Date:','type'
                    => 'text',
                    'value' => "$fullDetail[6]",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>

            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('booking_total_charge', ['class' => 'form-control',
                    'label' => 'Total Booking Charge ($):',
                    'id'=>'btc','type' => 'number',
                    'value' => "$fullDetail[7]",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('room_number', ['class' => 'form-control', 'label' =>
                    'Room Number:', 'value' =>
                    "$fullDetail[9]",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('staff_code', ['class' => 'form-control','label' =>
                    'Staff Code:',
                    'id'=>'staff_code','type' => 'text','readonly',
                    'value' => "$fullDetail[8]",'class' => 'form-control','required' =>
                    true]);?>
                </div>
            </div>

        </div>
        <div class="row">
            <?php
            $currentTotalPrice=0;
            $sql=$conn->execute("select asset_rehearsal_charge from assets_bookings inner join assets a on
            assets_bookings.asset_id = a.id where booking_id=$BookingId");

            foreach ($sql->fetchAll() as $price){

            $currentTotalPrice+=$price[0];
            }?>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('actual_price', ['class' => 'form-control', 'type' =>
                    'hidden', 'value' =>
                    "$currentTotalPrice",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group"><?= $this->Form->control('booking_id', ['class' => 'form-control', 'type' =>
                    'hidden', 'value' =>
                    "$BookingId",'class' =>
                    'form-control','readonly']);?>
                </div>
            </div>
        </div>

        <hr class="mb-4">

        <h5>Backline</h5>
        <p>Please check the backline you would like to add to your rehearsal booking.</p>
        <div class="row mb-3">
            <div class="col-md">
                <h5 class="mb-3">Drums</h5>
                <?php foreach ($drum_list as $drum): ?>
                <div class="input-group">
                    <?= $this->Form->control($drum['id'], [
                    checkAssets($drum['id'],$fullDetail[10]),
                    'type' => 'checkbox',
                    'value' => $drum['id'].":".$drum['asset_name']." $".$drum['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$drum['asset_name']." $".$drum['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md">
                <h5 class="mb-3">Amplifiers</h5>
                <?php foreach ($amp_list as $amp): ?>
                <div class="input-group">
                    <?= $this->Form->control($amp['id'], [
                    checkAssets($amp['id'],$fullDetail[10]),
                    'type' => 'checkbox',
                    'value' => $amp['id'].":".$amp['asset_name']." $".$amp['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$amp['asset_name']." $".$amp['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md">
                <h5 class="mb-3">Other</h5>
                <?php foreach ($other_list as $other): ?>
                <div class="input-group">
                    <?= $this->Form->control($other['id'], [
                    checkAssets($other['id'],$fullDetail[10]),
                    'type' => 'checkbox',
                    'value' => $other['id'].":".$other['asset_name']." $".$other['asset_rehearsal_charge'],
                    'name' => 'instruments[]',
                    'hiddenField' => false,
                    'label' => " ".$other['asset_name']." $".$other['asset_rehearsal_charge']]) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <hr class="mb-4">
        <h5>Notes</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="notesHistoryTable">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Timestamp</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($notes_history as $note): ?>
                <tr>
                    <td>
                        <?= $note->note ?>
                    </td>
                    <td class="text-right" style="width:1%; white-space: nowrap;">
                        <?php $a=explode('-',$note->timestamp);

                        $b=explode(',',$a[0]);
                   
                        
                        $c=explode('/',$b[0]);
                        $f=$c[1].'/'.$c[0].'/'.$c[2].', '.$b[1];
                       ?>
                        <?= $f ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br class="mb-4">
        <div class="row">
            <div class="col-md">
                <?= $this->Form->control('new_note', ['type' => 'text','class' => 'form-control', 'label' => false,
                'placeholder' => 'If you would like to add a note to this rehearsal booking, please write in this text area.']); ?>
            </div>
        </div>
        <div class="card-footer ">

            <!--            <a href='/bookings/staff_rehearsal_calendar/'>Back</a>-->
            <?php if($user['type']=='admin'){
                echo $this->Html->link('Back',
            array('action' => 'staff_rehearsal_calendar'),
            array(
            'bootstrap-type' => 'primary',
            'class' => 'btn btn-twitter',
            // transform link to a button
            'rule' => 'button'
            )
            );

            }
            else{
            echo $this->Html->link('back',['controller'=>'bookings','action'=>'client_rehearsal_calendar']);


            }
            ?>
            <br><input type="button" class="btn btn-danger" onclick="popUp()" value="Cancel this Booking"><br>

            <br><input type="button" class="btn btn-rose" onclick="myFunction()" value="Save Changes and Pay"><br>
            <br>
            <button class="btn btn-primary" , name="submit" , value="update notes">update notes</button>


        </div>


    </div>


</div>
</div>
<script>
    function popUp() {
        $("#myCancelModal").modal("show");

    }

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


        let cprice = "<?= $currentTotalPrice?>";
        //txt=txt+"<h3>Total price: $"+cprice+"</h3>";
        sum -= cprice;

        txt = txt + "<h3>Total price: $" + sum + "</h3>";

        document.getElementById("demo").innerHTML = txt;


        /*document.cookie="txt="+txt;*/


    }
</script>


<script>
    $(document).ready(function () {
        $("#notesHistoryTable").DataTable({
            'dom': 'tr',

            'columnDefs': [
                {'orderable': false, 'targets': [0]}],
            'order': [[1, 'desc']]
        });
    });
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

                            echo "<p id='demo'></p>";
                ?>

            </div>
            <div class="modal-footer">

                <?php echo $this->Form->submit('Proceed to Square for Payment', ['class'=>'btn
                btn-primary','name'=>'submit'])?>


                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myCancelModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel This Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php

                            echo "<p id='demo'></p>";
                ?>


                <?= $this->Form->postLink(__('Cancel & Refund'), ['action' => 'cancel',
                $fullDetail[10]], ['class'=>'btn btn-danger','confirm' =>
                __('Are you sure you want to cancel and refund this booking?')])?>
                <br>
                <?= $this->Form->postLink(__('Cancel without Refund'), ['action' => 'cancelNoRefund',
                $fullDetail[11]], ['class'=>'btn btn-warning','confirm' =>
                __('Are you sure you want to cancel this booking without refund?')])?>


            </div>
        </div>
    </div>
</div>



