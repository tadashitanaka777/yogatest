<?php
/*
Template Name: manage:instructor
*/
?>
<?php
namespace Manage\user\application;

use Manage\PayUser;
use Manage\Common;
use Manage\Application;
use Manage\Login;
use WP_User;
use Manage\WpCustomfiled;
use Manage\AdvancedCustomFields;

session_start();

// echo get_home_directory();
require_once('vendor/autoload.php');
require_once("payjp-php/vendor/autoload.php");
require_once('function-admin.php'); ?>
<?php get_header("admin");?>
<?php
require_once("manage/src/header.php");
//loginのチェックと　現在のステータス
Common::showWpLoginBar();
//Sessionloginのチェックと　現在のステータス
Common::showSessionLoginBar($ui->ID);
// var_dump($ui->ID);

?>
<?php require_once('community-admin/include/navigation.php'); ?>
<?php
$wpcf = new WpCustomfiled;
/**
 * postの入力とnonceチェック
 * @var [type]
 */
if (isset($_POST['nonce'])
&& wp_verify_nonce($_POST['nonce'], 'instractor')
) {
                // var_dump($_POST["postId"]);
                // var_dump($_POST["yogastyle"]);
                // var_dump($_POST["interviewSelect"]);
                // var_dump($_POST["interviewText"]);
                $wpcf->saveCustomPost($_POST["postId"], "name", $_POST["pname"]);
                $wpcf->saveCustomPost($_POST["postId"], "instagramUrl", $_POST["instagramUrl"]);
                $wpcf->saveCustomPost($_POST["postId"], "facebookUrl", $_POST["facebookUrl"]);
                $wpcf->saveCustomPost($_POST["postId"], "twitterUrl", $_POST["twitterUrl"]);
                $wpcf->saveCustomPost($_POST["postId"], "webUrl", $_POST["webUrl"]);
                $wpcf->saveCustomPost($_POST["postId"], "email", $_POST["email"]);
                $wpcf->saveCustomPost($_POST["postId"], "area1", $_POST["area"][0]);
                $wpcf->saveCustomPost($_POST["postId"], "area2", $_POST["area"][1]);
                $wpcf->saveCustomPost($_POST["postId"], "area3", $_POST["area"][2]);
    if ($_POST["yogastyle"]) {
        $wpcf->saveCustomPosts($_POST["postId"], "yogastyle", $_POST["yogastyle"]);
    }
                $wpcf->saveCustomPost($_POST["postId"], "studioFree", $_POST["studio-free"]);
                $wpcf->saveCustomPost($_POST["postId"], "eventFree", $_POST["event-free"]);
                $wpcf->saveCustomPost($_POST["postId"], "licenseFree", $_POST["license-free"]);
                $wpcf->saveCustomPost($_POST["postId"], "profile", $_POST["profile"]);
                $wpcf->savePostStatus($_POST["postId"], $_POST["status"]);
                $wpcf = new WpCustomfiled;
                // var_dump($_FILES);
    if (isset($_FILES['imgMain']) && !empty($_FILES['imgMain'])) {
        $upload = $_FILES['imgMain'];
        $wpcf->saveCustomImage($_POST["postId"], $upload, "imgMain");
    }
    if (isset($_FILES['avatarImage']) && !empty($_FILES['avatarImage'])) {
        $upload = $_FILES['avatarImage'];
        $wpcf->saveCustomImage($_POST["postId"], $upload, "avatarImage");
    }
    if (isset($_FILES['logoImage']) && !empty($_FILES['logoImage'])) {
        $upload = $_FILES['logoImage'];
        $wpcf->saveCustomImage($_POST["postId"], $upload, "logoImage");
    }
    if (isset($_FILES['otherImage']) && !empty($_FILES['otherImage'])) {
        $wpcf->saveCustomImages($_POST["postId"], $_FILES['otherImage'], "otherImage");
    }
    if (isset($_POST['interviewSelect']) && (isset($_POST['interviewText']))) {
        /**
         * 値をグループとして保存する。AdvancedCustomFieldsでも確認できるように。
         * @var [type]
         */
        $itemArr = array();
        $itemArr["select"] = $_POST['interviewSelect'];
        $itemArr["text"] = $_POST['interviewText'];
        $wpcf->saveCustomPostsGroup($_POST["postId"], "interview", $itemArr);
    }
    //スタジオ登録
    if (isset($_POST['studioApplication'])) {
        // var_dump($_POST['studioApplication']);
        $apc = new Application;
        //applyとdeleteの時のみ実行する。
        // applying
        // success
        // null
        foreach ($_POST['studioApplication'] as $key => $value) {
            //null 未選択
            //0 申請中
            //1 承認済み
            //2 非承認
            if ($value["status"]=="apply") {
                $apc->applicationPostTypeUpdate($_POST["postId"], $key, "studio", 0);
            }
            if ($value["status"]=="delete") {
                $rst=$apc->applicationPostTypeUpdate($_POST["postId"], $key, "studio", 2);
            }
        }
    }
    //イベント登録
    if (isset($_POST['eventApplication'])) {
        // var_dump($_POST['eventApplication']);
        $apc = new Application;
        //applyとdeleteの時のみ実行する。
        // applying
        // success
        // null
        foreach ($_POST['eventApplication'] as $key => $value) {
            //null 未選択
            //0 申請中
            //1 承認済み
            //2 非承認
            if ($value["status"]=="apply") {
                $apc->applicationPostTypeUpdate($_POST["postId"], $key, "event", 0);
            }
            if ($value["status"]=="delete") {
                $rst=$apc->applicationPostTypeUpdate($_POST["postId"], $key, "event", 2);
                // var_dump($rst);
            }
        }
    }
}

            $apc = new Application;
            // var_dump($ui->ID);
            $results = $apc->getUserHavePostTypeList($ui->ID, 'instructor');
           // var_dump($results);
