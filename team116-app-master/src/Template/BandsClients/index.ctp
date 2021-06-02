<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BandsClient[]|\Cake\Collection\CollectionInterface $bandsClients
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bands Client'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bands'), ['controller' => 'Bands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Band'), ['controller' => 'Bands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bandsClients index large-9 medium-8 columns content">
    <h3><?= __('Bands Clients') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('band_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bandsClients as $bandsClient): ?>
            <tr>
                <td><?= $this->Number->format($bandsClient->id) ?></td>
                <td><?= $bandsClient->has('band') ? $this->Html->link($bandsClient->band->id, ['controller' => 'Bands', 'action' => 'view', $bandsClient->band->id]) : '' ?></td>
                <td><?= $bandsClient->has('client') ? $this->Html->link($bandsClient->client->id, ['controller' => 'Clients', 'action' => 'view', $bandsClient->client->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bandsClient->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bandsClient->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bandsClient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bandsClient->id)]) ?>
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
