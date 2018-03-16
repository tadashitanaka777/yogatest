<?php
// namespace Payjp;

require_once("../../payjp-php/vendor/autoload.php");

// var_dump($_POST);
$obj = \Payjp\Payjp::setApiKey('sk_test_601eb2fe36a9583d4817a68d');

$arg = array(
    "limit" => 10,
    "offset" => 10,
);
try {
} catch (Exception $e) {
}

$customer = \Payjp\Customer::all();
// var_dump($customer->data);
foreach ($customer->data as $key => $value) {
    echo "顧客ID<BR />";
    echo $value->id;
    // var_dump($value);
    echo "<BR />";
    echo $value->email;
    echo "<br />description[wp_ID]";
    echo $value->description;
    echo "<BR />";
    if (isset($value->cards->data[0])) {
        echo  $value->cards->data[0]->id;
        echo "<BR />";
        echo  $value->cards->data[0]->brand;
        echo "<BR />";
        echo "下四桁";
        echo  $value->cards->data[0]->last4;
        echo "<BR />";
        echo '<a href="subscription.php?id='.$value->id.'">定期課金する。test001課金</a>';
        echo "<BR />";
        $sbn = \Payjp\Customer::retrieve($value->id);
        var_dump($sbn);
        if (isset($sbn->subscriptions->data[0])) {
            echo "定期購入状況";
            echo "<BR />";
            $text = str_replace("Payjp\Subscription JSON:","",$sbn->subscriptions->data[0]);
            // var_dump($text);
            $arr = json_decode($text);

            echo " [ ";
            echo $arr->status;
            echo " ] ";
            echo $arr->id;
            echo '<a href="subscriptionCancellation.php?id='.$arr->id.'">切り替え</a>';
            echo "<BR />";
            echo '<a href="subscriptionCancellation.php?id='.$arr->id.'&mode=cancel">キャンセル</a>';
            echo "<BR />";
            echo '<a href="subscriptionCancellation.php?id='.$arr->id.'&mode=del">削除</a>';
            // var_dump();
            echo "<br />";
        }
        echo "<BR />";
    } else {
        echo "card無し";
    }
    echo "<hr />";
}
// echo "カード番号の取得※番号などをすべては確認できないと思われる。";
// $cardId = $customer->cards->data[0]->id;
// $cu = \Payjp\Customer::retrieve(customerID);
// $result = $cu->cards->retrieve($cardId);
// var_dump($result);
// $result = \Payjp\Subscription::create($arg);
// echo $result;
