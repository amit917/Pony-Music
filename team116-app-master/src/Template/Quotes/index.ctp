<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote[]|\Cake\Collection\CollectionInterface $quotes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quotes index large-9 medium-8 columns content">
    <h3><?= __('Quotes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_fname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_lname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('From_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('To_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Band_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Display') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quotes as $quote): ?>
            <tr>
                <td><?= $this->Number->format($quote->id) ?></td>
                <td><?= h($quote->client_fname) ?></td>
                <td><?= h($quote->client_lname) ?></td>
                <td><?= h($quote->phone) ?></td>
                <td><?= h($quote->Email) ?></td>
                <td><?= h($quote->From_date) ?></td>
                <td><?= h($quote->To_date) ?></td>
                <td><?= h($quote->Band_name) ?></td>
                <td><?= h($quote->Display) ?></td>
                <td><?= $quote->has('user') ? $this->Html->link($quote->user->id, ['controller' => 'Users', 'action' => 'view', $quote->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $quote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $quote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $quote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quote->id)]) ?>
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
