<?php
class UsersController extends AppController {
	
	var $name = 'Users';
	
	var $components = array('Email','Stripe');
   
	public $uses = array('User','Log','Contact','Country','SimRequest','Referral','Point');		
	
	 function admin_login(){ 
	
     $this->layout="admin_login_layout";

	 $user_id=$this->Session->read('User.id');
	
		if($user_id){
		
		$this->redirect('dashboard');

		}
		

		if(!empty($this->data)){

			$admin_arr = $this->User->find('first',array('conditions'=>array('username'=>$this->data['User']['username'],'password'=>md5($this->data['User']['password']))));

			if(!empty($admin_arr))	{

			$this->Session->write('User', $admin_arr['User']);

			$this->Session->write('Admin', 1);

			$this->redirect('dashboard');

			}else{

     		$this->Session->setFlash(__('Wrong username/password', true));

			}
		} 
	}
	function admin_dashboard(){
		
	$this->checkAdminSession();
		
	$this->layout="admin_inner_layout";
	$date = date('Y-m-d');
	$condition=array('Log.created LIKE'=>$date.'%');
    $this->paginate=array('conditions'=>$condition,'order' => array('Log.id'=>'desc'));
	$this->set('logs',$this->paginate('Log')); 
	
	}
	function admin_view($id=null){
	
	$this->checkAdminSession();
		
	$this->layout="admin_inner_layout";
		
	$this->set('ids',$id);
	
	if(!empty($this->request->data)){
	
     $conditions['AND'] = array();
	
	if((!empty($this->request->data['startDate'])) && (!empty($this->request->data['endDate']))){		

	$contact_id=$this->request->data['ids'];
	
	$this->set('ids',$contact_id);
	
	$start = $this->request->data['startDate'];
				
    $end = $this->request->data['endDate'];
				
			
	$cond = array('Date(Inboxe.created) >=' => $start);
	        array_push($conditions['AND'], $cond);
	$cond1 =array('Date(Inboxe.created) <=' => $end);
			array_push($conditions['AND'], $cond1);			
    $cond2= array('Inboxe.contact_id' =>$contact_id);		
	        array_push($conditions['AND'], $cond2);
		
	$this->Session->write('User.condition',$conditions);	
	
	}	
	}else{
	
	$cond3=array('Inboxe.contact_id'=>$id);	       
			
	$this->Session->write('User.condition',$cond3);
	
	}
	
	$condition=$this->Session->read('User.condition');
	
	
    $this->paginate=array('conditions'=>$condition,'order' => array('Inboxe.id'=>'desc'));
		
	$this->set('user_arr',$this->paginate('Inboxe')); 
	
	$this->set('start',$start);
	$this->set('end',$end);	
		
	}	
	function admin_logout() {

    $this->Session->delete('Admin');
    $this->Session->delete('User');

    $this->redirect('/admin');
	
	}

 	
	
	function admin_password($id=null){
	
	$this->layout="admin_inner_layout";
	
	$this->set('ids',$id);
	
	$user_arr=$this->User->find('first',array('conditions'=>array('User.id'=>$id,'User.role'=>'A')));
	
	$email=$user_arr['User']['email'];
	$fname=$user_arr['User']['fname'];
			
	if(!empty($this->request->data)){	
	
	$pws=$this->request->data['User']['password'];	
	$this->request->data['User']['id']=$id;	
	$this->request->data['User']['password']=md5($this->request->data['User']['password']);	
			
	if($this->User->save($this->request->data)) {
		  	
	    $this->Email->to =$email;
        $subject1='Change Password'.SITENAME;
		$this->Email->subject = $subject1;
		$this->Email->from = EMAIL;
		$this->Email->template = 'change_password';
		$this->Email->sendAs = 'html';
		$this->set('first_name',$fname);
		$this->set('password',$pws);	
	    $this->Email->send();
		$this->Session->setFlash(__('Password has been changed. ', true));		
		$this->redirect('dashboard');
	
			}
		}
	}
		
