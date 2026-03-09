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
class FrontsController extends AppController {

/**
 * @var array
 */
	public $uses = array('User','MenuPage','Contact','QuoteRequest','Gallery','QuickQuote','Blog','QuoteComerical','State','StatePrice','Subsubsidy');
	public $components = array('Session','Paginator','Email');	
	function beforeFilter()
    {
		$this->callConstants();
	}
	
	function index()
	{
		$this->set('title_for_layout',SITENAME.' HomePage');		
		$this->layout='front_layout';
		$Gallery =  $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1)));
		$this->set('Gallery',$Gallery);
		/* $QuickQuote =  $this->QuickQuote->find('all');
		$this->set('QuickQuote',$QuickQuote); */
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>1)));
		$this->set('menu',$menu);
		$this->Blog->bindModel(
		array('belongsTo' => array('Category' => array(
		'className' => 'Category',			 
		'foreignKey' => 'category_id',				
		'conditions' => array(),
		'fields' => 'name,slug',
		'order' => array(),
		)))); 
		$Blogs =  $this->Blog->find('all',array('conditions'=>array('Blog.status'=>1),'limit'=>6,'order'=>'Blog.id desc'));
		$this->set('Blogs',$Blogs);
		
		if(!empty($this->request->data)){
			
			$uniqueid = rand(0000000,9999999);
			$nsert['QuoteRequest']['uniqueid'] =  $uniqueid;
			$nsert['QuoteRequest']['fullname'] =  $this->request->data['fullname'];
			$nsert['QuoteRequest']['email'] =  $this->request->data['email'];
			$nsert['QuoteRequest']['phone'] =  $this->request->data['phone'];
			$nsert['QuoteRequest']['address'] =  $this->request->data['address'];
			//$nsert['QuoteRequest']['pincode'] =  $this->request->data['pincode'];
			//$nsert['QuoteRequest']['more_check'] =  $this->request->data['more_check']; 
			//$nsert['QuoteRequest']['solortype'] =  $this->request->data['solortype'];
			//$nsert['QuoteRequest']['system_selection'] =  $this->request->data['system_selection'];
			//$nsert['QuoteRequest']['help_me_decide'] =  $this->request->data['help_me_decide'];
			//$nsert['QuoteRequest']['monthly_power_bill'] =  $this->request->data['monthly_power_bill'];
			//$nsert['QuoteRequest']['note'] =  $this->request->data['note'];
			$nsert['QuoteRequest']['created'] =  date('Y-m-d H:i:s');
			/* echo '<pre>';
			print_r($nsert); 
			die(); */
			$this->Session->setFlash('Your request has been sent successfully.','default',array('class' => 'alert alert-success'));				
				$this->redirect('/thank-you');
			/*
			if($this->QuoteRequest->save($nsert)){
				
				$subject = SITENAME.' :- New CWS request('.$uniqueid.') by '.$this->request->data['fullname'];
				#$to = EMAIL;
				//$to = 'ranjitsingh.ranjit7@gmail.com';
				$to = 'web@xoroglobal.com';
				$template_name = 'newsolorrequest';
				$variables = array('requestid'=>$uniqueid,
					'name'=>$this->request->data['fullname'],
					'email'=>$this->request->data['email'],
					'phone'=>$this->request->data['phone'],
					'message'=>$this->request->data['address']
				);
				//$this->sendemail($to,$subject,$template_name,$variables);	
				
				$this->Session->setFlash('Your request has been sent successfully.','default',array('class' => 'alert alert-success'));				
				$this->redirect('/thank-you');
			}	*/
			
			
		}	
	}
	
	function consulting()
	{
		$this->set('title_for_layout',SITENAME.' Consulting');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>5)));
		$this->set('menu',$menu);
	}
	function about()
	{
		$this->set('title_for_layout',SITENAME.' About');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>1)));
		$this->set('menu',$menu);
	}
	function products()
	{
		$this->set('title_for_layout',SITENAME.' Product');		
		$this->layout='front_layout';		
	}
	function suppliers()
	{
		$this->set('title_for_layout',SITENAME.' Suppliers');		
		$this->layout='front_layout';		
	}
	function promotions()
	{
		$this->set('title_for_layout',SITENAME.' Promotions');		
		$this->layout='front_layout';		
	}
	/* 
	function product_partners()
	{
		$this->set('title_for_layout',SITENAME.' Product Partners');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>4)));
		$this->set('menu',$menu);
	}
	function services()
	{
		$this->set('title_for_layout',SITENAME.' Our services');		
		$this->layout='front_layout';
		$Gallery =  $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1)));
		$this->set('Gallery',$Gallery);
	}
	function user_area()
	{
		$this->set('title_for_layout',SITENAME.' User Area');		
		$this->layout='front_layout';
		
	}
	 */
	function calculator()
	{
		$this->set('title_for_layout',SITENAME.' About');		
		$this->layout='front_layout';
		$states =  $this->State->find('all',array('conditions'=>array(),'group'=>array('state')));
		$this->set('states',$states);
		#echo '<pre>';print_r($states);die;
		
	}
	
	function cal_next()
	{
		$this->set('title_for_layout',SITENAME.' About');		
		$this->layout='front_layout';
		$states =  $this->State->find('all',array('conditions'=>array(),'group'=>array('state')));
		$this->set('states',$states);
		$calculation_session=$this->Session->read('calculations');
		$post_data_session=$this->Session->read('post_data');
		if(!empty($this->request->data)){
						
			if($this->request->data['connection_type'] == 0){
				
				$state_name=$this->request->data['state_id'];
				$connection_type=$this->request->data['connection_type'];
				$frequency=$this->request->data['frequency'];
				if($frequency=='bi-monthly')
				{
					$monthly_bill=$this->request->data['electricity_bill']/2; // Monthly Bill entred by user
				}else{
					$monthly_bill=$this->request->data['electricity_bill'];
				}
				$state_unit =  $this->State->find('first',array('conditions'=>array('State.state LIKE'=>$state_name,'State.type'=>$connection_type)));
				$unit_per_rate=$state_unit['State']['unit_per_rate'];  // Fetch unit per rate as per state
			
				$Subsidy =  $this->Subsubsidy->find('first',array('conditions'=>array()));
				$govt_subsidy_percent=$Subsidy['Subsubsidy']['govt_subsidy_percent']; // Fetch govt subsidy in percentage
							
				$no_units_used=$monthly_bill/$unit_per_rate;   //Number of Units User
				$per_kw_unit=$Subsidy['Subsubsidy']['per_kw_unit']; // Units produce in 1KW per month
				
				$total_kw_required=round($no_units_used/$per_kw_unit); // total kw required
				
				// Monthly Saving		 
				$monthly_saving =  round($total_kw_required * $per_kw_unit * $unit_per_rate);  
			
				//Fetch kw cost
				$stateprice =  $this->StatePrice->find('first',array('conditions'=>array('StatePrice.min_capacity <='=>$total_kw_required,'StatePrice.max_capacity >='=>$total_kw_required)));
				if(empty($stateprice))
				{
					$this->Session->setFlash('Invalid request.','default',array('class' => 'alert alert-danger'));		
					$this->redirect('/solar-calculator');
				}				
				$payable_amount =	$stateprice['StatePrice']['amount'] * $total_kw_required;			
				
				// Month and years calculation
				$payable_amount_covered_per_month = round($payable_amount/$monthly_saving);
			
				$per_year=$payable_amount_covered_per_month/12;
				//$per_year=number_format($per_year,2);
				$per_year=round($per_year,2,PHP_ROUND_HALF_DOWN);
				
				
				//25 years saving
				$twentyfive_year_cal=$monthly_saving*10*25;
				$twentyfive_year_saving=$twentyfive_year_cal-$payable_amount;
				
				//ROI
				$roi_cal= $monthly_saving*10*25;
				$total_roi=($roi_cal/$payable_amount)*100;
				$roi_val=$total_roi/25;
				$roi=round($roi_val,2,PHP_ROUND_HALF_DOWN);
				
				
				$unitratepercentage = $Subsidy['Subsubsidy']['unit_rate_percentage']; 			
				$totalincome = 0;
				$yearlyinco = '';
				$totaltaxsaving = 0;
				$taxsaving = 0;
				for($i=0; $i <= 25; $i++){		
					
				 	if($i == 0){
						$foutry = ($payable_amount * 40 / 100);	
						$foutry = $payable_amount - $foutry;
						$taxsaving = round($foutry * 35 / 1000 );
						$totaltaxsaving = $totaltaxsaving + $taxsaving;
						
					}else if($i == 1){
						$payable_amount = $payable_amount - $totaltaxsaving;
						$foutry = ($payable_amount * 40 / 100);	
						$foutry = $payable_amount - $foutry;
						$taxsaving = round($foutry * 35 / 1000 );
						$totaltaxsaving = $totaltaxsaving + $taxsaving;
					}else if($i == 2){
						$payable_amount = $payable_amount - $totaltaxsaving;
						$foutry = ($payable_amount * 40 / 100);	
						$foutry = $payable_amount - $foutry;
						$taxsaving = round($foutry * 20 / 1000 );
						$totaltaxsaving = $totaltaxsaving + $taxsaving;
					} 
					
					$yearly = $monthly_saving * 10;				
					$rateofincrease = ($yearly * $unitratepercentage) / 100; 
					$finalyearly = $yearly + ($rateofincrease*$i);
					
					$totalincome = $totalincome + $finalyearly + $taxsaving;
					
					$yearlyinco .= $totalincome.',';
				}	
				$twentyfive_year_saving = $totalincome;
				
				
				//$total_rebate = 0;
			
				$yearlyinco = rtrim($yearlyinco,',');				
				$calculations['monthly_bill']=$monthly_bill;
				$calculations['monthly_saving']=$monthly_saving;
				$calculations['total_kw_required']=$total_kw_required;
				$calculations['total_rebate']=$totaltaxsaving;
				//$calculations['ten_year_saving']=$ten_year_saving;
				$calculations['twentyfive_year_saving']=$twentyfive_year_saving;
				$calculations['per_year']=$per_year;
				$calculations['roi']=$roi;
				$calculations['yearlyinco']=$yearlyinco;
				$post_data=$this->request->data;
				$this->Session->write('calculations',$calculations);
				$this->Session->write('post_data',$post_data);
				$this->set('post_data',$post_data);
				$this->set('calculations',$calculations);
			
			}else{	
			
			$state_name=$this->request->data['state_id'];
			$connection_type=$this->request->data['connection_type'];
			$frequency=$this->request->data['frequency'];
			if($frequency=='bi-monthly')
			{
				$monthly_bill=$this->request->data['electricity_bill']/2; // Monthly Bill entred by user
			}else{
				$monthly_bill=$this->request->data['electricity_bill'];
			}
			
			$state_unit =  $this->State->find('first',array('conditions'=>array('State.state LIKE'=>$state_name,'State.type'=>$connection_type)));
			
			$unit_per_rate=$state_unit['State']['unit_per_rate'];  // Fetch unit per rate as per state
			
			$Subsidy =  $this->Subsubsidy->find('first',array('conditions'=>array()));
			$govt_subsidy_percent=$Subsidy['Subsubsidy']['govt_subsidy_percent']; // Fetch govt subsidy in percentage
						
			$no_units_used=$monthly_bill/$unit_per_rate;   //Number of Units User
			$per_kw_unit=$Subsidy['Subsubsidy']['per_kw_unit']; // Units produce in 1KW per month
			
			$total_kw_required=round($no_units_used/$per_kw_unit); // total kw required
			//$govt_subsidy_value_kw=($total_kw_required*$govt_subsidy_percent)/100; // as per govt rule and subsidy fetch KW value
			
			// Monthly Saving
			//$monthly_saving=$govt_subsidy_value_kw*$per_kw_unit*$unit_per_rate;  
			$monthly_saving =  round($total_kw_required * $per_kw_unit * $unit_per_rate);  
		
			//Fetch kw cost
			$stateprice =  $this->StatePrice->find('first',array('conditions'=>array('StatePrice.min_capacity <='=>$total_kw_required,'StatePrice.max_capacity >='=>$total_kw_required)));
			if(empty($stateprice))
			{
				$this->Session->setFlash('Invalid request.','default',array('class' => 'alert alert-danger'));		
				$this->redirect('/solar-calculator');
			}
			
			$total_cost =	$stateprice['StatePrice']['amount'] * $total_kw_required;			
			
			//fetch govt alloted subsidy per kw
			$total_rebate=$Subsidy['Subsubsidy']['subsidy']  * $total_kw_required; // Fetch govt subsidy per kw
			$payable_amount=$total_cost-$total_rebate;
			
			// Month and years calculation
			$payable_amount_covered_per_month = round($payable_amount/$monthly_saving);
		
			$per_year=$payable_amount_covered_per_month/12;
			//$per_year=number_format($per_year,2);
			$per_year=round($per_year,2,PHP_ROUND_HALF_DOWN);
			
		
			//25 years saving
			$twentyfive_year_cal=$monthly_saving*10*25;
			$twentyfive_year_saving=$twentyfive_year_cal-$payable_amount;
			
			//ROI
			$roi_cal= $monthly_saving*10*25;
			$total_roi=($roi_cal/$payable_amount)*100;
			$roi_val=$total_roi/25;
			$roi=round($roi_val,2,PHP_ROUND_HALF_DOWN);
			
			
			$unitratepercentage = $Subsidy['Subsubsidy']['unit_rate_percentage']; 			
			$totalincome = 0;
			$yearlyinco = '';
			for($i=0; $i <= 25; $i++){				
				$yearly = $monthly_saving * 10;				
				$rateofincrease = ($yearly * $unitratepercentage) / 100; 
				$finalyearly = $yearly + ($rateofincrease*$i);
				
				$totalincome = $totalincome + $finalyearly;
				
				$yearlyinco .= $totalincome.',';
			}	
			$twentyfive_year_saving = $totalincome;
		
			$yearlyinco = rtrim($yearlyinco,',');
			
			$calculations['monthly_bill']=$monthly_bill;
			$calculations['monthly_saving']=$monthly_saving;
			$calculations['total_kw_required']=$total_kw_required;
			$calculations['total_rebate']=$total_rebate;
			//$calculations['ten_year_saving']=$ten_year_saving;
			$calculations['twentyfive_year_saving']=$twentyfive_year_saving;
			$calculations['per_year']=$per_year;
			$calculations['roi']=$roi;
			$calculations['yearlyinco']=$yearlyinco;
			$post_data=$this->request->data;
			$this->Session->write('calculations',$calculations);
			$this->Session->write('post_data',$post_data);
			$this->set('post_data',$post_data);
			$this->set('calculations',$calculations);
			/* echo '<pre>';print_r($post_data);
			die; */
		}	
		}else if(!empty($calculation_session) && !empty($post_data_session))
		{
			$calculations=$calculation_session;
			$post_data=$post_data_session;
			$this->set('post_data',$post_data);
			$this->set('calculations',$calculations);
		}else{
			return $this->redirect('/solar-calculator');
		}
		
	}
	
	function contact()
	{
		$this->set('title_for_layout',SITENAME.' Contact');		
		$this->layout='front_layout';
		if(!empty($this->request->data)){	
			$this->request->data['Contact']['user_type']=1;
			if($this->Contact->save($this->request->data)){
				$name = $this->request->data['Contact']['name'];
				$email = $this->request->data['Contact']['email'];
				$subjects = $this->request->data['Contact']['subject'];
				$messages = $this->request->data['Contact']['message'];
				$subject = SITENAME.$subjects;	
				$to= 'web@xoroglobal.com';
				$body=$messages;
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:CWS <info@cwsaus.com.au>' . "\r\n";
				mail($to,$subject,$body,$headers);	
				$this->Session->setFlash('Thanks for contact us.','default',array('class' => 'alert alert-success'));
				$this->redirect('/contact-us');
			}			
		}
	}
	
	function pricing()
	{
		$this->set('title_for_layout',SITENAME.' Pricing');		
		$this->layout='front_layout';
	}
	
	function policies()
	{
		$this->set('title_for_layout',SITENAME.' State Policies');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>5)));
		$this->set('menu',$menu);
	}
	
	function blog()
	{
		$this->set('title_for_layout',SITENAME.' Blog');		
		$this->layout='front_layout';
	}
	
	
	
	function solar_home()
	{
		$this->set('title_for_layout',SITENAME.' Solar for Homes');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>2)));
		$this->set('menu',$menu);
		
		if(!empty($this->request->data)){
			
			$uniqueid = rand(0000000,9999999);
			$nsert['QuoteRequest']['uniqueid'] =  $uniqueid;
			$nsert['QuoteRequest']['fullname'] =  $this->request->data['fullname'];
			$nsert['QuoteRequest']['email'] =  $this->request->data['email'];
			$nsert['QuoteRequest']['phone'] =  $this->request->data['phone'];
			$nsert['QuoteRequest']['address'] =  $this->request->data['address'];
			$nsert['QuoteRequest']['pincode'] =  $this->request->data['pincode'];
			$nsert['QuoteRequest']['more_check'] =  $this->request->data['more_check'];
			$nsert['QuoteRequest']['solortype'] =  $this->request->data['solortype'];
			$nsert['QuoteRequest']['system_selection'] =  $this->request->data['system_selection'];
			$nsert['QuoteRequest']['help_me_decide'] =  $this->request->data['help_me_decide'];
			$nsert['QuoteRequest']['monthly_power_bill'] =  $this->request->data['monthly_power_bill'];
			$nsert['QuoteRequest']['note'] =  $this->request->data['note'];
			$nsert['QuoteRequest']['created'] =  date('Y-m-d H:i:s');
			// echo '<pre>';
			// print_r($nsert);
			// die();
			if($this->QuoteRequest->save($nsert)){
				
				$subject = SITENAME.' :- Confirmation of your solar quotes request';
				
				$to = $this->request->data['email'];
				$template_name = 'solorforhomequote';
				$variables = array('name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	
				
				
				$subject = SITENAME.' :- New solar quotes request('.$uniqueid.') by '.$this->request->data['fullname'];
				#$to = EMAIL;
				$to = 'ranjitsingh.ranjit7@gmail.com';
				$template_name = 'newsolorrequest';
				$variables = array('requestid'=>$uniqueid,'name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	
				
				$this->Session->setFlash('Your request has been sent successfully.','default',array('class' => 'alert alert-success'));				
				$this->redirect('/thank-you');
			}	
			
			
		}
	}
	
	function solar_business()
	{
		$this->set('title_for_layout',SITENAME.' Solar for Business');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>3)));
		$this->set('menu',$menu);
		
		if(!empty($this->request->data)){
			$selected_day=$this->request->data['days'];
			$purchase_option=$this->request->data['purchase_option'];
			$days=array('not select','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
			$purchase_options=array('not select','Capital Purchase','Lease','PPA','Help me decide');
			$uniqueid = rand(0000000,9999999);
			$nsert['QuoteComerical']['uniqueid'] =  $uniqueid;
			$nsert['QuoteComerical']['fullname'] =  $this->request->data['fullname'];
			$nsert['QuoteComerical']['email'] =  $this->request->data['email'];
			$nsert['QuoteComerical']['phone'] =  $this->request->data['phone'];
			$nsert['QuoteComerical']['address'] =  $this->request->data['address'];
			$nsert['QuoteComerical']['pincode'] =  $this->request->data['pincode'];
			$nsert['QuoteComerical']['solortype'] =  $this->request->data['solortype'];
			$nsert['QuoteComerical']['industry'] =  $this->request->data['industry'];
			
			if($this->request->data['industry']=='Other')
			{
				$nsert['QuoteComerical']['other_industry'] =  $this->request->data['other_industry'];
			}else{
				$nsert['QuoteComerical']['other_industry'] ='';
			}
			$nsert['QuoteComerical']['days_of_opt'] =  $days[$selected_day];
			if($this->request->data['electricity_usage']=='INR')
			{
				$nsert['QuoteComerical']['electricity_usage'] =  'Spend in INR';
			}else{
				$nsert['QuoteComerical']['electricity_usage'] =  'Units in kW';
			}
			if($this->request->data['system_size']=='1')
			{
				$nsert['QuoteComerical']['system_size'] =  'Yes';
			}else{
				$nsert['QuoteComerical']['system_size'] =  'No';
			}
			$nsert['QuoteComerical']['electricity_usage_amount'] =  $this->request->data['electricity_usage_amount'];
			$nsert['QuoteComerical']['system_selection'] =  $this->request->data['system_selection'];
			$nsert['QuoteComerical']['purchase_option'] =  $purchase_options[$purchase_option];
			$nsert['QuoteComerical']['note'] =  $this->request->data['note'];
			
			$nsert['QuoteComerical']['status'] = 1;
			$nsert['QuoteComerical']['created'] = date('Y-m-d H:i:s');
			
			if($this->QuoteComerical->save($nsert)){
				
				$subject = SITENAME.' :- Confirmation of your solar quotes request';
				
				$to = $this->request->data['email'];
				$template_name = 'businessnewsolorrequest';
				$variables = array('name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	
				
				
				$subject = SITENAME.' :- New solar quotes request('.$uniqueid.') by '.$this->request->data['fullname'];
				#$to = EMAIL;
				$to = 'ranjitsingh.ranjit7@gmail.com';
				$template_name = 'newsolorrequest';
				$variables = array('requestid'=>$uniqueid,'name'=>$this->request->data['fullname']);
				$this->sendemail($to,$subject,$template_name,$variables);	
				
				$this->Session->setFlash('Your request has been sent successfully.','default',array('class' => 'alert alert-success'));				
				$this->redirect('/thank-you');
			}
		}
	}
	
	function solar_types()
	{
		$this->set('title_for_layout',SITENAME.' Types of Solar');		
		$this->layout='front_layout';
		$menu =  $this->MenuPage->find('first',array('conditions'=>array('MenuPage.id'=>4)));
		$this->set('menu',$menu);
	}
	
	function thank_you()
	{
		$this->set('title_for_layout',SITENAME.' Thank You');		
		$this->layout='front_layout';
	}
	
}
	
?>