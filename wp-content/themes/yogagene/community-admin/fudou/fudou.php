<?php
/*
Plugin Name: Fudousan Plugin
Plugin URI: http://nendeb.jp/
Description: Fudousan Plugin for Real Estate
Version: 1.8.2
Author: nendeb
Author URI: http://nendeb.jp/
License: GPLv2 or later
*/

// Define current version constant
define( 'FUDOU_VERSION', '1.8.2' );


/*  Copyright 2017 nendeb (email : nendeb@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( !defined('WP_CONTENT_URL') ) define( 'WP_CONTENT_URL', get_option('siteurl').'/wp-content' );
if ( !defined('WP_CONTENT_DIR') ) define( 'WP_CONTENT_DIR', ABSPATH.'wp-content' );
if ( !defined('WP_PLUGIN_URL') )  define( 'WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins' );
if ( !defined('WP_PLUGIN_DIR') )  define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins' );

//SSL 1:使用可能 0:使用不可
if ( !defined('FUDOU_SSL_MODE') ) define( 'FUDOU_SSL_MODE', 1 );
//物件画像数
if ( !defined('FUDOU_IMG_MAX') )  define( 'FUDOU_IMG_MAX', 30 );
//物件トラックバック・コメント 1:使用可能 0:使用不可
if ( !defined('FUDOU_TRA_COMMENT' ) )  define( 'FUDOU_TRA_COMMENT', 0 );
//メディアアップロードタイプ
if ( !defined('FUDOU_MEDIA_UPLOAD') ) define( 'FUDOU_MEDIA_UPLOAD', 0 );


/**
 * admin.
 */
require_once 'data/fudo-configdatabase.php';
require_once 'data/work-fudo.php';
require_once 'admin/fudo-functions.php';
require_once 'admin/admin_fudou.php';
require_once 'admin/admin_fudou2.php';

/**
 * widget.
 */
require_once 'widget/fudo-widget.php';
require_once 'widget/fudo-widget2.php';
require_once 'widget/fudo-widget3.php';
require_once 'widget/fudo-widget4.php';

/**
 * Incrude hack.
 */
require_once 'inc/inc-page-jyoken.php';

/**
 * Fudou custom post embed. 
 */
require_once 'oembed/oembed.php';

/**
 * Structured Data . 
 */
require_once 'inc/template-tags.php';


remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
/*
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_enqueue_scripts', 1); 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 
remove_action('wp_head', 'feed_links_extra',3,0); 
remove_action('wp_head', 'index_rel_link'); 
remove_action('wp_head', 'parent_post_rel_link'); 
remove_action('wp_head', 'start_post_rel_link'); 
remove_action('wp_head', 'rel_canonical'); 
*/


/*
 * xml-rpc機能を無効
*/
//add_filter( 'xmlrpc_methods' , function( $methods ) { unset( $methods['pingback.ping'] ); return $methods; });


/* 非推奨関数のエラーを書き出さなくする */
/** 
 * Filter whether to trigger an error for _doing_it_wrong() calls. 
 * 
 * @since 3.1.0 
 * 
 * @param bool $trigger Whether to trigger the error for _doing_it_wrong() calls. Default true. 
 */ 
//add_action( 'doing_it_wrong_trigger_error', '__return_false' );

/** 
 * Filter whether to trigger an error for deprecated files. 
 * 
 * @since 2.5.0 
 * 
 * @param bool $trigger Whether to trigger the error for deprecated files. Default true. 
 */ 
//add_filter( 'deprecated_file_trigger_error', '__return_false' ); 

/*
 * Cancel to  Marks a constructor as deprecated and informs when it has been used.
 * PHP4 style constructor method that is deprecated.
 * @since 4.3.0
*/
//add_filter( 'deprecated_constructor_trigger_error', '__return_false' );

/**
 * Cancel to function as deprecated and inform when it has been used.
 *
 * There is a hook deprecated_function_run that will be called that can be used
 * to get the backtrace up to what file and function called the deprecated
 */
//add_filter( 'deprecated_function_trigger_error', '__return_false' );



//rss 会員
remove_filter('do_feed_rdf', 'do_feed_rdf', 10);
remove_filter('do_feed_rss', 'do_feed_rss', 10);
remove_filter('do_feed_rss2', 'do_feed_rss2', 10);
remove_filter('do_feed_atom', 'do_feed_atom', 10);

//rss 会員
function custom_feed_rdf_fudou() {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rdf.php';
	load_template( $template_file );
}
add_action('do_feed_rdf', 'custom_feed_rdf_fudou', 10, 1);

function custom_feed_rss_fudou() {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rss.php';
	load_template( $template_file );
}
add_action('do_feed_rss', 'custom_feed_rss_fudou', 10, 1);

function custom_feed_rss2_fudou( $for_comments ) {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rss2' . ( $for_comments ? '-comments' : '' ) . '.php';
	load_template( $template_file );
}
add_action('do_feed_rss2', 'custom_feed_rss2_fudou', 10, 1);

function custom_feed_atom_fudou( $for_comments ) {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-atom' . ( $for_comments ? '-comments' : '' ) . '.php';
	load_template( $template_file );
}
add_action('do_feed_atom', 'custom_feed_atom_fudou', 10, 1); 

