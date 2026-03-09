<?php 
App::uses('AppController','Controller');
class FrontsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session','Paginator','Email');	
	public $uses = array('Category','Product','Subscriber','Customer','Notification','Device','Contact');
	/***
	/*Author  :Paramjit,
	/*Comment : Check before user is login or not
	****/
	function beforeFilter()
    {
		$this->callConstants();
		$this->getCategories();
		$this->getCartList();
	}
	

	/***
	/*Author  :Ranjit,
	/*Comment :Home Page
	****/
	public function index(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.' | Home Page');	
		
	}
	
	public function index_demo(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.' | Home Page');	
		
	}
	
	public function about(){
		$this->layout='customduro_layout';
		
		$this->set('meta_title','Outdoor Liquid Waterproofing Membrane | Roof and Wall Waterproofing ');
		$this->set('meta_description','Looking for waterproofing membrane in Australia? Durotech provide best quality waterproofing solutions for outdoor, wall and for basement. For more information call 0296031177');
		$this->set('meta_keyword','basement, waterproofing, membrane, outdoor waterproofing, roof membrane');
		
	}
	
	public function technical_literature($project=null){
		$this->layout='customduro_layout';
		#$this->set('title_for_layout',SITENAME.' | Technical Literature');	
		
		$this->set('meta_title','Bitumen, Polyurethane Membrane Waterproofing | Bitumen Sheet Waterproofing');
		$this->set('meta_description','Bitumen Membranes, sheet, polyurethane Membrane and Industrial Bitumens Manufacturer offered by Durotech Industries. Call us 02 9603 1177or Email sales@durotechindustries.com.au');
		$this->set('meta_keyword','bitumen, membrane, waterproofing, bitumen waterproofing, sheet waterproofing');
		
		$searchtitle = '';
		if(!empty($this->request->data)){
			$searchtitle = $this->request->data['search'];			
			$categoryId = $this->Category->find("list",array('conditions'=>array('Category.category_name LIKE'=>'%'.$searchtitle.'%')));	
						
			if(!empty($categoryId)){			
				$product = $this->Product->find("all",array('conditions'=>array('Product.status'=>1,'Product.category_id'=>$categoryId),'order'=>array('Product.title'=>'asc')));		
			}else{
				$product = $this->Product->find("all",array('conditions'=>array('Product.status'=>1,'Product.title LIKE'=>'%'.$searchtitle.'%'),'order'=>array('Product.title'=>'asc')));	
			}		
		}else{
			$product = $this->Product->find('all',array('conditions'=>array('Product.status'=>1,'Product.datasheet !='=>''),'order'=>array('Product.title'=>'asc')));
		}	
			
		$this->set('searchtitle',$searchtitle);
		$this->set('product',$product);
		$this->set('project',$project);
		
	}	
	
	public function technical_literature_bk($project=null){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.' | Technical Literature');	

		$this->set('meta_title','');
		$this->set('meta_description','');
		$this->set('meta_keyword','');	
		
		$this->set('project',$project);
		
	}
	public function durooem(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | DuroOEM');			
	}

	public function durolab(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Duro Lab');			
	}
	
	public function flake(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Duro Flake');			
	}
	public function specification(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Specification');			
	}
	
	public function institute_waterproofing(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Durotech Institute Waterproofing');			
	}
	
	public function video(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Durotech Institute Waterproofing');			
	}
	public function faq(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.'  | Durotech Faq');			
	}
	function subscribe(){
		$this->autoRender = false;
		
		isset($_REQUEST['email'])? $email = $_REQUEST['email'] : $email = '';
		if(!empty($email)){
			$Subscriber = $this->Subscriber->find('first',array('conditions'=>array('Subscriber.email'=>$email)));
			if(empty($Subscriber)){
				$Subscriber['Subscriber']['email'] = $email;
				$this->Subscriber->save($Subscriber);
			}
			echo 'You successfully subscribed.';
		}else{
			echo 'Email id required;';
		}		
				
	}	
	
		/***
	/*Author  :Ranjit,
	/*Comment : add to cart page
	****/	
	function add_to_cart($item_id,$qty=null){
		
		$this->autoRender= false;		
		if(!empty($item_id)){			
			// cart session Id
			$cart_sessionId = $this->Session->read('cart');
			if(empty($cart_sessionId)){
				$sessionId = $this->random_password(12);
				$this->Session->write('cart',$sessionId);
			}else{
				$sessionId = $cart_sessionId;
			}	
	
			$condition = array('Product.id'=>$item_id);
			$product_list = $this->Product->find('first',array('conditions'=>$condition));
			$curr=$this->Session->read('currency');
			if(!empty($curr))
			{
				$cur_val=$curr;
			}else{
				$cur_val='dollar';
			}
			if($curr=='euro')
			{
				$price=$product_list['Product']['price_euro'];			
			}else{
				$price=$product_list['Product']['price_dollar'];		
			}
		
			$stock = $product_list['Product']['stock'];
			// CHECK IF STOCK QTY LESS THAN WE CANN'T GIVE PERMISSION 
			
				
			$ShopCartArr = $this->ShopCart->find('first',array('conditions'=>array('ShopCart.product_id'=>$item_id,'ShopCart.session_id'=>$sessionId)));
				
			// Add to cart 				
				if(!empty($qty)){
					//$price = $qty * $product_list['Item']['price'];				
					//$price = $product_list['Product']['price'];				
				}else{
					$qty = 1;
					//$price = $product_list['Product']['price'];
				}
				
				if(!empty($ShopCartArr)){
					$cart_data['ShopCart']['id'] = $ShopCartArr['ShopCart']['id'];
					$qty = $ShopCartArr['ShopCart']['quantity'] + $qty;
					$price = $ShopCartArr['ShopCart']['price'] + $price;
					
				}
				
				if($stock >= $qty){
					
					
					$cart_data['ShopCart']['category_id'] = $product_list['Product']['category_id'];
					$cart_data['ShopCart']['product_id'] = $product_list['Product']['id'];
					$cart_data['ShopCart']['price'] = $price;
					$cart_data['ShopCart']['quantity'] = $qty;
					$cart_data['ShopCart']['currency'] = $cur_val;
					$cart_data['ShopCart']['session_id'] = $sessionId;
					$cart_data['ShopCart']['status'] = 0; //  '0=>not clear,1=>clear'
					$cart_data['ShopCart']['date'] = date('Y-m-d H:i:s');
					//echo '<pre>';print_r($cart_data);die;
					$this->ShopCart->save($cart_data);				
					echo '1##'.ucfirst($product_list['Product']['title']);				
				}else{
					echo '0##'.$stock;
				}
		}		
	}
	/***
	/*Author  :Ranjit,
	/*Comment :Contact Page
	****/
	public function contact(){
		$this->layout='customduro_layout';
		$this->set('title_for_layout',SITENAME.' Contact');	

		if(!empty($this->request->data)){
			
		
	
			$name =  $this->request->data['name'];
			$email =  $this->request->data['email'];
			$phone =  $this->request->data['phone'];
			$body =  $this->request->data['message'];
			
			$contact['Contact']['name'] = $name;
			$contact['Contact']['email'] = $email;
			$contact['Contact']['phone'] = $phone;
			$contact['Contact']['message'] = $body;
			$contact['Contact']['created'] = date('Y-m-d H:i:s');
			$this->Contact->save($contact);
			
			$subject = SITENAME.' :: Contact Us';
			$to = 'sales@durotechindustries.com.au';
			$template_name = 'conatact';
			$variables = array('name'=>$name,'email'=>$email,'phone'=>$phone,'body'=>$body);
			try{
				$this->sendemail($to,$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}	
			
			try{
				$this->sendemail('technical@durotechindustries.com.au',$subject,$template_name,$variables);
			}catch (Exception $e){
				
			}	
			/* $message = 'Hi,';
			$message .= '<p>'.$name.' want to contact us</p>';
			$message .= '<p></p>';
			$message .= '<p>Name : '.$name.'</p>';
			$message .= '<p>Email : '.$email.'</p>';
			$message .= '<p>Phone : '.$phone.'</p>';
			$message .= '<p>Message : '.$body.'</p>';
			$message .= '<p></p>';
			$message .= '<p>Thanks,</p>';
			$message .= '<p><A href="www.durotechindustries.com.au">www.durotechindustries.com.au</a></p>';
			
			//$to = MAILTO;
			$to = 'sales@durotechindustries.com.au';
			$subject = SITENAME.' :: Contact Us';
			// SEND EMAIL
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <'.EMAIL.'>' . "\r\n";	
			mail($to,$subject,$message,$headers); */
			
			$this->Session->setFlash('Your mesage has been sent successfully.','default',array('class' => 'alert alert-success'));
			$this->redirect('/contact');
		}	
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Contact Page
	****/
	public function change_currency($type=null){
		$this->autoRender=false;
		if($type=='Euro €')
		{
			$this->Session->write('currency','euro');
		}else{
			$this->Session->write('currency','dollar');
		}
		
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Login/Signup Page
	****/
	public function login(){
		$this->layout='front_layout';
		$this->set('title_for_layout',SITENAME.' Login');
		if(!empty($this->request->data)){
			
			//signup process
			if(isset($this->request->data['signup']))
			{
				//check email if already exist
				$customerEmail = $this->Customer->find('first',array('conditions'=>array('Customer.email'=>$this->request->data['Customer']['email'])));
				if(!empty($customerEmail))
				{
					$this->Session->setFlash('Email id is already exist','default',array('class' => 'alert alert-danger'));
					$this->redirect('/login');
				}
				$this->request->data['Customer']['unique_id']= $this->random_password(10);
				$this->request->data['Customer']['status']=1;
				if($this->Customer->save($this->request->data))
				{
					$to=$this->request->data['Customer']['email'];
					$name=$this->request->data['Customer']['fname'];
					$password=$this->request->data['Customer']['password'];
					$subject = SITENAME.' :: Account Registered';	
					$template_name='message';
					$top_content = 'Your account has been created successfully.Here is your login account detail :';
					$variables=array('password'=>$password,'top_content'=>$top_content,'name'=>$name,'email'=>$to,'type'=>'signup');
					$this->sendemail($to,$subject,$template_name,$variables);
					$this->Session->setFlash('Register successfully.','default',array('class' => 'alert alert-success'));
					$this->redirect('/login');
				}
				
			}
			
			//login process
			if(isset($this->request->data['login']))
			{
				$email = $this->request->data['Customer']['email'];
				$password = $this->request->data['Customer']['password'];
			
				$customer = $this->Customer->find('first',array('conditions'=>array('Customer.email'=>$email,'Customer.password'=>$password)));
				if(!empty($customer)){
					$this->Session->write('customer',$customer['Customer']);   
					$this->Session->write('is_customer',1);   
					$this->redirect('/profile'); 
				}else{
					$this->Session->setFlash('Wrong email or password.','default',array('class' => 'alert alert-danger'));
				} 
			}
			
		}			
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Shop Page
	****/
	public function shop($category=null){
		$this->layout='front_layout';
		$this->set('title_for_layout',SITENAME.' Shop');
		$categories = $this->Category->find('all',array('conditions'=>array('Category.status'=>1),'order'=>'Category.category_name asc'));	
		$this->set('categories',$categories);
		if($category!='')
		{
			$categoryInfo = $this->Category->find('first',array('conditions'=>array('Category.slug'=>$category),'order'=>'Category.category_name asc'));	
			if(!empty($categoryInfo))
				$this->paginate = array('conditions'=>array('Product.category_id'=>$categoryInfo['Category']['id']),'page' => 1, 'limit' => 10,'order'=>'Product.id asc');	
			else
				$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>'Product.id asc');	
		}else{
			
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 10,'order'=>'Product.id asc');		
		}
		
		$this->Category->recursive = 0;
		$products = $this->Paginator->paginate('Product');	
		//echo '<pre>';print_r($products);die;
		$this->set('products',$products);	
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Product Detail Page
	****/
	public function product_detail($id=null){
		$this->layout='front_layout';
		$this->set('title_for_layout',SITENAME.' Product Detail');
		$categories = $this->Category->find('all',array('conditions'=>array('Category.status'=>1),'order'=>'Category.category_name asc'));	
		$this->set('categories',$categories);		
		$this->Product->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',			 
		'foreignKey' => 'category_id',				
		'conditions' => array(),
		'fields' => 'id,category_name',
		'order' => array(),
		)))); 
		$product = $this->Product->find('first',array('conditions'=>array('Product.product_code'=>$id)));
		$this->set('product',$product);				
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :checkout Page
	****/
	public function checkout(){
		$this->layout='front_layout';
		$this->set('title_for_layout',SITENAME.' Checkout');
			
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :cart Page
	****/
	public function cart(){
		$this->layout='front_layout';
		$this->set('title_for_layout',SITENAME.' Cart Items');
		app::import('Model', 'ShopCart');
		$this->GroceryCart = new ShopCart();
				
		$sessionId = $this->Session->read('cart');
		if(empty($sessionId)){
			return $this->redirect('/shop');
		}		
		$this->ShopCart->bindModel(
			array('belongsTo' => array('Product' => array(
				'className' => 'Product',			 
				'foreignKey' => 'product_id',				
				'conditions' => array(),
				'fields' => '',
				'order' => array(),
			))));
		
		// get value from cart
		$condition = array('ShopCart.session_id'=>$sessionId);
		$item_list = $this->ShopCart->find('all',array('conditions'=>$condition));
		$this->set('itemlist',$item_list);
		//echo '<pre>';print_r($item_list);die;
		if(!empty($this->request->data)){
			
			$i=0;
			$j=0;
			
			foreach($this->request->data['id'] as $ids){
				$item_id = $this->request->data['item_id'][$i];	
				$itemArr = $this->Product->find('first',array('conditions'=>array('Product.id'=>$item_id)));
				$stock = $itemArr['Product']['stock'];
				if($this->request->data['quantity'][$i] > $stock){
					$data['ShopCart']['quantity'] = $stock;
					$data['ShopCart']['id'] = $ids;
					$data['ShopCart']['price'] = $this->request->data['price'][$i];								
					$this->GroceryCart->save($data);
					$j = 1;
				}else{
					$data['ShopCart']['quantity'] = $this->request->data['quantity'][$i];
					$data['ShopCart']['id'] = $ids;
					$data['ShopCart']['price'] = $this->request->data['price'][$i];								
					$this->ShopCart->save($data);
				}
				if($j == 1){
					$this->Session->setFlash('Cart has been updated also updated max stock quantity.','default',array('class' => 'alert alert-success'));
				}else{
					$this->Session->setFlash('Cart has been updated.','default',array('class' => 'alert alert-success'));
				}				
			$i++;
			}			
			$this->redirect('cart');		
	}
	}
	
	// delete item from  cart
	function DeleteCartItem($cartId = null,$type=null){		
		$this->autoRender = false;		
		if(!empty($cartId)){
			$this->ShopCart->delete($cartId);
			$this->Session->setFlash('Product successfully deleted from cart.','default',array('class' => 'alert alert-success'));
			if($type == 1){
				$this->redirect('cart');
			}else{
				$this->redirect('/shop');
			}
			
		}
		
	}
	
	function send_subscriber()
	{
		app::import('Model', 'Subscriber');
        $this->Subscriber = new Subscriber();
		if(!empty($this->request->data)){
			$subscriber=$this->Subscriber->find('all',array('conditions'=>array('Subscriber.email'=>$this->request->data['Subscriber']['email'])));
			if(empty($subscriber))
			{
				$this->Subscriber->create();
				$this->Subscriber->save($this->request->data);
			}
			$this->redirect('index');
		}
	}
	
	/***
	/*Author  :Ranjit,
	/*Comment :Admin Notification list
	****/
	public function admin_index(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Notification');		
		$this->checkAdminSession(); 
		
		$this->Notification->bindModel(
		array('belongsTo' => array('Product' => array(
			'className' => 'Product',			 
			'foreignKey' => 'product_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
				
		$this->Notification->recursive = 0;
		$this->paginate = array('page' => 1, 'limit' => 25);
		$notification = $this->Paginator->paginate('Notification');
		// echo '<pre>';	
		// print_r($notification);
		// die();	
		$this->set('notification', $notification);		
		
		
	}
	
	public function admin_send(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Notification');		
		$this->checkAdminSession(); 
	
		if(!empty($this->request->data)){
			
			$type = $this->request->data['type'];
			$title = $this->request->data['title'];
			$description = $this->request->data['description'];
			$product_id = $this->request->data['product_id'];
			
			if(!empty($_FILES['image']['name'])){
			
				$file = $_FILES['image'];
				$filename = $file['name'];
				$tmp_name = $file['tmp_name'];			
				$ext = pathinfo($filename, PATHINFO_EXTENSION);			
				$oringinalfilename = time().'.'.$ext;
				move_uploaded_file($tmp_name,'product_image/'.$oringinalfilename);					
			}else{
				$oringinalfilename = '';
			}

			$created = date('Y-m-d H:i:s');
			$notificationArr['Notification']['type'] = $type;
			$notificationArr['Notification']['product_id'] = $product_id;
			$notificationArr['Notification']['title'] = $title;
			$notificationArr['Notification']['description'] = $description;
			$notificationArr['Notification']['image'] = $oringinalfilename;
			$notificationArr['Notification']['created'] = $created;
			$this->Notification->save($notificationArr);
			
			$deviceArr =  $this->Device->find('all');
			
			if(!empty($deviceArr)){
				foreach($deviceArr as $deviceArrs){
					$device_token = $deviceArrs['Device']['device_token'];
					$device_type = $deviceArrs['Device']['device_type'];
					if($device_type == 'android'){					
					//send a notifiation				
						$result = $this->send_android_notification($device_token, $title);					
					}else if($device_type == 'IOS'){						
						//$result =  $this->send_ios_notification($device_token, $title);	
						//$device_token = 'abaeaa3f0ef16abda5593d1bd2b4674bf9d33d912d80d2210d2bee2d732b402f';							
						$url = SITEURL."sendpush.php";						
						$fields = array(
							'deviceToken' => urlencode($device_token),
							'message' => urlencode($title),							
						);
						//url-ify the data for the POST
						foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
						rtrim($fields_string, '&');
						//open connection
						$ch = curl_init();
						//set the url, number of POST vars, POST data
						curl_setopt($ch,CURLOPT_URL, $url);
						curl_setopt($ch,CURLOPT_POST, count($fields));
						curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
						//execute post
						$result = curl_exec($ch);
						//close connection
						curl_close($ch);									
					}	
				}	
			}
			$this->Session->setFlash('Notification has been sent.','default',array('class' => 'alert alert-success'));	
			return $this->redirect(array('action' => 'index'));
		}	
		$Product = $this->Product->find('all',array('conditions'=>array('Product.status'=>1)));
		$this->set('product', $Product);
	}
	
	public function admin_delete($id = null) {
		$this->autoRender = false;
		
		$this->checkAdminSession(); 
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid Notification'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Notification->delete()) {
			$this->Session->setFlash('The Notification has been deleted.','default',array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash('The Notification could not be deleted.Please, try again.','default',array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	function send_android_notification($registration_ids, $message) {
		
		$dat2  =array("message"=>$message);
		$fields = array(
		'registration_ids' => array($registration_ids),
		'data'=> $dat2,
		);

		$headers = array(
		'Authorization: key=AAAABZjbTLg:APA91bG1bzcB06uwvOzNR7-_YJGbJWpKXG7AgcuSeLlbP4YG0C8wz_7L6YYTrh1eYK0V331ESf-2gaxOw4Mnrp3hGQzj3dKepWfKJOmDvIkq1_QjuElsfuyhRiy7RS8Vw_fqwdStEdan', // FIREBASE_API_KEY_FOR_ANDROID_NOTIFICATION
		'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		// Execute post
		$result = curl_exec($ch );
		if($result === false){
		die('Curl failed:' .curl_errno($ch));
		}
		// Close connection
		curl_close( $ch );
		return $result;
	}	
	
	function send_ios_notification($deviceToken,$message){
		
		
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/proPush.pem'; 
		$deviceToken = 'abaeaa3f0ef16abda5593d1bd2b4674bf9d33d912d80d2210d2bee2d732b402f';	
				
		$passphrase = '12345';
		//$filepath  = SITEURL.'proPush.pem';
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', $filepath);
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		// Open a connection to the APNS server
		$fp = stream_socket_client(
		// 'ssl://gateway.push.apple.com:2195', $err,  // For development
		'ssl://gateway.push.apple.com:2195', $err, // for production
		$errstr, 1000, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);
		//echo 'Connected to APNS' . PHP_EOL;
		// Create the payload body
		$body['aps'] = array(
		'alert' => trim($message),
		'sound' => 'default'
		);
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));	
	
		// Close the connection to the server
		fclose($fp);
		return 'success';
	}
}
?>