<?php

namespace App\Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 *
 * @method \App\Model\Entity\Asset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function index()
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Assets');

        $this->loadModel('AssetTypes');

        $assets = $this->AssetTypes->find('all')->contain(['Assets']);

        $this->set(compact('assets'));
    }

    /**
     * View method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Assets');

        $asset = $this->Assets->get($id, [
            'contain' => ['Bookings', 'AssetUsages'],
        ]);

        $this->set('asset', $asset);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Assets');

        $this->loadModel('AssetTypes');
        $types = $this->AssetTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'asset_type'
        ]);


        $this->set(compact('types'));

        $asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $asset = $this->Assets->patchEntity($asset, $data);


            $asset->asset_type = $this->AssetTypes->find()->select('asset_type')->where(['id IS' => $data['types']]);
            $asset->asset_name = $data['asset_name'];
            $asset->asset_rehearsal_charge = $data['asset_rehearsal_charge'];
            $asset->quantity = $data['quantity'];
            $asset->type_id = $data['types'];
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $bookings = $this->Assets->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'bookings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
      $this->checkAuth();

        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Assets');
        $asset = $this->Assets->get($id, [
            'contain' => ['Bookings'],
        ]);

        $asset_type_fk = $asset['type_id'];
        $this->loadModel('AssetTypes');
        $not_current_type = $this->AssetTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'asset_type'
        ])->where(function (QueryExpression $exp) use($asset_type_fk){
            return $exp
                ->notEq('id', $asset_type_fk);
        })->toArray();
        $this->set(compact('not_current_type'));

        $this->loadModel('AssetTypes');
        $types = $this->AssetTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'asset_type'
        ]);
        $this->set(compact('types'));

        $current_asset_category = $this->AssetTypes->find('list', ['keyField' => 'id', 'valueField' => 'asset_type'])->where(['id IS' => $asset_type_fk])->toArray();
        $this->set(compact('current_asset_category'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $asset = $this->Assets->patchEntity($asset, $data);

            $asset->asset_type = $this->AssetTypes->find()->select('asset_type')->where(['id IS' => $data['types']]);
            $asset->asset_name = $data['asset_name'];
            $asset->asset_rehearsal_charge = $data['asset_rehearsal_charge'];
            $asset->quantity = $data['quantity'];
            $asset->type_id = $data['types'];
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $bookings = $this->Assets->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
            $this->Flash->success(__('The asset has been deleted.'));
        } else {
            $this->Flash->error(__('The asset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addModal()
    {
        $this->checkAuth();

        $this->request->allowMethod(['ajax', 'get']);
        $newAsset = $this->Assets->newEntity();

        $assetAvailability = array();




        $this->set(compact('newAsset'));
    }

    public function saveModal()
    {
        $this->checkAuth();
        $this->request->allowMethod(['ajax', 'post']);
        $newAsset = $this->Assets->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $newAsset = $this->Assets->patchEntity($newAsset, $data);

            $newAsset->asset_type = $data['asset_type'];
            $newAsset->asset_name = $data['asset_type'];
            $newAsset->asset_rehearsal_charge = $data['asset_rehearsal_charge'];
            $newAsset->asset_availability = $data['asset_availability'];
            if ($this->Assets->save($newAsset)) {
                $this->Flash->success(__('The asset has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asset could not be saved. Please, try again.'));
        }
        $this->set(compact('newAsset'));
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
    public function export()
    {
        $this->response = $this->response->withDownload('asset-list.csv');
        $data = $this->Assets->find('all');
        $_serialize = 'data';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }


}
