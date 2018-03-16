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
                 ACTION申請一覧
             </div>
             <div class="row ui three column grid">

            <?php
            $apc = new Application;
            //ステータスの変更
            if (isset($_POST['permissionId'])) {
                // var_dump($_POST);
                //許可をあたえる。
                $apc-> permittingPostType(
                    $_POST['permissionId'],
                    $_POST['kind'],
                    $_POST['permissionPostTypeStatus']
                );
            }?>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "instructor";
            $results = $apc->getPermissionPostTypeList($ui->ID ,$postType);
            // var_dump($ui->ID);
            // var_dump($postType);
            // var_dump($results);
            // exit;
            ?>
            <div class="row">
                <?php
                foreach ($results as $value) {
                    // var_dump($value->applicationWpPostId);
                    $rstpt = $apc->getPost($ui->ID, $value->applicationWpPostId);
                    echo "<div class='column'>■".$value->kind."■　&nbsp;";
                    echo $value->applicationWpPostId.":".$rstpt->post_title;
                    $rstpt = $apc->getPost($ui->ID, $value->permissionWpPostId);
                    echo "</div>";
                    echo "<div class='column'>";
                    echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                    echo "</div>";
                    // $arr = get_user_meta($value->applicationId);
                    // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                    echo "<div class='column'>";
                    //{申請の状況の表示}
                    $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                    echo "</div>";
                }
                ?>
            </div>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "event";
                $results = $apc->getPermissionPostTypeList($ui->ID, $postType);
                // var_dump($results);
                ?>
                <div class="row">
                    <?php
                    foreach ($results as $value) {
                        // $rstpt = $apc->getPost($ui->ID, $value->applicationWpPostId);
                        // var_dump($rstpt);
                        echo "<div class='column'>■".$value->kind."■　&nbsp;";
                        echo $value->applicationWpPostId;
                        // echo ":".$rstpt->post_title;
                        $rstpt = $apc->getPostFromPostId($value->permissionWpPostId);
                        // print_r($wpdb->queries);
                        echo "</div>";
                        echo "<div class='column'>";
                        echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                        echo "</div>";
                        // $arr = get_user_meta($value->applicationId);
                        // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                        echo "<div class='column'>";
                        //{申請の状況の表示}
                        $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "studio";
                $results = $apc->getPermissionPostTypeList($ui->ID, $postType);
                // var_dump($results);
                // exit;
                ?>
                <div class="row">
                    <?php
                    foreach ($results as $value) {
                        $rstpt = $apc->getPost($value->applicationId, $value->applicationWpPostId);//applicationWpPostId
                        // var_dump($ui->ID,$value->applicationId,$value->applicationWpPostId,$rstpt);
                        // exit;
                        echo "<div class='column'>■".$value->kind."■　&nbsp;";
                        echo $value->applicationWpPostId.":".$rstpt->post_title;
                        $rstpt = $apc->getPost($ui->ID, $value->permissionWpPostId);
                        echo "</div>";
                        echo "<div class='column'>";
                        echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                        echo "</div>";
                        // $arr = get_user_meta($value->applicationId);
                        // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                        echo "<div class='column'>";
                        //{申請の状況の表示}
                        $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "job";
                $results = $apc->getPermissionPostTypeList($ui->ID, $postType);
                // var_dump($results);
                // exit;
                ?>
                <div class="row">
                    <?php
                    foreach ($results as $value) {
                        $rstpt = $apc->getPost($value->applicationWpPostId);
                        echo "<div class='column'>■".$value->kind."■　&nbsp;";
                        echo $value->applicationWpPostId.":".$rstpt->post_title;
                        $rstpt = $apc->getPost($value->permissionWpPostId);
                        echo "</div>";
                        echo "<div class='column'>";
                        echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                        echo "</div>";
                        // $arr = get_user_meta($value->applicationId);
                        // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                        echo "<div class='column'>";
                        //{申請の状況の表示}
                        $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "license";
                $results = $apc->getPermissionPostTypeList($ui->ID, $postType);
                // var_dump($results);
                // exit;
                ?>
                <div class="row">
                    <?php
                    foreach ($results as $value) {
                        $rstpt = $apc->getPost($value->applicationWpPostId);
                        echo "<div class='column'>■".$value->kind."■　&nbsp;";
                        echo $value->applicationWpPostId.":".$rstpt->post_title;
                        $rstpt = $apc->getPost($value->permissionWpPostId);
                        echo "</div>";
                        echo "<div class='column'>";
                        echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                        echo "</div>";
                        // $arr = get_user_meta($value->applicationId);
                        // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                        echo "<div class='column'>";
                        //{申請の状況の表示}
                        $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php
            //一覧の取得---------------------------------------------
            $postType = "shop";
                $results = $apc->getPermissionPostTypeList($ui->ID, $postType);
                // var_dump($results);
                // exit;
                ?>
                <div class="row">
                    <?php
                    foreach ($results as $value) {
                        $rstpt = $apc->getPost($value->applicationWpPostId);
                        echo "<div class='column'>■".$value->kind."■　&nbsp;";
                        echo $value->applicationWpPostId.":".$rstpt->post_title;
                        $rstpt = $apc->getPost($value->permissionWpPostId);
                        echo "</div>";
                        echo "<div class='column'>";
                        echo "→".$value->permissionWpPostId.":".$rstpt->post_title;
                        echo "</div>";
                        // $arr = get_user_meta($value->applicationId);
                        // echo "<div class='column'>".$value->applicationId.":".$arr['first_name'][0]."</div>";
                        echo "<div class='column'>";
                        //{申請の状況の表示}
                        $apc->showPermissionPostTypeStatus($value->status, $postType, $value->id);
                        echo "</div>";
                    }
                    ?>
                </div>


         </div>
       </div>
   </div>
</body>
</html>
