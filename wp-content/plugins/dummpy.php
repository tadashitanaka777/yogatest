<?php
/*
Plugin Name: Hello Dummy
Description: Dummy Plugin For WordPress.
Version: 1.0.0
*/

/* Hello Dumy メイン処理 */
function print_dummy() {
	echo "Hello Dummy!";
}

/* アクションフック登録処理 */
add_action('wp_footer' ,'print_dummy');

?>
