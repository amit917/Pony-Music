<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Checkout Controller
 *
 * @property \App\Model\Table\CheckoutTable $Checkout
 *
 * @method \App\Model\Entity\Checkout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckoutController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bookings'],
        ];
        $checkout = $this->paginate($this->Checkout);

        $this->set(compact('checkout'));
    }

    /**
     * View method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkout = $this->Checkout->get($id, [
            'contain' => ['Bookings'],
        ]);

        $this->set('checkout', $checkout);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkout = $this->Checkout->newEntity();
        if ($this->request->is('post')) {
            $checkout = $this->Checkout->patchEntity($checkout, $this->request->getData());
            if ($this->Checkout->save($checkout)) {
                $this->Flash->success(__('The checkout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
        }
        $bookings = $this->Checkout->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('checkout', 'bookings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkout = $this->Checkout->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkout = $this->Checkout->patchEntity($checkout, $this->request->getData());
            if ($this->Checkout->save($checkout)) {
                $this->Flash->success(__('The checkout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
        }
        $bookings = $this->Checkout->Bookings->find('list', ['limit' => 200]);
        $this->set(compact('checkout', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkout id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkout = $this->Checkout->get($id);
        if ($this->Checkout->delete($checkout)) {
            $this->Flash->success(__('The checkout has been deleted.'));
        } else {
            $this->Flash->error(__('The checkout could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
