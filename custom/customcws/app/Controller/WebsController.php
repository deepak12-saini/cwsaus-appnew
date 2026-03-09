<?php 
App::uses('AppController','Controller');
class WebsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('User','Task','Employee','TaskAssign','TaskDocument','NappUser','TaskComment','UserPermission','Department','SaleRep','SaleQuestion','SaleNotification','AssignClient','Client','BatchCountSheet','BatchRegister','StaffClient','ClientType','UserLocation','Room');
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function room(){
		
		$this->autoRender = false;
		
		$roomArr = $this->Room->find('all');
		if(!empty($roomArr)){
			$roomData = array();
			foreach($roomArr as $roomArrs){
				$room['uniqueid'] = $roomArrs['Room']['uniqueid'];
				$room['room'] = $roomArrs['Room']['room'];
				$room['name'] = $roomArrs['Room']['name'];
				$roomData[] = $room;
			}
			$data['status'] = 1;
			$data['data'] = $roomData;
		}else{
			$data['status'] = 0;
			$data['message'] = 'no room available';
		}
		echo json_encode($data);	
	}	
	function userlocation(){
		
		$this->autoRender = false;	
		isset($_REQUEST['user_id'])? 	$user_id =  $_REQUEST['user_id'] : $user_id =  0;
		isset($_REQUEST['lats'])? 	$lats =  $_REQUEST['lats'] : $lats =  '';
		isset($_REQUEST['longs'])? 	$longs =  $_REQUEST['longs'] : $longs =  '';
		if(!empty($user_id) && !empty($lats) && !empty($longs)){
			
			$userArr = $this->UserLocation->find('first',array('conditions'=>array('UserLocation.user_id'=>$user_id)));
			if(!empty($userArr)){
				$insert['UserLocation']['id'] = $userArr['UserLocation']['id'];
			}				
			$insert['UserLocation']['user_id'] = $user_id;
			$insert['UserLocation']['lats'] = $lats;
			$insert['UserLocation']['longs'] = $longs;
			$insert['UserLocation']['created'] = date('Y-m-d H:i:s');			
			if ($this->UserLocation->save($insert)) {
				$data['status'] = 1;
				$data['message'] = 'Location updated successfully';
			}				
		}else{
			$data['status'] = 0;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);	
	}	
	
	function fetchuser(){
		
		$this->autoRender = false;
		
		$this->UserLocation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));	
		$userArr = $this->UserLocation->find('all');
		if(!empty($userArr)){
			$user = array();
			foreach($userArr as $userArrs){
				
				$userdata['user_id'] = $userArrs['NappUser']['id'];	
				$userdata['name'] = $userArrs['NappUser']['name'].' '.$userArrs['NappUser']['lname'];	
				$userdata['lats'] = $userArrs['UserLocation']['lats'];
				$userdata['longs'] = $userArrs['UserLocation']['longs'];
				$userdata['created'] = $userArrs['UserLocation']['created'];
				$user[] = $userdata;
			}
			$data['status'] = 1;
			$data['data'] = $user;
		}else{
			$data['status'] = 0;
			$data['message'] = 'no record found';
		}	
		echo json_encode($data);	
	}	
	
	function clientType(){
		
	$this->autoRender = false;
		$ClientTypeArr = $this->ClientType->find('all');
		
		$categoryArr = array();
		foreach($ClientTypeArr as $ClientTypes){
			$category['id'] =  $ClientTypes['ClientType']['id'];
			$category['name'] =  $ClientTypes['ClientType']['name'];
			$categoryArr[] =$category;
		}	
		$data['status'] = 1;
		$data['data'] = $categoryArr;
		
		echo json_encode($data);
		
	}	
	
	function addclient(){
	
		$this->autoRender = false;
		
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = 0;
		isset($_REQUEST['category_id'])? $category_id = $_REQUEST['category_id'] : $category_id = 0;
		isset($_REQUEST['name'])? $fname = $_REQUEST['name'] : $fname = '';
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		isset($_REQUEST['mobile'])? $mobile = $_REQUEST['mobile'] : $mobile = '';
		isset($_REQUEST['landline'])? $landline = $_REQUEST['landline'] : $landline = '';
		isset($_REQUEST['company'])? $company = $_REQUEST['company'] : $company = '';
		isset($_REQUEST['address1'])? $address1 = $_REQUEST['address1'] : $address1 = '';
		isset($_REQUEST['city'])? $city = $_REQUEST['city'] : $city = '';
		isset($_REQUEST['state'])? $state = $_REQUEST['state'] : $state = '';
		isset($_REQUEST['zip'])? $zip = $_REQUEST['zip'] : $zip = '';
		isset($_REQUEST['country'])? $country = $_REQUEST['country'] : $country = '';
		
		if(!empty($user_id) && !empty($category_id) && !empty($fname) && !empty($email) && !empty($mobile)){
			
			$insert['Client']['user_id'] = $user_id;
			$insert['Client']['category_id'] = $category_id;
			$insert['Client']['fname'] = $fname;
			$insert['Client']['email'] = $email;
			$insert['Client']['mobile'] = $mobile;
			$insert['Client']['landline'] = $landline;
			$insert['Client']['company'] = $company;
			$insert['Client']['address1'] = $address1;
			$insert['Client']['city'] = $city;
			$insert['Client']['state'] = $state;
			$insert['Client']['country'] = $country;
			$insert['Client']['zip'] = $zip;
			
			if ($this->Client->save($insert)) {
				$clientId = $this->Client->id;
				
				$insert['StaffClient']['id']	= 	'';			
				$insert['StaffClient']['staff_id']	= 	$user_id;			
				$insert['StaffClient']['client_id']	= 	$clientId;	
				$this->StaffClient->save($insert);	
				
				$data['status'] = 1;
				$data['message'] = 'Client added successfully';
				
			}	
			
		}else{
			$data['status'] = 0;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	
	
	function stafflist(){
		
		$this->autoRender = false;
		$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));
		$userArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper)));
		$staffArr = '';
		if(!empty($userArr)){
			foreach($userArr as $userArrs){
				$staff['id'] = $userArrs['NappUser']['id'];	
				$staff['name'] = $userArrs['NappUser']['name'].' '.$userArrs['NappUser']['lname'];	
				$staff['email'] = $userArrs['NappUser']['email'];	
				$staff['mobile_number'] = $userArrs['NappUser']['mobile_number'];
				$staffArr[] = $staff;	
			}	
			$data['status'] = true;
			$data['data'] = $staffArr;	
		}else{
			$data['status'] = false;
			$data['message'] = 'no record found';		
		}
		echo json_encode($data);		
	}	
	
	
		
	
	function departmentlist(){
		
		$this->autoRender = false;
		$Department = $this->Department->find('all');
		$deptArr = array();
		
		foreach($Department as $Departments){
			$dept['dept_id'] = $Departments['Department']['id'];
			$dept['department_title'] = $Departments['Department']['department_title'];
			
			$deptArr[] = $dept;
		}
		echo json_encode($deptArr);	
	}	
	
	function salestarget(){
		
		$this->autoRender = false;
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		if(!empty($staff_id)){
			
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$staff_id)));
			if(!empty($userArr)){
				if($userArr['NappUser']['rating'] > 0){
					
					$emp['rating'] =  $userArr['NappUser']['rating'];
					
					$emp['package']['basic_sal'] =  $userArr['NappUser']['basic_sal'];
					$emp['package']['super'] =  $userArr['NappUser']['super'];
					$emp['package']['phone_expnse'] =  $userArr['NappUser']['phone_expnse'];
					$emp['package']['fmv'] =  $userArr['NappUser']['fmv'];
					$emp['package']['total_annual_package'] =  $userArr['NappUser']['total_annual_package'];
					
					$emp['sales_targets']['sale_targe_per_week'] =  $userArr['NappUser']['sale_targe_per_week'];
					$emp['sales_targets']['sale_targe_per_month'] =  $userArr['NappUser']['sale_targe_per_month'];
					$emp['sales_targets']['sale_targe_per_annum'] =  $userArr['NappUser']['sale_targe_per_annum'];
					
					$emp['ff_day'] =  $userArr['NappUser']['ff_day'];
					$emp['ff_meeting'] =  $userArr['NappUser']['ff_meeting'];
					$emp['ff_month'] =  $userArr['NappUser']['ff_month'];
					
					$emp['cc_day'] =  $userArr['NappUser']['cc_day'];
					$emp['cc_meeting'] =  $userArr['NappUser']['cc_meeting'];
					$emp['cc_month'] =  $userArr['NappUser']['cc_month'];
				
					$data['status'] = true;
					$data['data'] = $emp;
				}else{
					$data['status'] = false;
					$data['message'] = 'All parameters required';
				}
			}else{
				$data['status'] = false;
				$data['message'] = 'user not exist';
			}		
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	
	function assignClient(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		if(!empty($staff_id)){
			
			$this->AssignClient->bindModel(
			array('belongsTo' => array('Client' => array(
				'className' => 'Client',			 
				'foreignKey' => 'client_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));	
			$AssignClient = $this->AssignClient->find('all',array('conditions'=>array('AssignClient.user_id'=>$staff_id)));			
			$cleintArr = array();
			if(!empty($AssignClient)){				
				foreach($AssignClient as $AssignClients){
					$client['id'] = $AssignClients['Client']['id'];		
					$client['fname'] = $AssignClients['Client']['fname'];		
					$client['lname'] = $AssignClients['Client']['lname'];		
					$client['email'] = $AssignClients['Client']['email'];		
					$client['company'] = $AssignClients['Client']['company'];		
					$client['job_title'] = $AssignClients['Client']['job_title'];		
					$client['address1'] = $AssignClients['Client']['address1'];		
					$client['address2'] = $AssignClients['Client']['address2'];		
					$client['state'] = $AssignClients['Client']['state'];		
					$client['zip'] = $AssignClients['Client']['zip'];		
					$client['city'] = $AssignClients['Client']['city'];		
					$client['country'] = $AssignClients['Client']['country'];	
					$cleintArr[] = $client;	
				}	
			}
			$data['status'] = true;
			$data['data'] = $cleintArr;			
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);		
	}
	
	function salenotification(){
				
		$this->autoRender = false;
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		if(!empty($staff_id)){
			
			$saleArr = $this->SaleNotification->find('all',array('conditions'=>array('SaleNotification.user_id'=>$staff_id)));
			if(!empty($saleArr)){
				$saleArray = array();
				foreach($saleArr as $saleArrs){
					$sale['title'] = $saleArrs['SaleNotification']['title'];	
					$sale['description'] = $saleArrs['SaleNotification']['description'];	
					$sale['created'] = $saleArrs['SaleNotification']['created'];
					$saleArray[] = $sale;	
				}
				$data['status'] = true;
				$data['data'] =  $saleArray;		
			}else{
				$data['status'] = false;
				$data['message'] = 'no notification';	
			}	
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);	
	}
	
	
	function salemeet(){
		
		$this->autoRender = false;
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		isset($_REQUEST['sales_type'])? $sales_question_id = $_REQUEST['sales_type'] : $sales_question_id = '';
		if(!empty($staff_id) && !empty($sales_question_id)){
			$this->SaleRep->bindModel(
			array('belongsTo' => array('SaleQuestion' => array(
				'className' => 'SaleQuestion',			 
				'foreignKey' => 'sales_question_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));	
			$SaleRepArr = $this->SaleRep->find('all',array('conditions'=>array('SaleRep.sales_question_id'=>$sales_question_id,'SaleRep.staff_id'=>$staff_id),'order'=>array('SaleRep.id'=>'DESC')));
			$SaleRep = array();
			if(!empty($SaleRepArr)){
				foreach($SaleRepArr as $SaleRepArrs){
					$SaleRepArrss['id'] = $SaleRepArrs['SaleRep']['id'];
					$SaleRepArrss['name'] = $SaleRepArrs['SaleRep']['name'];
					$SaleRepArrss['phone'] = $SaleRepArrs['SaleRep']['phone'];
					$SaleRepArrss['company'] = $SaleRepArrs['SaleRep']['company'];
					$SaleRepArrss['email'] = $SaleRepArrs['SaleRep']['email'];
					$SaleRepArrss['spoken_to'] = $SaleRepArrs['SaleRep']['spoken_to'];
					$SaleRepArrss['sample_given_request'] = $SaleRepArrs['SaleRep']['sample_given_request'];
					$SaleRepArrss['comment'] = $SaleRepArrs['SaleRep']['comment'];
					$SaleRepArrss['address'] = $SaleRepArrs['SaleRep']['address'];
					$SaleRepArrss['date'] = date('d M Y',strtotime($SaleRepArrs['SaleRep']['datetime']));
					$SaleRepArrss['time'] = date('h:i a',strtotime($SaleRepArrs['SaleRep']['datetime']));
					$SaleRep[] = $SaleRepArrss;
				}
				
				$data['status'] = true;
				$data['data'] = $SaleRep;	
					
			}else{
				$data['status'] = false;
				$data['message'] = 'no record found';	
			}			
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);		
	}	
	
	
	function addsalemeet(){
		$this->autoRender = false;
		
		isset($_REQUEST['sales_type'])? $sales_question_id = $_REQUEST['sales_type'] : $sales_question_id = '';
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		isset($_REQUEST['name'])? $name = $_REQUEST['name'] : $name = '';
		isset($_REQUEST['phone'])? $phone = $_REQUEST['phone'] : $phone = '';
		isset($_REQUEST['company'])? $company = $_REQUEST['company'] : $company = '';
		isset($_REQUEST['spoken_to'])? $spoken_to = $_REQUEST['spoken_to'] : $spoken_to = '';
		isset($_REQUEST['sample_given_request'])? $sample_given_request = $_REQUEST['sample_given_request'] : $sample_given_request = '';
		isset($_REQUEST['comment'])? $comment = $_REQUEST['comment'] : $comment = '';
		isset($_REQUEST['address'])? $address = $_REQUEST['address'] : $address = '';
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		
		if(!empty($sales_question_id) && !empty($staff_id)){
			
			$SaleRepArr['SaleRep']['staff_id'] = $staff_id;
			$SaleRepArr['SaleRep']['name'] = $name;
			$SaleRepArr['SaleRep']['phone'] = $phone;
			$SaleRepArr['SaleRep']['company'] = $company;
			$SaleRepArr['SaleRep']['spoken_to'] = $spoken_to;
			$SaleRepArr['SaleRep']['sample_given_request'] = $sample_given_request;
			$SaleRepArr['SaleRep']['comment'] = $comment;
			$SaleRepArr['SaleRep']['address'] = $address;
			$SaleRepArr['SaleRep']['email'] = $email;
			$SaleRepArr['SaleRep']['sales_question_id'] = $sales_question_id;
			$SaleRepArr['SaleRep']['datetime'] = date('Y-m-d H:i:s');
			$SaleRepArr['SaleRep']['created'] = date('Y-m-d H:i:s');
			$this->SaleRep->save($SaleRepArr);
			
			$data['status'] = true;
			$data['message'] = 'Added successfully';
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);	
		
	}	
	
	function deletesalemeet(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['id'])? $id = $_REQUEST['id'] : $id = '';
		if(!empty($id) && !empty($sales_type)){
			if($this->SaleRep->delete($id)){
				$data['status'] = false;
				$data['message'] = 'deleted successfully';
			}	
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);	
	}	
	
	function editsalemeet(){
		$this->autoRender = false;
		
		isset($_REQUEST['id'])? $id = $_REQUEST['id'] : $id = '';
		isset($_REQUEST['sales_type'])? $sales_question_id = $_REQUEST['sales_type'] : $sales_question_id = '';		
		isset($_REQUEST['name'])? $name = $_REQUEST['name'] : $name = '';
		isset($_REQUEST['phone'])? $phone = $_REQUEST['phone'] : $phone = '';
		isset($_REQUEST['company'])? $company = $_REQUEST['company'] : $company = '';
		isset($_REQUEST['spoken_to'])? $spoken_to = $_REQUEST['spoken_to'] : $spoken_to = '';
		isset($_REQUEST['sample_given_request'])? $sample_given_request = $_REQUEST['sample_given_request'] : $sample_given_request = '';
		isset($_REQUEST['comment'])? $comment = $_REQUEST['comment'] : $comment = '';
		isset($_REQUEST['address'])? $address = $_REQUEST['address'] : $address = '';
		
		if(!empty($id) && !empty($sales_type)){
			
			$SaleRepArr['SaleRep']['id'] = $id;
			$SaleRepArr['SaleRep']['name'] = $name;
			$SaleRepArr['SaleRep']['phone'] = $phone;
			$SaleRepArr['SaleRep']['company'] = $company;
			$SaleRepArr['SaleRep']['spoken_to'] = $spoken_to;
			$SaleRepArr['SaleRep']['sample_given_request'] = $sample_given_request;
			$SaleRepArr['SaleRep']['comment'] = $comment;
			$SaleRepArr['SaleRep']['address'] = $address;
			$SaleRepArr['SaleRep']['sales_question_id'] = $sales_question_id;
			$SaleRepArr['SaleRep']['datetime'] = date('Y-m-d H:i:s');
			$this->SaleRep->save($SaleRepArr);
			
			$data['status'] = true;
			$data['message'] = 'updated successfully';
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);	
		
	}	
	
	function profileupdate(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		isset($_REQUEST['name'])? $name = $_REQUEST['name'] : $name = '';
		isset($_REQUEST['lname'])? $lname = $_REQUEST['lname'] : $lname = '';	
		isset($_REQUEST['mobile_number'])? $mobile_number = $_REQUEST['mobile_number'] : $mobile_number = '';
		isset($_REQUEST['designation'])? $designation = $_REQUEST['designation'] : $designation = '';
		isset($_REQUEST['company'])? $company = $_REQUEST['company'] : $company = '';
		isset($_REQUEST['country'])? $country = $_REQUEST['country'] : $country = '';
		
		if(!empty($staff_id) && !empty($name) && !empty($lname) && !empty($mobile_number)&& !empty($dept_id) && !empty($company) && !empty($designation) && !empty($country)){
			
			$NappUser['NappUser']['id'] = $staff_id;			
			$NappUser['NappUser']['empid'] = $dept_id;			
			$NappUser['NappUser']['name'] = $name;
			$NappUser['NappUser']['lname'] = $lname;		
			$NappUser['NappUser']['mobile_number'] = $mobile_number;		
			$NappUser['NappUser']['company'] = $company;		
			$NappUser['NappUser']['country'] = $country;
			$NappUser['NappUser']['insert_date'] = date('Y-m-d H;i:s');
			$this->NappUser->save($NappUser);
			
			$data['status'] = true;
			$data['message'] = 'profile updated successfully';
			
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	
	}
	
	function profile(){
		
		$this->autoRender = false;
		isset($_REQUEST['staff_id'])? $staff_id = $_REQUEST['staff_id'] : $staff_id = '';
		
		if(!empty($staff_id)){
			
			$this->NappUser->bindModel(
			array('belongsTo' => array('Department' => array(
				'className' => 'Department',			 
				'foreignKey' => 'dept_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));		
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$staff_id)));
			if(!empty($userArr)){
				// echo '<pre>';
				// print_r($userArr);
				// die();
				$emp['staff_id'] =  $userArr['NappUser']['id'];
				$emp['emp_id'] =  $userArr['NappUser']['emp_id'];
				$emp['department'] =  $userArr['Department']['department_title'];
				$emp['name'] =  $userArr['NappUser']['name'];
				$emp['lname'] =  $userArr['NappUser']['lname'];
				$emp['email'] =  $userArr['NappUser']['email'];
				$emp['mobile_number'] =  $userArr['NappUser']['mobile_number'];
				$emp['insert_date'] =  $userArr['NappUser']['insert_date'];
				$emp['company'] =  $userArr['NappUser']['company'];
				$emp['is_active'] =  $userArr['NappUser']['is_active'];
				$emp['is_cpd_presentation'] =  $userArr['NappUser']['is_cpd_presentation'];
				$emp['is_natspec_presentation'] =  $userArr['NappUser']['is_natspec_presentation'];
				$emp['is_staff_id'] =  $userArr['NappUser']['is_staff_id'];
				$emp['country'] =  $userArr['NappUser']['country'];
				if($userArr['NappUser']['is_approved'] == 1){
					$emp['is_approved'] =  'Approved';
				}else{
					$emp['is_approved'] =  'Pending';;
				}	
				
				$data['status'] = true;
				$data['data'] = $emp;
			}else{
				$data['status'] = false;
				$data['message'] = 'wrong username or password';
			}	
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	function login(){
		
		$this->autoRender = false;
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		isset($_REQUEST['password'])? $password = $_REQUEST['password'] : $password = '';
		if(!empty($email) && !empty($password)){
			
			$this->NappUser->bindModel(
			array('belongsTo' => array('Department' => array(
				'className' => 'Department',			 
				'foreignKey' => 'dept_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));		
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.email'=>$email,'NappUser.password'=>md5($password))));
			if(!empty($userArr)){
				// echo '<pre>';
				// print_r($userArr);
				// die();
				$emp['staff_id'] =  $userArr['NappUser']['id'];
				$emp['emp_id'] =  $userArr['NappUser']['emp_id'];
				$emp['department'] =  $userArr['Department']['department_title'];
				$emp['name'] =  $userArr['NappUser']['name'];
				$emp['lname'] =  $userArr['NappUser']['lname'];
				$emp['email'] =  $userArr['NappUser']['email'];
				$emp['mobile_number'] =  $userArr['NappUser']['mobile_number'];
				$emp['insert_date'] =  $userArr['NappUser']['insert_date'];
				$emp['company'] =  $userArr['NappUser']['company'];
				$emp['is_active'] =  $userArr['NappUser']['is_active'];
				$emp['is_cpd_presentation'] =  $userArr['NappUser']['is_cpd_presentation'];
				$emp['is_natspec_presentation'] =  $userArr['NappUser']['is_natspec_presentation'];
				$emp['is_staff_id'] =  $userArr['NappUser']['is_staff_id'];
				$emp['country'] =  $userArr['NappUser']['country'];
				if($userArr['NappUser']['is_approved'] == 1){
					$emp['is_approved'] =  'Approved';
				}else{
					$emp['is_approved'] =  'Pending';;
				}	
				
				$data['status'] = true;
				$data['data'] = $emp;
			}else{
				$data['status'] = false;
				$data['message'] = 'wrong username or password';
			}	
		}else{
			$data['status'] = false;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	
	function signup(){
		
		$this->autoRender = false;
		
		isset($_REQUEST['name'])? $name = $_REQUEST['name'] : $name = '';
		isset($_REQUEST['lname'])? $lname = $_REQUEST['lname'] : $lname = '';
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		isset($_REQUEST['password'])? $password = $_REQUEST['password'] : $password = '';
		isset($_REQUEST['mobile_number'])? $mobile_number = $_REQUEST['mobile_number'] : $mobile_number = '';
		
		if(!empty($name) && !empty($lname) && !empty($email) && !empty($password)){
			$autopassword =  md5($password);
			$empid = 'DT-'.rand(000000,999999);
			$is_staff_id = 1;
			$NappUser['NappUser']['emp_id'] = $empid;
			$NappUser['NappUser']['name'] = $name;
			$NappUser['NappUser']['lname'] = $lname;			
			$NappUser['NappUser']['email'] = $email;
			#$NappUser['NappUser']['mobile_number'] = $mobile_number;
			$NappUser['NappUser']['password'] = $autopassword;
			$NappUser['NappUser']['address_5'] = $password;
			$NappUser['NappUser']['is_staff_id'] = $is_staff_id;
			$NappUser['NappUser']['insert_date'] = date('Y-m-d H;i:s');
			$this->NappUser->save($NappUser);
			
			$semployeeid =  base64_encode(base64_encode(base64_encode($email)));
			$staff_to = 'kal@durotechindustries.com.au';	
					
			#$staff_to = 'web@xoroglobal.com';				
			$staff_subject = SITENAME." :: New Employee Registered.";				
			$staff_template_name = 'staffmessage';
			$staff_variables = array('emp_id'=>$semployeeid,'name'=>$name.' '.$lname,'email'=>$email,'type'=>'register');
			try{
				$this->sendemail($staff_to , $staff_subject ,$staff_template_name,$staff_variables);
			}catch (Exception $e){	
			
			}	
							
			$data['status'] = 1;
			$data['message'] = 'Registered successfully';
			
		}else{
			$data['status'] = 0;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	
	function productionlogin(){
		
		$this->autoRender = false;
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		isset($_REQUEST['password'])? $password = $_REQUEST['password'] : $password = '';
		if(!empty($password) && !empty($email)){
			
			$this->NappUser->bindModel(
			array('belongsTo' => array('Department' => array(
				'className' => 'Department',			 
				'foreignKey' => 'dept_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));		
			$userArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.email'=>$email,'NappUser.password'=>md5($password))));
			
			if(!empty($userArr)){
				
				$emp['user_id'] =  $userArr['NappUser']['id'];
				$emp['emp_id'] =  $userArr['NappUser']['emp_id'];
				$emp['department'] =  $userArr['Department']['department_title'];
				$emp['name'] =  $userArr['NappUser']['name'];
				$emp['lname'] =  $userArr['NappUser']['lname'];
				$emp['email'] =  $userArr['NappUser']['email'];
				$emp['mobile_number'] =  $userArr['NappUser']['mobile_number'];
				$emp['insert_date'] =  $userArr['NappUser']['insert_date'];
				$emp['company'] =  $userArr['NappUser']['company'];
				$emp['is_active'] =  $userArr['NappUser']['is_active'];
				$emp['is_cpd_presentation'] =  $userArr['NappUser']['is_cpd_presentation'];
				$emp['is_natspec_presentation'] =  $userArr['NappUser']['is_natspec_presentation'];
				$emp['is_staff_id'] =  $userArr['NappUser']['is_staff_id'];
				$emp['country'] =  $userArr['NappUser']['country'];
							
				$data['status'] = 1;
				$data['data'] = $emp;
			}else{
				$data['status'] = 0;
				$data['message'] = 'wrong username or password';
			}	
		}else{
			$data['status'] = 0;
			$data['message'] = 'All parameters required';
		}	
		echo json_encode($data);
	}	
	
	function batchregisterlist(){

		$this->autoRender = false;
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = '';
		if(!empty($date)){
			
			$BatchRegister = $this->BatchRegister->find('all',array('conditions'=>array('BatchRegister.user_id'=>$user_id)));
			if(!empty($BatchRegister)){
				$getalldata = array();
				foreach($BatchRegister as $BatchRegisters){
					$getdata['date'] = $BatchRegisters['BatchRegister']['date'];
					$getdata['batch_no'] = $BatchRegisters['BatchRegister']['batch_no'];
					$getdata['product'] = $BatchRegisters['BatchRegister']['product'];
					$getdata['apearance'] = $BatchRegisters['BatchRegister']['apearance'];
					$getdata['t_degree_c'] = $BatchRegisters['BatchRegister']['t_degree_c'];
					$getdata['s_g'] = $BatchRegisters['BatchRegister']['s_g'];
					$getdata['check_test'] = $BatchRegisters['BatchRegister']['check_test'];
					$getdata['test_by'] = $BatchRegisters['BatchRegister']['test_by'];
					$getdata['created'] = $BatchRegisters['BatchRegister']['created'];
					$getalldata[] = $getdata;
					$data['status'] = 1;	
					$data['data'] = $getalldata;
				}	
			}else{
				$data['status'] = 0;	
				$data['message'] = 'No data available';
			}	
		}else{
			$data['status'] = 0;	
			$data['message'] = 'All parameters required';
		}
		echo json_encode($data);	
	}	
	
	function batchregister(){
		
		$this->autoRender = false;
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = '';
		isset($_REQUEST['date'])? $date = $_REQUEST['date'] : $date = '';
		isset($_REQUEST['batch_no'])? $batch_no = $_REQUEST['batch_no'] : $batch_no = '';
		isset($_REQUEST['product'])? $product = $_REQUEST['product'] : $product = '';
		isset($_REQUEST['apearance'])? $apearance = $_REQUEST['apearance'] : $apearance = '';
		isset($_REQUEST['t_degree_c'])? $t_degree_c = $_REQUEST['t_degree_c'] : $t_degree_c = '';
		isset($_REQUEST['s_g'])? $s_g = $_REQUEST['s_g'] : $s_g = '';
		isset($_REQUEST['check_test'])? $check_test = $_REQUEST['check_test'] : $check_test = '';
		isset($_REQUEST['test_by'])? $test_by = $_REQUEST['test_by'] : $test_by = '';
		if(!empty($date) && !empty($batch_no) && !empty($product) && !empty($apearance) && !empty($t_degree_c) && !empty($s_g) && !empty($check_test) && !empty($test_by)){
			
			$insert['BatchRegister']['user_id'] = $user_id;
			$insert['BatchRegister']['date'] = $date;
			$insert['BatchRegister']['batch_no'] = $batch_no;
			$insert['BatchRegister']['product'] = $product;
			$insert['BatchRegister']['apearance'] = $apearance;
			$insert['BatchRegister']['t_degree_c'] = $t_degree_c;
			$insert['BatchRegister']['s_g'] = $s_g;
			$insert['BatchRegister']['check_test'] = $check_test;
			$insert['BatchRegister']['test_by'] = $test_by;			
			$insert['BatchRegister']['created'] = date('Y-m-d H:i:s');			
			$this->BatchRegister->save($insert);
			
			$data['status'] = 1;	
			$data['message'] = 'saved successfully';
		}else{
			$data['status'] = 0;	
			$data['message'] = 'All parameters required';
		}
		echo json_encode($data);	
	}
	
	function batchcountsheetlist(){

		$this->autoRender = false;
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = '';
		if(!empty($date)){
			
			$BatchRegister = $this->BatchCountSheet->find('all',array('conditions'=>array('BatchCountSheet.user_id'=>$user_id)));
			if(!empty($BatchRegister)){
				$getalldata = array();
				foreach($BatchRegister as $BatchRegisters){
					$getdata['date'] = $BatchRegisters['BatchCountSheet']['date'];
					$getdata['employee_name'] = $BatchRegisters['BatchCountSheet']['employee_name'];
					$getdata['batch_number'] = $BatchRegisters['BatchCountSheet']['batch_number'];
					$getdata['product_name'] = $BatchRegisters['BatchCountSheet']['product_name'];
					$getdata['quantity'] = $BatchRegisters['BatchCountSheet']['quantity'];
					$getdata['no_of_pails'] = $BatchRegisters['BatchCountSheet']['no_of_pails'];
					$getdata['date_completed'] = $BatchRegisters['BatchCountSheet']['date_completed'];
					$getdata['signature'] = $BatchRegisters['BatchCountSheet']['signature'];
					$getdata['created'] = $BatchRegisters['BatchCountSheet']['created'];
					
					$getalldata[] = $getdata;
					$data['status'] = 1;	
					$data['data'] = $getalldata;
				}	
			}else{
				$data['status'] = 0;	
				$data['message'] = 'No data available';
			}	
		}else{
			$data['status'] = 0;	
			$data['message'] = 'All parameters required';
		}
		echo json_encode($data);	
	}
	
	function selectedclient(){
		
		$this->autoRender = false;
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = '';
		if(!empty($user_id)){
			
			$StaffClientArr = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$user_id),'fields'=>array('client_id')));
			
			$clientArr = $this->Client->find('all',array('conditions'=>array('Client.id'=>$StaffClientArr)));
			$clients = array();
			if(!empty($clientArr)){
				foreach($clientArr as $clientArrs){
					$client['id'] = $clientArrs['Client']['id'];
					$client['fname'] = $clientArrs['Client']['fname'];
					$client['lname'] = $clientArrs['Client']['lname'];
					$client['email'] = $clientArrs['Client']['email'];
					
					// get correct mobile phone number
					$mobile = $clientArrs['Client']['mobile'];
					$mobile = str_replace(' ','',$mobile);
					$mobile = str_replace('-','',$mobile);
					$mobile = str_replace('(','',$mobile);
					$mobile = str_replace(')','',$mobile); 
					
					if (strstr($mobile, '/'))
					{							
						$client['mobile'] = '';
						
					}else{ 
					
						$mobile = rtrim($mobile,'+');
						$countrycode = substr($mobile,0,2);
						if($countrycode == '91'){
						$client['mobile'] = '+'.$mobile;	
						}else{	
						$mobile = rtrim($mobile,'0');
						$mobile = rtrim($mobile,'61');					
						$client['mobile'] = '+61'.$mobile;
						}
					}
					
					#$client['landline'] = $clientArrs['Client']['landline'];
					$client['company'] = $clientArrs['Client']['company'];
					$client['address1'] = $clientArrs['Client']['address1'];
					$clients[] = $client;
				}
			}
			$data['status'] = 1;	
			$data['data'] = $clients;	
		}else{
			$data['status'] = 0;	
			$data['message'] = 'All parameters required';
		}
		echo json_encode($data);
	}	
	function batchcountsheet(){
		
		$this->autoRender = false;
		isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = '';
		isset($_REQUEST['employee_name'])? $employee_name = $_REQUEST['employee_name'] : $employee_name = '';
		isset($_REQUEST['date'])? $date = $_REQUEST['date'] : $date = '';
		isset($_REQUEST['batch_number'])? $batch_number = $_REQUEST['batch_number'] : $batch_number = '';
		isset($_REQUEST['product_name'])? $product_name = $_REQUEST['product_name'] : $product_name = '';
		isset($_REQUEST['quantity'])? $quantity = $_REQUEST['quantity'] : $quantity = '';
		isset($_REQUEST['no_of_pails'])? $no_of_pails = $_REQUEST['no_of_pails'] : $no_of_pails = '';
		isset($_REQUEST['date_completed'])? $date_completed = $_REQUEST['date_completed'] : $date_completed = '';
		isset($_REQUEST['signature'])? $signature = $_REQUEST['signature'] : $signature = '';
		
		if(!empty($user_id) && !empty($date) && !empty($employee_name) && !empty($batch_number) && !empty($product_name) && !empty($quantity) && !empty($no_of_pails) && !empty($date_completed)){
			
			$insert['BatchCountSheet']['user_id'] = $user_id;
			$insert['BatchCountSheet']['date'] = $date;
			$insert['BatchCountSheet']['employee_name'] = $employee_name;
			$insert['BatchCountSheet']['batch_number'] = $batch_number;
			$insert['BatchCountSheet']['product_name'] = $product_name;
			$insert['BatchCountSheet']['quantity'] = $quantity;
			$insert['BatchCountSheet']['no_of_pails'] = $no_of_pails;
			$insert['BatchCountSheet']['date_completed'] = $date_completed;
			$insert['BatchCountSheet']['signature'] = $signature;
			$insert['BatchCountSheet']['created'] = date('Y-m-d H:i:s');			
			$this->BatchCountSheet->save($insert);
			
			$data['status'] = 1;	
			$data['message'] = 'saved successfully';
		}else{
			$data['status'] = 0;	
			$data['message'] = 'All parameters required';
		}
		echo json_encode($data);	
	}
	

}
?>