<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sessions Model
 *
 * @property \App\Model\Table\RoomsTable&\Cake\ORM\Association\HasMany $Rooms
 *
 * @method \App\Model\Entity\Session get($primaryKey, $options = [])
 * @method \App\Model\Entity\Session newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Session[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Session|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Session saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Session[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Session findOrCreate($search, callable $callback = null, $options = [])
 */
class SessionsTable extends Table
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

        $this->setTable('sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Rooms', [
            'foreignKey' => 'session_id',
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
            ->time('session_day_start')
            ->requirePresence('session_day_start', 'create')
            ->notEmptyTime('session_day_start');

        $validator
            ->time('session_day_end')
            ->requirePresence('session_day_end', 'create')
            ->notEmptyTime('session_day_end');

        $validator
            ->decimal('session_day_charge')
            ->requirePresence('session_day_charge', 'create')
            ->notEmptyString('session_day_charge');

        $validator
            ->time('session_night_start')
            ->requirePresence('session_night_start', 'create')
            ->notEmptyTime('session_night_start');

        $validator
            ->time('session_night_end')
            ->requirePresence('session_night_end', 'create')
            ->notEmptyTime('session_night_end');

        $validator
            ->decimal('session_night_charge')
            ->requirePresence('session_night_charge', 'create')
            ->notEmptyString('session_night_charge');

        return $validator;
    }
}
