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
	public $uses = array('User','PaymentSetup','Category','Product','Subscriber','Contact','Staff','NappUser','UserAnswer','Question','QuestionOption','QuestionSubmit','LabFile','LabAssign','Coupon','Permission','UserPermission','Coupon','Lead');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function admin_lead()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Lead Generation');
		$this->checkAdminSession();
	
		$this->paginate = array('page' => 1, 'limit' => 10,'order'=>'Lead.id desc');
		$LeadArr = $this->Paginator->paginate('Lead');	
		#echo '<pre>'; print_r($LeadArr); die;
		$this->set('LeadArr',$LeadArr);	
		
	}
	function admin_updatestatus($lead_id = null)
	{
		$this->autoRender = false;
		$this->checkAdminSession();
		
		$update['Lead']['id'] = $lead_id;
		$update['Lead']['status'] = 2;
		$this->Lead->save($update);
		$this->Session->setFlash('Lead marked has completed.','default',array('class' => 'alert alert-success'));
		$this->redirect('lead');
	}	
	
	
	function autocouponlist(){
		$this->autoRender = false;
		
		$admin_arr = $this->User->find('first');
			if(!empty($admin_arr)){				
				$this->Session->write('User', $admin_arr['User']);
				$this->Session->write('is_admin', 1);			
				$this->redirect('couponlist');
			}else{
				//$this->Session->setFlash(__('Wrong username/password', true));
				$this->Session->setFlash('Wrong username/password','default',array('class' => 'alert alert-danger'));
				$this->redirect('/');
			}
	}	
	function admin_redeem($couponcode=null){
		
		$this->autoRender = false;
		$this->checkAdminSession();
		
		$CouponArr = $this->Coupon->find('first',array('conditions'=>array('Coupon.couponcode'=>$couponcode)));	
		if(!empty($CouponArr)){
			if($CouponArr['Coupon']['is_redeem'] == 1){
				
				$update['Coupon']['id'] = $CouponArr['Coupon']['id'];
				$update['Coupon']['is_redeem'] = 2;				
				$update['Coupon']['created'] = date('Y-m-d H:i:s');
				$update['Coupon']['redeem_date'] = date('Y-m-d H:i:s');
				$this->Coupon->save($update);
				
				$this->Session->setFlash('This coupon code successfully redeeemed','default',array('class' => 'alert alert-success'));
				$this->redirect('couponlist');
			}else{
				$this->Session->setFlash('wrong coupon code.','default',array('class' => 'alert alert-danger'));
				$this->redirect('couponlist');	
			}	
		}else{
			$this->Session->setFlash('wrong coupon code.','default',array('class' => 'alert alert-danger'));
			$this->redirect('couponlist');	
		}	
	}	
	
	
	function admin_couponlist(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Redeemed Coupon Code List');
		$this->checkAdminSession();
		
		
		$this->Coupon->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->paginate = array('conditions'=>array('Coupon.is_redeem >'=>0),'page' => 1, 'limit' => 10,'order'=>'Coupon.created desc');
		$this->Coupon->recursive = 0;
		$CouponArr = $this->Paginator->paginate('Coupon');	
		// echo '<pre>';
		// print_r($CouponArr);
		// die();
		$this->set('CouponArr',$CouponArr);
	}	
	
	public function admin_permission($id=null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Saff Permission');
		$this->checkAdminSession();
		
		if(!empty($this->request->data)){
			$this->UserPermission->query('delete from user_permissions where user_id='.$id.'');
			if(!empty($this->request->data['permssion_id'])){
				
				foreach($this->request->data['permssion_id'] as $permssion_id){
					$permssionId = explode('-',$permssion_id);
				
					$UserPermission['UserPermission']['id'] = '';
					$UserPermission['UserPermission']['user_id'] = $id;
					$UserPermission['UserPermission']['meta_val'] = $permssionId[1];
					$UserPermission['UserPermission']['permssion_id'] = $permssionId[0];
					$this->UserPermission->save($UserPermission);
				}	
			}	
			$this->Session->setFlash('updated successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('staff');	
		}			
		$permission = $this->Permission->find('all');
		$this->set('permission',$permission);	
	
		$upermission = $this->UserPermission->find('all',array('conditions'=>array('UserPermission.user_id'=>$id)));
		$this->set('upermission',$upermission);	
		
		$NappUser = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$id)));
		$this->set('NappUser',$NappUser);	
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
		$this->checkAdminSession(); 
		
		$totalcate = $this->Category->find('count');
		$totalpro = $this->Product->find('count');
		$totalStaff = $this->Staff->find('count');
		$totalCustomer = $this->NappUser->find('count');
		
		$this->set('totalCustomer',$totalCustomer);
		$this->set('totalStaff',$totalStaff);
		$this->set('totalcate',$totalcate);
		$this->set('totalpro',$totalpro);
	}
	
