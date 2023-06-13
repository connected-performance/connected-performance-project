<?php
use App\Models\Customer;
use App\Models\User;

function getCustomer()
{
	$customers = Customer::select('user_id')->get();
	$users = User::whereIn('id', $customers)->get();
	
	return $users;
}