	function admin_forget() {
	
	$this->layout="admin_login_layout";
	
	if(!empty($this->request->data)){
	
	$user_arr=$this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.role'=>'A')));
	
	
	if(!empty($user_arr)) {
	
	$pws=$this->random_generator(8);	
	
	$this->request->data['User']['id']=$user_arr['User']['id'];
	$this->request->data['User']['password']=md5($pws);
		
	$urls=SITEURL;
	$urls=$urls.'/admin';
	
	if($this->User->save($this->request->data))
	
	    $this->Email->to =$this->request->data['User']['email'];
        $subject1=SITENAME .'Forget Password';
		$this->Email->subject = $subject1;
		$this->Email->from = EMAIL;
		$this->Email->template = 'forget_password';
		$this->Email->sendAs = 'html';
		$this->set('first_name', $user_arr['User']['first_name']);
		$this->set('username', $user_arr['User']['username']);
		$this->set('password',$pws);	
		$this->set('url',$urls);		
        $this->Email->send(); 

		$this->Session->setFlash(__('Password has been changed.Please check Email_id ', true));			
		$this->redirect('/admin');
		
	    }else{	
	
		$this->Session->setFlash(__('Email id is not exist', true));		
		$this->redirect('forget');
	
	 }
	   }	
	     }
	// inner pages topup files	 
	function index(){
		$this->layout="ekocalling_layout";
		//$this->layout="front_layout_new";
		$this->set('title_for_layout',SITENAME.' Top Up');					
	}
		
	function payment(){
		$this->layout="ekocalling_layout";
		$this->set('title_for_layout',SITENAME.' Payment Detail');	
		
		if(!empty($this->request->data)){			
			
			$amount = $this->request->data['amount'];
			$mobile_number = $this->request->data['mobile_number'];
			
			if(empty($amount)){
				$this->Session->setFlash(__('Please select amount', true)); 
				$this->redirect('index');					
			}else if (!is_numeric($amount)) {
				$this->Session->setFlash(__('Please enter valid amount', true)); 
				$this->redirect('index');					
			}else if(empty($mobile_number)){
				$this->Session->setFlash(__('Please enter mobile number', true)); 
				$this->redirect('index');					
			}else if (!is_numeric($amount)) {
				$this->Session->setFlash(__('Please enter valid mobile number', true)); 
				$this->redirect('index');					
			}else{
						
			$unique_key = $this->random_generator(8);
			$contact['Contact']['amount'] = $this->request->data['amount'];
			$contact['Contact']['mobile'] = $this->request->data['mobile_number'];
			$contact['Contact']['email'] = $this->request->data['email'];
			$contact['Contact']['unique_key'] = $unique_key;
			$contact['Contact']['created'] = date('Y-m-D H:i:s');
		
			if($this->Contact->save($contact)){
				$this->Session->write('unique_key',$unique_key);
				$this->redirect('payment');
			}
		}
		}
		$uniquekey = $this->Session->read('unique_key');
		$contactdata = $this->Contact->find('first',array('conditions'=>array('Contact.unique_key'=>$uniquekey)));
		if(!empty($contactdata)){
			$this->set('contactdata',$contactdata);			
		}else{
			$this->redirect('/topup');
		}
		$reffral_array = $this->Referral->find('all',array('conditions'=>array('Referral.mail_notify'=>1,'Referral.status'=>1)));
			$this->set('reffral_array',$reffral_array);	
		
		}
		
