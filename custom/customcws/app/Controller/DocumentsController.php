<?php 
App::uses('AppController','Controller');
class DocumentsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('BatchRegister','DocumentLibrary','NappUser','User','DocumentLibraryRecord','DocumentReceiveInspection','DocumentPreventiveMaintenance','DocumentPreventiveMaintenanceRecord','DocumentFieldExecutiveDuty','DocumentCalibrationReocrd','DocumentCalibration','DocumentNcClosureRecord','DocumentNcClosure');
	
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	public function adddoc() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Batch Register List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
		
			$this->request->data['DocumentLibrary']['user_id'] = $user_id;
			$this->request->data['DocumentLibrary']['status'] = 1;
			$this->request->data['DocumentLibrary']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentLibrary->save($this->request->data)){
				$this->Session->setFlash('Record saved successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');	
			}	
		}
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	

		$docArr = $this->DocumentLibrary->find('first',array('order'=>array('DocumentLibrary.id'=>'DESC'),'fields'=>array('DocumentLibrary.id')));
		$this->set('docArr', $docArr);
		// echo '<pre>';
		// print_r($docArr);
		// die();
		if(!empty($docArr['DocumentLibrary']['id'])){
			$docId = 'CWSRL-'. (1000+$docArr['DocumentLibrary']['id'] + 1);
		}else{
			$docId = 'CWSRL-1001';
		}	
		$this->set('docId', $docId);
	}
	
	public function editdoc($id) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Batch Register List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
		
			$this->request->data['DocumentLibrary']['user_id'] = $user_id;
			$this->request->data['DocumentLibrary']['status'] = 1;
			$this->request->data['DocumentLibrary']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentLibrary->save($this->request->data)){
				$this->Session->setFlash('Record saved successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');	
			}	
		}
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	

		$docArr = $this->DocumentLibrary->find('first',array('conditions'=>array('DocumentLibrary.id'=>$id)));
		$this->set('docArr', $docArr);
		$this->request->data = $docArr;
		/* echo '<pre>';
		print_r($docArr);
		die();		 */
		 
	}
	
	function addtask($id=null){
	
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Save Records');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$this->DocumentLibraryRecord->query('delete from document_library_records where doc_id = '.$id.'');	

			for($i=1; $i <= count($this->request->data);  $i++){
				if(!empty($this->request->data['nameofthebook'][$i])){
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['id'] = '';
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['doc_id'] = $id;
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['nameofthebook'] = $this->request->data['nameofthebook'][$i];
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['expecteddateofreturn'] = $this->request->data['expecteddateofreturn'][$i];
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['qty'] = $this->request->data['qty'][$i];
					$insertDocumentLibraryRecord['DocumentLibraryRecord']['remarks'] = $this->request->data['remarks'][$i];
					$this->DocumentLibraryRecord->save($insertDocumentLibraryRecord);
				}
			}
			$this->Session->setFlash('Record saved successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('index');	
			
		}			
		$docArr = $this->DocumentLibrary->find('first',array('conditions'=>array('DocumentLibrary.id'=>$id)));
		$this->set('docArr', $docArr);
		
		$doclibrecArr = $this->DocumentLibraryRecord->find('all',array('conditions'=>array('DocumentLibraryRecord.doc_id'=>$id)));
		$this->set('doclibrecArr', $doclibrecArr);
	}		
	function index()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Batch Register List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_indentor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_coordinator',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_3' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_hod',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_4' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_library',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->DocumentLibrary->bindModel(
		array('hasMany' => array('DocumentLibraryRecord' => array(
			'className' => 'DocumentLibraryRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));		
		$this->paginate = array('conditions'=>array('DocumentLibrary.user_id'=>$user_id),'page' => 1, 'limit' => 10);		
		$this->DocumentLibrary->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentLibrary');	
		
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}
	
	function admin_nc_closure()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' NC and NC Closure');
		$this->checkAdminSession();
		
		$this->DocumentNcClosure->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->DocumentNcClosure->bindModel(
		array('hasMany' => array('DocumentNcClosureRecord' => array(
			'className' => 'DocumentNcClosureRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));		
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>array('DocumentNcClosure.id'=>'DESC'));		
		$this->DocumentNcClosure->recursive = 2;
		$DocumentNcClosureArr = $this->Paginator->paginate('DocumentNcClosure');	
		
		$this->set('DocumentLibraryArr',$DocumentNcClosureArr);	
	}

	function admin_index()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Batch Register List');
		$this->checkAdminSession();
		
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_indentor',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_coordinator',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_3' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_hod',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$this->DocumentLibrary->bindModel(
		array('belongsTo' => array('NappUser_4' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'sign_of_library',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->DocumentLibrary->bindModel(
		array('hasMany' => array('DocumentLibraryRecord' => array(
			'className' => 'DocumentLibraryRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));		
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->DocumentLibrary->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentLibrary');	
		
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}

	########################################################## Receiveing & Inspection ####################################################
	
		
	function edit_receiving_insepction($id=null)
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Receiving and Insepction');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$insert['DocumentReceiveInspection']['id'] = $id;
			$insert['DocumentReceiveInspection']['ph_property'] = $this->request->data['ph']['propery'][0];
			$insert['DocumentReceiveInspection']['ph_certificate_result'] = $this->request->data['ph']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['ph_actual_result'] = $this->request->data['ph']['actual_result'][0];

			
			$insert['DocumentReceiveInspection']['solid_property'] = $this->request->data['solids']['propery'][0];
			$insert['DocumentReceiveInspection']['solid_certificate_result'] = $this->request->data['solids']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['solid_actual_result'] = $this->request->data['solids']['actual_result'][0];

			
			$insert['DocumentReceiveInspection']['gravity_property'] = $this->request->data['gravity']['propery'][0];
			$insert['DocumentReceiveInspection']['gravity_certificate_result'] = $this->request->data['gravity']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['gravity_actual_result'] = $this->request->data['gravity']['actual_result'][0];

			$insert['DocumentReceiveInspection']['viscosity_property'] = $this->request->data['viscosity']['propery'][0];
			$insert['DocumentReceiveInspection']['viscosity_certificate_result'] = $this->request->data['viscosity']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['viscosity_actual_result'] = $this->request->data['viscosity']['actual_result'][0];

			$insert['DocumentReceiveInspection']['user_id'] = $user_id;
			$insert['DocumentReceiveInspection']['documentid'] = $this->request->data['DocumentReceiveInspection']['documentid'];
			$insert['DocumentReceiveInspection']['signature'] = $this->request->data['DocumentReceiveInspection']['signature'];
			$insert['DocumentReceiveInspection']['product_name'] = $this->request->data['DocumentReceiveInspection']['product_name'];
			//$insert['DocumentReceiveInspection']['date'] = date('Y-m-d');
			$insert['DocumentReceiveInspection']['status'] = $this->request->data['DocumentReceiveInspection']['status'];
			$insert['DocumentReceiveInspection']['finaldate'] = $this->request->data['DocumentReceiveInspection']['finaldate'];
			$insert['DocumentReceiveInspection']['pass_fail'] = $this->request->data['DocumentReceiveInspection']['pass_fail'];
			$insert['DocumentReceiveInspection']['concessional_pass'] = $this->request->data['DocumentReceiveInspection']['concessional_pass'];
			
			$insert['DocumentReceiveInspection']['created'] = date('Y-m-d H:i:s');
			
			// echo '<pre>';
			// print_r($this->request->data);
			// print_r($insert);
			// die();
			
			if($this->DocumentReceiveInspection->save($insert)){
				$this->Session->setFlash('Receiving and insepction updated successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('receiving_insepction');
			}
		}

		$docArr = $this->DocumentReceiveInspection->find('first',array('conditions'=>array('DocumentReceiveInspection.id'=>$id)));
		$this->set('docArr', $docArr);
		$this->request->data = $docArr;
		/* echo '<pre>';
		print_r($docArr);
		die(); */
		
	}
	
	function add_receiving_insepction()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Receiving and Insepction List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$insert['DocumentReceiveInspection']['ph_property'] = $this->request->data['ph']['propery'][0];
			$insert['DocumentReceiveInspection']['ph_certificate_result'] = $this->request->data['ph']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['ph_actual_result'] = $this->request->data['ph']['actual_result'][0];

			
			$insert['DocumentReceiveInspection']['solid_property'] = $this->request->data['solids']['propery'][0];
			$insert['DocumentReceiveInspection']['solid_certificate_result'] = $this->request->data['solids']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['solid_actual_result'] = $this->request->data['solids']['actual_result'][0];

			
			$insert['DocumentReceiveInspection']['gravity_property'] = $this->request->data['gravity']['propery'][0];
			$insert['DocumentReceiveInspection']['gravity_certificate_result'] = $this->request->data['gravity']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['gravity_actual_result'] = $this->request->data['gravity']['actual_result'][0];

			$insert['DocumentReceiveInspection']['viscosity_property'] = $this->request->data['viscosity']['propery'][0];
			$insert['DocumentReceiveInspection']['viscosity_certificate_result'] = $this->request->data['viscosity']['certificate_result'][0];
			$insert['DocumentReceiveInspection']['viscosity_actual_result'] = $this->request->data['viscosity']['actual_result'][0];

			$insert['DocumentReceiveInspection']['user_id'] = $user_id;
			$insert['DocumentReceiveInspection']['documentid'] = $this->request->data['DocumentReceiveInspection']['documentid'];
			$insert['DocumentReceiveInspection']['signature'] = $this->request->data['DocumentReceiveInspection']['signature'];
			$insert['DocumentReceiveInspection']['date'] = date('Y-m-d');
			$insert['DocumentReceiveInspection']['finaldate'] = $this->request->data['DocumentReceiveInspection']['finaldate'];
			$insert['DocumentReceiveInspection']['pass_fail'] = $this->request->data['DocumentReceiveInspection']['pass_fail'];
			$insert['DocumentReceiveInspection']['concessional_pass'] = $this->request->data['DocumentReceiveInspection']['concessional_pass'];
			$insert['DocumentReceiveInspection']['status'] = 1;
			$insert['DocumentReceiveInspection']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentReceiveInspection->save($insert)){
				$this->Session->setFlash('Receiving and insepction added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('receiving_insepction');	
			}
		}

		$docArr = $this->DocumentReceiveInspection->find('first',array('order'=>array('DocumentReceiveInspection.id'=>'DESC'),'fields'=>array('DocumentReceiveInspection.id')));
		$this->set('docArr', $docArr);
		// echo '<pre>';
		// print_r($docArr);
		// die();
		if(!empty($docArr['DocumentReceiveInspection']['id'])){
			$docId = 'CWSIR-'. (1000 + $docArr['DocumentReceiveInspection']['id'] + 1);
		}else{
			$docId = 'CWSIR-1001';
		}	
		
		$this->set('docId', $docId);
	}	
	
	function receiving_insepction()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Receiving and Insepction List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->DocumentReceiveInspection->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		/*
		$this->DocumentLibrary->bindModel(
		array('hasMany' => array('DocumentLibraryRecord' => array(
			'className' => 'DocumentLibraryRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); */
		$this->paginate = array('conditions'=>array('DocumentReceiveInspection.user_id'=>$user_id),'page' => 1, 'limit' => 10);		
		$this->DocumentReceiveInspection->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentReceiveInspection');	
		
	/* 	echo '<pre>';
		print_r($DocumentLibraryArr);
		die();	 */
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}
	function admin_receiving_insepction()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Receiving and Insepction List');
		$this->checkAdminSession();
		
		
		$this->DocumentReceiveInspection->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		/*
		$this->DocumentLibrary->bindModel(
		array('hasMany' => array('DocumentLibraryRecord' => array(
			'className' => 'DocumentLibraryRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); */
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->DocumentReceiveInspection->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentReceiveInspection');	
		
	/* 	echo '<pre>';
		print_r($DocumentLibraryArr);
		die();	 */
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}	
	########################################################## Receiveing & Inspection ####################################################
	
	function admin_preventive_maintenance()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Preventive Maintenance List');
		$this->checkAdminSession();
		
		$this->DocumentPreventiveMaintenance->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->DocumentPreventiveMaintenance->bindModel(
		array('hasMany' => array('DocumentPreventiveMaintenanceRecord' => array(
			'className' => 'DocumentPreventiveMaintenanceRecord',			 
			'foreignKey' => 'doc_preventive_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); 
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->DocumentPreventiveMaintenance->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentPreventiveMaintenance');	
		
		/* echo '<pre>';
		print_r($DocumentLibraryArr);
		die();	  */
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}
	
	function admin_executive_duty_requisition()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' executive duty requisition');
		$this->checkAdminSession();
		
		$this->DocumentFieldExecutiveDuty->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
				
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->DocumentFieldExecutiveDuty->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentFieldExecutiveDuty');	
		
		// echo '<pre>';
		// print_r($DocumentLibraryArr);
		// die();	  
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}	
	
	function admin_calibration_equipment()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Calibration status of Instrument / Equipment');
		$this->checkAdminSession();
		
		$this->DocumentCalibration->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		
		$this->DocumentCalibration->bindModel(
		array('hasMany' => array('DocumentCalibrationReocrd' => array(
			'className' => 'DocumentCalibrationReocrd',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));  
		
		
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->DocumentCalibration->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentCalibration');	
		
		// echo '<pre>';
		// print_r($DocumentLibraryArr);
		// die();	  
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}
	
	function preventive_maintenance()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Preventive Maintenance List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->DocumentPreventiveMaintenance->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->DocumentPreventiveMaintenance->bindModel(
		array('hasMany' => array('DocumentPreventiveMaintenanceRecord' => array(
			'className' => 'DocumentPreventiveMaintenanceRecord',			 
			'foreignKey' => 'doc_preventive_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		)))); 
		$this->paginate = array('conditions'=>array('DocumentPreventiveMaintenance.user_id'=>$user_id),'page' => 1, 'limit' => 10);		
		$this->DocumentPreventiveMaintenance->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentPreventiveMaintenance');	
		
		/* echo '<pre>';
		print_r($DocumentLibraryArr);
		die();	  */
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}	
	
	function add_preventive_maintenance()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Document Preventive Maintenance List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['DocumentPreventiveMaintenance']['user_id'] = $user_id;
			$this->request->data['DocumentPreventiveMaintenance']['status'] = 1;
			$this->request->data['DocumentPreventiveMaintenance']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentPreventiveMaintenance->save($this->request->data)){				
				$lastid = $this->DocumentPreventiveMaintenance->id;				
				if(!empty($this->request->data['jobtobedone'])){
					$i=1;
					foreach($this->request->data['jobtobedone'] as $jobtobedone){
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['id'] = '';
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['doc_preventive_id'] = $lastid;
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['job_to_be_done'] = $jobtobedone;
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['frequency'] = $this->request->data['frequency'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['date'] = $this->request->data['date'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['major_job_details'] = $this->request->data['major_job_detail'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['sign'] = $this->request->data['sign'][$i];
						$this->DocumentPreventiveMaintenanceRecord->save($DocumentPreventiveMaintenanceRecord);
						
						$i++;
					}	
				}	
				
				$this->Session->setFlash('Receiving and insepction added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('preventive_maintenance');	
			}
		}

		$docArr = $this->DocumentPreventiveMaintenance->find('first',array('order'=>array('DocumentPreventiveMaintenance.id'=>'DESC'),'fields'=>array('DocumentPreventiveMaintenance.id')));
		$this->set('docArr', $docArr);
		// echo '<pre>';
		// print_r($docArr);
		// die();
		if(!empty($docArr['DocumentPreventiveMaintenance']['id'])){
			$docId = 'CWSPM-'. (1000 + $docArr['DocumentPreventiveMaintenance']['id'] + 1);
		}else{
			$docId = 'CWSPM-1001';
		}	
		
		$this->set('docId', $docId);
	}	
	
	function edit_preventive_maintenance($id=null)
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Document Preventive Maintenance List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['DocumentPreventiveMaintenance']['id'] = $id;
			$this->request->data['DocumentPreventiveMaintenance']['user_id'] = $user_id;
			$this->request->data['DocumentPreventiveMaintenance']['status'] = 1;
			$this->request->data['DocumentPreventiveMaintenance']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentPreventiveMaintenance->save($this->request->data)){				
				$this->DocumentPreventiveMaintenance->query("delete from document_preventive_maintenance_records where doc_preventive_id = ".$id."");				
				if(!empty($this->request->data['jobtobedone'])){
					$i=1;
					foreach($this->request->data['jobtobedone'] as $jobtobedone){
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['id'] = '';
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['doc_preventive_id'] = $id;
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['job_to_be_done'] = $jobtobedone;
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['frequency'] = $this->request->data['frequency'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['date'] = $this->request->data['date'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['major_job_details'] = $this->request->data['major_job_detail'][$i];
						$DocumentPreventiveMaintenanceRecord['DocumentPreventiveMaintenanceRecord']['sign'] = $this->request->data['sign'][$i];
						$this->DocumentPreventiveMaintenanceRecord->save($DocumentPreventiveMaintenanceRecord);
						
						$i++;
					}	
				}	
				
				$this->Session->setFlash('Receiving and insepction updated successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('preventive_maintenance');	
			}
		}
		
		
		$this->DocumentPreventiveMaintenance->bindModel(
		array('hasMany' => array('DocumentPreventiveMaintenanceRecord' => array(
			'className' => 'DocumentPreventiveMaintenanceRecord',			 
			'foreignKey' => 'doc_preventive_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));

		$docArr = $this->DocumentPreventiveMaintenance->find('first',array('conditions'=>array('DocumentPreventiveMaintenance.id'=>$id)));
		$this->set('docArr', $docArr);
		$this->request->data = $docArr;
		/*  echo '<pre>';
		print_r($docArr);
		die();  */
		
	}	
	
	
	function executive_duty_requisition()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' executive duty requisition');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->DocumentFieldExecutiveDuty->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
				
		$this->paginate = array('conditions'=>array('DocumentFieldExecutiveDuty.user_id'=>$user_id),'page' => 1, 'limit' => 10);		
		$this->DocumentFieldExecutiveDuty->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentFieldExecutiveDuty');	
		
		// echo '<pre>';
		// print_r($DocumentLibraryArr);
		// die();	  
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}	
	
	function add_executive_duty(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' executive duty requisition');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){
			$this->request->data['DocumentFieldExecutiveDuty']['user_id'] = $user_id;
			$this->request->data['DocumentFieldExecutiveDuty']['status'] = 1;
			$this->request->data['DocumentFieldExecutiveDuty']['created'] = date('Y-m-d H:i:s');
			$this->DocumentFieldExecutiveDuty->save($this->request->data);	
				
			$this->Session->setFlash('executive duty requisition added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('executive_duty_requisition');			
		}	
		
		$docArr = $this->DocumentFieldExecutiveDuty->find('first',array('order'=>array('DocumentFieldExecutiveDuty.id'=>'DESC'),'fields'=>array('DocumentFieldExecutiveDuty.id')));
		$this->set('docArr', $docArr);
		// echo '<pre>';
		// print_r($docArr);
		// die();
		if(!empty($docArr['DocumentFieldExecutiveDuty']['id'])){
			$docId = 'CWSFER-'. (1000 + $docArr['DocumentFieldExecutiveDuty']['id'] + 1);
		}else{
			$docId = 'CWSFER-1001';
		}	
		
		$this->set('docId', $docId);
		
	}	
	function edit_executive_duty($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' executive duty requisition');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){
			$this->request->data['DocumentFieldExecutiveDuty']['id'] = $id;			
			$this->DocumentFieldExecutiveDuty->save($this->request->data);	
				
			$this->Session->setFlash('executive duty requisition added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('executive_duty_requisition');			
		}	
		
		$docArr = $this->DocumentFieldExecutiveDuty->find('first',array('conditions'=>array('DocumentFieldExecutiveDuty.id'=>$id)));
		$this->set('docArr', $docArr);
		$this->request->data = $docArr;
		
	}	
	
	function calibration_equipment()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Calibration status of Instrument / Equipment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->DocumentCalibration->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		
		$this->DocumentCalibration->bindModel(
		array('hasMany' => array('DocumentCalibrationReocrd' => array(
			'className' => 'DocumentCalibrationReocrd',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));  
		
		
		$this->paginate = array('conditions'=>array('DocumentCalibration.user_id'=>$user_id),'page' => 1, 'limit' => 10);		
		$this->DocumentCalibration->recursive = 2;
		$DocumentLibraryArr = $this->Paginator->paginate('DocumentCalibration');	
		
		// echo '<pre>';
		// print_r($DocumentLibraryArr);
		// die();	  
		 
		$this->set('DocumentLibraryArr',$DocumentLibraryArr);	
	}	
	
	function add_calibration_equipment(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Calibration status of Instrument / Equipment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){
			
			$params['DocumentCalibration']['status'] = 1;
			$params['DocumentCalibration']['created'] = date('Y-m-d H:i:s');
			$params['DocumentCalibration']['user_id'] = $user_id;
			$params['DocumentCalibration']['documentid'] = $this->request->data['DocumentCalibration']['documentid'];
			$params['DocumentCalibration']['date'] = $this->request->data['DocumentCalibration']['date'];
			if($this->DocumentCalibration->save($params)){
				$DocumentCalibration_id = $this->DocumentCalibration->id;
				$i=1;
				foreach($this->request->data['tool_equipment_description'] as $tool_equipment_description){
					if(!empty($tool_equipment_description)){
						$insert['DocumentCalibrationReocrd']['id'] = '';
						$insert['DocumentCalibrationReocrd']['doc_id'] = $DocumentCalibration_id;
						$insert['DocumentCalibrationReocrd']['tool_equipment_description'] = $tool_equipment_description;
						$insert['DocumentCalibrationReocrd']['location'] = $this->request->data['location'][$i];
						$insert['DocumentCalibrationReocrd']['test_period'] =  $this->request->data['test_period'][$i];
						$insert['DocumentCalibrationReocrd']['person_responsible'] =  $this->request->data['person_responsible'][$i];
						$insert['DocumentCalibrationReocrd']['date_added'] =  $this->request->data['date_added'][$i];
						$insert['DocumentCalibrationReocrd']['standard_identification'] =  $this->request->data['standard_identification'][$i];
						$this->DocumentCalibrationReocrd->save($insert);
					}
					$i++;
				}
				$this->Session->setFlash('Calibration status of Instrument / Equipment Added Successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('calibration_equipment');
			}	
			
		}
		$docArr = $this->DocumentCalibration->find('first',array('order'=>array('DocumentCalibration.id'=>'DESC'),'fields'=>array('DocumentCalibration.id')));
		$this->set('docArr', $docArr);
		if(!empty($docArr['DocumentCalibration']['id'])){
			$docId = 'CWSCSI-'. (1000 + $docArr['DocumentCalibration']['id'] + 1);
		}else{
			$docId = 'CWSCSI-1001';
		}	
		
		$this->set('docId', $docId);
		
	}		
	
	function edit_calibration_equipment($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Calibration status of Instrument / Equipment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){
			
			$params['DocumentCalibration']['id'] = $id;
			$params['DocumentCalibration']['documentid'] = $this->request->data['DocumentCalibration']['documentid'];
			$params['DocumentCalibration']['date'] = $this->request->data['DocumentCalibration']['date'];
			if($this->DocumentCalibration->save($params)){
				$this->DocumentCalibrationReocrd->query("delete from document_calibration_reocrds where doc_id = ".$id."");
				$i=1;
				foreach($this->request->data['tool_equipment_description'] as $tool_equipment_description){
					if(!empty($tool_equipment_description)){
						$insert['DocumentCalibrationReocrd']['id'] = '';
						$insert['DocumentCalibrationReocrd']['doc_id'] =$id;
						$insert['DocumentCalibrationReocrd']['tool_equipment_description'] = $tool_equipment_description;
						$insert['DocumentCalibrationReocrd']['location'] = $this->request->data['location'][$i];
						$insert['DocumentCalibrationReocrd']['test_period'] =  $this->request->data['test_period'][$i];
						$insert['DocumentCalibrationReocrd']['person_responsible'] =  $this->request->data['person_responsible'][$i];
						$insert['DocumentCalibrationReocrd']['date_added'] =  $this->request->data['date_added'][$i];
						$insert['DocumentCalibrationReocrd']['standard_identification'] =  $this->request->data['standard_identification'][$i];
						$this->DocumentCalibrationReocrd->save($insert);
					}
					$i++;
				}
				$this->Session->setFlash('Calibration status of Instrument / Equipment updated Successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('calibration_equipment');
			}	
			
		}
		
		$this->DocumentCalibration->bindModel(
		array('hasMany' => array('DocumentCalibrationReocrd' => array(
			'className' => 'DocumentCalibrationReocrd',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->DocumentCalibration->recursive = 2;
		$docArr = $this->DocumentCalibration->find('first',array('conditions'=>array('DocumentCalibration.id'=>$id)));
		$this->set('docArr', $docArr);
		
		
		
		$this->request->data = $docArr;
		
	}
	
	function nc_closure()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' NC and NC Closure');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->DocumentNcClosure->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->DocumentNcClosure->bindModel(
		array('hasMany' => array('DocumentNcClosureRecord' => array(
			'className' => 'DocumentNcClosureRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));		
		$this->paginate = array('conditions'=>array('DocumentNcClosure.user_id'=>$user_id),'page' => 1, 'limit' => 10,'order'=>array('DocumentNcClosure.id'=>'DESC'));		
		$this->DocumentNcClosure->recursive = 2;
		$DocumentNcClosureArr = $this->Paginator->paginate('DocumentNcClosure');	
		
		// echo '<pre>';
		// print_r($DocumentNcClosureArr);
		// die();
		 
		$this->set('DocumentLibraryArr',$DocumentNcClosureArr);	
	}
	
	public function add_ncclosure() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add NC and NC Closure');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$insert['DocumentNcClosure']['documentid'] = $this->request->data['DocumentNcClosure']['documentid'];
			$insert['DocumentNcClosure']['date'] = $this->request->data['DocumentNcClosure']['date'];
			$insert['DocumentNcClosure']['user_id'] = $user_id;
			$insert['DocumentNcClosure']['created'] = date('Y-m-d H:i:s');
			if($this->DocumentNcClosure->save($insert)){
				$doc_id = $this->DocumentNcClosure->id;
				
				$insertrecord['DocumentNcClosureRecord']['id'] =  '';
				$insertrecord['DocumentNcClosureRecord']['doc_id'] =  $doc_id;
				$insertrecord['DocumentNcClosureRecord']['nc'] =  $this->request->data['DocumentNcClosureRecord']['nc'];
				$insertrecord['DocumentNcClosureRecord']['source_nc'] =  $this->request->data['DocumentNcClosureRecord']['source_nc'];
				$insertrecord['DocumentNcClosureRecord']['responsiblity'] =  $this->request->data['DocumentNcClosureRecord']['responsiblity'];
				$insertrecord['DocumentNcClosureRecord']['root_cause'] =  $this->request->data['DocumentNcClosureRecord']['root_cause'];
				$insertrecord['DocumentNcClosureRecord']['action'] =  $this->request->data['DocumentNcClosureRecord']['action'];
				$insertrecord['DocumentNcClosureRecord']['resource'] =  $this->request->data['DocumentNcClosureRecord']['resource'];
				$insertrecord['DocumentNcClosureRecord']['time'] =  $this->request->data['DocumentNcClosureRecord']['time'];
				$insertrecord['DocumentNcClosureRecord']['closure'] =  $this->request->data['DocumentNcClosureRecord']['closure'];
				$this->DocumentNcClosureRecord->save($insertrecord);
				
				$this->Session->setFlash('Added Successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('nc_closure');				
			}		
		}		
		$docArr = $this->DocumentNcClosure->find('first',array('order'=>array('DocumentNcClosure.id'=>'DESC'),'fields'=>array('DocumentNcClosure.id')));
		$this->set('docArr', $docArr);
		if(!empty($docArr['DocumentNcClosure']['id'])){
			$docId = 'CWSDNC-'. (1000 + $docArr['DocumentNcClosure']['id'] + 1);
		}else{
			$docId = 'CWSDNC-1001';
		}		
		$this->set('docId', $docId);
	}
	
	public function edit_ncclosure($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add NC and NC Closure');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){
			$this->DocumentNcClosureRecord->query("delete from document_nc_closure_records where doc_id = ".$id."");
			$i=0;
			foreach($this->request->data['DocumentNcClosureRecord']['nc'] as $nc){			
				$insertrecord['DocumentNcClosureRecord']['id'] =  '';
				$insertrecord['DocumentNcClosureRecord']['doc_id'] =  $id;
				$insertrecord['DocumentNcClosureRecord']['nc'] =  $nc;
				$insertrecord['DocumentNcClosureRecord']['source_nc'] =  $this->request->data['DocumentNcClosureRecord']['source_nc'][$i];
				$insertrecord['DocumentNcClosureRecord']['responsiblity'] =  $this->request->data['DocumentNcClosureRecord']['responsiblity'][$i];
				$insertrecord['DocumentNcClosureRecord']['root_cause'] =  $this->request->data['DocumentNcClosureRecord']['root_cause'][$i];
				$insertrecord['DocumentNcClosureRecord']['action'] =  $this->request->data['DocumentNcClosureRecord']['action'][$i];
				$insertrecord['DocumentNcClosureRecord']['resource'] =  $this->request->data['DocumentNcClosureRecord']['resource'][$i];
				$insertrecord['DocumentNcClosureRecord']['time'] =  $this->request->data['DocumentNcClosureRecord']['time'][$i];
				$insertrecord['DocumentNcClosureRecord']['closure'] =  $this->request->data['DocumentNcClosureRecord']['closure'][$i];
				$this->DocumentNcClosureRecord->save($insertrecord);
				$i++;
			}
			$this->Session->setFlash('Records Updated  Successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('nc_closure');	
		}	
		
		$this->DocumentNcClosure->bindModel(
		array('hasMany' => array('DocumentNcClosureRecord' => array(
			'className' => 'DocumentNcClosureRecord',			 
			'foreignKey' => 'doc_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
			
		$DocumentNcClosureArr = $this->DocumentNcClosure->find('first',array('conditions'=>array('DocumentNcClosure.id'=>$id)));	
		$this->set('DocumentNcClosureArr', $DocumentNcClosureArr);
		$this->request->data = $DocumentNcClosureArr;
	}		
	
}
?>