//RSS フィード
function rss_get_posts_fudou( $query ) {
	if ( is_feed() ) {
		$query->set( 'post_type', array( 'post', 'fudo' ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'rss_get_posts_fudou' );


/*
 * 不動産プラグイン(本体)をシリーズ内で最初に読み込むようにする。
 * @since Fudousan Plugin 1.5.0
*/
function fudou_plugin_first_load() {

	$this_plugin = 'fudou/fudou.php';
	$active_plugins = get_option('active_plugins');
	$new_active_plugins = array();

	$insert = 0;
	foreach ( $active_plugins as $plugins ) {
		if( $plugins != $this_plugin ){
			if( strpos( $plugins , 'fudou' ) !== false && $insert == 0 ){
				$new_active_plugins[] = $this_plugin;
				$insert = 1;
			}
			$new_active_plugins[] = $plugins;
		}else{
			if( $insert == 0 ){
				$new_active_plugins[] = $this_plugin;
				$insert = 1;
			}
		}
	}
	if( !empty( $new_active_plugins ) ){
		update_option( 'active_plugins' ,  $new_active_plugins );
	}
}
add_action( "activated_plugin", "fudou_plugin_first_load" );


/*
 * 不動産プラグインデーターベース設定
 * @since Fudousan Plugin 1.0.0
*/
function init_data_tables_fudou() {
	//データーベース設定
	databaseinstallation_fudo(0);
}
register_activation_hook(__FILE__,'init_data_tables_fudou');

/*
 * 不動産プラグインデーターベース他 チェック
 * @since Fudousan Plugin 1.5.3
*/
function databaseinstallation_warnings_fudou() {

	global $wpdb;

	//データーベース チェック
	$table_name1 = $wpdb->prefix . DB_KEN_TABLE;
	$table_name2 = $wpdb->prefix . DB_SHIKU_TABLE;
	$table_name3 = $wpdb->prefix . DB_ROSENKEN_TABLE;
	$table_name4 = $wpdb->prefix . DB_ROSEN_TABLE;
	$table_name5 = $wpdb->prefix . DB_EKI_TABLE;

	$results1 = $wpdb->get_var("show tables like '$table_name1'") ;
	$results2 = $wpdb->get_var("show tables like '$table_name2'") ;
	$results3 = $wpdb->get_var("show tables like '$table_name3'") ;
	$results4 = $wpdb->get_var("show tables like '$table_name4'") ;
	$results5 = $wpdb->get_var("show tables like '$table_name5'") ;

	if( empty($results1) || empty($results2) || empty($results3) || empty($results4) || empty($results5) ){
		function databaseinstallation_notices_main() {
			echo '<div class="error" style="text-align: center;"><p>データベースを登録できませんでした。サーバーに問題があるのかも知れません。[Fudousan Plugin]</p></div>';
		}
		add_action('admin_notices', 'databaseinstallation_notices_main');
	}



	// ダッシュボードウィジェット
	add_action('wp_dashboard_setup', 'fudo_add_dashboard_widgets' );	//物件数表示
	add_action('wp_dashboard_setup', 'fudodl_add_dashboard_widgets' );	//不動産プラグイン案内



	//マルチサイト
	if ( is_multisite() ) {
		function multi_site_notices() {
			echo '<div class="error" style="text-align: center;"><p>マルチサイトでは利用できません。</p></div>';
		}
		add_action('admin_notices', 'multi_site_notices');
	}



	//パーマリンクチェック
	$permalink_structure = get_option('permalink_structure');
	if ( $permalink_structure != '' ) {

		//パーマリンクチェック < Ver1.5.3
		$permalink_err = false;
		if ( defined('FUDOU_HISTORY_VERSION') ) {	if ( version_compare( FUDOU_HISTORY_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_MAP_VERSION') ) {		if ( version_compare( FUDOU_MAP_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_MAIL_VERSION') ) {		if ( version_compare( FUDOU_MAIL_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_KTAI_VERSION') ) {		if ( version_compare( FUDOU_KTAI_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_OGP_VERSION') ) {		if ( version_compare( FUDOU_OGP_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		//if ( defined('FUDOU_WT_VERSION') ) {		if ( version_compare( FUDOU_WT_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }

		if( $permalink_err ){
			add_action('admin_notices', 'fudou_permalink_notices');

			function fudou_permalink_notices() {
				echo '<div class="notice notice-warning is-dismissible"><p>パーマリンクは「基本」にしてください。　<a href="options-permalink.php">パーマリンク設定</a></p></div>';
			}
		}else{

			//パーマリンク「投稿名」チェック Ver1.5.3～
			$pos = strpos( $permalink_structure, 'postname' );
			if( $pos !== false ){

				$permalink_message_disable = get_option( 'permalink_message_disable' ); 
				if( !$permalink_message_disable ){

					$post_permalink_message_disable = isset($_POST['permalink_message_disable']) ? myIsNum_f($_POST['permalink_message_disable']) : ''; 
					if( $post_permalink_message_disable ){
						check_admin_referer('permalink_message_disable');
						update_option( 'permalink_message_disable', '1' );
					}else{
						add_action( 'admin_notices', 'fudou_permalink_notices2' );
					}
				}

			}
			function fudou_permalink_notices2() {

				printf( '
					<div id="permalink_message" class="notice notice-warning">
						<p>
							<form class="permalink_message_disable" name="permalink_message_disable" method="post" action="">
							<input type="hidden" name="permalink_message_disable" value="1" />
							<strong>パーマリンクの設定が「投稿名」を使うように設定されています。</strong>
							<br />パーマリンクの「投稿名」は非推奨です。「基本」又は「数字ベース」を使用してください。　<a href="%1$s">パーマリンク設定</a>　%2$s %3$s
							</form>
						</p>
					</div>',
					esc_url( admin_url( 'options-permalink.php' ) ) ,
					'<input type="submit" name="submit" id="submit" class="button-primary" value="パーマリンクを変更せずに この表示を非表示にする"  />',
					wp_nonce_field('permalink_message_disable') 
				);
			}
		}
	}



	//アップロードしたファイルを年月ベースのフォルダに整理 チェック
	$stored_value = get_option("uploads_use_yearmonth_folders");
	if( $stored_value ){

		$img_count = 0;
		$sql  = "SELECT count(DISTINCT P.ID) AS co";
		$sql .=" FROM $wpdb->posts AS P";
		$sql .=" WHERE P.post_type ='attachment'";
		//$sql = $wpdb->prepare($sql,'');
		$meta = $wpdb->get_row( $sql );
		if( !empty($meta) ){
			$img_count = $meta->co;
		}
		//画像が登録されていない場合だけ
		if( !$img_count ){
			add_action( 'admin_notices', 'fudou_uploads_yearmonth_notices' );
		}

		function fudou_uploads_yearmonth_notices() {
			printf( '
				<div id="permalink_message" class="notice notice-warning">
					<p>
						<strong>メディア設定「アップロードしたファイルを年月ベースのフォルダに整理」の チェックを外してください。</strong>
						　<a href="%1$s">不動産プラグイン設定(基本設定)->メディア設定 </a>
					</p>
				</div>',
				esc_url( admin_url( 'options-general.php?page=fudou/admin/admin_fudou.php' ) ) 
			);
		}
	}
}
add_action('admin_init', 'databaseinstallation_warnings_fudou');


/*
 * 不動産プラグインシリーズ 環境 チェック
 * @since Fudousan Plugin 1.7.6
*/
function fudou_version_check_warnings() {

	//不動産プラグインバージョンチェック
	global $fudou_version_check_err;
	if ( defined( 'FUDOU_CHOUMEI_VERSION' ) ) {	if ( version_compare( FUDOU_CHOUMEI_VERSION , '1.0.6', '<') ) 	{ $fudou_version_check_err .= ' 不動産町名検索プラグイン を ver1.0.6以降 にバージョンアップしてください。(現在:'	. FUDOU_CHOUMEI_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_KOUKU_VERSION' ) ) {	if ( version_compare( FUDOU_KOUKU_VERSION , '1.0.6', '<') ) 	{ $fudou_version_check_err .= ' 不動産校区プラグインを ver1.0.6以降 にバージョンアップしてください。(現在:'		. FUDOU_KOUKU_VERSION . ')<br />' ; } }

	function fudou_version_check_err_notices() {
		global $fudou_version_check_err;
		echo '<div class="error"><p>不動産プラグインを利用するには、以下の不動産プラグインシリーズをバージョンアップしてください。<br />' . $fudou_version_check_err . '</p></div>';
	}
	if( $fudou_version_check_err ){
		add_action( 'admin_notices', 'fudou_version_check_err_notices' );
	}

}
add_action('admin_init', 'fudou_version_check_warnings' );




/*
 * WordPress Coreバージョン チェック
 * @since Fudousan Plugin 1.7.11
*/
function fudou_wp_version_check_warnings() {

	global $wp_version;

	function fudou_wp_version_check_err_notices( $wp_version ) {
		global $wp_version;
		echo '<div class="error"><p>不動産プラグインを利用するには、WordPressをバージョンアップしてください。現在：' . $wp_version . '</p></div>';
	}
	if ( version_compare( $wp_version, '4.4', '<' ) ) {
		add_action( 'admin_notices', 'fudou_wp_version_check_err_notices' );
	}
}
add_action('admin_init', 'fudou_wp_version_check_warnings' );





/**
 *
 * 不動産プラグインチェック
 *
 * @since Fudousan Plugin 1.7.15
 */
function fudou_active_plugins_check(){
	global $is_fudou,$is_fudouktai,$is_fudoumap,$is_fudoukaiin,$is_fudoumail,$is_fudourains,$is_fudoucsv,$is_fudouapaman,$is_fudouhistory,$is_fudoutopslider;
	global $is_fudourains_nishi,$is_fudourains_chubu;
	global $is_fudouogptwittercards,$is_fudoutweetoldpost,$is_fudoutootoldpost,$is_fudoubus,$fudou_share_bottons;
	global $is_fudoucsv_c21,$is_fudoucsv_homes,$is_fudoudatabase,$is_fudourains_higashi;
	global $is_fudoukouku,$is_fudouamp,$is_fudouchoumei,$is_wptouch;
	global $is_fudoubukkenkanrisha,$is_fudoukaiin_vip;

	$is_wp_multibyte_patch =false;

	$fudo_active_plugins = get_option('active_plugins');
	if(is_array($fudo_active_plugins)) {
		foreach($fudo_active_plugins as $meta_box){
			if( $meta_box == 'fudou/fudou.php')			$is_fudou=true;
			if( $meta_box == 'fudouamp/fudouamp.php')		$is_fudouamp=true;
			if( $meta_box == 'fudoubus/fudoubus.php')		$is_fudoubus=true;
			if( $meta_box == 'fudouchoumei/fudouchoumei.php')	$is_fudouchoumei=true;
			if( $meta_box == 'fudoucsv/fudoucsv.php')		$is_fudoucsv=true;
			if( $meta_box == 'fudouapaman/fudouapaman.php')		$is_fudouapaman=true;
			if( $meta_box == 'fudoucsv_c21/fudoucsv_c21.php')	$is_fudoucsv_c21=true;
			if( $meta_box == 'fudoucsv_homes/fudoucsv_homes.php')	$is_fudoucsv_homes=true;
			if( $meta_box == 'fudoudatabase/fudoudatabase.php')	$is_fudoudatabase=true;
			if( $meta_box == 'fudouhistory/fudouhistory.php')	$is_fudouhistory=true;
			if( $meta_box == 'fudoukaiin/fudoukaiin.php')		$is_fudoukaiin=true;
			if( $meta_box == 'fudoukouku/fudoukouku.php')		$is_fudoukouku=true;
			if( $meta_box == 'fudouktai/fudouktai.php')		$is_fudouktai=true;
			if( $meta_box == 'fudoumail/fudoumail.php')		$is_fudoumail=true;
			if( $meta_box == 'fudoumap/fudoumap.php')		$is_fudoumap=true;
			if( $meta_box == 'fudou-ogp-twittercards/fudou-ogp-twittercards.php') $is_fudouogptwittercards=true;
			if( $meta_box == 'fudourains_chubu/fudourains_chubu.php')		$is_fudourains_chubu=true;
			if( $meta_box == 'fudourains_higashi/fudourains_higashi.php')		$is_fudourains_higashi=true;
			if( $meta_box == 'fudourains_kinki/fudourains.php')			$is_fudourains=true;
			if( $meta_box == 'fudourains_nishi/fudourains_nishi.php')		$is_fudourains_nishi=true;
			if( $meta_box == 'fudou-share-bottons/fudou-share-bottons.php')		$is_fudou_share_bottons=true;
			if( $meta_box == 'fudoutopslider/fudoutopslider.php')			$is_fudoutopslider=true;
			if( $meta_box == 'fudou-tweet-old-post/tweet-old-post.php')		$is_fudoutweetoldpost=true;
			if( $meta_box == 'fudou-toot-old-post/toot-old-post.php')		$is_fudoutootoldpost=true;
			if( $meta_box == 'wptouch/wptouch.php')					$is_wptouch=true;
			if( $meta_box == 'fudoubukkenkanrisha/fudoubukkenkanrisha.php')		$is_fudoubukkenkanrisha=true;
			if( $meta_box == 'fudoukaiin_vip/fudoukaiin_vip.php')			$is_fudoukaiin_vip=true;

			if( $meta_box == 'wp-multibyte-patch/wp-multibyte-patch.php')		$is_wp_multibyte_patch=true;
		}
	}

	//WP Multibyte Patchチェック
	if( !$is_wp_multibyte_patch ){
		add_action('admin_notices', 'fudou_wp_multibyte_patch_notices');
	}
	function fudou_wp_multibyte_patch_notices() {
		echo '<div class="error notice is-dismissible visibility-notice"><p>「WP Multibyte Patch」プラグインを有効化してください。　<a href="' .  esc_url( admin_url( 'plugins.php' ) ) . '">プラグイン設定</a></p></div>';
	}
}
add_action('init', 'fudou_active_plugins_check');









/**
 *
 * SSL利用時に add thickbox
 *
 * @since Fudousan Plugin 1.5.2
 */
function fudou_active_thickbox(){
	global $is_iphone;
	$fudou_ssl_site_url = get_option('fudou_ssl_site_url');
	if( !wp_is_mobile() && $fudou_ssl_site_url !='' ){
		if (function_exists('add_thickbox')) add_thickbox();
	}
}
add_action( 'init', 'fudou_active_thickbox' );


/**
 * TwentyFifteen
 * 不動産閲覧履歴プラグイン CSS キャンセル
 * 不動産トップスライダープラグイン CSS キャンセル
 *
 * @since Fudousan Plugin 1.7.8
 * TwentyFifteen TwentySixteen TwentySeventeen
 */
function fudou_twentyfifteen_remove_css(){
	// theme check
	if ( function_exists('wp_get_theme') ) {
		$theme_ob = wp_get_theme();
		$template_name = $theme_ob->template;
	}else{
		$template_name = get_option('template');
	}
	if( $template_name == 'twentyfifteen' ||  $template_name == 'twentysixteen' ||  $template_name == 'twentyseventeen'){
		//不動産閲覧履歴プラグイン の CSS を読み込まなくする (v1.5.0 ～)
		remove_action( 'wp_enqueue_scripts', 'add_header_history_css_fudou', 12 );

		//不動産トップスライダープラグインの CSS を読み込まなくする (v1.5.0 ～)
		remove_action( 'wp_enqueue_scripts', 'add_header_topslider_css_fudou', 12 );
	}
}
add_action( 'init', 'fudou_twentyfifteen_remove_css' );



/**
 *
 * 物件詳細テンプレート切替
 *
 * @since Fudousan Plugin 1.7.8
 * @param  $template
 * @return $template
 */
function get_post_type_single_template_fudou($template = '') {

	if ( !is_multisite() ) {

		global $wp_query;
		$object = $wp_query->get_queried_object();

		if( !empty( $object->post_type ) ){

			if($object->post_type == 'fudo'){
				// theme check
				if ( function_exists('wp_get_theme') ) {
					$theme_ob = wp_get_theme();
					$template_name = $theme_ob->template;
				}else{
					$template_name = get_option('template');
				}

				switch ( $template_name ) {
					case "twentyseventeen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2017.php', 'single-fudo.php'));
						break;
					case "twentysixteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2016.php', 'single-fudo.php'));
						break;
					case "twentyfifteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2015.php', 'single-fudo.php'));
						break;
					case "twentyfourteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2014.php', 'single-fudo.php'));
						break;
					default:
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo.php', 'single-fudo.php'));
						break;
				}
			}
		}
	}
	return $template;
}
add_filter('template_include', 'get_post_type_single_template_fudou');


/**
 *
 * 物件リストテンプレート切替
 *
 * @since Fudousan Plugin 1.7.8
 * @param  $template
 * @return $template
 */
function fudo_body_archiveclass($class) {
	$class[0] = 'archive archive-fudo';
	return $class;
}
function get_post_type_archive_template_fudou($template = '') {
	if ( !is_multisite() ) {

		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$cat_name = isset( $cat->taxonomy ) ? $cat->taxonomy : '';

		if ( isset( $_GET['bukken'] ) || isset( $_GET['bukken_tag'] ) 
			|| $cat_name == 'bukken' || $cat_name =='bukken_tag' ) {

			status_header( 200 );

			// theme check
			if ( function_exists('wp_get_theme') ) {
				$theme_ob = wp_get_theme();
				$template_name = $theme_ob->template;
			}else{
				$template_name = get_option('template');
			}

			switch ( $template_name ) {
				case "twentyseventeen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2017.php', 'archive.php'));
					break;
				case "twentysixteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2016.php', 'archive.php'));
					break;
				case "twentyfifteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2015.php', 'archive.php'));
					break;
				case "twentyfourteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2014.php', 'archive.php'));
					break;
				default:
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo.php', 'archive.php'));
					break;
			}
			add_filter( 'body_class', 'fudo_body_archiveclass' );
		}
	}
	return $template;
}
add_filter( 'template_include', 'get_post_type_archive_template_fudou', 11 );


/**
 *
 * テーマ別 ヘッダーに jsや CSSを 追加
 *
 * @since Fudousan Plugin 1.7.8
 */
function add_header_css_js_fudou() {
	if ( !is_multisite() && !is_admin() ) {

		$plugin_url = plugin_dir_url( __FILE__ );

		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}

		switch ( $template_name ) {
			case "twentyten" :
				wp_enqueue_style( 'twentyten-style2010', $plugin_url .'themes/style2010.css' );
				wp_enqueue_style( 'twentyten-corners2010', $plugin_url .'themes/corners2010.css' );
				break;
			case "twentyeleven" :
				wp_enqueue_style( 'twentyeleven-style2011', $plugin_url .'themes/style2011.css' );
				wp_enqueue_style( 'twentyeleven-corners2011', $plugin_url .'themes/corners2011.css' );
				break;
			case "twentytwelve" :
				wp_enqueue_style( 'twentytwelve-style2012', $plugin_url .'themes/style2012.css' );
				wp_enqueue_style( 'twentytwelve-corners2012', $plugin_url .'themes/corners2012.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;
			case "twentythirteen" :
				wp_enqueue_style( 'twentythirteen-style2013', $plugin_url .'themes/style2013.css' );
				wp_enqueue_style( 'twentythirteen-corners2013', $plugin_url .'themes/corners2013.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;
			case "twentyfourteen" :
				wp_enqueue_style( 'twentyfourteen-style2014', $plugin_url .'themes/style2014.css' );
				wp_enqueue_style( 'twentyfourteen-corners2014', $plugin_url .'themes/corners2014.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
					//	wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );	//not support
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;
			case "twentyfifteen" :
				wp_enqueue_style( 'twentyfifteen-style2015', $plugin_url .'themes/style2015.css' );
				wp_enqueue_style( 'twentyfifteen-corners2015', $plugin_url .'themes/corners2015.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
					//	wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );	//not support
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;

			case "twentysixteen" :
				wp_enqueue_style( 'twentysixteen-style2016', $plugin_url .'themes/style2016.css' );
				wp_enqueue_style( 'twentysixteen-corners2016', $plugin_url .'themes/corners2016.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
					//	wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );	//not support
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;

			case "twentyseventeen" :
				wp_enqueue_style( 'twentyseventeen-style2017', $plugin_url .'themes/style2017.css' );
				wp_enqueue_style( 'twentyseventeen-corners2017', $plugin_url .'themes/corners2017.css' );
				//for IE8/7
				$ua = getenv('HTTP_USER_AGENT');
				switch (true) {
					case (preg_match('/MSIE 7/', $ua)):
					//	wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );	//not support
						break;
					case (preg_match('/MSIE 8/', $ua)):
						wp_enqueue_script( 'respond', $plugin_url . 'js/respond.min.js' );
						break;
				}
				break;

			default:
			//	wp_enqueue_style( 'twentytwelve-style2012', $plugin_url .'themes/style2012.css' );
			//	wp_enqueue_style( 'twentytwelve-corners2012', $plugin_url .'themes/corners2012.css' );
				break;
		}
	}
}
add_action( 'wp_enqueue_scripts', 'add_header_css_js_fudou', 12 );


/**
 *
 * ヘッダー埋め込みタグ
 *
 * @since Fudousan Plugin 1.5.0
 */
function add_header_text_fudou() {
	//echo "\n";
	//echo '<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />';
	echo "\n<!-- Fudousan Plugin Ver.".FUDOU_VERSION." -->\n";
	//ヘッダ埋め込みタグ
	if( get_option('fudo_head_tag') != '' ) echo get_option('fudo_head_tag') . "\n";
}
add_action('wp_head', 'add_header_text_fudou');


/**
 *
 * トップテンプレート切替
 *
 * @since Fudousan Plugin 1.7.8
 * @param  $template
 * @return $template
 */
function get_post_type_top_template_fudou( $template = '' ) {

	if ( is_home() ) {

		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}

		switch ( $template_name ) {
			case "twentyseventeen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2017.php', 'index.php'));
				break;
			case "twentysixteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2016.php', 'index.php'));
				break;
			case "twentyfifteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2015.php', 'index.php'));
				break;
			case "twentyfourteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2014.php', 'index.php'));
				break;
			default:
				$template = locate_template(array('../../plugins/fudou/themes/home.php', 'index.php'));
				break;
		}
	}
	return $template;
}
add_filter( 'template_include', 'get_post_type_top_template_fudou' );


/**
 *
 * フッター Fudousan Plugin Ver.XXXX
 *
 * @since Fudousan Plugin 1.5.0
 */
function add_footer_text_fudou() {
	if ( is_front_page() ){
		echo '<div id="nendebcopy"><a href="http://nendeb.jp" target="_blank" rel="nofollow" title="WordPress 不動産プラグイン">Fudousan Plugin Ver.'.FUDOU_VERSION.'</a></div>';
	}else{
		echo '<div id="nendebcopy">Fudousan Plugin Ver.'.FUDOU_VERSION.'</div>';
	}
}
add_filter( 'wp_footer', 'add_footer_text_fudou' );


/**
 *
 * フッター埋め込みタグ
 *
 * @since Fudousan Plugin 1.6.5
 */
function add_footer_tag_fudou() {
	//フッター埋め込みタグ
	if( get_option('fudo_footer_tag') != '' ) echo "\n" . get_option('fudo_footer_tag') . "\n";
	echo "\n<!-- Fudousan Plugin Ver.".FUDOU_VERSION." -->\n";
}
add_filter( 'wp_footer', 'add_footer_tag_fudou' );


/**
 *
 * matchHeight.js
 *
 * @since Fudousan Plugin 1.6.5
 */
function fudou_matchHeight_scripts() {
	$plugin_url = plugin_dir_url( __FILE__ );
	//new
	wp_enqueue_script( 'jquery-matchHeight', $plugin_url . 'js/jquery.matchHeight-min.js', array( 'jquery' ), '', true );
	//old
	wp_enqueue_script( 'jquery-flatheights', $plugin_url . 'js/jquery.flatheights.min.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'fudou_matchHeight_scripts' );


/**
 *
 * ヘッダーに imagesloadedを 追加
 *
 * @since Fudousan Plugin 1.8.1
 */
function add_imagesloaded_fudou() {
	if( apply_filters( 'fudou_imagesloaded_use', true ) ){
		//imagesloaded
		wp_enqueue_script( 'fudou_imagesloaded', includes_url( '/js/imagesloaded.min.js' ), array(), '', false );
	}
}
add_action( 'wp_enqueue_scripts', 'add_imagesloaded_fudou' );



/**
 *
 * フッターに jsを 追加
 *
 * @since Fudousan Plugin 1.8.1
 */
function add_util_js_fudou() {

	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'util', $plugin_url . 'js/util.min.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'add_util_js_fudou', 12 );


/**
 *
 * adminフッターに jsを 追加
 *
 * @since Fudousan Plugin 1.7.9
 */
function add_util_js_admin_fudou() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'admin_util', $plugin_url . 'js/util.min.js', array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'add_util_js_admin_fudou' );


/**
 *
 * Contact Form 7 フォームにデーター追加
 *
 * @since Fudousan Plugin 1.7.12
 * @param  array $tag
 * @return array $tag
 */
function wpcf7_form_tag_filter_fudou( $tag ){

	global $post;
	if ( isset( $post->ID ) ){
		$post_id = $post->ID;
	}else{
		$post_id = isset( $_GET['p'] ) ? myIsNum_f( $_GET['p'] ) : '';
	}
	if ( ! is_array( $tag ) ) return $tag;

	if($post_id != ""){
		$name = $tag['name'];
		if($name == 'your-subject'){
			$tag_val  = get_post_meta( $post_id,'shikibesu', true );
			$tag_val .= " ".get_the_title( $post_id );

			$kakaku_data = get_post_meta($post_id,'kakaku',true);

			if( get_post_meta($post_id, 'seiyakubi', true) != "" ){
				$kakaku_data = 'ご成約済';
			}

			$kakakujoutai_data = get_post_meta($post_id,'kakakujoutai',true);
			if( $kakakujoutai_data=="1" )	$kakaku_data = '相談';
			if( $kakakujoutai_data=="2" )	$kakaku_data = '確定';
			if( $kakakujoutai_data=="3" )	$kakaku_data = '入札';

			if( is_numeric( $kakaku_data ) ){
				if ( function_exists( 'fudou_money_format_ja' ) ) {
					// Money Format 億万円 表示
					$tag_val .= " ". apply_filters( 'fudou_money_format_ja', $kakaku_data );
				}else{
					$tag_val .= " ". floatval( $kakaku_data )/10000;
					$tag_val .= ""."万円";
				}
			}else{
				$tag_val .= " " . $kakaku_data;
			}

			$tag['values'] = (array)$tag_val;
		}

		if( is_user_logged_in() ){

			//global $current_user;
			//get_currentuserinfo();
			$current_user = wp_get_current_user( ); 

			if( isset( $current_user->user_email ) ){
				$pos = strpos(  $current_user->user_email , 'pseudo.twitter.com' );
				if ($pos === false) {
					if($name == 'your-email') $tag['values'] = (array)$current_user->user_email;
				}
			}
			if( isset( $current_user->user_lastname ) && isset( $current_user->user_firstname ) ){
				if($name == 'your-name')  $tag['values'] = (array)($current_user->user_lastname .' '. $current_user->user_firstname );
			}
		}
	}
	return $tag;
}
add_filter( 'wpcf7_form_tag', 'wpcf7_form_tag_filter_fudou', 11 );


/**
 *
 * ビジュアルリッチエディターにボタンを追加
 *
 * @since Fudousan Plugin 1.0.0
 * @param  array $buttons
 * @return array $buttons
 */
function ilc_mce_buttons_fudou( $buttons ){
	array_push($buttons, "backcolor", "fontsizeselect", "cleanup");
	return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons_fudou");



/**
 *
 * 物件番号検索2
 *
 * @since Fudousan Plugin 1.7.7
 */
function fudou_shikibesu_search_join($join) {
	global $wpdb;
	if ( is_search() ) {
		if( isset($_GET['s']) && $_GET['s'] != '' ){
			$join .= " INNER JOIN $wpdb->postmeta AS PM_SKB ON $wpdb->posts.ID = PM_SKB.post_id ";
		}
	}
	return $join;
}
add_filter('posts_join', 'fudou_shikibesu_search_join');
function fudou_shikibesu_search( $search, $wp_query) {
	global $wpdb;
	if( is_search() ){
		$s = isset($_GET['s']) ? esc_sql(esc_attr( stripslashes($_GET['s']))) : '';
		$s = str_replace("&#039;","",$s);
		if ( $s !='' ) {
			$value = " OR ( PM_SKB.meta_key = 'shikibesu' AND PM_SKB.meta_value = '$s' )";
			$search = str_replace( ')))', ') '. $value . '))', $search );
		}
	}
	return $search;
}
add_filter('posts_search', 'fudou_shikibesu_search', 10, 2);
function fudou_shikibesu_search_distinct( $distinct, $query ){
	if ( is_search() ) {
		if( isset($_GET['s']) && $_GET['s'] != '' ){
			return 'DISTINCT';
		}
	}
	return $distinct;
}
add_filter( 'posts_distinct', 'fudou_shikibesu_search_distinct', 10, 2 );



/**
 *
 * SEO keywords description.
 *
 * @since Fudousan Plugin 1.0.0
 */
function keywords_description_fudou() {
	global $post;
	if ( is_single() ){
		$fudokeywords = get_post_meta($post->ID,'fudokeywords',true);
		if($fudokeywords != ''){
			echo "\n";
			echo '<meta name="keywords" content="'.$fudokeywords.'" />';
		}

		$fudodescription = get_post_meta($post->ID,'fudodescription',true);
		if($fudodescription != ''){
			echo "\n";
			echo '<meta name="description" content="'.$fudodescription.'" />';
		}
      }
}
add_action('wp_head', 'keywords_description_fudou');



/*
 * Money Format 億・万円 表示
 *
 * @since Fudousan Plugin 1.7.12
 * @param str $kakaku_data (max 99999999999999)
 * @param int $empty_process
 * @return srt $value
 */
function fudou_money_format_ja( $kakaku_data, $empty_process=0 ){

	//数値チェック
	$kakaku_data = floor( myIsNum_f( $kakaku_data ) );

	//空の場合
	if( $kakaku_data === '' ){
		return '';
	}

	//0の場合 $empty_process:1 0円表示
	if( !$kakaku_data && !$empty_process ){
		return '';
	}

	$value = '';
        $pos = mb_strlen( $kakaku_data,"utf-8" ) ;

	$cho = intval( myRight( myLeft( $kakaku_data, $pos-12 ), 4 ) );
	$oku = intval( myRight( myLeft( $kakaku_data, $pos-8 ), 4 ) );
	$man = intval( myRight( myLeft( $kakaku_data, $pos-4 ), 4 ) );
	$yen = intval( myRight( $kakaku_data,4 ) );

	if( $kakaku_data > 2000000 ){		//売買

		if ( $cho ) $value .= number_format( $cho ) . '兆';
		if ( $oku ) $value .= number_format( $oku ) . '億';
		if ( $man ) $value .= number_format( $man ) . '万';
		if ( $yen ) $value .= number_format( $yen ) . '';
		return $value . '円 ';

	}else{					//賃貸

		if ( $yen ) $yen = $yen/10000 ;
		if ( $man ){
			$value .= number_format( ($man + $yen), 4 );
			$value = preg_replace( "/\.?0+$/","", $value );
			return ( $value ) ? $value . "万円 " : "";
		}else{
			$value = number_format( $kakaku_data );
			return $value . '円 ';
		}
	}
}
add_filter( 'fudou_money_format_ja', 'fudou_money_format_ja' );



/**
 *
 * 半角数字チェック 整数/小数点
 *
 * @since Fudousan Plugin 1.5.1
 * @param num|string|array $value.
 * @return num|array $value
 */
if (!function_exists('myIsNum_f')) {
	function myIsNum_f( $value ) {
		$data = array();
		if( is_array( $value ) ){
			foreach ( $value as $k => $v ) {
				$v = str_replace(array("\r\n","\n","\r"), '', $v );
				if ( is_array($v) ){
					$data[$k] = myIsNum_f( $v );
				}else{
					if ( preg_match( "/\A([0-9]\d*|0)(\.\d+)?\z/", $v) ) {
						$data[] = $v;
					}
				}
			}
		}else{
			$value = str_replace(array("\r\n","\n","\r"), '', $value );
			if ( preg_match( "/\A([0-9]\d*|0)(\.\d+)?\z/", $value ) ) {
				return $value;
			}
		}
		if( !empty($data) ){
			return (array)$data;
		}else{
			return '';
		}
	}
}

/**
 *
 * 正規表現 URL アドレス の判別
 *
 * @since Fudousan Plugin 1.5.0
 * @param string $value.
 * @return bool $value
 */
if (!function_exists('checkurl_fudou')) {
	function checkurl_fudou( $url ){
		if( preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i' , $url )){
			return true;
		}
		return false;
	}
}

/**
 *
 * Adds template class to the array of body classes.
 *
 * @since Fudousan Plugin 1.3.0
 */
function fudou_template_body_class( $classes ) {

	if ( function_exists('wp_get_theme') ) {
		$theme_ob = wp_get_theme();
		$template_name = $theme_ob->template;
	}else{
		$template_name = get_option('template');
	}

	if ( $template_name != '' )
		$classes[] = $template_name;

	return $classes;
}
add_filter( 'body_class', 'fudou_template_body_class' );




/** 
 * JetPack パブリサイズにカスタム投稿タイプ追加
 *
 * @since Fudousan Plugin 1.7.0
 */
function fudou_jetpack_custom_posttype_publicize(){
	add_post_type_support( 'fudo', 'publicize' );
}
add_action( 'init', 'fudou_jetpack_custom_posttype_publicize' );

/** 
 * JetPack Sitemapにカスタム投稿タイプ追加
 *
 * JetPack 4.8.0
 * @since Fudousan Plugin 1.7.14
 */
function fudou_jetpack_sitemap_post_types( $post_types ) {

	if( array_search( 'fudo', $post_types ) === false ){
		$post_types[] = 'fudo';
	}
	return $post_types;
}
add_filter( 'jetpack_sitemap_post_types', 'fudou_jetpack_sitemap_post_types' );
add_filter( 'jetpack_sitemap_news_sitemap_post_types', 'fudou_jetpack_sitemap_post_types' );




/**
 *
 * admin login user_check fudous.
 * checks for USER_AGENT,Dummy_Item,CSRF,wp-submit.
 *
 * @since Fudousan Plugin 1.7.7
 *
 */
if ( !function_exists('fudou_add_spam_login_user_check') && !function_exists('fudou_add_spam_login_nonce') ) {
	// admin login user_check fudou
	function fudou_add_spam_login_user_check() {
		$is_spams = false;
		//Empty USER AGENT
		$useragent = esc_attr($_SERVER["HTTP_USER_AGENT"]);
		if ( empty($useragent) ) $is_spams = true;

		$user_login = isset( $_POST["log"] ) ? $_POST["log"] : '';
		if(!$user_login) $user_login = isset( $_GET["log"] ) ? $_GET["log"] : '';
		$user_pass  = isset( $_POST["pwd"] ) ? $_POST["pwd"] : '';
		if(!$user_pass) $user_pass  = isset( $_GET["pwd"] ) ? $_GET["pwd"] : '';

		//Dummy Item
		$user_url = isset( $_POST["url"] ) ? $_POST["url"] : '';
		if(!$user_url) $user_url = isset( $_GET["url"] ) ? $_GET["url"] : '';
		if ( $user_url != '' )  $is_spams = true;

		//verify_nonce
		$login_nonce = isset($_POST['fudou_login_nonce']) ?  $_POST['fudou_login_nonce'] : '';
		if( !$login_nonce ) $login_nonce = isset($_GET['fudou_login_nonce']) ?  $_GET['fudou_login_nonce'] : '';
		if ( !$is_spams && $user_login && !$login_nonce )  $is_spams = true;
		if ( !$is_spams && $user_login && !wp_verify_nonce( $login_nonce, 'fudou_login_nonce') )  $is_spams = true;

		//wp-submit
		$wp_submit = isset($_POST['wp-submit']) ?  $_POST['wp-submit'] : '';
		if( !$wp_submit ) $wp_submit = isset( $_GET["wp-submit"] ) ? $_GET["wp-submit"] : '';
		if ( !$is_spams && $user_login && !$wp_submit )  $is_spams = true;
		//if ( !$is_spams && $user_login && $wp_submit == '%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3' )  $is_spams = true;

		if ( $is_spams ){
			status_header( 403 );
			exit();
		}
	}
	add_action( 'login_init', 'fudou_add_spam_login_user_check', 2 );

	// admin login user_check verify_nonce & dummy item
	function fudou_add_spam_login_nonce() {
		echo '<input type="hidden" name="fudou_login_nonce" value="' .wp_create_nonce( 'fudou_login_nonce' ) . '" />';
		echo '<p class="form-url" style="display:none"><label>URL</label><input type="text" name="url" id="url" class="input" size="30" /></p>';
	}
	add_action( 'login_form', 'fudou_add_spam_login_nonce', 10 );
}

