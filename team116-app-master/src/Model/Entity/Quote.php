<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Quote Entity
 *
 * @property int $id
 * @property string|null $client_fname
 * @property string|null $client_lname
 * @property string|null $client_phone
 * @property string|null $client_email
 * @property \Cake\I18n\FrozenDate|null $start_event
 * @property \Cake\I18n\FrozenDate|null $end_event
 * @property string|null $band_name
 * @property string|null $notes
 * @property string|null $display_name
 * @property int|null $user_id
 * @property string|null $status
 *
 * @property \App\Model\Entity\User $user
 */
class Quote extends Entity
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
        'client_fname' => true,
        'client_lname' => true,
        'client_phone' => true,
        'client_email' => true,
        'start_event' => true,
        'end_event' => true,
        'band_name' => true,
        'notes' => true,
        'display_name' => true,
        'user_id' => true,
        'status' => true,
        'user' => true,
    ];
}
