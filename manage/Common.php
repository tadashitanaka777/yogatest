<?php

namespace Manage;

class Common
{
    public function __construct()
    {
    }
    /**
     * ログイン表示する。ログインしていなければ表示しない。
     * @return [type] [description]
     */
    static function showWpLoginBar()
    {
        global $ui;
        if (!is_user_logged_in()) {
            echo "ログインしてください。";

            exit;
        }
        $userinfo = wp_get_current_user();
        // $pu = new PayUser;
        // $ui = $pu->getUserPayinfo($userinfo);
        $ui = $userinfo;
        $arr = get_user_meta($ui ->ID);
        $ui->firstName = $arr['first_name'][0];
        $ui->payjpCusId = $arr['payjpCusId'][0];
        ?>
        <div class="ui segment">
            <a href="/manage/user/application/">
                申請トップへ&nbsp;
            </a>
            Wpuser
            [ID:<?=$ui->ID?>]&nbsp;
            [NAME:<?=$ui->firstName?>]&nbsp;
            でログイン&nbsp;
            <a href="/manage/user/application/submitAction.php">
            &nbsp;申請許可へ&nbsp;
            </a>
        </div>
        <?php
    }
    static function showPayjpLoginBar()
    {
        $userinfo = wp_get_current_user();
        $pu = new PayUser;
        $ui = $pu->getUserPayinfo($userinfo);
        ?>
        <div class="ui segment">
            payjpUser
            [ID:<?=$ui->ID?>]&nbsp;
            [NAME:<?=$ui->firstName?>]&nbsp;<?=$ui->userLevel?>
            でログイン&nbsp;
        </div>
        <?php
    }
    static function showSessionLoginBar($userId)
    {
        global $ui;
        ?>
        <div class="ui segment">
        <?php
        $lgn = new Login;
        //ここでのIDはWP上のマスターログインID
        $lgnlist = $lgn->getLoginPossibleList($userId);
        //切り替えログインID
        if (isset($lgnlist)) {
            ?>
            切り替え可能なユーザー一覧<br>
            <?php
            foreach ($lgnlist as $value) {
                $name = get_user_meta($value, 'first_name', true);
                // var_dump($_POST);
                ?>
                <form class="" action="" method="post">
                    <?=$value?><?=$name?>で
                    <button type="submit" name="changeLogin" value="<?=$value?>">ログイン</button>
                </form>
                <?php
            }
        }
        if (isset($_POST["changeLogin"])) {
            $sessionUserId = $_POST["changeLogin"];
            // var_dump($sessionUserId);
            $_SESSION = null;
            $obj = get_userdata($sessionUserId);
            $arr = get_user_meta($sessionUserId);
            $obj->firstName = $arr['first_name'][0];
            $obj->payjpCusId = $arr['payjpCusId'][0];
            $_SESSION["ui"]= serialize($obj);
            // var_dump($_SESSION["ui"]);
        }
        if (isset($_SESSION["ui"])) {
            $ui = unserialize($_SESSION["ui"]);
            // var_dump($ui->ID);
        }
            $userinfo = wp_get_current_user();
        // var_dump($userinfo);
        if ($userinfo->ID == $ui->ID) {
            $_SESSION["ui"] = null;
            echo "</div>";
            return null;
        }
        ?>
            切り替え中[ID:<?=$ui->ID?>]&nbsp;
            [NAME:<?=$ui->firstName?>]&nbsp;
            でログインしています&nbsp;
            <form class="" action="" method="post">
                <?=$value?><?=$name?>
                <button type="submit" name="changeLogin" value="<?=$userinfo->ID?>">切り替え終了</button>
            </form>
        </div>
        <?php
    }
}
