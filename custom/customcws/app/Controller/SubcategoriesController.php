<?php 
App::uses('AppController','Controller');
class SubcategoriesController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Subcategory','Category');
	/***
	/*Author  :Paramjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	/***
	/*Author  :Ranjit,
	/*Comment :Admin Category list
	****/
	public function admin_index(){
		
		 $this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' SubCategories');		
		$this->checkAdminSession(); 
		$this->Subcategory->bindModel(
				array('belongsTo' => array('Category' => array(
				'className' => 'Category',    
				'foreignKey' => 'category_id',    
				'conditions' => array(),
				'fields' => array('category_name'),
				'order' => array(),
			))));		
		$this->Subcategory->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$categories = $this->Paginator->paginate('Subcategory');		
		$this->set('categories', $categories);	 
	
	}
	
	
	/**
	* Author:Ranjit
	* Discription:Add Category
	* @return void
*/
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New SubCategories');
		$this->checkAdminSession(); 
			$category = $this->Category->find('all');
			$this->set('category',$category);
		if ($this->request->is('post')) {
			$cat_slug=str_replace(' ','-',strtolower($this->request->data['Subcategory']['name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			$this->request->data['Subcategory']['slug']=$cat_slug;
			
			$this->Subcategory->create();
			if ($this->Subcategory->save($this->request->data)) {
				$this->Session->setFlash('The SubCategories has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The SubCategories could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	/**
	* Author:Ranjit
	* Discription:Edit The Category
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
	public function admin_edit($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Edit Subcategory');
		$this->checkAdminSession(); 
		
		$category = $this->Category->find('all');
		$this->set('category',$category);
		
		if (!$this->Subcategory->exists($id)) {
			throw new NotFoundException(__('Invalid sevice Subcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$cat_slug=str_replace(' ','-',strtolower($this->request->data['Subcategory']['name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			
			$this->request->data['Subcategory']['slug']=$cat_slug;

			if ($this->Subcategory->save($this->request->data)) {
				$this->Session->setFlash('The Subcategory has been updated','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Subcategory could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Subcategory.' . $this->Subcategory->primaryKey => $id));
			$Subcategory = $this->Subcategory->find('first', $options);			
			$this->request->data = $Subcategory;			
			$this->set('Subcategory',$Subcategory);
			
		}
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
		$this->Subcategory->id = $id;
		if (!$this->Subcategory->exists()) {
			throw new NotFoundException(__('Invalid Subcategory'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Subcategory->delete()) {
			$this->Session->setFlash('The Subcategory has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Subcategory could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

}
?>