<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>

<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_note</i>
                </div>
                <h4 class="card-title">Edit Booking</h4>
            </div>
            <div class="card-body">
                <br>

                <?= $this->Form->create($booking,['name'=>'searchF','onsubmit'=>'return validateForm()']);
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
                <h5>Booking Details</h5>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('booking_type', ['label' => 'Booking Type', 'required' => true,'readonly']); ?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('booking_total_charge', ['label' => 'Booking Total Charge', 'required' => true,'readonly']); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('booking_date_from', ['type' => 'date', 'label' => 'Booking Date', 'required' =>
                            true,'readonly']);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('booking_date_to', ['type' => 'date','label' => 'Booking Date','readonly']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('assets._ids', ['options' => $assets,'label'=>'Assets List']);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('room_id' ,['options' => $rooms,'type'=>'hidden','empty' => true,'readonly']);?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md">
                        <?= $this->Form->control('clients._ids',['options' => $clients,'type'=>'hidden','readonly']);?>
                    </div>
                    <div class="col-md">
                        <?= $this->Form->control('studio_id' ,['options' => $studios,'type'=>'hidden','readonly', 'empty' => true]);?>
                    </div>


                </div>



            </div>
            <div class="card-footer ">
                <div>
                    <h6><a href="../index">back</a></h6><br>

                    <h6><a href="#0">reset</a></h6>
                </div>



                <?php echo $this->Form->submit('Submit', ['class'=>'btn btn-rose'])?>
                <?php echo $this->Form->end() ?>

            </div>


        </div>
    </div>
</div>


