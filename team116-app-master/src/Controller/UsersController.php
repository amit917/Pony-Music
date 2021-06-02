<?php

namespace App\Controller;


use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use cake\Mailer\Email;
use cake\Auth\DefaultPasswordHasher;
use phpDocumentor\Reflection\Type;
use SquareConnect\Api\CheckoutApi;
use SquareConnect\ApiClient;
use SquareConnect\Configuration;
use SquareConnect\Model\CreateCheckoutRequest;
use SquareConnect\Model\CreateOrderRequest;
use SquareConnect\Model\CreateOrderRequestLineItem;
use SquareConnect\Model\Money;
use cake\ORM\TableRegistry;
use Cake\Mailer\TransportFactory;
use Cake\Network\Exception\SocketException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('public_rehearsal_calendar');
    }

    public function index()
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Users list');
        $users = $this->Users->find()->where(['type =' => 'freelancer']);


        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuth();
        $user = $this->Users->get($id, [
            'contain' => ['BookingsClients'],
        ]);

        $this->set('user', $user);
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
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function addFreelancer()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Freelancer Sign Up');
        $this->checkAuth();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    
        public function addAdmin()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Admin Sign Up');
        $this->checkAuth();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The new admin has been saved.'));

                return $this->redirect(['controller' => 'staffs', 'action' => 'index']);
            }
            $this->Flash->error(__('The new admin could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function editAdmin($id = null) {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $admin = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Users->patchEntity($admin, $this->request->getData());
            if ($this->Users->save($admin)) {
                $this->Flash->success(__('Admin information has been saved.'));

                return $this->redirect(['controller' => 'staffs', 'action' => 'index']);
            }
            $this->Flash->error(__('The admin information could not be saved. Please, try again.'));
        }
        $this->set(compact('admin'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAuth();
        $this->viewBuilder()->setLayout('admin');
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuth();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'staffs', 'action' => 'index']);
    }

    public function isAuthorized($user)
    {
        return ($user['email'] == 'admin@monash.edu');
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->user('type') == 'admin') {

                    return $this->redirect(['controller' => 'bookings', 'action' => 'staff_rehearsal_calendar', $this->Auth->user('id')]);
                }
                if ($this->Auth->user('type') == 'staff') {

                    return $this->redirect(['controller' => 'bookings', 'action' => 'staff_rehearsal_calendar', $this->Auth->user('id')]);
                }
                if ($this->Auth->user('type') == 'Freelancer') {

                    return $this->redirect(['controller' => 'bookings', 'action' => 'freelancer_recording_calendar', $this->Auth->user('id')]);
                }
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function forgotpassword()
    {

        if ($this->request->is('post')) {
            $myemail = $this->request->getData('email');
            $mytoken = Security::hash(Security::randomBytes(25));
            $userTable = TableRegistry::get('Users');
            $user = $userTable->find('all')->where(['email' => $myemail])->first();
            $user->token = $mytoken;
            if ($userTable->save($user)) {
                $this->Flash->success('Reset password link has been sent to your email(' . $myemail . '). please open your inbox');

                $msg='Hello, ' . $myemail . '<br/> please click this link to reset your password<br/> <a href="http://ponymusic.dreamfactorymusic.com.au/users/reset_password/' . $mytoken . '>Reset Password</a>';
                    
               $email = new Email('default');
               $success=$email
                    ->setTransport('gmail')
                    ->setFrom(['ieteam116@gmail.com' => 'pony music'])
                    ->setTo($myemail)
                    ->setSubject('please reset your password')
                     ->setEmailFormat('html')
                    ->setViewVars(array('msg' => $msg))
                    ->send($msg);

                if ($success) {
                    $this->Flash->success('Reset password link has been sent to your email(' . $myemail . '). please open your inbox');
                } else {
                    $this->Flash->error('Could not send email');
                }
            }

        }
    }

    public function resetpassword($token)
    {

        if ($this->request->is('post')) {
            $mypass = $this->request->getdata('password');
            $usertable = TableRegistry::get('Users');
            $user = $usertable->find('all')->where(['token' => $token])->first();

            $user->password = $mypass;
            if ($usertable->save($user)) {
                return $this->redirect(['action' => 'login']);
            }


        }
    }

   public function adminDashboard()
    {
        $this->checkAuth();
        if (!$this->Auth->user()) {
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $status="booked";

        $this->viewBuilder()->setLayout('admin');
        $this->set('topTitle', 'Dashboard');
        $this->set(compact('status'));
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data['btn'] == 'processing') {
                $status="processing";

            } elseif ($data['btn'] == 'booked') {
                $status = "booked";
            }

            elseif ($data['btn'] == 'canceled') {
                $status="canceled";
            }
            elseif ($data['btn'] == 'all') {
                $status="";
            }
            elseif ($data['btn'] == 'CanceledW/ORefundList') {
                $status="CanceledW/ORefundList";
            }
            $this->set(compact('status'));

        }



    }

    public function bookingsHistory()
    {
        $user=$this->Auth->user();

        if($user['type']=== 'admin'){
            $this->viewBuilder()->setLayout('admin');

        }
        elseif($user['type']=== 'client'){
            $this->viewBuilder()->setLayout('client');

        }
        $this->set('topTitle', 'My Booking History');
        $userId = $this->Auth->user('id');

        $this->set(compact('userId'));


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


    public function addModal()
    {
        $this->checkAuth();

        $this->request->allowMethod(['ajax', 'get']);
        $newUser = $this->Users->newEntity();

        $this->set(compact('newUser'));
    }

    public function saveModal()
    {
        $this->checkAuth();
        $this->request->allowMethod(['ajax', 'post']);
        $newUser = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $newUser = $this->Users->patchEntity($newUser, $data);

            $newUser->email = $data['email'];
            $newUser->fname = $data['fname'];
            $newUser->password = $data['password'];
            $newUser->phone = $data['phone'];
            $newUser->type = $data['type'];
            if ($this->Users->save($newUser)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('newUser'));
    }
}