/***
/*Author  :Ranjit,
/*Comment : admin Login page
****/
	public function admin_login() {
		
		$this->layout='admin_login';
		$this->set('title_for_layout',SITENAME.' Admin Login Page');		
		$admin_id=$this->Session->read('User.id');
		if(!empty($admin_id)){
			$this->redirect('dashboard');
		}		
		if(!empty($this->data)){		
			$admin_arr = $this->User->find('first',array('conditions'=>array('username'=>$this->data['User']['username'],'password'=>$this->data['User']['password'])));
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
		$this->Session->destroy();
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
		$this->checkAdminSession();
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
	
	function admin_subscriber_list()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Subscriber List');
		$this->checkAdminSession();
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>'Subscriber.id desc');
		$this->Subscriber->recursive = 0;
		$Subscribers = $this->Paginator->paginate('Subscriber');	
		//echo '<pre>';print_r($Subscribers);die;
		$this->set('Subscribers',$Subscribers);	
	}
	function admin_contactus()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Contact List');
		$this->checkAdminSession();
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>'Contact.id desc');
		$this->Contact->recursive = 0;
		$contact = $this->Paginator->paginate('Contact');	
		//echo '<pre>'; print_r($contact ); die;
		$this->set('contact',$contact);	
	}
	
	

	
	function admin_web_setting()
		{
			$this->layout='admin_layout';
			$this->set('title_for_layout',SITENAME.' Web setting');
			$this->checkAdminSession();
			$Config = $this->Config->find('first',array('conditions'=>array('Config.id'=>1)));
			
			if(!empty($this->request->data)){	

				if (!empty($this->request->data['image']['name'])) {					
					$file = $this->request->data['image'];
					$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
					$arr_ext = array('jpg', 'jpeg', 'gif','png');
					if (in_array($ext, $arr_ext)) {														
						move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/' . $file['name']);
						//prepare the filename for database entry
						$this->request->data['Config']['logo'] = $file['name'];							
					}else{
						$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));
						$this->redirect('web_setting');
					}
				}		
			
				$this->request->data['Config']['id']=$Config['Config']['id'];			
				if ($this->Config->save($this->request->data)) {
				$this->Session->setFlash('Your web setting has been updated','default',array('class' => 'alert alert-success'));
				$this->redirect('web_setting');
				}else{
				$this->Session->setFlash('Your web setting has not updated','default',array('class' => 'alert alert-danger'));
					
				}
				
			}
		
			$this->request->data = $Config;
			$this->set('Config',$Config);
		}

