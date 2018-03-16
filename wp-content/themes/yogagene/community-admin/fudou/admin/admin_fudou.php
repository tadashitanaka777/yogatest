<?php
/*
 * 不動産プラグイン管理画面設定
 * @package WordPress4.7
 * @subpackage Fudousan Plugin
 * Version: 1.7.12
*/


/**
 * ログイン画面 ロゴ
 *
 * Version: 1.7.6
 */
function fudou_login_header_logo() {
	?>
	<style>
	.login h1 a {
		background-image: url( <?php echo WP_PLUGIN_URL;?>/fudou/img/nendeb_logo.png);
		background-size: auto auto;
		width: 315px;
		height: 50px;
		margin: 0;
	}
	</style>
<?php }
//add_action( 'login_head', 'fudou_login_header_logo' );

/**
 * Filters link URL of the header logo above login form.
 * @param string $login_header_url Login header logo URL.
 * Version: 1.7.6
 */
function fudou_login_header_url() { 
	return 'https://nendeb.jp/';
}
//add_filter( 'login_headerurl', 'fudou_login_header_url' );

/**
 * Filters the title attribute of the header logo above login form.
 *
 * @param string $login_header_title Login header logo title attribute.
 * Version: 1.7.6
 */
function fudou_login_headertitle() { 
	return '不動産プラグイン';
}
//add_filter( 'login_headertitle', 'fudou_login_headertitle' );








if (!function_exists('hide_wptouch3_updateplugin')) {
//wptouch3への更新を非表示
function hide_wptouch3_updateplugin($data) {
	if ( isset($data->response['wptouch/wptouch.php']) ) {
		unset( $data->response['wptouch/wptouch.php']);
	}
	return $data;
}
add_filter('site_option__site_transient_update_plugins', 'hide_wptouch3_updateplugin');
}


//管理画面CSS追加
function fudou_admin_style(){
	wp_enqueue_style( 'fudou_admin_style', plugin_dir_url( __FILE__ ) .'fudou_admin_style.css', array(), FUDOU_VERSION );
}
add_action( 'admin_enqueue_scripts', 'fudou_admin_style' );



/*
//プラグイン更新表示を非表示
if( get_option('fudo_plugin_update' ) != 'true' ){

	function wp_plugin_update_rows_fudou() {
		if ( !current_user_can('update_plugins' ) )
			return;
		$plugins = get_site_transient( 'update_plugins' );

		if ( isset($plugins->response) && is_array($plugins->response) ) {
			$plugins = array_keys( $plugins->response );
			foreach( $plugins as $plugin_file ) {
				if( $plugin_file != 'fudou/fudou.php' ){
					add_action( "after_plugin_row_$plugin_file", 'wp_plugin_update_row', 10, 2 );
				}
			}
		}
	}
	add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_plugin_update_rows' );" ), 2 );
	add_action( 'admin_init', create_function( '$a', "add_action( 'admin_init', 'wp_plugin_update_rows_fudou' );" ), 2 );

	//プラグインの自動更新を無効化	3.7～
	//add_filter( 'auto_update_plugin', '__return_false' , 99 );
}
*/


//WordPressのバージョンアップ通知を非表示
if( get_option('fudo_wp_update') != 'true' ){

	add_filter( 'pre_site_transient_update_core', '__return_zero' );
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );

	//コアの自動更新をすべて無効化	3.7～
	//add_filter( 'auto_update_core', '__return_false' );

	//すべての自動更新を無効化する
	//add_filter( 'automatic_updater_disabled', '__return_true' );
}


// 物件画像メディアアップローダ用の javascript API
function fudou_admin_mediauploader_scripts() {
	wp_register_script(
		'fudou_mediauploader',
		plugin_dir_url( __FILE__ ) . '../js/media-uploader_pro.js',
		array( 'jquery' ),
		false,
		true
	);
	wp_enqueue_media();
	wp_enqueue_script( 'fudou_mediauploader' );
}
add_action( 'admin_print_scripts', 'fudou_admin_mediauploader_scripts' );




/**
 * 不動産プラグイン基本設定
 *
 * Version: 1.7.0
 */
if( is_admin() ){
	new FudouPlugin();
}
class FudouPlugin {

	/**
	 * Start up
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add options page
	 */
	function admin_menu () {
		add_options_page( 'admin_menu_fudou', '不動産プラグイン設定', 'edit_pages', __FILE__, array( $this, 'form' ) );
	}


	function process_option( $name, $default, $params ) {
		if ( array_key_exists( $name, $params ) ) {
			$value = stripslashes( $params[$name] );
		} elseif ( array_key_exists( '_' . $name, $params ) ) {
		// unchecked checkbox value
			$value = stripslashes( $params['_'.$name] );
		} else {
			$value = null;
		}
		$stored_value = get_option( $name );
		if ( $value == null ) {
			if ( $stored_value === false ) {
				if ( is_callable( $default ) && method_exists( $default[0], $default[1] ) ) {
					$value = call_user_func( $default );
				} else {
					$value = $default;
				}
				add_option( $name, $value );
				} else {
					$value = $stored_value;
				}
			} else {
			if ( $stored_value === false ) {
				add_option( $name, $value );
			} elseif ( $stored_value != $value ) {
				update_option( $name, $value );
			}
		}
		return $value;
	}

	function process_option2($name, $default, $params) {
		$value = '';
		if( isset( $_POST['fudo_eigyouken']) ){
			$value = isset($params[$name]) ? stripslashes($params[$name]) : '';
			$stored_value = get_option($name);

			if ($stored_value === false) {
				add_option($name, $value);
			} else {
				update_option($name, $value);
			}
		}
		return $value;
	}

	//fudo_form
	function process_option3($name, $default, $params) {
		$value = '';
		if( isset( $_POST['fudo_eigyouken']) ){
			$value = stripslashes($params[$name]);
			$stored_value = get_option($name);

				if ($stored_value === false) {
					add_option($name, $value);
				} else {
					update_option($name, $value);
				}
		}
		return $value;
	}

	//設備
	function process_option_setsubi() {
		$name = 'widget_seach_setsubi';
		$value = isset($_POST['set']) ? $_POST['set'] : '';
		if( isset( $_POST['fudo_eigyouken']) ){
			$stored_value = get_option($name);

			if ($stored_value === false) {
				add_option($name, maybe_serialize($value) );
			} else {
				update_option($name, maybe_serialize($value) );
			}
		}
		return maybe_unserialize(get_option($name));
	}

