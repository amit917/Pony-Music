
<div class="card text-center">
    <div class="card-header card-header-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="/bookings/staff_rehearsal_calendar/">Rehearsals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/bookings/staff_recording_calendar">Recordings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/bookings/cancelled_booking_report">Reports</a>
            </li>


        </ul>

    </div>
    <div class="card-body">

        <!DOCTYPE html>
        <html>
        <head>
            <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>jQuery UI Datepicker - Default functionality</title>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        </head>

<?= $this->Form->create() ?>
<?php $myTemplates = [
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


<div class = "row">
    <h3>Cancelled recording studio Booking</h3>
</div>
<div class="row">
    <div class="col-md-auto">
        <?= $this->Form->control('client_email', ['label' => 'Email', 'required' => true]); ?>
    </div>
    <div class="col-md-auto">
        <?= $this->Form->control('client_phone', ['label' => 'client_phone', 'required' => true]); ?>
    </div>
    <div class = "col-md-auto">
    <?php echo $this->Form->submit('Search', [ 'name' => 'submit', 'class'=>'btn btn-rose'])?>
    </div>
</div>


<?= $this->Form->end() ?>



<?php echo "<table style= 'width:100%'>"; ?>
<?php echo "<tr>"; ?>
<?php echo "<th> First name </th>"; ?>
<?php echo "<th> Last name </th>"; ?>

<?php echo "<th> Email </th>"; ?>
<?php echo "<th> Phone </th>"; ?>
<?php echo "<th> Requested Start date </th>"; ?>
<?php echo "<th> Requested End date </th>"; ?>


<?php
if ($stmt2 !=null){
foreach($stmt2 as $row2){?>
    <?php echo " <tr>";?>
    <?php echo "<td>";?>
    <?php echo $row2['client_fname'];?>


    <?php echo "</td>";?>
    <?php echo "<td>";?>
    <?php echo $row2['client_lname'];?>


    <?php echo "</td>";?>
    <?php echo "<td>";?>
    <?php echo $row2['client_email'];?>


    <?php echo "</td>";?>

    <?php echo "<td>";?>
    <?php echo $row2['client_phone'];?>


    <?php echo "</td>";?>
    <?php echo "<td>";?>
    <?php $start_date = strtotime($row2['start_event']);?>
    <?php echo date('d/m/Y',$start_date);?>


    <?php echo "</td>";?>
    <?php echo "<td>";?>
    <?php $end_date = strtotime($row2['end_event']);?>
    <?php echo date('d/m/Y',$end_date);?>


    <?php echo "</td>";?>

    <?php echo " </tr>";?>




<?php }?>
<?php } ?>





<?php echo "</tr>"; ?>


<?php echo "</table>"; ?>











