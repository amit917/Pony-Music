<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
 */
?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-info card-header-primary">

                <h4 class="card-title text-center">
                    Asset Details
                </h4>
                <p class="card-category">

                </p>
            </div>
            <div class="card-body">
                <dt>Type:</dt>
                <dd><?= $asset->asset_type ?></dd>
                <dt>Name:</dt>
                <dd> <?= $asset->asset_name ?></dd>
                <dt>Rehearsal Price:</dt>
                <dd><?= $asset->asset_rehearsal_charge ?></dd>
                <dt>Current Status:</dt>
                <dd><?= $asset->asset_status ?></dd>
            </div>
            <div class="card-footer">
                <?= $this->Html->link('Edit Details', ['action'=>'edit', $asset->id], ['class'=>'btn btn-info'])?>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-info card-header-primary">
                <h4 class="card-title text-center">Related Bookings</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-hover" id="clientBookingsTable">
                    <thead class="text-info">
                    <th>Booking ID</th>
                    <th>Type</th>
                    <th>Room</th>

                    <th>Date Used</th>


                    </thead>
                    <tbody>
                    <?php foreach ($asset->bookings as $bookings): ?>
                    <tr>
                        <td><?= $bookings->id ?></td>
                        <td><?= $bookings->booking_type ?></td>
                        <td><?= $bookings->room_id ?></td>
                        <td><?= $bookings->booking_date_from ?></td>

                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Band'), ['action' => 'edit', $band->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Band'), ['action' => 'delete', $band->id], ['confirm' => __('Are you sure you want to delete # {0}?', $band->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bands'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Band'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bands view large-9 medium-8 columns content">
    <h3><?= h($band->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Band Name') ?></th>
            <td><?= h($band->band_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($band->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Clients') ?></h4>
        <?php if (!empty($band->clients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Client Fname') ?></th>
                <th scope="col"><?= __('Client Lname') ?></th>
                <th scope="col"><?= __('Client Phone') ?></th>
                <th scope="col"><?= __('Client Email') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($band->clients as $clients): ?>
            <tr>
                <td><?= h($clients->id) ?></td>
                <td><?= h($clients->client_fname) ?></td>
                <td><?= h($clients->client_lname) ?></td>
                <td><?= h($clients->client_phone) ?></td>
                <td><?= h($clients->client_email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Clients', 'action' => 'view', $clients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Clients', 'action' => 'edit', $clients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clients', 'action' => 'delete', $clients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
