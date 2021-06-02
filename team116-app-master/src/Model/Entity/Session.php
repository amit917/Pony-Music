<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $session_day_start
 * @property \Cake\I18n\FrozenTime $session_day_end
 * @property float $session_day_charge
 * @property \Cake\I18n\FrozenTime $session_night_start
 * @property \Cake\I18n\FrozenTime $session_night_end
 * @property float $session_night_charge
 *
 * @property \App\Model\Entity\Room[] $rooms
 */
class Session extends Entity
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
        'session_day_start' => true,
        'session_day_end' => true,
        'session_day_charge' => true,
        'session_night_start' => true,
        'session_night_end' => true,
        'session_night_charge' => true,
        'rooms' => true,
    ];
}
