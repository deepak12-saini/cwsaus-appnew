<?php 
App::uses('AppController','Controller');
class ClientsController extends AppController{
	
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Client','ClientType','NappUser','UserPermission','StaffClient','ClientComment','User','DialerNumber');
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function admin_commentdownload($id){
		
		$this->autoRender = false ;
		$this->checkAdminSession(); 
		$id = base64_decode(base64_decode($id));
		
		 $path = WWW_ROOT.'clientdoc/'.$id;

		if (file_exists($path)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($path));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($path));
			ob_clean();
			flush();
			readfile($path);
			exit;
		}else{

		}	
	}	
	function admin_addcomment($client_id=null){
		
		$this->layout='admin_new_layout';
		$this->set('title_for_layout',SITENAME.' Employee Comments');		
		$this->checkAdminSession(); 
		$user_id = $this->Session->read('User.id');
		if(!empty($this->request->data)){			
			if(!empty($_FILES['documents']['name'])){
				$name = $_FILES['documents']['name'];
				$tempname = $_FILES['documents']['tmp_name'];
				$path  = WWW_ROOT.'clientdoc/';
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$filename =  time().'_'.$name;										
				move_uploaded_file($tempname,$path.'/'.$filename);
				$insert['ClientComment']['documents'] = $filename;
			}	
			$insert['ClientComment']['comment'] = $this->request->data['comment'];
			$insert['ClientComment']['client_id'] =$client_id;
			$insert['ClientComment']['admin_id'] =$user_id;
			$insert['ClientComment']['type'] =1; // employee
			$insert['ClientComment']['created'] = date('Y-m-d H:i:s');
			
			$this->ClientComment->save($insert);
			$this->Session->setFlash('Comment posted successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('comment/'.$client_id);	
		}
		
		$this->set('client_id',$client_id);
	}	
	
	function admin_comment($client_id=null){
		
		$this->layout='admin_new_layout';
		$this->set('title_for_layout',SITENAME.' Employee Comments');		
		$this->checkAdminSession(); 
		
		$this->ClientComment->bindModel(
			array('belongsTo' => array('Client' => array(
			'className' => 'Client',    
			'foreignKey' => 'client_id',    
			'conditions' => array(),
			'fields' => array('fname','lname'),
			'order' => array(),
		))));	
		$this->ClientComment->bindModel(
			array('belongsTo' => array('User' => array(
			'className' => 'User',    
			'foreignKey' => 'admin_id',    
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
		$this->ClientComment->bindModel(
			array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',    
			'foreignKey' => 'emp_id',    
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$clientArr = $this->ClientComment->find('all',array('conditions'=>array('ClientComment.client_id'=>$client_id),'order'=>array('ClientComment.id'=>'DESC')));
		$this->set('clientArr',$clientArr);
		$this->set('client_id',$client_id);
		/* echo '<pre>';
		print_r($clientArr);
		die(); */
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Admin customer list
	****/
	function admin_assign(){
		$this->checkAdminSession(); 
		$this->autoRender  = false;
		
		if(!empty($this->request->data)){
			
			
			if(!empty($this->request->data['selectids'])){
				$staff_id = $this->request->data['client_id'];
			
				foreach($this->request->data['selectids'] as $client_id){
					$StaffClientArr = $this->StaffClient->find('first',array('conditions'=>array('StaffClient.client_id'=>$client_id,'StaffClient.staff_id'=>$staff_id)));	
					if(empty($StaffClientArr)){
						$insert['StaffClient']['id']	= 	'';			
						$insert['StaffClient']['staff_id']	= 	$staff_id;			
						$insert['StaffClient']['client_id']	= 	$client_id;	
						$this->StaffClient->save($insert);	
					}
				}			
			}	
			$this->redirect('index');	
		}else{
			$this->redirect('index');
		}	
	}	
	public function admin_index($id=null){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' customer list');		
		$this->checkAdminSession(); 
		
		$StaffClientArr = array();
		$clientId = $this->Session->read('client.id');
		if($id == 'clear'){
			$this->Session->delete('client');
			$this->redirect('index');	
		}else if(!empty($id) && ($id != 'clear')){
			$this->Session->write('client.id',$id);
			$clientId = $id;
			$StaffClientArr = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$id),'fields'=>array('client_id')));		
		
		}else if(!empty($clientId)){			
			$StaffClientArr = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$clientId),'fields'=>array('client_id')));		
		}	
		
		
		$this->set('clientId', $clientId);
		$this->set('StaffClientArr', $StaffClientArr);
		// echo '<pre>';
		// print_r($StaffClientArr);
		// die();
				
		$this->Client->bindModel(
		array('belongsTo' => array('ClientType' => array(
		'className' => 'ClientType',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array(),
		'order' => array(),
		))));	
		
		$clientArr  = $this->Session->read('client');
		
		$category_id = '';
		$search = '';
		$client_id = '';
		if(!empty($this->request->data)){
			
			
			$category_id = $this->request->data['category_id'];
			$search = $this->request->data['search'];
			$client_id = $this->request->data['client_id'];
						
			if(!empty($client_id)){				
				$searchclient = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$client_id),'fields'=>array('client_id')));
				$this->Session->write('client.client_id',$client_id);
			}else{
				$this->Session->delete('client.client_id');
			}			
			// echo '<pre>';
			// print_r($searchclient);
			// die();
			
			if(!empty($category_id)){
				$this->Session->write('client.category_id',$category_id);
			}else{
				$this->Session->delete('client.category_id');
			}	
			
			if(!empty($search)){
				$this->Session->write('client.search',$search);
			}else{
				$this->Session->delete('client.search');
			}	
			
			if(!empty($category_id) && !empty($search)  && !empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient,'Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($search)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient),'page' => 1, 'limit' => 300);	
			}else if(!empty($category_id)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);	
			}else if(!empty($search)){
				$this->paginate = array('conditions'=>array('OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);	
			}else if(empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>0),'page' => 1, 'limit' => 300);	
			}	
		
		}else if(!empty($clientArr)){
			
			$client_id = $this->Session->read('client.client_id');
			if(!empty($client_id)){				
				$searchclient = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$client_id),'fields'=>array('client_id')));
				$this->Session->write('client.client_id',$client_id);
			}else{
				$this->Session->delete('client.client_id');
			}	
			
			
			$category_id = $this->Session->read('client.category_id');
			$search = $this->Session->read('client.search');
			
			if(!empty($category_id) && !empty($search)  && !empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient,'Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($search)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>$searchclient),'page' => 1, 'limit' => 300);	
			}else if(!empty($category_id)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);	
			}else if(!empty($search)){
				$this->paginate = array('conditions'=>array('OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);	
			}else{	
				$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 300,'order'=>array('Client.fname'=>'asc'));
			}
		
		}else{	
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 300,'order'=>array('Client.fname'=>'asc'));
		}
		$this->Client->bindModel(
			array('hasMany' => array('StaffClient' => array(
			'className' => 'StaffClient',    
			'foreignKey' => 'client_id',    
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->StaffClient->bindModel(
			array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',    
			'foreignKey' => 'staff_id',    
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->Client->recursive = 3;
		$clientArr = $this->Paginator->paginate('Client');	

		// echo '<pre>';
		// print_r($clientArr);
		// die();	
		
		$this->set('clientArr', $clientArr);	
		
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
		
		$this->set('category_id', $category_id);
		$this->set('search', $search);
		
		$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);		
		$this->set('client_id', $client_id);
			
	}
	
	
	
	/**
	* Author:Ranjit
	* Discription:Add Client
	* @return void
*/
	public function admin_import() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Import Customer');
		$this->checkAdminSession(); 
		if (!empty($this->request->data)) {			
			
			if(!empty($_FILES['file']['name'])){ 
				$name = $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];				
				$path  = WWW_ROOT.'files/'.$name;
				move_uploaded_file($tmp_name,$path);
				$i =0; 
				if (($openfile = fopen($path, "r")) !== FALSE) {
					while ($getdata = fgetcsv($openfile, 1000, ",")) {	
						if($i > 0){
							
							$clientArr = $this->Client->find('first',array('conditions'=>array('Client.mobile'=>$getdata[2],'Client.email'=>$getdata[5])));
							if(empty($clientArr)){
								$clients['Client']['id'] = '';
								$clients['Client']['category_id'] = $this->request->data['Client']['category_id'];
								$clients['Client']['company'] = $getdata[0];
								$clients['Client']['fname'] = $getdata[1];
								$clients['Client']['mobile'] = $getdata[2];
								$clients['Client']['landline'] = $getdata[3];
								$clients['Client']['address1'] = $getdata[4];
								$clients['Client']['email'] = $getdata[5];
								isset($getdata[6])? $clients['Client']['website'] = $getdata[6] : $clients['Client']['website'] = '';
								$clients['Client']['status'] = 1;
								$clients['Client']['created'] = date('Y-m-d H:i:s');
								$this->Client->save($clients);	
								// echo '<pre>';
								// print_r($clients);
								// echo '</pre>';
							}							
						}
						$i++;
					}
					#die();
					$this->Session->setFlash('The customer has been saved','default',array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));	
				}					
			}
		}
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
	}
	
	
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New customer');
		$this->checkAdminSession(); 
		if ($this->request->is('post')) {			
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash('The customer has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The customer could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
	}
	
	/**
	* Author:Ranjit
	* Discription:Edit The Category
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
	
	public function admin_edit($id=null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New customer');
		$this->checkAdminSession(); 
		if (!empty($this->request->data)) {			
			$this->request->data['Client']['id'] = $id;
		
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash('The customer has been updated','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The customer could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		$clientArr = $this->Client->find('first',array('conditions'=>array('Client.id'=>$id)));
		$this->request->data = $clientArr;
		$this->set('clientArr', $clientArr);
		
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
		
	}

	/**
 	* Author:Ranjit
	* Discription:Delete The Category
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_delete($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Delete');
		$this->checkAdminSession(); 
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid Category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash('The Category has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Category could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	 
	
	public function admin_clienttype_add(){		
		$this->checkAdminSession(); 
		$this->layout='';		
		
		if(!empty($this->request->data)){
		
			if($this->ClientType->save($this->request->data)){
				return $this->redirect(array('action' => 'clienttype'));
			}	
		}	
	}
	public function admin_clienttype_edit($id){		
		$this->checkAdminSession(); 
		$this->layout='';		
		
		if(!empty($this->request->data)){
			$this->request->data['ClientType']['id'] = $id;
			if($this->ClientType->save($this->request->data)){
				return $this->redirect(array('action' => 'clienttype'));
			}	
		}	
		$ClientTypeArr = $this->ClientType->find('first',array('conditions'=>array('ClientType.id'=>$id)));
		$this->set('ClientTypeArr', $ClientTypeArr);
	}
	 	
	
	public function admin_clienttype(){		
		$this->checkAdminSession(); 
		$this->layout='';		
		
		$ClientTypeArr = $this->Paginator->paginate('ClientType');		
		$this->set('ClientTypeArr', $ClientTypeArr);
		
	}
	public function edit($id=null) {
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add New customer');
		$this->checkSatffSession(); 
		$user_id = $this->Session->read('Customer.id');
		if (!empty($this->request->data)) {			
			$this->request->data['Client']['id'] = $id;
		
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash('The customer has been updated','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The customer could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		$clientArr = $this->Client->find('first',array('conditions'=>array('Client.user_id'=>$user_id,'Client.id'=>$id)));
		if(empty($clientArr)){
			$this->Session->setFlash('Sorry, you have no permission.','default',array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->data = $clientArr; 
		$this->set('clientArr', $clientArr);
		
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
		$this->set('user_id', $user_id);
		
	}
	public function add() {
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add New customer');
		$this->checkSatffSession(); 
		$user_id = $this->Session->read('Customer.id');
		if ($this->request->is('post')) {	
			
			/* echo '<pre>';
			print_r($this->request->data);
			die(); */
			$this->request->data['Client']['user_id'] = $user_id;
			//$this->request->data['Client']['category_id'] = 13;
			if ($this->Client->save($this->request->data)) {
				$clientId = $this->Client->id;
				
				$insert['StaffClient']['id']	= 	'';			
				$insert['StaffClient']['staff_id']	= 	$user_id;			
				$insert['StaffClient']['client_id']	= 	$clientId;	
				$this->StaffClient->save($insert);	
				
				$this->Session->setFlash('The customer has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The customer could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
	}
	
	public function index($id=null){		
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' customer list');		
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
	
		$this->set('user_id', $user_id);
		$StaffClientArr = array();		
		if($id == 'clear'){
			$this->Session->delete('client');
			$this->redirect('index');	
		}
		$StaffClientArr = $this->StaffClient->find('list',array('conditions'=>array('StaffClient.staff_id'=>$user_id),'fields'=>array('client_id')));
	
		
		$this->Client->bindModel(
		array('belongsTo' => array('ClientType' => array(
		'className' => 'ClientType',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array(),
		'order' => array(),
		))));	
		
		$clientArr  = $this->Session->read('client');
		
		$category_id = '';
		$search = '';
		$client_id = '';
		if(!empty($this->request->data)){
			
			
			$category_id = $this->request->data['category_id'];
			$search = rtrim($this->request->data['search'],' ');
				
			// echo '<pre>';
			// print_r($searchclient);
			// die();
			
			if(!empty($category_id)){
				$this->Session->write('client.category_id',$category_id);
			}else{
				$this->Session->delete('client.category_id');
			}	
			
			if(!empty($search)){
				$this->Session->write('client.search',$search);
			}else{
				$this->Session->delete('client.search');
			}	
			
			if(!empty($category_id) && !empty($search)  && !empty($StaffClientArr)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($StaffClientArr)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($search)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);	
			}else if(!empty($search)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);	
			}else if(empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>0),'page' => 1, 'limit' => 300);	
			}	
		
		}else if(!empty($clientArr)){
						
			$category_id = $this->Session->read('client.category_id');
			$search = $this->Session->read('client.search');
			
			if(!empty($category_id) && !empty($search)  && !empty($StaffClientArr)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($StaffClientArr)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id) && !empty($search)){
				$this->paginate = array('conditions'=>array('Client.category_id'=>$category_id,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);				
			}else if(!empty($category_id)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'Client.category_id'=>$category_id),'page' => 1, 'limit' => 300);	
			}else if(!empty($search)){
				$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr,'OR'=>array('Client.mobile LIKE'=>'%'.$search.'%','Client.fname LIKE'=>'%'.$search.'%','Client.email LIKE'=>'%'.$search.'%')),'page' => 1, 'limit' => 300);	
			}else if(empty($searchclient)){
				$this->paginate = array('conditions'=>array('Client.id'=>0),'page' => 1, 'limit' => 300);	
			}	
		}else{	
			$this->paginate = array('conditions'=>array('Client.id'=>$StaffClientArr),'page' => 1, 'limit' => 300,'order'=>array('Client.fname'=>'asc'));
		}
		$this->Client->bindModel(
			array('hasMany' => array('StaffClient' => array(
			'className' => 'StaffClient',    
			'foreignKey' => 'client_id',    
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->StaffClient->bindModel(
			array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',    
			'foreignKey' => 'staff_id',    
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$this->Client->recursive = 3;
		$clientArr = $this->Paginator->paginate('Client');	

		// echo '<pre>';
		// print_r($clientArr);
		// die();	
		
		$this->set('clientArr', $clientArr);	
		
		$ClientTypeArr = $this->ClientType->find('all');
		$this->set('ClientTypeArr', $ClientTypeArr);
		
		$this->set('category_id', $category_id);
		$this->set('search', $search);
		
		$userper = $this->UserPermission->find('list',array('conditions'=>array('UserPermission.meta_val'=>'sr'),'fields'=>array('user_id')));		
		$cuser = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1,'NappUser.id'=>$userper),'fields'=>array('id','name','lname')));
		$this->set('cuser', $cuser);		
		$this->set('client_id', $client_id);
			
	}
	
	function addcomment($client_id=null){
		
		$this->layout='admin_new_layout';
		$this->set('title_for_layout',SITENAME.' Employee Comments');		
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
		if(!empty($this->request->data)){			
			if(!empty($_FILES['documents']['name'])){
				$name = $_FILES['documents']['name'];
				$tempname = $_FILES['documents']['tmp_name'];
				$path  = WWW_ROOT.'clientdoc/';
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$filename =  time().'_'.$name;										
				move_uploaded_file($tempname,$path.'/'.$filename);
				$insert['ClientComment']['documents'] = $filename;
			}	
			$insert['ClientComment']['comment'] = $this->request->data['comment'];
			$insert['ClientComment']['client_id'] =$client_id;
			$insert['ClientComment']['emp_id'] =$user_id;
			$insert['ClientComment']['type'] =0; // employee
			$insert['ClientComment']['created'] = date('Y-m-d H:i:s');
			
			$this->ClientComment->save($insert);
			$this->Session->setFlash('Comment posted successfully','default',array('class' => 'alert alert-success'));
			$this->redirect('comment/'.$client_id);	
		}
		
		$this->set('client_id',$client_id);
	}	
	
	function comment($client_id=null){
		
		$this->layout='admin_new_layout';
		$this->set('title_for_layout',SITENAME.' Employee Comments');		
		$this->checkSatffSession(); 
		
		$this->ClientComment->bindModel(
			array('belongsTo' => array('Client' => array(
			'className' => 'Client',    
			'foreignKey' => 'client_id',    
			'conditions' => array(),
			'fields' => array('fname','lname'),
			'order' => array(),
		))));	
		$this->ClientComment->bindModel(
			array('belongsTo' => array('User' => array(
			'className' => 'User',    
			'foreignKey' => 'admin_id',    
			'conditions' => array(),
			'fields' => array('name'),
			'order' => array(),
		))));
		$this->ClientComment->bindModel(
			array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',    
			'foreignKey' => 'emp_id',    
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		
		$clientArr = $this->ClientComment->find('all',array('conditions'=>array('ClientComment.client_id'=>$client_id),'order'=>array('ClientComment.id'=>'DESC')));
		$this->set('clientArr',$clientArr);
		$this->set('client_id',$client_id);
	
	}
	function addclientdialers(){
		$this->autoRender = false;
		if(!empty($_REQUEST['client_list'])){
			$clients = $this->Client->find('all',array('conditions'=>array('Client.id'=>$_REQUEST['client_list']),'fields'=>array('Client.id','Client.mobile')));
			
			if(!empty($clients)){
				foreach($clients as $client){
					if($client['Client']['mobile'] != ''){
						$dialclients = $this->DialerNumber->find('first',array('conditions'=>array('DialerNumber.status'=>0,'DialerNumber.client_id'=>$client['Client']['id'])));
						
						if(empty($dialclients)){
							$client['Client']['mobile'] = str_replace(array('+',' '),'',$client['Client']['mobile']);
							$firstonecharacter = substr($client['Client']['mobile'], 0, 1);
							if($firstonecharacter==0 || $firstonecharacter=='0'){
								$client['Client']['mobile'] = '61'.ltrim($client['Client']['mobile'],0);
							}
							$client_arr['DialerNumber']['id'] = '';
							$client_arr['DialerNumber']['client_id'] = $client['Client']['id'];
							$client_arr['DialerNumber']['phone'] = $client['Client']['mobile'];
							$client_arr['DialerNumber']['comments'] = '';
							$client_arr['DialerNumber']['status'] = 0;
							$client_arr['DialerNumber']['created'] = date("Y-m-d H:i:s");
							$this->DialerNumber->save($client_arr);
						}
					}
				}
			}
		}
	}

}
?>