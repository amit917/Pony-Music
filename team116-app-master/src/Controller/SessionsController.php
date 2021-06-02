<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * Sessions Controller
 *
 * @property \App\Model\Table\SessionsTable $Sessions
 *
 * @method \App\Model\Entity\Session[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SessionsController extends AppController
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
        $this->set('topTitle', 'Rehearsal Session Times');


        $sessions = $this->paginate($this->Sessions);
        $this->set(compact('sessions'));


        $rehearsal_sessions = $this->Sessions->find()->select(['id', 'session_day_start', 'session_day_end', 'session_day_charge', 'session_night_start', 'session_night_end', 'session_night_charge'])->toArray();
        foreach ($rehearsal_sessions as $row) {
            if ($row['session_day_start']->format('i') != '00') {
                $row['session_day_start'] = $row['session_day_start']->format("g:ia");
            } else {
                $row['session_day_start'] = $row['session_day_start']->format("ga");
            }

            if ($row['session_day_end']->format('i') != '00') {
                $row['session_day_end'] = $row['session_day_end']->format("g:ia");
            } else {
                $row['session_day_end'] = $row['session_day_end']->format("ga");
            }

            if ($row['session_night_start']->format('i') != '00') {
                $row['session_night_start'] = $row['session_night_start']->format("g:ia");
            } else {
                $row['session_night_start'] = $row['session_night_start']->format("ga");
            }

            if ($row['session_night_end']->format('i') != '00') {
                $row['session_night_end'] = $row['session_night_end']->format("g:ia");
            } else {
                $row['session_night_end'] = $row['session_night_end']->format("ga");
            }
        }
        $this->set(compact('rehearsal_sessions'));

        $dow = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $this->set(compact('dow'));
    }

    /**
     * View method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $session = $this->Sessions->get($id, [
            'contain' => ['Rooms'],
        ]);

        $this->set('session', $session);
    }

    /**
     * Edit method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Edit Session Time');

        $session = $this->Sessions->get($id, [
            'contain' => [],
        ]);

        if ($session['id'] == 1) {
            $cardTitle = 'Monday';
        } elseif ($session['id'] == 2) {
            $cardTitle = 'Tuesday';
        } elseif ($session['id'] == 3) {
            $cardTitle = 'Wednesday';
        } elseif ($session['id'] == 4) {
            $cardTitle = 'Thursday';
        } elseif ($session['id'] == 5) {
            $cardTitle = 'Friday';
        } elseif ($session['id'] == 6) {
            $cardTitle = 'Saturday';
        } else {
            $cardTitle = 'Sunday';
        }


   $this->set(compact('cardTitle'));


        if ($this->request->is(['patch', 'post', 'put'])) {
            $session = $this->Sessions->patchEntity($session, $this->request->getData());
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be saved. Please, try again.'));
        }
        $this->set(compact('session'));
    }


    public function editModal()
    {
        $this->checkAuth();

        $this->request->allowMethod(['ajax', 'get']);
        $editSession = $this->Sessions->newEntity();

        $this->set(compact('editSession'));
    }

    public function saveModal()
    {
        $this->checkAuth();
        $this->request->allowMethod(['ajax', 'post']);
        $editSession = $this->Sessions->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $editSession = $this->Sessions->patchEntity($editSession, $data);

            $editSession->session_day_start = $data['session_day_start'];
            $editSession->session_day_end = $data['session_day_end'];
            $editSession->session_day_charge = $data['session_day_charge'];
            $editSession->session_night_start = $data['session_night_start'];
            $editSession->session_night_end = $data['session_night_end'];
            $editSession->session_night_charge = $data['session_night_charge'];
            if ($this->Sessions->save($editSession)) {
                $this->Flash->success(__('This session has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be updated. Please, try again.'));
        }
        $this->set(compact('editSession'));
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
