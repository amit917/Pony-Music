<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookings Model
 *
 * @property \App\Model\Table\RoomsTable&\Cake\ORM\Association\BelongsTo $Rooms
 * @property \App\Model\Table\StudiosTable&\Cake\ORM\Association\BelongsTo $Studios
 * @property \App\Model\Table\CheckoutTable&\Cake\ORM\Association\HasMany $Checkout
 * @property \App\Model\Table\NotesTable&\Cake\ORM\Association\HasMany $Notes
 * @property \App\Model\Table\RoomUsagesTable&\Cake\ORM\Association\HasMany $RoomUsages
 * @property \App\Model\Table\AssetsTable&\Cake\ORM\Association\BelongsToMany $Assets
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsToMany $Clients
 *
 * @method \App\Model\Entity\Booking get($primaryKey, $options = [])
 * @method \App\Model\Entity\Booking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Booking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Booking|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Booking saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Booking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Booking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Booking findOrCreate($search, callable $callback = null, $options = [])
 */
class BookingsTable extends Table
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

        $this->setTable('bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id',
        ]);
        $this->belongsTo('Studios', [
            'foreignKey' => 'studio_id',
        ]);
        //   $this->belongsTo('Staffs', [
        //     'foreignKey' => 'staff_code',
        // ]);
        $this->hasMany('Checkout', [
            'foreignKey' => 'booking_id',
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'booking_id',
        ]);
        $this->hasMany('RoomUsages', [
            'foreignKey' => 'booking_id',
        ]);
        $this->belongsToMany('Assets', [
            'foreignKey' => 'booking_id',
            'targetForeignKey' => 'asset_id',
            'joinTable' => 'assets_bookings',
        ]);
        $this->belongsToMany('Clients', [
            'foreignKey' => 'booking_id',
            'targetForeignKey' => 'client_id',
            'joinTable' => 'bookings_clients',
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
            ->scalar('booking_type')
            ->maxLength('booking_type', 255)
            ->requirePresence('booking_type', 'create')
            ->notEmptyString('booking_type');

        $validator
            ->decimal('booking_total_charge')
            ->requirePresence('booking_total_charge', 'create')
            ->notEmptyString('booking_total_charge');

        $validator
            ->date('booking_date_from')
            ->requirePresence('booking_date_from', 'create')
            ->notEmptyDate('booking_date_from');

        $validator
            ->date('booking_date_to')
            ->requirePresence('booking_date_to', 'create')
            ->notEmptyDate('booking_date_to');

        $validator
            ->scalar('booking_session')
            ->maxLength('booking_session', 2)
            ->requirePresence('booking_session', 'create')
            ->notEmptyString('booking_session');

        $validator
            ->scalar('booking_notes')
            ->maxLength('booking_notes', 1000)
            ->notEmptyString('booking_notes');

        $validator
            ->scalar('staff_code')
            ->maxLength('staff_code', 4)
            ->allowEmptyString('staff_code');

        $validator
            ->scalar('display_name')
            ->maxLength('display_name', 255)
            ->requirePresence('display_name', 'create')
            ->notEmptyString('display_name');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['room_id'], 'Rooms'));
        $rules->add($rules->existsIn(['studio_id'], 'Studios'));

        return $rules;
    }
}
