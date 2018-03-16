<?php
namespace Manage\user\Application;

use Manage\PayUser;
use Manage\Application;
use Manage\Common;


session_start();
require_once('../../../vendor/autoload.php');
require_once("../../../payjp-php/vendor/autoload.php");

?>
<html>
<?php
require_once("../../src/header.php");
?>
<body>
<?php
//loginのチェックと　現在のステータス
Common::showWpLoginBar();
//Sessionloginのチェックと　現在のステータス
Common::showSessionLoginBar($ui->ID);
?>
     <div class="ui stackable left aligned page grid">
   <div class="fourteen wide column">
       <div class="ui four column grid">
             <div class="row">
                 企業検索
             </div>
             <div class="row">
                 企業一覧
             </div>
             <div class="row ui three column grid segment">

                        <?php
                     // var_dump($wpdb->users);

                        $results = $wpdb->get_results("
                         SELECT *
                         FROM $wpdb->users as A,
                              $wpdb->usermeta as B
                         WHERE A.user_status = '0'
                         AND A.ID = B.user_id
                         AND B.meta_key = 'kind'
                         AND B.meta_value = 'corp'
                         ORDER BY A.user_registered DESC
                     ");
                    //var_dump($results);
                        // var_dump($_POST);
                        $apc = new Application;
                        if (isset($_POST['ID'])) {
                            # code...
                            $apc->ApplicationCorp($ui->ID, $_POST['ID']);
                            // $apliCorpStatus = $apc->getApplicationCorpStatus($ui->ID, $_POST['ID']);
                        }
foreach ($results as $value) {
   // var_dump($value);
   ?><div class="row"><?php

    echo "<div class='column'>".$value->ID."</div>";
   //echo "<div class='column'>".$value->user_login."</div>";
   //echo "<div class='column'>".$value->user_email."</div>";
   //echo "<div class='column'>".$value->user_registered."</div>";
   //
    $arr = get_user_meta($value->ID);
    echo "<div class='column'>".$arr['first_name'][0]."</div>";
    echo "<div class='column'>";
    $apliCorpStatus = $apc->getApplicationCorpStatus($ui->ID, $value->ID);
//{申請の状況の表示}
    $apc->showApplicationCorpStatus($apliCorpStatus, $value->ID);
    echo "</div>";

   //try {
   //    $objectUi = $pu->getUserPayinfo($value);
   //    if(isset($objectUi->payjpCusId)){
   //        echo "<div class='column'>".$objectUi->payjpCusId."</div>";
   //    }
   //} catch (\Exception $e) {
   //    echo "<div class='column'></div>";
//
   //}
?></div><div class="ui section divider"></div><?php
}
                        ?>
             </div>

       </div>
   </div>
</body>
</html>
