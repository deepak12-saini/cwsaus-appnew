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
	
	//Function 'checkAdminSession' for admin check in controller
	function checkAdminSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_admin')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area.','default',array('class' => 'alert alert-danger'));
			$this->redirect('/admin');
			exit();
		}
	}
	
	//Function 'checkCustomerSession' for admin check in controller
	function checkcommonSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('Customer')){
			// set flash message and redirect
			$this->Session->setFlash('Sorry, you have no access. Please login with user account.','default',array('class' => 'alert alert-danger'));
			$this->redirect('/login');
			exit();
		}
	}
	function chkuserpermission(){
		
		$user_id = $this->Session->read('Customer.id');
		app::import('Model','UserPermission');
		$this->UserPermission = new UserPermission();
		$userArr = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.user_id'=>$user_id),'fields' => array('permssion_id'),));
		return $userArr;
	}	
	//Function 'checkCustomerSession' for admin check in controller
	function checkCustomerSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_customer')){
			// set flash message and redirect
			$this->Session->setFlash('Sorry, you have no user account access. Please login with user account.','default',array('class' => 'alert alert-danger'));
			$this->redirect('/login');
			exit();
		}
	}
	//Function 'checkStaffession' for admin check in controller
	function checkSatffSession() {
		// if the admin session hasn't been set
		if(!$this->Session->read('is_staff')){
			// set flash message and redirect
			$this->Session->setFlash('Sorry, you have no staff account access. Please login with staff account.','default',array('class' => 'alert alert-danger'));
			$this->redirect('/login');
			exit();
		}
	}
	function getCartList(){
		$sessionId = $this->Session->read('cart');
		$items_list=array();
		if(!empty($sessionId)){
			
			app::import('Model','ShopCart');
			$this->ShopCart = new ShopCart();
			
			app::import('Model','Product');
			$this->Product = new Product();
					
			$this->ShopCart->bindModel(
			array('belongsTo' => array('Product' => array(
				'className' => 'Product',			 
				'foreignKey' => 'product_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));
			// get value from cart
			$condition = array('ShopCart.session_id'=>$sessionId);
			
			$items_list = $this->ShopCart->find('all',array('conditions'=>$condition));
		}		
		$this->set('sessionItems',$items_list);
	}
	//Function 'callConstants' to define constants
	function callConstants()	{
		app::import('Model','Config');
		$this->Config = new Config();
		$configs = $this->Config->find('first');
		foreach($configs['Config'] as $key => $value){
			if(!defined(strtoupper($key))) 
				define(strtoupper($key), $value);
		}

	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :get Categories on menu
	****/
	public function getCategories(){
		app::import('Model','Category');
		$this->Category = new Category();
		$categories = $this->Category->find('all',array('conditions'=>array('Category.status'=>1),'order'=>'Category.category_name asc'));
		$this->set('categories',$categories);
	}
	
	
	public function getcarttotal(){
		app::import('Model','Cart');
		$this->Cart = new Cart();
		$cart_session_id = $this->Session->read('cart_session_id');
		
		$totalcount = 0;
		if(!empty($cart_session_id)){
			$totalcount = $this->Cart->find('count',array('conditions'=>array('Cart.cart_session_id'=>$cart_session_id)));
		}		
		return $totalcount;
	}
	
	public function getproduct(){
		app::import('Model','Product');
		$this->Product = new Product();
		$ProductArr = $this->Product->find('all',array('fields'=>array('title')));
		return $ProductArr;
	}	
	
	public function random_password( $length = 8 ) {
		//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%?";
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
		// send message email to client
	function sendemail($to,$subject,$template_name,$variables){
		$this->autoRender = false;		
		App::uses('CakeEmail', 'Network/Email');
       // $Email = new CakeEmail();
		
         $Email = new CakeEmail('smtp');
		$from=EMAIL;
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