	//プラグイン設定フォーム
	function form() {
		global $post;
		global $wpdb;
		global $wp_version;
		global $is_fudoubus;


		if( isset( $_POST['fudo_eigyouken']) ){
			for( $i=1; $i<48 ; $i++ ){
				$stored_value = get_option('ken'.$i);
				$ken_data = isset($_POST['ken'.$i]) ? $_POST['ken'.$i] : '';
				if( $stored_value === false){
					add_option('ken'.$i, $ken_data);
				} elseif ($stored_value != $ken_data) {
					update_option('ken'.$i, $ken_data);
				}
			}
		}

		$opt_fudo_annnai = $this->process_option3('fudo_annnai','', $_POST);
		$opt_fudo_annnai = get_option('fudo_annnai');
		$opt_fudo_form   = $this->process_option3('fudo_form','', $_POST);
		$opt_fudo_form   = get_option('fudo_form');
		$opt_fudo_head_tag = $this->process_option3('fudo_head_tag','', $_POST);
		$opt_fudo_head_tag = get_option('fudo_head_tag');

		$opt_fudo_footer_tag = $this->process_option3('fudo_footer_tag','', $_POST);
		$opt_fudo_footer_tag = get_option('fudo_footer_tag');

	//	$opt_fudo_plugin_update = $this->process_option('fudo_plugin_update','true', $_POST);
		$opt_fudo_wp_update = $this->process_option('fudo_wp_update','true', $_POST);

		$opt_fudo_map_directions = $this->process_option('fudo_map_directions','true', $_POST);
		$opt_fudo_map_bus_directions = $this->process_option('fudo_map_bus_directions','true', $_POST);

		$opt_fudo_map_elevation = $this->process_option('fudo_map_elevation','true', $_POST);
		$fudo_map_comment	= $this->process_option2('fudo_map_comment','', $_POST);
		$fudo_map_comment	= get_option('fudo_map_comment');

		//GoogleMaps API KEY map1.6.6
		$googlemaps_api_key	= $this->process_option2('googlemaps_api_key','', $_POST);
		$googlemaps_api_key	= get_option('googlemaps_api_key');

		//GoogleMaps API KEY local use map1.7.5
		$googlemaps_api_key_local	= $this->process_option2('googlemaps_api_key_local','', $_POST);
		$googlemaps_api_key_local	= get_option('googlemaps_api_key_local');


		$fudou_ssl_site_url	= $this->process_option2('fudou_ssl_site_url','', $_POST);
		$fudou_ssl_site_url	= get_option('fudou_ssl_site_url');

		$newup_mark = $this->process_option2('newup_mark','', $_POST);
		$newup_mark = get_option('newup_mark');
		if($newup_mark == '') $newup_mark=14;

		//for WordPress3.5
		if ( version_compare($wp_version, '3.5', '>=') ) {
			$upload_path	= $this->process_option2('upload_path','', $_POST);

			$uploads_use_yearmonth_folders = '';

			if( isset( $_POST['fudo_eigyouken']) ){
				$value = isset($_POST['uploads_use_yearmonth_folders']) ? $_POST['uploads_use_yearmonth_folders'] : '';
					$stored_value = get_option("uploads_use_yearmonth_folders");

					if ($stored_value === false) {
						add_option("uploads_use_yearmonth_folders", $value);
					} else {
						update_option("uploads_use_yearmonth_folders", $value);
					}
			}

			$stored_value = get_option("uploads_use_yearmonth_folders");
			if( $stored_value ){
				$uploads_use_yearmonth_folders = 'checked="checked"';
			}else{
				$uploads_use_yearmonth_folders = '';
			}
		}

		$widget_seach_setsubi	= $this->process_option_setsubi();


		if ( is_multisite() ) {
				echo '<div class="error" style="text-align: center;"><p>マルチサイトでは利用できません。</p></div>';
		}else{


			?>

			<div class="wrap">
				<div id="icon-tools" class="icon32"><br /></div>
				<h2>不動産プラグイン設定(基本設定)</h2>
				<div id="poststuff">


				<div id="post-body">
				<div id="post-body-content">

					<?php if ( !empty($_POST ) ) : ?>
					<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
					<?php endif; ?> 

				        <h3>環境 </h3>
					<div style="margin:0 0 0 20px;">

						PHPバージョン　<?php echo PHP_VERSION;?><br />
					<?php				
						$sapi_type = php_sapi_name();
						if (substr($sapi_type, 0, 3) == 'cgi') {
						    echo "PHP CGI 版を使用しています<br />";
						} else {
						    echo "PHP CGI 版を使用していません<br />";
						}

						//PHP Safe Mode
						if(ini_get('safe_mode')) echo "PHP セーフモード　はい<br />";
						else  echo "PHP セーフモード　いいえ<br />";

						//PHP Memory Limit 
					//	if(ini_get('memory_limit')) 
					//	echo "PHP Memory Limit　" . ini_get('memory_limit') . "<br />";
					?>
						MySQLバージョン　<?php echo $wpdb->db_version();?><br />
					</div>


				        <h3>データ </h3>
					<div style="margin:0 0 0 20px;">
					<?php
						echo '地域データバージョン ' . get_option( "fudo_area_db_version" );
						echo '<br />';
						echo '路線データバージョン ' . get_option( "fudo_train_db_version" );
					?>
					</div>
					<br />
					<br />


					<form class="add:the-list: validate" method="post">

				        <input name="fudo_eigyouken" type="hidden" value="publish" />
				        <h3>営業県 </h3>
					<div style="margin:0 0 0 20px;">
					<?php
						$sql = "SELECT middle_area_id, middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE ." ORDER BY middle_area_id";
					//	$sql = $wpdb->prepare($sql,'');

						$metas = $wpdb->get_results( $sql, ARRAY_A );
						if(!empty($metas)) {
							$i=1;
							foreach ( $metas as $meta ) {

								$meta_id = $meta['middle_area_id'];
								$meta_valu = $meta['middle_area_name'];
								echo ' <span class="k_checkbox"><input type="checkbox" name="ken'.$meta['middle_area_id'].'" value="'.$meta['middle_area_id'].'" id="ken'.$meta['middle_area_id'].'"';
								if( get_option('ken'.$meta['middle_area_id']) != '' ){
									echo ' checked="checked" /> <label for="ken'.$meta['middle_area_id'].'"><b>'. $meta['middle_area_name'].'</b></label></span>　';
								}else{
									echo ' /> <label for="ken'.$meta['middle_area_id'].'">'. $meta['middle_area_name'].'</label></span>　';
								}
								if ($i == '07' ) echo '<br />';
								if ($i == '14' ) echo '<br />';
								if ($i == '20' ) echo '<br />';
								if ($i == '24' ) echo '<br />';
								if ($i == '30' ) echo '<br />';
								if ($i == '35' ) echo '<br />';
								if ($i == '39' ) echo '<br />';
								if ($i == '46' ) echo '<br />';

								$i++;
							}
						}
					?>

					</div>　　　*必要な県だけ設定してください。全て選択すると不具合がでる場合があります。
					<br />
					<br />
					<br />

					<h3>物件問合せ先</h3>
					<div id="postdivrich" class="postarea">
					<div style="margin:0 0 0 20px;">
						<style>
							textarea{ width:100%;}
						</style>
					<?php
						if ( version_compare($wp_version, '3.3', '<') ) {
							the_editor($opt_fudo_annnai, 'fudo_annnai', 'title', true, 2);
						}else{
							wp_editor($opt_fudo_annnai, 'fudo_annnai', 'title', true, 2);
						}
					?>
						<table id="post-status-info" cellspacing="0"><tbody><tr>
							<td id="wp-word-count">*物件詳細ページ下に表示されます。</td>
							<td class="autosave-info"><span id="autosave">&nbsp;</span></td>
						</tr></tbody></table>
						*免許番号は必ず表記してください。
						*&lt;/div&gt;等の閉じ忘れに注意してください。
					</div>
					
					</div>
					<br />

				        <h3>問合せフォーム</h3>
					<div id="postdivrich" class="postarea">
					<div style="margin:0 0 0 20px;">
					<div id='editorcontainer'><textarea rows='10' cols='40' name='fudo_form' tabindex='2' id='fudo_form'><?php echo esc_textarea( $opt_fudo_form ); ?></textarea></div>

						<table id="post-status-info" cellspacing="0"><tbody><tr>
							<td id="wp-word-count">*物件詳細ページ下に表示されます。</td>
							<td class="autosave-info"><span id="autosave">&nbsp;</span></td>
						</tr></tbody></table>

					</div>
					</div>

					<br />
					<br />

					<a name="set" id="set"></a>

				        <h3>物件条件検索ウィジェット「設備・条件」　設定(表示設定)</h3>
					<div id="postdivrich" class="postarea">
					<?php
						echo '<div style="margin:0 0 0 20px;">';
						echo ' (表示したい項目にチェックを入れてください)<br />';
						global $work_setsubi;
					//	array_multisort($code,SORT_DESC,$work_setsubi); 
					//	asort($work_setsubi);
						foreach($work_setsubi as $meta_box){

							//条件
							if( $meta_box['code'] == "10001") echo "<hr />";
							//キッチン                                    
							if( $meta_box['code'] == "20701") echo "<hr />";
							//バス・トイレ                                
							if( $meta_box['code'] == "21001") echo "<hr />";
							//冷暖房                                      
							if( $meta_box['code'] == "21301") echo "<hr />";
							//収納                                        
							if( $meta_box['code'] == "21401") echo "<hr />";
							//放送・通信                                  
							if( $meta_box['code'] == "21901") echo "<hr />";
							//セキュリティ                                
							if( $meta_box['code'] == "22301") echo "<hr />";
							//ガス水道                                    
							if( $meta_box['code'] == "20101") echo "<hr />";
							//その他                                      
							if( $meta_box['code'] == "22401") echo "<hr />";

							echo '<span class="k_checkbox"><input type="checkbox" name="set[]"  value="'.$meta_box['code'].'" id="set'.$meta_box['code'].'"';
							$chk_bold = false;
							if(is_array($widget_seach_setsubi)) {
								$i=0;
								foreach($widget_seach_setsubi as $meta_box2){
									if($widget_seach_setsubi[$i] == $meta_box['code']){
										echo ' checked="checked"';
										$chk_bold = true;
									}

									$i++;
								}
							}
							if( $chk_bold ){
								echo '"> <label for="set'.$meta_box['code'].'"><b>'.$meta_box['name'].'</b></label></span>　';
							}else{
								echo '"> <label for="set'.$meta_box['code'].'">'.$meta_box['name'].'</label></span>　';
							}
						}

						echo '<br /><br /> *物件にチェックが入っている項目が表示対象になります。';
						echo '<br /> *チェックが全く無い場合、全て表示対象になります。';

						echo '</div>';
					?>

					<br />
					<br />



				        <h3>NEW(新着)、UP(更新)マーク表示</h3>
					<div id="postdivrich" class="postarea">
					<?php
						echo '<div style="margin:0 0 0 20px;">';
						echo '<b>表示日数</b> (表示したい日数を入れてください。半角数値)<br />';
						echo '<input name="newup_mark" type="number" value="'. $newup_mark . '" size="4" />日間表示　( 0 で表示しなくなります。)<br />';
						echo ' *登録日と更新日が同じ場合はNEWマークになります。';
						echo '</div>';
					?>

					<br />
					<br />

				        <h3>地図表示 (物件詳細)</h3>
					<div style="margin:0 0 0 20px;">

						<b>駅から物件までのルートを表示</b><br />
						<select name="fudo_map_directions">
						<option value="false"<?php if($opt_fudo_map_directions != "true") echo ' selected="selected"'; ?>>表示しない</option>
						<option value="true" <?php if($opt_fudo_map_directions == "true") echo ' selected="selected"'; ?>>表示する</option>
						</select><br /><br />

					<?php if( $is_fudoubus ){ ?>
						<b>バス停から物件までのルートを表示(バス停優先)</b><br />
						<select name="fudo_map_bus_directions">
						<option value="false"<?php if($opt_fudo_map_bus_directions != "true") echo ' selected="selected"'; ?>>表示しない</option>
						<option value="true" <?php if($opt_fudo_map_bus_directions == "true") echo ' selected="selected"'; ?>>表示する</option>
						</select><br /><br />
					<?php }?>

						<b>標高を表示</b><br />
						<select name="fudo_map_elevation">
						<option value="false"<?php if($opt_fudo_map_elevation != "true") echo ' selected="selected"'; ?>>表示しない</option>
						<option value="true"<?php if($opt_fudo_map_elevation == "true") echo ' selected="selected"'; ?>>表示する</option>
						</select>　
						*マーカークリック時に標高を追加表示します。<br /><br />

						<b>マップ下コメント</b><br />
						<input name="fudo_map_comment" type="text" value="<?php echo $fudo_map_comment; ?>" class="regular-text code" /><br />
						*マップ下に簡単なコメントを表示できます。<br />

						<br />

						<b>GoogleMaps API KEY</b><br />
						<input name="googlemaps_api_key" type="text" value="<?php echo $googlemaps_api_key; ?>" class="regular-text code" /><br />

						<?php
						//GoogleMaps API KEY local use map1.7.5
						?>
						<b>localhostでの API KEY 使用</b><br />
						<select name="googlemaps_api_key_local">
						<option value="0"<?php if( $googlemaps_api_key_local != 1 ) echo ' selected="selected"'; ?>>使用しない</option>
						<option value="1"<?php if( $googlemaps_api_key_local == 1 ) echo ' selected="selected"'; ?>>使用する</option>
						</select>

					</div>
					<br />
					<br />


				<?php if(FUDOU_SSL_MODE==1){ ?>	

					<h3>SSL(会員申込み、パスワードリセット、物件問い合わせ)</h3>
					<div style="margin:0 0 0 20px;">

						ベースURL　<input name="fudou_ssl_site_url" type="text" value="<?php echo $fudou_ssl_site_url; ?>" class="regular-text code" /><br />
						※問い合わせフォームや会員申込みだけ SSLにしたい場合は SSLのURLを入力してください。<br />
						※物件問い合わせフォームがポップアップフォームになります。<br />
						※使用しない場合は空欄にしてください。<br />

						※例 通常トップページが http://ドメイン/の場合　「https://ドメイン」 (最後のスラッシュは無し)<br />
						※例 通常トップページが http://ドメイン/の場合　「https://共用SSL」 (最後のスラッシュは無し)<br />
						※例 通常トップページが http://ドメイン/wp/の場合　「https://ドメイン/wp」 (最後のスラッシュは無し)<br />
						※例 通常トップページが http://ドメイン/wp/の場合　「https://共用SSL/wp」 (最後のスラッシュは無し)


					</div>
					<br />
					<br />
				<?php } ?>	

				<?php
				/*
				        <h3>不動プラグイン更新表示</h3>
					<div style="margin:0 0 0 20px;">

					　<select name="fudo_plugin_update">
					<option value="true"<?php if($opt_fudo_plugin_update != "false") echo ' selected="selected"'; ?>>表示する</option>
					<option value="false"<?php if($opt_fudo_plugin_update == "false") echo ' selected="selected"'; ?>>表示しない</option>
					</select>
					*不動プラグイン更新表示(新しいバージョンの・・)をするかしないかを設定します。(更新カウント数はそのままです)
					</div>
					<br />
					<br />
				*/
				?>

				        <h3>WordPressのバージョンアップ通知</h3>
					<div style="margin:0 0 0 20px;">

					　<select name="fudo_wp_update">
					<option value="true"<?php if($opt_fudo_wp_update != "false") echo ' selected="selected"'; ?>>表示する</option>
					<option value="false"<?php if($opt_fudo_wp_update == "false") echo ' selected="selected"'; ?>>表示しない</option>
					</select>
					*WordPress のバージョンアップ通知をするかしないかを設定します。
					</div>

					<br />
					<br />

				<!-- for WordPress3.5～ -->
					<?php if ( version_compare($wp_version, '3.5', '>=') ) { ?>
				        <h3>メディア設定</h3>
					<div style="margin:0 0 0 20px;"><br />
						<?php _e('Store uploads in this folder'); ?>
						<input name="upload_path" type="text" id="upload_path" value="<?php echo esc_attr(get_option('upload_path')); ?>" /> 
						<span class="description"><?php _e('Default is <code>wp-content/uploads</code>'); ?></span>
						<br />
						<input name="uploads_use_yearmonth_folders" type="checkbox" id="uploads_use_yearmonth_folders" value="1" <?php echo $uploads_use_yearmonth_folders;?> />
						アップロードしたファイルを年月ベースのフォルダに整理</label>
					</div>
					<br />
					<br />
					<?php } ?>
				<!-- . WordPress3.5～ -->


					<h3>ヘッダ・フッター埋め込みタグ</h3>
					<div id="postdivrich" class="postarea">
					<div style="margin:0 0 0 20px;">
					ヘッダー
						<div id='editorcontainer'><textarea rows='10' cols='40' name='fudo_head_tag' tabindex='2' id='fudo_form'><?php echo esc_textarea( $opt_fudo_head_tag ); ?></textarea></div>
							<table id="post-status-info" cellspacing="0"><tbody><tr>
								<td id="wp-word-count">*他社のアクセスログ オリジナルのscript css等ヘッダに埋め込むタグを記述してください</td>
								<td class="autosave-info"><span id="autosave">&nbsp;</span></td>
							</tr></tbody></table>
						</div>
					</div>
					<div style="margin:0 0 0 20px;">
					フッター
						<div id='editorcontainer'><textarea rows='10' cols='40' name='fudo_footer_tag' tabindex='2' id='fudo_form'><?php echo esc_textarea( $opt_fudo_footer_tag ); ?></textarea></div>
							<table id="post-status-info" cellspacing="0"><tbody><tr>
								<td id="wp-word-count">*他社のアクセスログ オリジナルのscript css等ヘッダに埋め込むタグを記述してください</td>
								<td class="autosave-info"><span id="autosave">&nbsp;</span></td>
							</tr></tbody></table>
						</div>
					</div>
					</div>

				<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="変更を保存"  /></p>

				</div>
				</div>

			    </form>
			</div>

			<?php
		}
	}
}




