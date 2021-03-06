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
// var_dump($ui);

?>
     <div class="ui stackable left aligned page grid">
   <div class="fourteen wide column">
       <div class="ui four column grid">
             <div class="row">
                 イベント申請
             </div>
             <div class="row">
             </div>
                <?php
                $apc = new Application;
                // var_dump($ui->ID);
                $arr = $apc->getPost($ui->ID,$_GET['postId']);
                 // var_dump($arr);
                 // var_dump($_GET['postId']);
                 // exit;
                ?>
             <div class="row " style="background:#ccc;">
                 <div class="column">
                        <?=$arr->ID?>
                 </div>
                 <div class="column">
                        <?=$arr->post_title?>
                 </div>
                 <div class="column">
                     が申請可能なイベント
                 </div>
             </div>
             <div class="row ui three column grid segment">
                        <?php
                        if (isset($_POST['permissionWpPostId'])) {
                            // var_dump($_POST);
                            $apc->applicationPostType(
                                $ui->ID,
                                $_POST['permissionId'],
                                $_POST['applicationWpPostId'],
                                $_POST['permissionWpPostId'],
                                $_POST['kind']
                            );
                        }
                        $results = $apc->getPostTypeList("event");
                        foreach ($results as $value) {
                            // ◎自分自身への申請のみ表示する。
                                $isShow = $apc->isOwnPostTypeList(
                                    $ui->ID,
                                    $value->post_author,
                                    $arr->post_type,
                                    "event"
                                );
                                if (!$isShow) {
                                    continue;
                                }
                                // var_dump($arr->post_type);
                            //---------------------
                            ?><div class="row"><?php

                            echo "<div class='column'>".$value->ID."</div>";
                           //echo "<div class='column'>".$value->user_login."</div>";
                           //echo "<div class='column'>".$value->user_email."</div>";
                           //echo "<div class='column'>".$value->user_registered."</div>";
                            echo "<div class='column'>".$value->post_title."</div>";
                            echo "<div class='column'>";
                        //申請の状況の取得
                            $apliPostTypeStatus = $apc->getApplicationPostTypeStatus(
                                $arr->ID, //$ApplicationPostId,
                                $value->ID, //$permissionPostId,
                                "event"
                                               );

                            // var_dump($arr->ID);
                            // var_dump($value->ID);
                            // //{申請の状況の表示}QQ
                                               $apc->showApplicationPostTypeStatus(
                                                   $apliPostTypeStatus,
                                                   $value->post_author,
                                                   $arr->ID, //$ApplicationPostId,
                                                   $value->ID, //$permissionPostId,
                                                   "event"
                                               );
                                               echo "</div>";
                        ?></div><div class="ui section divider"></div><?php
                        }
                        ?>
             </div>

       </div>
   </div>
</body>
</html>
