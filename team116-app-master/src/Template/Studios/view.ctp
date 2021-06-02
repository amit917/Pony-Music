<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Studio $studio
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Studio'), ['action' => 'edit', $studio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Studio'), ['action' => 'delete', $studio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studio->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Studios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Studio Usages'), ['controller' => 'StudioUsages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studio Usage'), ['controller' => 'StudioUsages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studios view large-9 medium-8 columns content">
    <h3><?= h($studio->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $studio->has('location') ? $this->Html->link($studio->location->id, ['controller' => 'Locations', 'action' => 'view', $studio->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studio->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Studio Number') ?></th>
            <td><?= $this->Number->format($studio->studio_number) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bookings') ?></h4>
        <?php if (!empty($studio->bookings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Booking Type') ?></th>
                <th scope="col"><?= __('Booking Total Charge') ?></th>
                <th scope="col"><?= __('Booking Date From') ?></th>
                <th scope="col"><?= __('Booking Date To') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Studio Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($studio->bookings as $bookings): ?>
            <tr>
                <td><?= h($bookings->id) ?></td>
                <td><?= h($bookings->booking_type) ?></td>
                <td><?= h($bookings->booking_total_charge) ?></td>
                <td><?= h($bookings->booking_date_from) ?></td>
                <td><?= h($bookings->booking_date_to) ?></td>
                <td><?= h($bookings->room_id) ?></td>
                <td><?= h($bookings->studio_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $bookings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $bookings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bookings', 'action' => 'delete', $bookings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Studio Usages') ?></h4>
        <?php if (!empty($studio->studio_usages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Studio Id') ?></th>
                <th scope="col"><?= __('Studio Usages Date') ?></th>
                <th scope="col"><?= __('Studio Usages Session') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($studio->studio_usages as $studioUsages): ?>
            <tr>
                <td><?= h($studioUsages->id) ?></td>
                <td><?= h($studioUsages->studio_id) ?></td>
                <td><?= h($studioUsages->studio_usages_date) ?></td>
                <td><?= h($studioUsages->studio_usages_session) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudioUsages', 'action' => 'view', $studioUsages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudioUsages', 'action' => 'edit', $studioUsages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudioUsages', 'action' => 'delete', $studioUsages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studioUsages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
<?php

?>