/*
 * ダッシュボードウィジェット
 * 不動産プラグイン案内表示
 * Version: 1.7.11
 */
function fudodl_add_dashboard_widgets() {
	// Right Now
	if ( current_user_can( 'edit_posts' ) ) {
		wp_add_dashboard_widget( 'dashboard_right_now3', '不動産プラグイン', 'wp_dashboard_right_now3' );
	}
}
//admin_init
//add_action('wp_dashboard_setup', 'fudodl_add_dashboard_widgets' );
function wp_dashboard_right_now3() {
	echo '<div class="table table_content">';
	echo '<iframe src="//nendeb.jp/fudou_dl.html" height="350" width="100%" frameborder="0"></iframe>';
	echo '</div>';
}



/*
 * ダッシュボードウィジェット
 * 物件数表示
 * Version: 1.7.11
 */
function fudo_add_dashboard_widgets() {
	// Right Now
	if ( current_user_can( 'edit_posts' ) ) {
		wp_add_dashboard_widget( 'dashboard_right_now2', '物件', 'wp_dashboard_right_now2' );
	}
}
//admin_init
//add_action('wp_dashboard_setup', 'fudo_add_dashboard_widgets' );
function wp_dashboard_right_now2() {
	global $wpdb;
	global $wp_registered_sidebars;

	$num_ippan = 0;
	$num_kaiin = 0;

	// Posts
	$num_posts2 = wp_count_posts( 'fudo' );
	//$num =  $num_posts2->publish ;

	//公開
	$sql = "SELECT count(DISTINCT P.ID) AS co";
	$sql .=  " FROM $wpdb->posts AS P";
	$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
	$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
	$sql .=  " AND PM.meta_key='kaiin' AND PM.meta_value = 0";
	//$sql = $wpdb->prepare($sql,'');
	$metas = $wpdb->get_row( $sql );
	if( !empty($metas) ){
		$num_ippan = $metas->co;
	}

	//会員
	$sql = "SELECT count(DISTINCT P.ID) AS co";
	$sql .=  " FROM $wpdb->posts AS P";
	$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
	$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
	$sql .=  " AND PM.meta_key='kaiin' AND PM.meta_value = 1";
	//$sql = $wpdb->prepare($sql,'');
	$metas = $wpdb->get_row( $sql );
	if( !empty($metas) ){
		$num_kaiin = $metas->co;
	}

	echo '<div class="table table_content">';
	echo '<p class="sub">公開</p>';

	echo '<table>';

	echo '<tr class="first">';
	echo '<td class="first b b-posts">' . number_format_i18n( $num_ippan ) . '</td>';
	echo '<td class="t posts">件　一般公開</td>';
	echo '</tr>';

	echo '<tr class="first">';
	echo '<td class="first b b_pages">' . number_format_i18n( $num_kaiin ) . '</td>';
	echo '<td class="t pages">件　会員公開</td>';
	echo '</tr>';

	do_action( 'kaiin_level_admin_bukken_count' );

	echo '</table></div>';

	if ( current_user_can( 'edit_posts' ) ) {

		echo '<div class="table table_discussion">';
		echo '<p class="sub">非公開</p>'."\n\t".'<table>';
		$num = number_format_i18n( $num_posts2->draft );

		$text = "件　下書き";
		echo '<tr class="first">';
		echo '<td class="first b b-posts">' . $num . '</td>';
		echo '<td class="t posts">' . $text . '</td>';
		echo '</tr>';


		$num = number_format_i18n( $num_posts2->private );
		$text = "件　非公開";
		echo '<tr class="first">';
		echo '<td class="first b b-pages">' . $num . '</td>';
		echo '<td class="t posts">' . $text . '</td>';
		echo '</tr>';
	}

	do_action( 'kaiin_level_admin_bukken_count2' );

	echo '</table></div>';

	echo '<br class="clear" />';
	do_action( 'activity_box_end' );
}


