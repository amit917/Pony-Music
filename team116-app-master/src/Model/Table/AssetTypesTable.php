<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssetTypes Model
 *
 * @method \App\Model\Entity\AssetType get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssetType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssetType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssetType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssetType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssetType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssetType findOrCreate($search, callable $callback = null, $options = [])
 */
class AssetTypesTable extends Table
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

        $this->setTable('asset_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Assets', [
            'foreignKey' => 'type_id',
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

        return $validator;
    }
}
