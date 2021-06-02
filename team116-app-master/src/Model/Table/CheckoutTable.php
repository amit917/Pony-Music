<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checkout Model
 *
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsTo $Bookings
 *
 * @method \App\Model\Entity\Checkout get($primaryKey, $options = [])
 * @method \App\Model\Entity\Checkout newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Checkout[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Checkout|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checkout saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checkout patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Checkout[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Checkout findOrCreate($search, callable $callback = null, $options = [])
 */
class CheckoutTable extends Table
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

        $this->setTable('checkout');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bookings', [
            'foreignKey' => 'booking_id',
        ]);
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
            ->scalar('checkout_code')
            ->maxLength('checkout_code', 255)
            ->requirePresence('checkout_code', 'create')
            ->notEmptyString('checkout_code');

        $validator
            ->scalar('transaction_code')
            ->maxLength('transaction_code', 255)
            ->allowEmptyString('transaction_code');

        $validator
            ->scalar('payment_code')
            ->maxLength('payment_code', 255)
            ->allowEmptyString('payment_code');

        $validator
            ->scalar('location_code')
            ->maxLength('location_code', 255)
            ->allowEmptyString('location_code');

        $validator
            ->scalar('idempotency_key')
            ->maxLength('idempotency_key', 255)
            ->allowEmptyString('idempotency_key');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmptyString('status');

        $validator
            ->integer('refund_code')
            ->allowEmptyString('refund_code');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['booking_id'], 'Bookings'));

        return $rules;
    }
}
