<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * Template: archive-fudo2014.php
 * 
 * @package WordPress4.7
 * @subpackage Fudousan Plugin
 * @subpackage Twenty_Fourteen
 * Version: 1.7.8
 */


	/**** 検索 SQL ****/
	require_once WP_PLUGIN_DIR . '/fudou/inc/inc-archive-fudo.php';


	//カウント
		$metas_co = 0;
		if($sql !=''){
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			if( !empty( $metas ) ){
				$metas_co = $metas->co;
			}
		}else{
			$metas_co = 0;
		}

	//ソート・ページナビ
		$page_navigation = '';

		if($metas_co != 0 ){
			$kak_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort == 'kak' && $bukken_order =='')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='kak' && $bukken_order =='d')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			if($bukken_sort_data2 == "post_modified" && $bukken_sort == '')
				$kak_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';


			$tam_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tam' && $bukken_order =='')
				$tam_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';

			if($bukken_sort=='tam' && $bukken_order =='d')
				$tam_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			$mad_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $bukken_order =='')
				$mad_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $bukken_order =='d')
				$mad_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			$sho_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $bukken_order =='')
				$sho_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $bukken_order =='d')
				$sho_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			$tac_img = '<img src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $bukken_order =='')
				$tac_img = '<img src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $bukken_order =='d')
				$tac_img = '<img src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			$page_navigation = '<div id="nav-above1" class="navigation">';
			$page_navigation .= '<div class="nav-previous">';


			//条件検索
			if($bukken_slug_data=="jsearch"){

				//url生成

				//間取り
				$madori_url = '';
				if(!empty($madori_id)) {
					$i=0;
					foreach($madori_id as $meta_box){
						$madori_url .= '&amp;mad[]='.$madori_id[$i];
						$i++;
					}
				}

				//設備条件
				$setsubi_url = '';
				if(!empty($set_id)) {
					$i=0;
					foreach($set_id as $meta_box){
						$setsubi_url .= '&amp;set[]='.$set_id[$i];
						$i++;
					}
				}

				$add_url  = '';

				//複数種別
				if( $shub !='' ) $add_url  .= '&amp;shub='.$shub;

				if (is_array($bukken_shubetsu)) {
					$i=0;
					foreach($bukken_shubetsu as $meta_set){
						$add_url  .= '&amp;shu[]='.$bukken_shubetsu[$i];
						$i++;
					}

				} else {
					$add_url  .= '&amp;shu='.$bukken_shubetsu;
				} 

			//	if($ken_id != '') $ken_id = intval($ken_id);

				$add_url .= '&amp;ros='. $ros_id;
				$add_url .= '&amp;eki='. $eki_id;
				$add_url .= apply_filters( 'fudoubus_add_url_archive', '' );

				$add_url .= '&amp;ken='. $ken_id;
				$add_url .= '&amp;sik='. $sik_id;
				$add_url .= '&amp;kalc='.$kalc_data;
				$add_url .= '&amp;kahc='.$kahc_data;
				$add_url .= '&amp;kalb='.$kalb_data;
				$add_url .= '&amp;kahb='.$kahb_data;
				$add_url .= '&amp;hof='. $hof_data;
				$add_url .= $madori_url;
				$add_url .= '&amp;tik='. $tik_data;
				$add_url .= '&amp;mel='. $mel_data;
				$add_url .= '&amp;meh='. $meh_data;
				$add_url .= $setsubi_url;

				$joken_url  = $site .'?bukken=jsearch';


				//複数市区
				if (is_array($ksik_id)) {
					$i=0;
					foreach($ksik_id as $meta_set){
						$add_url .= '&amp;ksik[]='.$ksik_id[$i];
						$i++;
					}
				}

				//複数駅
				if(is_array( $rosen_eki )  ){
					$i=0;
					foreach($rosen_eki as $meta_set){
						$add_url .= '&amp;re[]='.$rosen_eki[$i];
						$i++;
					}
				}

				//オリジナルフィルター $add_url
				$add_url = apply_filters( 'fudou_org_add_url_archive', $add_url );

				$joken_url .= $add_url;

				if( $s != '' ){
					$s_tag = '&amp;s=' . $s;
				}else{
					$s_tag = '';
				}

				if($bukken_sort=='kak') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=kak&amp;ord='.$bukken_order.$s_tag.'">'.$kak_img.'価格</a> ';
				if($bukken_sort=='kak') $page_navigation .= '</b>';

				if($bukken_sort=='tam') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tam&amp;ord='.$bukken_order.$s_tag.'">'.$tam_img.'面積</a> ';
				if($bukken_sort=='tam') $page_navigation .= '</b>';

				if($bukken_sort=='mad') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=mad&amp;ord='.$bukken_order.$s_tag.'">'.$mad_img.'間取</a> ';
				if($bukken_sort=='mad') $page_navigation .= '</b>';

				if($bukken_sort=='sho') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=sho&amp;ord='.$bukken_order.$s_tag.'">'.$sho_img.'住所</a> ';
				if($bukken_sort=='sho') $page_navigation .= '</b>';

				if($bukken_sort=='tac') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tac&amp;ord='.$bukken_order.$s_tag.'">'.$tac_img.'築年月</a>';
				if($bukken_sort=='tac') $page_navigation .= '</b>';

				/*
				 * 物件ソート用タグ
				 *
				 * @since Fudousan Plugin 1.7.8
				 * For archive-fudoXXXX.php apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );
				*/
				$page_navigation = apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );

			}else{

				//物件カテゴリ・物件タグ
				if( $taxonomy_name == 'bukken_tag' ){
					$joken_url = $site.'?bukken_tag='.$slug_data.'';
				}else{
					$joken_url = $site.'?bukken='.$slug_data.'';
				}

				if($s != ''){
					$joken_url  = $site .'?s='.$s.'&bukken=search';

					if($searchtype == 'id')
						$joken_url  .= '&st=id';

					if($searchtype == 'chou')
						$joken_url  .= '&st=chou';
				}


				$bukken = isset( $_GET['bukken'] ) ? $_GET['bukken'] : '';
				$bukken_slug_data = esc_attr( stripslashes( $bukken ));
				$add_url  = '&amp;bk='.$bukken;

				$add_url .= '&amp;shu='.$bukken_shubetsu;
				$add_url .= '&amp;mid='.$mid_id;
				$add_url .= '&amp;nor='.$nor_id;
				$add_url .= apply_filters( 'fudoubus_add_url_archive', '' );

				//オリジナルフィルター $add_url
				$add_url = apply_filters( 'fudou_org_add_url_archive', $add_url );

				if ($taxonomy_name == '') $joken_url .= $add_url;

				if($bukken_sort=='kak') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=kak&amp;ord='.$bukken_order.'">'.$kak_img.'価格</a> ';
				if($bukken_sort=='kak') $page_navigation .= '</b>';

				if($bukken_sort=='tam') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tam&amp;ord='.$bukken_order.'">'.$tam_img.'面積</a> ';
				if($bukken_sort=='tam') $page_navigation .= '</b>';

				if($bukken_sort=='mad') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=mad&amp;ord='.$bukken_order.'">'.$mad_img.'間取</a> ';
				if($bukken_sort=='mad') $page_navigation .= '</b>';

				if($bukken_sort=='sho') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=sho&amp;ord='.$bukken_order.'">'.$sho_img.'住所</a> ';
				if($bukken_sort=='sho') $page_navigation .= '</b>';

				if($bukken_sort=='tac') $page_navigation .= '<b>';
				$page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tac&amp;ord='.$bukken_order.'">'.$tac_img.'築年月</a> ';
				if($bukken_sort=='tac') $page_navigation .= '</b>';

				$s_tag = '';

				/*
				 * 物件ソート用タグ
				 *
				 * @since Fudousan Plugin 1.7.8
				 * For archive-fudoXXXX.php apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );
				*/
				$page_navigation = apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );

			}


			$page_navigation .= '</div>';
			$page_navigation .= '<div class="nav-next">';

			if($bukken_order=="d"){
				$bukken_order = "";
			}else{
				$bukken_order = "d";
			}

			//ページナビ
			$page_navigation .= f_page_navi($metas_co,$posts_per_page,$bukken_page_data,$bukken_sort,$bukken_order,$s,$joken_url);

			$page_navigation .= '</div>';
			$page_navigation .= '</div><!-- #nav-above -->';
		}


		//パーマリンクチェック
		$permalink_structure = get_option('permalink_structure');
		if ( $permalink_structure != '' ) {
			$add_url_point = mb_strlen( $add_url, "utf-8" ) ;
			if( $add_url_point > 5 ){
				$add_url_point = $add_url_point - 5;
				$add_url = '?' . myRight( $add_url, $add_url_point ) ;
			}else{
				$add_url = '';
			}
		}



	//物件一覧ページ
	get_header(); 

