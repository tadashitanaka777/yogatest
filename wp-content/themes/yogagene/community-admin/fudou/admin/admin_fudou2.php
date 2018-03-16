<?php
/*
 * 不動産プラグイン管理画面設定2
 * @package WordPress4.6
 * @subpackage Fudousan Plugin
 * Version: 1.7.6
*/

/**
 * 不動産プラグインツール
 *
 * Version: 1.7.6
 */
if( is_admin() ){
	new FudouPlugin2();
}
class FudouPlugin2 {

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
		add_management_page( 'admin_tool_fudou', '不動産プラグインツ-ル', 'edit_pages', __FILE__, array($this, 'form' ) );
	}


	function form() {
		global $post;
		global $wpdb;
		global $work_bukkenshubetsu;
		global $is_fudoukaiin;

	?>


	<div class="wrap">
		<div id="icon-tools" class="icon32"><br /></div>
		<h2>不動産プラグインツール</h2>
		<div id="poststuff">

		<div id="post-body">
		<div id="post-body-content">

			<br />

			<form name="ex" id="ex"  method="post" action="<?php echo WP_PLUGIN_URL;?>/fudou/admin_phpex.php">
		        <input name="typ" type="hidden" value="1" />

		        <b>物件リスト</b>　
			物件リストをエクセルで保存できます。<br /><br />

			<?php
			//種別選択
			echo '種別と項目(ショート/フル)を選択して下さい<br />';
			echo '<select name="shu" id="shu" onchange="consent_check1()">';
			echo '<option value="0">種別選択</option>';

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
			$sql .=  " WHERE P.post_type ='fudo' AND P.post_status != 'trash'";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' ";
			$sql .=  " ORDER BY PM.meta_value";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];
					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							echo '<option value="'.$meta_box['id'].'">'.$meta_box['name'].'</option>';
						}
					}
				}
			}
			echo '<option value="1">売買すべて</option>';
			echo '<option value="2">賃貸すべて</option>';
			echo '</select>';

			echo '<select name="ex" id="ex">';
			echo '<option value="0">ショート</option>';
			echo '<option value="1">フル</option>';
			echo '</select>';
			?>
			<input type="submit" name="btn1" id="btn1" class="button-primary" value="送信"  />
		</form>
		</div>

		<?php do_action('fudou_plugin_tool'); ?>

		<div id="post-body-content">

			<form name="motoex" id="motoex"  method="post" action="<?php echo WP_PLUGIN_URL;?>/fudou/admin_phpex.php">
		        <input name="typ" type="hidden" value="2" />
			<br />
		        <b>元付別物件リスト</b>　
			物件リストをエクセルで保存できます。<br /><br />

			<?php
			//種別選択
			echo '種別と元付と項目(ショート/フル)を選択して下さい<br />';
			echo '<select name="shu" id="shu" onchange="mot_shu(this)">';
			echo '<option value="0">種別選択</option>';

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_16 ON P.ID = PM_16.post_id ";
			$sql .=  " WHERE P.post_type ='fudo' AND P.post_status != 'trash'";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND PM.meta_value < 3000 ";
			$sql .=  " AND PM_16.meta_key='motozukemei' AND PM_16.meta_value != '' ";
			$sql .=  " ORDER BY PM.meta_value";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {
				echo '<option value="1">売買全て</option>';
				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];
					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							echo '<option value="'.$meta_box['id'].'">'.$meta_box['name'].'</option>';
						}
					}
				}
			}

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_16 ON P.ID = PM_16.post_id ";
			$sql .=  " WHERE P.post_type ='fudo' AND P.post_status != 'trash'";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND PM.meta_value > 3000 ";
			$sql .=  " AND PM_16.meta_key='motozukemei' AND PM_16.meta_value != '' ";
			$sql .=  " ORDER BY PM.meta_value";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {
				echo '<option value="2">賃貸全て</option>';
				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];
					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							echo '<option value="'.$meta_box['id'].'">'.$meta_box['name'].'</option>';
						}
					}
				}
			}
			echo '</select>';

			echo '<select name="mot" id="mot" onchange="consent_check2()">';
			echo '<option value="0">元付選択</option>';
			echo '</select>';

			echo '<select name="ex" id="ex">';
			echo '<option value="0">ショート</option>';
			echo '<option value="1">フル</option>';
			echo '</select>';

			?>
			<input type="submit" name="btn2" id="btn2" class="button-primary" value="送信"  />
			</form>

		</div>


		<?php if($is_fudoukaiin) {?>

		<div id="post-body-content">

			<form name="motoexu" id="motoexu"  method="post" action="<?php echo WP_PLUGIN_URL;?>/fudou/admin_phpex_user.php">
		        <input name="typ" type="hidden" value="3" />
			<br />
		        <b>会員リスト</b>　
			会員リストをエクセルで保存できます。<br /><br />

			<input type="submit" name="btn3" id="btn3" class="button-primary" value="送信"  />
			</form>
		</div>
		<?php } ?>




		<div id="post-body-content">

			<form name="motoexu" id="motoexu"  method="post" action="" onsubmit="return confirm_keisaikigenbi()">
		        <input name="typ" type="hidden" value="4" />
			<br />
		        <b>掲載期限日一括更新</b>　
			掲載期限日を一括更新で更新します。<br /><br />

		<?php

			$keisaikigenbi = isset($_POST['keisaikigenbi']) ? $_POST['keisaikigenbi'] : '';
			$k_draft =       isset($_POST['draft']) ? myIsNum_f($_POST['draft']) : '';
			$k_publish =     isset($_POST['publish']) ? myIsNum_f($_POST['publish']) : '';

			if( $k_draft !='' || $k_publish !='' ){

				$sql = "SELECT DISTINCT P.ID";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
				$sql .=  " WHERE P.post_type ='fudo' ";

				if( $k_draft == '1' && $k_publish != '1'){
					$sql .=  " AND P.post_status='draft' ";
				}
				if( $k_draft != '1' && $k_publish == '1'){
					$sql .=  " AND P.post_status='publish' ";
				}
				if( $k_publish == '1' && $k_draft == '1'){
					$sql .=  " AND ( P.post_status='publish' OR P.post_status='draft' )";
				}

		//		$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );
				$i=0;
				if(!empty($metas)) {
					foreach ( $metas as $meta ) {
						update_post_meta($meta['ID'], 'keisaikigenbi',$keisaikigenbi);
						$i++;
					}
				}
				echo '<div id="message" class="updated fade"><p><strong>掲載期限日 '.$i.'件 更新しました</strong></p></div>';
			}

		?>
			更新対象　　
			<input name="draft" type="checkbox" value="1" /> 下書き　
			<input name="publish" type="checkbox" value="1" /> 公開 
			<br />
			掲載期限日 <input name="keisaikigenbi" type="text" value="" /> (yyyy/mm/ddの形式)<br />
			*空欄にすると掲載期限日が削除されます。
			<input type="submit" name="btn4" id="btn4" class="button-primary" value="送信"  />
			</form>
			<script  type="text/javascript">
			<!-- <![CDATA[
				function confirm_keisaikigenbi() {
					res = confirm("掲載期限日を更新します。よろしいですか？");
					if (res == true) {
						return true;
					} else {
						return false;
					}
				}
			// ]]> -->
			</script>

		</div>
		</div>


	</div>

	<script type="text/javascript">

		function mot_shu(slct){
			var request;

				var getsite="<?php echo WP_PLUGIN_URL;?>/fudou/json/";

				var syoki1="元付選択";
				var data;

				//元付け
				var postDat = encodeURI("shu="+document.motoex.shu.options[slct.selectedIndex].value);
				request = new XMLHttpRequest();
			//	request = new createXmlHttpRequest(); 
				request.open("POST", getsite+"jsonmotozuke.php", true);
				request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
				request.send(postDat);
				request.onreadystatechange = function() {
					if (request.readyState == 4 && request.status == 200) {
						var id = null;
						var name = null;
						var val = null;
						motcodecrea();
						var jsDat = request.responseText;

						if(jsDat !=''){
							data = eval("("+jsDat+")");
							document.motoex.mot.options[0]=new Option(syoki1,"0",false,false);
							for(var i=0; i<data.motozuke.length; i++) {
								id = data.motozuke[i].id;
								name = data.motozuke[i].name;
								val = false;
								document.motoex.mot.options[i+1] = new Option(name,id,false,val);
							}
						}else{
							document.motoex.mot.options[0]=new Option(syoki1,"0",false,false);
						}
					}
					consent_check2();
				}

		}

		function motcodecrea(){
			var cnt = document.motoex.mot.length;
			for(var i=cnt; i>=0; i--) {
				document.motoex.mot.options[i] = null;
			}
		}

		consent_check1();
		consent_check2();

		function consent_check1() {
			if (document.ex.shu.options[document.ex.shu.selectedIndex].value == '0')
				document.ex.btn1.disabled = true;
			else 
				document.ex.btn1.disabled = false;
		}

		function consent_check2() {
			if (document.motoex.shu.options[document.motoex.shu.selectedIndex].value == '0')
				document.motoex.btn2.disabled = true;
			else 
				if (document.motoex.mot.options[document.motoex.mot.selectedIndex].value == '0')
					document.motoex.btn2.disabled = true;
				else
					document.motoex.btn2.disabled = false;
		}

	</script>

	<?php

    }
}