/***
	/*Author  :Ranjit,
	/*Comment : Admin change password
****/	
	function admin_change_password()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Change Password Page');
		$this->checkAdminSession();
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
				
						/* // find template
						$emailTemplate = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.tag'=>'change-password')));
						$name = $User['User']['name'];
						$email_template = $emailTemplate['EmailTemplate']['description'];						
						$email_template = str_replace('[NAME]',$name,$email_template);	
						$email_template = str_replace('[PASSWORD]',$this->request->data['User']['new_password'],$email_template);	
					
						// SEND EMAIL
						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						// More headers
						$headers .= 'From: <no-reply@expressooh.com>' . "\r\n";	
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
	
	function send_forgot_password()
	{
		if($this->request->is('post')){
			
			$User = $this->NappUser->find('first',array('conditions'=>array('NappUser.email'=>$this->request->data['User']['email'])));
			if(!empty($User)){
				
				//$this->NappUser->id = $User['NappUser']['id'];
				//$password=$this->random_password(8);
				//$this->NappUser->saveField("password",md5($password));
				
				
				$userId = base64_encode(base64_encode(base64_encode($User['NappUser']['id'])));
				$url = SITEURL.'users/forgot_password/'.$userId;
				//$to = 'web@xoroglobal.com';	
				$to = $User['NappUser']['email'];	
				$subject=SITENAME." :: Reset your password.";				
				$template_name = 'setpassword';
				$variables = array('url'=>$url,'name'=>$User['NappUser']['name'],'email'=>$this->request->data['User']['email']);		
				try{
					$this->sendemail($to,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}				
				$this->Session->setFlash('Please check your email and set your password. ','default',array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('The email entered is not found. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			$this->redirect('/login');
		}
	}
	
	function forgot_password($usersId=null)
	{
		$this->layout='admin_login';
		
		$userId = base64_decode(base64_decode(base64_decode($usersId)));
		$usersArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$userId)));
		if(empty($usersArr)){
			$this->Session->setFlash('This users is not exits. Please try again!','default',array('class' => 'alert alert-danger'));	
			$this->redirect('/login');	
		}	
		if($this->request->is('post')){			
			$password = $this->request->data['NappUser']['password'];
			if(!empty($usersArr)){
				$this->NappUser->id= $usersArr['NappUser']['id'];				
				$this->NappUser->saveField("password",md5($password));
				
				$to = $usersArr['NappUser']['email'];				
				//$to = 'web@xoroglobal.com';				
				$subject = SITENAME." :: Your password changed successfully.";				
				$template_name = 'message';
				$variables = array('password'=>$password,'name'=>$usersArr['NappUser']['name'],'email'=>$usersArr['NappUser']['email'],'type'=>'forgot');		
				try{
					$this->sendemail($to , $subject ,$template_name,$variables);
				}catch (Exception $e){
					
				}	
			
				$this->Session->setFlash('Passowrd reset successfully.','default',array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('The email entered is not found. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
			$this->redirect('/login');
		}
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
				$this->User->id=$User['User']['id'];
				$password=$this->random_password(8);
				$this->User->saveField("password",$password);
				$to=$this->request->data['User']['email'];
				$subject=SITENAME." Password reset";
				// find template
			/* 	$emailTemplate = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.tag'=>'forgot-password')));
				$name = $User['User']['name'];
				$email_template = $emailTemplate['EmailTemplate']['description'];
				$email_template = str_replace('[NAME]',$name,$email_template);	
				$email_template = str_replace('[EMAIL]',$to,$email_template);	
				$email_template = str_replace('[PASSWORD]',$password,$email_template);	
				// SEND EMAIL
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: <no-reply@expressooh.com>' . "\r\n";	
				mail($to,$subject,$email_template,$headers); */
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
		$this->checkAdminSession();
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
	
	function admin_uploadprodcut(){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' payment setting');
		$this->checkAdminSession();
		
		if(!empty($this->request->data)){
			if(!empty($this->request->data['file']['name'])){
				$filename = $this->request->data['file']['name'];
				$tmp_name = $this->request->data['file']['tmp_name'];
				$org  = time().$filename;
				move_uploaded_file($tmp_name,'uploadfile/'.$org);
				
				
				echo '<pre>';
				print_r($this->request->data);
				die();	
			}			
		}		
	}	
	
	public function random_password( $length = 8 ) {
		
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
	
	
	function admin_customer()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Submited Quizz');
		$this->checkAdminSession();
		$name = '';
		
		$this->NappUser->bindModel(
		array('hasMany' => array('LabAssign' => array(
			'className' => 'LabAssign',			 
			'foreignKey' => 'customer_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->LabAssign->bindModel(
		array('belongsTo' => array('LabFile' => array(
			'className' => 'LabFile',			 
			'foreignKey' => 'lab_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		if(!empty($this->request->data)){
			$name = rtrim($this->request->data['name'],' ');
			$name = ltrim($name,' ');
			$this->paginate = array('conditions'=>array('OR'=>array('NappUser.name LIKE'=>'%'.$name.'%','NappUser.lname LIKE'=>'%'.$name.'%','NappUser.email LIKE'=>'%'.$name.'%')),'page' => 1, 'limit' => 25,'order'=>array('NappUser.id'=>'desc'));
		}else{
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('NappUser.id'=>'desc'));
		}	
		$this->NappUser->recursive = 2;
		$NappUser = $this->Paginator->paginate('NappUser');	
		//echo '<pre>'; print_r($NappUser); die;
		$this->set('NappUser',$NappUser);	
		$this->set('name',$name);	
	}
	
	function admin_quizz()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Submited Quizz');
		$this->checkAdminSession();
		
		$this->QuestionSubmit->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>'QuestionSubmit.id desc');
		$this->QuestionSubmit->recursive = 0;
		$QuestionSubmitArr = $this->Paginator->paginate('QuestionSubmit');	
		//echo '<pre>'; print_r($QuestionSubmitArr); die;
		$this->set('QuestionSubmitArr',$QuestionSubmitArr);	
	}
	
	function admin_staff()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Staff List');
		$this->checkAdminSession();
		$this->NappUser->bindModel(
		array('hasMany' => array('LabAssign' => array(
			'className' => 'LabAssign',			 
			'foreignKey' => 'customer_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->LabAssign->bindModel(
		array('belongsTo' => array('LabFile' => array(
			'className' => 'LabFile',			 
			'foreignKey' => 'lab_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		if(!empty($this->request->data)){
			$name = rtrim($this->request->data['name'],' ');
			$name = ltrim($name,' ');
			$this->paginate = array('conditions'=>array('NappUser.is_staff_id'=>1,'OR'=>array('NappUser.name LIKE'=>'%'.$name.'%','NappUser.lname LIKE'=>'%'.$name.'%','NappUser.email LIKE'=>'%'.$name.'%')),'page' => 1, 'limit' => 25,'order'=>array('NappUser.id'=>'desc'));
		}else{
			$this->paginate = array('conditions'=>array('NappUser.is_staff_id'=>1),'page' => 1, 'limit' => 25,'order'=>array('NappUser.id'=>'desc'));
		}	
		$this->NappUser->recursive = 2;		
		$staffArr = $this->Paginator->paginate('NappUser');	
		//echo '<pre>'; print_r($staffArr); die;
		$this->set('staffArr',$staffArr);	
	}
	
	function admin_labfile()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Label File List');
		$this->checkAdminSession();
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);
		$this->LabFile->recursive = 0;
		$staffArrArr = $this->Paginator->paginate('LabFile');	
		//echo '<pre>'; print_r($staffArrArr); die;
		$this->set('staffArrArr',$staffArrArr);	
	}
	
	function admin_updatelabfile($id=null)
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' update Label File');
		$this->checkAdminSession();
		$labfile = $this->LabFile->find('first',array('conditions'=>array('LabFile.id'=>$id)));
		$this->set('labfile',$labfile);
		
		if(!empty($this->request->data)){
			
			$dir = $labfile['LabFile']['dir'];
			$password = $this->request->data['User']['password'];
			if(!empty($_FILES['filename']['name'])){
				$filename = time().$_FILES['filename']['name'];
				$tmp_name = $_FILES['filename']['tmp_name'];
				move_uploaded_file($tmp_name,WWW_ROOT .'/'.$dir.'/'.$filename);
				$savedata['LabFile']['filename'] = $filename;
			}				
			$savedata['LabFile']['id'] = $id;		
			$savedata['LabFile']['password'] = $password;
			$this->LabFile->save($savedata);
			$this->Session->setFlash('File updated successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('labfile');
		}		
	}
	
	function apppricelistrequest(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['customer_id']) ? $customer_id = $_REQUEST['customer_id'] : $customer_id = 0;		
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		if(!empty($user)){			
			$custId = base64_encode(base64_encode($customer_id));
			$url = SITEURL.'admin/users/accesstouser/'.$custId;
			
			$to = 'kal@durotechindustries.com.au';				
			#$to = 'web@xoroglobal.com';				
			$subject=SITENAME." :: Request For Price List";				
			$template_name = 'pricelist';
			$name =  $user['NappUser']['name'].' '.$user['NappUser']['lname'];
			$variables = array('name'=>$name,'email'=>$user['NappUser']['email'],'type'=>'pricelist','url'=>$url);		
			try{
				$this->sendemail($to,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}	
			$data['status'] = true;
			$data['message'] = 'Request sent successfully';		
		}else{
			$data['status'] = false;
			$data['message'] = 'This user is not exist';			
		}	
		echo json_encode($data);	
	}
	
	function accesslabfile(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['customer_id']) ? $customer_id = $_REQUEST['customer_id'] : $customer_id = 0;
		if(!empty($customer_id)){			
			$this->LabAssign->bindModel(
			array('belongsTo' => array('LabFile' => array(
				'className' => 'LabFile',			 
				'foreignKey' => 'lab_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));				
			$LabAssign = $this->LabAssign->find('all',array('conditions'=>array('LabAssign.customer_id'=>$customer_id)));
			if(!empty($LabAssign)){
				$lablist = array();	
				$i = 1;			
				foreach($LabAssign as $LabAssigns){
					$lab['id'] =  $i;
					$lab['label'] =  $LabAssigns['LabFile']['label'];
					$lab['password'] =  $LabAssigns['LabFile']['password'];
					$lab['url'] =  SITEURL.$LabAssigns['LabFile']['dir'].'/'.$LabAssigns['LabFile']['filename'];
					$lablist[]=$lab;
					$i++;	
				}	
				$data['status'] = true;
				$data['data'] = $lablist;	
			}else{
				$data['status'] = false;
				$data['data'] = 'No File Access';	
			}		
		}else{
			$data['status'] = false;
			$data['message'] = 'user id missing';			
		}	
		echo json_encode($data);
	}	
	
	function labfile()
	{
		$is_staff_id=$this->Session->read('Customer.is_staff_id');	
		if($is_staff_id == 0){
			$this->layout='inner_layout';
		}else{
			$this->layout='staff_inner_layout';
		}	
		#$this->checkCustomerSession();
		$this->checkcommonSession();
		
		$this->set('title_for_layout',SITENAME.' Label File List');		
		$customer_id=$this->Session->read('Customer.id');		
		$this->LabAssign->bindModel(
		array('belongsTo' => array('LabFile' => array(
			'className' => 'LabFile',			 
			'foreignKey' => 'lab_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
	
		$this->paginate = array('conditions'=>array('LabAssign.customer_id'=>$customer_id),'page' => 1, 'limit' => 10);
		$LabAssignArr = $this->Paginator->paginate('LabAssign');	
		
		//echo '<pre>'; print_r($LabAssignArr); die;
		$this->set('LabAssignArr',$LabAssignArr);	
	}
	
	
	
	public function labelpdffile($dir=null){
		
		$is_staff_id=$this->Session->read('Customer.is_staff_id');	
		if($is_staff_id == 0){
			$this->layout='inner_layout';
		}else{
			$this->layout='staff_inner_layout';
		}	
		#$this->checkCustomerSession();
		$this->checkcommonSession();
		
		$this->set('title_for_layout',SITENAME.' | Price PDF File');	
		
		$customer_id=$this->Session->read('Customer.id');
		$LabFile = $this->LabFile->find('first',array('conditions'=>array('LabFile.dir'=>$dir)));
		if(empty($LabFile)){
			$this->redirect('labfile');
		}	
		$this->set('is_access',0);
		$opt = $this->Session->read('opt');
		$pdfaceess = $this->Session->read('pdfaceess');
		if(!empty($this->request->data)){
			$uotp = $this->request->data['otp'];
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.otp'=>$uotp,'NappUser.id'=>$customer_id)));
			
			if(!empty($userArr)){
				$update['NappUser']['id'] = $customer_id;
				$update['NappUser']['otp'] = '';
				$this->NappUser->save($update);	
				$this->Session->write('pdfaceess',1);
				$this->Session->delete('opt');
				$this->Session->setFlash('Thank for verifying your account.','default',array('class' => 'alert alert-success'));
				$this->redirect('labelpdffile/'.$dir);
				
			}else{
				$this->Session->setFlash('Wrong otp password. Please try again.','default',array('class' => 'alert alert-danger'));
			}	
		}else if(!empty($opt)){
			$this->set('is_access',1);
		}elseif(empty($pdfaceess)){			
			$rand = rand(000000,999999);			
			$update['NappUser']['id'] = $customer_id;
			$update['NappUser']['otp'] = $rand;
			$this->NappUser->save($update);	
			
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
	
			
			$name = $userArr['NappUser']['name'].' '.$userArr['NappUser']['lname'];
			
			$to = $userArr['NappUser']['email'];								
			$subject= SITENAME." :: One Time Password (OTP) for Price List Access. OTP is ".$rand;				
			$template_name = 'otp';										
			$variables = array('name'=>$name,'otp'=>$rand);	
	
			try{
				$this->sendemail($to,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}
			
			$this->Session->write('opt',$rand);			
			$this->Session->setFlash('OTP sent at email. Please check your mail and verify.','default',array('class' => 'alert alert-success'));
			$this->redirect('labelpdffile/'.$dir);
		}
		
	
		$this->set('LabFile',$LabFile);
	}
	
	function admin_access($id=null)
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' update Label File');
		$this->checkAdminSession();
		$LabAssign = $this->LabAssign->find('all',array('conditions'=>array('LabAssign.customer_id'=>$id)));
		$this->set('LabAssign',$LabAssign);
		// echo '<pre>';
		// print_r($LabAssign);
		// die();
		
		$NappUser = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$id)));
		$this->set('NappUser',$NappUser);
		
		$labfile = $this->LabFile->find('all');
		$this->set('labfile',$labfile);
		
		if(!empty($this->request->data)){
			
			$name = ucfirst($NappUser['NappUser']['name']).' '.ucfirst($NappUser['NappUser']['lname']);
					
			$this->LabAssign->query("delete from lab_assigns where customer_id = ".$id." ");
			if(!empty($this->request->data['lab_id'])){
				$label = '';
				foreach($this->request->data['lab_id'] as $lab_id){
					
					$LabFile = $this->LabFile->find('first',array('conditions'=>array('LabFile.id'=>$lab_id)));
					$label .= $LabFile['LabFile']['label'].' , ';
									
					$lab['LabAssign']['id'] = '';
					$lab['LabAssign']['customer_id'] = $id;
					$lab['LabAssign']['lab_id'] = $lab_id;
					$this->LabAssign->save($lab);
				}

				$label = rtrim($label,' ,');	
				if(!empty($label)){
					
					$to = $NappUser['NappUser']['email'];								
					$subject= SITENAME." :: Access To Price List Approved";				
					$template_name = 'congrates_price_list';										
					$variables = array('name'=>$name,'label'=>$label,'type'=>$NappUser['NappUser']['is_staff_id']);	
			
					try{
						$this->sendemail($to,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}
				}	
			}					
				
			$this->Session->setFlash('Labs Assigned','default',array('class' => 'alert alert-success'));
			if($NappUser['NappUser']['is_staff_id'] == 0){
				$this->redirect('customer');
			}else{
				$this->redirect('staff');
			}	
		}		
	}
	
	function admin_add_staff()
	{
	$this->layout='admin_layout';
	$this->set('title_for_layout',SITENAME.' Add Staff Page');
	$this->checkAdminSession();
	
		if(!empty($this->request->data)){		
			$staff_id = $this->request->data['Staff']['staff_id'];
			$staffArr = $this->Staff->find('first',array('conditions'=>array('Staff.staff_id'=>$staff_id)));
			if(empty($staffArr)){
				if ($this->Staff->save($this->request->data)) {
					$this->Session->setFlash('Added successfully','default',array('class' => 'alert alert-success'));
					$this->redirect('staff');
				}else{
					$this->Session->setFlash('Your profile has not updated','default',array('class' => 'alert alert-danger'));				
				}
			}else{
				$this->Session->setFlash('This staff id is already exist','default',array('class' => 'alert alert-danger'));				
			}
		}
	}
	function admin_edit_staff($id=null)
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Edit Staff Page');
		$this->checkAdminSession();
		$admin_id=$this->Session->read('User.id');
	
		$staffArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$id)));
		if(!empty($this->request->data)){						
			$emp_id = $this->request->data['NappUser']['emp_id'];		
			$staffArrnew = $this->NappUser->find('first',array('conditions'=>array('NappUser.id !='=>$id,'NappUser.emp_id'=>$emp_id)));
			if(empty($staffArrnew)){				
				$this->request->data['NappUser']['id'] = $id;
				
				// echo '<pre>';
				// print_r($this->request->data);
				// die();	
				if ($this->NappUser->save($this->request->data)) {
					if($staffArr['NappUser']['is_approved'] != $this->request->data['NappUser']['is_approved']){
						if($this->request->data['NappUser']['is_approved'] == 1){
							// account arroved 	
							
							$staff_to = $staffArr['NappUser']['email'];				
							$staff_subject = SITENAME." :: Congrats! your account has been approved";				
							$staff_template_name = 'staffaccount';
							$staff_variables = array('is_approved'=>1,'name'=>$staffArr['NappUser']['name'].' '.$staffArr['NappUser']['lname']);
							try{
								$this->sendemail($staff_to , $staff_subject ,$staff_template_name,$staff_variables);
							}catch (Exception $e){	
							
							}					
							
						}else if($this->request->data['NappUser']['is_approved'] == 2){
							// account disapproved
							
							$staff_to = $staffArr['NappUser']['email'];				
							$staff_subject = SITENAME." :: Account Disapproved.";				
							$staff_template_name = 'staffaccount';
							$staff_variables = array('is_approved'=>2,'name'=>$staffArr['NappUser']['name'].' '.$staffArr['NappUser']['lname']);
							try{
								$this->sendemail($staff_to , $staff_subject ,$staff_template_name,$staff_variables);
							}catch (Exception $e){	
							
							}	
							
						}	
					}	
					$this->Session->setFlash('updated successfully','default',array('class' => 'alert alert-success'));
					$this->redirect('staff');
				}else{
					$this->Session->setFlash('Your profile has not updated','default',array('class' => 'alert alert-danger'));				
				}
			}else{
				$this->Session->setFlash('This employee id is already exist','default',array('class' => 'alert alert-danger'));				
			}
		}
		
		
		$this->set('staffArr',$staffArr);
		$this->request->data = $staffArr;
	} 
	
	function register(){
		
		$this->layout='admin_login';
		$this->set('title_for_layout',SITENAME.' Customer Register Page');

		if(!empty($this->data)){
		
			$email = $this->request->data['NappUser']['email'];
			$cus_arr = $this->NappUser->find('first',array('conditions'=>array('email'=>$email)));
			if(empty($cus_arr)){
				
				$empid = 'CWS-'.rand(000000,999999);
				
				$password = $this->request->data['NappUser']['password'];
				$autopassword =  md5($this->request->data['NappUser']['password']);
				$this->request->data['NappUser']['insert_date'] = date('Y-m-d H;i:s');
				$this->request->data['NappUser']['emp_id'] =$empid;
				$this->request->data['NappUser']['password'] =$autopassword;
				$this->request->data['NappUser']['address_5'] = $password;
				$this->NappUser->save($this->request->data);
				
								
				$to = $this->request->data['NappUser']['email'];				
				$subject = SITENAME." :: Welcome To CWS Activate Your Account.";				
				$template_name = 'activation';
				$variables = array('password'=>base64_encode($to) ,'name'=>$this->request->data['NappUser']['name'],'email'=>$this->request->data['NappUser']['email'],'type'=>'activation');		
				try{
					$this->sendemail($to , $subject ,$template_name,$variables);
					$this->Session->setFlash('Register successfully. Please check your mail and activate your account.','default',array('class' => 'alert alert-success'));
					$this->redirect('/login');
				}catch (Exception $e){
				
					$this->Session->setFlash('Register successfully.','default',array('class' => 'alert alert-success'));
					$this->redirect('/login');
				}				
			}else{
				$this->Session->setFlash('Email id already exist.','default',array('class' => 'alert alert-danger'));
					
			}
			
		}	
	}

	function activateaccount($code=null){

		$this->autoRender = false;
		if(!empty($code)){
			$code = base64_decode($code);
			$cus_arr = $this->NappUser->find('first',array('conditions'=>array('email'=>$code)));
		
			if(!empty($cus_arr)){		
				if($cus_arr['NappUser']['is_active'] == 0){	
					$password = $cus_arr['NappUser']['address_5'];					
					$this->request->data['NappUser']['id'] = $cus_arr['NappUser']['id'];
					$this->request->data['NappUser']['is_active'] = 1;
					$this->request->data['NappUser']['address_5'] = '';
					$this->NappUser->save($this->request->data);
					
					
					$to = $cus_arr['NappUser']['email'];				
					$subject = SITENAME." :: Your account is activated.";				
					$template_name = 'message';
					$variables = array('password'=>$password ,'name'=>$cus_arr['NappUser']['name'],'email'=>$cus_arr['NappUser']['email'],'type'=>'signup');
					try{
						$this->sendemail($to , $subject ,$template_name,$variables);								
					}catch (Exception $e){				
						$this->Session->setFlash('Register successfully.','default',array('class' => 'alert alert-success'));
						$this->redirect('/login');
					}
					
					if($cus_arr['NappUser']['is_staff_id'] == 0){	
						$this->Session->setFlash('You account has been activated successfully.','default',array('class' => 'alert alert-success'));	
						$this->Session->write('Customer', $cus_arr['NappUser']);
						$this->Session->write('is_customer', 1);			
						$this->redirect('dashboard');
					}else{
						$semployeeid =  base64_encode(base64_encode(base64_encode($cus_arr['NappUser']['email'])));
						#$staff_to = 'kal@durotechindustries.com.au';				
						$staff_to = 'web@xoroglobal.com';				
						$staff_subject = SITENAME." :: New Employee Registered.";				
						$staff_template_name = 'staffmessage';
						$staff_variables = array('emp_id'=>$semployeeid,'name'=>$cus_arr['NappUser']['name'].' '.$cus_arr['NappUser']['lname'],'email'=>$cus_arr['NappUser']['email'],'type'=>'register');
						try{
							$this->sendemail($staff_to , $staff_subject ,$staff_template_name,$staff_variables);
						}catch (Exception $e){	
						
						}	
						$this->Session->setFlash('You account has been activated successfully.','default',array('class' => 'alert alert-success'));		
						$this->Session->write('Customer', $cus_arr['NappUser']);
						$this->Session->write('is_staff', 1);			
						$this->redirect('/staffs/dashboard');
					}	
					
					
				}else{
					$this->Session->setFlash('your account is already activated.','default',array('class' => 'alert alert-danger'));
					 $this->redirect('/login');		
				} 
			}else{
				$this->Session->setFlash('wrong activation code.','default',array('class' => 'alert alert-danger'));
				$this->redirect('/login');		
			}		
		}else{
			$this->Session->setFlash('activateion code is wrong.','default',array('class' => 'alert alert-danger'));
			$this->redirect('/login');
		}	
	}	
	
	
	
	public function login() {
		
		$this->layout='admin_login';
		$this->set('title_for_layout',SITENAME.' Customer Login Page');		
		$is_customer=$this->Session->read('is_customer');
		$is_staff=$this->Session->read('is_staff');
		
		if(!empty($is_customer)){
			$this->redirect('dashboard');
		}else if(!empty($is_staff)){
			$this->redirect('/staffs/dashboard');
		}		
		if(!empty($this->data)){
			$password = md5($this->request->data['NappUser']['password']);	
			$cus_arr = $this->NappUser->find('first',array('conditions'=>array('email'=>$this->request->data['NappUser']['email'],'password'=>$password)));
			// echo '<pre>';
			// print_r($cus_arr);
			// die();			
			if(!empty($cus_arr)){	
				if($cus_arr['NappUser']['is_active'] == 0){
					$this->Session->setFlash('You account is not active','default',array('class' => 'alert alert-danger'));
				}else{
					
				if($cus_arr['NappUser']['is_staff_id'] == 0){					
					$this->Session->write('Customer', $cus_arr['NappUser']);
					$this->Session->write('is_customer', 1);			
					$this->redirect('dashboard');
				}else{
					$this->Session->write('Customer', $cus_arr['NappUser']);
					$this->Session->write('is_staff', 1);			
					$this->redirect('/staffs/dashboard');
				}	
				
				}
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
	function logout()
	{
		$this->Session->destroy();
		$this->redirect('/login');

	}
	
	public function dashboard() {
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' Customer Dashboard Page');
		$this->checkCustomerSession(); 
		
	}
	
	public function questionlist(){
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' Customer questionlist');
		$this->checkCustomerSession(); 
		$customer_id=$this->Session->read('Customer.id');
		
		$customer_id=$this->Session->read('Customer.id');
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		$this->set('user',$user);
		
		$this->Question->bindModel(
			array('hasMany' => array('QuestionOption' => array(
			'className' => 'QuestionOption',    
			'foreignKey' => 'question_id',    
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
			))));	
	
		
		$question = $this->Question->find('all');
		$this->set('question',$question);
		
		$user_answers = $this->UserAnswer->find('all',array('conditions'=>array('UserAnswer.user_id'=>$customer_id)));
		$this->set('question',$question);
		
		if(!empty($this->request->data)){
					
			$name = $this->request->data['name'];
			$lname = $this->request->data['lname'];
			$email = $this->request->data['email'];
			$phone = $this->request->data['mobile'];
			$landlineno = $this->request->data['landlineno'];
			$company = $this->request->data['company'];
			$company_address = $this->request->data['company_address'];
			
			$QuestionSubmit['QuestionSubmit']['user_id'] = $customer_id;
			$QuestionSubmit['QuestionSubmit']['name'] = $name;
			$QuestionSubmit['QuestionSubmit']['lname'] = $lname;
			$QuestionSubmit['QuestionSubmit']['phone'] = $phone;
			$QuestionSubmit['QuestionSubmit']['email'] = $email;
			$QuestionSubmit['QuestionSubmit']['landlineno'] = $landlineno;
			$QuestionSubmit['QuestionSubmit']['company'] = $company;
			$QuestionSubmit['QuestionSubmit']['company_address'] = $company_address;
			$QuestionSubmit['QuestionSubmit']['created'] = date('Y-m-d H:i:s');
			$this->QuestionSubmit->save($QuestionSubmit);
			
			$url = SITEURL.'finalsubmit.php?user_id='.$customer_id;			
			$res = file_get_contents($url);
			$custname  = base64_encode(base64_encode($name));
			$this->redirect('thanks/'.$custname);		
		}	
		
	}
	public function thanks($custname=null) {
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' Customer Dashboard Page');
		$this->checkCustomerSession(); 
		$this->set('custname',$custname);
		
	}
	
	
	function profile()
	{
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' Profile Page');
		$this->checkCustomerSession();
		$customer_id=$this->Session->read('Customer.id');
			
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		if(!empty($this->request->data)){			
			if(!empty($user)){
				$this->request->data['NappUser']['id']=$customer_id;
				
				if ($this->NappUser->save($this->request->data)) {
				$this->Session->setFlash('Your profile has been updated','default',array('class' => 'alert alert-success'));
				$this->redirect('profile');
				}else{
				$this->Session->setFlash('Your profile has not updated','default',array('class' => 'alert alert-danger'));
					
				}
			}
		}
	
		$this->request->data = $user;
	}

	function admin_natspec_presentation_status($user_id=null,$status=null){
	
		$this->autoRender = false;
		
		$update['NappUser']['id']=$user_id;
		$update['NappUser']['is_natspec_presentation']=$status;
		// echo '<pre>';
		// print_r($update);
		// die();
		$this->NappUser->save($update);
		$this->Session->setFlash('natspec presentation status has been updated','default',array('class' => 'alert alert-success'));
		$this->redirect('customer');
	}	
	
	
	
	
	function admin_cpd_presentation_status($user_id=null,$status=null){
	
		$this->autoRender = false;
		
		$update['NappUser']['id']=$user_id;
		$update['NappUser']['is_cpd_presentation']=$status;
		$this->NappUser->save($update);
		$this->Session->setFlash('cpd presentation status has been updated','default',array('class' => 'alert alert-success'));
		$this->redirect('customer');
	}	
	function change_password()
	{
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' Change Password Page');
		$this->checkCustomerSession();
		if($this->request->is('post')){
			$customer_id=$this->Session->read('Customer.id');
			$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
			if(!empty($user)){
				$this->NappUser->id=$user['NappUser']['id'];
				if($this->request->data['NappUser']['new_password']==$this->request->data['NappUser']['confirm_password'])
				{
						
					if($user['NappUser']['password']==$this->request->data['NappUser']['current_password'])
					{
						
						$this->NappUser->saveField("password",$this->request->data['NappUser']['new_password']);
						
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
	
	function admin_accesstouser($custId=null){
		
		$this->autoRender = false;
		if(!empty($custId)){
			$custId = base64_decode(base64_decode($custId));
			$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$custId)));
			if(!empty($user)){						
				$admin_arr = $this->User->find('first');
				if(!empty($admin_arr)){				
				$this->Session->write('User', $admin_arr['User']);
				$this->Session->write('is_admin', 1);			
				$this->redirect('access/'.$custId);
				}else{
					//$this->Session->setFlash(__('Wrong username/password', true));
					$this->Session->setFlash('Wrong username/password','default',array('class' => 'alert alert-danger'));
				}
			}else{
				$this->Session->setFlash('sorry this customer not exist.','default',array('class' => 'alert alert-success'));	
				$this->redirect('/admin');		
			}	
		}else{
			$this->Session->setFlash('customer id is missing.','default',array('class' => 'alert alert-success'));	
			$this->redirect('/admin');
		}	
	}	
	
	
	
	function pricelistrequest(){
		
		$this->autoRender = false;
		
		$customer_id = $this->Session->read('Customer.id');	
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		if(!empty($user)){			
			$custId = base64_encode(base64_encode($customer_id));
			$url = SITEURL.'admin/users/accesstouser/'.$custId;
			$name =  $user['NappUser']['name'].' '.$user['NappUser']['lname'];
			$to = 'kal@durotechindustries.com.au';				
			#$to = 'web@xoroglobal.com';				
			$subject=SITENAME." :: Request For Price List by ".$name;				
			$template_name = 'pricelist';
			
			$variables = array('name'=>$name,'email'=>$user['NappUser']['email'],'type'=>'pricelist','url'=>$url);		
			try{
				$this->sendemail($to,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}	
			$this->Session->setFlash('Your request has been sent!.','default',array('class' => 'alert alert-success'));
			$this->redirect('labfile');
		}		
	}	
	function access($status=null){
		
		$this->autoRender = false;
		$customer_id=$this->Session->read('Customer.id');
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		if(!empty($user)){
			
			if($status == 0){
							
				$to = 'kal@durotechindustries.com.au';				
				$subject=SITENAME." :: Refuel CPD Access";				
				$template_name = 'refuel';
				$name =  $user['NappUser']['name'].' '.$user['NappUser']['lname'];
				$variables = array('name'=>$name,'email'=>$user['NappUser']['email'],'type'=>'Refuel');		
				try{
					$this->sendemail($to,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}	
				$this->Session->setFlash('Your request has been sent!','default',array('class' => 'alert alert-success'));
				$this->redirect('questionlist');
			}else{ 
				$to = 'kal@durotechindustries.com.au';				
				$subject=SITENAME." :: Natspec Presentation Access";				
				$template_name = 'refuel';
				$name =  $user['NappUser']['name'].' '.$user['NappUser']['lname'];
				$variables = array('name'=>$name,'email'=>$user['NappUser']['email'],'type'=>'Presentation');		
				try{
					$this->sendemail($to,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}
				$this->Session->setFlash('Your request has been sent!','default',array('class' => 'alert alert-success'));
				$this->redirect('presentation');	
			}	
				
		}	
	}	
	
	function coupon(){
		$this->autoRender = false;
		isset($_REQUEST['code'])? $code = $_REQUEST['code'] : $code = '';
		if(!empty($code)){
			
			$codeArr = $this->Coupon->find('first',array('conditions'=>array('Coupon.code'=>$code)));
			if(!empty($codeArr)){
				
				if($codeArr['Coupon']['is_read'] == 0){
					
					$update['Coupon']['id'] = $codeArr['Coupon']['id'];
					$update['Coupon']['is_read'] = 1;
					$this->Coupon->save($update);
					if($codeArr['Coupon']['is_ok'] == 1){
						$data['status'] = true;
						$data['message'] = 'Congrats! you have won $'.$codeArr['Coupon']['price'].'  Now contact technical@durotechindustries.com.au to redeeem your prize';	
					}else{
						$data['status'] = false;
						$data['message'] = 'Sorry this wrong coupon code';
					}					
				}else{
					$data['status'] = false;
					$data['message'] = 'This coupon code has already been used.';
				}	
				
			}else{
				$data['status'] = false;
				$data['message'] = 'wrong code';
			}	
		}else{
			$data['status'] = false;
			$data['message'] = 'please enter code';	
		}	
		echo json_encode($data);
	}	
	
	public function presentation(){
		$this->layout='inner_layout';
		$this->set('title_for_layout',SITENAME.' | Presentation');	
		
		$customer_id=$this->Session->read('Customer.id');
		$user = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$customer_id)));
		$this->set('user',$user);
	}
}
