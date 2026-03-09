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
class OrganisationsController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','CircularRelation','CircularManagementReview','NappUser','Agenda','Department','Complaint','CircularAction');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function index(){
		$this->autoRender = false;
		
		$this->redirect('circular');
	}	

	function circular(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Management Review List');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');
		
		
		$CircularRelation = $this->CircularRelation->find('list',array('conditions'=>array('CircularRelation.emp_id'=>$emp_id),'fields'=>array('circular_id')));
		
		$this->CircularManagementReview->bindModel(
		array('hasMany' => array('CircularRelation' => array(
			'className' => 'CircularRelation',			 
			'foreignKey' => 'circular_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->CircularRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('dept_id','name','lname'),
			'order' => array(),
		))));
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->CircularManagementReview->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('dept_id','name','lname'),
			'order' => array(),
		))));
		$this->CircularManagementReview->recursive =3;		
		$this->paginate = array('conditions'=>array('OR'=>array('CircularManagementReview.emp_id'=>$emp_id,'CircularManagementReview.id'=>$CircularRelation)),'page' => 1, 'limit' => 25,'order'=>array('CircularManagementReview.id'=>'DESC'));
		$circularArr = $this->Paginator->paginate('CircularManagementReview');
		$this->set('circularArr',$circularArr);
		$this->set('emp_id',$emp_id);	 
	}
	
	function edit($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Management Review List');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');
		
		$this->CircularManagementReview->bindModel(
			array('hasMany' => array('CircularRelation' => array(
			'className' => 'CircularRelation',			 
			'foreignKey' => 'circular_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$CircularManagementReviewArr = $this->CircularManagementReview->find('first',array('conditions'=>array('CircularManagementReview.emp_id'=>$emp_id,'CircularManagementReview.id'=>$id)));
		if(empty($CircularManagementReviewArr)){
			$this->redirect('circular');	
		}	
		$this->set('CircularManagementReviewArr',$CircularManagementReviewArr);
		
		if(!empty($this->request->data)){
			
			$agendId = '';
			if(!empty($this->request->data['agendId'])){
				foreach($this->request->data['agendId'] as $agendIds){
					$agendId .= $agendIds.'##';
				}	
			}	
				
			$insert['CircularManagementReview']['id'] = $id;
			$insert['CircularManagementReview']['admin_id'] = 2;
			$insert['CircularManagementReview']['emp_id'] = $emp_id;
			$insert['CircularManagementReview']['agenda'] = $agendId;
			$insert['CircularManagementReview']['date'] = $this->request->data['Organisation']['date'];
			$insert['CircularManagementReview']['start_time'] = $this->request->data['Organisation']['start_time'];
			$insert['CircularManagementReview']['end_time'] = $this->request->data['Organisation']['end_time'];
			$insert['CircularManagementReview']['created'] = date('Y-m-d H:i:s');
			// echo '<pre>';
			// print_r($insert);
			// die();
			$this->CircularManagementReview->save($insert);
			$CircularManagementReview_id = $this->CircularManagementReview->id;
			$this->CircularRelation->query("delete from circular_relations where circular_id=".$id."");
			if(!empty($this->request->data['emp_id'])){				
				foreach($this->request->data['emp_id'] as $emp_ids){
					$CircularRelation['CircularRelation']['id'] = '';
					$CircularRelation['CircularRelation']['emp_id'] = $emp_ids;
					$CircularRelation['CircularRelation']['circular_id'] = $CircularManagementReview_id;
					$this->CircularRelation->save($CircularRelation);
				}	
			}
			$this->redirect('circular');
		}

		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
	
		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);
		
		$AgendaArr = $this->Agenda->find('all');
		$this->set('AgendaArr',$AgendaArr);
		
		
		
	
	}
	
	function result($circular_id=null){
	
	$this->layout='staff_inner_layout';
	$this->set('title_for_layout',SITENAME.' Result Page');
	$this->checkSatffSession();
	$emp_id=$this->Session->read('Customer.id');
	
	
	$reviewArr = $this->CircularAction->find('all',array('conditions'=>array('CircularAction.circular_id'=>$circular_id)));
	$this->set('reviewArr',$reviewArr);
	
	
	$this->CircularManagementReview->bindModel(
		array('hasMany' => array('CircularRelation' => array(
		'className' => 'CircularRelation',			 
		'foreignKey' => 'circular_id',				
		'conditions' => array(),
		'fields' => '',
		'order' => array(),
	))));
	$CircularManagementReviewArr = $this->CircularManagementReview->find('first',array('conditions'=>array('CircularManagementReview.id'=>$circular_id)));
	if(empty($CircularManagementReviewArr)){
		$this->redirect('circular');	
	}	
	$this->set('CircularManagementReviewArr',$CircularManagementReviewArr);
	$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));

	$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
	$this->set('NappUser',$NappUser);
	
	$AgendaArr = $this->Agenda->find('all');
	$this->set('AgendaArr',$AgendaArr); 
	
	
	}
	function closemom($id=null){
	
	$this->layout='staff_inner_layout';
	$this->set('title_for_layout',SITENAME.' Close Mintues of Meeting');
	$this->checkSatffSession();
	$emp_id=$this->Session->read('Customer.id');
	
		
		$this->CircularManagementReview->bindModel(
			array('hasMany' => array('CircularRelation' => array(
			'className' => 'CircularRelation',			 
			'foreignKey' => 'circular_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$CircularManagementReviewArr = $this->CircularManagementReview->find('first',array('conditions'=>array('CircularManagementReview.emp_id'=>$emp_id,'CircularManagementReview.id'=>$id)));
		if(empty($CircularManagementReviewArr)){
			$this->redirect('circular');	
		}	
		$this->set('CircularManagementReviewArr',$CircularManagementReviewArr);		
		if(!empty($this->request->data)){			
			$meeting_id = $CircularManagementReviewArr['CircularManagementReview']['meeting_id'];
			
					
			if(!empty($this->request->data[title])){
				$this->CircularAction->query("delete from circular_actions where circular_id= ".$id."");
				for($i=1; $i<=count($this->request->data['title']);  $i++){
					
				$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');
				$update['CircularAction']['id'] = '';
				$update['CircularAction']['circular_id'] = $id;
				$update['CircularAction']['agenda'] = $this->request->data['title'][$i];
				$update['CircularAction']['description'] = $this->request->data['description'][$i];
				$update['CircularAction']['responsiblity'] = $this->request->data['responsiblity'][$i];
				$update['CircularAction']['time_frame'] = $this->request->data['time_frame'][$i];
				$update['CircularAction']['added_by'] = $name;
				$update['CircularAction']['created'] = date('Y-m-d H:i:s');
				$this->CircularAction->save($update);				
				} 
				// update status
				$UpdateCircularManagementReview['CircularManagementReview']['id'] = $id;
				$UpdateCircularManagementReview['CircularManagementReview']['status'] = 1;
				$UpdateCircularManagementReview['CircularManagementReview']['start_time'] = $this->request->data['Organisation']['start_time'];
				$UpdateCircularManagementReview['CircularManagementReview']['end_time'] = $this->request->data['Organisation']['end_time'];
				$this->CircularManagementReview->save($UpdateCircularManagementReview);
				
				if(!empty($CircularManagementReviewArr['CircularRelation'])){				
					foreach($CircularManagementReviewArr['CircularRelation'] as $CircularManagementReviewArrs){					
					$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$CircularManagementReviewArrs['emp_id'])));
						if(!empty($NappUserArr)){
							$user_id = $NappUserArr['NappUser']['id'];
							$to_email = $NappUserArr['NappUser']['email'];	
							$to_name  = $NappUserArr['NappUser']['name'].' '.$NappUserArr['NappUser']['lname'];	
							$subject = SITENAME." :: Mintue Of Meeting(#".$meeting_id.") Finished";				
							$template_name = 'finish_mintue_of_meeting';	
							$url  = SITEURL.'organisations/autologin/'.base64_encode($user_id);
							//$date = date('d M Y',strtotime($this->request->data['Organisation']['date']));
							//$time = $this->request->data['Organisation']['start_time'].' '.$this->request->data['Organisation']['end_time'];
							$variables = array('to_name'=>$to_name,'meeting_id'=>$meeting_id,'url'=>$url);		
							try{ 
								$this->sendemail($to_email,$subject,$template_name,$variables);
							}catch (Exception $e){
								
							}						
						}  					
					}	
				}
				$this->redirect('circular');
			}
		}

		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
	
		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);
		
		$AgendaArr = $this->Agenda->find('all');
		$this->set('AgendaArr',$AgendaArr);
		
	}
	function autologin($user_id=null){
		
		$this->autoRender = false;
		
		$ComplaintArrs = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>base64_decode($user_id))));		
		if(!empty($ComplaintArrs)){								
			$this->Session->write('Customer', $ComplaintArrs['NappUser']);
			$this->Session->write('is_customer', 1);			
			$this->redirect('circular');
					
		}else{
			$this->redirect('/login');
		}	
			
	}
	function add(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Circular Management Review List');
		$this->checkSatffSession();
		$emp_id=$this->Session->read('Customer.id');
		
		$cname = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');
		
		if(!empty($this->request->data)){
			
				// send email to intiative
			// $compaint_by = $ConformanceArr['Conformance']['compaint_by'];			
			// $to_email = $NappUserArr['NappUser']['email'];
			
			$circularArr = $this->CircularManagementReview->find('first',array('order'=>array('CircularManagementReview.id'=>'DESC')));	
			$meeting_id = 1000 + $circularArr['CircularManagementReview']['id'];
			$meeting_id = 'MM-'.$meeting_id;
			
				
			$agendId = '';
			if(!empty($this->request->data['agendId'])){
				foreach($this->request->data['agendId'] as $agendIds){
					$agendId .= $agendIds.'##';
				}	
			}	
						
			$insert['CircularManagementReview']['admin_id'] = 2;
			$insert['CircularManagementReview']['meeting_id'] = meeting_id;
			$insert['CircularManagementReview']['emp_id'] = $emp_id;
			$insert['CircularManagementReview']['agenda'] = $agendId;
			$insert['CircularManagementReview']['date'] = $this->request->data['Organisation']['date'];
			$insert['CircularManagementReview']['start_time'] = $this->request->data['Organisation']['start_time'];
			$insert['CircularManagementReview']['end_time'] = $this->request->data['Organisation']['end_time'];
			$insert['CircularManagementReview']['extra'] = $this->request->data['Organisation']['extra'];
			$insert['CircularManagementReview']['created'] = date('Y-m-d H:i:s');
			// echo '<pre>';
			// print_r($insert);
			// die();
			$this->CircularManagementReview->save($insert);
			$CircularManagementReview_id = $this->CircularManagementReview->id;
			if(!empty($this->request->data['emp_id'])){
				foreach($this->request->data['emp_id'] as $emp_ids){
					$CircularRelation['CircularRelation']['id'] = '';
					$CircularRelation['CircularRelation']['emp_id'] = $emp_ids;
					$CircularRelation['CircularRelation']['circular_id'] = $CircularManagementReview_id;
					$this->CircularRelation->save($CircularRelation);
					
					$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$emp_ids)));	
					if(!empty($NappUserArr)){
						$user_id = $NappUserArr['NappUser']['id'];
						$to_email = $NappUserArr['NappUser']['email'];
						$to_name  = $NappUserArr['NappUser']['name'].' '.$NappUserArr['NappUser']['lname'];	
						$subject = SITENAME." :: Schedule mintue of meeting";				
						$template_name = 'mintue_of_meeting';	
						$url  = SITEURL.'organisations/autologin/'.base64_encode($user_id);
						$date = date('d M Y',strtotime($this->request->data['Organisation']['date']));
						$time = $this->request->data['Organisation']['start_time'].' '.$this->request->data['Organisation']['end_time'];
						$variables = array('to_name'=>$to_name,'meeting_id'=>$meeting_id,'cname'=>$cname,'date'=>$date,'time'=>$time,'url'=>$url);		
						try{ 
							$this->sendemail($to_email,$subject,$template_name,$variables);
						}catch (Exception $e){
							
						}
						
					}					
				}	
			}
			$this->redirect('circular');
		}

		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
	
		$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
		$this->set('NappUser',$NappUser);
		
		$AgendaArr = $this->Agenda->find('all');
		$this->set('AgendaArr',$AgendaArr);
	}	
		

	
	
	function admin_result($circular_id=null){
	
	$this->layout='admin_layout';
	$this->set('title_for_layout',SITENAME.' Result Page');
	$this->checkAdminSession();	

	$emp_id=$this->Session->read('Customer.id');
	$reviewArr = $this->CircularAction->find('all',array('conditions'=>array('CircularAction.circular_id'=>$circular_id)));
	$this->set('reviewArr',$reviewArr);
	
	
	$this->CircularManagementReview->bindModel(
		array('hasMany' => array('CircularRelation' => array(
		'className' => 'CircularRelation',			 
		'foreignKey' => 'circular_id',				
		'conditions' => array(),
		'fields' => '',
		'order' => array(),
	))));
	$CircularManagementReviewArr = $this->CircularManagementReview->find('first',array('conditions'=>array('CircularManagementReview.id'=>$circular_id)));
	if(empty($CircularManagementReviewArr)){
		$this->redirect('circular');	
	}	
	$this->set('CircularManagementReviewArr',$CircularManagementReviewArr);
	$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));

	$NappUser = $this->NappUser->find('all',array('conditions'=>array('NappUser.id !='=>$emp_id,'NappUser.is_staff_id'=>1)));
	$this->set('NappUser',$NappUser);
	
	$AgendaArr = $this->Agenda->find('all');
	$this->set('AgendaArr',$AgendaArr); 
	
	
	}

	function admin_index(){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkAdminSession();
				
		$this->CircularManagementReview->bindModel(
		array('hasMany' => array('CircularRelation' => array(
			'className' => 'CircularRelation',			 
			'foreignKey' => 'circular_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->CircularRelation->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('dept_id','name','lname'),
			'order' => array(),
		))));
		$this->NappUser->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => array(),
			'order' => array(),
		))));
		
		$this->CircularManagementReview->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('dept_id','name','lname'),
			'order' => array(),
		))));
		$this->CircularManagementReview->recursive =3;		
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('CircularManagementReview.id'=>'DESC'));
		$circularArr = $this->Paginator->paginate('CircularManagementReview');
		$this->set('circularArr',$circularArr);
		
		// echo '<pre>';
		// print_r($circularArr);
		// die();
	}	

	function admin_detail($complaint_id=null,$type=null){
		
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Complaint List');
		$this->checkAdminSession();

		$complaint_id = base64_decode($complaint_id);
		$this->Complaint->bindModel(
		array('belongsTo' => array('Department' => array(
			'className' => 'Department',			 
			'foreignKey' => 'dept_id',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('ComplaintType' => array(
			'className' => 'ComplaintType',			 
			'foreignKey' => 'complaint_type',				
			'conditions' => array(),
			'fields' => '',
			'order' => array(),
		)))); 
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'complaint_to',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
		$this->Complaint->bindModel(
		array('belongsTo' => array('NappUser1' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'emp_id',				
			'conditions' => array(),
			'fields' => array('name','lname','id'),
			'order' => array(),
		))));
				
		$ComplaintArr = $this->Complaint->find('first',array('conditions'=>array('Complaint.complaint_id'=>$complaint_id)));
		$this->set('ComplaintArr',$ComplaintArr);
		$this->set('type',$type);
			
	}		
	
}
