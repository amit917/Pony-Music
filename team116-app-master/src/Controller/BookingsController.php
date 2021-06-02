<?php

namespace App\Controller;


use App\Controller\AppController;

use SquareConnect\Api\CheckoutApi;
use SquareConnect\ApiClient;
use SquareConnect\ApiException;
use SquareConnect\Configuration;
use SquareConnect\Model\BatchRetrieveOrdersRequest;
use SquareConnect\Model\CreateCheckoutRequest;
use SquareConnect\Model\CreateOrderRequest;
use SquareConnect\Model\CreateOrderRequestLineItem;
use SquareConnect\Model\Money;
use cake\ORM\TableRegistry;
use SquareConnect\Api\OrdersApi;
use Cake\Mailer\Email;
use Cake\Validation\Validator;
use Cake\Mailer\TransportFactory;


/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 *
 * @method \App\Model\Entity\Booking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public $bookingList;


    public function recordingCalendar()
    {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('admin_fullcalendar');

    }

    public function recordingAdd()
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin_fullcalendar');
        $recording = $this->Bookings->newEntity();


        $this->set(compact('recording'));
    }

    public function index()
    {
        $this->checkAuth();
        $this->paginate = [
            'contain' => ['Rooms', 'Studios'],
        ];
        $bookings = $this->paginate($this->Bookings);


        $this->set(compact('bookings'));
    }
    

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $booking = $this->Bookings->get($id, [
            'contain' => ['Rooms', 'Studios', 'Assets', 'Clients'],
        ]);

        $this->set('booking', $booking);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     *
     */
    public function add()
    {
        $this->checkAuth();
        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $rooms = $this->Bookings->Rooms->find('list', ['limit' => 200]);
        $studios = $this->Bookings->Studios->find('list', ['limit' => 200]);
        $assets = $this->Bookings->Assets->find('list', ['limit' => 200]);
        $clients = $this->Bookings->Clients->find('list', ['limit' => 200]);
        $this->set(compact('booking', 'rooms', 'studios', 'assets', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();


        $booking = $this->Bookings->get($id, [
            'contain' => ['Assets', 'Clients'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
         
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $rooms = $this->Bookings->Rooms->find('list', ['limit' => 200]);
        $studios = $this->Bookings->Studios->find('list', ['limit' => 200]);
        /*$assets = $this->Bookings->Assets->find('list', ['limit' => 200]);*/
        $assets = $this->Bookings->Assets->find('list', [
            'keyField' => 'id',
            'valueField' => function ($current_asset) {
                return $current_asset->asset_type . ' $' . $current_asset->asset_rehearsal_charge;
            }
        ]);
        $clients = $this->Bookings->Clients->find('list', ['limit' => 200]);
        $this->set(compact('booking', 'rooms', 'studios', 'assets', 'clients'));
    }

    public function confirmBooking()
    {
        $this->loadModel('Events');
        $this->loadModel('Clients');
        $this->loadModel('Quotes');
        $this->loadModel('cancelled_bookings');



        if ($this->request->is('post')&& $this->request->getData('submit') === 'Confirm') {
            $new_events = $this->Events->newEntity();
            $data = $this->request->getData();
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            //$new_events->To_date = $data['end_date'];
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->title = $data['requested_display_name'];
            $new_events->notes = $data['notes'];

            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->band_name = $data['requested_band_name'];
            $new_events->display_name = $data['requested_display_name'];
            $new_events->user_email =  $data['user_id'];

            $this->Events->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->Quotes->get($id);
            $result = $this->Quotes->delete($entity);

            return $this->redirect(['action' => 'staffRecordingCalendar']);


        };
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Confirm ') {
            $new_events = $this->Events->newEntity();
            $data = $this->request->getData();
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            //$new_events->To_date = $data['end_date'];
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->title = $data['requested_display_name'];
            $new_events->notes = $data['notes'];

            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->band_name = $data['requested_band_name'];
            $new_events->display_name = $data['requested_display_name'];
            $new_events->user_email =  $data['user_id'];
            $this->Events->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->cancelled_bookings->get($id);
            $result = $this->cancelled_bookings->delete($entity);

            return $this->redirect(['action' => 'staffRecordingCalendar']);


        };
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Confirmed') {
            $new_events = $this->Events->newEntity();
            $data = $this->request->getData();
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->title = $data['requested_display_name'];
            $new_events->notes = $data['notes'];
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->band_name = $data['requested_band_name'];
            $new_events->display_name = $data['requested_display_name'];

            $this->Events->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->Events->get($id);
            $result = $this->Events->delete($entity);

            return $this->redirect(['action' => 'staffRecordingCalendar']);


        };
        if ($this->request->is('post')&& $this->request->getData('submit') === 'REQUEST') {
            $data = $this->request->getData();
            $new_events = $this->Quotes->newEntity();
            $new_events->display_name = $data['requested_display_name'];
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];
            $this->Quotes->save($new_events);
            $id = $data['quote_id'];

            $entity = $this->Quotes->get($id);
            $result = $this->Quotes->delete($entity);




            return $this->redirect(['action' => 'staffRecordingCalendar']);


        };
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Canceled') {
            $data = $this->request->getData();
            $new_events = $this->cancelled_bookings->newEntity();
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->display_name = $data['requested_display_name'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];



            $this->cancelled_bookings->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->cancelled_bookings->get($id);
            $result = $this->cancelled_bookings->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);

        };



        if ($this->request->is('post')&& $this->request->getData('submit') === 'Cancel'){
            $data = $this->request->getData();
            $new_events = $this->cancelled_bookings->newEntity();
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
           $new_events->display_name = $data['requested_display_name'];
            $new_events->notes = $data['notes'];
            $new_events->user_id = $data['user_id'];
            $new_events->band_name = $data['requested_band_name'];
           



            $this->cancelled_bookings->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->Quotes->get($id);
            $result = $this->Quotes->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }
         if ($this->request->is('post')&& $this->request->getData('submit') === 'Delete '){
            $data = $this->request->getData();
            $id = $data['quote_id'];
            $entity = $this->Quotes->get($id);
            $result = $this->Quotes->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }
         if ($this->request->is('post')&& $this->request->getData('submit') === 'Delete  '){
            $data = $this->request->getData();
            $id = $data['quote_id'];
            $entity = $this->Events->get($id);
            $result = $this->Events->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }
         if ($this->request->is('post')&& $this->request->getData('submit') === 'Delete'){
            $data = $this->request->getData();
            $id = $data['quote_id'];
            $entity = $this->cancelled_bookings->get($id);
            $result = $this->cancelled_bookings->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Cancel '){
            $data = $this->request->getData();
            $new_events = $this->cancelled_bookings->newEntity();

            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->display_name = $data['requested_display_name'];
            $new_events->notes = $data['notes'];
            $new_events->user_id = $data['user_id'];
            $new_events->band_name = $data['requested_band_name'];



            $this->cancelled_bookings->save($new_events);
            $id = $data['quote_id'];
            $entity = $this->Events->get($id);
            $result = $this->Events->delete($entity);



            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }

        if ($this->request->is('post')&& $this->request->getData('submit') === 'Pending   '){
            $data = $this->request->getData();
            $new_events = $this->Quotes->newEntity();
            $new_events->display_name = $data['requested_display_name'];
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];
            $new_events->user_id = $data['user_id'];
            $this->Quotes->save($new_events);
            $id = $data['quote_id'];

            $entity = $this->cancelled_bookings->get($id);
            $result = $this->cancelled_bookings->delete($entity);




            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Pending'){
            $data = $this->request->getData();
            $new_events = $this->Quotes->newEntity();
            $new_events->display_name = $data['requested_display_name'];
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];
            $new_events->user_id =(int) $data['user_id'];
            $this->Quotes->save($new_events);
            $id = $data['quote_id'];

            $entity = $this->Events->get($id);
            $result = $this->Events->delete($entity);




            return $this->redirect(['action' => 'staffRecordingCalendar']);



        }

        return $this->redirect(['action' => 'staffRecordingCalendar']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function staffRehearsalCalendar()
    {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Booking Calendar');


    }

    public function freelanceRehearsalCalendar()
    {


        $this->viewBuilder()->setLayout('client');
        $this->set('topTitle', 'Booking Calendar');


    }

    public function publicRehearsalCalendar()
    {

        $this->viewBuilder()->setLayout('public');
        $this->set('topTitle', 'Booking Calendar');


    }

    public function cancelledBookingReport()
    {

        $this->viewBuilder()->setLayout('admin');

        $this->set('stmt2', '');
        $this->set('topTitle', '');

        $conn = \Cake\Datasource\ConnectionManager::get('default');


        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $client_phone = $data['client_phone'];
            $stmt2 = $conn->execute("SELECT * FROM `cancelled_bookings` WHERE client_phone = '" . $client_phone . "'");
            $this->set('stmt2', $stmt2);
        }


    }

    public function staffRecordingCalendar()
    {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('admin');
        
        $conn = \Cake\Datasource\ConnectionManager::get('default');
         $this->loadModel('quotes');
        $stmt = $conn->execute(' select * from events');
        $stmt1 = $conn->execute(' select * from quotes');
        
       
        
       
        $new_events = $this->quotes->newEntity();

        if ($this->request->is('post')) {
        
           
            $data = $this->request->getData();
            
            $new_events->display_name = $data['display_name'];
            $start_date = date("Y-m-d", strtotime($data['start_date']));
            $new_events->start_event = $start_date;
            //$new_events->To_date = $data['end_date'];
            $end_date = $data['end_date'];
            $end_date = date("Y-m-d", strtotime($data['end_date']));
            $new_events->end_event = date('Y-m-d', strtotime('+1 day', strtotime($end_date)));


            $new_events->client_fname = $data['client_fname'];
            $new_events->client_lname = $data['client_lname'];
            $new_events->client_phone = $data['client_phone'];
            $new_events->client_email = $data['client_email'];
            $new_events->band_name = $data['band_name'];
            
          
               

            $new_events->notes = htmlspecialchars($data['notes']);

            $this->quotes->save($new_events);
            return $this->redirect(['action' => 'staffRecordingCalendar']);

        }

    }

   

    public function freelancerEdit(){
        
        $this->loadModel('quotes');
        $this->loadModel('events');
        if ($this->request->is('post')&& $this->request->getData('submit') === 'Edit-notes') {
            $data = $this->request->getData();
            $new_events = $this->quotes->newEntity();
            $new_events->display_name = $data['requested_display_name'];
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];
            $session = $this->getRequest()->getSession();
            $new_events->user_email = $session->read('Auth.User.email');
            $this->quotes->save($new_events);
            $id = $data['quote_id'];

            $entity = $this->quotes->get($id);
            $result = $this->quotes->delete($entity);
            return $this->redirect(['action' => 'freelancer_recording_calendar']);


        }
         if ($this->request->is('post')&& $this->request->getData('submit') === 'Edit-Notes  ') {
            $data = $this->request->getData();
            $new_events = $this->quotes->newEntity();
            $new_events->display_name = $data['requested_display_name'];
            $start_date = date ("Y-m-d",strtotime($data['requested_start_date']));
            $new_events->start_event = $start_date;
            $end_date1 =  strtotime("+1 day", strtotime($data['requested_end_date']));
            $end_date = date ("Y-m-d",$end_date1);
            $new_events->end_event =$end_date;
            $new_events->client_fname = $data['future_client_fname'];
            $new_events->client_lname = $data['future_client_lname'];
            $new_events->client_phone = $data['future_client_phone'];
            $new_events->client_email = $data['future_client_email'];
            $new_events->notes = $data['notes'];
            $new_events->band_name = $data['requested_band_name'];
            $session = $this->getRequest()->getSession();
            $new_events->user_email = $session->read('Auth.User.email');
            $this->events->save($new_events);
            $id = $data['quote_id'];

            $entity = $this->events->get($id);
            $result = $this->events->delete($entity);
            return $this->redirect(['action' => 'freelancer_recording_calendar']);


        }
    }
    public function clientRecordingCalendar()
    {

        $this->viewBuilder()->setLayout('client');
        $this->set('topTitle', 'Booking Calendar');
        $this->loadModel('Events');
        $this->loadModel('Clients');
        $new_events = $this->Events->newEntity();
        $new_clients = $this->Clients->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $new_events->title = $data['Display_name'];
            $new_events->start_event = $data['start_date'];
            $actual_date = $data['end_date'];
            $actual_day = (int)substr($actual_date, -2);
            $actual_day = (string)($actual_day + 1);
            $actualEndDate2 = substr($actual_date, 0, 8) + $actual_day;

            $new_events->end_event = $data['end_date'];
            $new_clients->client_fname = $data['client_fname'];
            $new_clients->client_lname = $data['client_lname'];
            $new_clients->client_phone = $data['client_phone'];
            $new_clients->client_email = $data['client_email'];
            $this->Events->save($new_events);
            $this->Clients->save($new_clients);

        }
    }

    public function publicRecordingCalendar()
    {

        $this->viewBuilder()->setLayout('public');
        $this->set('topTitle', 'Booking Calendar');

        if ($this->request->is('post')) {
            
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                
                if ($this->Auth->user('type') == 'admin') { 
                     $data = $this->request->getData();
                    
                    $var = $data['start_event'];
                    $var1= $data['end_event'];

                    return $this->redirect(['controller' => 'bookings', 'action' => 'staff_recording_calendar', "param1" => "val1", "start-date" => "$var","end-date"=>"$var1", $this->Auth->user('id')]);
                }
                if ($this->Auth->user('type') == 'staff') {

                    return $this->redirect(['controller' => 'bookings', 'action' => 'staff_recording_calendar', $this->Auth->user('id')]);
                }
                if ($this->Auth->user('type') == 'Freelancer') {
                    $data = $this->request->getData();
                    
                    $var = $data['start_event'];
                    $var1= $data['end_event'];

                    return $this->redirect(['controller' => 'bookings', 'action' => 'freelancer_recording_calendar', "param1" => "val1", "start-date" => "$var","end-date"=>"$var1", $this->Auth->user('id')]);
                  
                }
            }
            $this->Flash->error(__('Invalid email or password, please try again'));
        }

    }

    public function publicRecordingCalendarLogin()
    {

    }

    

    public function staffRehearsalForm($id = null)
    {
        $this->checkAuth();

        //Set booking form layout.
        $this->viewBuilder()->setLayout('admin');

        $this->set('topTitle', 'Add a Booking');
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');
        $this->loadModel('Locations');
        $this->loadModel('Sessions');

        //List all assets.
        $drum_list = array();
        $amp_list = array();
        $other_list = array();
        $conn=\Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

        foreach ($ans = $stmt->fetchAll() as $row) {

            $AMFullTime = $row[0] . "-" . $row[1];
            $PMFullTime = $row[2] . "-" . $row[3];


            if ($AMFullTime == $_GET["timestamp"]) {
                $Assets_session= 'AM';

            } elseif ($PMFullTime == $_GET["timestamp"]) {
                $Assets_session= 'PM';


            }


        }
        $asset_array=$this->Assets->find('all');
        $roomDate=$_GET["date"];
        $d=explode('-',$roomDate);
        $asd=$d[0].$d[1].$d[2];
        $sum=0;


        foreach($asset_array as $asset){
            
            $asset_usage=$conn->execute("select assets_bookings.quantity_request,b.id from assets_bookings 
            inner join bookings b on assets_bookings.booking_id=b.id
            where b.status='completed' and assets_bookings.assets_bookings_date=$asd
            and assets_bookings.assets_bookings_session='$Assets_session' and assets_bookings.asset_id=$asset[id]");
                                                             
            $usage=$asset_usage->fetchAll();
            
            foreach ($usage as $ava){
                $sum+=$ava[0];
                
            }
            if($asset['quantity']>$sum){
                $sum=0;

                if ($asset['asset_type'] === 'Drums') {
                    array_push($drum_list, $asset);
                    $this->set(compact('drum_list'));
                } elseif ($asset['asset_type'] === 'Amplifiers') {
                    array_push($amp_list, $asset);
                    $this->set(compact('amp_list'));
                } elseif ($asset['asset_type'] === 'Other') {
                    array_push($other_list, $asset);
                    $this->set(compact('other_list'));
                }

            }
            $sum=0;

        }
        
        $rooms = $this->Rooms->find()->where(['id IS' => $id]);
        $this->set(compact('rooms'));

        //Create a new Bookings entity.
        $bookings = $this->Bookings->newEntity();
        $this->set(compact('bookings'));

        $bookings_clients = $this->BookingsClients->newEntity();
        $this->set(compact('bookings_clients'));

        //Create a new Clients entity.
        //Shouldn't create a new Client entity if they already exist (potential search via their phone number).
        $existing_clients = $this->Clients->find();
        $this->set(compact('existing_clients'));

        $new_clients = $this->Clients->newEntity();
        $this->set(compact('new_clients'));
        $checkoutUrl = "#0";

        $this->set(compact('checkoutUrl'));

        if ($this->request->is('post')) {


            //Retrieve the data.
            $data = $this->request->getData();
            //debug($data);

            $this->bookingList = $data;
            if (isset($data['instruments'])) {
                $instruments = $data['instruments'];
                $result = array();


                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($result, $ind[0]);

                    }

                }
                $this->set(compact('result'));

                $sum = 0;
                if (!empty($result)) {

                    foreach ($result as $id) {
                        $conn = \Cake\Datasource\ConnectionManager::get('default');
                        $stmt = $conn->execute(' select asset_name,asset_rehearsal_charge from assets where id=' . $id);
                        foreach ($ans = $stmt->fetchAll() as $row) {
                            $sum += $row[1];


                        }

                    }
                }
                $sum += $data['booking_total_charge'];
            }
            $sum = $data['booking_total_charge'];


            //
            if ($data['btn'] == 'Charge_card') {
                $this->checkout($sum, $data);
            } elseif ($data['btn'] == 'Booking_without_charge') {
                $this->bookFree($data);
            }


        }


    }

    public function clientRehearsalForm($id = null)
    {

        //Set booking form layout.
        $this->viewBuilder()->setLayout('client');

        $this->set('topTitle', 'Add a Booking');
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');
        $this->loadModel('Locations');
        $this->loadModel('Sessions');

        //List all assets.
        $assets = $this->Assets->find('list', [
            'keyField' => 'id',
            'valueField' => function ($current_asset) {
                return $current_asset->asset_type . ' $' . $current_asset->asset_rehearsal_charge;
            }
        ]);
        $assets = $assets->toArray();
        $this->set(compact('assets'));
        $rooms = $this->Rooms->find()->where(['id IS' => $id]);
        $this->set(compact('rooms'));

        //Create a new Bookings entity.
        $bookings = $this->Bookings->newEntity();
        $this->set(compact('bookings'));

        $bookings_clients = $this->BookingsClients->newEntity();
        $this->set(compact('bookings_clients'));

        //Create a new Clients entity.
        //Shouldn't create a new Client entity if they already exist (potential search via their phone number).
        $existing_clients = $this->Clients->find();
        $this->set(compact('existing_clients'));

        $new_clients = $this->Clients->newEntity();
        $this->set(compact('new_clients'));
        $checkoutUrl = "#0";

        $this->set(compact('checkoutUrl'));

        if ($this->request->is('post')) {

            //Retrieve the data.
            $data = $this->request->getData();

            $this->bookingList = $data;
            if (isset($data['instruments'])) {
                $instruments = $data['instruments'];
                $result = array();


                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($result, $ind[0]);

                    }

                }
                $this->set(compact('result'));
                $sum = 0;
                if (!empty($result)) {

                    foreach ($result as $id) {
                        $conn = \Cake\Datasource\ConnectionManager::get('default');
                        $stmt = $conn->execute(' select asset_name,asset_rehearsal_charge from assets where id=' . $id);
                        foreach ($ans = $stmt->fetchAll() as $row) {
                            $sum += $row[1];


                        }

                    }
                }
                $sum += $data['booking_total_charge'];

            } else {
                $sum = $data['booking_total_charge'];
            }


            $this->checkout($sum, $data);


        }


    }

    public function publicRehearsalForm($id = null)
    {

        //Set booking form layout.
        $this->viewBuilder()->setLayout('public');

        $this->set('topTitle', 'Add a Booking');
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');
        $this->loadModel('Locations');
        $this->loadModel('Sessions');
        $this->loadModel('Notes');

        //List all assets.
           $drum_list = array();
        $amp_list = array();
        $other_list = array();
        $conn=\Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

        foreach ($ans = $stmt->fetchAll() as $row) {

            $AMFullTime = $row[0] . "-" . $row[1];
            $PMFullTime = $row[2] . "-" . $row[3];


            if ($AMFullTime == $_GET["timestamp"]) {
                $Assets_session= 'AM';

            } elseif ($PMFullTime == $_GET["timestamp"]) {
                $Assets_session= 'PM';


            }


        }
        $asset_array=$this->Assets->find('all');
        $roomDate=$_GET["date"];
        $d=explode('-',$roomDate);
        $asd=$d[0].$d[1].$d[2];
        $sum=0;


        foreach($asset_array as $asset){
            
            $asset_usage=$conn->execute("select assets_bookings.quantity_request,b.id from assets_bookings 
            inner join bookings b on assets_bookings.booking_id=b.id
            where b.status='completed' and assets_bookings.assets_bookings_date=$asd
            and assets_bookings.assets_bookings_session='$Assets_session' and assets_bookings.asset_id=$asset[id]");
                                                             
            $usage=$asset_usage->fetchAll();
            
            foreach ($usage as $ava){
                $sum+=$ava[0];
                
            }
            if($asset['quantity']>$sum){
                $sum=0;

                if ($asset['asset_type'] === 'Drums') {
                    array_push($drum_list, $asset);
                    $this->set(compact('drum_list'));
                } elseif ($asset['asset_type'] === 'Amplifiers') {
                    array_push($amp_list, $asset);
                    $this->set(compact('amp_list'));
                } elseif ($asset['asset_type'] === 'Other') {
                    array_push($other_list, $asset);
                    $this->set(compact('other_list'));
                }

            }
            $sum=0;

        }
        $rooms = $this->Rooms->find()->where(['id IS' => $id]);
        $this->set(compact('rooms'));

        //Create a new Bookings entity.
        $bookings = $this->Bookings->newEntity();
        $this->set(compact('bookings'));

        $bookings_clients = $this->BookingsClients->newEntity();
        $this->set(compact('bookings_clients'));

        //Create a new Clients entity.
        //Shouldn't create a new Client entity if they already exist (potential search via their phone number).
        $existing_clients = $this->Clients->find();
        $this->set(compact('existing_clients'));

        $new_clients = $this->Clients->newEntity();
        $this->set(compact('new_clients'));
        $checkoutUrl = "#0";

        $this->set(compact('checkoutUrl'));

        $note = $this->Notes->newEntity();
        $this->set(compact('note'));

        if ($this->request->is('post')) {

            //Retrieve the data.
            $data = $this->request->getData();
            $this->bookingList = $data;


            if (isset($data['instruments'])) {
                $instruments = $data['instruments'];
                $result = array();


                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($result, $ind[0]);

                    }

                }
                $this->set(compact('result'));

                $sum = 0;
                if (!empty($result)) {

                    foreach ($result as $id) {
                        $conn = \Cake\Datasource\ConnectionManager::get('default');
                        $stmt = $conn->execute(' select asset_name,asset_rehearsal_charge from assets where id=' . $id);
                        foreach ($ans = $stmt->fetchAll() as $row) {
                            $sum += $row[1];


                        }

                    }
                }
                $sum += $data['booking_total_charge'];
            }
            $sum = $data['booking_total_charge'];
            $this->checkout($sum, $data);


        }


    }

    public function checkout($sum, $data)
    {
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');
        $this->loadModel('Locations');
        $this->loadModel('Sessions');
        $this->loadModel('Checkout');
        $this->loadModel('Notes');

        $this->bookingList = $data;
        $total_price = 0;
        $accessToken = 'EAAAEKhTmfP4PDnIA4LQqkAatoyYagwLpeOcsosUig2eS_BWQIyy0nqjd-sv7mv-';
        $locationId = 'G56H8ZCB15N63';


// Create and configure a new API client object
        $defaultApiConfig = new Configuration();
        $defaultApiConfig->setAccessToken($accessToken);
        $defaultApiConfig->setHost("https://connect.squareupsandbox.com");
        $defaultApiClient = new ApiClient($defaultApiConfig);
        $checkoutClient = new CheckoutApi($defaultApiClient);
        $price = new Money;
        $sum = $sum * 100;
        $price->setAmount($sum);
        $price->setCurrency('AUD');
        $lineItems = array();

//Create the line item and set details
        $book = new CreateOrderRequestLineItem;
        $book->setName('Rehearsal Room Price');
        $book->setQuantity('1');
        $sum = $data['booking_total_charge'];
        $total_price += $sum;
        $price = new Money;
        $sum = $sum * 100;
        $price->setAmount($sum);
        $price->setCurrency('AUD');
        $book->setBasePriceMoney($price);
        if (isset($data['discount']) && $data['discount'] > 0) {

            $sum = $data['booking_total_charge'] - $data['discount'];
            $sum = $sum * 100;
            $price->setAmount($sum);
            $price->setCurrency('AUD');
            $book->setBasePriceMoney($price);


        }
        array_push($lineItems, $book);
        if (isset($data['instruments'])) {
            $instruments = $data['instruments'];
            if ($instruments != null) {
                $all_assets = array();


                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($all_assets, $ind[0]);

                    }

                }


                if (!empty($all_assets)) {

                    foreach ($all_assets as $id) {
                        $conn = \Cake\Datasource\ConnectionManager::get('default');
                        $stmt = $conn->execute(' select asset_name,asset_rehearsal_charge from assets where id=' . $id);
                        foreach ($ans = $stmt->fetchAll() as $row) {
                            $sum = $row[1];
                            $total_price += $sum;
                            $price = new Money;
                            $sum = $sum * 100;
                            $price->setAmount($sum);
                            $price->setCurrency('AUD');


                            $book = new CreateOrderRequestLineItem;
                            $book->setName($row[0]);

                            $book->setQuantity('1');
                            $book->setBasePriceMoney($price);
                            array_push($lineItems, $book);


                        }

                    }
                }

            }
        }


