<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssetUsages Model
 *
 * @property \App\Model\Table\AssetsTable&\Cake\ORM\Association\BelongsTo $Assets
 *
 * @method \App\Model\Entity\AssetUsage get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssetUsage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssetUsage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssetUsage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetUsage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetUsage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssetUsage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssetUsage findOrCreate($search, callable $callback = null, $options = [])
 */
class AssetUsagesTable extends Table
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

        $this->setTable('asset_usages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assets', [
            'foreignKey' => 'asset_id',
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
            ->date('asset_usages_date')
            ->requirePresence('asset_usages_date', 'create')
            ->notEmptyDate('asset_usages_date');

        $validator
            ->scalar('asset_usages_session')
            ->maxLength('asset_usages_session', 2)
            ->requirePresence('asset_usages_session', 'create')
            ->notEmptyString('asset_usages_session');

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
        $rules->add($rules->existsIn(['asset_id'], 'Assets'));

        return $rules;
    }
}
