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
class DialersController extends AppController {
	public $components = array('Session','Paginator');
	public $uses = array('Log','DialerNumber');
	function beforeFilter(){
		$this->callConstants();
	}
	function index(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Dialer');
		$this->checkSatffSession();
		App::import('Vendor','Services_Twilio_Capability',array('file'=>'services/Twilio/Capability.php'));
		$capability = new Services_Twilio_Capability(DIALER_TSID, DIALER_TOKEN);
		#$capability->allowClientOutgoing('AP59a7c2e59a2d42c8bb6df3cdea5a004d');
		$capability->allowClientOutgoing('AP30afc654a59bae82af1924b0c3338501');
		$token = $capability->generateToken();
		// echo '<pre>';
		// print_r($token);
		// die();
		$this->set('token', $token);
	}
	public function voice(){
		$this->checkSatffSession();
		$this->layout='staff_inner_layout';		
		$this->set('title_for_layout',SITENAME.' Voice');
		$this->paginate = array('conditions' => array('Log.user_id'=>$this->Session->read('Customer.id')),'order' =>array('Log.created' => 'desc'));
		$logs = $this->paginate('Log');
		$this->set('logs', $logs);
	}
	function callstablished(){
		$this->autoRender = false;
		if($_REQUEST['dial_number_id'] > 0){
			$client_arr['DialerNumber']['id'] = $_REQUEST['dial_number_id'];
			$client_arr['DialerNumber']['status'] = 1;
			$this->DialerNumber->save($client_arr);
		}
	}
	function savenotes(){
		$this->autoRender = false;
		if($_REQUEST['dial_number_id'] > 0){
			$client_arr['DialerNumber']['id'] = $_REQUEST['dial_number_id'];
			$client_arr['DialerNumber']['comments'] = $_REQUEST['message'];
			$this->DialerNumber->save($client_arr);
		}
	}
	function nextusers(){
		$this->autoRender = false;
		$dialclients = $this->DialerNumber->find('first',array('conditions'=>array('DialerNumber.status'=>0),'order' =>array('DialerNumber.id' => 'asc')));
		if(!empty($dialclients)){
			echo $dialclients['DialerNumber']['id'].'-'.$dialclients['DialerNumber']['phone'].'-'.$dialclients['DialerNumber']['client_id'].'-'.str_replace('+','',DIALER_CALLERID);
		}
	}
	function call(){
		$this->autoRender=false;
		app::import('Model','NappUser');				
		$this->NappUser = new NappUser();
		// put a phone number you've verified with Twilio to use as a caller ID number
		$number = "";
		$user_id = 0;
		// get the phone number from the page request parameters, if given
		if (isset($_REQUEST['PhoneNumber'])) {
			$_REQUEST['PhoneNumber'] = str_replace(' ','',$_REQUEST['PhoneNumber']);
			$_REQUEST['PhoneNumber'] = str_replace('(','',$_REQUEST['PhoneNumber']);
			$_REQUEST['PhoneNumber'] = str_replace(')','',$_REQUEST['PhoneNumber']);
			$_REQUEST['PhoneNumber'] = str_replace('-','',$_REQUEST['PhoneNumber']);
			$number = htmlspecialchars($_REQUEST['PhoneNumber']);
		}
		if (isset($_REQUEST['user_id'])) {
			$user_id = htmlspecialchars($_REQUEST['user_id']);
		}
		if(($number !='') && ($user_id > 0)){
			$user_arr = $this->NappUser->find('first', array('conditions' => array('NappUser.id' =>$user_id)));
			if(!empty($user_arr)){
				Controller::loadModel('Log');
				$this->Log->create();
				$this->request->data['Log']['id'] = ''; 
				$this->request->data['Log']['user_id'] = $user_arr['NappUser']['id']; 
				$this->request->data['Log']['client_id'] = $_REQUEST['client_id']; 
				$this->request->data['Log']['phone_number'] = $number;
				if($this->Log->save($this->request->data)){
					$log_id = $this->Log->getLastInsertId();
					header("content-type: text/xml");
					echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
						echo '<Response>';
							echo '<Dial action="'.SITEURL.'dialers/voice_recording/'.$log_id.'" callerId="'.$_REQUEST['caller_id'].'" record="true">'.$number.'</Dial>';
						echo '</Response>';
						exit;
				}else{
					header("content-type: text/xml");
					echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
						echo "<Response>";
							echo "<Hangup/>";
						echo "</Response>";
					exit;
				}
			}else{
				header("content-type: text/xml");
				echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
					echo "<Response>";
						echo "<Hangup/>";
					echo "</Response>";
				exit;
			}
		}else{
			header("content-type: text/xml");
			echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
				echo "<Response>";
					echo "<Hangup/>";
				echo "</Response>";
			exit;
		}
	}
	function voice_recording($log_id=null){
		$this->autoRender=false;
		Controller::loadModel('Log');
		$log_arrdetails = $this->Log->find('first', array('conditions' => array('Log.id' =>$log_id)));
		$this->request->data['Log']['id'] = $log_id;
		if(isset($_REQUEST['RecordingUrl'])){
			$this->request->data['Log']['voice_url'] = $_REQUEST['RecordingUrl'];
		}
		if(isset($_REQUEST['RecordingDuration'])){
			$this->request->data['Log']['call_duration'] = $_REQUEST['RecordingDuration'];
		}else if(isset($_REQUEST['DialCallDuration'])){
			$this->request->data['Log']['call_duration'] = $_REQUEST['DialCallDuration'];
		}
		if(isset($_REQUEST['DialCallStatus'])){
			$this->request->data['Log']['status'] = $_REQUEST['DialCallStatus'];
		}else{
			$this->request->data['Log']['status'] = $_REQUEST['CallStatus'];
		}	
		$this->request->data['Log']['created'] = date("Y-m-d H:i:s"); 
		$this->Log->save($this->request->data);
		header("content-type: text/xml");
			echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
			echo "<Response>";
			echo "</Response>";
		exit;
	}
}