		// front page topup file
		function topups(){
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Top Up');					
		}	
		function payments(){
			$this->layout="homepage_layout";
			$this->set('title_for_layout',SITENAME.' Payment Detail');	
			
			if(!empty($this->request->data)){		

				$amount = $this->request->data['amount'];
				$mobile_number = $this->request->data['mobile_number'];
				
				if(empty($amount)){
					$this->Session->setFlash(__('Please select amount', true)); 
					$this->redirect('topups');					
				}else if (!is_numeric($amount)) {
					$this->Session->setFlash(__('Please enter valid amount', true)); 
					$this->redirect('topups');					
				}else if(empty($mobile_number)){
					$this->Session->setFlash(__('Please enter mobile number', true)); 
					$this->redirect('topups');					
				}else if (!is_numeric($amount)) {
					$this->Session->setFlash(__('Please enter valid mobile number', true)); 
					$this->redirect('topups');					
				}else{
							
				$unique_key = $this->random_generator(8);
				$contact['Contact']['amount'] = $this->request->data['amount'];
				$contact['Contact']['mobile'] = $this->request->data['mobile_number'];
				$contact['Contact']['email'] = $this->request->data['email'];
				$contact['Contact']['unique_key'] = $unique_key;
				$contact['Contact']['created'] = date('Y-m-D H:i:s');
			
				if($this->Contact->save($contact)){
					$this->Session->write('unique_key',$unique_key);
					$this->redirect('payments');
				}
			}
			}
			$uniquekey = $this->Session->read('unique_key');
			$contactdata = $this->Contact->find('first',array('conditions'=>array('Contact.unique_key'=>$uniquekey)));
			if(!empty($contactdata)){
				$this->set('contactdata',$contactdata);			
			}else{
				$this->redirect('topups');
			}
			
			$reffral_array = $this->Referral->find('all',array('conditions'=>array('Referral.mail_notify'=>1,'Referral.status'=>1)));
			$this->set('reffral_array',$reffral_array);		
		}
			
		
		function our_app(){
			
			$this->layout="inner_layout";
			$this->set('title_for_layout',SITENAME.'Get-Hellomobitel');
		}
		
		
		function bundles(){
			
			$this->layout="ekocalling_layout";
			$this->set('title_for_layout',SITENAME.'Bundles');
		}
		
		function support(){
			
			//$this->layout="microtalkng_layout";
			$this->layout="ekocalling_layout";
			$this->set('title_for_layout',SITENAME.'Support');
		}
		
		
		function convertXmlObjToArr($obj){
		$this->autoRender = false;
					$arr=array();
					$children = $obj->children();
					
						foreach ($children as $elementName => $node){
								// $nextIdx = count($arr);
								$nextIdx = strtolower((string)$elementName);
								//$arr[$nextIdx][] = strtolower((string)$elementName);
								$attributes = $node->attributes();
								foreach ($attributes as $attributeName => $attributeValue)
								{
									$attribName = strtolower(trim((string)$attributeName));
									$attribVal = trim((string)$attributeValue);
									$arr[$nextIdx][] = $attribVal;
								}
								$text = (string)$node;
								$text = trim($text);
								if (strlen($text) > 0)
								{
									$arr[$nextIdx][] = $text;
								}

								$this->convertXmlObjToArr($node, $arr[$nextIdx]);
						}
			
					return $arr;
			}
			 
		 /*****************************Random number*****************************/


	function random_generator($digits){
	
	srand ((double) microtime() * 10000000);

    $input = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z",
						"1","2","3","4","5","6","7","8","9");

		$random_generator="";// Initialize the string to store random numbers

		for($i=1;$i<$digits+1;$i++)	{ 
		
		// Loop the number of times of required digits

		if(rand(1,2) == 1){// to decide the digit should be numeric or alphabet

			$rand_index = array_rand($input);

			$random_generator .=$input[$rand_index]; // One char is added
			
			}	else  {

			$random_generator .=rand(1,7); // one number is added
			
			}

		} // end of for loop

