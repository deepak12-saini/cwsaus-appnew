<?php 
App::uses('AppController','Controller');
class CategoriesController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Category','Article');
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
	public function admin_index($clearAll=null){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Categories');		
		$this->checkAdminSession(); 
		
		if(!empty($clearAll) && ($clearAll == 'clear')){			
			$this->Session->delete('search_cat');			
			return $this->redirect(array('action' => 'index'));	
		}
		
		if(!empty($this->request->data['search_cat'])){
			$search_cat=$this->request->data['search_cat'];
			$this->Session->write('search_cat',$search_cat);
		}else{
			$search_cat=$this->Session->read('search_cat');
		}
		
		if(!empty($search_cat))
		{ 
			$conditions['OR']=array();
			$conditions['OR']['Category.name LIKE'] = '%'.$search_cat.'%';
		
			$this->paginate = array('conditions'=>$conditions,'page' => 1, 'limit' => 25);
		}else {
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);			
		}
		$this->Category->recursive = 0;
		
		$categories = $this->Paginator->paginate('Category');		
		$this->set('categories', $categories);		
		$this->set('search_cat', $search_cat);		
	}
	
	
	/**
	* Author:Ranjit
	* Discription:Add Category
	* @return void
*/
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New Category');
		$this->checkAdminSession(); 
		if ($this->request->is('post')) {
			/* $cat_slug=str_replace(' ','-',strtolower($this->request->data['Category']['name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			$this->request->data['Category']['slug']=$cat_slug; */
			
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('The Category has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Category could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
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
		$this->set('title_for_layout',SITENAME.' Edit Category');
		$this->checkAdminSession(); 
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid sevice category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			/* $cat_slug=str_replace(' ','-',strtolower($this->request->data['Category']['name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			
			$this->request->data['Category']['slug']=$cat_slug; */

			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('The Category has been updated','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Category could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$Category = $this->Category->find('first', $options);			
			$this->request->data = $Category;			
			$this->set('Category',$Category);
			
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid Category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			/* $condition=array('Blog.category_id'=>$id);
			$this->Blog->deleteAll($condition,false); */
			
			$this->Session->setFlash('The Category has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Category could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

}
?>