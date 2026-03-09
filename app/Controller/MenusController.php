<?php
class MenusController extends AppController {
	public $uses = array('User','MenuPage');
	public $components = array('Session','Paginator');	
	function beforeFilter(){
		$this->callConstants();
	}
	function admin_index(){
		$this->set('title_for_layout',SITENAME.' Admin Menu List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 
		$this->MenuPage->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$MenuPage = $this->Paginator->paginate('MenuPage');		
		$this->set('MenuPage', $MenuPage);	 
	}
	function admin_edit($id){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin Menu Edit Page');
		$this->checkAdminSession(); 
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>$id)));
		$this->set('menu',$menu);
		if(!empty($this->request->data)){
			if($this->MenuPage->save($this->request->data)) {
				$this->Session->setFlash('Menu has been updates','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}else{
				$this->Session->setFlash('Menu has not updated','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	
}
	
?>