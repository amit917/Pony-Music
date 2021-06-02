<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Room Entity
 *
 * @property int $id
 * @property int $room_number
 * @property int $session_id
 * @property int $location_id
 *
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\RoomUsage[] $room_usages
 */
class Room extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'room_number' => true,
        'session_id' => true,
        'location_id' => true,
        'session' => true,
        'location' => true,
        'bookings' => true,
        'room_usages' => true,
    ];
}
