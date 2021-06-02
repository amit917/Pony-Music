<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetsBooking[]|\Cake\Collection\CollectionInterface $assetsBookings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assets Booking'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetsBookings index large-9 medium-8 columns content">
    <h3><?= __('Assets Bookings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assets_bookings_session') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assets_bookings_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asset_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity_request') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assetsBookings as $assetsBooking): ?>
            <tr>
                <td><?= $this->Number->format($assetsBooking->id) ?></td>
                <td><?= h($assetsBooking->assets_bookings_session) ?></td>
                <td><?= h($assetsBooking->assets_bookings_date) ?></td>
                <td><?= $assetsBooking->has('asset') ? $this->Html->link($assetsBooking->asset->id, ['controller' => 'Assets', 'action' => 'view', $assetsBooking->asset->id]) : '' ?></td>
                <td><?= $assetsBooking->has('booking') ? $this->Html->link($assetsBooking->booking->id, ['controller' => 'Bookings', 'action' => 'view', $assetsBooking->booking->id]) : '' ?></td>
                <td><?= $this->Number->format($assetsBooking->quantity_request) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assetsBooking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assetsBooking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assetsBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetsBooking->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