		return $random_generator;


	} // end of function
	
	function success(){		
	
		$this->layout="homepage_layout";
		
		if(!empty($this->request->data)){
			
			
			$id = $this->request->data['id'];
			$contactdata = $this->Contact->find('first',array('conditions'=>array('Contact.id'=>$id,'Contact.status'=>0)));
			if(!empty($contactdata) && (!empty($this->request->data['transaction_id']))){
				// fetch data from contact page. 
			
				$unique_key = $contactdata['Contact']['unique_key'];
				$email = $contactdata['Contact']['email'];
				$amount = $contactdata['Contact']['amount'];
				$mobile = $contactdata['Contact']['mobile'];				
				$description = 'Online Topup';
			
				// transaction id
				$transaction_id = $this->request->data['transaction_id'];	
				
				$url = 'http://89.163.139.76/a2b-api/api.php?currency=GBP&api_security_key=0bd4746da39cfab8b328997ef080da1c&api_method=card_balance_add&username='.$mobile.'&amount='.$amount;
					
				//  Initiate curl
				$ch = curl_init();
				// Disable SSL verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// Will return the response, if false it print the response
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// Set the url
				curl_setopt($ch, CURLOPT_URL,$url);
				// Execute
				$result=curl_exec($ch);
				// Closing
				curl_close($ch);
				// Will dump a beauty json :3
				$response = json_decode($result, true);  
				
				// save data in log table		
				$log['Log']['phone_number'] = $mobile;
				$log['Log']['unique_key'] = $unique_key;
				$log['Log']['email'] = $email;	
				$log['Log']['amount'] = $amount;
				$log['Log']['transaction_payapal'] = $transaction_id;
				$log['Log']['transaction_api'] = '';
				$log['Log']['currency'] = 'GBP';
				$log['Log']['credits'] = $amount;
				$log['Log']['api_status'] = 1;
				$log['Log']['paypal_status'] = 1;
				$log['Log']['created'] = date('Y-m-d H:i:s');
				$this->Log->save($log);
				$log_id = $this->Log->id;
				//update contact table	
				$contact_arr['Contact']['id'] = $contactdata['Contact']['id'];
				$contact_arr['Contact']['status'] = 1;
				$this->Contact->save($contact_arr);
				
				
				// save credits points
				$reffer_status = $this->request->data['reffer_status'];		
				if($reffer_status == 1){
					$refferal_id = $this->request->data['refferal'];
					$reffrals = $this->Referral->find('first',array('conditions'=>array('Referral.id'=>$refferal_id)));
					$commission = $reffrals['Referral']['commission'];
					$credit = $amount * $commission /100 ; // get credit
					
					$points['Point']['name'] = $this->request->data['name'];
					$points['Point']['phone'] = $mobile;
					$points['Point']['email'] = $email;
					$points['Point']['topup_amount'] = $amount;
					$points['Point']['comssion'] = $commission;
					$points['Point']['credits'] = $credit;
					$points['Point']['status'] = 0;
					$points['Point']['created'] = date('Y-m-d H:i:s');
					$points['Point']['referral_id'] = $refferal_id;
					$points['Point']['log_id'] = $log_id;
					$this->Point->save($points);
				}
						
				// send email to customer 
				$this->Email->to =$email;
				$subject ='Success Payment '.SITENAME;
				$this->Email->subject = $subject;
				$this->Email->from = EMAIL;
				$this->Email->template = 'success_payment';
				$this->Email->sendAs = 'html';
				$this->set('amount',$amount);		
				$this->Email->send();	
				
				// delete session value
				$this->Session->delete('unique_key');				
				$this->set('transaction',$transaction_id);		
			
			}else{
				$this->Session->setFlash(__('Something worng. Please try again', true));
				$this->redirect('/account');				
			}
			
		}
			
	}
	
	
	// front enc
	
	function complete(){		
	
		$this->layout="homepage_layout";
		
		if(!empty($this->request->data)){		
			
			$id = $this->request->data['id'];
			$contactdata = $this->Contact->find('first',array('conditions'=>array('Contact.id'=>$id,'Contact.status'=>0)));
			if(!empty($contactdata) && (!empty($this->request->data['transaction_id']))){
						
				// fetch data from contact page. 
			
				$unique_key = $contactdata['Contact']['unique_key'];
				$email = $contactdata['Contact']['email'];
				$amount = $contactdata['Contact']['amount'];
				$mobile = $contactdata['Contact']['mobile'];

				// transaction id
				$transaction_id = $this->request->data['transaction_id'];			
				$description = 'Online Topup';			    
			
				
				$url = 'http://89.163.139.76/a2b-api/api.php?currency=GBP&api_security_key=0bd4746da39cfab8b328997ef080da1c&api_method=card_balance_add&username='.$mobile.'&amount='.$amount;
					
				//  Initiate curl
				$ch = curl_init();
				// Disable SSL verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// Will return the response, if false it print the response
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// Set the url
				curl_setopt($ch, CURLOPT_URL,$url);
				// Execute
				$result=curl_exec($ch);
				// Closing
				curl_close($ch);
				// Will dump a beauty json :3
				$response = json_decode($result, true);  
				
				// save data in log table		
				$log['Log']['phone_number'] = $mobile;
				$log['Log']['unique_key'] = $unique_key;
				$log['Log']['email'] = $email;	
				$log['Log']['amount'] = $amount;
				$log['Log']['transaction_payapal'] = $transaction_id;
				$log['Log']['transaction_api'] = '';
				$log['Log']['currency'] = 'GBP';
				$log['Log']['credits'] = $amount;
				$log['Log']['api_status'] = 1;
				$log['Log']['paypal_status'] = 1;
				$log['Log']['created'] = date('Y-m-d H:i:s');
				$this->Log->save($log);	
				$log_id = $this->Log->id;
								
				//update contact table	
				$contact_arr['Contact']['id'] = $contactdata['Contact']['id'];
				$contact_arr['Contact']['status'] = 1;
				$this->Contact->save($contact_arr);
				
				// save credits points
				$reffer_status = $this->request->data['reffer_status'];		
				if($reffer_status == 1){
					$refferal_id = $this->request->data['refferal'];
					$reffrals = $this->Referral->find('first',array('conditions'=>array('Referral.id'=>$refferal_id)));
					$commission = $reffrals['Referral']['commission'];
					$credit = $amount * $commission /100 ; // get credit
					
					$points['Point']['name'] = $this->request->data['name'];
					$points['Point']['phone'] = $mobile;
					$points['Point']['email'] = $email;
					$points['Point']['topup_amount'] = $amount;
					$points['Point']['comssion'] = $commission;
					$points['Point']['credits'] = $credit;
					$points['Point']['status'] = 0;
					$points['Point']['created'] = date('Y-m-d H:i:s');
					$points['Point']['referral_id'] = $refferal_id;
					$points['Point']['log_id'] = $log_id;
					$this->Point->save($points);
				}
										
				// send email to customer 
				$this->Email->to =$email;
				$subject ='Success Payment '.SITENAME;
				$this->Email->subject = $subject;
				$this->Email->from = EMAIL;
				$this->Email->template = 'success_payment';
				$this->Email->sendAs = 'html';
				$this->set('amount',$amount);		
				$this->Email->send();	
				
				// delete session value
				$this->Session->delete('unique_key');				
				$this->set('transaction',$transaction_id);		
			
			}else{
				$this->Session->setFlash(__('Something worng. Please try again', true));	
				$this->redirect('/account');				
			}
			
		}			
	}		
	
	// webservice : payment and topup
	
	function ws_payment(){		
	
		$this->autoRender = false;	
		
			ob_start();
		echo "<pre>";
		print_r($_POST);
		print_r($_REQUEST);
		echo "</pre>";
		$out1 = ob_get_contents();
		ob_end_clean();
		$file = fopen("debug/ws_topup".time().".txt", "w");
		fwrite($file, $out1); 
		fclose($file); 
		
		/* if((!empty($_POST['phone'])) && (!empty($_POST['amount'])) && (!empty($_POST['email'])) && (!empty($_POST['stripeToken']))){
						
			$unique_key = $this->random_generator(8);
			$email =  $_POST['email'];
			$amount = $_POST['amount'];
			$phone =  $_POST['phone'];		
			$stripeToken = $_POST['stripeToken'];
			$description = 'Online Topup';	
			
			try{				
				$response = $this->Stripe->doOnetimePayment($stripeToken,$amount,$description);	
				// transaction id
				$transaction_id = $response->id;								
				$url = 'http://89.163.139.74/a2b-api/api.php?currency=GBP&api_security_key=0bd4746da39cfab8b328997ef080da1c&api_method=card_balance_add&username='.$phone.'&amount='.$amount;
					
				//  Initiate curl
				$ch = curl_init();
				// Disable SSL verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				// Will return the response, if false it print the response
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// Set the url
				curl_setopt($ch, CURLOPT_URL,$url);
				// Execute
				$result=curl_exec($ch);
				// Closing
				curl_close($ch);
				// Will dump a beauty json :3
				$response = json_decode($result, true);  
				
				//if($response['success'] == 1){
					$log['Log']['api_status'] = 1;
				//}else{
				//	$log['Log']['api_status'] = 0;
				//}	
									
				// save data in log table		
				$log['Log']['phone_number'] = $phone;
				$log['Log']['unique_key'] = $unique_key;
				$log['Log']['email'] = $email;						
				$log['Log']['amount'] = $amount;
				$log['Log']['transaction_payapal'] = $transaction_id;
				$log['Log']['transaction_api'] = '';
				$log['Log']['currency'] = 'GBP';
				$log['Log']['credits'] = $amount;			
				$log['Log']['paypal_status'] = 1;
				$log['Log']['type'] = 1;
				$log['Log']['created'] = date('Y-m-d H:i:s');
				$this->Log->save($log);
											
				// send email to customer 
				$this->Email->to =$email;
				$subject ='Success Payment '.SITENAME;
				$this->Email->subject = $subject;
				$this->Email->from = EMAIL;
				$this->Email->template = 'success_payment';
				$this->Email->sendAs = 'html';
				$this->set('amount',$amount);		
				$this->Email->send();	
				
				$finalresult['status'] = 1;
				$finalresult['msg'] = 'Topup process is completed.';	
			
			}catch(Exception $e){	

				$finalresult['status'] = 0;
				$finalresult['msg']  = $e->json_body['error']['message'];
			}		 
		
		}else{
			$finalresult['status'] = 0;
			$finalresult['msg'] = 'All parameter required.';	
		} */
		$finalresult['status'] = 0;
			$finalresult['msg'] = 'All parameter required.';
		echo json_encode($finalresult);	
	}
	
	############################################ Home Page ##########################################
	
	function home(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Home');
		
		
	}
	/* function home(){
		
		$this->layout="home_layout";
		$this->set('title_for_layout',SITENAME.' Home');
		
		
	} */
	function about_us(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' About Us');
	}

	function term_conditions(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Term Conditions');
	}
	function access_number(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Access Number');
	}
	
	function privacy_policy(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Privacy Policy');
		
	}
	function get_your_data_settings(){
		
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Get your data settings');
		
	}
	
	function admin_free_sim(){
		
	$this->checkAdminSession();
		
	$this->layout="admin_inner_layout";
	
    $this->paginate=array('order' => array('SimRequest.id'=>'desc'));
	$this->set('sim_request',$this->paginate('SimRequest')); 
	
	}
	
	
	function contact_us(){	
		$this->layout="homepage_layout";
		$this->set('title_for_layout',SITENAME.' Contact Us');
		
		if(!empty($this->request->data)){
			
			
			$this->Email->to = 'whitelabelvoip@gmail.com';//ADMIN_EMAIL;
			
			$subject='Contact Us '.SITENAME;
			$this->Email->subject = $subject;
			$this->Email->from = 'noreply@hellomobitel.com';
			$this->Email->template = 'contactus';
			$this->Email->sendAs = 'html';
			$this->set('name', $this->request->data['Contact']['name']);
			$this->set('email', $this->request->data['Contact']['email']);
			$this->set('subject', $this->request->data['Contact']['subject']);
			$this->set('message', $this->request->data['Contact']['message']);		
			$this->Email->send(); 
			$this->Session->setFlash(__('Email is sent successfully', true));
			$this->redirect('contact_us');
		}
	
	}
	function info(){
		
		phpinfo();
		
	}
	

	function configs(){

	$this->autoRender = false;

	$data['Config']['id'] = 1;
	$data['Config']['siteurl'] = '';
	//$this->Config->save($data);

	}
	
	function success_payment(){		
	
		$this->layout="homepage_layout";
		
	}
	function fail_payment(){		
	
		$this->layout="homepage_layout";
		
	}		
	
}
