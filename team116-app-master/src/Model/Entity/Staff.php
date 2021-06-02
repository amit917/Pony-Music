<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property string $staff_fname
 * @property string $staff_lname
 * @property string $staff_phone
 * @property string|null $staff_email
 * @property string $staff_code
 * @property string|null $staff_token
 */
class Staff extends Entity
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
        'staff_fname' => true,
        'staff_lname' => true,
        'staff_phone' => true,
        'staff_email' => true,
        'staff_code' => true,
        'staff_token' => true,
    ];
}
