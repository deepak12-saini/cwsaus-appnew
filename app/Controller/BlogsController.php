<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class BlogsController extends AppController {
	/**
	* This controller does not use a model
	*
	* @var array
	*/
	public $components = array('Session','Paginator','Stripe');	
	public $uses = array('Category','Blog','User');
	/***
	/*Author  :Paramjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	public function index($slug=null)
	{
	
		//set admin layout
		$this->layout='front_layout';
		//set title for page Edit Widget
		$this->set('title_for_layout',SITENAME.' Blog');
		//fetch categgories
		$category = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
		$categories=array();
		if(!empty($category))
		{
			foreach($category as $category_arr)
			{
				$BlogCount = $this->Blog->find('count',array('conditions'=>array('Blog.status'=>1,'Blog.category_id'=>$category_arr['Category']['id'],'Blog.is_deleted'=>0)));
				$categories_arr['id']=$category_arr['Category']['id'];
				$categories_arr['name']=$category_arr['Category']['name'];
				$categories_arr['slug']=$category_arr['Category']['slug'];
				$categories_arr['count']=$BlogCount;
				$categories[]=$categories_arr;
			}
		}
		$this->set('categories', $categories);
		$this->Blog->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',			 
		'foreignKey' => 'category_id',				
		'conditions' => array(),
		'fields' => '',
		'order' => array(),
		)))); 
	
		if(!empty($this->request->data['title'])){
			$search_title=$this->request->data['title'];
			if($slug!='')
			{
				$Slugcategory = $this->Category->find('first',array('conditions'=>array('Category.slug'=>$slug),'fields'=>'id'));
				$this->paginate = array('conditions'=>array('Blog.is_deleted'=>0,'Blog.status'=>1,'Blog.category_id'=>$Slugcategory['Category']['id'],'Blog.title LIKE'=>"%$search_title%"),'page' => 1, 'limit' => 3,'order'=>array('Blog.id'=>'DESC'));
			}else{
				$this->paginate = array('conditions'=>array('Blog.is_deleted'=>0,'Blog.status'=>1,'Blog.title LIKE'=>"%$search_title%"),'page' => 1, 'limit' => 3,'order'=>array('Blog.id'=>'DESC'));
			}
			
		}else{
			if($slug!='')
			{
				$Slugcategory = $this->Category->find('first',array('conditions'=>array('Category.slug'=>$slug),'fields'=>'id'));
				$this->paginate = array('conditions'=>array('Blog.is_deleted'=>0,'Blog.status'=>1,'Blog.category_id'=>$Slugcategory['Category']['id']),'page' => 1, 'limit' => 3,'order'=>array('Blog.id'=>'DESC'));
			}else{
				$this->paginate = array('conditions'=>array('Blog.is_deleted'=>0,'Blog.status'=>1),'page' => 1, 'limit' => 3,'order'=>array('Blog.id'=>'DESC'));
			}
		}
		
		
		$this->Blog->recursive = 3;		
		$Blogs = $this->Paginator->paginate('Blog');	
		//echo  '<pre>';print_r($Blogs);die;
		$this->set('Blogs', $Blogs);
		
		//Recent Posts
		$RecentBlog = $this->Blog->find('all',array('conditions'=>array('Blog.status'=>1,'Blog.is_deleted'=>0),'limit'=>5,'order'=>array('Blog.created'=>'DESC')));
		$this->set('RecentBlogs', $RecentBlog);
	}
	
	public function detail($slug=null)
	{
		//set admin layout
		$this->layout='front_layout';
		//set title for page Edit Widget
		
		
		//fetch categgories
		$category = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
		$categories=array();
		if(!empty($category))
		{
			foreach($category as $category_arr)
			{
				$BlogCount = $this->Blog->find('count',array('conditions'=>array('Blog.status'=>1,'Blog.category_id'=>$category_arr['Category']['id'],'Blog.is_deleted'=>0)));
				$categories_arr['id']=$category_arr['Category']['id'];
				$categories_arr['name']=$category_arr['Category']['name'];
				$categories_arr['slug']=$category_arr['Category']['slug'];
				$categories_arr['count']=$BlogCount;
				$categories[]=$categories_arr;
			}
		}
		$this->set('categories', $categories);
		
		//Recent Posts
		$RecentBlog = $this->Blog->find('all',array('conditions'=>array('Blog.status'=>1,'Blog.is_deleted'=>0),'limit'=>5,'order'=>array('Blog.created'=>'DESC')));
		$this->set('RecentBlogs', $RecentBlog);
		if(!empty($slug))
		{
			$this->Blog->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',			 
		'foreignKey' => 'category_id',				
		'conditions' => array(),
		'fields' => '',
		'order' => array(),
		)))); 
		
			$Blog = $this->Blog->find('first',array('conditions'=>array('Blog.slug'=>$slug)));
			$this->set('Blog', $Blog);
			//echo  '<pre>';print_r($Blog);die;
		}else{
			$this->redirect('/blog');
		}

		$this->set('title_for_layout',SITENAME.' '.$Blog['Blog']['title']);
	}
	
		/***
	/*Author  :Ranjit,
	/*Comment :Admin Blog list
	****/
	public function admin_index($clearAll=null){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Blog');		
		$this->checkAdminSession(); 
		
		if(!empty($clearAll) && ($clearAll == 'clear')){			
			$this->Session->delete('search_Blog');			
			return $this->redirect(array('action' => 'index'));	
		}	
		$this->Blog->recursive = 3;
		$this->Blog->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',			 
		'foreignKey' => 'category_id',				
		'conditions' => array(),
		'fields' => 'name',
		'order' => array(),
		)))); 
		
		if(!empty($this->request->data['search'])){
			$search_Blog=$this->request->data['search'];
			$this->Session->write('search_Blog',$search_Blog);
		}else{
			$search_Blog=$this->Session->read('search_Blog');
		}
		
		if(!empty($search_Blog))
		{
			$conditions['AND']['Blog.is_deleted'] = 0;
			$conditions['OR']['Blog.title LIKE'] = '%'.$search_Blog.'%';
						
			$this->paginate = array('conditions'=>$conditions,'page' => 1, 'limit' => 25,'order'=>array('Blog.id'=>'DESC'));
		}else{			
			$this->paginate = array('conditions'=>array('is_deleted'=>0),'page' => 1, 'limit' => 25,'order'=>array('Blog.id'=>'DESC'));
		}
		
		//$this->Blog->recursive = 0;
		
		$Blogs = $this->Paginator->paginate('Blog');		
		$this->set('Blogs', $Blogs);
		$this->set('search_Blog', $search_Blog);		
	}
	
	
	
	
	/**
	* Author:Ranjit
	* Discription:Add Category
	* @return void
*/
	public function admin_add(){
		$this->checkAdminSession(); 
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New Blog');
		if ($this->request->is('post')) {
			if(!empty($this->request->data['Blog']['image']['name'])){
			$error = $this->request->data['Blog']['image']['error'];		
			if($error == 0){	
				
				$image_name = $this->request->data['Blog']['image']['name'];
				$type = $this->request->data['Blog']['image']['type'];
				$tmp_name = $this->request->data['Blog']['image']['tmp_name'];
				$filename = time().$image_name;	
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				$ext = substr(strtolower(strrchr($image_name, '.')), 1);
				if (!in_array($ext, $arr_ext)) {
				$this->Session->setFlash('Please upload the valid image extention. Please, try again.','default',array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'add'));
				}
				$file = move_uploaded_file($tmp_name,'blog_img/'.$filename);	
				
				$this->request->data['Blog']['title_image'] = $filename;
				
			}
			}else{
				$this->request->data['Blog']['title_image'] = '';
			}
		/* 	echo '<pre>';
			print_r($this->request->data);die; */
			/* $cat_slug=str_replace(' ','-',strtolower($this->request->data['Blog']['title']));
			$cat_slug = str_replace('&','and',$cat_slug);
			$this->request->data['Blog']['title_slug'] = $cat_slug; */
			$this->request->data['Blog']['created'] = date('Y-m-d H:i:s');
			$this->request->data['Blog']['updated'] = date('Y-m-d H:i:s');				
			$this->Blog->create();
				
			if ($this->Blog->save($this->request->data)) {				
				
				$this->Session->setFlash('The Blog Page has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Blog Page could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}		
		$category = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
		#echo '<pre>';print_r($category);die;
		$this->set('cate',$category); 
		
	}
	/**
	* Author:Ranjit
	* Discription:Edit The StaticPage
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
 
	public function admin_edit($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Edit New Blog');
		$this->checkAdminSession(); 	
			
		if (!empty($this->request->data)) {	
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$Blog = $this->Blog->find('first', $options);	
			if (!empty($this->request->data['Blog']['image']['name'])) {
			$error = $this->request->data['Blog']['image']['error'];			
			if($error == 0){					
				$error = $this->request->data['Blog']['image']['error'];
				$image_name = $this->request->data['Blog']['image']['name'];
				$type = $this->request->data['Blog']['image']['type'];
				$tmp_name = $this->request->data['Blog']['image']['tmp_name'];
				$filename = time().$image_name;	
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				$ext = substr(strtolower(strrchr($image_name, '.')), 1);
				if (!in_array($ext, $arr_ext)) {
				$this->Session->setFlash('Please upload the valid image extention. Please, try again.','default',array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'add'));
				}
				$file = move_uploaded_file($tmp_name,'blog_img/'.$filename);	
				
				$this->request->data['Blog']['title_image'] = $filename;
				
			}else{
			$this->request->data['Blog']['title_image'] = $this->request->data['Blog']['image'];	
			}
			}else{
				if($Blog['Blog']['title_image']!='')
				$this->request->data['Blog']['title_image']=$Blog['Blog']['title_image'];
				else	
				$this->request->data['Blog']['title_image']='';
			}
			$this->request->data['Blog']['id'] = $id;
			$this->request->data['Blog']['updated'] = date('Y-m-d H:i:s');	
		/* 	$cat_slug=str_replace(' ','-',strtolower($this->request->data['Blog']['title']));
			$cat_slug = str_replace('&','and',$cat_slug);
			$this->request->data['Blog']['title_slug'] = $cat_slug; */
		
			if ($this->Blog->save($this->request->data)) {
				
				
				$this->Session->setFlash('The Blog Page has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The Blog Page could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
		
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$Blog = $this->Blog->find('first', $options);			
		$this->request->data = $Blog;			
		$this->set('Blog',$Blog);
		
		$category = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
		$this->set('cate',$category); 
	}
	
	/**
 	* Author:Ranjit
	* Discription:Delete The StaticPage
	* @throws NotFoundException
	* @param string $id
	* @return void
 */
	public function admin_delete($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Delete');
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid Blog Page'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Blog->saveField("is_deleted",1)) {
			$this->Session->setFlash('The Blog Page has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Blog Page could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
		
	/**
	* Author:Ranjit
	* Discription:Admin View Blog Details
	* @return void
	*/
	public function admin_view($id = null) {
		$this->checkAdminSession(); 
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Blog Details');
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		 
		$this->set('Blog', $this->Blog->find('first', $options));
	}
	
		/**
	* Author:Ranjit
	* Discription:Admin Delete Blog Image
	* @return void
	*/	
	public function admin_delete_image($id = null){
		$this->checkAdminSession(); 
		$this->layout='admin_gift_layout';
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		$Blog = $this->Blog->read('title_image', $id);
		$imgPath = WWW_ROOT . "blog_img" . DS . $Blog['Blog']['title_image'];
		// unlink($imgPath);
		if( file_exists($imgPath ) )  unlink($imgPath);
		 $this->Blog->id=$id;
		 $this->Blog->saveField("title_image","");
		 return $this->redirect(array('action' => 'edit', $id));
		
	}
	
}
?>