<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetsBooking Entity
 *
 * @property int $id
 * @property string|null $assets_bookings_session
 * @property \Cake\I18n\FrozenDate|null $assets_bookings_date
 * @property int $asset_id
 * @property int $booking_id
 * @property int|null $quantity_request
 *
 * @property \App\Model\Entity\Asset $asset
 * @property \App\Model\Entity\Booking $booking
 */
class AssetsBooking extends Entity
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
        'assets_bookings_session' => true,
        'assets_bookings_date' => true,
        'asset_id' => true,
        'booking_id' => true,
        'quantity_request' => true,
        'asset' => true,
        'booking' => true,
    ];
}
