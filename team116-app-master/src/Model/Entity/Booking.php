<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property string $booking_type
 * @property float $booking_total_charge
 * @property \Cake\I18n\FrozenDate $booking_date_from
 * @property \Cake\I18n\FrozenDate $booking_date_to
 * @property int|null $room_id
 * @property int|null $studio_id
 * @property string $booking_session
 * @property string $booking_notes
 * @property string|null $staff_code
 * @property string $display_name
 * @property string|null $status
 *
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\Studio $studio
 * @property \App\Model\Entity\Checkout[] $checkout
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\RoomUsage[] $room_usages
 * @property \App\Model\Entity\Asset[] $assets
 * @property \App\Model\Entity\Client[] $clients
 */
class Booking extends Entity
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
        'booking_type' => true,
        'booking_total_charge' => true,
        'booking_date_from' => true,
        'booking_date_to' => true,
        'room_id' => true,
        'studio_id' => true,
        'booking_session' => true,
        'booking_notes' => true,
        'staff_code' => true,
        'display_name' => true,
        'status' => true,
        'room' => true,
        'studio' => true,
        'checkout' => true,
        'notes' => true,
        'room_usages' => true,
        'assets' => true,
        'clients' => true,
    ];
}
