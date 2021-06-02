<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoomUsages Model
 *
 * @property \App\Model\Table\RoomsTable&\Cake\ORM\Association\BelongsTo $Rooms
 * @property &\Cake\ORM\Association\BelongsTo $Bookings
 *
 * @method \App\Model\Entity\RoomUsage get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoomUsage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoomUsage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoomUsage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomUsage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomUsage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoomUsage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoomUsage findOrCreate($search, callable $callback = null, $options = [])
 */
class RoomUsagesTable extends Table
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

        $this->setTable('room_usages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Bookings', [
            'foreignKey' => 'booking_id',
            'joinType' => 'INNER',
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
            ->date('room_usages_date')
            ->requirePresence('room_usages_date', 'create')
            ->notEmptyDate('room_usages_date');

        $validator
            ->scalar('room_usages_session')
            ->maxLength('room_usages_session', 2)
            ->requirePresence('room_usages_session', 'create')
            ->notEmptyString('room_usages_session');

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
        $rules->add($rules->existsIn(['booking_id'], 'Bookings'));

        return $rules;
    }
}
