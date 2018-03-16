<?php
require_once('../wp-load.php');
// namespace Payjp;

require_once("../payjp-php/vendor/autoload.php");

// var_dump($_POST);
$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');
//wpuser情報の取得
$userinfo = wp_get_current_user();
// var_dump($userinfo->ID);
$arg = array(
    // "email" => $_POST["email"],
    "card" => $_POST["talkenId"],
    "description" => $userinfo->ID,
);
try {
    $customer = \Payjp\Customer::create($arg);
    echo "顧客ID<BR />";
    var_dump($customer->cards->data[0]->customer);
    $result = update_user_meta($userinfo->ID, $meta_key = 'payjpCusId', $meta_value = $customer->cards->data[0]->customer, $prev_value = false);
    var_dump($result);
} catch (Exception $e) {
    echo "顧客IDを取得できませんでした。";
}

// $result = \Payjp\Subscription::create($arg);
// echo $result;