//管理画面投稿表示 ver1.7.10
function my_fudo_stuff(){


	$labels = array(
		'menu_name'          => '物件',
		'singular_name'      => '物件',			//menu
		'all_items'          => '物件一覧',		//menu
		'add_new'            => '新規物件追加',		//menu
		'name'               => '物件',
		'add_new_item'       => '新規物件追加',
		'edit_item'          => '物件の編集',
	);

	if( FUDOU_TRA_COMMENT  ){
		register_post_type(
			'fudo', 
			array(
				'labels'		=> $labels,
				'description'		=> '',		//投稿タイプの説明
				'public'		=> true,
				'publicly_queryable'	=> true,	//ドメイン/?post_type=fudoでアーカイブ表示
				'show_ui'		=> true,	//管理画面に表示
				'show_in_menu'		=> true,	//管理画面左メニューに表示
				'show_in_nav_menus'	=> false,	//管理画面->メニューに表示
				'show_in_admin_bar'	=> true,	//管理バー(+新規)に表示
				'capability_type'	=> 'post',	//権限設定
				'has_archive' 		=> true,
				'hierarchical'		=> false,	//階層構造を許可(親記事を指定できる)
				'menu_position'		=> 5, 
				'query_var'		=> false, 
				'exclude_from_search'	=> false, 	//サイト内検索
				//'menu_icon'	=> '', 			//アイコン
				'supports' => array(			//投稿画面用のパーツ
					'title', 
					'editor', 
					'excerpt',
					'trackbacks',
					'comments',
				//	'revisions',
				//	'custom-fields',
					'thumbnail'
				),
				'rewrite' => array('with_front' => false),
			//	'rewrite'		=> false,
			//	'rewrite' => array( 'slug' => 'fudo', 'with_front' => false ),
			//	'rewrite' => array( 'slug' => 'fudo' ),
			)
		);
	}else{
		register_post_type(
			'fudo', 
			array(
				'labels'		=> $labels,
				'description'		=> '',		//投稿タイプの説明
				'public'		=> true,
				'publicly_queryable'	=> true,	//ドメイン/?post_type=fudoでアーカイブ表示
				'show_ui'		=> true,	//管理画面に表示
				'show_in_menu'		=> true,	//管理画面左メニューに表示
				'show_in_nav_menus'	=> false,	//管理画面->メニューに表示
				'show_in_admin_bar'	=> true,	//管理バー(+新規)に表示
				'capability_type'	=> 'post',	//権限設定
				'has_archive' 		=> true,
				'hierarchical'		=> false,	//階層構造を許可(親記事を指定できる)
				'menu_position'		=> 5, 
				'query_var'		=> false, 
				'exclude_from_search'	=> false, 	//サイト内検索
				//'menu_icon'	=> '', 			//アイコン
				'supports' => array(			//投稿画面用のパーツ
					'title', 
					'editor', 
					'excerpt',
				//	'trackbacks',
				//	'comments',
				//	'revisions',
				//	'custom-fields',
					'thumbnail'
				),
				'rewrite' => array('with_front' => false),
			//	'rewrite'		=> false,
			//	'rewrite' => array( 'slug' => 'fudo', 'with_front' => false ),
			//	'rewrite' => array( 'slug' => 'fudo' ),
			)
		);
	}

/*
	//旧タイプ
	if( FUDOU_TRA_COMMENT  ){
		register_post_type(
			'fudo', 
			array(
				'label' => __('物件'),
				'singular_label' => __('投稿'),
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => false,
				'query_var' => false, 
				'menu_position' => 5, 
				'supports' => array(
					'title', 
					'editor', 
					'excerpt',
					'trackbacks',
					'comments',
				//	'revisions',
				//	'custom-fields',
					'thumbnail'
				),
				'has_archive' => true,
				'rewrite' => array('with_front' => false),

			)
		);
	}else{
		register_post_type(
			'fudo', 
			array(
				'label' => __('物件'),
				'singular_label' => __('投稿'),
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => false,
				'query_var' => false, 
				'menu_position' => 5, 
				'supports' => array(
					'title', 
					'editor', 
					'excerpt',
				//	'trackbacks',
				//	'comments',
				//	'revisions',
				//	'custom-fields',
					'thumbnail'
				),
				'has_archive' => true,
				'rewrite' => array('with_front' => false),
			//	'rewrite' => array( 'slug' => $slug, 'with_front' => false ),
			)
		);
	}
*/


	//物件カテゴリ
	register_taxonomy(
		'bukken',	//タクソノミー名
		'fudo', 	//post type名
		array(
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'label' => '物件カテゴリ',
			'singular_label' => '物件カテゴリ',
			'public' => true,
			'show_ui' => true,
			//'menu-order' => true,
			//'rewrite' => array('slug' => 'bukken')

		)
	);


	//物件投稿タグ
	register_taxonomy(
		'bukken_tag',	//タクソノミー名
		'fudo', 	//post type名
		array(
			'public' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'show_in_nav_menus' => true,
			'hierarchical' => false,
			'labels' => array(
				'name' => '物件投稿タグ',
				'singular_name' => '物件投稿タグ',
				'searemperor_items' => '物件タグを検索',
				'popular_items' => 'よく使われている物件タグ',
				'all_items' => 'すべてのタグ',
				'edit_item' => '物件タグの編集',
				'update_item' => '更新',
				'add_new_item' => '新規物件タグを追加',
				'new_item_name' => '新しい物件投稿タグ',
				'choose_from_most_used' => 'よく使われている物件タグから選択'
			)
			//,'rewrite' => array('slug' => 'bukken_tag')  
		)
	);
	add_post_type_support( 'fudo', 'author' );

}
add_action('init', 'my_fudo_stuff'); 




