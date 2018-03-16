<?php
namespace Manage\user\application;

//http://localhost:8000/wp-admin/
//http://localhost:8000/manage/user/application

use Manage\PayUser;
use Manage\Common;
use Manage\Application;
use Manage\Login;
use WP_User;
use Manage\WpCustomfiled;

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


$wpcf = new WpCustomfiled;
if (isset($_FILES['imgMain']) && !empty($_FILES['imgMain'])) {
    $upload = $_FILES['imgMain'];
    var_dump($_POST);
    echo "<hr />";
    var_dump($_FILES);
    echo "<hr />";
    echo "<hr />";
    // echo $_POST["postId"];
    $wpcf->addCustomImage($_POST["postId"], $upload, "imgMain");
}


$apc = new Application;
$results = $apc->getUserHavePostTypeList($ui->ID, 'instructor');
foreach ($results as $postVal) {
    $item = get_post_custom($postVal->ID);
// var_dump($item);
?>
<div class="ui stackable left aligned page grid col-md-12">
    <form class="forms" data-parsley-validate novalidate method="post" id="f<?=$postVal->ID?>"
        enctype="multipart/form-data"
    ><input type="hidden" value="<?=$postVal->ID?>" name="postId"  />
        <?php wp_nonce_field("instractor", "nonce"); ?>
        <input type="file" name="imgMain" size="30">
        <input type="submit" name="btn" >
    </form>
</div>
<?php
}

?>

</body>
</html>
