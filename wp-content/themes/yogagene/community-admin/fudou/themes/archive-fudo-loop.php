<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * Template: archive-fudo-loop.php
 * 
 * @package WordPress4.8
 * @subpackage Fudousan Plugin
 * Version: 1.8.2
 *
 */


	//会員2
	$kaiin = 0;
	if( !is_user_logged_in() && get_post_meta($meta_id, 'kaiin', true) > 0 ) $kaiin = 1;
	//ユーザー別会員物件リスト
	$kaiin2 = users_kaiin_bukkenlist( $meta_id, $kaiin_users_rains_register, get_post_meta( $meta_id, 'kaiin', true ) );

	$_post = get_post( intval($meta_id) );

	//newup_mark
	$post_modified_date =  vsprintf("%d-%02d-%02d", sscanf($_post->post_modified, "%d-%d-%d"));
	$post_date =  vsprintf("%d-%02d-%02d", sscanf($_post->post_date, "%d-%d-%d"));
	$newup_mark_img=  '';
	if( $newup_mark != 0 && is_numeric($newup_mark) ){
		if( ( abs(strtotime($post_modified_date) - strtotime(date("Y/m/d"))) / (60 * 60 * 24) ) < $newup_mark ){
			if($post_modified_date == $post_date ){
				$newup_mark_img = '<div class="new_mark">new</div>';
			}else{
				$newup_mark_img =  '<div class="new_mark">up</div>';
			}
		}
	}
?>


<div class="list_simple_boxtitle">
	<h2 class="entry-title">

	<?php 
	//会員ロゴ
	if( get_post_meta($meta_id, 'kaiin', true) == 1 ) {
		$kaiin_logo = '<span class="fudo_kaiin_type_logo"><img src="' . WP_PLUGIN_URL . '/fudou/img/kaiin_s.jpg" alt="会員物件" /></span>';
		echo apply_filters( 'fudou_kaiin_logo_view', $kaiin_logo );
	} 
	?>
	<?php do_action( 'fudo_kaiin_type_logo', $meta_id ); 	//会員ロゴ ?>

	<?php if ( !my_custom_kaiin_view('kaiin_title',$kaiin,$kaiin2) ){ ?>
		<a href="<?php echo get_permalink($meta_id).$add_url; ?>" title="">会員物件<?php echo $newup_mark_img; ?></a>
	<?php }else{ ?>
		<a href="<?php echo get_permalink($meta_id).$add_url; ?>" title="<?php echo $meta_title; ?>" rel="bookmark"><?php echo $meta_title; ?><?php echo $newup_mark_img; ?></a>
	<?php } ?>
	</h2>
</div>


