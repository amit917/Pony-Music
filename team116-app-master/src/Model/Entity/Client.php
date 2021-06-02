<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $client_fname
 * @property string $client_lname
 * @property string $client_phone
 * @property string|null $client_email
 *
 * @property \App\Model\Entity\Band[] $bands
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Client extends Entity
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
        'bands' => true,
        'bookings' => true,
    ];
}
