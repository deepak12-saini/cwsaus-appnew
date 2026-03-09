<?php 
App::uses('AppController','Controller');
class CategoriesController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Category');
	/***
	/*Author  :Ranjit,
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
		$this->set('title_for_layout',SITENAME.' Categories');		
		$this->checkAdminSession(); 
				
		$this->Category->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$categories = $this->Paginator->paginate('Category');		
		$this->set('categories', $categories);		
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
			$cat_slug=str_replace(' ','-',strtolower($this->request->data['Category']['category_name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			$this->request->data['Category']['slug']=$cat_slug;
						
			if (!empty($this->request->data['image']['name'])) {					
				$file = $this->request->data['image'];
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				if (in_array($ext, $arr_ext)) {														
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'category/' . $file['name']);
					//prepare the filename for database entry
					$this->request->data['Category']['image'] = $file['name'];							
				}else{
					$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));
					$this->redirect('add');
				}
			}else{
				$this->request->data['Category']['image'] = '250250-defult.png';		
			}	
			
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
			$cat_slug=str_replace(' ','-',strtolower($this->request->data['Category']['category_name']));
			$cat_slug=str_replace('&','and',$cat_slug);
			
			$this->request->data['Category']['slug']=$cat_slug;
			
			
			
			if (!empty($this->request->data['image']['name'])) {					
				$file = $this->request->data['image'];
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				if (in_array($ext, $arr_ext)) {														
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'category/' . $file['name']);
					//prepare the filename for database entry
					$this->request->data['Category']['image'] = $file['name'];							
				}else{
					$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));
					$this->redirect('edit/'.$id);
				}
			}

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
			$this->Session->setFlash('The Category has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Category could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

}
?>