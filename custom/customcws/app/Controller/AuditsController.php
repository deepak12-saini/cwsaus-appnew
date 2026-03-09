<?php 
App::uses('AppController','Controller');
class AuditsController extends AppController{
	
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('User','FormatInternalAuditPlan','NappUser','CircularInternalAudit','CircularInternalAuditList','CircularInternalAuditResult'); 
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function circularinternalauditadd(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');	
		
		if(!empty($this->request->data)){
			
			$this->request->data['CircularInternalAudit']['created'] = date('Y-m-d H:i:s');
			if($this->CircularInternalAudit->save($this->request->data)){
				$this->Session->setFlash('Audit Planning request has added successfully','default',array('class' => 'alert alert-success'));
				$this->redirect('circularinternalauditlist');	
			}	
		/* 	echo '<pre>';
			print_r($this->request->data);
			die(); */
		}
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		
		$InternalAuditPlan = $this->CircularInternalAudit->find('first',array('order'=>array('CircularInternalAudit.id'=>'desc')));
		if(empty($InternalAuditPlan)){
			$auditnumber = 'AIP-1000';
		}else{
			$an = 1000 + $InternalAuditPlan['CircularInternalAudit']['id'] + 1; 
			$auditnumber = 'AIP-'.$an;
		}
		
		$this->set('auditnumber',$auditnumber);	
	}	
	
	function circularinternalauditedit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');	
		
		if(!empty($this->request->data)){
			
			$this->request->data['CircularInternalAudit']['id'] = $id;
			if($this->CircularInternalAudit->save($this->request->data)){
				$this->Session->setFlash('Audit Planning request has added successfully','default',array('class' => 'alert alert-success'));
				$this->redirect('circularinternalauditlist');	
			}	
		/* 	echo '<pre>';
			print_r($this->request->data);
			die(); */
		}
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		
		$InternalAuditPlan = $this->CircularInternalAudit->find('first',array('conditions'=>array('CircularInternalAudit.id'=>$id)));
		
