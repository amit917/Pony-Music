<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BandsClient $bandsClient
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bands Client'), ['action' => 'edit', $bandsClient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bands Client'), ['action' => 'delete', $bandsClient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bandsClient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bands Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bands Client'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Band'), ['controller' => 'Bands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bandsClients view large-9 medium-8 columns content">
    <h3><?= h($bandsClient->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Band') ?></th>
            <td><?= $bandsClient->has('band') ? $this->Html->link($bandsClient->band->id, ['controller' => 'Bands', 'action' => 'view', $bandsClient->band->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $bandsClient->has('client') ? $this->Html->link($bandsClient->client->id, ['controller' => 'Clients', 'action' => 'view', $bandsClient->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bandsClient->id) ?></td>
        </tr>
    </table>
</div>
