<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','Blog','QuoteRequest');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
	}
/**
 * Dashboard a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function admin_dashboard() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin Dashboard Page');
		$this->checkAdminSession(); 		$QuoteRequestCount = $this->QuoteRequest->find('count',array('conditions'=>array()));		$BlogsCount = $this->Blog->find('count',array('conditions'=>array('Blog.status'=>1)));
		
		$total_earning=0;
		$this->set("total_earning",$total_earning);		$this->set(compact('total_earning','BlogsCount','QuoteRequestCount'));

	}
	
	/***
	/*Author  :Ranjit,
	/*Comment : admin Login page
	****/
	public function admin_login() {
		$this->layout='admin_login';
		$this->set('title_for_layout',SITENAME.' Admin Login Page');
				$admin_id=$this->Session->read('User.id');
		if($admin_id){
			$this->redirect('dashboard');
		}		
		if(!empty($this->data)){		
			$admin_arr = $this->User->find('first',array('conditions'=>array('username'=>$this->data['User']['username'],'password'=>$this->data['User']['password'],'status'=>1,'user_type'=>2)));
			if(!empty($admin_arr)){				
				$this->Session->write('User', $admin_arr['User']);
				$this->Session->write('is_admin', 1);			
				$this->redirect('dashboard');
			}else{
				//$this->Session->setFlash(__('Wrong username/password', true));
				$this->Session->setFlash('Wrong username/password','default',array('class' => 'alert alert-danger'));
			}
		}
	}
/***
	/*Author  :Ranjit,
	/*Comment : User Logout page
****/	
	function admin_logout()
	{
		$this->Session->delete('User');
		$this->Session->delete('is_admin');
		$this->redirect('/admin');

	}
	
	/***
	/*Author  :Ranjit,
	/*Comment : Admin profile
****/	
	function admin_profile()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Profile Page');
		$admin_id=$this->Session->read('User.id');
		$user = $this->User->find('first',array('conditions'=>array('User.id'=>$admin_id)));
		if(!empty($this->request->data)){			
			if(!empty($user)){
				$this->request->data['User']['id']=$user['User']['id'];
				
				if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your profile has been updated','default',array('class' => 'alert alert-success'));
				$this->redirect('profile');
				}else{
				$this->Session->setFlash('Your profile has not updated','default',array('class' => 'alert alert-danger'));
					
				}
			}
		}
	
		$this->request->data = $user;
	}	

