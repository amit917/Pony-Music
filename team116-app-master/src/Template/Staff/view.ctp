<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Staff'), ['action' => 'edit', $staff->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Staff'), ['action' => 'delete', $staff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Staff'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staff'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="staff view large-9 medium-8 columns content">
    <h3><?= h($staff->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Staff Fname') ?></th>
            <td><?= h($staff->staff_fname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Lname') ?></th>
            <td><?= h($staff->staff_lname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Phone') ?></th>
            <td><?= h($staff->staff_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Code') ?></th>
            <td><?= h($staff->staff_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staff->id) ?></td>
        </tr>
    </table>
</div>
