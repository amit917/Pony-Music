<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asset Entity
 *
 * @property int $id
 * @property string $asset_type
 * @property string $asset_name
 * @property int $asset_rehearsal_charge
 * @property bool|null $asset_availability
 * @property int|null $quantity
 *
 * @property \App\Model\Entity\AssetUsage[] $asset_usages
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Asset extends Entity
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
        'asset_type' => true,
        'asset_name' => true,
        'asset_rehearsal_charge' => true,
        'asset_availability' => true,
        'quantity' => true,
        'type_id' => true,
        'asset_usages' => true,
        'bookings' => true,
    ];
}
