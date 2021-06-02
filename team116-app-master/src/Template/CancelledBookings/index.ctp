<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancelledBooking[]|\Cake\Collection\CollectionInterface $cancelledBookings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cancelled Booking'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cancelledBookings index large-9 medium-8 columns content">
    <h3><?= __('Cancelled Bookings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_event') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_event') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_fname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_lname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Display_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Band_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cancelledBookings as $cancelledBooking): ?>
            <tr>
                <td><?= $this->Number->format($cancelledBooking->id) ?></td>
                <td><?= h($cancelledBooking->title) ?></td>
                <td><?= h($cancelledBooking->start_event) ?></td>
                <td><?= h($cancelledBooking->end_event) ?></td>
                <td><?= h($cancelledBooking->client_fname) ?></td>
                <td><?= h($cancelledBooking->client_lname) ?></td>
                <td><?= h($cancelledBooking->client_phone) ?></td>
                <td><?= h($cancelledBooking->client_email) ?></td>
                <td><?= h($cancelledBooking->Display_name) ?></td>
                <td><?= h($cancelledBooking->Band_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cancelledBooking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cancelledBooking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cancelledBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cancelledBooking->id)]) ?>
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