//数字ベース
function fudou_post_type_link( $link, $post ){
	//パーマリンクチェック
	$permalink_structure = get_option( 'permalink_structure' );
	$pos = strpos( $permalink_structure, 'post_id' );

	if ( $pos !== false ) {
		if ( 'fudo' === $post->post_type ) {
			return home_url( '/fudo/' . $post->ID );
		} else {
			return $link;
		}
	}else{
			return $link;
	}
}
add_filter( 'post_type_link', 'fudou_post_type_link', 1, 2 );


/**
 * Add rewrite_rules.
 *
 * @since 1.6.0
 *
 * @param $rules
 * @return $rules
 */
function fudou_rewrite_rules_array( $rules ) {
	//パーマリンクチェック
	$permalink_structure = get_option( 'permalink_structure' );
	$pos = strpos( $permalink_structure, 'post_id' );

	if ( $pos !== false ) {
		$new_rules = array( 
			'fudo/([0-9]{1,})/?$' => 'index.php?post_type=fudo&p=$matches[1]',
			//'fudo/([0-9]{1,})/amp?$' => 'index.php?post_type=fudo&p=$matches[1]&amp=1',
		);
		return $new_rules + $rules;
	}else{
		return $rules;
	}
}
add_filter( 'rewrite_rules_array', 'fudou_rewrite_rules_array' );













//管理画面一覧表示
function my_fudo_columns($columns){

	$columns_title = isset($_GET['title']) ? $_GET['title'] : '';
	$columns_kkk   = isset($_GET['kkk']) ?   $_GET['kkk']  : '';
	$columns_no    = isset($_GET['no']) ?    $_GET['no']   : '';
	$columns_mds   = isset($_GET['mds']) ?   $_GET['mds'] : '';
	$columns_mds2  = isset($_GET['mds2']) ?  $_GET['mds2'] : '';
	$columns_kds   = isset($_GET['kds']) ?   $_GET['kds'] : '';
	$columns_siy   = isset($_GET['siy']) ?   $_GET['siy'] : '';
	$columns_sik   = isset($_GET['sik']) ?  $_GET['sik'] : '';

	//sort
	$arr_params = array ('title' => 'desc','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');

	//タイトル
	if ( $columns_title == 'asc'){
		$arr_params = array ('title' => 'desc','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' =>  'asc','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}
		$title_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$title_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_title.'.png" border="0">';

	//価格
	if ( $columns_kkk == 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => 'desc','no' => '','kds' => '','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => 'asc','no' => '','kds' => '','siy' => '','sik' => '');
	}
		$kakaku_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$kakaku_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_kkk.'.png" border="0">';

	//物件番号
	if ( $columns_no == 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => 'desc','kds' => '','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => 'asc','kds' => '','siy' => '','sik' => '');
	}
		$no_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$no_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_no.'.png" border="0">';

	//公開日付
	if ( $columns_mds == 'asc'){
		$arr_params = array ('title' => '','mds' => 'desc','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => 'asc','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}
		$date_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$date_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_mds.'.png" border="0">';


	//更新日付
	if ( $columns_mds2== 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => 'desc','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => 'asc','kkk' => '','no' => '','kds' => '','siy' => '','sik' => '');
	}
		$datek_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$datek_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_mds2.'.png" border="0">';

	//掲載期限日
	if ( $columns_kds == 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => 'desc','siy' => '','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => 'asc','siy' => '','sik' => '');
	}
		$date2_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$date2_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_kds.'.png" border="0">';

	//成約日
	if ( $columns_siy == 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => 'desc','sik' => '');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => 'asc','sik' => '');
	}
		$date3_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$date3_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_siy.'.png" border="0">';

	//市区
	if ( $columns_sik == 'asc'){
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => 'desc');
	}else{
		$arr_params = array ('title' => '','mds' => '','mds2' => '','kkk' => '','no' => '','kds' => '','siy' => '','sik' => 'asc');
	}
		$sik_url = esc_url(add_query_arg($arr_params, $_SERVER['REQUEST_URI']));
		$sik_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_'.$columns_sik.'.png" border="0">';


	if ( empty($columns_title) && empty($columns_kkk) && empty($columns_no) && empty($columns_mds) && empty($columns_mds2) && empty($columns_kds) && empty($columns_siy) && empty($columns_sik) ){
		$date_img = '<img src="../wp-content/plugins/fudou/img/sortbtm_desc.png" border="0">';
	}

	if( FUDOU_TRA_COMMENT ){
		$columns = array(
			'cb' => '<input type="checkbox"/>',
			'title' => '</a>タイトル<a href="#" onclick="location.href=\''.$title_url.'\'">'.$title_img.'</a>',
			'image' => '画像',
			'bukken' => '物件番号<a href="#" onclick="location.href=\''.$no_url.'\'">'.$no_img.'</a> <br />市区<a href="#" onclick="location.href=\''.$sik_url.'\'">'.$sik_img.'</a> 路線駅',
			'kakaku' => '種別　価格<a href="#" onclick="location.href=\''.$kakaku_url.'\'">'.$kakaku_img.'</a> <br />間取 地図',
			'bukken_tag' => '物件カテゴリ<br />物件投稿タグ',
			'newdate' => '</a>公開日<a href="#" onclick="location.href=\''.$date_url.'\'">'.$date_img.'</a> <br />更新日<a href="#" onclick="location.href=\''.$datek_url.'\'">'.$datek_img.'</a>',
			'keisaikigenbi' => '掲載期限日<a href="#" onclick="location.href=\''.$date2_url.'\'">'.$date2_img.'</a><br />成約日<a href="#" onclick="location.href=\''.$date3_url.'\'">'.$date3_img.'</a>',
			'comments' => __('Comments'), 
		);
	}else{
		$columns = array(
			'cb' => '<input type="checkbox"/>',
			'title' => '</a>タイトル<a href="#" onclick="location.href=\''.$title_url.'\'">'.$title_img.'</a>',
			'image' => '画像',
			'bukken' => '物件番号<a href="#" onclick="location.href=\''.$no_url.'\'">'.$no_img.'</a> <br />市区<a href="#" onclick="location.href=\''.$sik_url.'\'">'.$sik_img.'</a> 路線駅',
			'kakaku' => '種別　価格<a href="#" onclick="location.href=\''.$kakaku_url.'\'">'.$kakaku_img.'</a> <br />間取　地図',
			'bukken_tag' => '物件カテゴリ <br />物件投稿タグ',
			'newdate' => '</a>公開日<a href="#" onclick="location.href=\''.$date_url.'\'">'.$date_img.'</a> <br />更新日<a href="#" onclick="location.href=\''.$datek_url.'\'">'.$datek_img.'</a>',
			'keisaikigenbi' => '掲載期限日<a href="#" onclick="location.href=\''.$date2_url.'\'">'.$date2_img.'</a> <br />成約日<a href="#" onclick="location.href=\''.$date3_url.'\'">'.$date3_img.'</a>',
		);
	}	
	return $columns;
}
add_filter('manage_edit-fudo_columns', 'my_fudo_columns');


/*
 * 物件一覧 カラム
 *
 * Version: 1.7.12
 */
