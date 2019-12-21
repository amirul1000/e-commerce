<?php
// WePay PHP SDK - http://git.io/mY7iQQ
	require 'wepay.php';

	// application settings
	$account_id = 264516627;
	$client_id = 71626;
	$client_secret = "201dd3cac0";
	$access_token = "PRODUCTION_dc85f5839062e94246c8a646bff686ec5b5b22afe9d538cdd2f2754d167d8021";

	// credit card to charge
	$credit_card_id = 123456789;

	// change to useProduction for live environments
	Wepay::useStaging($client_id, $client_secret);

	$wepay = new WePay($access_token);

	// charge the credit card
	$response = $wepay->request('checkout/create', array(
		'account_id'		=> $_REQUEST['verification_code'],
		'amount'		=> $_REQUEST['payment_amuont'],
		'short_description'	=> 'A brand new soccer ball',
		'type'			=> 'GOODS',
		'payment_method_id'	=> $_REQUEST['card_number'], // user's credit_card_id
		'payment_method_type'	=> $_REQUEST['card_type']
	));


?>