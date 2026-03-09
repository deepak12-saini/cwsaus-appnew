<?php
class StatesController extends AppController {
	public $uses = array('User','StatePrice','State','Subsubsidy');
	public $components = array('Session','Paginator');	
	function beforeFilter(){
		$this->callConstants();
	}
	function admin_index(){
		$this->set('title_for_layout',SITENAME.' Admin State List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 
		$this->State->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$State = $this->Paginator->paginate('State');		
		$this->set('State', $State);	 
	}
	function admin_add(){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin State Add Page');
		$this->checkAdminSession(); 
		if(!empty($this->request->data)){
			if($this->State->save($this->request->data)) {
				$this->Session->setFlash('State has been saved','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}else{
				$this->Session->setFlash('State has not saved','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	function admin_edit($id){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin State Edit Page');
		$this->checkAdminSession(); 
		$State =  $this->State->find('first',array('conditions'=>array('State.id'=>$id)));
		$this->set('State',$State);
		if(!empty($this->request->data)){
			//echo"<pre>";print_r($this->request->data);die;
			if($this->State->save($this->request->data)) {
				$this->Session->setFlash('State has been updates','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}else{
				$this->Session->setFlash('State has not updated','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	public function admin_delete($id){
		$this->autoRender = false;
		if($this->State->delete($id)){
			$this->Session->setFlash('State has been deleted','default',array('class' => 'alert alert-success'));
		    $this->redirect('index');
		}
	}
	function admin_stateprice(){
		$this->set('title_for_layout',SITENAME.' Admin StatePrice List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 
		$this->StatePrice->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$StatePrice = $this->Paginator->paginate('StatePrice');		
		$this->set('StatePrice', $StatePrice);	 
	}
	function admin_stateprice_add(){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin StatePrice Add Page');
		$this->checkAdminSession(); 
		if(!empty($this->request->data)){
			if($this->StatePrice->save($this->request->data)) {
				$this->Session->setFlash('StatePrice has been saved','default',array('class' => 'alert alert-success'));
				$this->redirect('stateprice');
			}else{
				$this->Session->setFlash('StatePrice has not saved','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	function admin_stateprice_edit($id){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin StatePrice Edit Page');
		$this->checkAdminSession(); 
		$StatePrice =  $this->StatePrice->find('first',array('conditions'=>array('StatePrice.id'=>$id)));
		$this->set('StatePrice',$StatePrice);
		if(!empty($this->request->data)){
			if($this->StatePrice->save($this->request->data)) {
				$this->Session->setFlash('StatePrice has been updates','default',array('class' => 'alert alert-success'));
				$this->redirect('stateprice');
			}else{
				$this->Session->setFlash('StatePrice has not updated','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	public function admin_stateprice_delete($id){
		$this->autoRender = false;
		if($this->StatePrice->delete($id)){
			$this->Session->setFlash('StatePrice has been deleted','default',array('class' => 'alert alert-success'));
		    $this->redirect('stateprice');
		}
	}
	function admin_subsubsidy(){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin subsubsidy Page');
		$this->checkAdminSession(); 
		$Subsubsidy =$this->Subsubsidy->find('first', array('order' => 'rand()','limit' => 1));
		$this->set('Subsubsidy',$Subsubsidy);
		if(!empty($this->request->data)){
			if($this->Subsubsidy->save($this->request->data)) {
				$this->Session->setFlash('Subsubsidy has been saved','default',array('class' => 'alert alert-success'));
				$this->redirect('subsubsidy');
			}else{
				$this->Session->setFlash('Subsubsidy has not saved','default',array('class' => 'alert alert-danger'));
			}
		}
	}
}
	
?>