<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
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
        $this->set('topTitle', 'Clients');

        $clients = $this->Clients->find('all')->contain(['Bands', 'Bookings']);


        $this->set(compact('clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   public function view($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'View Client');


        $this->loadModel('Clients');
        $this->loadModel('Bands');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');



        $client = $this->Clients->get($id, [
            'contain' => ['Bands', 'Bookings'],
        ]);



   $bookingsList = array();
        foreach ($client['bookings'] as $bookings) {
            $bookings['booking_date_from'] = $bookings['booking_date_from']->format("d/m/Y");
            array_push($bookingsList, $bookings);
        }


        if (!empty($bookingsList[0]['room_id'])){
            $room_number = $this->Rooms->find()->select(['room_number'])->where(['id IS' => $bookingsList[0]['room_id']])->toArray();
            $this->set(compact('room_number'));
        }
        elseif (empty($bookingsList[0]['room_id'])) {
            $room_number = ['Cancelled'];
            $this->set(compact('room_number'));
        }

        $bandsList = array();
        foreach ($client['bands'] as $bands) {
            array_push($bandsList, $bands);
        }

        $this->set(compact('bookingsList'));
        $this->set(compact('bandsList'));
        $this->set(compact('client'));
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
        $this->set('topTitle', 'Clients');

        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $bands = $this->Clients->Bands->find('list', ['limit' => 200]);
        $bookings = $this->Clients->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('client', 'bands', 'bookings'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Edit Client');

        $this->loadModel('Clients');
        $client = $this->Clients->get($id, [
            'contain' => ['Bands', 'Bookings'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $client = $this->Clients->patchEntity($client,$data);

            $client->client_fname = $data['client_fname'];
            $client->client_lname = $data['client_lname'];
            $client->client_phone = $data['client_phone'];
            $client->client_email = $data['client_email'];

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Client information has been saved.'));
                return $this->redirect(['action' => 'view', $client->id]);
            } else {
                $this->Flash->error(__('Client information could not be saved. Please, try again.'));
            }
        }
        $bands = $this->Clients->Bands->find('list', ['limit' => 200]);
        $bookings = $this->Clients->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('client', 'bands', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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

    public function export()
    {
        $this->response = $this->response->withDownload('client-list.csv');
        $data = $this->Clients->find('all');
        $_serialize = 'data';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }
}
