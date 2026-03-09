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
class StaffsController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','PaymentSetup','Category','Product','Subscriber','Contact','Staff','NappUser','UserAnswer','LabFile','LabAssign','Coupon','UserPermission','Conformance','Department','ConformanceRelation');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
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
	
	function activeaccount($semployeeid=null){
		
		$this->autoRender = false;
		
		if(!empty($semployeeid)){
			$email = base64_decode(base64_decode(base64_decode($semployeeid)));
			//$email = 'web@xoroglobal.com';
			$cus_arr = $this->NappUser->find('first',array('conditions'=>array('email'=>$email)));
			if(!empty($cus_arr)){
				$admin_arr = $this->User->find('first');						
				$this->Session->write('User', $admin_arr['User']);
				$this->Session->write('is_admin', 1);
				$this->redirect('/admin/users/edit_staff/'.$cus_arr['NappUser']['id']);				
				
			}else{
				$this->Session->setFlash('Sorry staff id missing','default',array('class' => 'alert alert-success'));
				$this->redirect('/admin');
			}
		}else{
			$this->Session->setFlash('Sorry staff id missing','default',array('class' => 'alert alert-success'));
			$this->redirect('/admin');
		}	
		
	}	
	
	public function dashboard() {
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Staff Dashboard Page');
		$this->checkSatffSession(); 
				
		$customer_id=$this->Session->read('Customer.id');
		$cus_arr = $this->NappUser->find('first',array('conditions'=>array('id'=>$customer_id)));
		$this->set('cus_arr',$cus_arr);
		
	}

	function profile()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Profile Page');
		$this->checkSatffSession();
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
		
		$department = $this->Department->find('all');
		$this->set('user',$user);
		$this->set('departmentArr',$department);
	}
	
	function change_password()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Change Password Page');
		$this->checkSatffSession();
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
	
	function datasheet(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Product Datasheet');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->Product->bindModel(
		array('belongsTo' => array('Category' => array(
			'className' => 'Category',			 
			'foreignKey' => 'category_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$name = '';
		$category_id = '';
		if(!empty($this->request->data)){
			$name = $this->request->data['productname'];
			$category_id = $this->request->data['category_id'];
			if(!empty($category_id) && !empty($name)){
				$this->paginate = array('conditions'=>array('Product.category_id'=>$category_id,'Product.status'=>1,'Product.is_deleted'=>0,'Product.datasheet !='=>'','Product.title LIKE'=>'%'.$name.'%'),'page' => 1,'page' => 1, 'limit' => 20);
			}else if(!empty($category_id)){
				$this->paginate = array('conditions'=>array('Product.category_id'=>$category_id,'Product.status'=>1,'Product.is_deleted'=>0),'page' => 1,'page' => 1, 'limit' => 20);
			}else if(!empty($name)){
				$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.is_deleted'=>0,'Product.datasheet !='=>'','Product.title LIKE'=>'%'.$name.'%'),'page' => 1,'page' => 1, 'limit' => 20);
			}		
			
		}else{
			$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.is_deleted'=>0,'Product.datasheet !='=>''),'page' => 1, 'limit' => 25,'order'=>array('Product.title'=>'asc'));
		}
		
		$productArr = $this->Paginator->paginate('Product');		
		$this->set('productArr',$productArr);
		$this->set('category_id',$category_id);
		$this->set('name',$name);
		
		$categoryArr = $this->Category->find('all',array('conditions'=>array('Category.is_deteled'=>0,'Category.status'=>1)));
		$this->set('categoryArr',$categoryArr);
		
		
		$upermission = $this->UserPermission->find('all',array('conditions'=>array('UserPermission.user_id'=>$user_id)));
		$this->set('upermission',$upermission);			
	
	}	
	
	function document($product_code=null,$type=null,$num=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Product Datasheet');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($product_code) && !empty($type)){
			$product_code = base64_decode($product_code);
			$data = $this->Product->find('first',array('conditions'=>array('Product.product_code'=>$product_code)));
					
			if(empty($data)){
				$this->Session->setFlash('Something missing','default',array('class' => 'alert alert-success'));
				$this->redirect('datasheet');
			}	
			$this->set('data',$data);			
			$this->set('type',$type);			
			$this->set('num',$num);			
		}else{
			$this->Session->setFlash('Something missing','default',array('class' => 'alert alert-success'));
			$this->redirect('datasheet');
		}	
	}
	
	function autologin($conformance_id=null){
		
		$this->autoRender = false;
		
		$ConformanceArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.id'=>base64_decode($conformance_id))));
		if(!empty($ConformanceArr)){
			
			$userArr  = $this->User->find('first',array('conditions'=>array('User.id'=>2)));
			if(!empty($userArr)){				
				$this->Session->write('User', $userArr['User']);
				$this->Session->write('is_admin', 1);			
				$this->redirect('/admin/staffs/replyto/'.$conformance_id);
			}			
		}else{
			$this->redirect('/admin');
		}	
			
	}	
	
	function replyto($conformance_id=null,$emp_id=null){
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Conformance Reply');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.');
		$user_id=$this->Session->read('Customer.id');
		$dept_id=$this->Session->read('Customer.dept_id');
		
		$Department = $this->Department->find('first',array('Department.id'=>$dept_id));
		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname').' ('.$Department['Department']['department_title'].')';
				
		$this->ConformanceRelation->bindModel(
		array('belongsTo' => array('Conformance' => array(
			'className' => 'Conformance',			 
			'foreignKey' => 'conformance_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$ConformanceArr = $this->ConformanceRelation->find('first',array('conditions'=>array('ConformanceRelation.emp_id'=>base64_decode($emp_id),'ConformanceRelation.conformance_id'=>base64_decode($conformance_id))));	
				
		if(!empty($this->request->data)){
			
			
			$conformance_id = $ConformanceArr['Conformance']['id'];					
			$ConformanceRelation_id = $ConformanceArr['ConformanceRelation']['id'];						
			$updaterelation['ConformanceRelation']['id'] =  $ConformanceRelation_id;		
			
			$updaterelation['ConformanceRelation']['corrective_action_taken'] =  $this->request->data['Conformance']['corrective_action_taken'];
			$updaterelation['ConformanceRelation']['preventive_action'] =  $this->request->data['Conformance']['preventive_action'];
			$updaterelation['ConformanceRelation']['created'] =  date('Y-m-d H:i:s');
			$this->ConformanceRelation->save($updaterelation);
			
			// send email to intiative
			$compaint_by = $ConformanceArr['Conformance']['compaint_by'];			
			$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$compaint_by)));			
			$to_email = $NappUserArr['NappUser']['email'];
			//$to_email = 'web@xoroglobal.com';
			$to_name  = $NappUserArr['NappUser']['name'];	
			$subject = SITENAME." :: Non Conformance ".$ConformanceArr['Conformance']['nc_number']." By ".$this->Session->read('Customer.name');				
			$template_name = 'replyconformance';	
			$non_conforance = $ConformanceArr['Conformance']['non_conforance'];			
			$variables = array('name'=>$this->Session->read('Customer.name'),'to_name'=>$to_name,'title'=>$non_conforance,'nc_number'=>$ConformanceArr['Conformance']['nc_number']);		
			try{
				$this->sendemail($to_email,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}	
			
			$admin_email = 'kal@durotechindustries.com.au';
			#$admin_email = 'web@xoroglobal.com';
			$admin_subject = SITENAME." :: Non Conformance ".$ConformanceArr['Conformance']['nc_number']." By ".$this->Session->read('Customer.name');

			$autologinurl = SITEURL.'staffs/autologin/'.base64_encode($ConformanceArr['Conformance']['id']);	
			$admin_template_name = 'autoreplyconformance';	
			$non_conforance = $ConformanceArr['Conformance']['non_conforance'];			
			$admin_variables = array('autologinurl'=>$autologinurl,'name'=>$this->Session->read('Customer.name'),'to_name'=>'Kal','title'=>$non_conforance,'nc_number'=>$ConformanceArr['Conformance']['nc_number']);		
			try{
				$this->sendemail($admin_email,$admin_subject,$admin_template_name,$admin_variables);
			}catch (Exception $e){
				
			}
			
			$updateConformance['Conformance']['id'] =  $conformance_id;			
			if(!empty($this->request->data['Conformance']['corrective_action_taken'])){
				$updateConformance['Conformance']['corrective_action_taken'] =  $this->request->data['Conformance']['corrective_action_taken'];
				$updateConformance['Conformance']['is_corrective'] =  $name;
			}
			
			if(!empty($this->request->data['Conformance']['preventive_action'])){
				$updateConformance['Conformance']['preventive_action'] =  $this->request->data['Conformance']['preventive_action'];
				$updateConformance['Conformance']['is_preventive'] =  $name;
			}	
			$updateConformance['Conformance']['status'] = 2;	
			$updateConformance['Conformance']['created'] =  date('Y-m-d H:i:s');
			$this->Conformance->save($updateConformance);
			
			if(!empty($this->request->data['ConformanceRelationnew']['emp_id'])){
				
				$emp_id = $this->request->data['ConformanceRelationnew']['emp_id'];
				$insertrelation['ConformanceRelation']['id'] =  '';		
				$insertrelation['ConformanceRelation']['conformance_id'] =  $conformance_id;		
				$insertrelation['ConformanceRelation']['emp_id'] = $emp_id;					
				$this->ConformanceRelation->save($insertrelation);
				
				
				// $template_name = 'replyconformance';	
				// $non_conforance = $ConformanceArr['Conformance']['non_conforance'];			
				// $variables = array('name'=>$this->Session->read('Customer.name'),'to_name'=>$to_name,'title'=>$non_conforance,'nc_number'=>$ConformanceArr['Conformance']['nc_number']);		
				// try{
					// $this->sendemail($to_email,$subject,$template_name,$variables);
				// }catch (Exception $e){
					
				// }	
				
			}	
		
			$this->Session->setFlash('Replied successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('conformancelist');
		}	
		$this->set('conformanceArr',$ConformanceArr);
		
		$confrel = $this->ConformanceRelation->find('list',array('conditions'=>array('ConformanceRelation.conformance_id'=>base64_decode($conformance_id)),'fields'=>array('emp_id')));	
		
		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$confrel,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);
		$this->set('user_id',$user_id);
	
		
		
	}	
	function conformance($complaint_id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Conformance List');
		$this->checkSatffSession();
		
		if(!empty($complaint_id)){
			$complaint_id = base64_decode($complaint_id);
			
			$complaintArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.complaintid'=>$complaint_id)));
			if(!empty($complaintArr)){
				$this->redirect('index');
			}	
		}else{
			$complaint_id = 0;
		}	
		
		
		
		$user_id=$this->Session->read('Customer.id');			
		$name=$this->Session->read('Customer.name');	
		if(!empty($this->request->data)){
			
			$confirm = $this->Conformance->find('first',array('order'=>array('Conformance.id'=>'DESC')));
			$randnumber = 1000 + $confirm['Conformance']['id'];		
		
			$this->request->data['Conformance']['nc_number'] = 'DT-NC-'.$randnumber;				
			$this->request->data['Conformance']['compaint_by'] = $user_id;				
			$this->request->data['Conformance']['status'] = 1;	
					
			$this->request->data['Conformance']['complaintid'] = $complaint_id;				
			$this->request->data['Conformance']['created'] = date('Y-m-d H:i:s');	
			
			//ConformanceRelation
			$this->Conformance->save($this->request->data);	


			$compaint_to = $this->request->data['Conformance']['compaint_to'];
			$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$compaint_to)));			
			$to_email = $NappUserArr['NappUser']['email'];
			$to_name  = $NappUserArr['NappUser']['name'];	
			$subject = SITENAME." :: Non Conformance DT-NC-".$randnumber." By ".ucfirst($name);				
			$template_name = 'conformance';	
			$non_conforance = $this->request->data['Conformance']['non_conforance'];			
			$variables = array('name'=>$name,'to_name'=>$to_name,'title'=>$non_conforance);		
			try{
				$this->sendemail($to_email,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}		
			
			$conformance_id = $this->Conformance->id;
				// assign to
			$instConformanceRelation['ConformanceRelation']['id'] = '';
			$instConformanceRelation['ConformanceRelation']['conformance_id'] = $conformance_id;
			$instConformanceRelation['ConformanceRelation']['emp_id'] = $user_id;
			$this->ConformanceRelation->save($instConformanceRelation);
				// assig by
			$instConformanceRelation['ConformanceRelation']['id'] = '';
			$instConformanceRelation['ConformanceRelation']['conformance_id']  = $conformance_id;
			$instConformanceRelation['ConformanceRelation']['emp_id'] = $this->request->data['Conformance']['compaint_to'];
			$this->ConformanceRelation->save($instConformanceRelation);
			
			$this->Session->setFlash('Generated successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('conformancelist');
		}
		$department = $this->Department->find('all');
		$this->set('departmentArr',$department);

		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$user_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);	
		
	}	
	
	// function detail($complaint_id=null){
		
		// $this->layout='staff_inner_layout';
		// $this->set('title_for_layout',SITENAME.' Conformance List');
		// $this->checkSatffSession();
		// $user_id=$this->Session->read('Customer.id');
		
		// $this->Conformance->find('first',array('conditions'=>array('Conformance.id')));
	// }	
	
	function conformancelist(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Conformance List');
		$this->checkSatffSession();
		 $user_id=$this->Session->read('Customer.id');
		
		$confrel = $this->ConformanceRelation->find('list',array('conditions'=>array('ConformanceRelation.emp_id'=>$user_id),'fields'=>array('conformance_id')));
		
		
		$this->Conformance->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'compaint_by',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));

		
		$this->Conformance->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('hasMany' => array('ConformanceRelation' => array(
			'className' => 'ConformanceRelation',			 
			'foreignKey' => 'conformance_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->ConformanceRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('User' => array(
			'className' => 'User',			 
			'foreignKey' => 'admin_id',				
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('Complaint' => array(
			'className' => 'Complaint',			 
			'foreignKey' => 'complaintid',				
			'conditions' => array('complaintid'),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->Conformance->recursive = 3;
		#$this->paginate = array('conditions'=>array('OR'=>array('Conformance.compaint_by'=>$user_id,'Conformance.compaint_to'=>$user_id)),'page' => 1, 'limit' => 25,'order'=>array('Conformance.id DESC'));
		$this->paginate = array('conditions'=>array('Conformance.id'=>$confrel),'page' => 1, 'limit' => 25,'order'=>array('Conformance.id'=>'DESC'));
		$ConformanceArr = $this->Paginator->paginate('Conformance');
		$this->set('ConformanceArr',$ConformanceArr);
		$this->set('user_id',$user_id);	
			
		
	}
	
	function detail($nc_number=null,$type=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Conformance Detail');
		$this->checkSatffSession();
		 $user_id=$this->Session->read('Customer.id');
		
		$confrel = $this->ConformanceRelation->find('list',array('conditions'=>array('ConformanceRelation.emp_id'=>$user_id),'fields'=>array('conformance_id')));
		
		
		$this->Conformance->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'compaint_by',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));

		
		$this->Conformance->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('hasMany' => array('ConformanceRelation' => array(
			'className' => 'ConformanceRelation',			 
			'foreignKey' => 'conformance_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->ConformanceRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('User' => array(
			'className' => 'User',			 
			'foreignKey' => 'admin_id',				
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('Complaint' => array(
			'className' => 'Complaint',			 
			'foreignKey' => 'complaintid',				
			'conditions' => array('complaintid'),
			'fields' => '',
			'order' => array(),
		))));
		$nc_number = base64_decode($nc_number);
		$this->Conformance->recursive = 3;
		$ConformanceArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.nc_number'=>$nc_number)));
		/* echo '<pre>';
		print_r($ConformanceArr);
		die(); */
		$this->set('ComplaintArr',$ConformanceArr);
		$this->set('type',$type);
		$this->set('user_id',$user_id);	
			
		
	}
	
	function admin_detail($nc_number=null,$type=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Conformance Detail');
		$this->checkAdminSession();
		
		$this->Conformance->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'compaint_by',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));

		
		$this->Conformance->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('hasMany' => array('ConformanceRelation' => array(
			'className' => 'ConformanceRelation',			 
			'foreignKey' => 'conformance_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->ConformanceRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('User' => array(
			'className' => 'User',			 
			'foreignKey' => 'admin_id',				
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
		$this->Conformance->bindModel(
		array('belongsTo' => array('Complaint' => array(
			'className' => 'Complaint',			 
			'foreignKey' => 'complaintid',				
			'conditions' => array('complaintid'),
			'fields' => '',
			'order' => array(),
		))));
		$nc_number = base64_decode($nc_number);
		$this->Conformance->recursive = 3;
		$ConformanceArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.nc_number'=>$nc_number)));
		/* echo '<pre>';
		print_r($ConformanceArr);
		die(); */
		$this->set('ComplaintArr',$ConformanceArr);
		$this->set('type',$type);
	
	}
	function admin_replyto($conformance_id=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Conformance Reply');
		$this->checkAdminSession();
		$admin_id = $this->Session->read('User.id');
					
		$ConformanceArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.id'=>base64_decode($conformance_id))));					
		if(!empty($this->request->data)){		
			
			
			$compaint_by = $ConformanceArr['Conformance']['compaint_by'];			
			$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$compaint_by)));			
			$to_email = $NappUserArr['NappUser']['email'];
			#$to_email = 'web@xoroglobal.com';
			$to_name  = $NappUserArr['NappUser']['name'];	
			$subject = SITENAME." :: Non Conformance ".$ConformanceArr['Conformance']['nc_number']." By ".$this->Session->read('User.name');				
			$template_name = 'replyconformance';	
			$non_conforance = $ConformanceArr['Conformance']['non_conforance'];			
			$variables = array('name'=>$this->Session->read('User.name'),'to_name'=>$to_name,'title'=>$non_conforance,'nc_number'=>$ConformanceArr['Conformance']['nc_number']);		
			try{
				$this->sendemail($to_email,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}
			
			$conformance_id = $ConformanceArr['Conformance']['id'];			
			$updaterelation['Conformance']['id'] =  $conformance_id;	
			$updaterelation['Conformance']['admin_id'] =  $admin_id;	
			$updaterelation['Conformance']['management_representive'] =  $this->request->data['Conformance']['management_representive'];	
			$updaterelation['Conformance']['status'] =  $this->request->data['Conformance']['status'];	
			$this->Conformance->save($updaterelation);			
			$this->Session->setFlash('Replied successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('conformancelist');
		}	
		$this->set('conformanceArr',$ConformanceArr);
		
		
	}	
	function admin_conformancelist(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Conformance List');
		$this->checkAdminSession();
		$user_id=$this->Session->read('Customer.id');
	
		$this->Conformance->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'compaint_by',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('hasMany' => array('ConformanceRelation' => array(
			'className' => 'ConformanceRelation',			 
			'foreignKey' => 'conformance_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->ConformanceRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id','dept_id'),
			'order' => array(),
		))));
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => array('department_title'),
			'order' => array(),
		))));
		
		$this->Conformance->bindModel(
		array('belongsTo' => array('User' => array(
			'className' => 'User',			 
			'foreignKey' => 'admin_id',				
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
				
		$this->Conformance->recursive = 3;
		#$this->paginate = array('conditions'=>array('OR'=>array('Conformance.compaint_by'=>$user_id,'Conformance.compaint_to'=>$user_id)),'page' => 1, 'limit' => 25,'order'=>array('Conformance.id DESC'));
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('Conformance.id'=>'DESC'));
		$ConformanceArr = $this->Paginator->paginate('Conformance');
		
		
		// echo '<pre>';
		// print_r($ConformanceArr);
		// die();
		
		$this->set('ConformanceArr',$ConformanceArr);
		$this->set('user_id',$user_id);	
				
		
	}	
	function sendsms(){
		
		$this->autoRender = false;
		
		$confirgArr =$this->Config->find('first');
				
		$sid = TSID;	
		$token = TOKEN;	
		$to = '+61402963688';	
		$from = FROM_NUMBER;	
		$message = 'Test Message';	
		
		$url = SITEURL."twilio/index.php";						
		$fields = array(
			'sid' => urlencode($sid),
			'token' => urlencode($token),							
			'to' => urlencode($to),							
			'from' => urlencode($from),							
			'message' => urlencode($message),							
		);	
		$fields_string = '';
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
			
		echo '<pre>';
		print_r($result);
		die();	
	}	
	
}
