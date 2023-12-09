<?php

namespace App\Gateway;

define("APPROVED", 1);
define("DECLINED", 2);
define("ERROR", 3);

class Gwapi {

// Initial Setting Functions

  function setLogin($security_key) {
    $this->login['security_key'] = $security_key;
  }

  function setOrder($orderid,
        $orderdescription,
        $tax,
        $shipping,
        $ponumber,
        $ipaddress) {
    $this->order['orderid']          = $orderid;
    $this->order['orderdescription'] = $orderdescription;
    $this->order['tax']              = $tax;
    $this->order['shipping']         = $shipping;
    $this->order['ponumber']         = $ponumber;
    $this->order['ipaddress']        = $ipaddress;
  }

  function setBilling($firstname,
        $lastname,
        $company,
        $address1,
        $address2,
        $city,
        $state,
        $zip,
        $country,
        $phone,
        $fax,
        $email,
        $website) {
    $this->billing['firstname'] = $firstname;
    $this->billing['lastname']  = $lastname;
    $this->billing['company']   = $company;
    $this->billing['address1']  = $address1;
    $this->billing['address2']  = $address2;
    $this->billing['city']      = $city;
    $this->billing['state']     = $state;
    $this->billing['zip']       = $zip;
    $this->billing['country']   = $country;
    $this->billing['phone']     = $phone;
    $this->billing['fax']       = $fax;
    $this->billing['email']     = $email;
    $this->billing['website']   = $website;
  }

  function setShipping($firstname,
        $lastname,
        $company,
        $address1,
        $address2,
        $city,
        $state,
        $zip,
        $country,
        $email) {
    $this->shipping['firstname'] = $firstname;
    $this->shipping['lastname']  = $lastname;
    $this->shipping['company']   = $company;
    $this->shipping['address1']  = $address1;
    $this->shipping['address2']  = $address2;
    $this->shipping['city']      = $city;
    $this->shipping['state']     = $state;
    $this->shipping['zip']       = $zip;
    $this->shipping['country']   = $country;
    $this->shipping['email']     = $email;
  }

  function getPlan(
    $plan_payments,
    $plan_amount,
    $plan_name,
    $plan_id,
    $month_frequency,
    $day_of_month) {


    $this->plan['plan_payments'] = $plan_payments;//El número de pagos antes de que se complete el plan recurrente.
    $this->plan['plan_amount'] = $plan_amount;//El monto del plan que se cobrará en cada ciclo de facturación.
    $this->plan['plan_name'] = $plan_name;//El nombre para mostrar del plan.
    $this->plan['plan_id'] = $plan_id;//El ID de plan único que hace referencia solo a este plan recurrente.
    $this->plan['month_frequency'] = 1;//Con qué frecuencia, en meses, cobrar al cliente
    $this->plan['day_of_month'] = 30;//El día que se cobrará al cliente.
  }

  function getSubscription($first_name, $last_name) {
    $this->subscription['first_name'] = $first_name;//Nombre del titular de la tarjeta.
    $this->subscription['last_name'] = $last_name;//Apellido del titular de la tarjeta.
  }

