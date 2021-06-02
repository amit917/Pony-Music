<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CancelledBookings Controller
 *
 * @property \App\Model\Table\CancelledBookingsTable $CancelledBookings
 *
 * @method \App\Model\Entity\CancelledBooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CancelledBookingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $cancelledBookings = $this->paginate($this->CancelledBookings);

        $this->set(compact('cancelledBookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Cancelled Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      $this->viewBuilder()->setLayout('admin');
        $cancelledBooking = $this->CancelledBookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cancelledBooking = $this->CancelledBookings->patchEntity($cancelledBooking, $this->request->getData());
            if ($this->CancelledBookings->save($cancelledBooking)) {
                $this->Flash->success(__('The cancelled booking has been saved.'));

                return $this->redirect(['controller' => 'events', 'action' => 'index']);
            }
            $this->Flash->error(__('The cancelled booking could not be saved. Please, try again.'));
        }
        $this->set(compact('cancelledBooking'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cancelledBooking = $this->CancelledBookings->newEntity();
        if ($this->request->is('post')) {
            $cancelledBooking = $this->CancelledBookings->patchEntity($cancelledBooking, $this->request->getData());
            if ($this->CancelledBookings->save($cancelledBooking)) {
                $this->Flash->success(__('The cancelled booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cancelled booking could not be saved. Please, try again.'));
        }
        $this->set(compact('cancelledBooking'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cancelled Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

    }

    /**
     * Delete method
     *
     * @param string|null $id Cancelled Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cancelledBooking = $this->CancelledBookings->get($id);
        if ($this->CancelledBookings->delete($cancelledBooking)) {
            $this->Flash->success(__('The cancelled booking has been deleted.'));
        } else {
            $this->Flash->error(__('The cancelled booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
