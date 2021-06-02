<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Session[]|\Cake\Collection\CollectionInterface $sessions
 */

$dayList = ['MON','TUE','WED','THU','FRI','SAT','SUN'];
?>


<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-black card-header-primary">
                <h4 class="card-title text-center">
                    Session Times
                </h4>

            </div>
            <div class="card-body">

                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="nightSessionsTable" class="table table-striped table-no-bordered table-hover"
                           cellspacing="0"
                           width="100%" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th colspan="3" class="text-center">
                                Night
                            </th>
                            <th colspan="3" class="text-center">
                                Day
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>

                            <th>Start</th>
                            <th>End</th>
                            <th>Price</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Price</th>
                            <th class="td-actions text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($sessions as $i=>$session): ?>
                        <tr>
                            <td><?= $dayList[$i]?></td>

                            <td><?= explode(',',$session->session_night_start)[1] ?></td>
                            <td><?= explode(',',$session->session_night_end)[1] ?></td>
                            <td><?= "$ ".$session->session_night_charge ?></td>
                            <td><?= explode(',',$session->session_day_start)[1] ?></td>
                            <td><?= explode(',',$session->session_day_end)[1] ?></td>
                            <td><?= "$ ".$session->session_day_charge ?></td>

                            <td class="td-actions text-right">

                                <?= $this->Html->link(__('Edit'), ['controller' => 'sessions','action' => 'edit',
                                $session->id]) ?>

                            </td>

                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>


    </div>
</div>
<script>
    $(document).ready(function () {
        $('#addAssetModalButton').on('click', function () {
            $('.modal').show();
            $.ajax({
                type: 'get',
                async: true,
                url: "<?php echo $this->Url->build(['controller' => 'assets', 'action' => 'add_modal']); ?>",
                success: function (response) {
                    $('.modal').html(response);
                }
            });
        });
    })
    $("#availableButton").on('click', function () {
        var rows = $("#assetTableBody").find("tr").hide();
        rows.filter(":contains('Available')").show();
    });
    $("#unavailableButton").on('click', function () {
        var rows = $("#assetTableBody").find("tr").hide();
        rows.filter(":contains('Unavailable')").show();
    });
    $("#resetButton").on('click', function () {
        $("#assetTableBody").find("tr").show();

    });
</script>



