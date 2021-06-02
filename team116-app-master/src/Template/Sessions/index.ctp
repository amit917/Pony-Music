<?php
$dayList = ['MON','TUE','WED','THU','FRI','SAT','SUN'];
?>
<div class="card">
    <div class="card-header card-header-success">
        <h4>Sessions</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="sessionsTable">
                <thead>
                <tr>
                    <th></th>
                    <th class="text-left">Day</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Night</th>
                    <th class="text-left">Price</th>
                    <th class="td-actions text-right">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php $i = 0; ?>
                <?php foreach ($rehearsal_sessions as $rehearsal_session): ?>

                <tr>
                    <td><?= $dow[$i] ?></td>
                    <?php $i++; ?>
                    <td>
                        <?= $rehearsal_session->session_day_start.'—'.$rehearsal_session->session_day_end?>
                    </td>
                    <td>
                        <?= "$".$rehearsal_session->session_day_charge?>
                    </td>
                    <td><?= $rehearsal_session->
                        session_night_start.'—'.$rehearsal_session->session_night_end?>
                    </td>
                    <td>
                        <?= "$".$rehearsal_session->session_night_charge?>
                    </td>
                    <td class="td-actions text-right">
                        <?= $this->Html->link(__('View/Edit'), ['controller' => 'sessions','action' => 'edit',
                        $rehearsal_session->id], ['class'=>'btn-warning
                        btn-sm']) ?>
                    </td>
                </tr>
                </tbody>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>