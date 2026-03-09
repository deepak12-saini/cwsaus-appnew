<?php 
App::uses('AppController','Controller');
class GalleriesController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Category','Gallery');
	function beforeFilter() {
		$this->callConstants();	
	}
	public function admin_index(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Gallery');		
		$this->checkAdminSession();
		$this->Gallery->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$Gallery = $this->Paginator->paginate('Gallery');		
		$this->set('Gallery', $Gallery);	
			
	}
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New Gallery');
		$this->checkAdminSession(); 
		if ($this->request->is('post')) {
			if(!empty($this->request->data['Gallery']['image']['name'])){
				$error = $this->request->data['Gallery']['image']['error'];		
				if($error == 0){	
					$image_name = $this->request->data['Gallery']['image']['name'];
					$type = $this->request->data['Gallery']['image']['type'];
					$tmp_name = $this->request->data['Gallery']['image']['tmp_name'];
					$filename = time().$image_name;	
					$arr_ext = array('jpg', 'jpeg', 'gif','png');
					$ext = substr(strtolower(strrchr($image_name, '.')), 1);
					if (!in_array($ext, $arr_ext)) {
					$this->Session->setFlash('Please upload the valid image extention. Please, try again.','default',array('class' => 'alert alert-danger'));
					return $this->redirect(array('action' => 'add'));
					}
					$file = move_uploaded_file($tmp_name,'gallery/'.$filename);	
					
					$this->request->data['Gallery']['image'] = $filename;
					
				}
			}else{
				$this->request->data['Gallery']['image'] = '';
			}
			$this->Gallery->create();
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash('The Gallery has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Gallery could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
	}
		public function admin_edit($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Edit New Gallery');
		$this->checkAdminSession(); 	
		if (!empty($this->request->data)) {	
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$Gallery = $this->Gallery->find('first', $options);	
			if (!empty($this->request->data['Gallery']['image']['name'])) {
			$error = $this->request->data['Gallery']['image']['error'];			
			if($error == 0){					
				$error = $this->request->data['Gallery']['image']['error'];
				$image_name = $this->request->data['Gallery']['image']['name'];
				$type = $this->request->data['Gallery']['image']['type'];
				$tmp_name = $this->request->data['Gallery']['image']['tmp_name'];
				$filename = time().$image_name;	
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				$ext = substr(strtolower(strrchr($image_name, '.')), 1);
				if (!in_array($ext, $arr_ext)) {
				$this->Session->setFlash('Please upload the valid image extention. Please, try again.','default',array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'add'));
				}
				$file = move_uploaded_file($tmp_name,'gallery/'.$filename);	
				
				$this->request->data['Gallery']['image'] = $filename;
				
			}else{
			$this->request->data['Gallery']['image'] = $this->request->data['Gallery']['image'];	
			}
			}else{
				if($Gallery['Gallery']['image']!='')
				$this->request->data['Gallery']['image']=$Gallery['Gallery']['image'];
				else	
				$this->request->data['Gallery']['image']='';
			}
			$this->request->data['Gallery']['id'] = $id;
			if ($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash('The Gallery Page has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Gallery Page could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$Gallery = $this->Gallery->find('first', $options);			
		$this->request->data = $Gallery;			
		$this->set('Gallery',$Gallery);
	}
	public function admin_delete($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Delete');
		$this->checkAdminSession(); 
		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Invalid Gallery'));
		}
		if ($this->Gallery->delete()) {
			$this->Session->setFlash('The Gallery has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Gallery could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function admin_delete_image($id = null){
		$this->checkAdminSession(); 
		$this->layout='admin_layout';
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid Gallery'));
		}
		$Gallery = $this->Gallery->read('image', $id);
		$imgPath = WWW_ROOT . "gallery" . DS . $Gallery['Gallery']['image'];
		// unlink($imgPath);
		if( file_exists($imgPath ) )  unlink($imgPath);
		 $this->Gallery->id=$id;
		 $this->Gallery->saveField("image","");
		 return $this->redirect(array('action' => 'edit', $id));
		
	}
}
?>