<?php
namespace Manage\user;

use Manage\PayUser;
use \Exception;

require_once('../../vendor/autoload.php');
require_once("../../payjp-php/vendor/autoload.php");

if (is_user_logged_in()) {
    $pu = new PayUser;
    $userinfo = wp_get_current_user();
    $ui = $pu->getUserPayinfo($userinfo);
    var_dump($ui);
}
if (!isset($_POST["plan"])) {
    exit;
}
$selectPlan = htmlentities($_POST["plan"]);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width,initial-scale=1.0" name="viewport">
  <title></title>
  <script
             src="https://code.jquery.com/jquery-1.12.4.min.js"
             integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
             crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://js.pay.jp/"></script>
  <link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css" type="text/css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.min.css" media="screen" title="no title" charset="utf-8">
  <style media="screen">
    section {
      margin: 15px;
      max-width: 960px;
    }
  </style>
</head>
<body>
    <div class="ui stackable left aligned page grid">
  <div class="fourteen wide column">
          <div class="ui four column grid">
                  <div class="row">
                    <div class="column"><?php
                    if (is_user_logged_in()) {
                        echo 'ログイン中<br />';
                        // var_dump($umeta);
                    } else {
                        echo 'ログインしてください。<br />';
                        exit;
                    }
                    ?></div>
                    <div class="column">
                            <?php
                            echo "wpuser:";
                            echo $ui->id;
                            ?>
                    </div>
                    <div class="column">
                            <?php
                            echo "email:";
                            echo $ui->email;

                            ?>
                    </div>
                  </div>
           </div>
          <hr>
<?php
//tolkenidは一度しか利用できないため
// session_start();
// if (isset($_SESSION['talkenId'])) {
//     if ($_SESSION['talkenId'] == $_POST["talkenId"]) {
//         echo "ブラウザで戻ってください。";
//         exit;
//     }
// } else {
//     $_SESSION['talkenId'] = $_POST["talkenId"];
// }

// var_dump(isset($_SESSION['talkenId']));
// var_dump($_POST);
// var_dump($ui->id);
// var_dump($ui->payjpCusId);
try {
    // ini_set('display_errors', 0);
    // 顧客を削除
    //false  存在する位置を返す0,1,2,3
    if (preg_match('/cus_/',$ui->payjpCusId)) {
        $cu = \Payjp\Customer::retrieve($ui->payjpCusId);
        //新規のカードを登録
        $arg = array(
            "card" => $_POST["talkenId"],
        );
        try {
            $result = $cu->cards->create($arg);
        } catch (\Exception $e) {
            // echo __LINE__;
            // echo $e->getMessage();
            echo "登録エラーです。戻って再度登録をお願いします。";
            echo "<br />";
            echo "同じカードで登録・もしくはカード番号が違います。";
            exit;
        }
        //以前のカードを消去
        if ($ui->cardId <> null) {
            try {
                $card = $cu->cards->retrieve($ui->cardId);
                $card->delete();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        // var_dump($result);
        if ($result == null) {

        }
        echo "カード情報の更新をしました。";
    }
    //登録顧客IDが存在しない。初回登録の場合
    if (!preg_match('/cus_/',$ui->payjpCusId)) {
        echo __LINE__;
        var_dump(strpos($ui->payjpCusId, 'cus_'));
        //新規顧客を登録
        $arg = array(
            // "email" => $_POST["email"],
            "card" => $_POST["talkenId"],
            "description" => $ui->id,
        );
        // var_dump($arg);
        // exit;
        $customer = \Payjp\Customer::create($arg);
        var_dump($customer);
        // var_dump($customer->cards->data[0]->customer);
        $result = update_user_meta($ui->id, $meta_key = 'payjpCusId', $meta_value = $customer->cards->data[0]->customer, $prev_value = false);
        $ui->payjpCusId = $customer->cards->data[0]->customer;
        echo "登録されました。";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo "error".__LINE__;
}
?>

    //プランの変更・登録
    <div class="">
          <?php

          try {
              if (isset($ui->planSubId)) {
                  if ($ui->planName == $selectPlan) {
                      throw new Exception("おなじプランには登録できません。line:".__LINE__, 1);
                  }
              }
              if ($ui->planId == $selectPlan){
                  throw new Exception("おなじプランには登録できません。line:".__LINE__, 1);
              }
              if (!isset($ui->payjpCusId)) {
                  throw new Exception("顧客CusIdが不明です。line:".__LINE__, 1);
              }
              $cancelPlanSubId = $ui->planSubId;
              $result = $pu->changePlan($ui->payjpCusId, $cancelPlanSubId, $selectPlan);
          } catch (Exception $e) {
              // var_dump($selectPlan);
              // var_dump($ui->payjpCusId);
              // var_dump($cancelPlanSubId);
              // echo __LINE__."error";
              echo $e->getMessage();
              exit;
          }

          ?>
    </div>
    <div class="row">
        変更・登録いたしました。
    </div>
</div>
</div>
</body>
</html><?php
