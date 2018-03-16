<?php
namespace Manage\user;

use Manage\PayUser;

require_once('../../vendor/autoload.php');
require_once("../../payjp-php/vendor/autoload.php");

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
        </div>
       <hr>
       <form class="" action="planChange.php" method="post">
           <div class="ui two column grid">
                   <div class="row">
                     <div class="column">
                            <?php
                            echo 'payJpID:';
                            echo $ui->payjpCusId;
                            ?>
                     </div>
                     <div class="column">
                            <?php
                            if (isset($ui->payjpCusId)) {
                                echo "plan:";
                                echo $ui->planName;
                                echo "価格:";
                                echo $ui->planPrice;
                                echo "円";
                            }
                            ?>
                     </div>
                   </div>
                   <div class="column">
                           <div class="ui form">
                               <div class="grouped fields">
                                   <label for="plan">プランを選択</label>
                                   <div class="field">
                                       <div class="ui radio checkbox">
                                           <input name="plan"  tabindex="0" class="" type="radio" value="plan000"
                                           <?php
                                           if (($ui->planName <> "plan001")&($ui->planName <> "plan002")) {
                                               echo "checked='checked'";
                                           }
                                           ?>
                                           >
                                           <label>無料プラン</label>
                                       </div>
                                   </div>
                                   <div class="field">
                                       <div class="ui radio checkbox">
                                           <input name="plan" tabindex="0" class="" type="radio" value="plan001"
                                           <?php
                                           if ($ui->planName == "plan001") {
                                               echo "checked";
                                           }
                                           ?>
                                           >
                                           <label>980円プラン</label>
                                       </div>
                                   </div>
                                   <div class="field">
                                       <div class="ui radio checkbox">
                                           <input name="plan" tabindex="0" class="" type="radio" value="plan002"
                                           <?php
                                           if ($ui->planName == "plan002") {
                                               echo "checked";
                                           }
                                           ?>>

                                           <label>9800円プラン</label>
                                       </div>
                                   </div>
                               </div>

                           </div>
                  </div>
                  <div class="column">
                      <button  class="ui primary button submit" type="submit" >変更</buttn>
                  </div>
              </div>
      </form>

</div>
 </body>
 </html>
