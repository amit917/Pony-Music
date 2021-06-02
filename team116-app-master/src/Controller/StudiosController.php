<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Studios Controller
 *
 * @property \App\Model\Table\StudiosTable $Studios
 *
 * @method \App\Model\Entity\Studio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudiosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->checkAuth();
        $this->paginate = [
            'contain' => ['Locations'],
        ];
        $studios = $this->paginate($this->Studios);

        $this->set(compact('studios'));
    }

    /**
     * View method
     *
     * @param string|null $id Studio id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $studio = $this->Studios->get($id, [
            'contain' => ['Locations', 'Bookings', 'StudioUsages'],
        ]);

        $this->set('studio', $studio);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkAuth();
        $studio = $this->Studios->newEntity();
        if ($this->request->is('post')) {
            $studio = $this->Studios->patchEntity($studio, $this->request->getData());
            if ($this->Studios->save($studio)) {
                $this->Flash->success(__('The studio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The studio could not be saved. Please, try again.'));
        }
        $locations = $this->Studios->Locations->find('list', ['limit' => 200]);
        $this->set(compact('studio', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Studio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $studio = $this->Studios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studio = $this->Studios->patchEntity($studio, $this->request->getData());
            if ($this->Studios->save($studio)) {
                $this->Flash->success(__('The studio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The studio could not be saved. Please, try again.'));
        }
        $locations = $this->Studios->Locations->find('list', ['limit' => 200]);
        $this->set(compact('studio', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Studio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $studio = $this->Studios->get($id);
        if ($this->Studios->delete($studio)) {
            $this->Flash->success(__('The studio has been deleted.'));
        } else {
            $this->Flash->error(__('The studio could not be deleted. Please, try again.'));
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
}
