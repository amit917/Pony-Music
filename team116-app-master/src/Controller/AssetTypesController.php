<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssetTypes Controller
 *
 * @property \App\Model\Table\AssetTypesTable $AssetTypes
 *
 * @method \App\Model\Entity\AssetType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $assetTypes = $this->paginate($this->AssetTypes);

        $this->set(compact('assetTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assetType = $this->AssetTypes->get($id, [
            'contain' => [],
        ]);

        $this->set('assetType', $assetType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assetType = $this->AssetTypes->newEntity();
        if ($this->request->is('post')) {
            $assetType = $this->AssetTypes->patchEntity($assetType, $this->request->getData());
            if ($this->AssetTypes->save($assetType)) {
                $this->Flash->success(__('The asset type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset type could not be saved. Please, try again.'));
        }
        $this->set(compact('assetType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assetType = $this->AssetTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetType = $this->AssetTypes->patchEntity($assetType, $this->request->getData());
            if ($this->AssetTypes->save($assetType)) {
                $this->Flash->success(__('The asset type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset type could not be saved. Please, try again.'));
        }
        $this->set(compact('assetType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assetType = $this->AssetTypes->get($id);
        if ($this->AssetTypes->delete($assetType)) {
            $this->Flash->success(__('The asset type has been deleted.'));
        } else {
            $this->Flash->error(__('The asset type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function addModal()
    {
        $this->checkAuth();

        $this->request->allowMethod(['ajax', 'get']);
        $new_asset_type = $this->AssetTypes->newEntity();

        $this->set(compact('new_asset_type'));
    }

    public function saveModal()
    {
        $this->checkAuth();
        $this->request->allowMethod(['ajax', 'post']);
        $new_asset_type = $this->AssetTypes->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $new_asset_type = $this->AssetTypes->patchEntity($new_asset_type, $data);

            $new_asset_type->asset_type = $data['asset_type'];
            if ($this->AssetTypes->save($new_asset_type)) {
                $this->Flash->success(__('New asset category saved.'));

                return $this->redirect(['controller' => 'assets', 'action' => 'add']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $this->set(compact('new_asset_type'));
    }


    function checkAuth()
    {
        $user = $this->Auth->user();
        if (isset($user['type']) && $user['type'] === 'admin' ||
            isset($user['type']) && $user['type'] === 'staff') {

            $this->Auth->allow();
        }
        if (isset($user['type']) && $user['type'] === 'freelancer') {

            $this->Auth->allow();
        }
        if (isset($user['type']) && $user['type'] === 'client') {
            $this->Flash->error('YOU CAN NOT ACCESS THIS PAGE');
            $this->redirect(['controller' => 'bookings', 'action' => 'public_rehearsal_calendar']);
        }

    }
}