// Create an Order object using line items from above
        $order = new CreateOrderRequest();


        $order->setIdempotencyKey(uniqid());//uniqid() generates a random string.
        $cpUniqid = uniqid();

//sets the lineItems array in the order object
        $order->setLineItems($lineItems);
        $checkout = new CreateCheckoutRequest();

        $checkout->setIdempotencyKey(uniqid()); //uniqid() generates a random string.
        $checkout->setOrder($order); //this is the order we created in the previous step.

        $checkout->setRedirectUrl("http://ponymusic.dreamfactorymusic.com.au/bookings/booking_confirmation");
        $conn = \Cake\Datasource\ConnectionManager::get('default');
        $y = explode('-', $data['booking_date_from'])[0];
        $m = explode('-', $data['booking_date_from'])[1];
        $d = explode('-', $data['booking_date_from'])[2];
        $f = $y . $m . $d;
        $conn = \Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

        foreach ($ans = $stmt->fetchAll() as $row) {
            $AMFullTime = $row[0] . "-" . $row[1];
            $PMFullTime = $row[2] . "-" . $row[3];


            if ($AMFullTime == $data['session_time']) {

                $stmt = $conn->execute(" select * from room_usages where room_usages_date=" . $f . " and room_id=" . $data['room_id'] . " and room_usages_session='AM'");

                break;
            } elseif ($PMFullTime == $data['session_time']) {

                $stmt = $conn->execute(" select * from room_usages where room_usages_date=" . $f . " and room_id=" . $data['room_id'] . " and room_usages_session='PM'");
                break;

            }


        }


        if (!$stmt->fetch()) {
            try {
                $result = $checkoutClient->createCheckout($locationId, $checkout);


                //Save the checkout ID for verifying transactions
                $checkoutId = $result->getCheckout()->getId();
                $new_band = $this->Bands->newEntity();
                $new_band->band_name = $data['band_name'];
                $this->Bands->save($new_band);


                $new_clients = $this->Clients->newEntity();

                $new_clients->client_fname = $data['client_fname'];
                $new_clients->client_lname = $data['client_lname'];
                $new_clients->client_phone = $data['client_phone'];
                $new_clients->client_email = $data['client_email'];
                $this->Clients->save($new_clients);
                $new_band_client = $this->BandsClients->newEntity();
                $new_band_client->band_id = $new_band->id;
                $new_band_client->client_id = $new_clients->id;
                $this->BandsClients->save($new_band_client);


                $bookings = $this->Bookings->newEntity();
                $bookings = $this->Bookings->patchEntity($bookings, $data);

                $conn = \Cake\Datasource\ConnectionManager::get('default');
                $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

                foreach ($ans = $stmt->fetchAll() as $row) {
                    /*$AMFullTime=substr($row[0],0,5)."-".substr($row[1],0,5);
                    $PMFullTime=substr($row[2],0,5)."-".substr($row[3],0,5);*/
                    $AMFullTime = $row[0] . "-" . $row[1];
                    $PMFullTime = $row[2] . "-" . $row[3];


                    if ($AMFullTime == $data['session_time']) {
                        $bookings->booking_session = 'AM';
                        break;
                    } elseif ($PMFullTime == $data['session_time']) {
                        $bookings->booking_session = 'PM';
                        break;

                    }


                }
                if (isset($data['discount'])) {
                    if ($data['discount'] > 0) {
                        $total_price -= $data['discount'];

                    }
                }
                if (isset($data['discount'])) {
                    $bookings->staff_code = $data['staff_code'];
                }

                $bookings->booking_type = 'Rehearsal';
                $bookings->booking_date_from = $data['booking_date_from'];
                $bookings->booking_date_to = $data['booking_date_to'];
                $bookings->room_id = $data['room_id'];
                $bookings->booking_total_charge = $total_price;
                $bookings->display_name = $data['display_name'];
                $bookings->status = "processing";


                $this->Bookings->save($bookings);


                $new_note = $this->Notes->newEntity();
                $new_note->booking_id = $bookings->id;
                if (empty($data['note'])) {
                    $new_note->note = '';
                } elseif (!empty($data['note'])) {
                    $new_note->note = $data['note'];
                }

                $this->Notes->save($new_note);
                if (isset($data['instruments'])) {
                    for ($i = 0; $i < sizeof($all_assets); $i++) {

                        $assetsBookings = $this->AssetsBookings->newEntity();
                        $assetsBookings->asset_id = $all_assets[$i];
                        $assetsBookings->booking_id = $bookings->id;
                        $assetsBookings->assets_bookings_date=$data['booking_date_from'];
                        $assetsBookings->assets_bookings_session="$bookings->booking_session";
                        $this->AssetsBookings->save($assetsBookings);

                    }
                }


                $bookings_clients = $this->BookingsClients->newEntity();
                $bookings_clients->booking_id = $bookings->id;
                $bookings_clients->client_id = $new_clients->id;
                $bookings_clients->user_id = $this->Auth->user('id');
                $this->BookingsClients->save($bookings_clients);
                $checkout = $this->Checkout->newEntity();
                $checkout->checkout_code = $checkoutId;
                $checkout->booking_id = $bookings->id;

                $checkout->idempotency_key = $cpUniqid;
                $checkout->location_code = $locationId;


                $checkout->merchant_support_email = $data['client_email'];

                $this->Checkout->save($checkout);

                //Get the checkout URL that opens the checkout page.

                $checkoutUrl = $result->getCheckout()->getCheckoutPageUrl();
                $this->redirect($checkoutUrl);
                /*$this->bookingConfirmation($data);*/

            } catch (Exception $e) {
                echo 'Exception when calling CheckoutApi->createCheckout: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            $this->Flash->error('Sorry, this room has already been booked. Please try a different room or session time.');

        }


//


    }

    public function bookingConfirmation()
    {
        $this->loadModel('assets');
        $clients=$this->loadModel('clients');
        //$booking_clients=$this->loadModel('bookings_clients');
        $this->loadModel('Assets_Bookings');
       
        $this->loadModel('RoomUsages');
        $this->loadModel('rooms');


        /*$this->viewBuilder()->setLayout('client');*/
        $this->set('topTitle', 'Booking Confirmation');
        $this->loadModel('Checkout');
        $checkId = $_GET['checkoutId'];
        $transactionId = $_GET['transactionId'];
        $checkout = TableRegistry::getTableLocator()->get('Checkout');
        $query = $checkout
            ->find()
            ->where(['checkout_code =' => $checkId]);
        foreach ($query as $row) {
            $booking_id = $row->booking_id;
            $myemail=$row->merchant_support_email;

            $transaction = $checkout->get($row->id);
            $transaction->status = "completed";

            $transaction->transaction_code = $transactionId;
            $checkout->save($transaction);
        }
        
        $bookingUpdate = $this->loadModel('Bookings');

        $query = $bookingUpdate
            ->find()
            ->where(['id =' => $booking_id]);
        foreach ($query as $row) {
            $bookingStatus = $bookingUpdate->get($row->id);
            $bookingStatus->status = "completed";
            $bookingUpdate->save($bookingStatus);
            
        }


        $booking = TableRegistry::getTableLocator()->get('Bookings');
        $query = $booking
            ->find()
            ->select(['booking_date_from', 'room_id', 'booking_session','display_name','booking_total_charge'])
            ->where(['id =' => $booking_id]);
        foreach ($query as $ind) {
            $roomId = $ind->room_id;
            $roomDate = $ind->booking_date_from;
            $roomSession = $ind->booking_session;
            $bookingName =$ind->display_name;
            $bookingTotalCharge=$ind->booking_total_charge;
        }
        
        $clientInfo= $this->Bookings
        ->find('all')
        ->contain(['assets','clients'])
        ->where(['id ='=>$booking_id]);
        $assets_list='';
    
        
         foreach($clientInfo as $rac){
             $clientfname=$rac->clients[0]['client_fname'];
             $clientlname=$rac->clients[0]['client_lname'];
             $clientphone=$rac->clients[0]['client_phone'];
             if(isset($rac->assets)){
                 foreach($rac->assets as $asset){
                     $assets_list=$assets_list.'<br>'.$asset['asset_name'];
                 }
                 
             
             }
             
         }
         
         $roomNumbers=$this->rooms
         ->find('all')
         ->where(['id ='=>$roomId]);
         foreach($roomNumbers as $roc){
             $roomNumber=$roc['room_number'];
             
         }
         
         $cDate=explode('/',$roomDate);
         $bookingDate=$cDate[1].'/'.$cDate[0].'/'.$cDate[2];
        
        
        
        
        $msg="Hello $myemail, 
        <br><br>Thank you for booking one of our rehearsal rooms at Pony Music. The following is the information regarding your booking: 
        <hr>
        <br> Booking Date: $bookingDate
        <br> Booking Session: $roomSession
        <br> Booking Total Charge:$$bookingTotalCharge
        <br> Room Number: $roomNumber
        <br> Booking Name: $bookingName
        <br> Client Name: $clientfname $clientlname
        <br> Client Phone: $clientphone
        <br> Booked Assets:$assets_list;
        <hr>If you have any questions regarding your booking, please contact us on (03) 9702 3244.
    <br><br>Kind regards,
    <br><br>Pony Music";
                    
              
              
               $email = new Email('default');
               $success=$email
                    ->setTransport('gmail')
                    ->setFrom(['ieteam116@gmail.com' => 'Pony Music'])
                    ->setTo($myemail)
                    ->setSubject('Pony Music Booking Confirmation')
                     ->setEmailFormat('html')
                    ->setViewVars(array('msg' => $msg))
                    ->send($msg);
        
       
                   
                    
       
        
        $a=array();
        $a=explode('/',$roomDate);
        $fDate='20'.$a[2].'-'.$a[1].'-'.$a[0];
        $weekno=date("W",strtotime($fDate));
        
        $yearno=explode('/',$roomDate)[2];
  
        $roomUsages = $this->RoomUsages->newEntity();
        $roomUsages->room_id = $roomId;

        $roomUsages->room_usages_date = $roomDate;
        $roomUsages->room_usages_session = $roomSession;
        $roomUsages->booking_id = $booking_id;
        
        
                    
                    
        if ($this->RoomUsages->save($roomUsages)) {
            $response = 'Thank you! Your booking has been confirmed. You will be redirected to the Pony Music Rehearsal Calendar after 5 seconds.';

        } else {
            $response = 'Sorry, but it seems that an error has occurred. Please check your payment details in order for your booking to be processed.';
        }
        $user = $this->Auth->user();
        $this->set(compact('response'));
        $this->set(compact('user'));
        $this->set(compact('weekno'));
        $this->set(compact('yearno'));
        $this->set(compact('clientInfo'));


    }

    public function refundConfirmation()
    {

        $response = 'The booking is refunded<br> Redirect to Rehearsal calendar after 5 seconds';


        $user = $this->Auth->user();
        $this->set(compact('response'));
        $this->set(compact('user'));


    }

    public function searchCustomer()
    {
        $id = "hide";
        return $this->redirect(['action' => 'staff_rehearsal_form', $id]);
    }

    public function rehearsalBookingDetail($id = null)
    {
        $this->loadModel('RoomUsages');
        $user = $this->Auth->user();
        if ($user['type'] === 'admin') {
            $this->viewBuilder()->setLayout('admin');

        } elseif ($user['type'] === 'client') {
            $this->viewBuilder()->setLayout('client');

        }

        $this->set('topTitle', 'Booking Detail');


        $this->set('topTitle', 'Add a Booking');
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');
        $this->loadModel('Locations');
        $this->loadModel('Sessions');
        $this->loadModel('Notes');


        //List all assets.
        $assets = $this->Assets->find('list', [
            'keyField' => 'id',
            'valueField' => function ($current_asset) {
                return $current_asset->asset_type . ' $' . $current_asset->asset_rehearsal_charge;
            }
        ]);
        $assets = $assets->toArray();
        $this->set(compact('assets'));
        $all_assets = $this->Assets->find('all');
        $drum_list = array();
        $amp_list = array();
        $other_list = array();
        foreach ($all_assets as $asset) {
            if ($asset['asset_type'] === 'Drums') {
                array_push($drum_list, $asset);
                $this->set(compact('drum_list'));
            } elseif ($asset['asset_type'] === 'Amplifiers') {
                array_push($amp_list, $asset);
                $this->set(compact('amp_list'));
            } elseif ($asset['asset_type'] === 'Other') {
                array_push($other_list, $asset);
                $this->set(compact('other_list'));
            }
        }
        $rooms = $this->Rooms->find()->where(['id IS' => $id]);
        $this->set(compact('user', 'rooms'));

        //Create a new Bookings entity.
        $bookings = $this->Bookings->newEntity();
        $this->set(compact('bookings'));

        $bookings_clients = $this->BookingsClients->newEntity();
        $this->set(compact('bookings_clients'));

        //Create a new Clients entity.
        //Shouldn't create a new Client entity if they already exist (potential search via their phone number).
        $existing_clients = $this->Clients->find();
        $this->set(compact('existing_clients'));

        $new_clients = $this->Clients->newEntity();
        $this->set(compact('new_clients'));

        $BookingId = $_GET['BookingId'];

        $old_notes = $this->Bookings->get($BookingId, [
            'contain' => ['Notes']]);


        $notes_history = array();
        foreach ($old_notes['notes'] as $note) {
            array_push($notes_history, $note);
        }
        $this->set(compact('notes_history'));


        $new_note = $this->Notes->newEntity();
        $this->set(compact('new_note'));

        if ($this->request->is('post') && $this->request->getData('submit') === 'Proceed to Square for Payment') {
            $new_note->booking_id = $_GET['BookingId'];

            $new_note->note = $this->request->getData('new_note');

            $this->Notes->save($new_note);


            $totalp = 0;
            $ototal = 0;
            $BookingId = $_GET['BookingId'];

            $data = $this->request->getData();
            


            $conn = \Cake\Datasource\ConnectionManager::get('default');
            $stmt = $conn->execute(" select asset_rehearsal_charge from assets
     inner join assets_bookings ab on assets.id = ab.asset_id
     inner join bookings b on ab.booking_id = b.id where b.id=$BookingId");
            foreach ($stmt->fetchAll() as $row) {
                $totalp += $row[0];
            }
            if($totalp!=0 && !isset($data['instruments']) ){
                $this->getpayment($totalp, $BookingId);
                            $this->Flash->success(__('A refund has been issued for this booking.'));
                            $cCharge=$data['booking_total_charge']-$totalp;
                            $sql = $conn->execute("update bookings set booking_total_charge=$cCharge where id=$BookingId");
            }
                
            
            if (isset($data['instruments'])) {
                $instruments = $data['instruments'];
                if ($instruments != null) {
                    $all_assets = array();
                    foreach ($instruments as $ind) {
                        $ind = explode(":", $ind);
                        if ($ind[0] != 0) {
                            array_push($all_assets, $ind[0]);

                        }

                    }

                }


                if (!empty($all_assets)) {

                    foreach ($all_assets as $id) {

                        $conn = \Cake\Datasource\ConnectionManager::get('default');
                        $stmt = $conn->execute(' select asset_rehearsal_charge from assets where id=' . $id);
                        foreach ($ans = $stmt->fetchAll() as $row) {
                            $ototal += $row[0];
                        }
                    }
                }

                if ($totalp >= $ototal) {


                    $conn = \Cake\Datasource\ConnectionManager::get('default');
                    $stmt = $conn->execute("delete from assets_bookings where booking_id= $BookingId");
                    foreach ($all_assets as $ind) {
                        $assetsBookings = $this->AssetsBookings->newEntity();
                        $assetsBookings->asset_id = $ind;
                        $assetsBookings->assets_bookings_date=$data['booking_date_from'];
                        $assetsBookings->assets_bookings_session=$data['session_time'];
                        $assetsBookings->booking_id = $BookingId;
                        $this->AssetsBookings->save($assetsBookings);
                        $refundp = $totalp - $ototal;

                        if ($refundp > 0) {
                            $this->getpayment($refundp, $BookingId);
                            $this->Flash->success(__('The booking has been refunded.'));
                            $cCharge=$data['booking_total_charge']-$refundp;
                            $sql = $conn->execute("update bookings set booking_total_charge=$cCharge where id=$BookingId");
                        }
                    }


                } else {
                    $extraC = $ototal - $totalp;
                    $extraC += $data['booking_total_charge'];
                    $this->editBookingCheckout($extraC, $totalp, $data);

                }

            } else {
                $conn = \Cake\Datasource\ConnectionManager::get('default');
                $stmt = $conn->execute("delete from assets_bookings where booking_id= $BookingId");

            }


        } elseif ($this->request->is('post') && $this->request->getData('submit') === 'update notes') {

            $new_note->booking_id = $_GET['BookingId'];

            $new_note->note = $this->request->getData('new_note');

            $this->Notes->save($new_note);

            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));

        }
    }

    public function editBookingCheckout($extraC, $totalp, $data)
    {
        $this->loadModel('RequestAssetsBookings');
        $this->loadModel('Checkout');


        $total_price = 0;

        $accessToken = 'EAAAEKhTmfP4PDnIA4LQqkAatoyYagwLpeOcsosUig2eS_BWQIyy0nqjd-sv7mv-';
        $locationId = 'G56H8ZCB15N63';


// Create and configure a new API client object
        $defaultApiConfig = new Configuration();
        $defaultApiConfig->setAccessToken($accessToken);
        $defaultApiConfig->setHost("https://connect.squareupsandbox.com");
        $defaultApiClient = new ApiClient($defaultApiConfig);
        $checkoutClient = new CheckoutApi($defaultApiClient);

        $lineItems = array();
        if (isset($data['instruments'])) {
            $instruments = $data['instruments'];
            if ($instruments != null) {
                $all_assets = array();
                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($all_assets, $ind[0]);

                    }

                }

            }


            if (!empty($all_assets)) {

                foreach ($all_assets as $id) {

                    $conn = \Cake\Datasource\ConnectionManager::get('default');
                    $stmt = $conn->execute(' select asset_name,asset_rehearsal_charge from assets where id=' . $id);
                    foreach ($ans = $stmt->fetchAll() as $row) {
                        $sum = $row[1];
                        if ($totalp > 0) {


                            if ($sum > $totalp) {
                                $sum -= $totalp;

                                $totalp = 0;
                                $total_price += $sum;
                                $price = new Money;
                                $sum = $sum * 100;
                                $price->setAmount($sum);
                                $price->setCurrency('AUD');


                                $book = new CreateOrderRequestLineItem;
                                $book->setName($row[0]);

                                $book->setQuantity('1');
                                $book->setBasePriceMoney($price);

                                array_push($lineItems, $book);

                            } else {
                                $totalp -= $sum;
                                $sum = 1;

                                $totalp += 1;

                                $price = new Money;
                                $sum = $sum * 100;
                                $price->setAmount($sum);
                                $price->setCurrency('AUD');


                                $book = new CreateOrderRequestLineItem;
                                $book->setName($row[0]);

                                $book->setQuantity('1');
                                $book->setBasePriceMoney($price);

                                array_push($lineItems, $book);

                            }

                        } else {
                            $total_price += $sum;
                            $price = new Money;
                            $sum = $sum * 100;
                            $price->setAmount($sum);
                            $price->setCurrency('AUD');


                            $book = new CreateOrderRequestLineItem;
                            $book->setName($row[0]);

                            $book->setQuantity('1');
                            $book->setBasePriceMoney($price);

                            array_push($lineItems, $book);

                        }


                    }

                }
            }
        }


