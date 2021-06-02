<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Studio Entity
 *
 * @property int $id
 * @property int $studio_number
 * @property int $location_id
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\StudioUsage[] $studio_usages
 */
class Studio extends Entity
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
        'studio_number' => true,
        'location_id' => true,
        'location' => true,
        'bookings' => true,
        'studio_usages' => true,
    ];
}