?>
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php do_action( 'archive-fudo1' ); ?>

			<header class="page-header">

				<?php if( $joken_url !='' ) { ?>
					<h1 class="page-title"><a href="<?php echo $joken_url;?>"><?php echo esc_html( esc_html( $org_title ) ); ?></a></h1>
				<?php  }else{  ?>
					<h1 class="page-title"><?php echo esc_html( esc_html( $org_title ) ); ?></h1>
				<?php  } ?>
			</header><!-- .page-header -->


			<?php echo $page_navigation; ?>


			<div id="list_simplepage">
			<?php
				//loop SQL
				if($sql !=''){
					//$sql2 = $wpdb->prepare($sql2,'');
					$metas = $wpdb->get_results( $sql2, ARRAY_A );
					if(!empty($metas)) {

						foreach ( $metas as $meta ) {
							$meta_id = $meta['object_id'];	//post_id
							$meta_data = get_post( $meta_id ); 
							$meta_title =  $meta_data->post_title;

							require 'archive-fudo-loop.php';

						}
					}else{

						echo "物件がありませんでした。";

					}
				}else{
						echo "物件がありませんでした";
				}
				//loop SQL END
			?>
			</div><!-- .list_simplepage -->

			<?php echo $page_navigation; ?>

			<?php do_action( 'archive-fudo2' ); ?>

			<div class="pageback"><a href="#" onClick="history.back(); return false;">前のページにもどる</a></div>

		</div><!-- #content -->
	</section><!-- #primary -->


<?php
	get_sidebar( 'content' );
	get_sidebar();
	get_footer();
?>