function my_fudo_column($column){
	global $post;
	global $wpdb;
	global $is_fudoukaiin_vip;

	$img_path = get_option('upload_path');
	if ($img_path == '')
		$img_path = 'wp-content/uploads';

	if('image' == $column){
		echo '<style>.sorting-indicator {background-image : none;display: none; height:  auto; margin: auto; width: auto;}</style>';

		for( $imgid=1; $imgid<=2; $imgid++ ){

			$fudoimg_data = get_post_meta($post->ID, "fudoimg$imgid", true);
			$fudoimgcomment_data = get_post_meta($post->ID, "fudoimgcomment$imgid", true);

			if( $fudoimg_data !="" ){

				/*
				 * Add url fudoimg_data Pre
				 *
				 * Version: 1.7.12
				 *
				 **/
				$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post->ID );

				//Check URL
				if ( checkurl_fudou( $fudoimg_data )) {
					echo '<img src="' . $fudoimg_data . '" alt="' . $fudoimg_data . '" title="' . $fudoimg_data . '" width="64" height="64" />';
				}else{
				//Check attachment

					$sql  = "";
					$sql .=  "SELECT P.ID,P.guid";
					$sql .=  " FROM $wpdb->posts AS P";
					$sql .=  " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
				//	$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );

					$attachmentid = '';
					if ( $metas != '' ){
						$attachmentid  =  $metas->ID;
						$guid_url  =  $metas->guid;
					}

					if($attachmentid !=''){
						//thumbnail、medium、large、full 
						$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, 'thumbnail');
						$fudoimg_url = $fudoimg_data1[0];
						if($fudoimg_url !=''){
							echo '<img src="' . $fudoimg_url.'" alt="'.$fudoimg_data.'" title="'.$fudoimg_data.'" width="64" height="64" />';
						}else{
							echo '<img src="' . $guid_url . '" alt="'.$fudoimg_data.'" title="'.$fudoimg_data.'" width="64" height="64"/>';
						}

					}else{
						/*
						 * Add url fudoimg_data
						 *
						 * Version: 1.7.12
						 *
						 **/
						$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $post->ID );

						if ( checkurl_fudou( $fudoimg_data )) {
							echo '<img src="' . $fudoimg_data . '" alt="' . $fudoimg_data . '" title="' . $fudoimg_data . '" width="64" height="64" />';
						}else{
							echo '<img src="' . WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" width="64" height="64" />';
						}
					}
				}
			}
		}
		echo "\n";
	} 

	elseif ("bukken" == $column){
		//物件番号
		echo '番号:'.get_post_meta($post->ID, 'shikibesu', true).'';

		//市区
		admin_custom_shozaichi_print($post->ID);
		echo get_post_meta($post->ID, 'shozaichimeisho', true);


		//町名
		admin_custom_choimei_print( $post->ID );

		//路線・駅
		admin_custom_koutsu1_print( $post->ID );
		admin_custom_koutsu2_print( $post->ID );

		//バス路線
		$buscorse_busstop1 = apply_filters( 'fudoubus_buscorse_busstop_single', '', $post->ID, 1 );
		if( $buscorse_busstop1 ){
			echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/bus_o.png">';
			echo $buscorse_busstop1;
		}
		$buscorse_busstop2 = apply_filters( 'fudoubus_buscorse_busstop_single', '', $post->ID, 2 );
		if( $buscorse_busstop2 ){
			echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/bus_b.png">';
			echo $buscorse_busstop2;
		}

	}
	elseif ("kakaku" == $column){ 

		//物件種別
		global $work_bukkenshubetsu;
		$bukkenshubetsu_dat = '';
		$bukkenshubetsu_id = get_post_meta($post->ID,'bukkenshubetsu',true);
		foreach($work_bukkenshubetsu as $meta_box){
			if( $bukkenshubetsu_id ==  $meta_box['id'] ){
				$bukkenshubetsu_dat = ' ' . $meta_box['name'];
				break;
			}
		}
		if( $bukkenshubetsu_dat ){
			echo $bukkenshubetsu_dat;
		}else{
			echo ' <font color="#FF0000">未設定</font>';
		}


		//価格 v1.7.12
		echo "<br />";
		$kakaku_data = get_post_meta($post->ID,'kakaku',true);
		if( is_numeric( $kakaku_data ) ){
			if ( function_exists( 'fudou_money_format_ja' ) ) {
				// Money Format 億万円 表示
				echo apply_filters( 'fudou_money_format_ja', $kakaku_data );
			}else{
				echo floatval($kakaku_data)/10000;
				echo "万円";
			}
		}
		if(get_post_meta($post->ID,'kakakujoutai',true)=="1"){   echo ' <font color="#0000FF">相談</font>';  }
		if(get_post_meta($post->ID,'kakakujoutai',true)=="2"){   echo ' <font color="#0000FF">確定</font>'; }
		if(get_post_meta($post->ID,'kakakujoutai',true)=="3"){   echo ' <font color="#0000FF">入札</font>';  }


		//間取り
		echo "<br />";
		echo get_post_meta($post->ID,'madorisu',true);
		global $work_madori;
		$madorisyurui_id = get_post_meta($post->ID,'madorisyurui',true);
		foreach($work_madori as $meta_box2){
			if( $madorisyurui_id ==  $meta_box2['code'] ){
				echo ' ' . $meta_box2['name'];
			}
		}

		//面積
		$tatemonomenseki_data = get_post_meta($post->ID,'tatemonomenseki',true);
		if ($tatemonomenseki_data !="")
			echo ' ('.$tatemonomenseki_data.'㎡)';

		echo "<br />";

		//地図
		if( get_post_meta($post->ID, 'bukkenido', true)!="" && get_post_meta($post->ID, 'bukkenkeido', true)!="")
			echo '<font color="#0000FF">地図有</font>　';

		//会員マーク
		if( get_post_meta($post->ID, 'kaiin', true ) == 1 ){
			if( $is_fudoukaiin_vip ){
				echo '<span class="fudo_kaiin_type_logo member sbutton_jp fudoukaiin_mk_kaiin">会員</span>';
			}else{
				echo '<font color="#FF0000">会員</font>';
			}
			echo '<span id="kaiin-' . $post->ID . '" style="display:none">1</span>';
		}
		//会員VIP
		do_action( 'kaiin_level_column', $post->ID );


		//校区
		do_action( 'kouku_print', $post->ID );


	}

	elseif ("bukken_tag" == $column){
		the_terms(0, 'bukken');
		echo '<br /><hr />';
		the_terms(0, 'bukken_tag');
		echo "\n";
	}

	elseif ("keisaikigenbi" == $column){
		echo get_post_meta($post->ID,'keisaikigenbi',true).'<br />';
			echo '<hr />';
		echo get_post_meta($post->ID,'seiyakubi',true);
		echo "\n";
	}

	elseif ("newdate" == $column){

	//	$h_time = mysql2date( __( 'Y/m/d' ), $post->post_date );
	//	$m_time = mysql2date( __( 'Y/m/d' ), $post->post_modified );

		$h_time = mysql2date( 'Y/m/d', $post->post_date );
		$m_time = mysql2date( 'Y/m/d', $post->post_modified );

		//$time_diff
		if ( '0000-00-00 00:00:00' == $post->post_date ) {
			$time_diff = 0;
		} else {
			$time = get_post_time( 'G', true, $post );
			$time_diff = time() - $time;
		}


		echo '<abbr>公開日' . $h_time . '</abbr>';
		echo '<br />';
		echo '<abbr>更新日' . $m_time . '</abbr>';

		echo '<br />';
		if ( 'publish' == $post->post_status ) {
			_e( 'Published' );
		} elseif ( 'future' == $post->post_status ) {
			if ( $time_diff > 0 )
				echo '<strong class="attention">' . __( 'Missed schedule' ) . '</strong>';
			else
				_e( 'Scheduled' );
		} else {
			//_e( 'Last Modified' );
		}
		// 状態
		admin_custom_jyoutai_print($post->ID);

		//Auther
		do_action( 'user_view_column', get_userdata( $post->post_author ) );

	}
}
add_action('manage_posts_custom_column', 'my_fudo_column');





/*
 * 物件投稿一覧フィルター
 *
 * select表示
 */
function shubetsu_restrict_manage_posts() {

	global $post_type;
	global $wpdb;

	if( $post_type == 'fudo') {

		$shubetsu = isset($_GET['shubetsu']) ? $_GET['shubetsu'] : '';
		?>
		 <select name="shubetsu" class='postform'>
			<option value="1"<?php if( $shubetsu == "1"){echo ' selected="selected"';} ?>>物件すべて</option>
			<option value="2"<?php if( $shubetsu == "2"){echo ' selected="selected"';} ?>>売買すべて</option>
			<option value="3"<?php if( $shubetsu == "3"){echo ' selected="selected"';} ?>>　売買土地</option>
			<option value="4"<?php if( $shubetsu == "4"){echo ' selected="selected"';} ?>>　売買戸建</option>
			<option value="5"<?php if( $shubetsu == "5"){echo ' selected="selected"';} ?>>　売買マンション</option>
			<option value="6"<?php if( $shubetsu == "6"){echo ' selected="selected"';} ?>>　売買住宅以外の建物全部</option>
			<option value="7"<?php if( $shubetsu == "7"){echo ' selected="selected"';} ?>>　売買住宅以外の建物一部</option>
			<option value="10"<?php if( $shubetsu == "10"){echo ' selected="selected"';} ?>>賃貸すべて</option>
			<option value="11"<?php if( $shubetsu == "11"){echo ' selected="selected"';} ?>>　賃貸居住用</option>
			<option value="12"<?php if( $shubetsu == "12"){echo ' selected="selected"';} ?>>　賃貸事業用</option>

			<?php
			//CSVタイプ
			$sql  = " SELECT DISTINCT PM.meta_value AS csvtype";
			$sql .= " FROM $wpdb->posts AS P";
			$sql .= " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id ";
			$sql .= " WHERE P.post_type ='fudo'";
			$sql .= " AND PM.meta_key='csvtype'";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );

			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
					$csvtype = $meta['csvtype'];

					if( $csvtype ){
						echo '<option value="'.$csvtype.'"';
							
						if ($shubetsu == $csvtype ){
							 echo ' selected="selected"';
						}

						switch ($csvtype) {
							case "homes" :		echo '>ホームズ</option>'; break;
							case "h_rains" :	echo '>東日本レインズ</option>'; break;
							case "c_rains" :	echo '>中部レインズ</option>'; break;
							case "k_rains2" :	echo '>新近畿レインズ</option>'; break;
							case "n_rains" :	echo '>西日本レインズ</option>'; break;
							case "c21" :		echo '>センチュリー21</option>'; break;
							case "apaman" :		echo '>アパマン</option>'; break;
							case "fudoucsv" :	echo '>汎用CSV</option>'; break;
							case "k_rains" :	echo '>旧近畿レインズ</option>'; break;
							case "z_rains" :	echo '>レインズ</option>'; break;
							default:		echo '>'.$csvtype.'</option>';	break;
						}
					}
				}
			}
			?>
		</select>
		<style type="text/css">
		<!--
		#wpbody-content th#title a{display:inline;}
		#wpbody-content th#date a{display:inline;}
		-->
		</style>
		<?php
	}
}
add_action('restrict_manage_posts', 'shubetsu_restrict_manage_posts');

