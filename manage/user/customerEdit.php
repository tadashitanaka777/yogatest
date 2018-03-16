<?php
// namespace Payjp;

require_once("../payjp-php/vendor/autoload.php");

// var_dump($_POST);
$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');

define(customerID, "cus_81b3c6ec604a712b5d5f2fffe1b6");
$arg = array(
    "id" => customerID,
);
try {
} catch (Exception $e) {
}

$customer = \Payjp\Customer::retrieve($arg);
echo "顧客ID<BR />";
echo $customer->id;
echo "<BR />";
echo $customer->email;
echo "<BR />";
echo  $customer->cards->data[0]->id;
echo "<BR />";
echo  $customer->cards->data[0]->brand;
echo "<BR />";
echo "下四桁";
echo  $customer->cards->data[0]->last4;
echo "<BR />";
echo "カード番号の取得※番号などをすべては確認できないと思われる。";
$cardId = $customer->cards->data[0]->id;
$cu = \Payjp\Customer::retrieve(customerID);
$result = $cu->cards->retrieve($cardId);
var_dump($result);
// $result = \Payjp\Subscription::create($arg);
// echo $result;
