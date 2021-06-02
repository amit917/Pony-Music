<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetsBooking $assetsBooking
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assets Booking'), ['action' => 'edit', $assetsBooking->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assets Booking'), ['action' => 'delete', $assetsBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetsBooking->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assets Bookings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assets Booking'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assetsBookings view large-9 medium-8 columns content">
    <h3><?= h($assetsBooking->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assets Bookings Session') ?></th>
            <td><?= h($assetsBooking->assets_bookings_session) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset') ?></th>
            <td><?= $assetsBooking->has('asset') ? $this->Html->link($assetsBooking->asset->id, ['controller' => 'Assets', 'action' => 'view', $assetsBooking->asset->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Booking') ?></th>
            <td><?= $assetsBooking->has('booking') ? $this->Html->link($assetsBooking->booking->id, ['controller' => 'Bookings', 'action' => 'view', $assetsBooking->booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assetsBooking->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Request') ?></th>
            <td><?= $this->Number->format($assetsBooking->quantity_request) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assets Bookings Date') ?></th>
            <td><?= h($assetsBooking->assets_bookings_date) ?></td>
        </tr>
    </table>
</div>
