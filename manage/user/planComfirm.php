<?php
namespace Manage\user;

use Manage\PayUser;
use Exception;

require_once('../../vendor/autoload.php');
require_once("../../payjp-php/vendor/autoload.php");

if (!isset($_POST["plan"])) {
    exit;
}
$selectPlan = htmlentities($_POST["plan"]);
// var_dump($selectPlan);
if (is_user_logged_in()) {
    $pu = new PayUser;
    $userinfo = wp_get_current_user();
    $ui = $pu->getUserPayinfo($userinfo);
    var_dump($ui);
}
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
           <a href="javascript:history.back();">戻る</a>
           <!-- start******************* -->
          <div class="column">
                <?php
              // var_dump($selectPlan);

                    $planObj = $pu->getPlaninfo($selectPlan);

                ?>
                <?php echo $planObj->name;?>/
                月額<?php echo $planObj->amount;?>円
          </div>

          <div class="">
                <?php

                try {
                    if (isset($ui->planSubId)) {
                        $cancelPlanSubId = $ui->planSubId;
                    }
                    if ($ui->planId == $selectPlan){
                        throw new Exception("おなじプランには登録できません。", 1);
                    }
                    $result = $pu->changePlan($ui->payjpCusId, $cancelPlanSubId, $selectPlan);
                } catch (Exception $e) {
                    var_dump($selectPlan);
                    var_dump($ui->payjpCusId);
                    var_dump($cancelPlanSubId);
                    echo __LINE__."error";
                    echo $e->getMessage();
                    exit;
                }

                ?>
          </div>
          <div class="row">
              変更・登録いたしました。
          </div>
          <!-- end******************* -->
        </div>
    </div>
</div>
</body>
</html>
