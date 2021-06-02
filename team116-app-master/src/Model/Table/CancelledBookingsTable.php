<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CancelledBookings Model
 *
 * @method \App\Model\Entity\CancelledBooking get($primaryKey, $options = [])
 * @method \App\Model\Entity\CancelledBooking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CancelledBooking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CancelledBooking|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CancelledBooking saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CancelledBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CancelledBooking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CancelledBooking findOrCreate($search, callable $callback = null, $options = [])
 */
class CancelledBookingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cancelled_bookings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmptyString('title');

        $validator
            ->date('start_event')
            ->allowEmptyDate('start_event');

        $validator
            ->date('end_event')
            ->allowEmptyDate('end_event');

        $validator
            ->scalar('client_fname')
            ->maxLength('client_fname', 255)
            ->allowEmptyString('client_fname');

        $validator
            ->scalar('client_lname')
            ->maxLength('client_lname', 255)
            ->allowEmptyString('client_lname');

        $validator
            ->scalar('client_phone')
            ->maxLength('client_phone', 12)
            ->allowEmptyString('client_phone');

        $validator
            ->scalar('client_email')
            ->maxLength('client_email', 255)
            ->allowEmptyString('client_email');

        $validator
            ->scalar('display_name')
            ->maxLength('display_name', 255)
            ->allowEmptyString('display_name');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('band_name')
            ->maxLength('band_name', 255)
            ->allowEmptyString('band_name');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->notEmptyString('status');

        return $validator;
    }
}
