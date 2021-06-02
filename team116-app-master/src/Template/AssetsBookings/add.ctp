<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetsBooking $assetsBooking
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assets Bookings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetsBookings form large-9 medium-8 columns content">
    <?= $this->Form->create($assetsBooking) ?>
    <fieldset>
        <legend><?= __('Add Assets Booking') ?></legend>
        <?php
            echo $this->Form->control('assets_bookings_session');
            echo $this->Form->control('assets_bookings_date', ['empty' => true]);
            echo $this->Form->control('asset_id', ['options' => $assets]);
            echo $this->Form->control('booking_id', ['options' => $bookings]);
            echo $this->Form->control('quantity_request');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
