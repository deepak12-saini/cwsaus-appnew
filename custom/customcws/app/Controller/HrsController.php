<?php 
App::uses('AppController','Controller');
class HrsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('HrFormatTrainingCalendarRecord','HrFormatTrainingCalendar','HrTrainingNeedAssessment','HrTrainingNeedAssessmentRecord','NappUser','User','HrTrainingAttendanceRecord','HrTrainingAttendance','HrPerformanceFeedback','HrNewJoiningDetail','HrReportOrganization','HrDuringLeave','HrDuringLeaveRecord','HrFormatEvaluationEmployeRecord','HrFormatEvaluationEmployee','HrAppraisalFormRecord','HrAppraisalForm');
	
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function admin_hr_appraisal_form()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr Appraisal Form');
		$this->checkSatffSession();
		
		$this->HrAppraisalForm->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrAppraisalForm->bindModel(
		array('hasMany' => array('HrAppraisalFormRecord' => array(
			'className' => 'HrAppraisalFormRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrAppraisalForm->recursive = 2;
		$this->paginate = array('order'=>array('HrAppraisalForm.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrAppraisalForm');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		 
		
	}
	
	function admin_format_evaluation_employe()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr format training calendars');
		$this->checkAdminSession();
		
		$this->HrFormatEvaluationEmployee->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrFormatEvaluationEmployee->bindModel(
		array('hasMany' => array('HrFormatEvaluationEmployeRecord' => array(
			'className' => 'HrFormatEvaluationEmployeRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatEvaluationEmployee->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('HrFormatEvaluationEmployee.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrFormatEvaluationEmployee');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		/* echo '<pre>';
		print_r($HrDuringLeaveArr);
		die();    */
		
	}
	
	function admin_format_training_calendars()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr format training calendars');
		$this->checkAdminSession();
		
		$this->HrFormatTrainingCalendar->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrFormatTrainingCalendar->bindModel(
		array('hasMany' => array('HrFormatTrainingCalendarRecord' => array(
			'className' => 'HrFormatTrainingCalendarRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatTrainingCalendar->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('HrFormatTrainingCalendar.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrFormatTrainingCalendar');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		/* echo '<pre>';
		print_r($HrDuringLeaveArr);
		die();   */
		
	}
	
	function admin_res_during_leave()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Handling/Taking Over Duties & Responsibilties During Leave');
		$this->checkAdminSession();
	
		$this->HrDuringLeave->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrDuringLeave->bindModel(
		array('hasMany' => array('HrDuringLeaveRecord' => array(
			'className' => 'HrDuringLeaveRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrDuringLeave->recursive = 2;
		$this->paginate = array('order'=>array('HrDuringLeave.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrDuringLeave');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		// echo '<pre>';
		// print_r($HrDuringLeaveArr);
		// die();  
		
	}
	function admin_reportorganization()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Joining Report to organization');
		$this->checkAdminSession();
		
		$this->HrReportOrganization->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('order'=>array('HrReportOrganization.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrReportOrganizationArr = $this->Paginator->paginate('HrReportOrganization');	
		$this->set('HrReportOrganizationArr',$HrReportOrganizationArr);	
		
		// echo '<pre>';
		// print_r($HrReportOrganizationArr);
		// die();
		
	}
	function admin_newjoining()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' New Joining List');
		$this->checkAdminSession();
		
		$this->HrNewJoiningDetail->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('conditions'=>array(),'order'=>array('HrNewJoiningDetail.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrNewJoiningDetailArr = $this->Paginator->paginate('HrNewJoiningDetail');	
		$this->set('HrNewJoiningDetailArr',$HrNewJoiningDetailArr);	
		
		/* echo '<pre>';
		print_r($HrNewJoiningDetailArr);
		die();	 */
		
	}
	
	function admin_performancefeedback()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr Performance Feedback');
		$this->checkAdminSession();
		
		$this->HrPerformanceFeedback->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('conditions'=>array(),'order'=>array('HrPerformanceFeedback.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrPerformanceFeedbackArr = $this->Paginator->paginate('HrPerformanceFeedback');	
		$this->set('HrPerformanceFeedbackArr',$HrPerformanceFeedbackArr);	
		
		// echo '<pre>';
		// print_r($HrPerformanceFeedbackArr);
		// die();	
		
	}	
	
	function admin_attendence()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Attendance');
		$this->checkAdminSession();
		
		$this->HrTrainingAttendance->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrTrainingAttendance->bindModel(
		array('hasMany' => array('HrTrainingAttendanceRecord' => array(
			'className' => 'HrTrainingAttendanceRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrTrainingAttendance->recursive = 2;
		$this->paginate = array('conditions'=>array('HrTrainingAttendance.user_id'=>$user_id),'order'=>array('HrTrainingAttendance.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrTrainingAttendanceArr = $this->Paginator->paginate('HrTrainingAttendance');	
		$this->set('HrTrainingAttendanceArr',$HrTrainingAttendanceArr);	
		
		// echo '<pre>';
		// print_r($HrTrainingAttendanceArr);
		// die(); 
		
	}
	
	
	function admin_index()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Need Assessment');
		$this->checkAdminSession();
	
		$this->HrTrainingNeedAssessment->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrTrainingNeedAssessment->bindModel(
		array('hasMany' => array('HrTrainingNeedAssessmentRecord' => array(
			'className' => 'HrTrainingNeedAssessmentRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrTrainingNeedAssessment->recursive = 2;
		$this->paginate = array('conditions'=>array(),'order'=>array('HrTrainingNeedAssessment.id'=>'DESC'),'page' => 1, 'limit' => 10);		
		$this->HrTrainingNeedAssessment->recursive = 2;
		$HrTrainingNeedAssessmentArr = $this->Paginator->paginate('HrTrainingNeedAssessment');	
		$this->set('HrTrainingNeedAssessmentArr',$HrTrainingNeedAssessmentArr);	
		
		// echo '<pre>';
		// print_r($HrTrainingNeedAssessmentArr);
		// die();
		
	}
	
	function index()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Need Assessment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->HrTrainingNeedAssessment->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrTrainingNeedAssessment->bindModel(
		array('hasMany' => array('HrTrainingNeedAssessmentRecord' => array(
			'className' => 'HrTrainingNeedAssessmentRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrTrainingNeedAssessment->recursive = 2;
		$this->paginate = array('conditions'=>array('HrTrainingNeedAssessment.user_id'=>$user_id),'order'=>array('HrTrainingNeedAssessment.id'=>'DESC'),'page' => 1, 'limit' => 10);		
		$this->HrTrainingNeedAssessment->recursive = 2;
		$HrTrainingNeedAssessmentArr = $this->Paginator->paginate('HrTrainingNeedAssessment');	
		$this->set('HrTrainingNeedAssessmentArr',$HrTrainingNeedAssessmentArr);	
		
		// echo '<pre>';
		// print_r($HrTrainingNeedAssessmentArr);
		// die();
		
	}
	
	public function add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Hr Training Need Assessment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){	
			
			$this->request->data['HrTrainingNeedAssessment']['user_id'] = $user_id;
			$this->request->data['HrTrainingNeedAssessment']['created'] = date('Y-m-d H:i:s');
			if($this->HrTrainingNeedAssessment->save($this->request->data)){
				$hr_id = $this->HrTrainingNeedAssessment->id;	
				
				$i=0;
				foreach($this->request->data['performance_rating'] as $reocrd){
					$insert['HrTrainingNeedAssessmentRecord']['id'] = '';
					$insert['HrTrainingNeedAssessmentRecord']['hr_id'] = $hr_id;
					$insert['HrTrainingNeedAssessmentRecord']['performance_rating'] = $this->request->data['performance_rating'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_1'] = $this->request->data['record_1'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_2'] = $this->request->data['record_2'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_3'] = $this->request->data['record_3'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_4'] = $this->request->data['record_4'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_5'] = $this->request->data['record_5'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['remark'] = $this->request->data['remark'][$i];
					$this->HrTrainingNeedAssessmentRecord->save($insert);
					
					$i++;
				}
			}	
			$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('index');		
		}	
		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	

		$docArr = $this->HrTrainingNeedAssessment->find('first',array('order'=>array('HrTrainingNeedAssessment.id'=>'DESC'),'fields'=>array('HrTrainingNeedAssessment.id')));
		if(!empty($docArr['HrTrainingNeedAssessment']['id'])){
			$docId = 'CWSHR-TNA-'. (1000+$docArr['HrTrainingNeedAssessment']['id'] + 1);
		}else{
			$docId = 'CWSHR-TNA-1001';
		}	
		$this->set('docId', $docId);

	}
	
	public function edit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Hr Training Need Assessment');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		if(!empty($this->request->data)){	
			
			$this->request->data['HrTrainingNeedAssessment']['id'] = $id;
			$this->request->data['HrTrainingNeedAssessment']['user_id'] = $user_id;
			$this->request->data['HrTrainingNeedAssessment']['created'] = date('Y-m-d H:i:s');
			if($this->HrTrainingNeedAssessment->save($this->request->data)){
				$hr_id = $this->HrTrainingNeedAssessment->id;	
				
				$i=0;
				foreach($this->request->data['performance_rating'] as $reocrd){
					$insert['HrTrainingNeedAssessmentRecord']['id'] = '';
					$insert['HrTrainingNeedAssessmentRecord']['hr_id'] = $hr_id;
					$insert['HrTrainingNeedAssessmentRecord']['performance_rating'] = $this->request->data['performance_rating'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_1'] = $this->request->data['record_1'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_2'] = $this->request->data['record_2'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_3'] = $this->request->data['record_3'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_4'] = $this->request->data['record_4'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['record_5'] = $this->request->data['record_5'][$i];
					$insert['HrTrainingNeedAssessmentRecord']['remark'] = $this->request->data['remark'][$i];
					$this->HrTrainingNeedAssessmentRecord->save($insert);
					
					$i++;
				}
			}	
			$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('index');		
		}	
		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	

		$this->HrTrainingNeedAssessment->bindModel(
		array('hasMany' => array('HrTrainingNeedAssessmentRecord' => array(
			'className' => 'HrTrainingNeedAssessmentRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$docArr = $this->HrTrainingNeedAssessment->find('first',array('conditions'=>array('HrTrainingNeedAssessment.id'=>$id)));
		$this->set('docArr', $docArr);
		$this->request->data = $docArr;
		/* echo '<pre>';
		print_r($docArr);
		die(); */

	}
	
	
	function attendence()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Attendance');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		
		$this->HrTrainingAttendance->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrTrainingAttendance->bindModel(
		array('hasMany' => array('HrTrainingAttendanceRecord' => array(
			'className' => 'HrTrainingAttendanceRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrTrainingAttendance->recursive = 2;
		$this->paginate = array('conditions'=>array('HrTrainingAttendance.user_id'=>$user_id),'order'=>array('HrTrainingAttendance.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrTrainingAttendanceArr = $this->Paginator->paginate('HrTrainingAttendance');	
		$this->set('HrTrainingAttendanceArr',$HrTrainingAttendanceArr);	
		
		// echo '<pre>';
		// print_r($HrTrainingAttendanceArr);
		// die(); 
		
	}
	
	public function attendance_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Attendance');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){	
		
			$this->request->data['HrTrainingAttendance']['user_id'] = $user_id;
			$this->request->data['HrTrainingAttendance']['created'] = date('Y-m-d H:i:s');
			if($this->HrTrainingAttendance->save($this->request->data)){
				$lastinsrtId = $this->HrTrainingAttendance->id;
				
				$i=0;
				foreach($this->request->data['trainee_name'] as $trainee_name){
					$insert['HrTrainingAttendanceRecord']['id'] = '';
					$insert['HrTrainingAttendanceRecord']['user_id'] = $user_id;
					$insert['HrTrainingAttendanceRecord']['hr_id'] = $lastinsrtId;
					$insert['HrTrainingAttendanceRecord']['trainee_name'] = $this->request->data['trainee_name'][$i];
					$insert['HrTrainingAttendanceRecord']['department'] = $this->request->data['department'][$i];
					$insert['HrTrainingAttendanceRecord']['signature'] = $this->request->data['signature'][$i];
					$insert['HrTrainingAttendanceRecord']['date'] = $this->request->data['date'][$i];
					$this->HrTrainingAttendanceRecord->save($insert);
					$i++;
				}
			}	
			$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('attendence');		
		}		
		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	
		
		$docArr = $this->HrTrainingAttendance->find('first',array('order'=>array('HrTrainingAttendance.id'=>'DESC'),'fields'=>array('HrTrainingAttendance.id')));		
		if(!empty($docArr['HrTrainingAttendance']['id'])){
			$docId = 'CWSTA-'. (1000+$docArr['HrTrainingAttendance']['id'] + 1);
		}else{
			$docId = 'CWSTA-1001';
		}
		$this->set('docId', $docId);	
	}
		
	public function attendance_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Training Attendance');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){	
		
			$this->request->data['HrTrainingAttendance']['id'] = $id;
			$this->request->data['HrTrainingAttendance']['user_id'] = $user_id;
			$this->request->data['HrTrainingAttendance']['created'] = date('Y-m-d H:i:s');
			if($this->HrTrainingAttendance->save($this->request->data)){
				$this->HrTrainingAttendanceRecord->query('delete from hr_training_attendance_records where hr_id = '.$id.'');
				$i=0;
				foreach($this->request->data['trainee_name'] as $trainee_name){
					$insert['HrTrainingAttendanceRecord']['id'] = '';
					$insert['HrTrainingAttendanceRecord']['user_id'] = $user_id;
					$insert['HrTrainingAttendanceRecord']['hr_id'] = $id;
					$insert['HrTrainingAttendanceRecord']['trainee_name'] = $this->request->data['trainee_name'][$i];
					$insert['HrTrainingAttendanceRecord']['department'] = $this->request->data['department'][$i];
					$insert['HrTrainingAttendanceRecord']['signature'] = $this->request->data['signature'][$i];
					$insert['HrTrainingAttendanceRecord']['date'] = $this->request->data['date'][$i];
					$this->HrTrainingAttendanceRecord->save($insert);
					$i++;
				}
			}	
			$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('attendence');		
		}		
		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);	
		
		
		$this->HrTrainingAttendance->bindModel(
		array('hasMany' => array('HrTrainingAttendanceRecord' => array(
			'className' => 'HrTrainingAttendanceRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$docArr = $this->HrTrainingAttendance->find('first',array('conditions'=>array('HrTrainingAttendance.id'=>$id)));
	/* 	echo '<pre>';
		print_r($docArr);
		die();  */
		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);
	}	
	
	function performancefeedback()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Performance Feedback');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->HrPerformanceFeedback->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('conditions'=>array('HrPerformanceFeedback.user_id'=>$user_id),'order'=>array('HrPerformanceFeedback.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrPerformanceFeedbackArr = $this->Paginator->paginate('HrPerformanceFeedback');	
		$this->set('HrPerformanceFeedbackArr',$HrPerformanceFeedbackArr);	
		
		// echo '<pre>';
		// print_r($HrPerformanceFeedbackArr);
		// die();	
		
	}	
	public function performance_feedback_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Hr Performance Feedback');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['HrPerformanceFeedback']['user_id'] = $user_id;
			$this->request->data['HrPerformanceFeedback']['created'] = date('Y-m-d H:i:s');
			if($this->HrPerformanceFeedback->save($this->request->data)){
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('performancefeedback');	
			}				
		}
		
		$docArr = $this->HrPerformanceFeedback->find('first',array('order'=>array('HrPerformanceFeedback.id'=>'DESC'),'fields'=>array('HrPerformanceFeedback.id')));		
		if(!empty($docArr['HrPerformanceFeedback']['id'])){
			$docId = 'CWSTA-'. (1000+$docArr['HrPerformanceFeedback']['id'] + 1);
		}else{
			$docId = 'CWSTA-1001';
		}
		$this->set('docId', $docId);	
	}	

	public function performance_feedback_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Hr Performance Feedback');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['HrPerformanceFeedback']['id'] = $id;
			$this->request->data['HrPerformanceFeedback']['user_id'] = $user_id;
			$this->request->data['HrPerformanceFeedback']['created'] = date('Y-m-d H:i:s');
			if($this->HrPerformanceFeedback->save($this->request->data)){
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('performancefeedback');	
			}				
		}
		
		$docArr = $this->HrPerformanceFeedback->find('first',array('conditions'=>array('HrPerformanceFeedback.id'=>$id)));		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);	
	}	
	
	function newjoining()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' New Joining List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->HrNewJoiningDetail->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('conditions'=>array('HrNewJoiningDetail.user_id'=>$user_id),'order'=>array('HrNewJoiningDetail.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrNewJoiningDetailArr = $this->Paginator->paginate('HrNewJoiningDetail');	
		$this->set('HrNewJoiningDetailArr',$HrNewJoiningDetailArr);	
		
		/* echo '<pre>';
		print_r($HrNewJoiningDetailArr);
		die();	 */
		
	}
	
	public function newjoining_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Hr New Joining');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['HrNewJoiningDetail']['user_id'] = $user_id;
			$this->request->data['HrNewJoiningDetail']['created'] = date('Y-m-d H:i:s');
			if($this->HrNewJoiningDetail->save($this->request->data)){
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('newjoining');	
			}				
		}
		
		$docArr = $this->HrNewJoiningDetail->find('first',array('order'=>array('HrNewJoiningDetail.id'=>'DESC'),'fields'=>array('HrNewJoiningDetail.id')));		
		if(!empty($docArr['HrNewJoiningDetail']['id'])){
			$docId = 'CWSNJ-'. (1000+$docArr['HrNewJoiningDetail']['id'] + 1);
		}else{
			$docId = 'CWSNJ-1001';
		}
		$this->set('docId', $docId);	
	}
	
	public function newjoining_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Hr New Joining');
		$this->checkSatffSession();
		
		if(!empty($this->request->data)){
	
			$this->request->data['HrNewJoiningDetail']['id'] = $id;			
			if($this->HrNewJoiningDetail->save($this->request->data)){
				$this->Session->setFlash('Record updated successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('newjoining');	
			}				
		}
		
		$docArr = $this->HrNewJoiningDetail->find('first',array('conditions'=>array('HrNewJoiningDetail.id'=>$id)));		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);	
	}
	
	function reportorganization()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' New Joining List');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		
		$this->HrReportOrganization->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
	
		$this->paginate = array('conditions'=>array('HrReportOrganization.user_id'=>$user_id),'order'=>array('HrReportOrganization.id'=>'DESC'),'page' => 1, 'limit' => 10);				
		$HrReportOrganizationArr = $this->Paginator->paginate('HrReportOrganization');	
		$this->set('HrReportOrganizationArr',$HrReportOrganizationArr);	
		
		// echo '<pre>';
		// print_r($HrReportOrganizationArr);
		// die();
		
	}
	
	public function reportorganization_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Report Organization');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
	
			$this->request->data['HrReportOrganization']['user_id'] = $user_id;
			$this->request->data['HrReportOrganization']['created'] = date('Y-m-d H:i:s');
			if($this->HrReportOrganization->save($this->request->data)){
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('reportorganization');	
			}				
		}
		
		$docArr = $this->HrReportOrganization->find('first',array('order'=>array('HrReportOrganization.id'=>'DESC'),'fields'=>array('HrReportOrganization.id')));		
		if(!empty($docArr['HrReportOrganization']['id'])){
			$docId = 'CWSJRO-'. (1000+$docArr['HrReportOrganization']['id'] + 1);
		}else{
			$docId = 'CWSJRO-1001';
		}
		$this->set('docId', $docId);	
	}
	
	public function reportorganization_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Hr New Joining');
		$this->checkSatffSession();
		
		if(!empty($this->request->data)){
	
			$this->request->data['HrReportOrganization']['id'] = $id;			
			if($this->HrReportOrganization->save($this->request->data)){
				$this->Session->setFlash('Record updated successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('reportorganization');	
			}				
		}		
		$docArr = $this->HrReportOrganization->find('first',array('conditions'=>array('HrReportOrganization.id'=>$id)));		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);	
	}
	
	function res_during_leave()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Handling/Taking Over Duties & Responsibilties During Leave');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
	
		$this->HrDuringLeave->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrDuringLeave->bindModel(
		array('hasMany' => array('HrDuringLeaveRecord' => array(
			'className' => 'HrDuringLeaveRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrDuringLeave->recursive = 2;
		$this->paginate = array('conditions'=>array('HrDuringLeave.user_id'=>$user_id),'order'=>array('HrDuringLeave.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrDuringLeave');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		// echo '<pre>';
		// print_r($HrDuringLeaveArr);
		// die();  
		
	}
	
	public function res_during_leave_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Handling/Taking Over Duties & Responsibilties During Leave');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$this->request->data['HrDuringLeave']['user_id'] = $user_id;
			$this->request->data['HrDuringLeave']['created'] = date('Y-m-d H:i:s');
			if($this->HrDuringLeave->save($this->request->data)){
				$lastinsrtId = $this->HrDuringLeave->id;
				
				$i=0;
				foreach($this->request->data['description_of_duty'] as $description_of_duty){
					$insert['HrDuringLeaveRecord']['id'] = '';
					$insert['HrDuringLeaveRecord']['hr_id'] = $lastinsrtId;
					$insert['HrDuringLeaveRecord']['description_of_duty'] = $this->request->data['description_of_duty'][$i];
					$insert['HrDuringLeaveRecord']['description_of_responsibility'] = $this->request->data['description_of_responsibility'][$i];
					$insert['HrDuringLeaveRecord']['handed_over'] = $this->request->data['handed_over'][$i];
					$insert['HrDuringLeaveRecord']['assigned_to'] = $this->request->data['assigned_to'][$i];
					$insert['HrDuringLeaveRecord']['signature'] = $this->request->data['signature'][$i];
					$this->HrDuringLeaveRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('res_during_leave');	
			}				
		}
		
		$docArr = $this->HrDuringLeave->find('first',array('order'=>array('HrDuringLeave.id'=>'DESC'),'fields'=>array('HrDuringLeave.id')));		
		if(!empty($docArr['HrDuringLeave']['id'])){
			$docId = 'CWSRDL-'. (1000+$docArr['HrDuringLeave']['id'] + 1);
		}else{
			$docId = 'CWSRDL-1001';
		}
		$this->set('docId', $docId);	
	}
	
	public function res_during_leave_edit($id) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Edit Handling/Taking Over Duties & Responsibilties During Leave');
		$this->checkSatffSession();
		
		if(!empty($this->request->data)){
			
			$this->request->data['HrDuringLeave']['id'] = $id;
			$this->request->data['HrDuringLeave']['created'] = date('Y-m-d H:i:s');
			if($this->HrDuringLeave->save($this->request->data)){
				
				$this->HrDuringLeaveRecord->query('delete from hr_during_leave_records where hr_id = '.$id.'');
				$i=0;
				foreach($this->request->data['description_of_duty'] as $description_of_duty){
					$insert['HrDuringLeaveRecord']['id'] = '';
					$insert['HrDuringLeaveRecord']['hr_id'] = $id;
					$insert['HrDuringLeaveRecord']['description_of_duty'] = $this->request->data['description_of_duty'][$i];
					$insert['HrDuringLeaveRecord']['description_of_responsibility'] = $this->request->data['description_of_responsibility'][$i];
					$insert['HrDuringLeaveRecord']['handed_over'] = $this->request->data['handed_over'][$i];
					$insert['HrDuringLeaveRecord']['assigned_to'] = $this->request->data['assigned_to'][$i];
					$insert['HrDuringLeaveRecord']['signature'] = $this->request->data['signature'][$i];
					$this->HrDuringLeaveRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('res_during_leave');	
			}				
		}
		$this->HrDuringLeave->bindModel(
		array('hasMany' => array('HrDuringLeaveRecord' => array(
			'className' => 'HrDuringLeaveRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$docArr = $this->HrDuringLeave->find('first',array('conditions'=>array('HrDuringLeave.id'=>$id)));		
		/* echo '<pre>';
		print_r($docArr);
		die();   */
		$this->set('docArr', $docArr);	
		$this->request->data = $docArr;
	}
	
	
	function format_evaluation_employe()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr format training calendars');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
	
		$this->HrFormatEvaluationEmployee->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrFormatEvaluationEmployee->bindModel(
		array('hasMany' => array('HrFormatEvaluationEmployeRecord' => array(
			'className' => 'HrFormatEvaluationEmployeRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatEvaluationEmployee->recursive = 2;
		$this->paginate = array('conditions'=>array('HrFormatEvaluationEmployee.user_id'=>$user_id),'order'=>array('HrFormatEvaluationEmployee.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrFormatEvaluationEmployee');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		/* echo '<pre>';
		print_r($HrDuringLeaveArr);
		die();    */
		
	}
	public function format_evaluation_employe_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Add Format evaluation employe');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$this->request->data['HrFormatEvaluationEmployee']['user_id'] = $user_id;
			$this->request->data['HrFormatEvaluationEmployee']['created'] = date('Y-m-d H:i:s');
			if($this->HrFormatEvaluationEmployee->save($this->request->data)){
				$lastinsrtId = $this->HrFormatEvaluationEmployee->id;
			
				$i=0;
				foreach($this->request->data['detail'] as $detail){
					$insert['HrFormatEvaluationEmployeRecord']['id'] = '';
					$insert['HrFormatEvaluationEmployeRecord']['hr_id'] = $lastinsrtId;
					$insert['HrFormatEvaluationEmployeRecord']['detail'] = $detail;				
					$insert['HrFormatEvaluationEmployeRecord']['acceptable'] = $this->request->data['acceptable'][$i];				
					$insert['HrFormatEvaluationEmployeRecord']['not_acceptable'] = $this->request->data['not_acceptable'][$i];			
					$insert['HrFormatEvaluationEmployeRecord']['to_be_improved'] = $this->request->data['to_be_improved'][$i];				
					$this->HrFormatEvaluationEmployeRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('format_evaluation_employe');	
			}				
		}
		
		$docArr = $this->HrFormatEvaluationEmployee->find('first',array('order'=>array('HrFormatEvaluationEmployee.id'=>'DESC'),'fields'=>array('HrFormatEvaluationEmployee.id')));		
		if(!empty($docArr['HrFormatEvaluationEmployee']['id'])){
			$docId = 'CWSFEE-'. (1000+$docArr['HrFormatEvaluationEmployee']['id'] + 1);
		}else{
			$docId = 'CWSFEE-1001';
		}
		$this->set('docId', $docId);	
	}
	public function format_evaluation_employe_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Add Format evaluation employe');
		$this->checkSatffSession();
		
		if(!empty($this->request->data)){
			
			$this->request->data['HrFormatEvaluationEmployee']['id'] = $id;		
			if($this->HrFormatEvaluationEmployee->save($this->request->data)){
				$this->HrFormatEvaluationEmployeRecord->query("delete from hr_format_evaluation_employe_records where hr_id = ".$id."");
				$i=0;
				foreach($this->request->data['detail'] as $detail){
					$insert['HrFormatEvaluationEmployeRecord']['id'] = '';
					$insert['HrFormatEvaluationEmployeRecord']['hr_id'] = $id;
					$insert['HrFormatEvaluationEmployeRecord']['detail'] = $detail;				
					$insert['HrFormatEvaluationEmployeRecord']['acceptable'] = $this->request->data['acceptable'][$i];				
					$insert['HrFormatEvaluationEmployeRecord']['not_acceptable'] = $this->request->data['not_acceptable'][$i];			
					$insert['HrFormatEvaluationEmployeRecord']['to_be_improved'] = $this->request->data['to_be_improved'][$i];				
					$this->HrFormatEvaluationEmployeRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('format_evaluation_employe');	
			}				
		}
		$this->HrFormatEvaluationEmployee->bindModel(
		array('hasMany' => array('HrFormatEvaluationEmployeRecord' => array(
			'className' => 'HrFormatEvaluationEmployeRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatEvaluationEmployee->recursive = 2;
		$docArr = $this->HrFormatEvaluationEmployee->find('first',array('conditions'=>array('HrFormatEvaluationEmployee.id'=>$id)));		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);	
	}
	function format_training_calendars()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr format training calendars');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
	
		$this->HrFormatTrainingCalendar->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrFormatTrainingCalendar->bindModel(
		array('hasMany' => array('HrFormatTrainingCalendarRecord' => array(
			'className' => 'HrFormatTrainingCalendarRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatTrainingCalendar->recursive = 2;
		$this->paginate = array('conditions'=>array('HrFormatTrainingCalendar.user_id'=>$user_id),'order'=>array('HrFormatTrainingCalendar.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrFormatTrainingCalendar');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		/* echo '<pre>';
		print_r($HrDuringLeaveArr);
		die();   */
		
	}
	
	
	
	
	
	public function format_trainng_calendar_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Add Format training calendars');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$this->request->data['HrFormatTrainingCalendar']['user_id'] = $user_id;
			$this->request->data['HrFormatTrainingCalendar']['created'] = date('Y-m-d H:i:s');
			if($this->HrFormatTrainingCalendar->save($this->request->data)){
				$lastinsrtId = $this->HrFormatTrainingCalendar->id;
			
				$i=0;
				foreach($this->request->data['month'] as $month){
					$insert['HrFormatTrainingCalendarRecord']['id'] = '';
					$insert['HrFormatTrainingCalendarRecord']['hr_id'] = $lastinsrtId;
					$insert['HrFormatTrainingCalendarRecord']['month'] = $month;
					if(!empty($this->request->data['planed'][$i])){ 
						$insert['HrFormatTrainingCalendarRecord']['planed'] = $this->request->data['planed'][$i]; 
					}else{
						$insert['HrFormatTrainingCalendarRecord']['planed'] = '';
					}	
					if(!empty($this->request->data['actual'][$i])){ 
						$insert['HrFormatTrainingCalendarRecord']['actual'] = $this->request->data['actual'][$i];
					}else{
						$insert['HrFormatTrainingCalendarRecord']['actual'] = '';
					}
					
					$this->HrFormatTrainingCalendarRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('format_training_calendars');	
			}				
		}
		
		$docArr = $this->HrFormatTrainingCalendar->find('first',array('order'=>array('HrFormatTrainingCalendar.id'=>'DESC'),'fields'=>array('HrFormatTrainingCalendar.id')));		
		if(!empty($docArr['HrFormatTrainingCalendar']['id'])){
			$docId = 'CWSFTC-'. (1000+$docArr['HrFormatTrainingCalendar']['id'] + 1);
		}else{
			$docId = 'CWSFTC-1001';
		}
		$this->set('docId', $docId);	
	}
	
	public function format_trainng_calendar_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Add Format training calendars');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
			$this->request->data['HrFormatTrainingCalendar']['id'] = $id;		
			if($this->HrFormatTrainingCalendar->save($this->request->data)){
				
				$this->HrFormatTrainingCalendarRecord->query("delete from hr_format_training_calendar_records where hr_id=".$id."");
				$i=0;
				foreach($this->request->data['month'] as $month){
					$insert['HrFormatTrainingCalendarRecord']['id'] = '';
					$insert['HrFormatTrainingCalendarRecord']['hr_id'] = $id;
					$insert['HrFormatTrainingCalendarRecord']['month'] = $month;
					if(!empty($this->request->data['planed'][$i])){ 
						$insert['HrFormatTrainingCalendarRecord']['planed'] = $this->request->data['planed'][$i]; 
					}else{
						$insert['HrFormatTrainingCalendarRecord']['planed'] = '';
					}	
					if(!empty($this->request->data['actual'][$i])){ 
						$insert['HrFormatTrainingCalendarRecord']['actual'] = $this->request->data['actual'][$i];
					}else{
						$insert['HrFormatTrainingCalendarRecord']['actual'] = '';
					}
					
					$this->HrFormatTrainingCalendarRecord->save($insert);
					$i++;
				}
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('format_training_calendars');	
			}				
		}
		$this->HrFormatTrainingCalendar->bindModel(
		array('hasMany' => array('HrFormatTrainingCalendarRecord' => array(
			'className' => 'HrFormatTrainingCalendarRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrFormatTrainingCalendar->recursive = 2;
		$docArr = $this->HrFormatTrainingCalendar->find('first',array('conditions'=>array('HrFormatTrainingCalendar.id'=>$id)));		
		
		// echo '<pre>';
		// print_r($docArr);
		// die();
		
		$this->request->data = $docArr;
		$this->set('docArr', $docArr);	
	}
	
	
	function hr_appraisal_form()
	{
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Appraisal Form');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
	
		$this->HrAppraisalForm->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->HrAppraisalForm->bindModel(
		array('hasMany' => array('HrAppraisalFormRecord' => array(
			'className' => 'HrAppraisalFormRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrAppraisalForm->recursive = 2;
		$this->paginate = array('conditions'=>array('HrAppraisalForm.user_id'=>$user_id),'order'=>array('HrAppraisalForm.id'=>'DESC'),'page' => 1, 'limit' => 10);		

		$HrDuringLeaveArr = $this->Paginator->paginate('HrAppraisalForm');	
		$this->set('HrDuringLeaveArr',$HrDuringLeaveArr);	
		
		// echo '<pre>';
		// print_r($HrDuringLeaveArr);
		// die();    
		
	}
	public function appraisal_form_edit($id=null) {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Edit Appraisal Form');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
		/* 	echo '<pre>';
			print_r($this->request->data);
			die(); */			
			$this->request->data['HrAppraisalForm']['id'] = $id;	
			if($this->HrAppraisalForm->save($this->request->data)){
				$this->HrAppraisalFormRecord->query("delete from hr_appraisal_form_records where hr_id=".$id."");
			
				$i=0;
				foreach($this->request->data['performance_criteria'] as $performance_criteria){
					$insert['HrAppraisalFormRecord']['id'] = '';
					$insert['HrAppraisalFormRecord']['hr_id'] = $id;
					$insert['HrAppraisalFormRecord']['performance_criteria'] = $performance_criteria;
					if(!empty($this->request->data['rating'][$i])){ 
						$insert['HrAppraisalFormRecord']['rating'] = $this->request->data['rating'][$i]; 
					}else{
						$insert['HrAppraisalFormRecord']['rating'] = '';
					}	
					if(!empty($this->request->data['performance_criteria'][$i])){ 
						$insert['HrAppraisalFormRecord']['performance_criteria'] = $this->request->data['performance_criteria'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['performance_criteria'] = '';
					}
					if(!empty($this->request->data['applicabe_for'][$i])){ 
						$insert['HrAppraisalFormRecord']['applicabe_for'] = $this->request->data['applicabe_for'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['applicabe_for'] = '';
					}
					if(!empty($this->request->data['rating_by_appraiser'][$i])){ 
						$insert['HrAppraisalFormRecord']['rating_by_appraiser'] = $this->request->data['rating_by_appraiser'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['rating_by_appraiser'] = '';
					}
					$this->HrAppraisalFormRecord->save($insert);
					$i++;
				} 
				
				$this->Session->setFlash('Record edit successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('hr_appraisal_form');	
			}				
		}
		$this->HrAppraisalForm->bindModel(
		array('hasMany' => array('HrAppraisalFormRecord' => array(
			'className' => 'HrAppraisalFormRecord',			 
			'foreignKey' => 'hr_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));	
		$this->HrAppraisalForm->recursive = 2;
		$docArr = $this->HrAppraisalForm->find('first',array('conditions'=>array('HrAppraisalForm.id'=>$id)));		
		$this->set('docArr', $docArr);	
		$this->request->data = $docArr;
	}
	
	public function appraisal_form_add() {
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Hr Add Appraisal Form');
		$this->checkSatffSession();
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){
			
		/* 	echo '<pre>';
			print_r($this->request->data);
			die(); */
			
			$this->request->data['HrAppraisalForm']['user_id'] = $user_id;
			$this->request->data['HrAppraisalForm']['created'] = date('Y-m-d H:i:s');
			if($this->HrAppraisalForm->save($this->request->data)){
				$lastinsrtId = $this->HrAppraisalForm->id;
			
				$i=0;
				foreach($this->request->data['performance_criteria'] as $performance_criteria){
					$insert['HrAppraisalFormRecord']['id'] = '';
					$insert['HrAppraisalFormRecord']['hr_id'] = $lastinsrtId;
					$insert['HrAppraisalFormRecord']['performance_criteria'] = $performance_criteria;
					if(!empty($this->request->data['rating'][$i])){ 
						$insert['HrAppraisalFormRecord']['rating'] = $this->request->data['rating'][$i]; 
					}else{
						$insert['HrAppraisalFormRecord']['rating'] = '';
					}	
					if(!empty($this->request->data['performance_criteria'][$i])){ 
						$insert['HrAppraisalFormRecord']['performance_criteria'] = $this->request->data['performance_criteria'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['performance_criteria'] = '';
					}
					if(!empty($this->request->data['applicabe_for'][$i])){ 
						$insert['HrAppraisalFormRecord']['applicabe_for'] = $this->request->data['applicabe_for'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['applicabe_for'] = '';
					}
					if(!empty($this->request->data['rating_by_appraiser'][$i])){ 
						$insert['HrAppraisalFormRecord']['rating_by_appraiser'] = $this->request->data['rating_by_appraiser'][$i];
					}else{
						$insert['HrAppraisalFormRecord']['rating_by_appraiser'] = '';
					}
					$this->HrAppraisalFormRecord->save($insert);
					$i++;
				} 
				
				$this->Session->setFlash('Record added successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('hr_appraisal_form');	
			}				
		}
		
		$docArr = $this->HrAppraisalForm->find('first',array('order'=>array('HrAppraisalForm.id'=>'DESC'),'fields'=>array('HrAppraisalForm.id')));		
		if(!empty($docArr['HrAppraisalForm']['id'])){
			$docId = 'CWSPAF-'. (1000+$docArr['HrAppraisalForm']['id'] + 1);
		}else{
			$docId = 'CWSPAF-1001';
		}
		$this->set('docId', $docId);	
	}
	
}
?>