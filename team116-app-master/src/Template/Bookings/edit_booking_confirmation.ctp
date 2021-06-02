
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">Booking Confirmation</h4>
            </div>
            <div class="card-body">
                <br>
                <h2><?= $response?></h2>
            </div>
        </div>
    </div>
</div>
<?php
echo "<meta http-equiv='refresh' content='2;url=staff_rehearsal_calendar?key=$weekno&year=$yearno'/>";



    //echo "<meta http-equiv='refresh' content='2;url=rehearsal_booking_detail?BookingId=$booking_id'/>";




?>


<!--<meta http-equiv='refresh' content='2;url=public_rehearsal_calendar'/>-->

