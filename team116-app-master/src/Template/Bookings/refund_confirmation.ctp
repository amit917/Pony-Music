
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">Refund Confirmation</h4>
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

    echo "<meta http-equiv='refresh' content='2;url=staff_rehearsal_calendar'/>";




}
elseif (isset($user['type']) && $user['type'] === 'freelancer') {
    echo "<meta http-equiv='refresh' content='3;url=client_rehearsal_calendar'/>";


}
elseif (isset($user['type'])&& $user['type'] === 'client') {
    echo "<meta http-equiv='refresh' content='3;url=client_rehearsal_calendar'/>";

}
else{
    echo "<meta http-equiv='refresh' content='3;url=public_rehearsal_calendar'/>";

}
?>


<!--<meta http-equiv='refresh' content='2;url=public_rehearsal_calendar'/>-->

