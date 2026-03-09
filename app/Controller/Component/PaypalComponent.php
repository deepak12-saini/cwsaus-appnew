<?php 
App::import('Vendor','PayPal',array('file'=>'PayPal/paypalfunctions.php'));
class PaypalComponent extends Component  {
 

	function callshortcutexpresscheckout($paymentAmount,$billingDescription,$type){
		
		$Paypalrequest = new Paypalrequest;	
		$currencyCodeType = "USD";
		$paymentType = "Sale";
		if($type == 1){
			$returnURL = SITEURL."customers/review";
			$cancelURL =  SITEURL."/customers/cancel";
		}else{
			$returnURL = SITEURL."sbos/review";
			$cancelURL =  SITEURL."/sbos/cancel";			
		}
		$resArray  = $Paypalrequest->CallShortcutExpressCheckout( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL,$billingDescription);		
		
		return $resArray;
		
	}
	
	function RedirectToPayPal($token){
		$Paypalrequest = new Paypalrequest;	
		$resArray  = $Paypalrequest->RedirectToPayPal($token);
		return $resArray;
	}
	
	function GetShippingDetails($token){
		
		$Paypalrequest = new Paypalrequest;	
		$resArray  = $Paypalrequest->GetShippingDetails($token);
		return $resArray;
	}
	function ConfirmPayment( $finalPaymentAmount,$token,$currencyCodeType,$paymentType,$payer_id ){
		$Paypalrequest = new Paypalrequest;	
		$resArray  = $Paypalrequest->ConfirmPayment( $finalPaymentAmount,$token,$currencyCodeType,$paymentType,$payer_id );
		return $resArray;
	}
	function CreateRecurringPaymentsProfile($token,$email,$shipToName,$desc,$shipToStreet,$shipToCity,$shipToState,$shipToZip,$shipToCountry){
		
		$Paypalrequest = new Paypalrequest;	
		$maintancefee = MAINTAINCE_FEE;
		$resArray  = $Paypalrequest->CreateRecurringPaymentsProfile($token,$email,$shipToName,$desc,$shipToStreet,$shipToCity,$shipToState,$shipToZip,$shipToCountry,$maintancefee);
		return $resArray;
	}
	
	function DoDirectPaypalPayment($paymentAmount, $creditCardType, $creditCardNumber,
							$expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, 
							$countryCode)
	{
		$currencyCode = "USD";
		$paymentType = "Sale";
		$Paypalrequest = new Paypalrequest;	
		$resArray  = $Paypalrequest->DirectPayment($paymentType, $paymentAmount, $creditCardType, $creditCardNumber,
							$expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, 
							$countryCode, $currencyCode);
		
		return $resArray;
	}
	
	function PaypalCreditPayment($order_id,$paymentAmount, $creditCardType, $creditCardNumber,$expDate, $cvv2, $firstName, $lastName,$email,$phone, $street, $city, $state, $zip,$countryCode)
	{
				//$payment_type = 'Authorization';	
		$payment_type = 'Sale';
		//$_POST['amount']=5;
		$request  = 'METHOD=DoDirectPayment';
		$request .= '&VERSION=51.0';
		$request .= '&USER=bharat.oditi169_api1.gmail.com'; // your paypal pro username
		$request .= '&PWD=1369308176'; //your paypal pro password  
		$request .= '&SIGNATURE=AFcWxV21C7fd0v3bYYYRCpSSRl31AMbrG4bTV1jhpUs0V4ZRJcC3RJS0';  ////your paypal signature password   
		$request .= '&CUSTREF=' . (int)$order_id;
		$request .= '&PAYMENTACTION=' . $payment_type;
		$request .= '&AMT='.$paymentAmount;
		$request .= '&CREDITCARDTYPE=' . $creditCardType;
		$request .= '&ACCT=' . urlencode(str_replace(' ', '', $creditCardNumber));
		//$request .= '&CARDSTART=' . urlencode($_POST['cc_start_date_month'] . $_POST['cc_start_date_year']);
		$request .= '&EXPDATE=' . urlencode($expDate);
		$request .= '&CVV2=' . urlencode($cvv2);

		if ($_POST['cc_type'] == 'SWITCH' || $_POST['cc_type'] == 'SOLO') { 
			$request .= '&CARDISSUE=' . urlencode($_POST['cc_issue']);
		}

		$request .= '&FIRSTNAME=' . urlencode($firstName);
		$request .= '&LASTNAME=' . urlencode($lastName);
		$request .= '&EMAIL=' . urlencode($email);
		$request .= '&PHONENUM=' . urlencode($phone);
		$request .= '&IPADDRESS=' . urlencode($_SERVER['REMOTE_ADDR']);
		$request .= '&STREET=' . urlencode($street);
		$request .= '&CITY=' . urlencode($city);
		$_POST['state']='';
		$request .= '&STATE=' . urlencode($_POST['state']);
		$_POST['zip']='';
		$request .= '&ZIP=' . urlencode($_POST['zip']);
		$request .= '&COUNTRYCODE=' . urlencode($countryCode);
		$request .= '&CURRENCYCODE=' . urlencode('USD');
	
		/* $curl = curl_init('https://api-3t.paypal.com/nvp'); // This is for live account
		$curl = curl_init('https://api-3t.sandbox.paypal.com/nvp'); // This is for sandbox account
		 */
		 
		$curl = curl_init('https://api-3t.sandbox.paypal.com/nvp');
		curl_setopt($curl, CURLOPT_PORT, 443);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

		$response = curl_exec($curl);
		curl_close($curl);
		$filename = 'debug/'.time().'_data.txt';
		$fp = fopen($filename,'w');
		fwrite($fp, $response);
		

		$response_info = array();
		parse_str($response, $response_info);
		return $response_info;
	}
	
	function recuringpayment($billingDescritpion,$finalPaymentAmount,$creditCardType,$creditCardNumber,$cvv2,$firstName,$lastName,$street,$city,$countryCode,$expDate){
		
		
		$url = 'https://api-3t.sandbox.paypal.com/nvp';
	
		$dte = date('Y-m-d',strtotime(' +1 year'));
		$StartRecPayDate = $dte.'T01:15:00';
		
		$fields = array(			
			'METHOD' => 'CreateRecurringPaymentsProfile',
			'VERSION' => '94',
			'USER' => 'bharat.oditi169_api1.gmail.com',
			'PWD' => '1369308176',
			'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AMbrG4bTV1jhpUs0V4ZRJcC3RJS0',
			'PROFILESTARTDATE' => urlencode($StartRecPayDate),
			'DESC' => urlencode($billingDescritpion),
			'BILLINGPERIOD' => 'Year',
			'BILLINGFREQUENCY' => '1',
			'AMT' => urlencode($finalPaymentAmount),
			'CREDITCARDTYPE' => urlencode($creditCardType),
			'ACCT' => urlencode($creditCardNumber),
			'CVV2' => urlencode($cvv2),
			'FIRSTNAME' => urlencode($firstName),
			'LASTNAME' => urlencode($lastName),
			'STREET' => urlencode($street),
			'CITY' => urlencode($city),
			'STATE' => '',
			'ZIP' => '',
			'COUNTRYCODE' => urlencode('US'),
			'CURRENCYCODE' => urlencode('USD'),
			'EXPDATE' => urlencode($expDate),
		);	
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$output = curl_exec($ch);
		//close connection
		curl_close($ch);
		
		$response = array();
		parse_str($output, $response);
		return $response;
		
	}
	
}
?>