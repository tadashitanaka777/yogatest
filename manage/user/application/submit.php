<?php
namespace Manage\user\Application;

use Manage\PayUser;
use Manage\Common;
use Manage\Application;
use Manage\Login;
use WP_User;

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
                 企業アカウント　申請一覧
             </div>
             <div class="row ui three column grid">

            <?php
            $apc = new Application;
            //ステータスの変更
            if (isset($_POST['permissionId'])) {
                //許可をあたえる。
                $apc-> permittingCorp(
                    $_POST['permissionId'],
                    $_POST['permissionCorpStatus']
                );
            }
            //一覧の取得
            $results = $apc->getPermissionCorpList($ui->ID);
            // var_dump($results);
            // exit;
            // var_dump($_POST);
        ?><div class="row"><?php
foreach ($results as $value) {
   // var_dump($value);
   // var_dump($value->status);
    echo "<div class='column'>".$value->applicationId."</div>";
   //echo "<div class='column'>".$value->user_login."</div>";
   //echo "<div class='column'>".$value->user_email."</div>";
   //echo "<div class='column'>".$value->user_registered."</div>";
   //
    $arr = get_user_meta($value->applicationId);
    echo "<div class='column'>".$arr['first_name'][0]."</div>";
    echo "<div class='column'>";
    // $apliCorpStatus = $apc->getApplicationCorpStatus($ui->id, $value->ID);
//{申請の状況の表示}
    // $apc->showApplicationCorpStatus($apliCorpStatus, $value->ID);
    $apc->showPermissionCorpStatus($value->status, $value->id);
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
}
                        ?>
                 </div>
             </div>

       </div>
   </div>
</body>
</html>
