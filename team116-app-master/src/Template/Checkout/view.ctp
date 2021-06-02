<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checkout $checkout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Checkout'), ['action' => 'edit', $checkout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Checkout'), ['action' => 'delete', $checkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Checkout'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="checkout view large-9 medium-8 columns content">
    <h3><?= h($checkout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Checkout Code') ?></th>
            <td><?= h($checkout->checkout_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Booking') ?></th>
            <td><?= $checkout->has('booking') ? $this->Html->link($checkout->booking->id, ['controller' => 'Bookings', 'action' => 'view', $checkout->booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Code') ?></th>
            <td><?= h($checkout->transaction_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($checkout->id) ?></td>
        </tr>
    </table>
</div>
