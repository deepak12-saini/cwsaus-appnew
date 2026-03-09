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
class MailersController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','Mailer','NappUser','WelcomeMailer');
	public $components = array('Session','Paginator');	
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
		$this->set('title_for_layout',SITENAME.' Mailer');		
		$this->checkAdminSession(); 
				
	
		
		$this->Mailer->recursive = 0;	
		$date = '';
		$client_id = '';
		$totalsent = 0;
		if(!empty($this->request->data['search']) && !empty($this->request->data['client_id'])){
			
			$date = date('Y-m-d',strtotime($this->request->data['search']));
			$client_id = $this->request->data['client_id'];	
			$this->paginate = array('conditions'=>array('DATE(Mailer.created)'=>$date,'Mailer.user_id'=>$client_id),'page' => 1, 'limit' => 200,'order'=>array('Mailer.id'=>'desc'));
			$totalsent = $this->Mailer->find('count',array('conditions'=>array('DATE(Mailer.created)'=>$date,'Mailer.user_id'=>$client_id)));			
		}else{			
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('Mailer.id'=>'desc'));
			$totalsent = $this->Mailer->find('count');
		}			
		$this->Mailer->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$mailers = $this->Paginator->paginate('Mailer');		
		$this->set('mailers', $mailers);

		$NappUser = $this->NappUser->find('all',array('conditions'=>array('is_approved'=>1,'is_staff_id'=>1),'fields' => array('id','name','lname')));	
		$this->set('client_id', $client_id);
		$this->set('NappUser', $NappUser);
		$this->set('totalsent', $totalsent);
		$this->set('date', $date);
		
	}
	
	public function admin_send() {
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Add New Mailer');
		$this->checkAdminSession(); 
		if (!empty($this->request->data)) {
			
			
			if(!empty($this->request->data['inserIndivdualtname'])){
				$client_requested = $this->request->data['client_requested'];
				for($i=0; $i<count($this->request->data['inserIndivdualtname']); $i++){
					
					$inserIndivdualtname = $this->request->data['inserIndivdualtname'][$i];
					$insertcompanyname = $this->request->data['insertcompanyname'][$i];
					$insertbuildersname = $this->request->data['insertbuildersname'][$i];
					$projectname = $this->request->data['projectname'][$i];
					$datenew = date('Y-m-d',strtotime($this->request->data['date'][$i]));
					$date = date('d/m/Y',strtotime($this->request->data['date'][$i]));
					$insertname =$this->request->data['insertname'][$i]; 
					
					$mobile =$this->request->data['mobile'][$i]; 
					$landline =$this->request->data['landline'][$i]; 
					
					
					if(!empty($this->request->data['senderemail'][$i])){
						$senderemail = $this->request->data['senderemail'][$i]; 
					}else{
						$senderemail = 'info@cwsaus.com.au'; 
					}
					if(!empty($this->request->data['subject'][$i])){
						$subject = $this->request->data['subject'][$i]; 
					}else{
						$subject = 'CWS :- Waterproofing and Epoxy Flooring'; 
					}
										
					$url = 'http://cwsaus.com.au/cws/sendemail.php';
					$fields = array(
						'inserIndivdualtname' => urlencode($inserIndivdualtname),
						'insertcompanyname' => urlencode($insertcompanyname),
						'insertbuildersname' => urlencode($insertbuildersname),
						'projectname' => urlencode($projectname),
						'date' => urlencode($date),
						'insertname' => urlencode($insertname),
						'subject' => urlencode($subject),
						'senderemail' => urlencode($senderemail)
					);
									
					$fields_string = '';
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
					
					$Mailerinsert['Mailer']['id'] = '';
					$Mailerinsert['Mailer']['inserindivdualname'] = $inserIndivdualtname;
					$Mailerinsert['Mailer']['insertcompanyname'] = $insertcompanyname;
					$Mailerinsert['Mailer']['insertbuilderemal'] = $insertbuildersname;					
					$Mailerinsert['Mailer']['date'] = $datenew;
					$Mailerinsert['Mailer']['projectname'] = $projectname;
					$Mailerinsert['Mailer']['insertname'] = $insertname;
					$Mailerinsert['Mailer']['subject'] = $subject;
					$Mailerinsert['Mailer']['sender_email'] = $senderemail;
					$Mailerinsert['Mailer']['mobile'] = $mobile;
					$Mailerinsert['Mailer']['landlineno'] = $landline;
					$Mailerinsert['Mailer']['client_requested'] = $client_requested;
					$Mailerinsert['Mailer']['created'] = date('Y-m-d H:i:s');
					$Mailerinsert['Mailer']['status'] = 1;
				
					$this->Mailer->save($Mailerinsert);		
				}
		
			}	
			$this->Session->setFlash('Emailer sent successfully','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		
	}	
	
	
	function updatewelcome($id=null){
		$this->autoRender = false;
		if(!empty($id)){
			$Mailerinsert['WelcomeMailer']['id'] = $id;
			$Mailerinsert['WelcomeMailer']['status'] = 2;			
			$this->WelcomeMailer->save($Mailerinsert);	
		}
	}	
	
	
	public function welcomemailer(){		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Welcome Mailer');		
		$this->checkSatffSession(); 
		$customer_id=$this->Session->read('Customer.id');
		
		$this->Mailer->recursive = 0;
		$this->paginate = array('conditions'=>array('WelcomeMailer.user_id'=>$customer_id),'page' => 1, 'limit' => 25,'order'=>array('WelcomeMailer.id'=>'desc'));
		$welmailers = $this->Paginator->paginate('WelcomeMailer');		
		$this->set('welmailers', $welmailers);		
	}
	
	public function admin_welcomemailer(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Welcome Mailer');		
		$this->checkAdminSession(); 
				
		
		$this->WelcomeMailer->recursive = 0;	
		$date = '';
		$client_id = '';
		$totalsent = 0;
		if(!empty($this->request->data['search']) && !empty($this->request->data['client_id'])){
			
			$date = date('Y-m-d',strtotime($this->request->data['search']));
			$client_id = $this->request->data['client_id'];	
			$this->paginate = array('conditions'=>array('DATE(WelcomeMailer.created)'=>$date,'WelcomeMailer.user_id'=>$client_id),'page' => 1, 'limit' => 200,'order'=>array('WelcomeMailer.id'=>'desc'));
			$totalsent = $this->WelcomeMailer->find('count',array('conditions'=>array('DATE(WelcomeMailer.created)'=>$date,'WelcomeMailer.user_id'=>$client_id)));			
		}else{			
			$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('WelcomeMailer.id'=>'desc'));
			$totalsent = $this->WelcomeMailer->find('count');
		}			
		$this->WelcomeMailer->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));
		$mailers = $this->Paginator->paginate('WelcomeMailer');		
		$this->set('mailers', $mailers);

		// echo '<pre>';
		// print_r($mailers);
		// die();		
		
		$NappUser = $this->NappUser->find('all',array('conditions'=>array('is_approved'=>1,'is_staff_id'=>1),'fields' => array('id','name','lname')));	
		$this->set('client_id', $client_id);
		$this->set('NappUser', $NappUser);
		$this->set('totalsent', $totalsent);
		$this->set('date', $date);
		
	}
	
	public function admin_sendwelcome(){		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Welcome Mailer');		
		$this->checkAdminSession(); 
		
		if (!empty($this->request->data)) {
			
			$name = $this->request->data['name'];
			$email = $this->request->data['email'];
			
			
			if(!empty($this->request->data['senderemail'])){
				$senderemail = $this->request->data['senderemail'];
			}else{
				$senderemail = 'info@cwsaus.com.au'; 
			}			
			if(!empty($this->request->data['subject'])){
				$subject = $this->request->data['subject'];
			}else{
				$subject = 'Welcome To Construction Waterproofing Solutions'; 
			}
			
			$Mailerinsert['WelcomeMailer']['id'] = '';
			$Mailerinsert['WelcomeMailer']['user_id'] = 0;
			$Mailerinsert['WelcomeMailer']['name'] = $name;
			$Mailerinsert['WelcomeMailer']['email'] = $email;			
			$Mailerinsert['WelcomeMailer']['senderemail'] = $senderemail;			
			$Mailerinsert['WelcomeMailer']['subject'] = $subject;				
			$Mailerinsert['WelcomeMailer']['created'] = date('Y-m-d H:i:s');
			$Mailerinsert['WelcomeMailer']['status'] = 1;			
			$this->WelcomeMailer->save($Mailerinsert);	
			$lastinset = $this->WelcomeMailer->id;
			
			$url = 'http://cwsaus.com.au/welcomemailer/welcomemailer.php';
			$fields = array(
				'lastinset' => urlencode($lastinset),
				'name' => urlencode($name),
				'email' => urlencode($email),
				'senderemail' => urlencode($senderemail),
				'subject' => urlencode($subject)					
			);
							
			$fields_string = '';
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
			
			$this->Session->setFlash('Emailer sent successfully','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'welcomemailer'));
		}	
	}
	
	public function sendwelcome(){		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Welcome Mailer');		
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
		if (!empty($this->request->data)) {
			
			$name = $this->request->data['name'];
			$email = $this->request->data['email'];
			
			
			if(!empty($this->request->data['senderemail'])){
				$senderemail = $this->request->data['senderemail'];
			}else{
				$senderemail = 'info@cwsaus.com.au'; 
			}			
			if(!empty($this->request->data['subject'])){
				$subject = $this->request->data['subject'];
			}else{
				$subject = 'Welcome To Construction Waterproofing Solutions'; 
			}
			
			$Mailerinsert['WelcomeMailer']['id'] = '';
			$Mailerinsert['WelcomeMailer']['user_id'] = $user_id;
			$Mailerinsert['WelcomeMailer']['name'] = $name;
			$Mailerinsert['WelcomeMailer']['email'] = $email;			
			$Mailerinsert['WelcomeMailer']['senderemail'] = $senderemail;			
			$Mailerinsert['WelcomeMailer']['subject'] = $subject;				
			$Mailerinsert['WelcomeMailer']['created'] = date('Y-m-d H:i:s');
			$Mailerinsert['WelcomeMailer']['status'] = 1;			
			$this->WelcomeMailer->save($Mailerinsert);	
			$lastinset = $this->WelcomeMailer->id;
			
			$url = 'http://cwsaus.com.au/welcomemailer/welcomemailer.php';
			$fields = array(
				'lastinset' => urlencode($lastinset),
				'name' => urlencode($name),
				'email' => urlencode($email),
				'senderemail' => urlencode($senderemail),
				'subject' => urlencode($subject)					
			);
							
			$fields_string = '';
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
			
			$this->Session->setFlash('Emailer sent successfully','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'welcomemailer'));
		}	
	}
	
	public function index(){		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Staff Mailer');		
		$this->checkSatffSession(); 
		$customer_id=$this->Session->read('Customer.id');
		
		$this->Mailer->recursive = 0;
		$this->paginate = array('conditions'=>array('Mailer.user_id'=>$customer_id),'page' => 1, 'limit' => 25,'order'=>array('Mailer.id'=>'desc'));
		$mailers = $this->Paginator->paginate('Mailer');		
		$this->set('mailers', $mailers);		
	}
	
	public function send() {
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Send Mailer');
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
		if (!empty($this->request->data)) {
			
			
			if(!empty($this->request->data['inserIndivdualtname'])){
				$client_requested = $this->request->data['client_requested'];
				
				for($i=0; $i<count($this->request->data['inserIndivdualtname']); $i++){
					
					$inserIndivdualtname = $this->request->data['inserIndivdualtname'][$i];
					$insertcompanyname = $this->request->data['insertcompanyname'][$i];
					$insertbuildersname = $this->request->data['insertbuildersname'][$i];
					$projectname = $this->request->data['projectname'][$i];
					$datenew = date('Y-m-d',strtotime($this->request->data['date'][$i]));
					$date = date('d/m/Y',strtotime($this->request->data['date'][$i]));
					$insertname =$this->request->data['insertname'][$i]; 
					
					$mobile =$this->request->data['mobile'][$i]; 
					$landline =$this->request->data['landline'][$i]; 
					
					
					if(!empty($this->request->data['senderemail'][$i])){
						$senderemail = $this->request->data['senderemail'][$i]; 
					}else{
						$senderemail = 'info@cwsaus.com.au'; 
					}
					if(!empty($this->request->data['subject'][$i])){
						$subject = $this->request->data['subject'][$i]; 
					}else{
						$subject = 'CWS :- Waterproofing and Epoxy Flooring'; 
					}
										
					$url = 'http://cwsaus.com.au/cws/sendemail.php';
					$fields = array(
						'inserIndivdualtname' => urlencode($inserIndivdualtname),
						'insertcompanyname' => urlencode($insertcompanyname),
						'insertbuildersname' => urlencode($insertbuildersname),
						'projectname' => urlencode($projectname),
						'date' => urlencode($date),
						'insertname' => urlencode($insertname),
						'subject' => urlencode($subject),
						'senderemail' => urlencode($senderemail)
					);
									
					$fields_string = '';
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
					
					$Mailerinsert['Mailer']['id'] = '';
					$Mailerinsert['Mailer']['user_id'] = $user_id;
					$Mailerinsert['Mailer']['inserindivdualname'] = $inserIndivdualtname;
					$Mailerinsert['Mailer']['insertcompanyname'] = $insertcompanyname;
					$Mailerinsert['Mailer']['insertbuilderemal'] = $insertbuildersname;					
					$Mailerinsert['Mailer']['date'] = $datenew;
					$Mailerinsert['Mailer']['projectname'] = $projectname;
					$Mailerinsert['Mailer']['insertname'] = $insertname;
					$Mailerinsert['Mailer']['subject'] = $subject;
					$Mailerinsert['Mailer']['sender_email'] = $senderemail;
					$Mailerinsert['Mailer']['mobile'] = $mobile;
					$Mailerinsert['Mailer']['client_requested'] = $client_requested;
					$Mailerinsert['Mailer']['landlineno'] = $landline;
					$Mailerinsert['Mailer']['created'] = date('Y-m-d H:i:s');
					$Mailerinsert['Mailer']['status'] = 1;
				
					$this->Mailer->save($Mailerinsert);		
				}
		
			}	
			$this->Session->setFlash('Emailer sent successfully','default',array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	function exportcsv(){
		
		$this->autoRender = false;
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
		
		$mailerArr = $this->Mailer->find('all',array('conditions'=>array('Mailer.user_id'=>$user_id)));
		
		/*  echo '<pre>';
		print_r($mailerArr);
		die();  */
		if(!empty($mailerArr)){
			$filename = "eoi-mailer.csv";
			$fp = fopen('php://output', 'w');
			
			$header = array('id','Individual Name','Receiver Email','Company Name','Projectname','Date','Insert Name','Mobile No.','Landline No.','Sender Email','Subject','created');
			
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			fputcsv($fp, $header);

			$i=1;
			foreach($mailerArr as $mailerArrs){				
				$row['id']=$i;
				$row['inserindivdualname']=$mailerArrs['Mailer']['inserindivdualname'];
				$row['insertbuilderemal']=$mailerArrs['Mailer']['insertbuilderemal'];
				$row['insertcompanyname']=$mailerArrs['Mailer']['insertcompanyname'];
				$row['projectname']=$mailerArrs['Mailer']['projectname'];
				$row['date']= date('d M Y',strtotime($mailerArrs['Mailer']['date']));
				$row['insertname']=$mailerArrs['Mailer']['insertname'];
				$row['mobile']=$mailerArrs['Mailer']['mobile'];
				$row['landlineno']=$mailerArrs['Mailer']['landlineno'];
				$row['sender_email']=$mailerArrs['Mailer']['sender_email'];
				$row['subject']=$mailerArrs['Mailer']['subject'];
				$row['created']=$mailerArrs['Mailer']['created'];		
									
				fputcsv($fp, $row);
				$i++;
			}
			exit;

		}		
	}	

	function addfield(){

		$this->autoRender = false;
		
		$this->Mailer->query('ALTER TABLE `mailers` ADD `client_requested` VARCHAR(50) NOT NULL AFTER `id`;');
		
		
		$mailerArr = $this->Mailer->find('first');
		echo '<pre>';
		print_r($mailerArr);
		die();
	}	
}
