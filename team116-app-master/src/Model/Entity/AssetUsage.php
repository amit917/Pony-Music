<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssetUsage Entity
 *
 * @property int $id
 * @property int $asset_id
 * @property \Cake\I18n\FrozenDate $asset_usages_date
 * @property string $asset_usages_session
 *
 * @property \App\Model\Entity\Asset $asset
 */
class AssetUsage extends Entity
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
        'asset_id' => true,
        'asset_usages_date' => true,
        'asset_usages_session' => true,
        'asset' => true,
    ];
}