  // Transaction Functions
  function doSale($amount, $ccnumber, $ccexp, $cvv) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Sales Information
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    $query .= "cvv=" . urlencode($cvv) . "&";
    // Order Information
    $query .= "ipaddress=" . urlencode($this->order['ipaddress']) . "&";
    $query .= "orderid=" . urlencode($this->order['orderid']) . "&";
    $query .= "orderdescription=" . urlencode($this->order['orderdescription']) . "&";
    $query .= "tax=" . urlencode(number_format($this->order['tax'],2,".","")) . "&";
    $query .= "shipping=" . urlencode(number_format($this->order['shipping'],2,".","")) . "&";
    $query .= "ponumber=" . urlencode($this->order['ponumber']) . "&";
    // Billing Information
    $query .= "firstname=" . urlencode($this->billing['firstname']) . "&";
    $query .= "lastname=" . urlencode($this->billing['lastname']) . "&";
    $query .= "company=" . urlencode($this->billing['company']) . "&";
    $query .= "address1=" . urlencode($this->billing['address1']) . "&";
    $query .= "address2=" . urlencode($this->billing['address2']) . "&";
    $query .= "city=" . urlencode($this->billing['city']) . "&";
    $query .= "state=" . urlencode($this->billing['state']) . "&";
    $query .= "zip=" . urlencode($this->billing['zip']) . "&";
    $query .= "country=" . urlencode($this->billing['country']) . "&";
    $query .= "phone=" . urlencode($this->billing['phone']) . "&";
    $query .= "fax=" . urlencode($this->billing['fax']) . "&";
    $query .= "email=" . urlencode($this->billing['email']) . "&";
    $query .= "website=" . urlencode($this->billing['website']) . "&";
    // Shipping Information
    $query .= "shipping_firstname=" . urlencode($this->shipping['firstname']) . "&";
    $query .= "shipping_lastname=" . urlencode($this->shipping['lastname']) . "&";
    $query .= "shipping_company=" . urlencode($this->shipping['company']) . "&";
    $query .= "shipping_address1=" . urlencode($this->shipping['address1']) . "&";
    $query .= "shipping_address2=" . urlencode($this->shipping['address2']) . "&";
    $query .= "shipping_city=" . urlencode($this->shipping['city']) . "&";
    $query .= "shipping_state=" . urlencode($this->shipping['state']) . "&";
    $query .= "shipping_zip=" . urlencode($this->shipping['zip']) . "&";
    $query .= "shipping_country=" . urlencode($this->shipping['country']) . "&";
    $query .= "shipping_email=" . urlencode($this->shipping['email']) . "&";
    $query .= "type=sale";
    return $this->_doPost($query);
  }

  function doPlan() {
    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    //
    $query .= "recurring=" . urlencode('add_plan') . "&";
    $query .= "plan_payments=" . urlencode($this->plan['plan_payments']) . "&";
    $query .= "plan_amount=" . urlencode($this->plan['plan_amount']) . "&";
    $query .= "plan_name=" . urlencode($this->plan['plan_name']) . "&";
    $query .= "plan_id=" . urlencode(strval($this->plan['plan_id'])) . "&";
    $query .= "month_frequency=" . urlencode($this->plan['month_frequency']) . "&";
    $query .= "day_of_month=" . urlencode($this->plan['day_of_month']) . "&";
    $query .= "type=add_plan";
    return $this->_doPost($query);
  }

  function  doSubscription($ccnumber, $ccexp) {
    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    //
    $query .= "recurring=" . urlencode('add_subscription') . "&";
    $query .= "first_name=" . urlencode($this->subscription['first_name']) . "&";
    $query .= "last_name=" . urlencode($this->subscription['last_name']) . "&";
    $query .= "plan_id=" . urlencode(strval($this->plan['plan_id'])) . "&";
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "type=add_subscription";
    return $this->_doPost($query);
  }

  function doCustomer($customer_id, $customer_card_number, $customer_exp_date, $customer_name, $customer_last_name, $customer_address, $customer_city, $customer_state, $customer_country, $customer_phone, $customer_email)
  {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "customer_vault=" . urlencode('add_customer') . "&";
    $query .= "customer_vault_id=" . urlencode($customer_id) . "&";
    $query .= "ccnumber=" . urlencode($customer_card_number) . "&";
    $query .= "ccexp=" . urlencode($customer_exp_date) . "&";
    $query .= "firstname=" . urlencode($customer_name) . "&";
    $query .= "lastname=" . urlencode($customer_last_name) . "&";
    $query .= "address1=" . urlencode($customer_address) . "&";
    $query .= "city=" . urlencode($customer_city) . "&";
    $query .= "state=" . urlencode($customer_state) . "&";
    $query .= "country=" . urlencode($customer_country) . "&";
    $query .= "phone=" . urlencode($customer_phone) . "&";
    $query .= "email=" . urlencode($customer_email) . "&";
    return $this->_doPost($query);
  }

  function doAuth($amount, $ccnumber, $ccexp, $cvv="") {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Sales Information
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    $query .= "cvv=" . urlencode($cvv) . "&";
    // Order Information
    $query .= "ipaddress=" . urlencode($this->order['ipaddress']) . "&";
    $query .= "orderid=" . urlencode($this->order['orderid']) . "&";
    $query .= "orderdescription=" . urlencode($this->order['orderdescription']) . "&";
    $query .= "tax=" . urlencode(number_format($this->order['tax'],2,".","")) . "&";
    $query .= "shipping=" . urlencode(number_format($this->order['shipping'],2,".","")) . "&";
    $query .= "ponumber=" . urlencode($this->order['ponumber']) . "&";
    // Billing Information
    $query .= "firstname=" . urlencode($this->billing['firstname']) . "&";
    $query .= "lastname=" . urlencode($this->billing['lastname']) . "&";
    $query .= "company=" . urlencode($this->billing['company']) . "&";
    $query .= "address1=" . urlencode($this->billing['address1']) . "&";
    $query .= "address2=" . urlencode($this->billing['address2']) . "&";
    $query .= "city=" . urlencode($this->billing['city']) . "&";
    $query .= "state=" . urlencode($this->billing['state']) . "&";
    $query .= "zip=" . urlencode($this->billing['zip']) . "&";
    $query .= "country=" . urlencode($this->billing['country']) . "&";
    $query .= "phone=" . urlencode($this->billing['phone']) . "&";
    $query .= "fax=" . urlencode($this->billing['fax']) . "&";
    $query .= "email=" . urlencode($this->billing['email']) . "&";
    $query .= "website=" . urlencode($this->billing['website']) . "&";
    // Shipping Information
    $query .= "shipping_firstname=" . urlencode($this->shipping['firstname']) . "&";
    $query .= "shipping_lastname=" . urlencode($this->shipping['lastname']) . "&";
    $query .= "shipping_company=" . urlencode($this->shipping['company']) . "&";
    $query .= "shipping_address1=" . urlencode($this->shipping['address1']) . "&";
    $query .= "shipping_address2=" . urlencode($this->shipping['address2']) . "&";
    $query .= "shipping_city=" . urlencode($this->shipping['city']) . "&";
    $query .= "shipping_state=" . urlencode($this->shipping['state']) . "&";
    $query .= "shipping_zip=" . urlencode($this->shipping['zip']) . "&";
    $query .= "shipping_country=" . urlencode($this->shipping['country']) . "&";
    $query .= "shipping_email=" . urlencode($this->shipping['email']) . "&";
    $query .= "type=auth";
    return $this->_doPost($query);
  }

  function doCredit($amount, $ccnumber, $ccexp) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Sales Information
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    // Order Information
    $query .= "ipaddress=" . urlencode($this->order['ipaddress']) . "&";
    $query .= "orderid=" . urlencode($this->order['orderid']) . "&";
    $query .= "orderdescription=" . urlencode($this->order['orderdescription']) . "&";
    $query .= "tax=" . urlencode(number_format($this->order['tax'],2,".","")) . "&";
    $query .= "shipping=" . urlencode(number_format($this->order['shipping'],2,".","")) . "&";
    $query .= "ponumber=" . urlencode($this->order['ponumber']) . "&";
    // Billing Information
    $query .= "firstname=" . urlencode($this->billing['firstname']) . "&";
    $query .= "lastname=" . urlencode($this->billing['lastname']) . "&";
    $query .= "company=" . urlencode($this->billing['company']) . "&";
    $query .= "address1=" . urlencode($this->billing['address1']) . "&";
    $query .= "address2=" . urlencode($this->billing['address2']) . "&";
    $query .= "city=" . urlencode($this->billing['city']) . "&";
    $query .= "state=" . urlencode($this->billing['state']) . "&";
    $query .= "zip=" . urlencode($this->billing['zip']) . "&";
    $query .= "country=" . urlencode($this->billing['country']) . "&";
    $query .= "phone=" . urlencode($this->billing['phone']) . "&";
    $query .= "fax=" . urlencode($this->billing['fax']) . "&";
    $query .= "email=" . urlencode($this->billing['email']) . "&";
    $query .= "website=" . urlencode($this->billing['website']) . "&";
    $query .= "type=credit";
    return $this->_doPost($query);
  }

  function doOffline($authorizationcode, $amount, $ccnumber, $ccexp) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Sales Information
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    $query .= "authorizationcode=" . urlencode($authorizationcode) . "&";
    // Order Information
    $query .= "ipaddress=" . urlencode($this->order['ipaddress']) . "&";
    $query .= "orderid=" . urlencode($this->order['orderid']) . "&";
    $query .= "orderdescription=" . urlencode($this->order['orderdescription']) . "&";
    $query .= "tax=" . urlencode(number_format($this->order['tax'],2,".","")) . "&";
    $query .= "shipping=" . urlencode(number_format($this->order['shipping'],2,".","")) . "&";
    $query .= "ponumber=" . urlencode($this->order['ponumber']) . "&";
    // Billing Information
    $query .= "firstname=" . urlencode($this->billing['firstname']) . "&";
    $query .= "lastname=" . urlencode($this->billing['lastname']) . "&";
    $query .= "company=" . urlencode($this->billing['company']) . "&";
    $query .= "address1=" . urlencode($this->billing['address1']) . "&";
    $query .= "address2=" . urlencode($this->billing['address2']) . "&";
    $query .= "city=" . urlencode($this->billing['city']) . "&";
    $query .= "state=" . urlencode($this->billing['state']) . "&";
    $query .= "zip=" . urlencode($this->billing['zip']) . "&";
    $query .= "country=" . urlencode($this->billing['country']) . "&";
    $query .= "phone=" . urlencode($this->billing['phone']) . "&";
    $query .= "fax=" . urlencode($this->billing['fax']) . "&";
    $query .= "email=" . urlencode($this->billing['email']) . "&";
    $query .= "website=" . urlencode($this->billing['website']) . "&";
    // Shipping Information
    $query .= "shipping_firstname=" . urlencode($this->shipping['firstname']) . "&";
    $query .= "shipping_lastname=" . urlencode($this->shipping['lastname']) . "&";
    $query .= "shipping_company=" . urlencode($this->shipping['company']) . "&";
    $query .= "shipping_address1=" . urlencode($this->shipping['address1']) . "&";
    $query .= "shipping_address2=" . urlencode($this->shipping['address2']) . "&";
    $query .= "shipping_city=" . urlencode($this->shipping['city']) . "&";
    $query .= "shipping_state=" . urlencode($this->shipping['state']) . "&";
    $query .= "shipping_zip=" . urlencode($this->shipping['zip']) . "&";
    $query .= "shipping_country=" . urlencode($this->shipping['country']) . "&";
    $query .= "shipping_email=" . urlencode($this->shipping['email']) . "&";
    $query .= "type=offline";
    return $this->_doPost($query);
  }

  function doCapture($transactionid, $amount) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Transaction Information
    $query .= "transactionid=" . urlencode($transactionid) . "&";
    if ($amount>0) {
        $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    }
    $query .= "type=capture";
    return $this->_doPost($query);
  }

  function doVoid($transactionid) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Transaction Information
    $query .= "transactionid=" . urlencode($transactionid) . "&";
    $query .= "type=void";
    return $this->_doPost($query);
  }

  function doRefund($transactionid, $amount) {

    $query  = "";
    // Login Information
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    // Transaction Information
    $query .= "transactionid=" . urlencode($transactionid) . "&";
    if ($amount>0) {
        $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    }
    $query .= "type=refund";
    return $this->_doPost($query);
  }

  /****consulta****/
  function testXmlQuery($security_key,$constraints)
  {

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
      $url="https://secure.networkmerchants.com/api/query.php?". $postStr;
      curl_setopt($mycurl, CURLOPT_URL, $url);
      curl_setopt($mycurl, CURLOPT_RETURNTRANSFER, 1);
      $responseXML=curl_exec($mycurl);
      curl_close($mycurl);
      $xml = simplexml_load_string($responseXML, "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array_json = json_decode($json,TRUE);

      if (isset($array_json['transaction'])) {
        $transaction = $array_json['transaction'];
        return $transaction;
      }elseif (isset($array_json['customer_vault'])) {
        $transaction = $array_json['customer_vault'];
        return $transaction;
      }elseif (isset($array_json['plan'])) {
        $transaction = $array_json['plan'];
        return $transaction;
      }else{
        return'No transactions returned';
      }
  }

  function _doPost($query) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://secure.networkmerchants.com/api/transact.php");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_POST, 1);

    if (!($data = curl_exec($ch))) {
        return ERROR;
    }
    curl_close($ch);
    unset($ch);
    //print "\n$data\n";
    $data = explode("&",$data);
    for($i=0;$i<count($data);$i++) {
        $rdata = explode("=",$data[$i]);
        $this->responses[$rdata[0]] = $rdata[1];
    }
    return $this->responses['response'];
  }

  // Functions Create Invoice
  function createInvoice($amount,$customer_id) {
    $query  = "";
    $query .= "invoicing=add_invoice&";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "amount=" . urlencode(number_format($amount,2,".","")) . "&";
    $query .= "email=" . urlencode($this->billing['email']) . "&";
    $query .= "orderid=" . urlencode($this->order['orderid']) . "&";
    $query .= "customer_id=" . urlencode($customer_id) . "&";
    $query .= "tax=" . urlencode(number_format($this->order['tax'],2,".","")) . "&";
    $query .= "first_name=" . urlencode($this->billing['firstname']) . "&";
    $query .= "last_name=" . urlencode($this->billing['lastname']) . "&";
    $query .= "ponumber	=" . urlencode($this->order['ponumber']) . "&";
    $query .= "company=" . urlencode($this->billing['company']) . "&";
    $query .= "address1=" . urlencode($this->billing['address1']) . "&";
    $query .= "address2=" . urlencode($this->billing['address2']) . "&";
    $query .= "city=" . urlencode($this->billing['city']) . "&";
    $query .= "state=" . urlencode($this->billing['state']) . "&";
    $query .= "zip=" . urlencode($this->billing['zip']) . "&";
    $query .= "country=" . urlencode($this->billing['country']) . "&";
    $query .= "phone=" . urlencode($this->billing['phone']) . "&";
    $query .= "fax=" . urlencode($this->billing['fax']) . "&";
    $query .= "website=" . urlencode($this->billing['website']);
    return $this->_doPost($query);
  }

  // Functions Send Invoice
  function sendInvoice($invoice_id) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "invoicing=send_invoice";
    $query .= "invoice_id=" . urlencode($invoice_id);
    return $this->_doPost($query);
  }

  // Functions Add Customer
  function addCustomer($type, $customer_id, $ccnumber, $ccexp, $customer_name, $customer_lastname, $customer_email) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "customer_vault=" . urlencode($type) . "&";
    $query .= "customer_vault_id=" . urlencode($customer_id) . "&";
    $query .= "ccnumber=" . urlencode($ccnumber) . "&";
    $query .= "ccexp=" . urlencode($ccexp) . "&";
    $query .= "firstname=" . urlencode($customer_name) . "&";
    $query .= "lastname=" . urlencode($customer_lastname) . "&";
    $query .= "email=" . urlencode($customer_email);
    return $this->_doPost($query);
  }

  // Functions Add Plan
  function addPlan($plan_payments, $plan_amount, $plan_name, $plan_id, $month_frequency, $day_of_month) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=add_plan&";
    $query .= "plan_payments=" . urlencode($plan_payments) . "&";
    $query .= "plan_amount=" . urlencode($plan_amount) . "&";
    $query .= "plan_name=" . urlencode($plan_name) . "&";
    $query .= "plan_id=" . urlencode($plan_id) . "&";
    $query .= "month_frequency=" . urlencode($month_frequency) . "&";
    $query .= "day_of_month=" . urlencode($day_of_month);
    return $this->_doPost($query);
  }

  // Functions Edit Plan
  function editPlan($current_plan_id, $plan_payments, $plan_amount, $month_frequency, $day_of_month, $plan_name) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=edit_plan&";
    $query .= "current_plan_id=" . urlencode($current_plan_id) . "&";
    if($plan_payments!=null){
      $query .= "plan_payments=" . urlencode($plan_payments) . "&";
    }
    if($plan_amount!=null){
      $query .= "plan_amount=" . urlencode($plan_amount) . "&";
    }
    if($plan_name!=null){
      $query .= "plan_name=" . urlencode($plan_name) . "&";
    }
    if($month_frequency!=null){
      $query .= "month_frequency=" . urlencode($month_frequency) . "&";
    }
    if($day_of_month!=null){
      $query .= "day_of_month=" . urlencode($day_of_month);
    }
    return $this->_doPost($query);
  }

  // Functions Add a Subscription to an Existing Plan
  function addSubscriptionToPlan($plan_id, $transaction_id, $start_date) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=add_subscription&";
    $query .= "plan_id=" . urlencode($plan_id) . "&";
    $query .= "start_date=" . urlencode($start_date) . "&";
    $query .= "source_transaction_id=" . urlencode($transaction_id);

    return $this->_doPost($query);
  }

  // Functions Add a Subscription to an Existing Plan
  function addSubscriptionCVToPlan($plan_id, $customer_vault_id, $order_id, $start_date) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=add_subscription&";
    $query .= "plan_id=" . urlencode($plan_id) . "&";
    $query .= "orderid=" . urlencode($order_id) . "&";
    $query .= "start_date=" . urlencode($start_date) . "&";
    $query .= "customer_vault_id=" . urlencode($customer_vault_id);

    return $this->_doPost($query);
  }

  // Functions Update a Custom Subscription's Plan Details
  function editSubscriptionToPlan($subscription_id, $customer_vault_id) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=update_subscription&";
    $query .= "subscription_id=" . urlencode($subscription_id) . "&";
    $query .= "customer_vault_id=" . urlencode($customer_vault_id);
    return $this->_doPost($query);
  }

  // Functions Update a Custom Subscription's Plan Details
  function editSubscription($subscription_id, $month_frequency, $day_of_month, $start_date) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=update_subscription&";
    $query .= "subscription_id=" . urlencode($subscription_id) . "&";
    $query .= "month_frequency=" . urlencode($month_frequency) . "&";
    $query .= "day_of_month=" . urlencode($day_of_month) . "&";
    $query .= "start_date=" . urlencode($start_date);
    return $this->_doPost($query);
  }

  // Functions Delete a Subscription
  function deleteSubscription($subscription_id) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "recurring=delete_subscription&";
    $query .= "subscription_id=" . urlencode($subscription_id);
    return $this->_doPost($query);
  }

  // Functions Add a Customer Vault
  function addCustomerVault($transaction_id, $customer_vault_id) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "customer_vault=add_customer&";
    $query .= "source_transaction_id=" . urlencode($transaction_id) . "&";
    $query .= "customer_vault_id=" . urlencode($customer_vault_id);
    return $this->_doPost($query);
  }

  // Functions Delete Customer
  function deleteCustomerVault($customer_id) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "customer_vault=delete_customer&";
    $query .= "customer_vault_id=" . urlencode($customer_id);
    return $this->_doPost($query);
  }

  // Functions Delete Customer
  function doSaleCustomerVault($customer_id, $amount, $orderid) {
    $query  = "";
    $query .= "security_key=" . urlencode($this->login['security_key']) . "&";
    $query .= "amount=" . urlencode($amount) . "&";
    $query .= "orderid=" . urlencode($orderid) . "&";
    $query .= "customer_vault_id=" . urlencode($customer_id);
    return $this->_doPost($query);
  }
}