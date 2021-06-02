<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoomUsage Entity
 *
 * @property int $id
 * @property int $room_id
 * @property \Cake\I18n\FrozenDate $room_usages_date
 * @property string $room_usages_session
 * @property int $booking_id
 *
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\$booking $$booking
 */
class RoomUsage extends Entity
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
        'room_id' => true,
        'room_usages_date' => true,
        'room_usages_session' => true,
        'booking_id' => true,
        'room' => true,
        '$booking' => true,
    ];
}
