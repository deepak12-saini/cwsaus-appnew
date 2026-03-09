<?php 
App::uses('AppController','Controller');
class ProductsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator');	
	public $uses = array('Product','Subcategory','Category','Cart','Project');
	
	
	public function index($slug=null){
		
		$this->layout='customduro_layout';
			
		$this->Category->bindModel(
		array('hasMany' => array('Product' => array(
		'className' => 'Product',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('id'),
		'order' => array(),
		))));		
		$category = $this->Category->find("all",array('conditions'=>array('Category.status'=>1)));	
		
		$sorting = array('Product.id asc');
		if(!empty($this->reques->data['sorting'])){
			$sorting = $this->reques->data['sorting'];
		
			if($sorting == 'created'){
				$sorting = array('Product.id desc');
			}else if($sorting == 'popularity'){
				$sorting = array('Product.is_featured desc');
			} 	
		}	
	
		if(!empty($slug)){
			$categoryArr = $this->Category->find("first",array('conditions'=>array('Category.status'=>1,'Category.slug'=>$slug)));
			$categoryname = $categoryArr['Category']['category_name'];			
			$products = $this->Product->find("all",array('conditions'=>array('Product.status'=>1,'Product.category_id'=>$categoryArr['Category']['id']),'order'=>$sorting));
			
			$meta_keyword = $categoryArr['Category']['meta_keyword'];	
			$meta_title = $categoryArr['Category']['meta_title'];	
			$meta_description = $categoryArr['Category']['meta_description'];	
			$category_name = $categoryArr['Category']['category_name'];	
		}else{
			$slug = $category[0]['Category']['slug'];
			$categoryname = $category[0]['Category']['category_name'];
			$products = $this->Product->find("all",array('conditions'=>array('Product.status'=>1,'Product.category_id'=>$category[0]['Category']['id']),'order'=>$sorting));
			
			$meta_keyword = $category[0]['Category']['meta_keyword'];	
			$meta_title = $category[0]['Category']['meta_title'];	
			$meta_description = $category[0]['Category']['meta_description'];	
			$category_name =  $category[0]['Category']['category_name'];	
		}
			
		$this->Category->bindModel(
		array('hasMany' => array('Product' => array(
		'className' => 'Product',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('id'),
		'order' => array(),
		))));		
		$isBrand = $this->Category->find("all",array('conditions'=>array('Category.is_brand'=>1,'Category.status'=>1)));
		
		$this->set(compact('products','category','slug','categoryname','isBrand','category_name'));
		
		
		// setup seo keyword
		if(!empty($meta_title)){
			$this->set('meta_title',$meta_title);
		}	
		if(!empty($meta_description)){
			$this->set('meta_description',$meta_description);
		}
		if(!empty($meta_keyword)){
			$this->set('meta_keyword',$meta_keyword);
		}
		
	}
	
	function search(){
		
		$this->autoRender = false;
		if(!empty($this->request->data)){
			$searchtitle = rtrim($this->request->data['search'],' ');
			$searchtitle = ltrim($searchtitle,' ');
			$this->Session->write('searchtitle',$searchtitle);
			$productArr = $this->Product->find("first",array('conditions'=>array('Product.status'=>1,'Product.title LIKE'=>'%'.$searchtitle.'%'),'fields'=>array('slug')));
			
			if(!empty($productArr)){
				$this->redirect('/products/detail/'.$productArr['Product']['slug']);
			}else if(!empty($searchtitle)){
				$this->Session->setFlash("Your search <b>".$searchtitle."</b> did not match any products.",'default',array('class' => 'alert alert-danger'));
				$this->redirect('/products');
			}else{
				$this->redirect('/products');
			}					
		}else{			
			$this->redirect('/products');		
		}			
	}	
	
	public function detail($produc_slug=null){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.' Product Deatil Page');	
		
		
		$random =  $this->Product->query("select title,slug,image FROM products where status = '1' ORDER BY RAND() LIMIT 0,4");
		
		$this->Product->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('id','meta_title','meta_description','meta_keyword'),
		'order' => array(),
		))));	
		$products = $this->Product->find("first",array('conditions'=>array('Product.status'=>1,'Product.slug'=>$produc_slug)));
		$this->set(compact('products'));
		
		$this->Category->bindModel(
		array('hasMany' => array('Product' => array(
		'className' => 'Product',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('id'),
		'order' => array(),
		))));		
		$category = $this->Category->find("all",array('conditions'=>array('Category.status'=>1)));	
		
		$this->Category->bindModel(
		array('hasMany' => array('Product' => array(
		'className' => 'Product',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('id'),
		'order' => array(),
		))));		
		$isBrand = $this->Category->find("all",array('conditions'=>array('Category.is_brand'=>1,'Category.status'=>1)));
		
		$this->set(compact('category','isBrand','random'));
		
		// setup seo keyword
		if(!empty($products['Product']['meta_title'])){
			$this->set('meta_title',$products['Product']['meta_title']);
		}else if(!empty($products['Category']['meta_title'])){
			$this->set('meta_title',$products['Category']['meta_title']);
		}	
		if(!empty($products['Product']['meta_description'])){
			$this->set('meta_description',$products['Product']['meta_description']);
		}else if(!empty($products['Category']['meta_description'])){
			$this->set('meta_title',$products['Category']['meta_description']);
		}
		
		if(!empty($products['Product']['meta_keyword'])){
			$this->set('meta_keyword',$products['Product']['meta_keyword']);
		}else if(!empty($products['Category']['meta_keyword'])){
			$this->set('meta_title',$products['Category']['meta_keyword']);
		}
	}
	
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
		$this->set('title_for_layout',SITENAME.' Product List');		
		$this->checkAdminSession(); 
		$this->Product->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',    
		'foreignKey' => 'category_id',    
		'conditions' => array(),
		'fields' => array('category_name'),
		'order' => array(),
		))));
		/* $this->Product->bindModel(
		array('belongsTo' => array('Subcategory' => array(
		'className' => 'Subcategory',    
		'foreignKey' => 'sub_category_id',    
		'conditions' => array(),
		'fields' => array('name'),
		'order' => array(),
		))));		 */	
		//$this->Product->recursive = 3;
		$name = '';
		if(!empty($this->request->data)){
			$name = $this->request->data['productname'];
			$this->paginate = array('conditions'=>array('Product.title LIKE'=>'%'.$name.'%'),'page' => 1, 'limit' => 25);
		}else{
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('Product.id'=>'desc'));
		}	
		$product = $this->Paginator->paginate('Product');		
		$this->set('product', $product);
		$this->set('name', $name);
		//echo"<pre>";print_r($product);die;	 	
	}
	
	public function admin_projectadd($product_id=null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add Project Reffernce');
		$this->checkAdminSession(); 
		if(!empty($this->request->data)){
			$file = $this->request->data['Product']['image'];						
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
			$arr_ext = array('jpg', 'jpeg', 'gif','png');
			if (in_array($ext, $arr_ext)) {
				$image = time().'.'.$ext;
				move_uploaded_file($file['tmp_name'], WWW_ROOT . 'productimg/' .$image);
				//prepare the filename for database entry
				$ProjectArr['Project']['id'] = '';
				$ProjectArr['Project']['images'] = $image;
				$ProjectArr['Project']['product_id'] = $product_id;
				$this->Project->save($ProjectArr);
			}else{
				$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));
			}				
		}		
	}
	public function admin_project($product_id=null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add Project Reffernce');
		$this->checkAdminSession(); 
		
		$imageArr = $this->Project->find('all',array('conditions'=>array('Project.product_id'=>$product_id)));
		$this->set('imageArr',$imageArr);	
		$this->set('product_id',$product_id);	
	}
	
	/**
	* Author:Ranjit
	* Discription:Add Category
	* @return void
*/
	public function admin_add() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add Product');
		$this->checkAdminSession(); 
		$category = $this->Category->find('all');
		$this->set('category',$category);
		$product_code=$this->random_password(8);
		$this->set('product_code',$product_code);
		/* $subcategory = $this->Subcategory->find('all');
		$this->set('subcategory',$subcategory); */
		if(!empty($this->request->data)){
			
			$cat_slug=str_replace(' ','-',strtolower($this->request->data['Product']['title']));
			$cat_slug=str_replace('&','and',$cat_slug);
			$this->request->data['Product']['slug']=$cat_slug;
		
			//Check if image has been uploaded
			if (!empty($this->request->data['Product']['image']['name'])) {		
				$file = $this->request->data['Product']['image'];						
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'gif','png');
				if (in_array($ext, $arr_ext)) {
					
				// upload thumnail image
				$width = 285;
				$height = 380;
				/* Get original image x y*/
				list($w, $h) = getimagesize($file['tmp_name']);
				/* calculate new image size with ratio */
				$ratio = max($width/$w, $height/$h);
				$h = ceil($height / $ratio);
				$x = ($w - $width / $ratio) / 2;
				$w = ceil($width / $ratio);
				
				$thumnail_image = time().'_thumnail_'.$file['name']; 
				/* new file name */
				$path =  WWW_ROOT . 'productimg/' . $thumnail_image;
				/* read binary data from image file */
				$imgString = file_get_contents($file['tmp_name']);			
				/* create image from string */
				$image = imagecreatefromstring($imgString);
				$tmp = imagecreatetruecolor($width, $height);
				imagecopyresampled($tmp, $image,
				0, 0,
				$x, 0,
				$width, $height,
				$w, $h);
				/* Save image */
				switch ($file['type']) {
					case 'image/jpeg':
						imagejpeg($tmp, $path, 100);
						break;
					case 'image/png':
						imagepng($tmp, $path, 0);
						break;
					case 'image/gif':
						imagegif($tmp, $path);
						break;
					default:
						exit;
						break;
				}
				/* cleanup memory */
				imagedestroy($image);
				imagedestroy($tmp);						
					
				move_uploaded_file($file['tmp_name'], WWW_ROOT . 'productimg/' . $file['name']);
				//prepare the filename for database entry
				$this->request->data['Product']['image'] = $file['name'];
				$this->request->data['Product']['thumb_image'] = $thumnail_image;
				}else{
					$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));
					exit;
				}
			}else{
				$this->request->data['Product']['image'] = '250250-defult.png';
				$this->request->data['Product']['thumb_image'] = '250250-defult.png';
			}
			
			if($this->Product->save($this->request->data)){
				$this->Session->setFlash('The product has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
				}else{
				$this->Session->setFlash('The product could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	public function admin_check(){
		$this->autoRender=false;
		if(!empty($this->request->data)){
			$category_id =$this->request->data['category_id'];
			$sub_cate = $this->Subcategory->find('all',array('conditions'=>array('Subcategory.category_id'=>$category_id)));
			$this->set('sub_cate',$sub_cate);
			if(!empty($sub_cate)){
				foreach($sub_cate as $sub_cate){
					echo '<option value="'.$sub_cate['Subcategory']['category_id'].'">'.$sub_cate['Subcategory']['name'].'</option>';
				}
			}else{
				echo '<option value="">Subcategory not available</option>';
			}
		}
	}
	function admin_edit($id = null){
	$this->layout='admin_layout';
	$this->set('title_for_layout',SITENAME.' Edit Product');
	$this->checkAdminSession(); 
	$category = $this->Category->find('all');
	$this->set('category',$category);
	
	$product_arr = $this->Product->find('first',array('conditions' => array('Product.id'=>$id)));
	$this->set('product_arr',$product_arr);			
	/* $subcategory = $this->Subcategory->find('all',array('conditions' => array('Subcategory.category_id'=>$product_arr['Product']['sub_category_id'])));
	$this->set('subcategory',$subcategory); */

	if(!empty($this->request->data)){
	
	
	$cat_slug=str_replace(' ','-',strtolower($this->request->data['Product']['title']));
	$cat_slug=str_replace('&','and',$cat_slug);
	$this->request->data['Product']['slug']=$cat_slug;
	
	//Check if image has been uploaded
	if (!empty($this->request->data['Product']['image']['name'])) {
	$file = $this->request->data['Product']['image'];

	$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
	$arr_ext = array('jpg', 'jpeg', 'gif','png');

		if (in_array($ext, $arr_ext)) {
			
			// upload thumnail image
			$width = 255;
			$height = 250;
			/* Get original image x y*/
			list($w, $h) = getimagesize($file['tmp_name']);
			/* calculate new image size with ratio */
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio) / 2;
			$w = ceil($width / $ratio);
			
			$thumnail_image = time().'_thumnail_'.$file['name']; 
			/* new file name */
			$path =  WWW_ROOT . 'productimg/' . $thumnail_image;
			/* read binary data from image file */
			$imgString = file_get_contents($file['tmp_name']);			
			/* create image from string */
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($tmp, $image,
			0, 0,
			$x, 0,
			$width, $height,
			$w, $h);
			/* Save image */
			switch ($file['type']) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
					break;
			}
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
			
			move_uploaded_file($file['tmp_name'], WWW_ROOT . 'productimg/' . $file['name']);
			//prepare the filename for database entry
			$this->request->data['Product']['image'] = $file['name'];
			$this->request->data['Product']['thumb_image'] = $thumnail_image;
		}else{
			$this->Session->setFlash('Please upload the valid image extention.','default',array('class' => 'alert alert-danger'));exit;
			return $this->redirect(array('action' => 'edit/'.$id));
		}
		}else{
			if($product_arr['Product']['image']!=''){
				$this->request->data['Product']['image']=$product_arr['Product']['image'];
				$this->request->data['Product']['thumb_image']=$product_arr['Product']['thumb_image'];
			}else{
				$this->request->data['Product']['image']='';
				$this->request->data['Product']['thumb_image']='';
			}
		
		}
		// echo '<pre>';
		// print_r($this->request->data);
		// die(); 
			if($this->Product->save($this->request->data)){
				$this->Session->setFlash('The product has been saved','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
				}else{
				$this->Session->setFlash('The product could not be saved. Please, try again.','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	public function admin_delete($id = null) {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Delete');
		$this->checkAdminSession(); 
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid Product'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash('The product has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The product could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	
	function addtocard($productcode=null){
		
		$this->autoRender = false;
		
		$product_arr = $this->Product->find('first',array('conditions' => array('Product.product_code'=>$productcode)));
		
		if(!empty($product_arr)){
			$title = $product_arr['Product']['title']; 
			$category_id = $product_arr['Product']['category_id']; 
			$product_id = $product_arr['Product']['id']; 
			$price_dollar = $product_arr['Product']['price_dollar']; 
						
			$cart_session_id = $this->Session->read('cart_session_id');	
			
			if(empty($cart_session_id)){
				$cart_session_id = strtolower($this->random_password(12));
				$this->Session->write('cart_session_id',$cart_session_id);		
			}	
						
			//$updatecart = $this->Cart->find('first',array('conditions'=>array('Cart.product_id'=>$product_id,'Cart.cart_session_id'=>$cart_session_id)));	
			// if(!empty($updatecart)){
				// $cart['Cart']['id'] =  $updatecart['Cart']['id'];	
				// $cart['Cart']['quantity'] =  $updatecart['Cart']['quantity'] + 1;	
			// }else{
				// $cart['Cart']['quantity'] = 1;
			// }	
			
			$cart['Cart']['quantity'] = 1;
			$cart['Cart']['cart_session_id'] =  $cart_session_id;			
			$cart['Cart']['product_id'] = $product_id;
			$cart['Cart']['category_id'] = $category_id;
			$cart['Cart']['price'] = $price_dollar;
			
			$cart['Cart']['status'] = 1;
			$cart['Cart']['currency'] = '$';
			$this->Cart->save($cart);
			
			$totalcartpro = $this->Cart->find('count',array('conditions'=>array('Cart.cart_session_id'=>$cart_session_id)));	
			
			echo $title.' has successfully added in shoping cart. ## '.$totalcartpro;	
		}	
	}	
	

}
?>