/*
 * 物件投稿一覧フィルター
 *
 * SQL where
 */
function shubetsu_posts_where($where) {

	if( is_admin() ) {
		global $wpdb;
		$where_data = "";

		$shubetsu = isset($_GET['shubetsu']) ? esc_sql(esc_attr( $_GET['shubetsu'] )) : '';

		switch ($shubetsu) {

			case "1" :	//物件すべて
				$postmeta_name = "bukkenshubetsu";
				break;
			case "2" :	//売買すべて
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND CAST( PM.meta_value AS SIGNED )<3000";
				break;
			case "3" :	//売買土地
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='11'";
				break;
			case "4" :	//売買戸建
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='12'";
				break;
			case "5" :	//売買マンション
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='13'";
				break;
			case "6" :	//売住宅以外の建物全部
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='14'";
				break;
			case "7" :	//売住宅以外の建物一部
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='15'";
				break;
			case "10" :	//賃貸すべて
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND  CAST( PM.meta_value AS SIGNED )>3000";
				break;
			case "11" :	//賃貸居住用
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='31'";
				break;
			case "12" :	//賃貸事業用
				$postmeta_name = "bukkenshubetsu";
				$where_data = " AND Left(PM.meta_value,2) ='32'";
				break;

			case "homes" :	//ホームズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='homes'";
				break;

			case "k_rains" :	//近畿レインズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='k_rains'";
				break;

			case "h_rains" :	//東日本レインズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='h_rains'";
				break;

			case "n_rains" :	//西日本レインズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='n_rains'";
				break;

			case "c_rains" :	//中部レインズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='c_rains'";
				break;

			case "c21" :	//センチュリー21
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='c21'";
				break;

			case "k_rains2" :	//近畿レインズ新システム
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='k_rains2'";
				break;

			case "z_rains" :	//全国レインズ
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='z_rains'";
				break;

			case "fudoucsv" :	//汎用CSV
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='fudoucsv'";
				break;

			case "apaman" :	//アパマン
				$postmeta_name = "csvtype";
				$where_data = " AND PM.meta_value ='apaman'";
				break;

			default:
				$postmeta_name = "bukkenshubetsu";
				break;
		}


		//未知のCSVタイプ $shubetsu 数値以外
		//if( $postmeta_name == "bukkenshubetsu" && !ctype_digit( $shubetsu ) ){
		if( $postmeta_name == "bukkenshubetsu" && !myIsNum_f( $shubetsu ) ){
			$postmeta_name = "csvtype";
			$where_data = " AND PM.meta_value ='" . esc_sql( $shubetsu ) . "'";
		}

		$sql = "";
		$sql = $sql . " SELECT DISTINCT (P.ID)";
		$sql = $sql . " FROM $wpdb->posts AS P";
		$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id ";
		$sql = $sql . " WHERE PM.meta_key='$postmeta_name'";
		$sql = $sql . " AND P.post_type ='fudo'";
		$sql = $sql . $where_data;

		if( $shubetsu != "" ) {
			$where .= " AND ID IN ( ".$sql." )";
		}
	}
	return $where;
}
add_filter('posts_where', 'shubetsu_posts_where');




//物件投稿一覧ソート ASC/DESC
function wp_order_by_order_fudou($orderby) {

	if( is_admin() ) {
		global $wpdb;

		//タイトル
		if ( isset($_GET['title']) && $_GET['title'] == 'asc' ){
			$orderby = "$wpdb->posts.post_title ASC";
		}
		if ( isset($_GET['title']) && $_GET['title'] == 'desc'){
			$orderby = "$wpdb->posts.post_title DESC";
		}

		//公開日付
		if ( isset($_GET['mds']) && $_GET['mds'] == 'asc' ){
			$orderby = "$wpdb->posts.post_date ASC";
		}
		if ( isset($_GET['mds']) && $_GET['mds'] == 'desc' ){
			$orderby = "$wpdb->posts.post_date DESC";
		}

		//更新日付
		if ( isset($_GET['mds2']) && $_GET['mds2'] == 'asc' ){
			$orderby = "$wpdb->posts.post_modified ASC";
		}
		if ( isset($_GET['mds2']) && $_GET['mds2'] == 'desc' ){
			$orderby = "$wpdb->posts.post_modified DESC";
		}

		//価格
		if ( isset($_GET['kkk']) && $_GET['kkk'] == 'asc' ){
			$orderby = "CAST(PM.meta_value AS SIGNED) ASC";
		}
		if ( isset($_GET['kkk']) && $_GET['kkk'] == 'desc' ){
			$orderby = "CAST(PM.meta_value AS SIGNED) DESC";
		}

		//物件番号
		if ( isset($_GET['no']) && $_GET['no'] == 'asc' ){
			$orderby = "PM.meta_value ASC";
		}
		if ( isset($_GET['no']) && $_GET['no'] == 'desc' ){
			$orderby = "PM.meta_value DESC";
		}

		//掲載期限日
		if ( isset($_GET['kds']) && $_GET['kds'] == 'asc' ){
			$orderby = "PM.meta_value ASC";
		}
		if ( isset($_GET['kds']) && $_GET['kds'] == 'desc' ){
			$orderby = "PM.meta_value DESC";
		}

		//成約日
		if ( isset($_GET['siy']) && $_GET['siy'] == 'asc' ){
			$orderby = "PM.meta_value ASC";
		}
		if ( isset($_GET['siy']) && $_GET['siy'] == 'desc' ){
			$orderby = "PM.meta_value DESC";
		}

		//市区
		if ( isset($_GET['sik']) && $_GET['sik'] == 'asc' ){
			$orderby = "PM.meta_value ASC, PM_S.meta_value ASC";
		}
		if ( isset($_GET['sik']) && $_GET['sik'] == 'desc' ){
			$orderby = "PM.meta_value DESC, PM_S.meta_value DESC";
		}
	}
	return $orderby;
}
add_filter( 'posts_orderby', 'wp_order_by_order_fudou', 999 );

//物件投稿一覧ソート JOIN
function wp_order_by_join_fudou( $join ){
	if( is_admin() ) {
		global  $wpdb;
		if( ( isset($_GET['kkk']) && $_GET['kkk'] != '' ) || ( isset($_GET['no']) && $_GET['no'] != '' ) || ( isset($_GET['kds']) && $_GET['kds'] != '' ) || ( isset($_GET['siy']) && $_GET['siy'] != '' ) || ( isset($_GET['sik']) && $_GET['sik'] != '' ) ){
			//$join .= " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id";
			$join .= " INNER JOIN $wpdb->postmeta AS PM ON $wpdb->posts.ID = PM.post_id";
		}
		if ( isset($_GET['sik']) && $_GET['sik'] != '' ){
			//$join .= " LEFT JOIN $wpdb->postmeta AS PM ON " . $wpdb->posts . ".ID = PM.post_id ";
			$join .= " INNER JOIN $wpdb->postmeta AS PM_S ON $wpdb->posts.ID = PM_S.post_id ";
		}
	}
	return $join;
}
add_filter('posts_join', 'wp_order_by_join_fudou' );

