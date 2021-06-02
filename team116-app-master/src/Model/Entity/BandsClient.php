<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BandsClient Entity
 *
 * @property int $id
 * @property int $band_id
 * @property int $client_id
 *
 * @property \App\Model\Entity\Band $band
 * @property \App\Model\Entity\Client $client
 */
class BandsClient extends Entity
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
        'band_id' => true,
        'client_id' => true,
        'band' => true,
        'client' => true,
    ];
}
