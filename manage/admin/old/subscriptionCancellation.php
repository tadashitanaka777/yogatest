<?php
// namespace Payjp;

require_once("../payjp-php/vendor/autoload.php");

// var_dump($_POST);
$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');
$su = \Payjp\Subscription::retrieve($_GET['id']);

if ($_GET["mode"] == "cancel") {
    echo "キャンセル処理<br />";
    $result = $su->cancel();
    // var_dump($result->status);
    exit;
}
if ($_GET["mode"] == "del") {
    echo "削除処理<br />";
    $result = $su->delete();
    var_dump($result);
    exit;
}
// $arg = array(
//     "customer" => $_GET["id"],
//     "plan" => "test001",
// );
try {
    echo "定期購入の停止<br />";
    $result = $su->pause();
    var_dump($result->status);
} catch (Exception $e) {
    echo "定期購入の再開<br />";
    echo $e->getMessage();
    $result = $su->resume();
    echo  $result->status;
    // var_dump($result->status);
}

// $result = \Payjp\Subscription::create($arg);
// echo $result;
