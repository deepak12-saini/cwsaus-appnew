<?php 
App::uses('AppController','Controller');
class ErrorsController  extends AppController {
	
    public $name = 'Errors';

    public function beforeFilter() {
        //parent::beforeFilter();
		$this->callConstants();		
       // $this->Auth->allow('error404');
    }

            
	 public function error400() {
		
       $this->layout = 'front_layout';
    }
	
    public function error404() {
	
       $this->layout = 'front_layout';
    }	
}  
?>

  



