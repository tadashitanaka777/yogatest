<?php

// namespace Manage;


// require_once('../manage/Application.php');
require_once(ABSPATH.'/vendor/autoload.php');
// require_once('../vendor/autoload.php');

// var_dump($applicationObj);
// 記事タイトルの前にIDを表示させる
function my_the_title($title, $id)
{
    return ''.$id.')'.$title;
}
add_filter('the_title', 'my_the_title', 10, 2);
function return_text()
{
    echo 'do return_text';
}
function text_ajax_test()
{
    check_ajax_referer('text_test_ajax', 'secure');
    if (isset($_REQUEST['text_test'])) {
      //ここに処理を書く
        echo  "ok";
        $text = "test";
    }
    // die();
}
add_action('wp_ajax_text_ajax_test', 'text_ajax_test');
add_action('wp_ajax_nopriv_text_ajax_test', 'text_ajax_test');
function example()
{
    global $obj;
    $obj = new Manage\Application;
    $rst = $obj->getWpApplicationPostTypeStatus(17, 29, "studio");
    if (isset($_REQUEST['text_test'])) {
      //ここに処理を書く
        $text = "testokexample";
    }
    $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
    echo  json_encode($rst);
    // echo  json_encode($arr);
    die();
}
add_action('wp_ajax_example', 'example');
// add_action('wp_ajax_nopriv_example', 'example');
function getActionPageResult()
{
    global $obj;
    $obj = new Manage\Application;
    $postId = $_GET['postId'];
    $postType = $_GET['post_type'];
    $page = $_GET['page'];
    $limit = $_GET['limit'];
    // $rst['pref']=$_GET['pref'];
    // $rst['status']=$_GET['status'];
    // $rst = $obj->getWpApplicationPostTypeStatus(17, 29, "studio");
    $rst = $obj->getPostActionListFromTo($postType, $page, $limit);
    foreach ($rst as $key => $value) {
        $arr = array();
        $arr["ID"] = $value["ID"];
        $item = get_post_custom($value["ID"]);
        $arr["imgMain"] = wp_get_attachment_image($item["imgMain"][0], array("80px",));
        $arr["studioName"] = $item["studioName"];
        $arr["postType"] =  $postType;
        $arr["postId"] =  $postId;
        $arr["status"] =  $obj->getWpApplicationPostTypeStatus($postId, $value["ID"], $postType);
        $arr["area1"] = $item["area1"];
        $result[] = $arr;
    }
    echo  json_encode($result);
    die();
}
add_action('wp_ajax_getActionPageResult', 'getActionPageResult');
// add_action('wp_footer', 'getActionPageResult');

/*管理画面のリダイレクト*/
add_action( 'admin_init', 'redirect_dashiboard' );
function redirect_dashiboard() {
    $user = wp_get_current_user();
    $umeta = get_user_meta($user->ID);
    // var_dump($umeta["wp_user_level"][0]);
    $userlevel = $umeta["wp_user_level"][0];
    if ($userlevel>2) {
        //投稿者以上は、WPの管理画面
        return null;
    }
    if ( '/wp-admin/index.php' == $_SERVER['SCRIPT_NAME'] ) {
        wp_redirect( '/mng/' );
    }
}
