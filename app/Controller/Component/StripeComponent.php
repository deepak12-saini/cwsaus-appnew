<?php 

App::import('Vendor','Stripe',array('file'=>'stripe/lib/stripe.php'));

class StripeComponent extends Component
{
    var $controller;
 		
		function __construct(){	
		      
		    Stripe::setApiKey("sk_test_NRkVES4kuag5EwRCoVRcMqEo");
		  
	}
	
	function doOnetimePayment($token,$amount,$desc){
		
			$charge = Stripe_Charge::create(array(		 
				"amount" => $amount * 100, // amount in cents, again
				"currency" => "gbp",
				"card" => $token, 
				"description" => $desc
		  )
		);
		
		return $charge;
	}
	function doRecurringPayment($token,$package,$desc){
			$charge = Stripe_Customer::create(array(	
				"card" => $token,
				"plan" => $package,
				"description" => $desc
			)
		);
		return $charge;
	}
	//buy keyword one time charge for the customer
	function doOnetimePaymentCustomer($amount,$customerId,$desc){
			$charge = Stripe_Charge::create(array(		 
				"amount" => $amount * 100, // amount in cents, again
				"currency" => "gbp",
				"customer" => $customerId, 
				"description" => $desc
		  )
		);
		return $charge;
	}
    //invoice send amount for desuction
	function doOnetimePaymentInvoice($customerId,$amount,$invoiceId,$desc){
			$charge = Stripe_Charge::create(array(		 
				"customer" => $customerId,
				"amount" => $amount, // amount in cents, again
				"currency" => "gbp",
				"invoice" => $invoiceId,
				"description" => $desc
		  )
		);
		return $charge;
	}
	//get all invoices of the customer
	function getInvoice($customerId){
		$charge = Stripe_Invoice::all(
			array(
				"customer" => $customerId
			)
		);
		return $charge;
	}
	//get customer info
	function retrieve($customerId){
		$charge = Stripe_Customer::retrieve($customerId);
		return $charge;
	}
	
	function refund_amount($onetime_payment_id){
	  $ch_id = Stripe_Charge::retrieve($onetime_payment_id);
	 // $var['amount'] = $amount * 100;
	  $ch_id->refund();
	  return $ch_id;
	 }
	function create_customer($email,$description){
		$create=Stripe_Customer::create(array(
			// "card" => $stripetoken,			 
			 "description" => $description,
			 "email" => $email,	  
			));
	  return $create;
	}
    
	function card_update($customerId,$token){
		
		$cu = Stripe_Customer::retrieve($customerId);
		$cu->source = $token;
		$cu->save();	
		return $cu;
	}
	
	   function getToken()
   {
	$stripe_token = Stripe_Token::create(array(
	"card" => array(
	"number" => "4242424242424242",
	"exp_month" => 2,
	"exp_year" => 2017,
	"cvc" => "314"
	)
	));
	return $stripe_token;
   }
  
}
?>