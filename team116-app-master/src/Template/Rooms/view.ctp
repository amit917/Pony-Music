<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room'), ['action' => 'edit', $room->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room'), ['action' => 'delete', $room->id], ['confirm' => __('Are you sure you want to delete # {0}?', $room->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Room Usages'), ['controller' => 'RoomUsages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room Usage'), ['controller' => 'RoomUsages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rooms view large-9 medium-8 columns content">
    <h3><?= h($room->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session') ?></th>
            <td><?= $room->has('session') ? $this->Html->link($room->session->id, ['controller' => 'Sessions', 'action' => 'view', $room->session->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $room->has('location') ? $this->Html->link($room->location->id, ['controller' => 'Locations', 'action' => 'view', $room->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($room->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room Number') ?></th>
            <td><?= $this->Number->format($room->room_number) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bookings') ?></h4>
        <?php if (!empty($room->bookings)): ?>
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
            <?php foreach ($room->bookings as $bookings): ?>
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
        <h4><?= __('Related Room Usages') ?></h4>
        <?php if (!empty($room->room_usages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Room Usages Date') ?></th>
                <th scope="col"><?= __('Room Usages Session') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($room->room_usages as $roomUsages): ?>
            <tr>
                <td><?= h($roomUsages->id) ?></td>
                <td><?= h($roomUsages->room_id) ?></td>
                <td><?= h($roomUsages->room_usages_date) ?></td>
                <td><?= h($roomUsages->room_usages_session) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RoomUsages', 'action' => 'view', $roomUsages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RoomUsages', 'action' => 'edit', $roomUsages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RoomUsages', 'action' => 'delete', $roomUsages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomUsages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<div>
    <div class="card">
        <div class="card-header card-header-black  card-header-primary">
            <h4 class="card-title text-center">
                Room List
            </h4>

        </div>
        <div class="card-body">

            <div class="toolbar">

                <?= $this->Html->link('Add a Room', ['action' => 'add'], ['class' => 'btn btn-black btn-sm float-right']) ?>

            </div>
            <div class="material-datatables">
                <table id="allAssetsTable" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                       width="100%" style="width:100%">
                    <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Location Id</th>
                        <th class="td-actions text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= $room->room_number ?></td>
                            <td><?= $room->location_id ?></td>

                            <td class="td-actions text-right">
                                <?= $this->Html->link('View', ['controller' => 'rooms', 'action' =>'view', $room->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'rooms','action' => 'edit',
                                    $room->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'rooms','action' => 'delete',
                                    $room->id],
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $room->id)]) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