// Create an Order object using line items from above
        $order = new CreateOrderRequest();


        $order->setIdempotencyKey(uniqid()); //uniqid() generates a random string.

//sets the lineItems array in the order object
        $order->setLineItems($lineItems);
        $checkout = new CreateCheckoutRequest();

        $checkout->setIdempotencyKey(uniqid()); //uniqid() generates a random string.
        $checkout->setOrder($order); //this is the order we created in the previous step.

        $checkout->setRedirectUrl("http://ponymusic.dreamfactorymusic.com.au/bookings/edit_booking_confirmation");


//
        try {
            $result = $checkoutClient->createCheckout($locationId, $checkout);


            //Save the checkout ID for verifying transactions
            $checkoutId = $result->getCheckout()->getId();


            for ($i = 0; $i < sizeof($all_assets); $i++) {

                $assetsBookings = $this->RequestAssetsBookings->newEntity();
                $assetsBookings->assets_id = $all_assets[$i];
                $assetsBookings->bookings_id = $data['booking_id'];
                $assetsBookings->extra_charge = $extraC;
                $this->RequestAssetsBookings->save($assetsBookings);

            }

            $checkout = $this->Checkout->newEntity();
            $checkout->checkout_code = $checkoutId;

            $checkout->booking_id = $data['booking_id'];


            $checkout->merchant_support_email = $data['client_email'];

            $this->Checkout->save($checkout);


            $checkoutUrl = $result->getCheckout()->getCheckoutPageUrl();
            $this->redirect($checkoutUrl);


        } catch (Exception $e) {
            echo 'Exception when calling CheckoutApi->createCheckout: ', $e->getMessage(), PHP_EOL;
        }


    }

    public function editBookingConfirmation()
    {
        $this->loadModel('AssetsBookings');
        

        $this->loadModel('RequestAssetsBookings');


        /*$this->viewBuilder()->setLayout('client');*/
        $this->set('topTitle', 'Edit Booking Confirmation');
        $this->loadModel('Checkout');
        $checkId = $_GET['checkoutId'];
        $transactionId = $_GET['transactionId'];

        $checkout = TableRegistry::getTableLocator()->get('Checkout');
        $query = $checkout
            ->find()
            ->select(['booking_id'])
            ->where(['checkout_code =' => $checkId]);
        foreach ($query as $row) {
            $booking_id = $row->booking_id;
            
            
        }
        
        $bookings = TableRegistry::getTableLocator()->get('Bookings');
        $query = $bookings
            ->find()
            ->select(['booking_date_from','booking_session'])
            ->where(['id =' => $booking_id]);
        foreach ($query as $row) {
            $bDate = $row->booking_date_from;
            $bSession=$row->booking_session;
            
            
        }
        
        $conn = \Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute("delete from assets_bookings where booking_id= $booking_id");
        $booking = TableRegistry::getTableLocator()->get('RequestAssetsBookings');
        $query = $booking
            ->find()
            ->select(['assets_id'])
            ->where(['bookings_id =' => $booking_id]);
        foreach ($query as $ind) {
            $assetsBookings = $this->AssetsBookings->newEntity();
            $assetsBookings->asset_id = $ind->assets_id;
            $assetsBookings->booking_id = $booking_id;
            $assetsBookings->assets_bookings_date=$bDate;
            $assetsBookings->assets_bookings_session="$bSession";
            $this->AssetsBookings->save($assetsBookings);
        }
        $booking = TableRegistry::getTableLocator()->get('RequestAssetsBookings');
        $fee = $booking
            ->find()
            ->select(['extra_charge'])
            ->where(['bookings_id =' => $booking_id])->first();
        $conn->execute("update bookings set booking_total_charge=$fee->extra_charge where id=$booking_id ");
        $a=array();
        $a=explode('/',$bDate);
        $fDate='20'.$a[2].'-'.$a[1].'-'.$a[0];
        $weekno=date("W",strtotime($fDate));
        
        $yearno=explode('/',$bDate)[2];


        $response = 'Your Edited Assets is confirmed<br> Redirect to Rehearsal calendar after 5 seconds';


        $user = $this->Auth->user();
        $this->set(compact('response'));
        $this->set(compact('user'));
        $this->set(compact('weekno'));
        $this->set(compact('yearno'));
        $this->set(compact('booking_id'));


    }

    public function bookFree($data)
    {
        //debug($data);
        $this->loadModel('Assets');
        $this->loadModel('AssetsBookings');
        $this->loadModel('AssetUsages');
        $this->loadModel('Bands');
        $this->loadModel('BandsClients');
        $this->loadModel('Clients');
        $this->loadModel('Bookings');
        $this->loadModel('BookingsClients');
        $this->loadModel('Rooms');
        $this->loadModel('RoomUsages');

        $this->loadModel('Sessions');
        if (isset($data['instruments'])) {
            $instruments = $data['instruments'];
            if ($instruments != null) {
                $all_assets = array();

                foreach ($instruments as $ind) {
                    $ind = explode(":", $ind);
                    if ($ind[0] != 0) {
                        array_push($all_assets, $ind[0]);

                    }

                }
            }


        }


        $y = explode('-', $data['booking_date_from'])[0];
        $m = explode('-', $data['booking_date_from'])[1];
        $d = explode('-', $data['booking_date_from'])[2];
        $f = $y . $m . $d;

        $conn = \Cake\Datasource\ConnectionManager::get('default');
        $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

        foreach ($ans = $stmt->fetchAll() as $row) {
            $AMFullTime = $row[0] . "-" . $row[1];
            $PMFullTime = $row[2] . "-" . $row[3];


            if ($AMFullTime == $data['session_time']) {

                $stmt = $conn->execute(" select * from room_usages where room_usages_date=" . $f . " and room_id=" . $data['room_id'] . " and room_usages_session='AM'");

                break;
            } elseif ($PMFullTime == $data['session_time']) {

                $stmt = $conn->execute(" select * from room_usages where room_usages_date=" . $f . " and room_id=" . $data['room_id'] . " and room_usages_session='PM'");
                break;

            }


        }


        if (!$stmt->fetch()) {


            $new_band = $this->Bands->newEntity();
            $new_band->band_name = $data['band_name'];
            $this->Bands->save($new_band);


            $new_clients = $this->Clients->newEntity();

            $new_clients->client_fname = $data['client_fname'];
            $new_clients->client_lname = $data['client_lname'];
            $new_clients->client_phone = $data['client_phone'];
            $new_clients->client_email = $data['client_email'];
            $this->Clients->save($new_clients);
            $new_band_client = $this->BandsClients->newEntity();
            $new_band_client->band_id = $new_band->id;
            $new_band_client->client_id = $new_clients->id;
            $this->BandsClients->save($new_band_client);


            $bookings = $this->Bookings->newEntity();
            $bookings = $this->Bookings->patchEntity($bookings, $data);

            $conn = \Cake\Datasource\ConnectionManager::get('default');
            $stmt = $conn->execute(' select session_day_start,session_day_end,session_night_start,session_night_end from sessions');

            foreach ($ans = $stmt->fetchAll() as $row) {
                /*$AMFullTime=substr($row[0],0,5)."-".substr($row[1],0,5);
                $PMFullTime=substr($row[2],0,5)."-".substr($row[3],0,5);*/
                $AMFullTime = $row[0] . "-" . $row[1];
                $PMFullTime = $row[2] . "-" . $row[3];


                if ($AMFullTime == $data['session_time']) {
                    $bookings->booking_session = 'AM';
                    break;
                } elseif ($PMFullTime == $data['session_time']) {
                    $bookings->booking_session = 'PM';
                    break;

                }


            }


            $bookings->staff_code = $data['staff_code'];


            $bookings->booking_type = 'Rehearsal';
            $bookings->booking_date_from = $data['booking_date_from'];
            $bookings->booking_date_to = $data['booking_date_to'];
            $bookings->room_id = $data['room_id'];
            $bookings->booking_total_charge = 0;
            $bookings->status = "completed";

            $bookings->display_name = $data['display_name'];


            $this->Bookings->save($bookings);
            if (isset($data['instruments'])) {
                for ($i = 0; $i < sizeof($all_assets); $i++) {

                    $assetsBookings = $this->AssetsBookings->newEntity();
                    $assetsBookings->asset_id = $all_assets[$i];
                    $assetsBookings->booking_id = $bookings->id;
                    $assetsBookings->assets_bookings_date=$data['booking_date_from'];
                    $assetsBookings->assets_bookings_session="$bookings->booking_session";
                    $this->AssetsBookings->save($assetsBookings);

                }

            }


            $bookings_clients = $this->BookingsClients->newEntity();
            $bookings_clients->booking_id = $bookings->id;
            $bookings_clients->client_id = $new_clients->id;
            $bookings_clients->user_id = $this->Auth->user('id');
            $this->BookingsClients->save($bookings_clients);
            $booking = TableRegistry::getTableLocator()->get('Bookings');
            $query = $booking
                ->find()
                ->select(['booking_date_from', 'room_id', 'booking_session'])
                ->where(['id =' => $bookings->id]);
            foreach ($query as $ind) {
                $roomId = $ind->room_id;
                $roomDate = $ind->booking_date_from;
                $roomSession = $ind->booking_session;
            }
            $roomUsages = $this->RoomUsages->newEntity();
            $roomUsages->room_id = $roomId;

            $roomUsages->room_usages_date = $roomDate;
            $roomUsages->room_usages_session = $roomSession;
            $roomUsages->booking_id = $bookings->id;
            //$weekno=date("W",strtotime($roomDate));
            $a=array();
            $a=explode('/',$roomDate);
            $fDate='20'.$a[2].'-'.$a[1].'-'.$a[0];
            $weekno=date("W",strtotime($fDate));
            $yearno=explode('/',$roomDate)[2];
            if ($this->RoomUsages->save($roomUsages)) {
                $this->Flash->success(__('The booking has been confirmed.'));
                return $this->redirect(['action' => 'staff_rehearsal_calendar',"?" => array(
                    "key" => "$weekno",
                    "year" => "$yearno"
                )]);


            } else {
                $this->Flash->error('Sorry, The room has been booked');
            }


        } else {
            $this->Flash->error('Sorry, The room has been booked');

        }
    }


