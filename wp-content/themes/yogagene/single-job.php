<?php
/*
Template Name: manage:job
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
?>

<?php require_once('community-admin/include/navigation.php'); ?>
<?php
//-------------------------------------
$wpcf = new WpCustomfiled;
$apc = new Application;
$results = $apc->getUserHavePostTypeList($ui->ID, 'studio');
// var_dump($results);
//-------------------------------------
foreach ($results as $postVal) {
    $item = get_post_custom($postVal->ID);
    // var_dump($item);
}//
?>
<section class="mypage-section">

          <form class="forms" data-parsley-validate novalidate>

            <div class="page-title">
              <div class="title_left">
                <h1>求人一覧 <small>Job</small></h1>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>登録求人一覧 <small>Job List</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="list-unstyled list-ul">
                          <li class="list-li list-table">
                            <div class="list-image list-cell">
                              <img src="/images/thumbnail-500x500.jpg" width="120" height="120">
                            </div>
                            <div class="list-title list-cell">
                              <h3>タイトルタイトル</h3>
                            </div>
                            <div class="list-address list-cell">
                              <p>〒153-0052 東京都目黒区祐天寺2-9-4 虎ノ門ビル2F</p>
                            </div>
                            <div class="list-pref list-cell">
                              <p>東京都</p>
                            </div>
                            <div class="list-btn-group list-cell">
                              <div class="form-group">
                                  <button class="btn btn-primary" type="reset">編集</button>
                                  <button type="submit" class="btn btn-default">削除</button>
                              </div>
                            </div>
                          </li>
                          <li class="list-li list-table">
                            <div class="list-image list-cell">
                              <img src="/images/thumbnail-500x500.jpg" width="120" height="120">
                            </div>
                            <div class="list-title list-cell">
                              <h3>タイトルタイトル</h3>
                            </div>
                            <div class="list-address list-cell">
                              <p>〒154-0003 東京都世田谷区野沢四丁目21番13号 KOMAZAWA STUDIO 2F</p>
                            </div>
                            <div class="list-pref list-cell">
                              <p>東京都</p>
                            </div>
                            <div class="list-btn-group list-cell">
                              <div class="form-group">
                                    <button class="btn btn-primary" type="reset">編集</button>
                                    <button type="submit" class="btn btn-default">削除</button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <?php include WORKSPACE . '/include/pagination.php'; ?>
                      </div>
                    </div>
                  </div><!-- x-content -->

                </div><!-- x-panel -->
              </div>

            </div>
          </form>

</section>
<?php get_footer("admin");
