<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Staffs Controller
 *
 * @property \App\Model\Table\StaffsTable $Staffs
 *
 * @method \App\Model\Entity\Staff[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StaffsController extends AppController
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
        $this->set('topTitle', 'staff list');
        
        $this->loadModel('Users');

        $admins = $this->Users->find('all')->where(['type IS' => 'admin']);
        $this->set(compact('admins'));
        
        $staffs = $this->Staffs->find('all');
        $this->set(compact('staffs'));
    }

    /**
     * View method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Staffs');

        $staff = $this->Staffs->get($id);

        $this->set('staffs', $staff);
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
        $this->set('topTitle','Staff sugn up');
        $staff = $this->Staffs->newEntity();
        if ($this->request->is('post')) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->getData());
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('The new staff member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The new staff member could not be saved. Please, try again.'));
        }
        $this->set(compact('staff'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $staff = $this->Staffs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->getData());
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('Staff member information has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Staff member information could not be saved. Please, try again.'));
        }
        $this->set(compact('staff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $staff = $this->Staffs->get($id);
        if ($this->Staffs->delete($staff)) {
            $this->Flash->success(__('Staff member has been deleted.'));
        } else {
            $this->Flash->error(__('Staff member could not be deleted. Please, try again.'));
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
