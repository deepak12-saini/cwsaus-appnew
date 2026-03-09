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
class EstimatorsController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','Estimator','NappUser');
	public $components = array('Session','Paginator');	
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	public function admin_index(){	
	
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Project Estimator');		
		$this->checkAdminSession(); 
		
		$this->Estimator->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25,'order'=>array('Estimator.id'=>'desc'));		
		$this->Estimator->bindModel(
		array('belongsTo' => array('NappUser' => array(
			'className' => 'NappUser',			 
			'foreignKey' => 'user_id',				
			'conditions' => array(),
			'fields' => array('name','lname'),
			'order' => array(),
		))));	
		$Estimators = $this->Paginator->paginate('Estimator');			
		$this->set('Estimators', $Estimators);	
		
	}
	
	
	public function index(){	
	
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Project Estimator');		
		$this->checkSatffSession(); 
		$customer_id=$this->Session->read('Customer.id');
		
		$this->Estimator->recursive = 0;
		$this->paginate = array('conditions'=>array('Estimator.user_id'=>$customer_id),'page' => 1, 'limit' => 25,'order'=>array('Estimator.id'=>'desc'));
		$Estimators = $this->Paginator->paginate('Estimator');			
		$this->set('Estimators', $Estimators);	
		
	}
	
	public function autologin() {		
		$this->autorender = false;	
		$admin_arr = $this->User->find('first');				
		$this->Session->write('User', $admin_arr['User']);
		$this->Session->write('is_admin', 1);			
		$this->redirect('/admin/estimators');			
	}
	
	public function addproject(){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.' Add New Project');
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
		
		$docArr = $this->Estimator->find('first',array('order'=>array('Estimator.id'=>'DESC'),'fields'=>array('Estimator.id')));
		if(!empty($docArr['Estimator']['id'])){
			$project_id = 'CWS-'. (1000+$docArr['Estimator']['id'] + 1);
		}else{
			$project_id = 'CWS-1001';
		}			
		if(!empty($this->request->data)){
			
			
			if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
				$filename = $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];
				
				$orginal = time().'_'.$filename;
				$path = $_SERVER['DOCUMENT_ROOT'].'/customcws/app/webroot/eoi/'.$orginal;
				move_uploaded_file($tmp_name,$path);
				
				$this->request->data['Estimator']['files'] = $orginal;
			}		
			$this->request->data['Estimator']['user_id'] = $user_id;
			$this->request->data['Estimator']['project_id'] = $project_id;
			$this->request->data['Estimator']['created'] = date('Y-m-d H:i:s');
			
			
				
			
			if($this->Estimator->save($this->request->data)){
				
				$NappUserArr = $this->NappUser->find('first',array('conditions'=>array('NappUser.id'=>$user_id)));
				$senddername = $NappUserArr['NappUser']['name'].' '.$NappUserArr['NappUser']['lname'];			
				$subject = SITENAME.' :: New Project Estimator Added By '.$senddername;			
				$to_name  = 'Kal';							
				$template_name = 'estimation';				
				$variables = array('name'=>$senddername,'to_name'=>$to_name,'project_id'=>$project_id);
				$to_email = 'kal@xoroglobal.com';	
				try{
					$this->sendemail($to_email,$subject,$template_name,$variables);
				}catch (Exception $e){
					
				}
				
				$this->Session->setFlash('Project added successfully','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}	
		}	
			
	}	
	
	public function editproject($id=null){
		
		$this->layout='staff_inner_layout';
		$this->set('title_for_layout',SITENAME.'Edit Project');
		$this->checkSatffSession(); 
		$user_id=$this->Session->read('Customer.id');
						
		if(!empty($this->request->data)){
			
			if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
				$filename = $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];
				
				$orginal = time().'_'.$filename;
				$path = $_SERVER['DOCUMENT_ROOT'].'/customcws/app/webroot/eoi/'.$orginal;
				move_uploaded_file($tmp_name,$path);
				
				$this->request->data['Estimator']['files'] = $orginal;
			}	
			$this->request->data['Estimator']['id'] = $id;			
			$this->request->data['Estimator']['created'] = date('Y-m-d H:i:s');
			if($this->Estimator->save($this->request->data)){
				$this->Session->setFlash('Project udpated successfully','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}	
		}	
		$docArr = $this->Estimator->find('first',array('conditions'=>array('Estimator.id'=>$id)));
		$this->set('docArr',$docArr);	
		$this->request->data = $docArr;
	}	
}