/***
	/*Author  :Ranjit,
	/*Comment : Admin change password
****/	
	function admin_change_password()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Change Password Page');
		if($this->request->is('post')){
			$admin_id=$this->Session->read('User.id');
			$User = $this->User->find('first',array('conditions'=>array('User.id'=>$admin_id)));
			if(!empty($User)){
				$this->User->id=$User['User']['id'];
				if($this->request->data['User']['new_password']==$this->request->data['User']['confirm_password'])
				{
						
					if($User['User']['password']==$this->request->data['User']['current_password'])
					{
						
						$this->User->saveField("password",$this->request->data['User']['new_password']);
						$to=$User['User']['email'];
						$subject=SITENAME." Admin Password Change";
				
						// find template
						/* $emailTemplate = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.tag'=>'change-password')));
						$name = $User['User']['name'];
						$email_template = $emailTemplate['EmailTemplate']['description'];						
						$email_template = str_replace('[NAME]',$name,$email_template);	
						$email_template = str_replace('[PASSWORD]',$this->request->data['User']['new_password'],$email_template);	
						
						// SEND EMAIL
						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						// More headers
						$headers .= 'From: <no-reply@neildev.us>' . "\r\n";	
						mail($to,$subject,$email_template,$headers); */
						$this->Session->setFlash('Your password has been changed successfully.','default',array('class' => 'alert alert-success'));
						$this->request->data='';
					}else{
						$this->Session->setFlash('Current password not correct.Please, try again.','default',array('class' => 'alert alert-danger'));
					}
				}else{
					
					$this->Session->setFlash('New and confirm password not matched.Please, try again.','default',array('class' => 'alert alert-danger'));
				}
				
				
			}else{
				$this->Session->setFlash('User record not found.Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			
		}
	}
	/***
	/*Author  :Ranjit,
	/*Comment : Admin forgot password
****/	
	function admin_website_setting()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Website Setting');
		if($this->request->data){

			if(!empty($this->request->data)){
				
				$this->request->data['Config']['id']=	ID;
				$this->Config->save($this->request->data);
				$this->Session->setFlash('Website setting is saved successfully.','default',array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('The email entered is not found.Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			$this->redirect('website_setting');
		}
		$this->request->data = $this->Config->find('first',array('conditions'=>array('Config.id'=>ID)));
	}	
	

	
	/***
	/*Author  :Ranjit,
	/*Comment : Admin forgot password
****/	
	function admin_forgot_password()
	{
		if($this->request->is('post')){
			$User = $this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['User']['email'])));
			if(!empty($User)){
				$name = $User['User']['name'];
				$email = $User['User']['email'];
				$this->User->id=$User['User']['id'];
				$password=$this->random_password(8);
				$this->User->saveField("password",$password);
				
				$to=$this->request->data['User']['email'];
				$subject=SITENAME." :: Password reset successfully.";
								
				$template_name='contact';
				$content = 'Here is you new password  :';				
				$message = '<p>Full Name  :  '.$name.'</p>';
				$message .= '<p>Email  :  '.$email.'</p>';
				$message .= '<p>Password  :  '.$password.'</p>';				
								
				$variables=array('receiver_name'=>$name,'top_content'=>$content,'message'=>$message);
				$this->sendemail($to,$subject,$template_name,$variables);
				
				$this->Session->setFlash('The mail has been sent to reset password.','default',array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('The email entered is not found.Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			$this->redirect('/admin');
		}
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment : Admin Payment Setup
	****/	
		function admin_payment_setting()
		{
			$this->layout='admin_layout';
			$this->set('title_for_layout',SITENAME.' payment setting');
			$admin_id= $this->Session->read('User.id');
			$PaymentSetup = $this->PaymentSetup->find('first',array('conditions'=>array('PaymentSetup.id'=>1)));
			if(!empty($this->request->data)){			
				if(!empty($PaymentSetup)){
					$this->request->data['PaymentSetup']['id']=$PaymentSetup['PaymentSetup']['id'];
				
					if ($this->PaymentSetup->save($this->request->data)) {
					$this->Session->setFlash('Your Payment Setup has been updated','default',array('class' => 'alert alert-success'));
					$this->redirect('payment_setting');
					}else{
					$this->Session->setFlash('Your Payment Setup has not updated','default',array('class' => 'alert alert-danger'));
						
					}
				}
			}
		
			$this->request->data = $PaymentSetup;
			$this->set('payment_setup',$PaymentSetup);
		}
	
	public function random_password( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
		function admin_subscribers()
	{
		 app::import('Model', 'Newsletter');
        $this->Newsletter = new Newsletter(); 
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Subscriber List');		
		$this->checkAdminSession(); 
		$this->Newsletter->recursive = 0;
		$this->paginate = array('conditions'=>array('Newsletter.email !='=>''),'page' => 1, 'limit' => 25);
		$Subscribers = $this->Paginator->paginate('Newsletter');
		
		
		$this->set('subscribers', $Subscribers);		
	}
	

	
	
	// send message email to client

	function sendemail($to,$subject,$template_name,$variables){
		$this->autoRender = false;		
		
		App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
		$from=ADMIN_EMAIL;
		$from_name=SITENAME;
		$Email->from(array($from => $from_name));
		$Email->to($to);
		$Email->subject($subject);
		$Email->template($template_name,null);
		$Email->emailFormat('html');
		$Email->viewVars($variables);		
		$Email->send(); 
		
		
	}

	
	################################# New USER ########################33
	
	/***
	/*Author  :Ranjit,
	/*Comment :Admin User list
	****/
	public function admin_index(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' User List');		
		$this->checkAdminSession(); 
		$role = $this->Session->read('User.role');		
		$this->User->recursive = 0;
		$this->paginate = array('conditions'=>array('User.role !='=>$role,'User.user_type'=>2),'page' => 1, 'limit' => 25);
		$users = $this->Paginator->paginate('User');		
		$this->set('users', $users);		
	}
	
	
	/**
	* Author:Ranjit
	* Discription:Add User
	* @return void
*/
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New User');
		$this->checkAdminSession(); 
		if ($this->request->is('post')) {
			
			$name = $this->request->data['User']['name'];
			$email = $this->request->data['User']['email'];
			$username = $this->request->data['User']['username'];
			$password = $this->request->data['User']['password'];
			$userExist = $this->User->find('first',array('conditions'=>array('User.email'=>$email)));	
			if(empty($userExist)){
				$this->request->data['User']['role']= 'A';
				$this->request->data['User']['user_type']= 2;
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$link  = '<a href="'.SITEURL.'admin">click here</a>';
					$to = $this->request->data['User']['email'];
					$subject=SITENAME." - Account detail.";
									
					$template_name='contact';
					$content = 'Here is your login detail :';		
					
					$message = '<p>Full Name  :  '.$name.'</p>';
					$message .= '<p>Email  :  '.$email.'</p>';
					$message .= '<p>Username  :  '.$username.'</p>';
					$message .= '<p>Password  :  '.$password.'</p>';				
					$message .= '<p>Link  :  '.$link.'</p>';				
									
					$variables=array('receiver_name'=>$name,'top_content'=>$content,'message'=>$message);
					$this->sendemail($to,$subject,$template_name,$variables);	
					$this->Session->setFlash('The user has been saved','default',array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('The user could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
				}
			} else {
				$this->Session->setFlash('Email id exist. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	/**
	* Author:Ranjit
	* Discription:Edit The User
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
	public function admin_edit($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Edit User');
		$this->checkAdminSession(); 
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$role = $this->Session->read('User.role');	
		if($role == 'A'){
			$this->Session->setFlash('Sorry you have no access','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'dashboard'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$id = $this->request->data['User']['id'];
			
			$name = $this->request->data['User']['name'];
			$email = $this->request->data['User']['email'];
			$username = $this->request->data['User']['username'];
			$password = $this->request->data['User']['password'];
			$userExist = $this->User->find('first',array('conditions'=>array('User.email'=>$email,'User.id !='=>$id)));	
			if(empty($userExist)){
				
			if ($this->User->save($this->request->data)) {
				
				if($this->request->data['noti'] == 1){
				
				$link  = '<a href="'.SITEURL.'admin">click here</a>';
				$to = $this->request->data['User']['email'];
				$subject=SITENAME." - updated login detail.";
								
				$template_name='contact';
				$content = 'Here is your login detail :';		
				
				$message = '<p>Full Name  :  '.$name.'</p>';
				$message .= '<p>Email  :  '.$email.'</p>';
				$message .= '<p>Username  :  '.$username.'</p>';
				$message .= '<p>Password  :  '.$password.'</p>';				
				$message .= '<p>Link  :  '.$link.'</p>';				
								
				$variables=array('receiver_name'=>$name,'top_content'=>$content,'message'=>$message);
				$this->sendemail($to,$subject,$template_name,$variables);	
				}
				$this->Session->setFlash('The User has been updated','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The User could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			} else {
				$this->Session->setFlash('Email id exist. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
				
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$User = $this->User->find('first', $options);			
			$this->request->data = $User;			
			$this->set('user',$User);
			
		}
	}

	/**
 	* Author:Ranjit
	* Discription:Delete The User
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
	public function admin_delete($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Delete');
		$this->checkAdminSession(); 
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		$role = $this->Session->read('User.role');	
		if($role == 'A'){
			$this->Session->setFlash('Sorry you have no access','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'dashboard'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash('The User has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The User could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	

	
	
}
