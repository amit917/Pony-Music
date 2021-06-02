<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Checkout $checkout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Checkout'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="checkout form large-9 medium-8 columns content">
    <?= $this->Form->create($checkout) ?>
    <fieldset>
        <legend><?= __('Add Checkout') ?></legend>
        <?php
            echo $this->Form->control('checkout_code');
            echo $this->Form->control('booking_id', ['options' => $bookings, 'empty' => true]);
            echo $this->Form->control('transaction_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
