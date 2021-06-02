<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
       $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Quotes');
        $this->loadModel('CancelledBookings');

        $confirmed = $this->Events->find('all');
        $pending = $this->Quotes->find('all');
        $cancelled = $this->CancelledBookings->find('all');

        $allBookings = array();

        foreach ($confirmed as $confirm) {
            array_push($allBookings, $confirm);
        }

        foreach ($pending as $pend) {
            array_push($allBookings, $pend);
        }

        foreach ($cancelled as $cancel) {
            array_push($allBookings, $cancel);
        }

        $this->set(compact('allBookings'));

        foreach ($confirmed as $row) {
            $row['start_event'] = $row['start_event']->format("d/m/Y");
            $row['end_event'] = $row['end_event']->format("d/m/Y");
        }

     foreach ($pending as $row) {
            $row['start_event'] = $row['start_event']->format("d/m/Y");
            $row['end_event'] = $row['end_event']->format("d/m/Y");
        }

        foreach ($cancelled as $row) {
            $row['start_event'] = $row['start_event']->format("d/m/Y");
            $row['end_event'] = $row['end_event']->format("d/m/Y");
        }

        $this->set(compact('confirmed'));
        $this->set(compact('pending'));
        $this->set(compact('cancelled'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $event = $this->Events->get($id, [
            'contain' => [],
        ]);




        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function exportEvents()
    {
        $this->response = $this->response->withDownload('confirmed-events-list.csv');
        $data = $this->Events->find('all');
        $_serialize = 'data';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }

    public function exportQuotes()
    {
        $this->loadModel('Quotes');

        $this->response = $this->response->withDownload('quotes-list.csv');
        $data = $this->Quotes->find('all');
        $_serialize = 'data';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }
}