<div class="list_simple_box">
	<div class="entry-excerpt">
	<?php
		if ( my_custom_kaiin_view('kaiin_excerpt',$kaiin,$kaiin2) ){
			echo $_post->post_excerpt; 
		}
	?>
	</div>

	<!-- 左ブロック --> 
	<div class="list_picsam">

		<!-- 価格 -->
		<div class="dpoint1">
			<?php 
			//価格
			if ( !my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){
				echo "会員物件";
			}else{
				if( get_post_meta($meta_id, 'seiyakubi', true) != "" ){ echo 'ご成約済'; }else{  my_custom_kakaku_print($meta_id); } 
			} 
			?>
		</div>
		<div class="dpoint2">
		<?php
			//間取り
			if ( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) ){
				my_custom_madorisu_print($meta_id);
			}

			//面積
			if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){
				if(get_post_meta($meta_id, 'bukkenshubetsu', true) < 1200 ){
					if( get_post_meta($meta_id, 'tochikukaku', true) !="" ) echo '&nbsp;'.get_post_meta($meta_id, 'tochikukaku', true).'m&sup2; ';
				}else{
					if( get_post_meta($meta_id, 'tatemonomenseki', true) !="" ) echo '&nbsp;'.get_post_meta($meta_id, 'tatemonomenseki', true).'m&sup2; ';
				}
			}
		?>
		</div>


		<!-- 画像 -->
		<div class="list_picsam_img">
		<?php
			if ( !my_custom_kaiin_view('kaiin_gazo',$kaiin,$kaiin2) ){
				echo '<img src="'.WP_PLUGIN_URL.'/fudou/img/kaiin.jpg" alt="" />';
				echo '<img src="'.WP_PLUGIN_URL.'/fudou/img/kaiin.jpg" alt="" />';
			}else{
				//サムネイル画像
				$img_path = get_option('upload_path');
				if ($img_path == '')	$img_path = 'wp-content/uploads';

				for( $imgid=1; $imgid<=2; $imgid++ ){

					$fudoimg_data = get_post_meta($meta_id, "fudoimg$imgid", true);
					$fudoimgcomment_data = get_post_meta($meta_id, "fudoimgcomment$imgid", true);
					$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($meta_id, "fudoimgtype$imgid", true));

					if($fudoimg_data !="" ){

						/*
						 * Add url fudoimg_data Pre
						 *
						 * Version: 1.7.12
						 *
						 **/
						$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $meta_id );

						//Check URL
						if ( checkurl_fudou( $fudoimg_data )) {
							echo '<a href="' . $fudoimg_data . '" rel="lightbox['.$meta_id.'] lytebox['.$meta_id.']" title="'.$fudoimg_alt.'">';
							echo '<img class="box2image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" /></a>';
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

								echo '<a href="' . $guid_url . '" rel="lightbox['.$meta_id.'] lytebox['.$meta_id.']" title="'.$fudoimg_alt.'">';
								if($fudoimg_url !=''){
									echo '<img class="box2image" src="' . $fudoimg_url.'" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" />';
								}else{
									echo '<img class="box2image" src="' . $guid_url . '" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'"  />';
								}
								echo '</a>';
							}else{

								/*
								 * Add url fudoimg_data
								 *
								 * Version: 1.7.12
								 *
								 **/
								$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $meta_id );

								if ( checkurl_fudou( $fudoimg_data )) {
									echo '<a href="' . $fudoimg_data . '" rel="lightbox['.$meta_id.'] lytebox['.$meta_id.']" title="'.$fudoimg_alt.'">';
									echo '<img class="box2image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
									echo '</a>';
								}else{
									echo '<img class="box2image" src="' . WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" />';
								}

							}
						}

					}else{
						echo '<img class="box2image" src="'.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg" alt="" />';
					}
				}
			}
		?>
		</div> <!-- #list_picsam_img -->

		<!-- 詳細リンクボタン -->
		<a href="<?php echo get_permalink($meta_id).$add_url; ?>" title="<?php echo $meta_title; ?>" rel="bookmark"><div class="list_details_button">物件の詳細を見る</div></a>
	</div>

	<!-- 右ブロック -->   
	<div class="list_detail">
		<dl class="list_price<?php if( get_post_meta($meta_id,'bukkenshubetsu',true) > 3000 ) echo ' rent'; ?>">
			<table width="100%">
				<tr>
					<td>
						<dt><?php if( get_post_meta($meta_id,'bukkenshubetsu',true) < 3000 ) { echo '価格';}else{echo '賃料';} ?></dt>
						<dd><div class="dpoint3">
							<?php 
							if ( !my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){
								echo "--";
							}else{
								if( get_post_meta($meta_id, 'seiyakubi', true) != "" ){ echo '--'; }else{  my_custom_kakaku_print($meta_id); }
							}
							?>
						</div></dd>

						<dd><?php my_custom_bukkenshubetsu_print($meta_id); ?></dd>
							<?php 
							if ( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2 ) ){
								if( get_post_meta($meta_id, 'madorisu', true) !=""){ 
									?>
									<dt>間取</dt><dd><div class="dpoint3"><?php my_custom_madorisu_print($meta_id); ?></div></dd>
									<?php
								}
							}
							?>

						<?php if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){ ?>

								<?php if( get_post_meta($meta_id, 'kakakutsubo', true ) ){?>
									<dt>坪単価</dt><dd><?php my_custom_kakakutsubo_print($meta_id) ;?></dd>
								<?php } ?>

								<?php if( get_post_meta($meta_id, 'kakakukyouekihi', true ) ){?>
									<dt>共益費・管理費</dt><dd><?php echo get_post_meta($meta_id, 'kakakukyouekihi', true);?>円</dd>
								<?php } ?>

								<?php if( get_post_meta($meta_id, 'kakakutsumitate', true ) ){?>
									<dt>修繕積立金</dt><dd><?php echo get_post_meta($meta_id, 'kakakutsumitate', true);?>円</dd>
								<?php } ?>

								<?php if( get_post_meta($meta_id, 'kakakuhyorimawari', true ) ){ ;?>
									<dt>満室時表面利回り</dt><dd><?php echo get_post_meta($meta_id, 'kakakuhyorimawari', true);?>%　
								<?php } ?>

								<?php if( get_post_meta($meta_id, 'kakakurimawari', true) ){ ;?>
									<dt>現行利回り</dt><dd><?php echo get_post_meta($meta_id, 'kakakurimawari', true);?>%</dd>
								<?php } ?>


								<!-- 駐車場 -->
								<?php //my_custom_chushajo_print_archive($meta_id); ?>

								<!-- #校区 -->
								<?php do_action( 'kouku_print', $meta_id );?>

						<?php } ?>
					</td>
				</tr>


				<?php if( get_post_meta($meta_id, 'kakakushikikin', true) !=""
					|| get_post_meta($meta_id, 'kakakureikin', true) !=""
					|| get_post_meta($meta_id, 'kakakuhoshoukin', true) !=""
					|| get_post_meta($meta_id, 'kakakukenrikin', true) !=""
					|| get_post_meta($meta_id, 'kakakushikibiki', true) !=""
					|| get_post_meta($meta_id, 'kakakukoushin', true) !="" ){ ;?>

				<?php if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){ ?>
				<tr>
					<td>
						<?php if( get_post_meta($meta_id, 'kakakushikikin', true) ){?>
						<dt>敷金</dt><dd><?php my_custom_kakakushikikin_print($meta_id); ?></dd>
						<?php } ?>

						<?php if(get_post_meta($meta_id, 'kakakureikin', true) ){?>
						<dt>礼金</dt><dd><?php my_custom_kakakureikin_print($meta_id); ?></dd>
						<?php } ?>

						<?php if(get_post_meta($meta_id, 'kakakuhoshoukin', true) ){?>
						<dt>保証金</dt><dd><?php my_custom_kakakuhoshoukin_print($meta_id); ?></dd>
						<?php } ?>

						<?php if(get_post_meta($meta_id, 'kakakukenrikin', true) ){?>
						<dt>権利金</dt><dd><?php my_custom_kakakukenrikin_print($meta_id); ?></dd>
						<?php } ?>

						<?php if(get_post_meta($meta_id, 'kakakushikibiki', true) ){?>
						<dt>償却・敷引金</dt><dd><?php my_custom_kakakushikibiki_print($meta_id); ?></dd>
						<?php } ?> 

						<?php if( get_post_meta($meta_id, 'kakakukoushin', true) ){ ;?>
						<dt>更新料</dt><dd><?php my_custom_kakakukoushin_print($meta_id); ?></dd>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
				<?php } ?>
			</table>
		</dl>


		<!-- 所在地、交通 -->
		<dl class="list_address">
			<table width="100%">
				<?php if ( my_custom_kaiin_view('kaiin_shozaichi',$kaiin,$kaiin2) ){ ?>
						<tr>
							<td class="list_address_th"><dt>所在地</dt></td>
							<td class="list_address_td" width="82%"><dd><?php my_custom_shozaichi_print($meta_id); ?>
							<?php echo get_post_meta($meta_id, 'shozaichimeisho', true);?></dd></td>
						</tr>
				<?php } ?>

				<?php if ( my_custom_kaiin_view('kaiin_kotsu',$kaiin,$kaiin2) ){ ?>
						<tr>
							<td class="list_address_th"><dt>交通</dt></td>
							<td class="list_address_td" width="82%"><dd><?php my_custom_koutsu1_print($meta_id); ?>
							<?php my_custom_koutsu2_print($meta_id); ?>
							<?php if(get_post_meta($meta_id, 'koutsusonota', true) !='') echo '<br />'.get_post_meta($meta_id, 'koutsusonota', true).'';?></dd></td>
						</tr>
				<?php } ?>
			</table>
		</dl>


		<!-- 物件情報 -->
		<dl class="list_price_others">

			<!-- 物件情報 -->
			<table width="100%">

				<?php if ( my_custom_kaiin_view('kaiin_tikunen',$kaiin,$kaiin2) ){ ?>
					<?php if(get_post_meta($meta_id, 'tatemonochikunenn', true) !="" || get_post_meta($meta_id, 'tatemonokozo', true) !="" ){ ?>
						<tr>
							<td class="list_price_others_th">築年月</td>
							<td class="list_price_others_td"><?php echo get_post_meta($meta_id, 'tatemonochikunenn', true);?></td>

							<td class="list_price_others_th">構造</td>
							<td class="list_price_others_td"><?php my_custom_tatemonokozo_print($meta_id) ?></td>
						</tr>
					<?php } ?>
				<?php } ?>

				<?php if ( my_custom_kaiin_view('kaiin_kaisu',$kaiin,$kaiin2) ){ ?>
					<?php if(get_post_meta($meta_id, 'tatemonokaisu1', true) !="" 
						|| get_post_meta($meta_id, 'tatemonokaisu2', true) !=""
						|| get_post_meta($meta_id,'heyakaisu',true) != '' ){ ?>
						<tr>
							<td class="list_price_others_th">階建</td>
							<td class="list_price_others_td">
								<?php if(get_post_meta($meta_id, 'tatemonokaisu1', true)!="") echo '地上 '.get_post_meta($meta_id, 'tatemonokaisu1', true).'階 ' ;?>
								<?php if(get_post_meta($meta_id, 'tatemonokaisu2', true)!="") echo '地下 '.get_post_meta($meta_id, 'tatemonokaisu2', true).'階' ;?>
							</td>

							<td class="list_price_others_th">部屋階数</td>
							<td class="list_price_others_td">
								<?php if( get_post_meta($meta_id, 'heyakaisu', true) ){ ?>
									<?php echo get_post_meta($meta_id, 'heyakaisu', true);?>階
								<?php } ?>
							</td>

						</tr>
					<?php } ?>
				<?php } ?>

				<?php if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){ ?>
					<?php if( get_post_meta($meta_id,'tochikukaku',true)!='' 
						|| get_post_meta($meta_id,'tochikenpei',true)!=''
						|| get_post_meta($meta_id,'tochiyoseki',true)!='' ){ ?>
						<tr>
							<td class="list_price_others_th">区画面積</td>
							<td class="list_price_others_td"><?php echo get_post_meta($meta_id, 'tochikukaku', true);?>m&sup2;</td>

							<td class="list_price_others_th">建蔽率/容積率</td>
							<td class="list_price_others_td"><?php echo get_post_meta($meta_id, 'tochikenpei', true);?>% / <?php echo get_post_meta($meta_id, 'tochiyoseki', true);?>%</td>
						</tr>

					<?php } else { ?>
						<tr>
							<td class="list_price_others_th">面積</td>
							<td class="list_price_others_td">
								<?php if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){ ?>
										<?php if( get_post_meta($meta_id, 'tatemonomenseki', true) !="" ) echo ''.get_post_meta($meta_id, 'tatemonomenseki', true).'m&sup2; ';?>
										<?php if( get_post_meta($meta_id, 'tochikukaku', true) !="" ) echo '土地 '.get_post_meta($meta_id, 'tochikukaku', true).'m&sup2; ';?>
								<?php } ?>
							</td>

							<td class="list_price_others_th">駐車場</td>
							<td class="list_price_others_td"><?php my_custom_chushajo_print_archive($meta_id); ?></td>

						</tr>
					<?php } ?>

				<?php } ?>



				<?php if ( my_custom_kaiin_view('kaiin_shikibesu',$kaiin,$kaiin2) ){ ?>

					<?php if( get_post_meta( $meta_id, 'bukkennaiyo',true )!='' || get_post_meta($meta_id,'nyukyogenkyo',true) !='' ){  ?>
						<tr>
							<?php
								$bukkenshubetsu_data = intval(get_post_meta($meta_id,'bukkenshubetsu',true));

								if ( $bukkenshubetsu_data <= 1202 ) {
									echo '<td class="list_price_others_th">区画番号</td>';
								}else{
									echo '<td class="list_price_others_th">部屋番号</td>';
								}

								echo '<td class="list_price_others_td">' . get_post_meta( $meta_id, 'bukkennaiyo',true ) . '</td>'; 
							?>

							<td class="list_price_others_th">現況</td>
							<td class="list_price_others_td">
							<?php
								$nyukyogenkyo_data = get_post_meta($meta_id,'nyukyogenkyo',true);

								if ( $bukkenshubetsu_data <1200 ) {
									if($nyukyogenkyo_data=="1")	echo '更地';
									if($nyukyogenkyo_data=="2")	echo '上物有';
									if($nyukyogenkyo_data=="10")	echo '上物有(更地引渡可)';
								}else{
									if($nyukyogenkyo_data=="1")	echo '居住中';
									if($nyukyogenkyo_data=="2")	echo '空家';
									if($nyukyogenkyo_data=="3")	echo '賃貸中';
									if($nyukyogenkyo_data=="4")	echo '未完成';
								}
								//text
								if( $nyukyogenkyo_data !='' && !is_numeric($nyukyogenkyo_data) ) echo $nyukyogenkyo_data;
							?></td>
						</tr>
					<?php } ?>
				<?php } ?>


						<tr>
							<?php if ( my_custom_kaiin_view('kaiin_shikibesu',$kaiin,$kaiin2) ){ ?>
								<td class="list_price_others_th">物件番号</td>
								<td class="list_price_others_td"><?php echo get_post_meta($meta_id, 'shikibesu', true);?></td>
							<?php } ?>

							<?php if ( my_custom_kaiin_view('kaiin_keisaikigenbi',$kaiin,$kaiin2) ){ ?>
								<?php if( get_post_meta($meta_id,'keisaikigenbi',true)!='' ){ ?>
									<td class="list_price_others_th">掲載期限日</td>
									<td class="list_price_others_td"><?php echo get_post_meta($meta_id, 'keisaikigenbi', true);?></td>
								<?php } else{ ?>
									<?php
									//echo '<td>更新日</td>';
									//echo '<td>' .  $post_modified_date . '</td>';
									echo '<td class="list_price_others_th" colspan="2"> </td>';
									?>
								<?php } ?>
							<?php } ?>
						</tr>

						<?php
						//会員チラ見せ 一棟と同じ条件
						if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) 
							&& my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) 
							&& my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) 
						){
						?>
						<tr>
							<td class="list_price_others_th">設備・条件</td>
							<td class="list_price_others_td" colspan="3"><?php echo my_custom_setsubi_print($meta_id); ?></td>
						</tr>
						<?php } ?>

			</table>


			<?php if( $kaiin == 1 ) { ?>
				この物件は、「会員様にのみ限定公開」している物件です。<br />
				非公開物件につき、詳細情報の閲覧には会員ログインが必要です。<br />
				非公開物件を閲覧・資料請求するには会員登録(無料)が必要です。

			<?php } else { ?>

			<?php
				//ユーザー別会員物件リスト
				if (!$kaiin2 && get_option('kaiin_users_rains_register') == 1 && get_post_meta($meta_id, 'kaiin', true) > 0 ) {

					if( get_post_meta($meta_id, 'kaiin', true) > 1 ){
						//VIP
						echo '<br />';
						echo 'この物件は、閲覧できません。<br />';
						echo '<br />';
					}else{
						echo 'この物件は、「閲覧条件」に 該当していない物件です。<br />';
						echo '閲覧条件を変更をする事で閲覧が可能になります。<br />';
						echo '<div align="center">';
						echo '<div id="maching_mail"><a href="'.WP_PLUGIN_URL.'/fudoumail/fudou_user.php?KeepThis=true&TB_iframe=true&height=500&width=680" class="thickbox">';
						echo '閲覧条件・メール設定</a></div>';
						echo '</div>';
					}
				}
			}
			?>
		</dl>
	</div>

</div><!-- end list_simple_box -->
