<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AssetsBookings Controller
 *
 * @property \App\Model\Table\AssetsBookingsTable $AssetsBookings
 *
 * @method \App\Model\Entity\AssetsBooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssetsBookingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Assets', 'Bookings'],
        ];
        $assetsBookings = $this->paginate($this->AssetsBookings);

        $this->set(compact('assetsBookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Assets Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assetsBooking = $this->AssetsBookings->get($id, [
            'contain' => ['Assets', 'Bookings'],
        ]);

        $this->set('assetsBooking', $assetsBooking);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assetsBooking = $this->AssetsBookings->newEntity();
        if ($this->request->is('post')) {
            $assetsBooking = $this->AssetsBookings->patchEntity($assetsBooking, $this->request->getData());
            if ($this->AssetsBookings->save($assetsBooking)) {
                $this->Flash->success(__('The assets booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assets booking could not be saved. Please, try again.'));
        }
        $assets = $this->AssetsBookings->Assets->find('list', ['limit' => 200]);
        $bookings = $this->AssetsBookings->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('assetsBooking', 'assets', 'bookings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assets Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assetsBooking = $this->AssetsBookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assetsBooking = $this->AssetsBookings->patchEntity($assetsBooking, $this->request->getData());
            if ($this->AssetsBookings->save($assetsBooking)) {
                $this->Flash->success(__('The assets booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assets booking could not be saved. Please, try again.'));
        }
        $assets = $this->AssetsBookings->Assets->find('list', ['limit' => 200]);
        $bookings = $this->AssetsBookings->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('assetsBooking', 'assets', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assets Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assetsBooking = $this->AssetsBookings->get($id);
        if ($this->AssetsBookings->delete($assetsBooking)) {
            $this->Flash->success(__('The assets booking has been deleted.'));
        } else {
            $this->Flash->error(__('The assets booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
