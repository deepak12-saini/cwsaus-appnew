<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	 public $components = array('Session','Stripe');
	//Function 'checkAdminSession' for admin check in controller
	function checkAdminSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_admin')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area','default',array('class' => 'alert alert-danger'));
			$this->redirect('/admin');
			exit();
		}
	}
	
	//Function 'checkAdminSession' for admin check in controller
	function checkCustomerSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_customer')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area','default',array('class' => 'alert alert-danger'));
			$this->redirect('/fp');
			exit();
		}
	}
	//Function 'checkAdminSession' for admin check in controller
	function checkClientSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_client')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area','default',array('class' => 'alert alert-danger'));
			$this->redirect('/sbo');
			exit();
		}
	}
	//Function 'callConstants' to define constants
	function callConstants()	{
		app::import('Model','Config');
		$this->Config = new Config();
		$configs = $this->Config->find('first',array('conditions'=>array('Config.id'=>1)));
		foreach($configs['Config'] as $key => $value){
			if(!defined(strtoupper($key))) 
				define(strtoupper($key), $value);
		}
		
		$seller_id = $this->Session->read('Seller.id');
		$credits = 0;
		if(!empty($seller_id)){
			app::import('Model','Seller');
			$this->Seller = new Seller();
			
			$seller = $this->Seller->find('first',array('conditions'=>array('Seller.id'=>$seller_id)));
			$credits = $seller['Seller']['credits']; 
		}
		$this->set('credits',$credits);
	}
	
	function CustomerClientRelation($client_id,$customer_id)
	{
			app::import('Model','Client');
			$this->Client = new Client();
			
			$ClientArr = $this->Client->find('first',array('conditions'=>array('Client.id'=>$client_id,'Client.customer_id'=>$customer_id)));
			if(!empty($ClientArr))
			{
				return 1;
			}else{
				return 0;
			}
	}
	//Function 'checkSignupEmail' for email uniqueness
	function checkSignupEmail($email=null) {
			app::import('Model','Customer');
			$this->Customer = new Customer();
			
			app::import('Model','Client');
			$this->Client = new Client();
			$email_flag=0;
			if(!empty($email))
			{
				$CustomerArr = $this->Customer->find('first',array('conditions'=>array('Customer.email'=>$email)));
				if(!empty($CustomerArr))
				{
					$email_flag=1;
				}
				$client_id=$this->Session->read('signup.client_id');
				if(!empty($client_id))
				{
					$ClientInfo = $this->Client->find('first',array('conditions'=>array('Client.id'=>$client_id),'fields'=>'email'));
					$ClientArr = $this->Client->find('first',array('conditions'=>array('Client.email'=>$email,'Client.email !='=>$ClientInfo['Client']['email'])));
				}else{
					
						$ClientArr = $this->Client->find('first',array('conditions'=>array('Client.email'=>$email)));
				}
			
				if(!empty($ClientArr))
				{
					$email_flag=2;
				}
			}
			return $email_flag;
			
	}
	
	function checkEmail($client_id=null,$email=null) {
			app::import('Model','Customer');
			$this->Customer = new Customer();
			
			app::import('Model','Client');
			$this->Client = new Client();
			$email_flag=0;
			//$customer_email=$this->Session->read('Customer.email');
			if(!empty($email))
			{
				$CustomerArr = $this->Customer->find('first',array('conditions'=>array('Customer.email'=>$email)));
				//echo '<pre>';print_r($CustomerArr);die;
				if(!empty($CustomerArr))
				{
					$email_flag=1;
				}
				
				if(!empty($client_id))
				{
					$ClientInfo = $this->Client->find('first',array('conditions'=>array('Client.id'=>$client_id),'fields'=>'email'));
					$ClientArr = $this->Client->find('first',array('conditions'=>array('Client.email'=>$email,'Client.email !='=>$ClientInfo['Client']['email'])));
				}else{
					
						$ClientArr = $this->Client->find('first',array('conditions'=>array('Client.email'=>$email)));
				}
			
				if(!empty($ClientArr))
				{
					$email_flag=2;
				}
			}
			return $email_flag;
			
	}
	
	
	function format_phone_us($phone) {
		$this->autoRender=false;		
		// note: making sure we have something
		if(!isset($phone{3})) { return ''; }
		// note: strip out everything but numbers 
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$length = strlen($phone);
		switch($length) {
			case 7:
				$result = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			break;
			case 10:
				$result = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
			break;
			case 11:
				$result = preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
			break;
			default:
				$result = $phone;
			break;
		}
		echo  $result;
	}
	
	function admin_format_phone_us($phone) {
		$this->autoRender=false;		
		// note: making sure we have something
		if(!isset($phone{3})) { return ''; }
		// note: strip out everything but numbers 
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$length = strlen($phone);
		switch($length) {
			case 7:
				$result = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			break;
			case 10:
				$result = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
			break;
			case 11:
				$result = preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
			break;
			default:
				$result = $phone;
			break;
		}
		echo  $result;
	}
	
	// send message email to client
	function sendemail($to,$subject,$template_name,$variables){
		$this->autoRender = false;		
		App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
		$from=REPLY_MAIL;
		
		$from_name=SITENAME;
		$Email->from(array($from => $from_name));
		$Email->to($to);
		$Email->subject($subject);
		$Email->template($template_name,null);
		$Email->emailFormat('html');
		$Email->viewVars($variables);		
		$Email->send(); 
	}
}
