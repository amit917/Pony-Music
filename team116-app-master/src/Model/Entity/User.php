<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $fname
 * @property string $lname
 * @property string|null $password
 * @property string|null $phone
 * @property string $type
 * @property \Cake\I18n\FrozenTime|null $created
 * @property string|null $token
 *
 * @property \App\Model\Entity\BookingsClient[] $bookings_clients
 */
class User extends Entity
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
        'email' => true,
        'fname' => true,
        'lname' => true,
        'password' => true,
        'phone' => true,
        'type' => true,
        'created' => true,
        'token' => true,
        'bookings_clients' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
    ];
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
