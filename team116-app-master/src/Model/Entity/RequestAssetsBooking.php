<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestAssetsBooking Entity
 *
 * @property int $id
 * @property int $assets_id
 * @property int $bookings_id
 * @property float|null $extra_charge
 *
 * @property \App\Model\Entity\Asset $asset
 * @property \App\Model\Entity\Booking $booking
 */
class RequestAssetsBooking extends Entity
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
        'assets_id' => true,
        'bookings_id' => true,
        'extra_charge' => true,
        'asset' => true,
        'booking' => true,
    ];
}
