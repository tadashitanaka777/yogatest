<?php
// namespace Payjp;

require_once("../payjp-php/vendor/autoload.php");

// var_dump($_POST);
$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');

$arg = array(
    "customer" => $_GET["id"],
    "plan" => "test001",
);
try {
    $customer = \Payjp\Subscription::create($arg);
    echo "定期購入<BR />";
    echo $customer->id;
    // var_dump($customer);
} catch (Exception $e) {
    echo $e->getMessage();;
}

// $result = \Payjp\Subscription::create($arg);
// echo $result;
