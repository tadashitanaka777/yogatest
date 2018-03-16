<?php
namespace Manage\user\application;

//http://localhost:8000/wp-admin/
//http://localhost:8000/manage/user/application

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
       <table border="1" cellpadding="5" cellspacing="0">
         <tr>
           <th >【申請側】</th>
           <th >個人アカウント</th>
           <th >企業アカウント</th>
           <th >インストラクター</th>
           <th >イベント</th>
           <th >スタジオ</th>
           <th >求人</th>
           <th >COMPANY</th>
           <th >資格</th>
           <th >ショップ</th>
         </tr>
         <tr>
           <th>個人アカウント</th>
           <td>　</td>
           <td>
               <a href="corp.php" target="_blank">○</a>
               </td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
         </tr>
         <tr>
           <th>企業アカウント</th>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
         </tr>
         <tr>
           <th>インストラクター</th>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>○</td>
           <td>○</td>
           <td>　</td>
           <td>　</td>
           <td>○</td>
           <td>　</td>
         </tr>
         <tr>
           <th>イベント</th>
           <td>　</td>
           <td>　</td>
           <td>○
           </td>
           <td>　</td>
           <td>△</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>△</td>
         </tr>
         <tr>
           <th>スタジオ</th>
           <td>　</td>
           <td>　</td>
           <td>○</td>
           <td>△</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>◎</td>
           <td>　</td>
         </tr>
         <tr>
           <th>求人</th>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>◎</td>
           <td>◎</td>
           <td>　</td>
           <td>◎</td>
           <td>　</td>
           <td>◎</td>
         </tr>
         <tr>
           <th>COMPANY</th>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
         </tr>
         <tr>
           <th>資格</th>
           <td>　</td>
           <td>　</td>
           <td>○</td>
           <td>　</td>
           <td>◎</td>
           <td>　</td>
           <td>◎</td>
           <td>　</td>
           <td>　</td>
         </tr>
         <tr>
           <th>ショップ</th>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>△</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
           <td>　</td>
         </tr>
       </table>
   </div>
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>インストラクター</h2>
           </div>
            <?php
            $apc = new Application;
            // var_dump($ui->ID);
            $results = $apc->getUserHavePostTypeList($ui->ID, 'instructor');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="event.php?postId=<?=$value->ID?>">
                    申請できるイベント一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="studio.php?postId=<?=$value->ID?>">
                    申請できるスタジオ一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="license.php?postId=<?=$value->ID?>">
                    申請できる資格一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
    <!-- イベント -->
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>イベント</h2>
           </div>
            <?php
            $apc = new Application;
            $results = $apc->getUserHavePostTypeList($ui->ID, 'event');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="instructor.php?postId=<?=$value->ID?>">
                    申請できるインストラクター一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="studio.php?postId=<?=$value->ID?>">
                    申請できるスタジオ一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="shop.php?postId=<?=$value->ID?>">
                    申請できるショップ一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
   <!-- スタジオ -->
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>スタジオ</h2>
           </div>
            <?php
            $apc = new Application;
            $results = $apc->getUserHavePostTypeList($ui->ID, 'studio');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="instructor.php?postId=<?=$value->ID?>">
                    申請できるインストラクター一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="event.php?postId=<?=$value->ID?>">
                    申請できるイベント一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="license.php?postId=<?=$value->ID?>">
                    申請できる資格一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
   <!-- 求人 -->
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>求人</h2>
           </div>
            <?php
            $apc = new Application;
            $results = $apc->getUserHavePostTypeList($ui->ID, 'job');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="event.php?postId=<?=$value->ID?>">
                    申請できるイベントー一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="studio.php?postId=<?=$value->ID?>">
                    申請できるスタジオ一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="company.php?postId=<?=$value->ID?>">
                    申請できるCOMPANY一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="shop.php?postId=<?=$value->ID?>">
                    申請できるショップ一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
   <!-- 資格 -->
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>資格</h2>
           </div>
            <?php
            $apc = new Application;
            $results = $apc->getUserHavePostTypeList($ui->ID, 'license');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="instructor.php?postId=<?=$value->ID?>">
                    申請できるインストラクターー一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="studio.php?postId=<?=$value->ID?>">
                    申請できるスタジオ一覧へ
                    </a>
                    </div>
                    <div class='column'>
                    <a href="company.php?postId=<?=$value->ID?>">
                    申請できるCOMPANY一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
   <!-- ショップ -->
   <div class="fourteen wide column">
       <div class="ui three column grid segment">
           <div class="row">
            <h2>ショップ</h2>
           </div>
            <?php
            $apc = new Application;
            $results = $apc->getUserHavePostTypeList($ui->ID, 'shop');
           // var_dump($results);
            foreach ($results as $value) {
                // var_dump($value);
                // イベント
                    ?><div class="row" style="background:#ccc;"><?php
                   echo "<div class='column'>".$value->ID."</div>";
                   echo "<div class='column'>".$value->post_title."</div>";
                   echo "<div class='column'></div>";
                   echo "</div>";
                   echo "<div class='column'>";
                    ?>
                    <a href="event.php?postId=<?=$value->ID?>">
                    申請できるイベント一覧へ
                    </a>
                    </div>
                <?php
            }
            ?>
        </div>
   </div>
</div>
</body>
</html>
