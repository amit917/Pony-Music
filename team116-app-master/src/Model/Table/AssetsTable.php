<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assets Model
 *
 * @property \App\Model\Table\AssetUsagesTable&\Cake\ORM\Association\HasMany $AssetUsages
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsToMany $Bookings
 *
 * @method \App\Model\Entity\Asset get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asset|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asset saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asset findOrCreate($search, callable $callback = null, $options = [])
 */
class AssetsTable extends Table
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

        $this->setTable('assets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AssetTypes', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('AssetUsages', [
            'foreignKey' => 'asset_id',
        ]);
        $this->belongsToMany('Bookings', [
            'foreignKey' => 'asset_id',
            'targetForeignKey' => 'booking_id',
            'joinTable' => 'assets_bookings',
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
            ->scalar('asset_type')
            ->maxLength('asset_type', 255)
            ->requirePresence('asset_type', 'create')
            ->notEmptyString('asset_type');

        $validator
            ->scalar('asset_name')
            ->maxLength('asset_name', 255)
            ->requirePresence('asset_name', 'create')
            ->notEmptyString('asset_name');

        $validator
            ->integer('asset_rehearsal_charge')
            ->requirePresence('asset_rehearsal_charge', 'create')
            ->notEmptyString('asset_rehearsal_charge');

        $validator
            ->boolean('asset_availability')
            ->allowEmptyString('asset_availability');

        $validator
            ->integer('quantity')
            ->allowEmptyString('quantity');

        return $validator;
    }
       public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['type_id'], 'AssetTypes'));

        return $rules;
    }
}
