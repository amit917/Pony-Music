<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quotes form large-9 medium-8 columns content">
    <?= $this->Form->create($quote) ?>
    <fieldset>
        <legend><?= __('Add Quote') ?></legend>
        <?php
            echo $this->Form->control('client_fname');
            echo $this->Form->control('client_lname');
            echo $this->Form->control('phone');
            echo $this->Form->control('Email');
            echo $this->Form->control('From_date', ['empty' => true]);
            echo $this->Form->control('To_date', ['empty' => true]);
            echo $this->Form->control('Band_name');
            echo $this->Form->control('Notes');
            echo $this->Form->control('Display');
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
