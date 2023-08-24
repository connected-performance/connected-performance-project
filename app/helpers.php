<?php
use App\Models\Customer;
use App\Models\User;
use App\Gateway\Gwapi;

function getCustomer()
{
	$customers = Customer::select('user_id')->get();
	$users = User::whereIn('id', $customers)->get();
	
	return $users;
}

function getTransaction($transaction_id)
{
	$gw = new gwapi;
	$constraints = "&action_type=sale&transaction_id=".$transaction_id;
	$security_key = 'BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR';

	$transactionFields = array(
	    'transaction_id',
	    'partial_payment_balance',
	    'platform_id',
	    'transaction_type',
	    'condition',
	    'order_id',
	    'authorization_code',
	    'ponumber',
	    'order_description',

	    'first_name',
	    'last_name',
	    'address_1',
	    'address_2',
	    'company',
	    'city',
	    'state',
	    'postal_code',
	    'country',
	    'email',
	    'phone',
	    'fax',
	    'cell_phone',
	    'customertaxid',
	    'customerid',
	    'website',

	    'shipping_first_name',
	    'shipping_last_name',
	    'shipping_address_1',
	    'shipping_address_2',
	    'shipping_company',
	    'shipping_city',
	    'shipping_state',
	    'shipping_postal_code',
	    'shipping_country',
	    'shipping_email',
	    'shipping_carrier',
	    'tracking_number',
	    'shipping_date',
	    'shipping',
	    'shipping_phone',

	    'cc_number',
	    'cc_hash',
	    'cc_exp',
	    'cavv',
	    'cavv_result',
	    'xid',
	    'eci',
	    'avs_response',
	    'csc_response',
	    'cardholder_auth',
	    'cc_start_date',
	    'cc_issue_number',
	    'check_account',
	    'check_hash',
	    'check_aba',
	    'check_name',
	    'account_holder_type',
	    'account_type',
	    'sec_code',
	    'drivers_license_number',
	    'drivers_license_state',
	    'drivers_license_dob',
	    'social_security_number',

	    'processor_id',
	    'tax',
	    'currency',
	    'surcharge',
	    'tip',

	    'card_balance',
	    'card_available_balance',
	    'entry_mode',
	    'cc_bin',
	    'cc_type'
	);
	$actionFields = array(
	    'amount',
	    'action_type',
	    'date',
	    'success',
	    'ip_address',
	    'source',
	    'api_method',
	    'username',
	    'response_text',
	    'batch_id',
	    'processor_batch_id',
	    'response_code',
	    'processor_response_text',
	    'processor_response_code',
	    'device_license_number',
	    'device_nickname'
	);

	$mycurl=curl_init();
	$postStr='security_key='.$security_key.$constraints;
	$url="https://secure.nmi.com/api/query.php?". $postStr;
	curl_setopt($mycurl, CURLOPT_URL, $url);
	curl_setopt($mycurl, CURLOPT_RETURNTRANSFER, 1);
	$responseXML=curl_exec($mycurl);
	curl_close($mycurl);
	$xml = simplexml_load_string($responseXML, "SimpleXMLElement", LIBXML_NOCDATA);
	$json = json_encode($xml);
	$array_json = json_decode($json,TRUE);
	dd($array_json);

	if (!isset($array_json['transaction'])) {
	    return'No transactions returned';
	} else {
	    $transaction = $array_json['transaction'];
	    return $transaction;
	}
}