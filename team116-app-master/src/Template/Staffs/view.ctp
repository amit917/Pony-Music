
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">View Staff</h4>
            </div>
            <div class="card-body">
                <br>
<div class="staffs view large-9 medium-8 columns content">
    <h3><?= h($staffs->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($staffs->staff_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fname') ?></th>
            <td><?= h($staffs->staff_fname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lname') ?></th>
            <td><?= h($staffs->staff_lname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($staffs->staff_phone) ?></td>
        </tr>
    </table>
</div>
            </div>
        </div>
    </div>
</div>
