<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Checkout Entity
 *
 * @property int $id
 * @property string $checkout_code
 * @property int|null $booking_id
 * @property string|null $transaction_code
 * @property string|null $payment_code
 * @property string|null $location_code
 * @property string|null $idempotency_key
 * @property string|null $status
 * @property int|null $refund_code
 *
 * @property \App\Model\Entity\Booking $booking
 */
class Checkout extends Entity
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
        'checkout_code' => true,
        'booking_id' => true,
        'transaction_code' => true,
        'payment_code' => true,
        'location_code' => true,
        'idempotency_key' => true,
        'status' => true,
        'refund_code' => true,
        'booking' => true,
    ];
}
