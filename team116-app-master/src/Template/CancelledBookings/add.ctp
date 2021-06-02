<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancelledBooking $cancelledBooking
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cancelled Bookings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cancelledBookings form large-9 medium-8 columns content">
    <?= $this->Form->create($cancelledBooking) ?>
    <fieldset>
        <legend><?= __('Add Cancelled Booking') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('start_event', ['empty' => true]);
            echo $this->Form->control('end_event', ['empty' => true]);
            echo $this->Form->control('client_fname');
            echo $this->Form->control('client_lname');
            echo $this->Form->control('client_phone');
            echo $this->Form->control('client_email');
            echo $this->Form->control('Display_name');
            echo $this->Form->control('Notes');
            echo $this->Form->control('Band_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
