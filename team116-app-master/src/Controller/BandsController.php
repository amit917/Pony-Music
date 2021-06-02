<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Bands Controller
 *
 * @property \App\Model\Table\BandsTable $Bands
 *
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BandsController extends AppController
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
        $this->set('topTitle', 'Bands');

        $bands = $this->paginate($this->Bands);

        $this->set(compact('bands'));
    }

    /**
     * View method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Bands');

        $band = $this->Bands->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set('band', $band);
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
        $this->set('topTitle', 'Bands');

        $band = $this->Bands->newEntity();
        if ($this->request->is('post')) {
            $band = $this->Bands->patchEntity($band, $this->request->getData());
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('The band has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The band could not be saved. Please, try again.'));
        }
        $clients = $this->Bands->Clients->find('list', ['limit' => 200]);
        $this->set(compact('band', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Bands');

        $band = $this->Bands->get($id, [
            'contain' => ['Clients'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $band = $this->Bands->patchEntity($band, $this->request->getData());
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('The band has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The band could not be saved. Please, try again.'));
        }
        $clients = $this->Bands->Clients->find('list', ['limit' => 200]);
        $this->set(compact('band', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $band = $this->Bands->get($id);
        if ($this->Bands->delete($band)) {
            $this->Flash->success(__('The band has been deleted.'));
        } else {
            $this->Flash->error(__('The band could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function search()
    {
        $this->checkAuth();

        $this->request->allowMethod('ajax');
        $keyword = $this->request->getQuery('keyword');
        $query = $this->Bands->find('all', [
            'conditions' => ['band_name LIKE' => '%' . $keyword . '%'],
            'order' => ['Bands.id' => 'DESC'],
            'limit' => 10
        ]);
        $this->set('bands', $this->paginate($query));
        $this->set('_serialize', ['bands']);

    }
    function checkAuth(){
        $user = $this->Auth->user();
        if (isset($user['type']) && $user['type'] === 'admin' ||
            isset($user['type']) && $user['type'] === 'staff' ) {

            $this->Auth->allow();
        }
        if (isset($user['type']) && $user['type'] === 'freelancer') {

            $this->Auth->allow();
        }
        if (isset($user['type'])&& $user['type'] === 'client') {
            $this->Flash->error('YOU CAN NOT ACCESS THIS PAGE');
            $this->redirect(['controller' => 'bookings', 'action' => 'public_rehearsal_calendar']);
        }

    }
}
