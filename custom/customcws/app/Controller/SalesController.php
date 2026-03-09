<?php 
App::uses('AppController','Controller');
class SalesController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	 
	public $uses = array('SaleRep','SaleQuestion','User','NappUser','UserPermission','Department','SaleReminder');
	/***
	/*Author  :Ranjit, 
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	/***
	/*Author  :Ranjit,
	/*Comment :Admin NappUser list
	****/
	
	public function admin_map(){	
	
		$this->layout='';
		$this->set('title_for_layout',SITENAME.' Customer Map');		
		$this->checkAdminSession(); 
	
	}
	
	public function admin_index(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Sale Customer List');		
		$this->checkAdminSession(); 
				
		$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));			
		$this->NappUser->recursive = 0;
		$this->paginate = array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper),'page' => 1, 'limit' => 25);
		$staffArr = $this->Paginator->paginate('NappUser');
		/* echo '<pre>';
		print_r($userper);
		print_r($staffArr);
		die();		 */
		$this->set('staff', $staffArr);		
	}
	
	function admin_saledasboard(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Sale Dashboard');		
		$this->checkAdminSession(); 
		
		// fetch all sales person
		$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));
		$napuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper)));
		$this->set('napuser',$napuser);
		$startdate = '';
		$enddate = '';
		$slaetype = '';
		$this->SaleRep->bindModel(
		array('belongsTo' => array('SaleQuestion' => array(
			'className' => 'SaleQuestion',			 
			'foreignKey' => 'sales_question_id',				
			'conditions' => array(),
			'fields' => '', 
			'order' => array(),
		))));
		$this->SaleRep->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'staff_id',				
			'conditions' => array(),
			'fields' => array('id','name','lname'),
			'order' => array(),
		))));	
		if(!empty($this->request->data)){
			$sdate = $this->request->data['startdate'];
			$edate = $this->request->data['enddate'];
			
			$startdate = date('Y-m-d',strtotime($sdate));
			$enddate = date('Y-m-d',strtotime($edate));			
			$SaleRepArr = $this->SaleRep->find('all',array('conditions'=>array('DATE(SaleRep.created) >='=>$startdate,'DATE(SaleRep.created) <='=>$enddate)));
		}else{
			
			$startdate = date('Y-m-d',strtotime('-7 days'));
			$enddate = date('Y-m-d');			
			$SaleRepArr = $this->SaleRep->find('all',array('conditions'=>array('DATE(SaleRep.created) >='=>$startdate,'DATE(SaleRep.created) <='=>$enddate)));
		}			
		$then = new DateTime($enddate);
		$now = new DateTime($startdate); 
		$sinceThen = $then->diff($now);							
		$d = $sinceThen->d;
		$finaldata = array();
		
		foreach($napuser as $napusers){
			$data['name'] = $napusers['NappUser']['name'];
			$nnew = array();
			for($i=0; $i < $d; $i++){
				$startdatenew = date('Y-m-d',strtotime($startdate.' +'.$i.' days'));			
				$totalsalesrep = $this->SaleRep->find('count',array('conditions'=>array('DATE(SaleRep.created)'=>$startdatenew,'SaleRep.staff_id'=>$napusers['NappUser']['id'])));
				$nnew[] = $totalsalesrep;			
			}	
			$data['data'] = $nnew;	
			$finaldata[] = 	$data;
		}
		$finaldate = array();
		for($k=0; $k < $d; $k++){
			$startdatenew = date('d-M',strtotime($startdate.' +'.$k.' days'));
			$finaldate[] = $startdatenew;
		}
		
		$slatestype = $this->SaleQuestion->find('all');				
		$this->set(compact('slatestype','SaleRepArr','startdate','enddate','slaetype','finaldata','d','finaldate'));
	}	
	
	function admin_report($staff_id=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Report Page');		
		$this->checkAdminSession(); 
		
		$napuser = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$staff_id)));		
		$this->SaleRep->bindModel(
		array('belongsTo' => array('SaleQuestion' => array(
			'className' => 'SaleQuestion',			 
			'foreignKey' => 'sales_question_id',				
			'conditions' => array(),
			'fields' => '', 
			'order' => array(),
		))));
		$startdate = '';
		$enddate = '';
		$slaetype = '';
		if(!empty($this->request->data)){
			$slaetype = $this->request->data['slaetype'];
			$startdate = $this->request->data['startdate'];
			$enddate = $this->request->data['enddate'];	
			if(!empty($slaetype)){
				$this->paginate = array('conditions'=>array('DATE(SaleRep.created) >='=>$startdate,'DATE(SaleRep.created) <='=>$enddate,'SaleRep.staff_id'=>$staff_id,'SaleRep.sales_question_id'=>$slaetype),'page' => 1, 'limit' => 100,'order'=>'SaleRep.id DESC'); 
			}else{
				$this->paginate = array('conditions'=>array('DATE(SaleRep.created) >='=>$startdate,'DATE(SaleRep.created) <='=>$enddate,'SaleRep.staff_id'=>$staff_id),'page' => 1, 'limit' => 100,'order'=>'SaleRep.id DESC'); 
			}	
			
		}else{
			$startdate = date('Y-m-d',strtotime('-7 days'));
			$enddate = date('Y-m-d');
			$this->paginate = array('conditions'=>array('DATE(SaleRep.created) >='=>$startdate,'DATE(SaleRep.created) <='=>$enddate,'SaleRep.staff_id'=>$staff_id),'page' => 1, 'limit' => 100,'order'=>'SaleRep.id DESC');
		}	
		
		$SaleRepArr = $this->Paginator->paginate('SaleRep');
		$this->set('napuser',$napuser);
		$this->set('SaleRepArr',$SaleRepArr);		
		$this->set('startdate',$startdate);
		$this->set('enddate',$enddate);
		$this->set('slaetype',$slaetype);
		// echo '<pre>';
		// print_r($SaleRepArr);
		// die();
		
		$slatestype = $this->SaleQuestion->find('all');
		$this->set('slatestype',$slatestype);
		
		
	}	
	function admin_settarget($staff_id=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Report Page');		
		$this->checkAdminSession(); 
		
		if(!empty($this->request->data)){
			$this->request->data['NappUser']['id'] = $staff_id;
			if($this->NappUser->save($this->request->data)){
				$this->Session->setFlash('Sale target set successfully','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}	
		}	
		
		$napuser = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$staff_id)));		
		$this->set('napuser',$napuser);
	}	
	
	function admin_salereminder($staff_id=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Report Page');		
		$this->checkAdminSession(); 
		$SaleReminder = $this->SaleReminder->find('first');
		$this->set('SaleReminder',$SaleReminder);
		if(!empty($this->request->data)){
			
			$update['SaleReminder']['id'] = $SaleReminder['SaleReminder']['id'];
			$update['SaleReminder']['first_reminder'] =  $this->request->data['first_reminder'];
			$update['SaleReminder']['first_reminder'] =  $this->request->data['first_reminder'];
			$update['SaleReminder']['f_time'] =  $this->request->data['f_time'];
			$update['SaleReminder']['second_reminder'] =  $this->request->data['second_reminder'];
			$update['SaleReminder']['s_time'] =  $this->request->data['s_time'];
			$update['SaleReminder']['third_reminder'] =  $this->request->data['third_reminder'];
			$update['SaleReminder']['t_time'] =  $this->request->data['t_time'];
		
			if($this->SaleReminder->save($update)){
				$this->Session->setFlash('sale reminder setuo successfully','default',array('class' => 'alert alert-success'));
				$this->redirect('salereminder');
			}			
			
		}		
		
	}	
	
	function cronjob(){
		die();
		$this->autoRender = false;
		
		$SaleReminderArr = $this->SaleReminder->find('first');
		
		$day = date('D');	
		$hour = date('H');
		$hour = ltrim($hour,'0');
		
		if( ($day != 'Sat') && ($day != 'Sun')){
			
			// fetch all sales person
			$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));
			$napuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper)));
			if(!empty($napuser)){
				$date = date('Y-m-d');
				foreach($napuser as $napusers){
					
					$name = $napusers['NappUser']['name'].' '.$napusers['NappUser']['lname'];
					$email = $napusers['NappUser']['email'];
					$staff_id = $napusers['NappUser']['id'];
				
					if($hour == $SaleReminderArr['SaleReminder']['f_time']){			
						$first_reminder = $SaleReminderArr['SaleReminder']['first_reminder'];
						
						$subject = SITENAME.' :: Good Morning Friendly Reminder';				
						$template_name = 'friendly';										
						$variables = array('to_name'=>$name,'message'=>$first_reminder);		
					
						try{
							$this->sendemail($email ,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						} 		
						
					}else if($hour == $SaleReminderArr['SaleReminder']['s_time']){
						$second_reminder = $SaleReminderArr['SaleReminder']['second_reminder'];
						
						$subject = SITENAME.' :: Good Afternoon Friendly Reminder';				
						$template_name = 'friendly';										
						$variables = array('to_name'=>$name,'message'=>$second_reminder);				
						try{
							$this->sendemail($email ,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						} 
						
					}else if($hour == $SaleReminderArr['SaleReminder']['t_time']){
						$third_reminder = $SaleReminderArr['SaleReminder']['third_reminder'];
						
						$subject = SITENAME.' :: Good Evening Friendly Reminder';				
						$template_name = 'friendly';										
						$variables = array('to_name'=>$name,'message'=>$third_reminder);				
						try{
							$this->sendemail($email ,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						} 
						
					} 	
					
				}	
			}			
		}			
	}	
	
	
	

}
?>