foreach ($results as $postVal) {
    $item = get_post_custom($postVal->ID);


    echo "<div class='column'>".$postVal->ID."</div>";?>
    <section class="mypage-section">
        <form class="forms" data-parsley-validate novalidate method="post" id="f<?=$postVal->ID?>"  enctype="multipart/form-data">
            <?php wp_nonce_field("instractor", "nonce"); ?>
            <input type="hidden" value="<?=$postVal->ID?>" name="postId"  />
            <div class="page-title">
                <div class="title_left">
                    <h1>インストラクター <small>instructor</small></h1>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="left-col">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                <div class="x_panel">
                        <div class="x_title">
                            <h2>プロフィール編集 <small>Profile Edit</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-horizontal form-label-left input_mask">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="instructor Name" name="pname" value="<?php
                                                if (isset($item)) {
                                                    echo $item["name"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="WebSite or Blog" name="webUrl" value="<?php
                                                if (isset($item)) {
                                                    echo $item["webUrl"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Facebook URL"name="facebookUrl" value="<?php
                                                if (isset($item)) {
                                                    echo $item["facebookUrl"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Twitter URL" name="twitterUrl" value="<?php
                                                if (isset($item)) {
                                                    echo $item["twitterUrl"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-twitter form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Instagram URL" name="instagramUrl" value="<?php
                                                if (isset($item)) {
                                                    echo $item["instagramUrl"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-instagram form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email"  name="email" value="<?php
                                                if (isset($item)) {
                                                    echo $item["email"][0];
                                                }
                                                    ?>">
                                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="dropWrap">
                                                <div class="dropRow">
                                                    <div class="dropCol">
                                                        <div class="dropArea">
                                                            <div class="dropFile">
                                                                <input type="file" class="fileInput" name="imgMain"  accept=".jpg,.jpeg,.png" capture="camera">
                                                            </div>
                                                            <div class="dropView portraito">
                                                                <span class="dropText">【メイン】<br>画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1600 x 960px【横長】</small></span>
                                                                <?php
                                                                /**
                                                                 * 選択画像の表示
                                                                 */
                                                                if (isset($item)) {
                                                                    $wpcf->theDropzoneBackimage($item["imgMain"][0]);

                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropCol">
                                                        <div class="dropArea">
                                                            <div class="dropFile">
                                                                <input type="file" class="fileInput" name="avatarImage" accept=".jpg,.jpeg,.png" capture="camera">
                                                            </div>
                                                            <div class="dropView avatar">
                                                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 1000px【正方形】</small></span>
                                                                <?php
                                                                /**
                                                                 * 選択画像の表示
                                                                 */
                                                                if (isset($item)) {

                                                                    $wpcf->theDropzoneBackimage($item["avatarImage"][0]);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropCol">
                                                        <div class="dropArea">
                                                            <div class="dropFile">
                                                                <input type="file" class="fileInput" name="logoImage" accept=".jpg,.jpeg,.png" capture="camera">
                                                            </div>
                                                            <div class="dropView logo">
                                                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 1000px【正方形】</small></span>
                                                                <?php
                                                                /**
                                                                 * 選択画像の表示
                                                                 */
                                                                if (isset($item)) {
                                                                    $wpcf->theDropzoneBackimage($item["logoImage"][0]);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    //可変イメージ
                                                    $otherImageArr = $wpcf->getImagesId($item["otherImage"]);
                                                    // var_dump($item["otherImage"],$otherImageArr);
                                                    if (isset($otherImageArr)) {
                                                        //数は変更可能
                                                        for ($i=0; $i < 6; $i++) {
                                                            $value = null;

                                                            if (isset($otherImageArr[$i])) {
                                                                $value = $otherImageArr[$i];
                                                            }
                                                                ?>
                                                                <div class="dropCol">
                                                                    <div class="dropArea">
                                                                        <div class="dropFile">
                                                                            <input type="file" class="fileInput" name="otherImage[]" accept=".jpg,.jpeg,.png" capture="camera">
                                                                        </div>
                                                                        <div class="dropView portraito">
                                                                            <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 600px【横長】</small></span>
                                                                            <?php
                                                                            /**
                                                                            * 選択画像の表示
                                                                            */
                                                                            if (isset($item)) {
                                                                                // $wpcf->theDropzoneBackimage($item["avatarImage"][0]);

                                                                                $wpcf->theDropzoneBackimage($value);
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                    }

                                                    ?>
                                                </div>
                                            </div>                                </div>



                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>プロフィール</h4>
                                    <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="profile" rows="10" placeholder="あなたの経歴や受賞歴などをご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"><?php
                                    if (isset($item)) {
                                        echo $item["profile"][0];
                                    }
                                        ?></textarea>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 mb-pc-20">
                                    <h4>活動エリア</h4>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect($item["area1"][0]); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 col-xs-12 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect($item["area2"][0]); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 col-xs-12 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect($item["area3"][0]); ?>
                                                </select>
                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h4>ヨガのスタイル</h4>
                                                <div id="style-list" class="list-js">
                                                    <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-8">
                                                <input type="text" class="search form-control" placeholder="絞り込み" />
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                <button class="btn btn-default btn-block sort" data-sort="style-name">ソート</button>
                                            </div>
                                                    </div>
                                                    <ul class="list list-group">
                                                    <?php
                                                    $array = $cdClass->styleArray();//array(1,2)
                                                    $i = 0;
                                                    foreach ($array as $key => $value) :
                                                    ?>
                                                    <li>
                                                        <div class="md-checkbox">
                                                        <input id="md-<?php echo $i; ?>" type="checkbox" value="<?php echo $key; ?>" name="yogastyle[]"
                                                         <?=$wpcf->showCheckedItems($item["yogastyle"], $key)?>><label for="md-<?php echo $i; ?>"></label>
                                                        </div>
                                                                <p class="style-name"><?php echo $value[0]; ?> <small><?php echo $value[1]; ?></small></p>
                                                                </li>
                                                                <?php
                                                                $i++;
                                                    endforeach;
                                                    ?>
                                                    </ul>
                                                    <ul class="pagination"></ul>
                                                </div>
                                            </div>
                                                    </div>
                                                </div><!-- x-content -->

                                            </div><!-- x-panel -->

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>インタビュー<small>Interview</small></h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                            <li>
                                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row interview-add">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>


                                            <?php

                                            $variable= array(1,2,3);
                                            $length = count($variable);
                                            if (isset($item["interview"])) {
                                                $length= $item["interview"];
                                            }
                                            $cnt = 0;
                                            foreach ($variable as $key => $value) {
                                                $i = $cnt++;
                                                // var_dump($length);
                                                if ($cnt < $length) {
                                                    // var_dump($cnt);
                                                ?>
                                                <tr>
                                                    <td class="td-question">
                                                    <?php
                                                    // echo $item["interview"][$key];
                                                    $interviewSelect = $key+1;
                                                    $interviewText = "";
                                                    if (isset($item["interview"])) {
                                                        $rstArr = explode(",", $item["interview"][$key]);
                                                        $interviewSelect = $item["interview"."_".$i."_Group_select"][0];
                                                        $interviewText = $item["interview"."_".$i."_Group_text"][0];
                                                    }
                                                        ?>
                                                    <select class="form-control" name="interviewSelect[]">
                                                        <?php echo $cdClass->interviewSelect($interviewSelect);?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入" name="interviewText[]"><?php
                                                        echo  urldecode($interviewText);
                                                            ?></textarea>
                                                    </td>
                                                    <td class="td-button">
                                                        <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                if ($cnt == $length) {
                                                    // var_dump($cnt);

                                                    ?>
                                                    <tr class="tr-add-row">
                                                    <td class="td-question">
                                                    <select class="form-control" name="interviewSelect[]">
                                                        <?php echo $cdClass->interviewSelect($key+1);?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入" name="interviewText[]"></textarea>
                                                    </td>
                                                    <td class="td-button">
                                                        <button class="btn btn-default btn-circle btn-plug-row">＋</button>
                                                        <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                    </td>
                                                    </tr>
                                                <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   }//if
                                            }//foreach
                                                        ?>
                                                                </tbody>
                                                            </table>
                                                            <script>
                                                            <!--
                                                                $(function(){
                                                        var tr;
                                                        var element = $('.interview-add');
                                                        element.find('.btn-add-row').on('click',function(){
                                                            tr = element.find('.tr-add-row').clone(true);
                                                            $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                                            tr.fadeIn(500).removeClass('tr-add-row');
                                                            _texrareaAutoHeight();
                                                            _checkRowNumber(element,5);
                                                            return false;
                                                        });
                                                        element.find('.btn-plug-row').on('click',function(){
                                                            tr = element.find('.tr-add-row').clone(true);
                                                            $(this).closest('tr').before(tr);
                                                            tr.fadeIn(500).removeClass('tr-add-row');
                                                            _texrareaAutoHeight();
                                                            _checkRowNumber(element,5);
                                                            return false;
                                                        });
                                                        element.find('.btn-remove-row').on('click',function(){
                                                            tr = $(this).closest('tr');
                                                            tr.fadeOut(500,function(){
                                                                tr.remove();
                                                                _checkRowNumber(element,5);
                                                            });
                                                            return false;
                                                        });
                                                                });
                                                            -->
                                                            </script>
                                                            <button class="btn btn-default btn-add-row">質問を追加</button>
                                                        </div>
                                                    </div>
                                                </div><!-- /x-content -->
                                            </div>

                                        </div>
                </div><!-- col-left -->
                <div class="col-right">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>所属スタジオ<small>Studio</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4>登録スタジオ</h4>
                                            <div id="studio-list" class="list-js">
                                                <ul class="list list-group">
                                                    <div class="ui four column grid">
                                                        <?php
                                                     // $apc = new Application;
                                                        $arrStudio =$apc->getPost($ui->ID, $postVal->ID);
                                                        // var_dump($arrStudio->ID,$postVal->ID,$arrStudio->post_title);
                                                        ?>
                                                        <?php
                                                        $results = $apc->getPostTypeList("studio");
                                                        foreach ($results as $apcval) {
                                                            // ◎自分自身への申請のみ表示する。
                                                             // $isShow = $apc->isOwnPostTypeList(
                                                             //     $ui->ID,
                                                             //     $apcval->post_author,
                                                             //     $arrStudio->post_type,
                                                             //     "studio"
                                                             // );
                                                             // if (!$isShow) {
                                                             //     continue;
                                                             // }
                                                            //---------------------
                                                            ?>
                                                            <?php //申請の状況の取得
                                                               //3 承認済み
                                                               //2 申請中
                                                               //1 未選択
                                                               $studioStatus = null;
                                                               $studioStatus = $apc->getWpApplicationPostTypeStatus($arrStudio->ID, $apcval->ID, "studio");
                                                               //未選択は表示しない
                                                            if ($studioStatus == 2) {
                                                                continue;
                                                            }
                                                                ?>
                                                               <li>
                                                                <?php
                                                                echo '<span class="shop-name">'.$apcval->ID.$apcval->post_title.'</span><span class="pref-name">東京都</span>';
                                                            ?>
                                                           <select class="form-control case" name="studioApplication[<?=$apcval->ID?>][status]">
                                                            <?php
                                                           //3 承認済み
                                                           //2 申請中
                                                           //1 未選択
                                                            foreach ($dataClass->getValues($studioStatus) as $key => $value) : ?>
                                                                            <option  value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach; ?>
                                                           </select>
                                                           <input type="hidden" name="studioApplication[<?=$apcval->ID?>][applicationPostId]" value="<?=$arrStudio->ID?>">
                                                       </li><?php
                                                        }//foreach
                                                        ?>

                                                    </div>
                                                </ul>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-studio-modal-lg">スタジオ追加</button>
                                                </div>
                                                <?php include(get_template_directory().'/include/modal-studio.php'); ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4>登録スタジオがない場合</h4>
                                        <textarea id="studio-free" class="form-control resize-vertical mb-pc-20" name="studio-free" rows="10" placeholder="スタジオの登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"><?php
                                        if (isset($item)) {
                                            echo $item["studioFree"][0];
                                        }
                                ?></textarea>
                        </div>
                                </div>

                            </div>
                        </div>
                                </div><!-- /x-content -->
                            </div>
                            <div class="x_panel">
                                <div class="x_title">
                        <h2>資格<small>License</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>登録資格</h4>

                                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <textarea id="license-free" class="form-control resize-vertical mb-pc-20" name="license-free" rows="10" placeholder="お持ちの資格ご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"><?php
                            if (isset($item)) {
                                echo $item["licenseFree"][0];
                            }
                                ?></textarea>
                        </div>
                                </div>
                            </div>
                        </div>
                                </div><!-- /x-content -->
                            </div>

                            <div class="x_panel">
                                <div class="x_title">
                        <h2>参加イベント<small>Event</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>開催イベント</h4>
                                <div id="event-list" class="list-js">
                        <ul class="list list-group">
                            <!-- <li>
                                <time class="event-date">2017年10月09日（月）</time>
                                <span class="event-name">dusk</span><span class="event-pref-name">東京都</span>
                                <select class="form-control case">
                                <?php foreach ($dataClass->getValues(3) as $key => $value) : ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" class="data-id" value="01">
                                        </li> -->
                                        <?php
                                        $results = $apc->getPostTypeList("event");
                                        // var_dump($results);
                                        foreach ($results as $apcval) {
                                            ?>
                                            <?php //申請の状況の取得
                                               //3 承認済み
                                               //2 申請中
                                               //1 未選択
                                               $eventStatus = null;
                                               $eventStatus = $apc->getWpApplicationPostTypeStatus($postVal->ID, $apcval->ID, "event");
                                               //未選択は表示しない
                                               // exit;
                                            if ($eventStatus == 2) {
                                                continue;
                                            }
                                                ?>
                                               <li>
                                                <?php
                                                // var_dump($eventStatus,$postVal->ID,$apcval->ID);
                                                echo '<time class="event-date">2017年10月09日（月）</time>
                                                <span class="event-name">dusk'.$apcval->ID.$apcval->post_title.'dd</span><span class="event-pref-name">東京都</span>';
                                            ?>
                                           <select class="form-control case" name="eventApplication[<?=$apcval->ID?>][status]">
                                            <?php
                                           //3 承認済み
                                           //2 申請中
                                           //1 未選択
                                            foreach ($dataClass->getValues($eventStatus) as $key => $value) : ?>
                                                            <option  value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach; ?>
                                           </select>
                                           <input type="hidden" name="eventApplication[<?=$apcval->ID?>][applicationPostId]" value="<?=$arrStudio->ID?>">
                                       </li><?php
                                        }//foreach
                                        ?>
                                    </ul>
                                            </div>
                                            <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-event-modal-lg">イベント追加</button>
                                    </div>
                                    <?php include(WORKSPACE . '/include/modal-event.php'); ?>
                                            </div>
                                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4>登録イベントがない場合</h4>
                                        <textarea id="event-free" class="form-control resize-vertical mb-pc-20" name="event-free" rows="10" placeholder="イベントの登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"><?php
                                        if (isset($item)) {
                                            echo $item["eventFree"][0];
                                        }
                                            ?></textarea>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /x-content -->
                            </div>
                        </div>

                    </div><!-- col-right -->
                    <div class="col-footer">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="ln_solid"></div>
                                <div class="form-group text-center">
                                    <div class="col-md-2 col-md-offset-4 col-sm-3 col-sm-offset-3 col-xs-6">
                                        <select class="form-control" name="status">

                                            <?php
                                            // var_dump($postVal->post_status);
                                                ?>
                                            <option value="publish"
                                            <?=$wpcf->showSelectedPostStatus($postVal->post_status, "publish")?>
                                            >公開</option>
                                            <option value="private"
                                            <?=$wpcf->showSelectedPostStatus($postVal->post_status, "private")?>
                                            >非公開</option>
                                            <option value="trash">削除</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-6">
                                        <button type="submit" class="btn btn-success btn-block">実行</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col-footer -->
                </div>
            </form>
        </section>
                <?php
                break;
}//foreach
            ?>


<?php get_footer("admin");
