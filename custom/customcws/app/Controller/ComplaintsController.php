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
class ComplaintsController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','PaymentSetup','Category','Product','Subscriber','Contact','Staff','NappUser','UserAnswer','LabFile','LabAssign','Coupon','UserPermission','Conformance','Department','ComplaintType','Complaint','ConformanceRelation');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function detail($complaint_id=null,$type=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');
		$complaint_id = base64_decode($complaint_id);
		$this->Complaint->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'complaint_to',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		#$this->Complaint->recursive = 0;				
		$ComplaintArr = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaint_id)));
		$this->set('ComplaintArr',$ComplaintArr);
		$this->set('type',$type);
		
		
	}	

	function index(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');
		
		$this->Complaint->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'complaint_to',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('hasMany' => array('Conformance' => array(
			'className' => 'Conformance',			 
			'foreignKey' => 'complaintid',				
			'conditions' => array('complaintid'),
			'fields' => '',
			'order' => array(),
		))));
		#$this->Complaint->recursive = 0;		

		$complaint_id = '';		
		if(!empty($this->request->data['complaint_id'])){
			$complaint_id = $this->request->data['complaint_id'];	
			$this->paginate = array('conditions'=>array('Complaint.complaint_id'=>$complaint_id),'page' => 1, 'limit' => 25,'order'=>array('Complaint.id'=>'DESC'));
		}else{
			$this->paginate = array('page' => 1, 'limit' => 25,'order'=>array('Complaint.id'=>'DESC'));
		}		
		$ComplaintArr = $this->Paginator->paginate('Complaint');
		$this->set('ComplaintArr',$ComplaintArr);
		$this->set('complaint_id',$complaint_id);	 
		$this->set('emp_id',$emp_id);	 
		/*echo '<pre>';
		print_r($ComplaintArr);
		die(); */
		
	}
	
	
	function admin_autologin($complaint_id=null,$user_id=null){
		
		$this->autoRender = false;
		
		$ComplaintArrs = $this->Complaint->find('first',array('conditions'=>array('Complaint.id'=>$complaint_id)));		
		if(!empty($ComplaintArrs)){
			if(!empty($user_id)){
				$userArr  = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			}else{
				$userArr  = $this->User->find('first',array('conditions'=>array('User.id'=>2)));
			}				
			if(!empty($userArr)){				
				$this->Session->write('User', $userArr['User']);
				$this->Session->write('is_admin', 1);			
				$this->redirect('/admin/complaints/detail/'.base64_encode($ComplaintArrs['Complaint']['complaint_id']));
			}			
		}else{
			$this->redirect('/admin');
		}	
			
	}
	
	function admin_isapproveddisapproved($type=null,$complaint_id=null,$user_id=null){
		
		$this->autoRender = false;
		
		$userArr = $this->User->find('first',array('conditions'=>array('User.id'=>base64_decode($user_id))));
		if(!empty($userArr)){			
			
			$this->Session->write('User', $userArr['User']);
			$this->Session->write('is_admin', 1);							
			$name = $userArr['User']['name'];
			$email = $userArr['User']['email'];	
						
			$confirm = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaint_id)));			
			$complaintid = $confirm['Complaint']['id']; 
			$complaint_to = $confirm['Complaint']['complaint_to']; 
			$emp_id = $confirm['Complaint']['emp_id']; 
			$dept_id = $confirm['Complaint']['dept_id']; 
			$reason_for_complaint = $confirm['Complaint']['reason_for_complaint'];
			
			$this->Conformance->bindModel(
			array('belongsTo' => array('User' => array(
				'className' => 'User',			 
				'foreignKey' => 'admin_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			)))); 
			$complaintArr = $this->Conformance->find('first',array('conditions'=>array('Conformance.complaintid'=>$complaintid)));			
			if($confirm['Complaint']['is_approve_descline'] == 1){	
				$this->Session->setFlash('Already raised non-conformance by '.$complaintArr['User']['name'],'default',array('class' => 'alert alert-success'));
				$this->redirect('/admin/staffs/conformancelist');					
			}else if($confirm['Complaint']['is_approve_descline'] == 2){	
				$this->Session->setFlash('Already declined non-conformance request by '.$complaintArr['User']['name'],'default',array('class' => 'alert alert-success'));
				$this->redirect('/admin/complaints');					
			}else if(($confirm['Complaint']['is_approve_descline'] == 0) && ($type == 1)){
				// approved
				$updatecomplaint['Complaint']['id'] = $complaintid;
				$updatecomplaint['Complaint']['is_approve_descline'] = $type;
				$this->Complaint->save($updatecomplaint);				
				
				if(empty($complaintArr)){
					$confirmArr = $this->Conformance->find('first',array('order'=>array('Conformance.id'=>'DESC')));
					if(!empty($confirmArr['Conformance']['id'])){
						$randnumber = 1000 + $confirmArr['Conformance']['id'];		
					}else{
						$randnumber = 1000;		
					}					
					$dtncid = 'DT-NC-'.$randnumber;
					$this->request->data['Conformance']['nc_number'] = $dtncid;				
					$this->request->data['Conformance']['complaintid'] = $complaintid;							
					$this->request->data['Conformance']['non_conforance'] = $reason_for_complaint;									
					$this->request->data['Conformance']['dept_id'] = $dept_id;				
					$this->request->data['Conformance']['admin_id'] = base64_decode($user_id);				
					$this->request->data['Conformance']['compaint_by'] = $emp_id;				
					$this->request->data['Conformance']['compaint_to'] = $complaint_to;				
					$this->request->data['Conformance']['date_of_complaint'] = date('Y-m-d'); 	
					$this->request->data['Conformance']['status'] = 0;									
					$this->request->data['Conformance']['created'] = date('Y-m-d H:i:s');				
					//ConformanceRelation
					$this->Conformance->save($this->request->data);	
					$conformance_id = $this->Conformance->id;
						
					$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$complaint_to)));			
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
					
					$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$emp_id)));			
					$to_email = $NappUserArr['NappUser']['email'];
					$to_name  = $NappUserArr['NappUser']['name'];	
					$subject = SITENAME." :: Non Conformance DT-NC-".$randnumber." By ".ucfirst($name);				
					$template_name = 'userconformance';	
					$non_conforance = $this->request->data['Conformance']['non_conforance'];			
					$variables = array('name'=>$name,'to_name'=>$to_name,'title'=>$non_conforance);		
					try{
						$this->sendemail($to_email,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}		

					// assign to
					$instConformanceRelation['ConformanceRelation']['id'] = '';
					$instConformanceRelation['ConformanceRelation']['conformance_id'] = $conformance_id;
					$instConformanceRelation['ConformanceRelation']['emp_id'] = $complaint_to;
					$this->ConformanceRelation->save($instConformanceRelation);
					// assig by
					$instConformanceRelation['ConformanceRelation']['id'] = '';
					$instConformanceRelation['ConformanceRelation']['conformance_id']  = $conformance_id;
					$instConformanceRelation['ConformanceRelation']['emp_id'] = $emp_id;
					$this->ConformanceRelation->save($instConformanceRelation);
					$this->redirect('/admin/staffs/replyto/'.base64_encode($conformance_id));
					
				}else{
					$this->redirect('/admin/complaints');
				}	
			}else if($type == 2){
				// declined 				
				$updatecomplaint['Complaint']['id'] = $complaintid;
				$updatecomplaint['Complaint']['is_approve_descline'] = $type;
				$this->Complaint->save($updatecomplaint);		

				$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$emp_id)));			
				$to_email = $NappUserArr['NappUser']['email'];
				$to_name  = $NappUserArr['NappUser']['name'];	
				$subject = SITENAME." :: Your request for non-conformance(".$complaint_id.") has been declined";				
				$template_name = 'declined';	
						
				$variables = array('name'=>$name,'to_name'=>$to_name,'reason_for_complaint'=>$reason_for_complaint,'complaint_id'=>$complaint_id);		
				try{
					$this->sendemail($to_email,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}	
				$this->Session->setFlash('Non conformance request has been declined','default',array('class' => 'alert alert-success'));
				$this->redirect('/admin/complaints');
			}	
		}else{
			$this->Session->setFlash('Complaint created successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('/admin');	
		}			
		
	}	
	
	
	function requesttoraisenc($complaintId=null){
		$this->checkSatffSession();
		$this->autoRender = false;
		$cname = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');
		$complaintId = base64_decode($complaintId);
		
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		
		$confirm = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaintId)));
		
		if(!empty($confirm)){
			$userArr = $this->User->find('all',array('conditions'=>array('User.id >'=>1)));
			// echo '<pre>';
			// print_r($userArr);
			// die();
			if(!empty($userArr)){
				foreach($userArr as $userArrs){
					$email = $userArrs['User']['email'];
					$name = $userArrs['User']['name'];
					$user_id = $userArrs['User']['id'];
					if(!empty($email)){
						$complaint_id = $confirm['Complaint']['complaint_id'];
						
						$approved = SITEURL.'admin/complaints/isapproveddisapproved/1/'.$complaint_id.'/'.base64_encode($userArrs['User']['id']);				
						$disapproved = SITEURL.'admin/complaints/isapproveddisapproved/2/'.$complaint_id.'/'.base64_encode($userArrs['User']['id']);
						#$to_email = 'web@xoroglobal.com';	
						$to_email = $userArrs['User']['email'];								
						$subject = SITENAME." :: ".$cname." want to raise non conformance";				
						$template_name = 'requestcomplaint';	
						
						$variables = array('reason_for_complaint'=>$confirm['Complaint']['reason_for_complaint'],'complainttype'=>$confirm['ComplaintType']['title'],'complaint_id'=>$complaint_id,'name'=>$this->Session->read('Customer.name'),'to_name'=>$name,'disapproved'=>$disapproved,'approved'=>$approved);		
						try{
							$this->sendemail($to_email,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}
					}
			
				}	
				$this->Session->setFlash('Non conformance request has been sent to successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}
			$this->redirect('index');	
		}else{
			$this->redirect('index');
		}	
	}	
	
	function add(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Complaint');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');	
		
		if(!empty($this->request->data)){
		
			if(!empty($_FILES['file']['name'])){			
				$filename = time().$_FILES['file']['name'];	
				$tmp_name = $_FILES['file']['tmp_name'];	
				move_uploaded_file($tmp_name, WWW_ROOT . 'complaint/' .$filename);
				$this->request->data['Complaint']['document'] = $filename;			
			}
			
			$confirm = $this->Complaint->find('first',array('order'=>array('Complaint.id'=>'DESC')));
			$complaintid = 1000 + $confirm['Complaint']['id'];	
			
			$this->request->data['Complaint']['complaint_id'] = 'DTC-'.$complaintid;
			$this->request->data['Complaint']['other'] = $this->request->data['Complaint']['other'];
			$this->request->data['Complaint']['emp_id'] = $emp_id;
			$this->request->data['Complaint']['created'] = date('Y-m-d H:i:s');
			if($this->request->data['Complaint']['is_non_conformance'] == 2){
				$this->request->data['Complaint']['actioned_by_date'] = 0000-00-00;
			}
			
			if($this->Complaint->save($this->request->data)){	
				$complaint_id = $this->Complaint->id;
				$this->Session->setFlash('Complaint created successfully','default',array('class' => 'alert alert-success'));
				
				$userArr = $this->User->find('all',array('conditions'=>array('User.id >'=>1)));
				if(!empty($userArr)){
					foreach($userArr as $userArrs){
						$complaintids = 'DTC-'.$complaintid;
						$url = SITEURL.'admin/complaints/autologin/'.$complaint_id.'/'.base64_encode($userArrs['User']['id']);				
						$to_email = $userArr['User']['email'];			
						$subject = SITENAME." :: Complaint ".$complaintids." By ".$this->Session->read('Customer.name');				
						$template_name = 'complaint';	
						
						$variables = array('name'=>$this->Session->read('Customer.name'),'to_name'=>'Admin','url'=>$url,'complaint_id'=>$complaint_id);		
						try{
							$this->sendemail($to_email,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}
					}
				}		
				
				$this->redirect('index');
				/* if($this->request->data['Complaint']['is_non_conformance'] == 2){
					$complaint_id = base64_encode($complaint_id);
					$this->redirect('/staffs/conformance/'.$complaint_id);
				}else{	
					$this->redirect('index');
				} */
			}	
		}
		
		$department = $this->Department->find('all');
		$this->set('departmentArr',$department);
		
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));

		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);

		$ComplaintType = $this->ComplaintType->find('all');
		$this->set('ComplaintType',$ComplaintType);	
	}		
	
	function edit($complaint_id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Complaint');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');	
		$complaint_id = base64_decode($complaint_id);
		if(!empty($this->request->data)){
			
			if(!empty($_FILES['file']['name'])){			
				$filename = time().$_FILES['file']['name'];	
				$tmp_name = $_FILES['file']['tmp_name'];	
				move_uploaded_file($tmp_name, WWW_ROOT . 'complaint/' .$filename);
				$this->request->data['Complaint']['document'] = $filename;			
			}
			
			if($this->request->data['Complaint']['is_non_conformance'] == 2){
				$this->request->data['Complaint']['actioned_by_date'] = 0000-00-00;
			}
			$this->request->data['Complaint']['other'] = $this->request->data['Complaint']['other'];
			if($this->Complaint->save($this->request->data)){			
				$this->Session->setFlash('Complaint updated successfully','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}	
		}
		
		$department = $this->Department->find('all');
		$this->set('departmentArr',$department);
		
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));

		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);

		$ComplaintType = $this->ComplaintType->find('all');
		$this->set('ComplaintType',$ComplaintType);	
		
		$ComplaintArr = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaint_id)));
		$this->set('ComplaintArr',$ComplaintArr);
		$this->request->data = $ComplaintArr;
	}	
	
	function admin_index(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkAdminSession();
		
		
		$this->Complaint->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'complaint_to',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('hasMany' => array('Conformance' => array(
			'className' => 'Conformance',			 
			'foreignKey' => 'complaintid',				
			'conditions' => array('complaintid'),
			'fields' => '',
			'order' => array(),
		))));
		#$this->Complaint->recursive = 0;
		$complaint_id = '';		
		if(!empty($this->request->data['complaint_id'])){
			$complaint_id = $this->request->data['complaint_id'];	
			$this->paginate = array('conditions'=>array('Complaint.complaint_id'=>$complaint_id),'page' => 1, 'limit' => 25,'order'=>array('Complaint.id'=>'DESC'));
		}else{
			$this->paginate = array('page' => 1, 'limit' => 25,'order'=>array('Complaint.id'=>'DESC'));
		}	
		
		$ComplaintArr = $this->Paginator->paginate('Complaint');
		
		// echo '<pre>';
		// print_r($ComplaintArr);
		// die();
		
		$this->set('ComplaintArr',$ComplaintArr);
		$this->set('complaint_id',$complaint_id);
		
		
	}	

	function admin_detail($complaint_id=null,$type=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkAdminSession();

		$complaint_id = base64_decode($complaint_id);
		$this->Complaint->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'complaint_to',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
				
		$ComplaintArr = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaint_id)));
		$this->set('ComplaintArr',$ComplaintArr);
		$this->set('type',$type);
			
	}		
	
}
