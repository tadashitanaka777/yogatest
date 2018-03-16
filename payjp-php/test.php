<?php
require_once("vendor\autoload.php");

$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');
$myCard = array('number' => '4242424242424242', 'exp_month' => 5, 'exp_year' => 2020);
// $charge = \Payjp\Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'jpy'));
$arg = array(
customer => "cus_da71a2b2f395c738166b288ca400",
plan => "test001",
);
$result = \Payjp\Subscription::create($arg);
echo $result;
