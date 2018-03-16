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
if (current_user_can(10)) {
    var_dump(current_user_can(10));
    echo "管理者でログイン<hr />";
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
 </head>
 <body>
<div class="ui stackable left aligned page grid">
   <div class="fourteen wide column">
       <div class="ui four column grid">
             <div class="row">
                 ユーザー検索
             </div>
             <div class="row">
                 ユーザー一覧
             </div>
             <div class="row ui six column grid">
                 <div class="row">
                     <?php
                     // var_dump($wpdb->users);

                     $results = $wpdb->get_results("
                         SELECT *
                         FROM $wpdb->users
                         WHERE user_status = '0'
                         ORDER BY user_registered DESC
                     ");
                     // var_dump($results);
                     foreach ($results as $value) {
                        // var_dump($value);
                        echo "<div class='column'>".$value->ID."</div>";
                        echo "<div class='column'>".$value->user_login."</div>";
                        echo "<div class='column'>".$value->user_email."</div>";
                        echo "<div class='column'>".$value->user_registered."</div>";
                        try {
                            $objectUi = $pu->getUserPayinfo($value);
                            if(isset($objectUi->payjpCusId)){
                                echo "<div class='column'>".$objectUi->payjpCusId."</div>";
                            }
                        } catch (\Exception $e) {
                            echo "<div class='column'></div>";

                        }

                     }
                     ?>
                 </div>
             </div>
              <div class="row">
                  <div class="column">
                      ステータス変更
                  </div>
              </div>
       </div>
   </div>
</div>
</body>
</html>
