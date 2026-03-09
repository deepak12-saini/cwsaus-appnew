<?php 
App::uses('AppController','Controller');
class ProductionsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('BatchRegister','BatchCountSheet','NappUser','User');
	
	/***
	/*Author  :Ranjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	
	function admin_index()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Batch Register List');
		$this->checkAdminSession();
		
		$this->BatchRegister->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->BatchRegister->recursive = 0;
		$BatchRegisterArr = $this->Paginator->paginate('BatchRegister');	
		#echo '<pre>'; print_r($BatchRegisterArr); die;
		$this->set('BatchRegisterArr',$BatchRegisterArr);	
	}
	function admin_batch_count_sheet()
	{
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Batch Count Sheet List');
		$this->checkAdminSession();
		
		$this->BatchCountSheet->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10);		
		$this->BatchCountSheet->recursive = 0;
		$BatchRegisterArr = $this->Paginator->paginate('BatchCountSheet');	
		//echo '<pre>'; print_r($BatchRegisterArr); die;
		$this->set('BatchRegisterArr',$BatchRegisterArr);	
	}

}
?>