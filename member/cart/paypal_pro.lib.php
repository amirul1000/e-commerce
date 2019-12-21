<?php
function card_payment_submit()
	 {
		// Set request-specific fields.
		$paymentType = urlencode($_REQUEST['Sale']);				// or 'Sale'
		$firstName = urlencode($_REQUEST['first_name']);
		$lastName = urlencode($_REQUEST['last_name']);
		$creditCardType = urlencode($_REQUEST['card_type']);
		$creditCardNumber = urlencode($_REQUEST['card_number']);
		$expDateMonth = $_REQUEST['expiration_month'];
		// Month must be padded with leading zero
		$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
	
		$expDateYear = urlencode($_REQUEST['expiration_year']);
		$cvv2Number = urlencode($_REQUEST['verification_code']);
		$address1 = urlencode($_REQUEST['adress1']);
		$address2 = urlencode($_REQUEST['adress2']);
		$city = urlencode($_REQUEST['city']);
		$state = urlencode($_REQUEST['state']);
		$zip = urlencode($_REQUEST['zip_code']);
		$country = urlencode($_REQUEST['country']);				// US or other valid country code
		$amount = urlencode($_REQUEST['payment_amuont']);
		$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		// Add request-specific fields to the request string.
		$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
					"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
					"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
		
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			global  $httptrnsaction;
			$httptrnsaction= $httpParsedResponseAr;
		    return true;
			//exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
		} else  
		{			
			   global  $httptrnsaction;
			   $httptrnsaction= $httpParsedResponseAr;
			   //exit('DoDirectPayment failed: ' . print_r($httpParsedResponseAr, true));
				//return false;
			   return true;	
		}
	}  
	function PPHttpPost($methodName_, $nvpStr_) 
	{
		
		$environment = 'sandbox';	// or 'beta-sandbox' or 'live'
	
		// Set up your API credentials, PayPal end point, and API version.
		
		$API_UserName = urlencode('sdk-three_api1.sdk.com');
		$API_Password = urlencode('QFZCWN5HZM8VBG7Q');
		$API_Signature = urlencode('A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI');
		
		$API_Endpoint = "https://api-3t.paypal.com/nvp";
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
?>	