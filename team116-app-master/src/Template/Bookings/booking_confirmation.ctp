<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-primary">
                <h4>Booking Confirmation</h4>
            </div>
            <div class="card-body">
                <br>
                <h2><?= $response?></h2>
            </div>
        </div>
    </div>
</div>


<?php


if (isset($user['type']) && $user['type'] === 'admin' ||
    isset($user['type']) && $user['type'] === 'staff' ) {

    echo "<meta http-equiv='refresh' content='2;url=staff_rehearsal_calendar?key=$weekno&year=$yearno'/>";




}
elseif (isset($user['type']) && $user['type'] === 'freelancer') {
    echo "<meta http-equiv='refresh' content='3;url=freelance_rehearsal_calendar?key=$weekno&year=$yearno'/>";


}
elseif (isset($user['type'])&& $user['type'] === 'client') {
    echo "<meta http-equiv='refresh' content='3;url=client_rehearsal_calendar'/>";

}
else{
    echo "<meta http-equiv='refresh' content='3;url=public_rehearsal_calendar?key=$weekno&year=$yearno'/>";

}
?>


<!--<meta http-equiv='refresh' content='2;url=public_rehearsal_calendar'/>-->

