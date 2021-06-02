<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BandsClients Controller
 *
 * @property \App\Model\Table\BandsClientsTable $BandsClients
 *
 * @method \App\Model\Entity\BandsClient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BandsClientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bands', 'Clients'],
        ];
        $bandsClients = $this->paginate($this->BandsClients);

        $this->set(compact('bandsClients'));
    }

    /**
     * View method
     *
     * @param string|null $id Bands Client id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bandsClient = $this->BandsClients->get($id, [
            'contain' => ['Bands', 'Clients'],
        ]);

        $this->set('bandsClient', $bandsClient);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bandsClient = $this->BandsClients->newEntity();
        if ($this->request->is('post')) {
            $bandsClient = $this->BandsClients->patchEntity($bandsClient, $this->request->getData());
            if ($this->BandsClients->save($bandsClient)) {
                $this->Flash->success(__('The bands client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bands client could not be saved. Please, try again.'));
        }
        $bands = $this->BandsClients->Bands->find('list', ['limit' => 200]);
        $clients = $this->BandsClients->Clients->find('list', ['limit' => 200]);
        $this->set(compact('bandsClient', 'bands', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bands Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bandsClient = $this->BandsClients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bandsClient = $this->BandsClients->patchEntity($bandsClient, $this->request->getData());
            if ($this->BandsClients->save($bandsClient)) {
                $this->Flash->success(__('The bands client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bands client could not be saved. Please, try again.'));
        }
        $bands = $this->BandsClients->Bands->find('list', ['limit' => 200]);
        $clients = $this->BandsClients->Clients->find('list', ['limit' => 200]);
        $this->set(compact('bandsClient', 'bands', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bands Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bandsClient = $this->BandsClients->get($id);
        if ($this->BandsClients->delete($bandsClient)) {
            $this->Flash->success(__('The bands client has been deleted.'));
        } else {
            $this->Flash->error(__('The bands client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