//


    public function cancel($id = null)
    {
        $this->checkAuth();
        $this->loadModel('RoomUsages');
        $this->request->allowMethod(['post', 'Delete']);
        $booking = $this->RoomUsages->find()->where(['booking_id = ' => $id]);
        foreach ($booking as $ruId) {
            $roomusageId = $ruId->id;
        }

        $price = $this->Bookings->find()->where(['id =' => $id]);
        foreach ($price as $p) {
            $sum = $p->booking_total_charge;
        }
        if ($sum <= 0) {
            $this->Flash->error(__('The booking could not be refund. Please, try again.'));

            return $this->redirect(['action' => 'staff_rehearsal_calendar']);


        } else {
            $bookingUpdate = $this->loadModel('Bookings');

            $query = $bookingUpdate
                ->find()
                ->where(['id =' => $id]);
            foreach ($query as $row) {
                $bookingStatus = $bookingUpdate->get($row->id);
                $bookingStatus->status = "refunded";
                $bookingUpdate->save($bookingStatus);
            }
            $booking = $this->RoomUsages->get($roomusageId);
            $this->getpayment($sum, $id);
            if ($this->RoomUsages->delete($booking)) {

                $this->Flash->success(__('The booking has been canceled and refunded.'));
                $this->redirect(['controller' => 'bookings', 'action' => 'refundConfirmation']);

            } else {
                $this->Flash->error(__('The booking could not be canceled. Please, try again.'));
            }

            //return $this->redirect(['action' => 'staff_rehearsal_calendar']);

        }


    }
       public function freelancerRecordingCalendar()
    {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('client');
        $this->set('topTitle', 'Booking Calendar');
        $this->loadModel('Quotes');
        $new_events = $this->Quotes->newEntity();
        

        if ($this->request->is('post')) {

            $data = $this->request->getData();
           
            $start_date = date ("Y-m-d",strtotime($data['start_date']));
            $new_events->start_event = $start_date;
            //$new_events->To_date = $data['end_date'];
            $end_date = $data['end_date'];
            $end_date = date ("Y-m-d",strtotime($data['end_date']));
            $new_events->end_event = date('Y-m-d', strtotime('+1 day', strtotime($end_date)));


            $new_events->client_fname = $data['client_fname'];
            $new_events->client_lname = $data['client_lname'];
           
            $new_events->client_phone = $data['client_phone'];
            $client_phone = $data['client_phone'];
            $validator = new Validator();
             $validator
    ->requirePresence('$client_phone')
    ->notEmptyString('$client_phone', 'Please fill this field')
    ->add('client_phone', [
        'length' => [
            'rule' => ['minLength', 10],
            'message' => 'Titles need to be at least 10 characters long',
        ]
    ]);
            $new_events->client_email = $data['client_email'];
            $new_events->display_name = $data['Display_name'];
            $new_events->band_name = $data['Band_name'];

            $new_events->notes = htmlspecialchars($data['notes']);
            $session = $this->getRequest()->getSession();


           
            $new_events->user_email = $session->read('Auth.User.email');


            $this->Quotes->save($new_events);
            return $this->redirect(['action' => 'freelancer_recording_calendar']);


        };


    }
    public function cancelNoRefund($id = null)
    {
        $this->checkAuth();
        $this->loadModel('RoomUsages');
        $this->request->allowMethod(['post', 'Delete']);
        $booking = $this->RoomUsages->get($id);
        $bookingUpdate = $this->loadModel('Bookings');

        $query = $bookingUpdate
            ->find()
            ->where(['id =' => $booking->booking_id]);
        foreach ($query as $row) {
            $bookingStatus = $bookingUpdate->get($row->id);
            $bookingStatus->status = "canceled";
            $bookingUpdate->save($bookingStatus);
        }


        if ($this->RoomUsages->delete($booking)) {
            $this->Flash->success(__('The booking has been canceled.'));
        } else {
            $this->Flash->error(__('The booking could not be canceled. Please, try again.'));
        }

        return $this->redirect(['action' => 'staff_rehearsal_calendar']);

    }

    function checkAuth()
    {
        $user = $this->Auth->user();
        if (isset($user['type']) && $user['type'] === 'admin' ||
            isset($user['type']) && $user['type'] === 'staff') {

            $this->Auth->allow();
        }
        if (isset($user['type']) && $user['type'] === 'freelancer') {

            $this->Auth->allow();
        }
        if (isset($user['type']) && $user['type'] === 'client') {
            $this->Flash->error('YOU CAN NOT ACCESS THIS PAGE');
            $this->redirect(['controller' => 'bookings', 'action' => 'public_rehearsal_calendar']);
        }

    }

    public function getpayment($sum, $bookingId)
    {
        $access_token = 'EAAAEKhTmfP4PDnIA4LQqkAatoyYagwLpeOcsosUig2eS_BWQIyy0nqjd-sv7mv-';
        $locationId = "G56H8ZCB15N63";
        $checkout = $this->loadModel("Checkout");//
        //$bookingId=$_GET["bookingID"];


        $query = $checkout->find()->where(["booking_id =" => $bookingId])->where(["status =" => "completed"])->first();
     
      
        $orderId = $query['transaction_code'];
        $uId = $query['idempotency_key'];
   


        $api_config = new Configuration();
        $api_config->setHost("https://connect.squareupsandbox.com");
        $api_config->setAccessToken($access_token);
        $api_client = new ApiClient($api_config);
        $ordersApi = new \SquareConnect\Api\OrdersApi($api_client);
      

        try {
            $body = new BatchRetrieveOrdersRequest();
            $body->setOrderIds([$orderId]);
            $result = $ordersApi->batchRetrieveOrders($locationId, $body);

            $paymentId = $result->getOrders()[0]->getTenders()[0]->getId();
        
            $this->bookingRefund($paymentId, $uId, $sum, $bookingId);
        } catch (\SquareConnect\ApiException $e) {
            echo $e->getResponseBody();
            echo $e->getResponseHeaders();
        }


    }

    public function bookingRefund($pId, $uId, $sum, $bookingId)
    {
        $access_token = 'EAAAEKhTmfP4PDnIA4LQqkAatoyYagwLpeOcsosUig2eS_BWQIyy0nqjd-sv7mv-';
        $api_config = new Configuration();
        $api_config->setHost("https://connect.squareupsandbox.com");
        $api_config->setAccessToken($access_token);
        $api_client = new ApiClient($api_config);

        $price = new Money;
        $sum = $sum * 100;
        $price->setAmount($sum);
        $price->setCurrency('AUD');

        $apiInstance = new \SquareConnect\Api\RefundsApi($api_client);
        $body = new \SquareConnect\Model\RefundPaymentRequest(); // \SquareConnect\Model\RefundPaymentRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        $body->setAmountMoney($price)
            ->setIdempotencyKey($uId)
            ->setPaymentId($pId)
            ->setReason("pony music refund");

        try {
            $result = $apiInstance->refundPayment($body);
            $refundId = $result->getRefund()->getId();
         
            $checkout = $this->loadModel("checkout");

            $conn = \Cake\Datasource\ConnectionManager::get('default');


            // $conn->execute("update checkout set status='refunded'  where booking_id=$bookingId ");
            // $conn->execute("update bookings set status='refunded'  where id=$bookingId ");
            $query = $checkout
                ->find()
                ->where(['booking_id =' => $bookingId])->first();


            $transaction = $checkout->get($query->id);
            $transaction->refund_code = $refundId;
            $this->checkout->save($transaction);

       


        } catch (ApiException $e) {
            echo 'Exception when calling RefundsApi->refundPayment: ', $e->getMessage(), PHP_EOL;
        }


    }
    public function cancelBookingList() {
        $this->checkAuth();

        $this->viewBuilder()->setLayout('admin');
    }







//    public function BookingRefund() {
//        $access_token = 'EAAAEEShjcqrxa9HHF_ymKFYNFVkQCX0CQdmivP4kukrqnI3NhV5nnTIP2q-OItD';
//        $locationId = "43ZC47M7VQAAP";
//        $orderId = "pf34IAbCYfKTuQsmY0RkEzP3PoTZY";
//
//        $api_config = new Configuration();
//        $api_config->setHost("https://connect.squareupsandbox.com");
//        $api_config->setAccessToken($access_token);
//        $api_client = new ApiClient($api_config);
//        $ordersApi = new \SquareConnect\Api\OrdersApi($api_client);
//
//        try {
//            $body = new BatchRetrieveOrdersRequest();
//            $body->setOrderIds([$orderId]);
//            $result = $ordersApi->batchRetrieveOrders($locationId, $body);
//            debug($result->getOrders()[0]->getTenders()[0]->getId());
//        } catch (\SquareConnect\ApiException $e) {
//            debug($e->getResponseBody());
//            debug($e->getResponseHeaders());
//        }
//
//
//    }
}