//物件投稿一覧ソート WHERE
function wp_order_by_where_fudou( $where ){
	if( is_admin() ) {
		global  $wpdb;
		//価格
		if( isset($_GET['kkk']) && $_GET['kkk'] != ''){
			$where .= " AND PM.meta_key = 'kakaku'";
		}
		//物件番号
		if( isset($_GET['no']) && $_GET['no'] != ''){
			$where .= " AND PM.meta_key = 'shikibesu'";
		}
		//掲載期限日
		if( isset($_GET['kds']) && $_GET['kds'] != ''){
			$where .= " AND PM.meta_key = 'keisaikigenbi'";
		}
		//成約日
		if( isset($_GET['siy']) && $_GET['siy'] != ''){
			$where .= " AND PM.meta_key = 'seiyakubi' ";
		}
		//市区
		if( isset($_GET['sik']) && $_GET['sik'] != ''){
			$where .= " AND PM.meta_key = 'shozaichicode' ";
			$where .= " AND PM_S.meta_key = 'shozaichimeisho' ";
		}
	}
	return $where;
}
add_filter('posts_where', 'wp_order_by_where_fudou' );

//重複表示対策
function admin_search_distinct_fudou( $distinct, $query ){

	$distinct_type = false;
	$post_type = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

	//s
	if( isset($_GET['s']) && $_GET['s'] != '' ){
		$distinct_type = true;
	}
	//価格
	if( isset($_GET['kkk']) && $_GET['kkk'] != ''){
		$distinct_type = true;
	}
	//物件番号
	if( isset($_GET['no']) && $_GET['no'] != ''){
		$distinct_type = true;
	}
	//掲載期限日
	if( isset($_GET['kds']) && $_GET['kds'] != ''){
		$distinct_type = true;
	}
	//成約日
	if( isset($_GET['siy']) && $_GET['siy'] != ''){
		$distinct_type = true;
	}
	//市区
	if( isset($_GET['sik']) && $_GET['sik'] != ''){
		$distinct_type = true;
	}

	if( is_admin() && $post_type == 'fudo' && $distinct_type ){
		return 'DISTINCT';
	}
	return $distinct;
}
add_filter( 'posts_distinct', 'admin_search_distinct_fudou', 10, 2 );



/**
 * admin 所在地
 *
 * @since Fudousan Plugin 1.6.0
 *
 * @param int $post_id Post ID.
 */
function admin_custom_shozaichi_print($post_id) {
	global $wpdb;

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($shozaichiken_data=="")
		$shozaichiken_data = get_post_meta($post_id,'shozaichiken',true);

	if(!empty($shozaichiken_data)){
		$sql = "SELECT middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE . " WHERE middle_area_id=".$shozaichiken_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ){
			echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/house_icon.png">';
			echo "".$metas->middle_area_name." ";
		}
	}

	$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichicode_data = myLeft($shozaichicode_data,5);
	$shozaichicode_data = myRight($shozaichicode_data,3);

	if($shozaichiken_data !="" && $shozaichicode_data !=""){
		$sql = "SELECT narrow_area_name FROM ". $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->narrow_area_name;
	}
}




/**
 * admin 路線 駅
 *
 * @since Fudousan Plugin 1.6.0
 *
 * @param int $post_id Post ID.
 */
function admin_custom_koutsu1_print($post_id) {
	global $wpdb;

	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki1', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($koutsurosen_data !=""){
		$sql = "SELECT rosen_name FROM ". $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ){
			echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/train_icon.png">';
			echo "".$metas->rosen_name." ";
		}
	}

	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->station_name.'';
	}
}
function admin_custom_koutsu2_print($post_id) {
	global $wpdb;

	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen2', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki2', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($koutsurosen_data !=""){
		$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ){
			echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/train_icon.png">';
			echo "".$metas->rosen_name." ";
		}
	}

	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->station_name.'';
	}
}

/**
 * admin 状態
 *
 * @since Fudousan Plugin 1.0.0
 *
 * @param int $post_id Post ID.
 */
function admin_custom_jyoutai_print($post_id) {
	$jyoutai_data = get_post_meta($post_id,'jyoutai',true);
	if($jyoutai_data=="1")  echo '<br />状態：空有/売出中';
	if($jyoutai_data=="3")  echo '<br />状態：空無/売止';
	if($jyoutai_data=="4")  echo '<br />状態：成約';
	if($jyoutai_data=="9")  echo '<br />状態：削除';
}

/**
 * admin 町名
 *
 * @since Fudousan Plugin 1.7.2
 *
 * @param int $post_id Post ID.
 */
function admin_custom_choimei_print($post_id) {

	global $wpdb;
	global $is_fudouchoumei;
	
	if( $is_fudouchoumei ){

		$choumei_id = get_post_meta( $post_id, 'choumei', true );

		$ken_id = get_post_meta( $post_id, 'shozaichicode', true );
		$ken_id = myLeft( $ken_id, 2 );

		if( !$ken_id )
			$ken_id = get_post_meta( $post_id, 'shozaichiken', true );

		$ken_prefix   =  sprintf( "%02d", $ken_id );
		//テーブル
		$table_name1 = $wpdb->prefix . $ken_prefix . DB_CHOUMEI_TABLE;

		//テーブルチェック
		$results1 = $wpdb->get_var( "show tables like '$table_name1'" ) ;

		if( $results1 && $choumei_id ){

			//SQL
			$sql  = "SELECT choumei_name";
			$sql .= " FROM " . $table_name1 . " ";
			$sql .= " WHERE ken_id = " . intval( $ken_id ) . "";
			$sql .= " AND choumei_use=1 ";
			$sql .= " AND choumei_id = " . $choumei_id . "";
			$sql .= " ORDER BY choumei_id";
			//$sql = $wpdb->prepare($sql,'');
			$meta = $wpdb->get_row( $sql );
			if(!empty( $meta )) {
				echo '<br /><img src="' . WP_PLUGIN_URL . '/fudou/img/loupe_icon.png">町名(' . $meta->choumei_name . ')';
			}
		}
	}
}



//物件投稿一覧フィルター(カテゴリ)
function cat_restrict_manage_posts_fudou() {

	global $post_type;
	global $wpdb;

	if( $post_type == 'fudo') {
		$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';

		echo '<select name="cat_id" class="postform">';
		echo '<option value="">カテゴリ・タグすべて</option>';

		$sql = "SELECT DISTINCT T.term_id , T.name ";
		$sql .=  " FROM ($wpdb->postmeta AS PM";
		$sql .=  " INNER JOIN (($wpdb->terms AS T";
		$sql .=  " INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ";
		$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON PM.post_id = TR.object_id)";
		$sql .=  " INNER JOIN $wpdb->posts AS P ON PM.post_id = P.ID";
		$sql .=  " WHERE P.post_type ='fudo'";
		$sql .=  " AND TT.taxonomy ='bukken'";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {
			echo '<optgroup label="物件カテゴリ"> ';
			foreach ( $metas as $meta ) {
				echo '<option value="'.$meta['term_id'].'"';
				if( $cat_id == $meta['term_id'] ) echo ' selected="selected"';
				echo '>　'.$meta['name'].'</option>';
			}
			echo '</optgroup>';
		}

		//echo '<option value="">物件タグ</option>';
		$sql = "SELECT DISTINCT T.term_id , T.name ";
		$sql .=  " FROM ($wpdb->postmeta AS PM";
		$sql .=  " INNER JOIN (($wpdb->terms AS T";
		$sql .=  " INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ";
		$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON PM.post_id = TR.object_id)";
		$sql .=  " INNER JOIN $wpdb->posts AS P ON PM.post_id = P.ID";
		$sql .=  " WHERE P.post_type ='fudo'";
		$sql .=  " AND TT.taxonomy ='bukken_tag'";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {
			echo '<optgroup label="物件タグ"> ';
			foreach ( $metas as $meta ) {
				echo '<option value="'.$meta['term_id'].'"';
				if( $cat_id == $meta['term_id'] ) echo ' selected="selected"';
				echo '>　'.$meta['name'].'</option>';
			}
			echo '</optgroup>';
		}

		echo '</select>';
	}
}
add_action('restrict_manage_posts', 'cat_restrict_manage_posts_fudou');

function cat_posts_where_fudou($where) {

	if( is_admin() ) {
		global $wpdb;
		$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';

		if( $cat_id != "" ) {
			$sql = "SELECT DISTINCT P.ID";
			$sql .=  " FROM ($wpdb->postmeta AS PM";
			$sql .=  " INNER JOIN (($wpdb->terms AS T";
			$sql .=  " INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ";
			$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON PM.post_id = TR.object_id)";
			$sql .=  " INNER JOIN $wpdb->posts AS P ON PM.post_id = P.ID";
			$sql .=  " WHERE T.term_id=".$cat_id."";
			$sql .=  " AND P.post_type ='fudo'";

			$where .= " AND ID IN ( ".$sql." )";
		}
	}
	return $where;
}
add_filter('posts_where', 'cat_posts_where_fudou');