		$this->set('InternalAuditPlan',$InternalAuditPlan);	
		$this->set('userid',$userid);	
		$this->request->data = $InternalAuditPlan;
	}
	
	function circularinternalauditresult($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');	   
		if(!empty($this->request->data)){
			
			if(!empty($this->request->data)){
			
			if(!empty($this->request->data['date'])){
				$this->CircularInternalAuditResult->query('delete from circular_internal_audit_results where audit_id = '.$id.'');
				foreach($this->request->data['date'] as $key=>$datetime){					
					$insert['CircularInternalAuditResult']['id'] = '';
					$insert['CircularInternalAuditResult']['audit_id'] = $id;
					$insert['CircularInternalAuditResult']['department'] = $key;
					$insert['CircularInternalAuditResult']['date'] = $datetime['datetime'];
					$insert['CircularInternalAuditResult']['time'] = $datetime['time'];
					$insert['CircularInternalAuditResult']['auditor'] = $datetime['auditor'];
					$insert['CircularInternalAuditResult']['auditee'] = $datetime['auditee'];
					$insert['CircularInternalAuditResult']['created'] = date('Y-m-d H:i:s');
					$this->CircularInternalAuditResult->save($insert);
				}
			}	
			$update['CircularInternalAudit']['id'] = $id;
			$update['CircularInternalAudit']['opening_held_on'] = $this->request->data['CircularInternalAudit']['opening_held_on'];
			$update['CircularInternalAudit']['opening_place_at'] = $this->request->data['CircularInternalAudit']['opening_place_at'];
			$update['CircularInternalAudit']['closing_held_on'] = $this->request->data['CircularInternalAudit']['closing_held_on'];
			$update['CircularInternalAudit']['closing_place_at'] = $this->request->data['CircularInternalAudit']['closing_place_at'];
			$this->CircularInternalAudit->save($update);
		
		}
			
		}	
		
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		
		$CircularInternalAuditResult = $this->CircularInternalAuditResult->find('all',array('conditions'=>array('CircularInternalAuditResult.audit_id'=>$id)));
		$this->set('CircularInternalAuditResult',$CircularInternalAuditResult);	
		
		
		$InternalAuditPlan = $this->CircularInternalAudit->find('first',array('conditions'=>array('CircularInternalAudit.id'=>$id)));
		// echo '<pre>';
		// print_r($CircularInternalAuditResult);
		// die();
		$this->set('InternalAuditPlan',$InternalAuditPlan);	
		$this->set('userid',$userid);	
		
		
	}	
	
	function circularinternalauditlist(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');	

		$this->CircularInternalAudit->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		
		$this->CircularInternalAudit->bindModel(
		array('hasMany' => array('CircularInternalAuditList' => array(
			'className' => 'CircularInternalAuditList',			 
			'foreignKey' => 'cia_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); 
		$this->CircularInternalAuditList->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->CircularInternalAuditList->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditee',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array()
		))));
		
		$this->CircularInternalAudit->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('CircularInternalAudit.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$CircularInternalAuditArr = $this->Paginator->paginate('CircularInternalAudit');	
		$this->set('CircularInternalAuditArr',$CircularInternalAuditArr);
		$this->set('userid',$userid);
		
		// echo '<pre>';
		// print_r($CircularInternalAuditArr);
		// die();
	}
	
	function add(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Internal Audit Plan');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
						
			$insert['FormatInternalAuditPlan'] = $this->request->data['Audit'];	
			$insert['FormatInternalAuditPlan']['created'] = date('Y-m-d H:i:s');				
			$insert['FormatInternalAuditPlan']['user_id'] = $userid;				
			if($this->FormatInternalAuditPlan->save($insert)){
				if($insert['FormatInternalAuditPlan']['auditor'] > 0){
				
					$audit_number = $insert['FormatInternalAuditPlan']['audit_number'];
					$auditee = $insert['FormatInternalAuditPlan']['auditee'];
					$auditor = $insert['FormatInternalAuditPlan']['auditor'];
					$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$auditor),'fields'=>array('id','name','lname','email')));
					if(!empty($userArr)){
						
						$id = $userArr['NappUser']['id'];
						$email = $userArr['NappUser']['email'];
						$name = $userArr['NappUser']['name'].' '.$userArr['NappUser']['lname'];
						
						
						$subject = SITENAME.' :: Internal Audit Planning Request';
						$autologinurl = SITEURL.'audits/autologin/'.base64_encode($id).'/audit';	
						$admin_template_name = 'autditplanning';	
							
						$admin_variables = array('autologinurl'=>$autologinurl,'name'=>$name,'audit_number'=>$audit_number,'sendername'=>$sendername);		
						try{
							#$this->sendemail($email,$subject,$admin_template_name,$admin_variables);
							$this->sendemail('web@xoroglobal.com',$subject,$admin_template_name,$admin_variables);
						}catch (Exception $e){
							
						}
						
					}


					$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$auditee),'fields'=>array('id','name','lname','email')));
					if(!empty($userArr)){
						
						$ids = $userArr['NappUser']['id'];
						$emails = $userArr['NappUser']['email'];
						$names = $userArr['NappUser']['name'].' '.$userArr['NappUser']['lname'];
						
						
						$subject = SITENAME.' :: Internal Audit Planning Request';
						$autologinurl = SITEURL.'audits/autologin/'.base64_encode($ids).'/audit';	
						$admin_template_name = 'autditplanning';	
							
						$admin_variables = array('autologinurl'=>$autologinurl,'name'=>$names,'audit_number'=>$audit_number,'sendername'=>$sendername);		
						try{
							#$this->sendemail($emails,$subject,$admin_template_name,$admin_variables);
							$this->sendemail('web@xoroglobal.com',$subject,$admin_template_name,$admin_variables);
						}catch (Exception $e){
							
						}
						
					}	
					
				}
			}
			$this->Session->setFlash('Audit Planning request has added successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('index');		
		}
		
		$InternalAuditPlan = $this->FormatInternalAuditPlan->find('first',array('order'=>array('FormatInternalAuditPlan.id'=>'desc')));
		if(empty($InternalAuditPlan)){
			$auditnumber = 'AIP-1000';
		}else{
			$an = 1000 + $InternalAuditPlan['FormatInternalAuditPlan']['id'] + 1; 
			$auditnumber = 'AIP-'.$an;
		}
		$this->set('auditnumber',$auditnumber);	
		
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		/* echo '<pre>';
		print_r($userArr);
		die(); */
	}	
	
	function edit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Internal Audit Plan');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
						
			$insert['FormatInternalAuditPlan'] = $this->request->data['Audit'];	
			$insert['FormatInternalAuditPlan']['created'] = date('Y-m-d H:i:s');				
			$insert['FormatInternalAuditPlan']['user_id'] = $userid;	
			$insert['FormatInternalAuditPlan']['id'] = $id;	
			
			if($insert['FormatInternalAuditPlan']['status'] == 3){
				$insert['FormatInternalAuditPlan']['sign_of_mr'] = $sendername;					
			}	
			
			if($this->FormatInternalAuditPlan->save($insert)){
				if($insert['FormatInternalAuditPlan']['status'] == 3){
					if($insert['FormatInternalAuditPlan']['auditor'] > 0){
				
					$audit_number = $insert['FormatInternalAuditPlan']['audit_number'];
					$auditee = $insert['FormatInternalAuditPlan']['auditee'];
					$auditor = $insert['FormatInternalAuditPlan']['auditor'];
					$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$auditor),'fields'=>array('id','name','lname','email')));
					if(!empty($userArr)){
						
						$id = $userArr['NappUser']['id'];
						$email = $userArr['NappUser']['email'];
						$name = $userArr['NappUser']['name'].' '.$userArr['NappUser']['lname'];
						
						
						$subject = SITENAME.' :: Internal Audit Planning Request Completed';
						$autologinurl = SITEURL.'audits/autologin/'.base64_encode($id).'/audit';	
						$admin_template_name = 'autditplanning';	
							
						$admin_variables = array('autologinurl'=>$autologinurl,'name'=>$name,'audit_number'=>$audit_number,'sendername'=>$sendername);		
						try{
							#$this->sendemail($email,$subject,$admin_template_name,$admin_variables);
							$this->sendemail('web@xoroglobal.com',$subject,$admin_template_name,$admin_variables);
						}catch (Exception $e){
							
						}
						
					}


					$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$auditee),'fields'=>array('id','name','lname','email')));
					if(!empty($userArr)){
						
						$ids = $userArr['NappUser']['id'];
						$emails = $userArr['NappUser']['email'];
						$names = $userArr['NappUser']['name'].' '.$userArr['NappUser']['lname'];
						
						
						$subject = SITENAME.' :: Internal Audit Planning Request Completed';
						$autologinurl = SITEURL.'audits/autologin/'.base64_encode($ids).'/audit';	
						$admin_template_name = 'autditplanning';	
							
						$admin_variables = array('autologinurl'=>$autologinurl,'name'=>$names,'audit_number'=>$audit_number,'sendername'=>$sendername);		
						try{
							#$this->sendemail($emails,$subject,$admin_template_name,$admin_variables);
							$this->sendemail('web@xoroglobal.com',$subject,$admin_template_name,$admin_variables);
						}catch (Exception $e){
							
						}
						
					} 	
				} 
				} 
			}

			$this->Session->setFlash('Audit planning request has been updated successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('index');		
		}
		
		$InternalAuditPlan = $this->FormatInternalAuditPlan->find('first',array('conditions'=>array('FormatInternalAuditPlan.id'=>$id)));
		
		$this->set('InternalAuditPlan',$InternalAuditPlan);	
		
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		/* echo '<pre>';
		print_r($userArr);
		die(); */
	}
	
	function delete($id=null){
		
		$this->autoRender = false;
		$this->checkSatffSession(); 
		if($this->Purchase->delete($id)){
			$this->Session->setFlash('Request has been deleted successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('index');	
		}	
	}	
	
	function autologin($id=null){
		$this->autoRender = false;
		
		if(!empty($id)){
			$uid = base64_decode($id);
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$uid,'NappUser.is_staff_id'=>1)));
			if(!empty($userArr)){
				if($userArr['NappUser']['is_active'] == 0){
					$this->Session->setFlash('You account is not active','default',array('class' => 'alert alert-danger'));
					$this->redirect('/login');	
				}else{								
					$this->Session->write('Customer', $userArr['NappUser']);
					$this->Session->write('is_customer', 1);			
					$this->redirect('/audits');
				
				}
			}else{
				$this->redirect('/login');	
			}
		}else{
			$this->redirect('/login');	
		}	
	}	
	
	
	function index(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Format Internal Audit Plan List');		
		$this->checkSatffSession(); 
		 $userid = $this->Session->read('Customer.id');	

		$this->FormatInternalAuditPlan->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->FormatInternalAuditPlan->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditee',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->FormatInternalAuditPlan->recursive = 2;
		$this->paginate = array('conditions'=>array('OR'=>array('FormatInternalAuditPlan.auditee'=>$userid,'FormatInternalAuditPlan.auditor'=>$userid,'FormatInternalAuditPlan.user_id'=>$userid)),'order'=>array('FormatInternalAuditPlan.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$FormatInternalAuditPlanArr = $this->Paginator->paginate('FormatInternalAuditPlan');	
		$this->set('FormatInternalAuditPlanArr',$FormatInternalAuditPlanArr);
		$this->set('userid',$userid);
		
		// echo '<pre>';
		// print_r($FormatInternalAuditPlanArr);
		// die();
	}
	
	
	
	function admin_index(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Format Internal Audit Plan List');		
		$this->checkAdminSession(); 
		
		$this->FormatInternalAuditPlan->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->FormatInternalAuditPlan->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditee',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->FormatInternalAuditPlan->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('FormatInternalAuditPlan.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$FormatInternalAuditPlanArr = $this->Paginator->paginate('FormatInternalAuditPlan');	
		$this->set('FormatInternalAuditPlanArr',$FormatInternalAuditPlanArr);
		
		// echo '<pre>';
		// print_r($FormatInternalAuditPlanArr);
		// die();
	}
	function admin_circularinternalauditresult($id=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkAdminSession(); 
		
		if(!empty($this->request->data)){
			
			if(!empty($this->request->data)){
			
			if(!empty($this->request->data['date'])){
				$this->CircularInternalAuditResult->query('delete from circular_internal_audit_results where audit_id = '.$id.'');
				foreach($this->request->data['date'] as $key=>$datetime){					
					$insert['CircularInternalAuditResult']['id'] = '';
					$insert['CircularInternalAuditResult']['audit_id'] = $id;
					$insert['CircularInternalAuditResult']['department'] = $key;
					$insert['CircularInternalAuditResult']['date'] = $datetime['datetime'];
					$insert['CircularInternalAuditResult']['time'] = $datetime['time'];
					$insert['CircularInternalAuditResult']['auditor'] = $datetime['auditor'];
					$insert['CircularInternalAuditResult']['auditee'] = $datetime['auditee'];
					$insert['CircularInternalAuditResult']['created'] = date('Y-m-d H:i:s');
					$this->CircularInternalAuditResult->save($insert);
				}
			}	
			$update['CircularInternalAudit']['id'] = $id;
			$update['CircularInternalAudit']['opening_held_on'] = $this->request->data['CircularInternalAudit']['opening_held_on'];
			$update['CircularInternalAudit']['opening_place_at'] = $this->request->data['CircularInternalAudit']['opening_place_at'];
			$update['CircularInternalAudit']['closing_held_on'] = $this->request->data['CircularInternalAudit']['closing_held_on'];
			$update['CircularInternalAudit']['closing_place_at'] = $this->request->data['CircularInternalAudit']['closing_place_at'];
			$this->CircularInternalAudit->save($update);
		
		}
			
		}	
		
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.is_active'=>1),'fields'=>array('id','name','lname')));
		$this->set('userArr',$userArr);	
		
		$CircularInternalAuditResult = $this->CircularInternalAuditResult->find('all',array('conditions'=>array('CircularInternalAuditResult.audit_id'=>$id)));
		$this->set('CircularInternalAuditResult',$CircularInternalAuditResult);	
		
		
		$InternalAuditPlan = $this->CircularInternalAudit->find('first',array('conditions'=>array('CircularInternalAudit.id'=>$id)));
		// echo '<pre>';
		// print_r($CircularInternalAuditResult);
		// die();
		$this->set('InternalAuditPlan',$InternalAuditPlan);	
		
		
	}	
	
	function admin_circularinternalauditlist(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Circular Internal Audit List');		
		$this->checkAdminSession(); 
		
		$this->CircularInternalAudit->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		
		$this->CircularInternalAudit->bindModel(
		array('hasMany' => array('CircularInternalAuditList' => array(
			'className' => 'CircularInternalAuditList',			 
			'foreignKey' => 'cia_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); 
		$this->CircularInternalAuditList->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->CircularInternalAuditList->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'auditee',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array()
		))));
		
		$this->CircularInternalAudit->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('CircularInternalAudit.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$CircularInternalAuditArr = $this->Paginator->paginate('CircularInternalAudit');	
		$this->set('CircularInternalAuditArr',$CircularInternalAuditArr);
		
		// echo '<pre>';
		// print_r($CircularInternalAuditArr);
		// die();
	}
}
?>