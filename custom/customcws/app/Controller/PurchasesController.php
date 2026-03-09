<?php 
App::uses('AppController','Controller');
class PurchasesController extends AppController{
	
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('User','Purchase','PurchaseRequirement','NappUser'); 
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function add(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Purchase Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
						
			$item_details = $this->request->data['Purchase']['item_details'];
			$unique_id = 1000;	
			$PurchaseArr = 	$this->Purchase->find('first',array('order'=>array('Purchase.id'=>'DESC')));
			if(!empty($PurchaseArr)){
				$unique_id = 1000 + $PurchaseArr['Purchase']['id'];
			}	
			$unique_id = 'Rev-'.$unique_id;		
			$this->request->data['Purchase']['unique_id'] = $unique_id;
			$this->request->data['Purchase']['prepared_by'] = $userid;
			$this->request->data['Purchase']['created'] = date('Y-m-d H:i:s');
			if($this->Purchase->save($this->request->data)){
				$purchase_id = $this->Purchase->id;
				if(!empty($this->request->data['item_name'])){
					$i=0;				
					foreach($this->request->data['item_name'] as $item_name){
						
						$PurchaseRequirement['PurchaseRequirement']['id'] = ''; 
						$PurchaseRequirement['PurchaseRequirement']['purchase_id'] = $purchase_id; 
						$PurchaseRequirement['PurchaseRequirement']['item_name'] = $item_name; 
						$PurchaseRequirement['PurchaseRequirement']['comments'] = $this->request->data['comments'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['description_item'] = $this->request->data['description_item'][$i]; 
						$this->PurchaseRequirement->save($PurchaseRequirement);									
						$i++;
					}	
				}									
				$permitted_by = $this->request->data['Purchase']['permitted_by'];
				$employeArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$permitted_by)));	
				$receivername = $employeArr['NappUser']['name'].' '.$employeArr['NappUser']['lname']; 
				$receiveremail = $employeArr['NappUser']['email'];			
				$url = SITEURL.'purchases/autologin/'.base64_encode($employeArr['NappUser']['id']);
				$subject = SITENAME.':- '.$sendername.' has made request ('.$unique_id.')';
				$template_name = 'sendrequest';					
				$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$receivername,'url'=>$url,'item_details'=>$item_details);
				try{
					$this->sendemail($receiveremail,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}
				
				$this->Session->setFlash('Request has been created successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');	
			}	
		}
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);	
				
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
					$this->redirect('/purchases');
				
				}
			}else{
				$this->redirect('/login');	
			}
		}else{
			$this->redirect('/login');	
		}	
	}	
	
	function received($id=null){
		
		$this->checkSatffSession(); 
		$this->autoRender =false;
		
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$PurchaseArr = $this->Purchase->find('first',array('conditions'=>array('Purchase.id'=>$id)));
		if(!empty($PurchaseArr)){
			
			$update['Purchase']['id'] = $id;
			$update['Purchase']['status'] = 2;
			$update['Purchase']['name_of_receiver'] = $sendername;
			$this->Purchase->save($update);
			
			$authorized_by = $PurchaseArr['Purchase']['authorized_by'];
			$unique_id = $PurchaseArr['Purchase']['unique_id'];
			$item_details = $PurchaseArr['Purchase']['item_details'];
			// send email to completion this task

				$subject = SITENAME.' :- Purchase Request('.$unique_id.') has been closed by '.$sendername;				
				if(!empty($PurchaseArr['NappUser_1']['email'])){
					
					$id_2 = $PurchaseArr['NappUser_1']['id'];
					#$email_2 = $PurchaseArr['NappUser_1']['email'];						
					$email_2 = 'web@xoroglobal.com';						
					$name_2 = $PurchaseArr['NappUser_1']['name'].' '.$PurchaseArr['NappUser_1']['lname'];					
					$url = SITEURL.'purchases/autologin/'.base64_encode($id_2);
					$template_name = 'closerequest';					
					$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_2,'url'=>$url,'item_details'=>$item_details);
					try{
						$this->sendemail($email_2,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}
														
				}	
				
				if(!empty($PurchaseArr['NappUser']['email'])){
					$id_1 = $PurchaseArr['NappUser']['id'];
					$email_1 = $PurchaseArr['NappUser']['email'];
					$name_1 = $PurchaseArr['NappUser']['name'].' '.$PurchaseArr['NappUser']['lname'];
					
					$url = SITEURL.'purchases/autologin/'.base64_encode($id_1);
					$template_name = 'closerequest';					
					$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_1,'url'=>$url,'item_details'=>$item_details);
					try{
						$this->sendemail($email_1,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}					
				} 
			
			 	if($authorized_by > 0){
					$NappUser  = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$authorized_by)));
					
					$id_3 = $NappUser['NappUser']['id'];
					$email_3 = $NappUser['NappUser']['email'];
					$name_3 = $NappUser['NappUser']['name'].' '.$NappUser['NappUser']['lname'];
					
					$url = SITEURL.'purchases/autologin/'.base64_encode($id_3);
					$template_name = 'closerequest';					
					$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_3,'url'=>$url,'item_details'=>$item_details);
					try{
						$this->sendemail($email_3,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}					
				} 
		
				$this->Session->setFlash('Received successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
		}else{
			 $this->redirect('index');
		}	
		
	}
	
	function process($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Purchase Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$PurchaseArr = $this->Purchase->find('first',array('conditions'=>array('Purchase.id'=>$id)));		
		$this->set('PurchaseArr',$PurchaseArr);
		$unique_id = $PurchaseArr['Purchase']['unique_id'];
		$item_details = $PurchaseArr['Purchase']['item_details'];
		if(!empty($this->request->data)){
			
			$status = $this->request->data['Purchase']['status'];
			$authorized_by = $this->request->data['Purchase']['authorized_by'];
			$final_result = $this->request->data['Purchase']['final_result'];	 
			$this->request->data['Purchase']['id'] = $id;
			if($this->Purchase->save($this->request->data)){
			
				// send email to authorization user
				if(($authorized_by > 0) && ($status < 2)){
					$subject = SITENAME.' :- Purchase Request('.$unique_id.') has been approved by '.$sendername;
					$NappUser  = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$authorized_by)));
								
					
					$email_2 = $NappUser['NappUser']['email'];						
					$name_2 = $NappUser['NappUser']['name'].' '.$NappUser['NappUser']['lname'];					
					$url = SITEURL.'purchases/autologin/'.base64_encode($authorized_by);
					$template_name = 'requestassign';					
					$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_2,'url'=>$url,'item_details'=>$item_details);
					try{
						$this->sendemail($email_2,$subject,$template_name,$variables);
					}catch (Exception $e){
						
					}
								
				}
						
				// send email to completion this task
				if($status == 1){
					$subject = SITENAME.' :- Purchase Request('.$unique_id.') has been approved by '.$sendername;
					
					if(!empty($PurchaseArr['NappUser_1']['email'])){
						
						$id_2 = $PurchaseArr['NappUser_1']['id'];
						$email_2 = $PurchaseArr['NappUser_1']['email'];						
						$name_2 = $PurchaseArr['NappUser_1']['name'].' '.$PurchaseArr['NappUser_1']['lname'];					
						$url = SITEURL.'purchases/autologin/'.base64_encode($id_2);
						$template_name = 'completiontask';					
						$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_2,'url'=>$url,'item_details'=>$item_details);
						try{
							$this->sendemail($email_2,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}
															
					}	
					
				 	if(!empty($PurchaseArr['NappUser']['email'])){
						$id_1 = $PurchaseArr['NappUser']['id'];
						$email_1 = $PurchaseArr['NappUser']['email'];
						$name_1 = $PurchaseArr['NappUser']['name'].' '.$PurchaseArr['NappUser']['lname'];
						
						$url = SITEURL.'purchases/autologin/'.base64_encode($id_1);
						$template_name = 'completiontask';					
						$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_1,'url'=>$url,'item_details'=>$item_details);
						try{
							$this->sendemail($email_1,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}					
					}
				
					if($authorized_by > 0){
						$NappUser  = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$authorized_by)));
						
						$id_3 = $NappUser['NappUser']['id'];
						$email_3 = $NappUser['NappUser']['email'];
						$name_3 = $NappUser['NappUser']['name'].' '.$NappUser['NappUser']['lname'];
						
						$url = SITEURL.'purchases/autologin/'.base64_encode($id_3);
						$template_name = 'completiontask';					
						$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$name_3,'url'=>$url,'item_details'=>$item_details);
						try{
							$this->sendemail($email_3,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}					
					} 
				}	
			}

			$this->Session->setFlash('Request updated successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('index');	
		}
		
		$this->request->data =  $PurchaseArr;  	
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);
	}	
	
	function edit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Purchase Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
			
			$item_details = $this->request->data['Purchase']['item_details'];
		
			$this->request->data['Purchase']['prepared_by'] = $userid;
			$this->request->data['Purchase']['id'] = $id;
			$this->request->data['Purchase']['created'] = date('Y-m-d H:i:s');
			if($this->Purchase->save($this->request->data)){
				$this->PurchaseRequirement->query('delete from purchase_requirements where purchase_id = '.$id.' ');
				if(!empty($this->request->data['item_name'])){
					$i=0;				
					foreach($this->request->data['item_name'] as $item_name){
						
						$PurchaseRequirement['PurchaseRequirement']['id'] = ''; 
						$PurchaseRequirement['PurchaseRequirement']['purchase_id'] = $id; 
						$PurchaseRequirement['PurchaseRequirement']['item_name'] = $item_name; 
						$PurchaseRequirement['PurchaseRequirement']['comments'] = $this->request->data['comments'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['description_item'] = $this->request->data['description_item'][$i]; 
						$this->PurchaseRequirement->save($PurchaseRequirement);									
						$i++;
					}	
				}	
					
				$this->Session->setFlash('Request has been created successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('index');	
			}	
		}
		
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);	
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$PurchaseArr = $this->Purchase->find('first',array('conditions'=>array('Purchase.id'=>$id)));
		// echo '<pre>';
		// print_r($PurchaseArr);
		// die();
		$this->set('PurchaseArr',$PurchaseArr);
		$this->request->data =  $PurchaseArr;	
	}	
	
	function index(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Purcashes List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->Purchase->recursive = 2;
		$this->paginate = array('conditions'=>array('Purchase.purchase_type'=>0,'or'=>array('Purchase.permitted_by'=>$userid,'Purchase.prepared_by'=>$userid,'Purchase.authorized_by'=>$userid)),'order'=>array('Purchase.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$purchaseArr = $this->Paginator->paginate('Purchase');	
		$this->set('purchaseArr',$purchaseArr);
		
		
	}
	function admin_resource_requirement(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Resource Requirement List');		
		$this->checkAdminSession(); 
		
		$userid = $this->Session->read('Customer.id');		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->Purchase->recursive = 2;
		$this->paginate = array('conditions'=>array('Purchase.purchase_type'=>1),'order'=>array('Purchase.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$purchaseArr = $this->Paginator->paginate('Purchase');	
		$this->set('purchaseArr',$purchaseArr);
		
	}
	
	
	function admin_index(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Purcashes List');		
		$this->checkAdminSession(); 
		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->Purchase->recursive = 2;
		$this->paginate = array('conditions'=>array('Purchase.purchase_type'=>0),'order'=>array('Purchase.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$purchaseArr = $this->Paginator->paginate('Purchase');	
		$this->set('purchaseArr',$purchaseArr);
		
		
	}
	
	function resource_process($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Approved / Descline Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$PurchaseArr = $this->Purchase->find('first',array('conditions'=>array('Purchase.id'=>$id)));		
		$this->set('PurchaseArr',$PurchaseArr);
		$unique_id = $PurchaseArr['Purchase']['unique_id'];
		$item_details = $PurchaseArr['Purchase']['item_details'];
		if(!empty($this->request->data)){
			if($this->request->data['Purchase']['status'] == 1){
				$this->request->data['Purchase']['purchase_type'] = 0;
			}	
			$this->request->data['Purchase']['id'] = $id;
			if($this->Purchase->save($this->request->data)){
				if($this->request->data['Purchase']['status'] == 0){
					$deleteid = '';
					if(!empty($this->request->data['status'])){
						foreach($this->request->data['status'] as $key=>$ids){
							$deleteid  .=  $key.',';					
							$PurchaseRequirement['PurchaseRequirement']['id'] = $key; 
							$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$key][0]; 
							$this->PurchaseRequirement->save($PurchaseRequirement);						
						}
						$deleteid = rtrim($deleteid,',');		
						if(!empty($deleteid)){	
							$this->PurchaseRequirement->query('delete from purchase_requirements where purchase_id = '.$id.' and id NOT IN ('.$deleteid.')');
						}
					}	
				}else{
					$deleteid = '';
					if(!empty($this->request->data['status'])){
						foreach($this->request->data['status'] as $key=>$ids){
							$PurchaseRequirementArr = $this->PurchaseRequirement->find('first',array('conditions'=>array('PurchaseRequirement.id'=>$key)));
														
							$deleteid  .=  $key.',';					
							$PurchaseRequirement['PurchaseRequirement']['id'] = $key; 
							$PurchaseRequirement['PurchaseRequirement']['item_name'] = $PurchaseRequirementArr['PurchaseRequirement']['resource_requirement']; 
							$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$key][0]; 
							$this->PurchaseRequirement->save($PurchaseRequirement);						
						}
						$deleteid = rtrim($deleteid,',');		
						if(!empty($deleteid)){	
							$this->PurchaseRequirement->query('delete from purchase_requirements where purchase_id = '.$id.' and id NOT IN ('.$deleteid.')');
						} 
					}
				}	
				// echo '<pre>';
				// print_r($this->request->data);
				// die();
			}

			$this->Session->setFlash('Request updated successfully.','default',array('class' => 'alert alert-success'));
			if($this->request->data['Purchase']['status'] == 1){
				$this->redirect('index');	
			}else{
				$this->redirect('resource_requirement');	
			}	
		}
		
		$this->request->data =  $PurchaseArr;  	
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);
	}	
	
	function resource_delete($id=null){
		
		$this->autoRender = false;
		$this->checkSatffSession(); 
		if($this->Purchase->delete($id)){
			$this->Session->setFlash('Request has been deleted successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('resource_requirement');	
		}	
	}	
	
	function resource_edit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Purchase Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
			
			$item_details = $this->request->data['Purchase']['item_details'];
		
			$this->request->data['Purchase']['prepared_by'] = $userid;
			$this->request->data['Purchase']['id'] = $id;
			$this->request->data['Purchase']['created'] = date('Y-m-d H:i:s');
			if($this->Purchase->save($this->request->data)){
				$this->PurchaseRequirement->query('delete from purchase_requirements where purchase_id = '.$id.' ');
				if(!empty($this->request->data['resource_requirement'])){
					$i=0;				
					foreach($this->request->data['resource_requirement'] as $resource_requirement){
						
						$PurchaseRequirement['PurchaseRequirement']['id'] = ''; 
						$PurchaseRequirement['PurchaseRequirement']['purchase_id'] = $id; 
						$PurchaseRequirement['PurchaseRequirement']['resource_requirement'] = $resource_requirement; 
						$PurchaseRequirement['PurchaseRequirement']['purpose_project'] = $this->request->data['purpose_project'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['time'] = $this->request->data['time'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['budget'] = $this->request->data['budget'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['remark'] = $this->request->data['remark'][$i]; 
						// echo '<pre>';
						// print_r($PurchaseRequirement);
						// die();
						$this->PurchaseRequirement->save($PurchaseRequirement);									
						$i++;
					}	
				}	
					
				$this->Session->setFlash('Request has been created successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('resource_requirement');	
			}	
		}
		
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);	
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$PurchaseArr = $this->Purchase->find('first',array('conditions'=>array('Purchase.id'=>$id)));
		// echo '<pre>';
		// print_r($PurchaseArr);
		// die();
		$this->set('PurchaseArr',$PurchaseArr);
		$this->request->data =  $PurchaseArr;	
	}
	
	// resource requirement
	
	function resource_add(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add Purchase Request');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');		
		$sendername = ucfirst($name);	
		
		if(!empty($this->request->data)){
			
			
						
			$item_details = $this->request->data['Purchase']['item_details'];
			$unique_id = 1000;	
			$PurchaseArr = 	$this->Purchase->find('first',array('order'=>array('Purchase.id'=>'DESC')));
			if(!empty($PurchaseArr)){
				$unique_id = 1000 + $PurchaseArr['Purchase']['id'];
			}	
			$unique_id = 'Rev-'.$unique_id;		
			$this->request->data['Purchase']['unique_id'] = $unique_id;
			$this->request->data['Purchase']['prepared_by'] = $userid;
			$this->request->data['Purchase']['purchase_type'] = 1;
			$this->request->data['Purchase']['created'] = date('Y-m-d H:i:s');
		
			if($this->Purchase->save($this->request->data)){
				$purchase_id = $this->Purchase->id;
				if(!empty($this->request->data['resource_requirement'])){
					$i=0;				
					foreach($this->request->data['resource_requirement'] as $resource_requirement){
						
						$PurchaseRequirement['PurchaseRequirement']['id'] = ''; 
						$PurchaseRequirement['PurchaseRequirement']['purchase_id'] = $purchase_id; 
						$PurchaseRequirement['PurchaseRequirement']['resource_requirement'] = $resource_requirement; 
						$PurchaseRequirement['PurchaseRequirement']['purpose_project'] = $this->request->data['purpose_project'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['quantity'] = $this->request->data['quantity'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['time'] = $this->request->data['time'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['budget'] = $this->request->data['budget'][$i]; 
						$PurchaseRequirement['PurchaseRequirement']['remark'] = $this->request->data['remark'][$i]; 
						// echo '<pre>';
						// print_r($PurchaseRequirement);
						// die();
						$this->PurchaseRequirement->save($PurchaseRequirement);									
						$i++;
					}	
				}									
				$permitted_by = $this->request->data['Purchase']['permitted_by'];
				$employeArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$permitted_by)));	
				$receivername = $employeArr['NappUser']['name'].' '.$employeArr['NappUser']['lname']; 
				$receiveremail = $employeArr['NappUser']['email'];			
				$url = SITEURL.'purchases/autologin/'.base64_encode($employeArr['NappUser']['id']);
				$subject = SITENAME.':- '.$sendername.' has made request ('.$unique_id.') for resources';
				$template_name = 'sendrequest';					
				$variables = array('unique_id'=>$unique_id,'sendername'=>$sendername,'receivername'=>$receivername,'url'=>$url,'item_details'=>$item_details);
				try{
					$this->sendemail($receiveremail,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}
				
				$this->Session->setFlash('Resource requirement request has been created successfully.','default',array('class' => 'alert alert-success'));
				$this->redirect('resource_requirement');	
			}	
		}
		$employeArr = $this->NappUser->find('all',array('conditions'=>array('NappUser.is_staff_id'=>1)));		
		$this->set('employeArr',$employeArr);	
				
	}
	function resource_requirement(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Resource Requirement List');		
		$this->checkSatffSession(); 
		$userid = $this->Session->read('Customer.id');		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'permitted_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'prepared_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		$this->Purchase->bindModel(
		array('belongsTo' => array('NappUser_2' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'authorized_by',				
			'conditions' => array(),
			'fields' => array('id','name','lname','email'),
			'order' => array(),
		))));
		
		$this->Purchase->bindModel(
		array('hasMany' => array('PurchaseRequirement' => array(
			'className' => 'PurchaseRequirement',			 
			'foreignKey' => 'purchase_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->Purchase->recursive = 2;
		$this->paginate = array('conditions'=>array('Purchase.purchase_type'=>1,'or'=>array('Purchase.permitted_by'=>$userid,'Purchase.prepared_by'=>$userid,'Purchase.authorized_by'=>$userid)),'order'=>array('Purchase.id'=>'DESC'),'page' => 1, 'limit' => 25);
		$purchaseArr = $this->Paginator->paginate('Purchase');	
		$this->set('purchaseArr',$purchaseArr);
		
	}
}
?>