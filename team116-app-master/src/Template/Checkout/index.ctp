<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checkout[]|\Cake\Collection\CollectionInterface $checkout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="checkout index large-9 medium-8 columns content">
    <h3><?= __('Checkout') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('checkout_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($checkout as $checkout): ?>
            <tr>
                <td><?= $this->Number->format($checkout->id) ?></td>
                <td><?= h($checkout->checkout_code) ?></td>
                <td><?= $checkout->has('booking') ? $this->Html->link($checkout->booking->id, ['controller' => 'Bookings', 'action' => 'view', $checkout->booking->id]) : '' ?></td>
                <td><?= h($checkout->transaction_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $checkout->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkout->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->id)]) ?>
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
