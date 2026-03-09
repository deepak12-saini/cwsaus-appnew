<?php
class QuicksController extends AppController {
	public $uses = array('User','QuickQuote','QuoteRequest','QuoteComerical');
	public $components = array('Session','Paginator');	
	function beforeFilter(){
		$this->callConstants();
	}
	function admin_index(){
		$this->set('title_for_layout',SITENAME.' Admin Quick Quote List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 
		$this->QuickQuote->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$QuickQuote = $this->Paginator->paginate('QuickQuote');		
		$this->set('QuickQuote', $QuickQuote);	 
	}
	function admin_quote_comericals(){
		$this->set('title_for_layout',SITENAME.' Admin  Quote Comerical List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 
		$this->QuoteComerical->recursive = 0;
		$this->paginate = array('conditions'=>array(),'page' => 1, 'limit' => 25);
		$QuoteComerical = $this->Paginator->paginate('QuoteComerical');		
		$this->set('QuoteComerical', $QuoteComerical);	 
	}
	function admin_request_list($clearAll=null){
		$this->set('title_for_layout',SITENAME.' Admin Quote Request List');		
		$this->layout='admin_layout';
		$this->checkAdminSession(); 	
		$conditions['AND'] = array();
		$search_uniqueid ='';
		$type ='';
		if(!empty($clearAll) && ($clearAll == 'clear')){	
			$search_uniqueid = $this->Session->delete('search_uniqueid');
			//$type = $this->Session->delete('type');
			$type = $this->Session->delete('QuoteRequest.conditions');
			 $this->redirect(array('action' => 'request_list'));	
		}
		$type = $this->Session->read('type');	
		$search_uniqueid = $this->Session->read('search_uniqueid');	
		
		if(!empty($this->request->data))
		{
			if(!empty($this->request->data['search'])){
				$search_uniqueid=$this->request->data['search'];
				$this->Session->write('search_uniqueid',$search_uniqueid);
				if($search_uniqueid !=''){
					$conditions['OR']['QuoteRequest.uniqueid LIKE'] = '%'.$search_uniqueid.'%';
				}else if($search_uniqueid !=''){
					$conditions['OR']['QuoteRequest.uniqueid LIKE'] = '%'.$search_uniqueid.'%';
				}
				$search_uniqueid = $this->Session->read('search_uniqueid');	
			}
			/*if(!empty($this->request->data['type'])){
				$type=$this->request->data['type'];
				$this->Session->write('type',$type);
				if($type=='home')
				{
					$search_type=0;
				}else if($type=='business')
				{
					$search_type=1;
				}else if($type=='other')
				{
					$search_type=2;
				}else{
					$search_type=array(0,1,2);
				}
				$cond= array('QuoteRequest.solortype' =>$search_type);		
				array_push($conditions['AND'], $cond);
			}*/
			$this->Session->Write('QuoteRequest.conditions',$conditions); 
		}else{
			$session_condition=$this->Session->read('QuoteRequest.conditions');	
			if(!empty($session_condition))
			{
				$this->Session->Write('QuoteRequest.conditions',$session_condition); 
			}else{
				$this->Session->Write('QuoteRequest.conditions',$conditions); 
			}
			
		}

		$condition = $this->Session->read('QuoteRequest.conditions');
		$this->paginate =array('conditions'=>$condition,'order' =>array('QuoteRequest.id' => 'asc'));
		$QuoteRequest = $this->Paginator->paginate('QuoteRequest');
		$this->set('QuoteRequest', $QuoteRequest);	
		$this->set('search_uniqueid', $search_uniqueid);	
		//$this->set('type', $type);	
	}
	function admin_add(){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin Quick Quote Edit Page');
		$this->checkAdminSession(); 
		if(!empty($this->request->data)){
			$this->request->data['QuickQuote']['unique_id']=$this->random_password(6);
			if($this->QuickQuote->save($this->request->data)) {
				$this->Session->setFlash('Quick quotes has been saved','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}else{
				$this->Session->setFlash('Quick quotes has not saved','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	function admin_edit($id){
		$this->layout='admin_layout';
		$this->set('title_for_layout',SITENAME.' Admin Quick Quote Edit Page');
		$this->checkAdminSession(); 
		$QuickQuote =  $this->QuickQuote->find('first',array('conditions'=>array('QuickQuote.id'=>$id)));
		$this->set('QuickQuote',$QuickQuote);
		if(!empty($this->request->data)){
			if($this->QuickQuote->save($this->request->data)) {
				$this->Session->setFlash('Quick quotes has been updates','default',array('class' => 'alert alert-success'));
				$this->redirect('index');
			}else{
				$this->Session->setFlash('Quick quotes has not updated','default',array('class' => 'alert alert-danger'));
			}
		}
	}
	public function admin_delete($id){
		$this->autoRender = false;
		if($this->QuickQuote->delete($id)){
			$this->Session->setFlash('Quick quotes has been deleted','default',array('class' => 'alert alert-success'));
		    $this->redirect('index');
		}
	}
	public function random_password( $length = 8 ) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		//$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
	public function index($unique_id=null)
	{
		$this->set('title_for_layout',SITENAME.' Quick Quote');		
		$this->layout='front_layout';
		$QuickQuote =  $this->QuickQuote->find('first',array('conditions'=>array('QuickQuote.unique_id'=>$unique_id)));
		#echo '<pre>';print_r($QuickQuote);die;
		$this->set('QuickQuote',$QuickQuote);
		if(!empty($this->request->data)){
			
			$uniqueid = rand(0000000,9999999);
			$nsert['QuoteRequest']['uniqueid'] =  $uniqueid;
			$nsert['QuoteRequest']['fullname'] =  $this->request->data['fullname'];
			$nsert['QuoteRequest']['email'] =  $this->request->data['email'];
			$nsert['QuoteRequest']['phone'] =  $this->request->data['phone'];
			$nsert['QuoteRequest']['address'] =  $this->request->data['address'];
			$nsert['QuoteRequest']['pincode'] =  $this->request->data['pincode'];
			$nsert['QuoteRequest']['more_check'] =  0;
			$nsert['QuoteRequest']['solortype'] =  2;
			$nsert['QuoteRequest']['system_selection'] = $QuickQuote['QuickQuote']['type'];
			$nsert['QuoteRequest']['help_me_decide'] =  0;
			$nsert['QuoteRequest']['monthly_power_bill'] =  0;
			$nsert['QuoteRequest']['note'] =  '';
			$nsert['QuoteRequest']['quick_quote_id'] =  $QuickQuote['QuickQuote']['id'];
			$nsert['QuoteRequest']['created'] =  date('Y-m-d H:i:s');
			// echo '<pre>';
			// print_r($nsert);
			// die();
			if($this->QuoteRequest->save($nsert)){
				
				/* $subject = SITENAME.' :- Confirmation of your solar quotes request';
				
				$to = $this->request->data['email'];
				$template_name = 'solorforhomequote';
				$variables = array('name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	 */
				
				
				$subject = SITENAME.' :- New contact ('.$uniqueid.') by '.$this->request->data['fullname'];
				
				$to= 'web@xoroglobal.com';
				$template_name = 'newsolorrequest';
				$variables = array('requestid'=>$uniqueid,'name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	
				
				$this->Session->setFlash('Your request has been sent successfully.','default',array('class' => 'alert alert-success'));				
				$this->redirect('/thank-you');
			}	
			
			
		}
	}
	
}
	
?>