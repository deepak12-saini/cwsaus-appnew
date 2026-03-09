<?php 
App::uses('AppController','Controller');
class NatasController extends AppController{
	
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('NataCategory','NataEvent'); 
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	
	function admin_index($nextdate=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' NATA LIST');		
		$this->checkAdminSession(); 
		
		if(empty($nextdate)){
			$nextdate = date('Y');
		}	
		$yer = date('Y');
		$this->NataCategory->bindModel(
		array('hasMany' => array('NataEvent' => array(
			'className' => 'NataEvent',			 
			'foreignKey' => 'cate_id',				
			'conditions' => array('NataEvent.year'=>$nextdate),
			'fields' => '',
			'order' => array(),
		))));
		$natacategory = $this->NataCategory->find('all');
		$this->set('natacategory',$natacategory);
		
		$this->set('nextdate', $nextdate);
	}
	
	
	public function admin_update($id=null,$status=null) {

		$this->checkAdminSession(); 
		$this->layout='';	
		
		$user_id  = $this->Session->read('User.id');
		$this->NataEvent->bindModel(
		array('belongsTo' => array('NataCategory' => array(
			'className' => 'NataCategory',			 
			'foreignKey' => 'cate_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$natacateArr = $this->NataEvent->find('first',array('conditions'=>array('NataEvent.id'=>$id)));
		$this->set('natacateArr',$natacateArr);
		if(!empty($this->request->data)){
			$update['NataEvent']['admin_id'] = $user_id;
			$update['NataEvent']['id'] = $id;
			$update['NataEvent']['description'] = $this->request->data['NataEvent']['description'];
			$update['NataEvent']['status'] = $this->request->data['NataEvent']['status'];
			
			$this->NataEvent->save($update);
			$this->Session->setFlash('Status updated successfully.','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'update/'.$id.'/1'));	
		}	
		$this->set('status',$status);
	}	
	
	public function admin_addevent(){		
		$this->checkAdminSession(); 
		$this->layout='admin_layout';	
		$user_id  = $this->Session->read('User.id');
		if(!empty($this->request->data)){
			
			$monthyear = date('m-Y',strtotime($this->request->data['NataEvent']['month']));
			$year = date('Y',strtotime($this->request->data['NataEvent']['month']));
			
			$allotdate = $this->request->data['NataEvent']['month'];
			$natacateArr = $this->NataEvent->find('first',array('conditions'=>array('NataEvent.month'=>$monthyear)));
			if(!empty($natacateArr)){
				$this->request->data['NataEvent']['id'] = $natacateArr['NataEvent']['id'];	
			}

			$date = date('Y-m-d',strtotime($this->request->data['NataEvent']['month']));
			$this->request->data['NataEvent']['date'] = $date;			
			
			$this->request->data['NataEvent']['month'] = $monthyear;
			$this->request->data['NataEvent']['year'] = $year;
			$this->request->data['NataEvent']['admin_id'] = $user_id;			
				
			if($this->NataEvent->save($this->request->data)){
				return $this->redirect(array('action' => 'index'));
			}
		}	
		$natacateArr = $this->NataCategory->find('all');
		$this->set('natacateArr',$natacateArr);
		
		// $natacate = array();	
		// if(!empty($natacateArr)){
			// foreach($natacateArr as $NataCategorys){
				// $natacate[$NataCategorys['NataCategory']['id']] = $NataCategorys['NataCategory']['name'];
			// }	
		// }	 
		
		// $this->set('natacate', $natacate);
		
		
	}
	public function admin_clienttype_add(){		
		$this->checkAdminSession(); 
		$this->layout='admin_layout';	

		
		
		if(!empty($this->request->data)){
			
			$NataCategory = $this->NataCategory->find('first',array('order'=>array('NataCategory.id'=>'desc')));
			if(!empty($NataCategory)){
				$this->request->data['NataCategory']['unique_id'] = 1000 + $NataCategory['NataCategory']['id'];
			}	else {
				$this->request->data['NataCategory']['unique_id'] = 1000;	
			}	
			
		
			if($this->NataCategory->save($this->request->data)){
				return $this->redirect(array('action' => 'clienttype'));
			}	
		}	
		
		$natacateArr = $this->NataCategory->find('all',array('conditions'=>array('NataCategory.parent_id'=>0)));
		$this->set('natacate',$natacateArr);
		// echo '<pre>';
		// print_r($natacateArr);
		// die();
	}
	public function admin_clienttype_edit($id){		
		$this->checkAdminSession(); 
		$this->layout='admin_layout';		
		
		if(!empty($this->request->data)){
			$this->request->data['NataCategory']['id'] = $id;
			if($this->NataCategory->save($this->request->data)){
				return $this->redirect(array('action' => 'clienttype'));
			}	
		}	
		$ClientTypeArr = $this->NataCategory->find('first',array('conditions'=>array('NataCategory.id'=>$id)));
		$this->set('ClientTypeArr', $ClientTypeArr);
		$this->request->data = $ClientTypeArr;
		
		$natacateArr = $this->NataCategory->find('all',array('conditions'=>array('NataCategory.parent_id'=>0)));
		$this->set('natacate',$natacateArr);
		
		
	}
	 	
	
	public function admin_clienttype(){		
		$this->checkAdminSession(); 
		$this->layout='admin_layout';		
	
		$ClientTypeArr = $this->NataCategory->find('all');			
		$this->set('ClientTypeArr', $ClientTypeArr);
		
		$natacate = array();	
		if(!empty($ClientTypeArr)){
			foreach($ClientTypeArr as $NataCategorys){
				$natacate[$NataCategorys['NataCategory']['id']] = $NataCategorys['NataCategory']['name'];
			}	
		}	
		$this->set('natacate', $natacate);
	}
	
	function index($nextdate=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' NATA LIST');		
		$this->checkSatffSession(); 
		
		if(empty($nextdate)){
			$nextdate = date('Y');
		}
		$this->NataCategory->bindModel(
		array('hasMany' => array('NataEvent' => array(
			'className' => 'NataEvent',			 
			'foreignKey' => 'cate_id',				
			'conditions' => array('NataEvent.year'=>$nextdate),
			'fields' => '',
			'order' => array(),
		))));
		$natacategory = $this->NataCategory->find('all');
		$this->set('natacategory',$natacategory);
		$this->set('nextdate', $nextdate);
	}
	
	public function addevent(){		
		$this->checkSatffSession(); 
		$this->layout='staff_inner_layout';	
		$user_id  = $this->Session->read('Customer.id');
				
		if(!empty($this->request->data)){
			
			$monthyear = date('m-Y',strtotime($this->request->data['NataEvent']['month']));
			$year = date('Y',strtotime($this->request->data['NataEvent']['month']));
			
			$allotdate = $this->request->data['NataEvent']['month'];
			$natacateArr = $this->NataEvent->find('first',array('conditions'=>array('NataEvent.month'=>$monthyear)));
			if(!empty($natacateArr)){
				$this->request->data['NataEvent']['id'] = $natacateArr['NataEvent']['id'];	
			}

			$date = date('Y-m-d',strtotime($this->request->data['NataEvent']['month']));
			$this->request->data['NataEvent']['date'] = $date;			
			
			$this->request->data['NataEvent']['month'] = $monthyear;
			$this->request->data['NataEvent']['year'] = $year;
			$this->request->data['NataEvent']['user_id'] = $user_id;			
				
			if($this->NataEvent->save($this->request->data)){
				return $this->redirect(array('action' => 'index'));
			}
		}	
		$natacateArr = $this->NataCategory->find('all');
		$this->set('natacateArr',$natacateArr);
		
	}
	public function update($id=null,$status=null) {

		$this->checkSatffSession(); 
		$this->layout='';	
		
		$user_id  = $this->Session->read('Customer.id');
		$this->NataEvent->bindModel(
		array('belongsTo' => array('NataCategory' => array(
			'className' => 'NataCategory',			 
			'foreignKey' => 'cate_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$natacateArr = $this->NataEvent->find('first',array('conditions'=>array('NataEvent.id'=>$id)));
		$this->set('natacateArr',$natacateArr);
		if(!empty($this->request->data)){
			
			$update['NataEvent']['id'] = $id;
			$update['NataEvent']['user_id'] = $user_id;
			$update['NataEvent']['description'] = $this->request->data['NataEvent']['description'];
			$update['NataEvent']['status'] = $this->request->data['NataEvent']['status'];
			
			$this->NataEvent->save($update);
			$this->Session->setFlash('Status updated successfully.','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'update/'.$id.'/1'));	
		}	
		$this->set('status',$status);
	}	
}
?>