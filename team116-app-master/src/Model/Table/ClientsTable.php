<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @property \App\Model\Table\BandsTable&\Cake\ORM\Association\BelongsToMany $Bands
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsToMany $Bookings
 *
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Bands', [
            'foreignKey' => 'client_id',
            'targetForeignKey' => 'band_id',
            'joinTable' => 'bands_clients',
        ]);
        $this->belongsToMany('Bookings', [
            'foreignKey' => 'client_id',
            'targetForeignKey' => 'booking_id',
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
            ->scalar('client_fname')
            ->maxLength('client_fname', 255)
            ->requirePresence('client_fname', 'create')
            ->notEmptyString('client_fname');

        $validator
            ->scalar('client_lname')
            ->maxLength('client_lname', 255)
            ->requirePresence('client_lname', 'create')
            ->notEmptyString('client_lname');

        $validator
            ->scalar('client_phone')
            ->maxLength('client_phone', 12)
            ->requirePresence('client_phone', 'create')
            ->notEmptyString('client_phone');

        $validator
            ->scalar('client_email')
            ->maxLength('client_email', 255)
            ->allowEmptyString('client_email');

        return $validator;
    }
}
