<?php
/*
 * 不動産プラグインウィジェット
 * @package WordPress4.8
 * @subpackage Fudousan Plugin
 * Version: 1.8.1
*/


//トップ投稿表示(最近の記事)
function fudo_toukouInit_top() {
	register_widget('fudo_toukou_top');
}
add_action('widgets_init', 'fudo_toukouInit_top');

//トップ物件表示
function fudo_widgetInit_top_r() {
	register_widget('fudo_widget_top_r');
}
add_action('widgets_init', 'fudo_widgetInit_top_r');

// 売買路線カテゴリ register Class fudo_widget widget
function fudo_widgetInit_b_r() {
	register_widget('fudo_widget_b_r');
}
add_action('widgets_init', 'fudo_widgetInit_b_r');

// 賃貸路線カテゴリ register Class fudo_widget widget
function fudo_widgetInit_r_r() {
	register_widget('fudo_widget_r_r');
}
add_action('widgets_init', 'fudo_widgetInit_r_r');

// 売買地域カテゴリ register Class fudo_widget widget
function fudo_widgetInit_b_c() {
	register_widget('fudo_widget_b_c');
}
add_action('widgets_init', 'fudo_widgetInit_b_c');

// 賃貸地域カテゴリ register Class fudo_widget widget
function fudo_widgetInit_r_c() {
	register_widget('fudo_widget_r_c');
}
add_action('widgets_init', 'fudo_widgetInit_r_c');

// 物件カテゴリ register Class fudo_widget widget
function fudo_widgetInit_cat() {
	register_widget('fudo_widget_cat');
}
add_action('widgets_init', 'fudo_widgetInit_cat');

// タクソノミー register Class fudo_widget_tag widget
function fudo_widgetInit_tag() {
	register_widget('fudo_widget_tag');
}
add_action('widgets_init', 'fudo_widgetInit_tag');

// 物件検索(キーワード)
function fudo_widgetInit_search() {
	register_widget('fudo_widget_search');
}
add_action('widgets_init', 'fudo_widgetInit_search');




// トップ投稿表示(最近の記事)
class fudo_toukou_top extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_toukou_top', 			// Base ID
			'最近の投稿表示' ,		// Name
			array( 'description' => '最近の投稿記事(抜粋優先・アイキャッチ画像)を表示します。', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$t_cat = isset($instance['t_cat']) ? esc_attr($instance['t_cat']) : '';
		$item  = isset($instance['item']) ? esc_attr($instance['item']) : '';

		if($item=='') $item = 5;

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('t_cat'); ?>">
		投稿カテゴリ<br /><?php wp_dropdown_categories(array('show_option_all' => '全てのカテゴリ', 'hide_empty' => 0, 'hierarchical' => 1, 'show_count' => 0, 'name' => $this->get_field_name('t_cat'), 'orderby' => 'name', 'selected' => $t_cat  ));?></label></p>

		<p><label for="<?php echo $this->get_field_id('item'); ?>">
		表示数 <input class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>" type="text" value="<?php echo $item; ?>" /></label></p>

		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		global $wpdb;
		global $post;

		// outputs the content of the widget

	        extract( $args );

		$title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$t_cat = isset($instance['t_cat']) ? $instance['t_cat'] : '';
		$item  = isset($instance['item']) ?  $instance['item'] : '';

		$category_link = '';
		echo $before_widget;


			if($t_cat > 0 ){
				$category_link = get_category_link( $t_cat );
			}
			//カテゴリ指定の場合はカテゴリリンク
			if ( $title !='' ){
				if($category_link){
					echo $before_title . '<a href="' . $category_link . '">' . $title . '</a>' .  $after_title; 
				}else{
					echo $before_title . $title . $after_title; 
				}
			}

			$sql  =  "SELECT DISTINCT P.ID , P.post_title , P.post_date , P.post_content , P.post_excerpt";
			$sql .=  " FROM $wpdb->posts AS P ";
			$sql .=  " INNER JOIN ($wpdb->term_taxonomy AS TT ";
			$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON TT.term_taxonomy_id = TR.term_taxonomy_id) ON P.ID = TR.object_id";
			$sql .=  " WHERE P.post_password='' AND P.post_status='publish'";
			$sql .=  " AND P.post_type='post'";

			if( $t_cat > 0 )
			$sql .=  " AND TT.term_id =" . $t_cat .  "";
			$sql .=  " ORDER BY P.post_date DESC";
			$sql .=  " LIMIT 0,".$item."";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			if(!empty($metas)) {

				echo "\n";
				echo "\n";
				echo '<ul id="toukou_top">';
				foreach ( $metas as $meta ) {
					$meta_id = $meta['ID'];
					$meta_post_title = $meta['post_title'];
					$meta_post_date  = $meta['post_date'];

					$meta_content_data = $meta['post_content'];
					$meta_content_data = str_replace(array("\r\n","\r","\n","\t"), '',  mb_substr( strip_tags( $meta_content_data ) , 0, 130) );

					$meta_excerpt_data  =  $meta['post_excerpt'];
					$meta_excerpt_data = str_replace(array("\r\n","\r","\n","\t"), '',  mb_substr( strip_tags( $meta_excerpt_data ) , 0, 130) );

					$meta_post_date = myLeft($meta_post_date,10);
					echo "\n";

					echo '<li><a href="' . get_permalink($meta_id) . '"><span class="toukou_top_post_title">'. $meta_post_title . '</span></a><br />';
					echo '<ul class="toukou_top_post_excerpt">';
					echo '<li><span class="toukou_top_post_thumbnail">' . get_the_post_thumbnail( $meta_id , 'thumbnail' ) . '</span>';

					if($meta_excerpt_data){
						echo '' . $meta_excerpt_data . '';
					}else{
						echo '' . $meta_content_data . '';
					}

					echo '<span style="float:right;">['.$meta_post_date.']　<a href="' . get_permalink($meta_id) . '">more・・</a></span>';
					echo '</li></ul>';
					echo '</li>';
					echo "\n";
				}
				echo '</ul>';
				echo "\n";
				echo "\n";
			}

		echo $after_widget;

	}
} // Class fudo_toukou_top








/**
 * トップ物件表示
 *
 * Version: 1.8.0
 */
class fudo_widget_top_r extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_top_r', 			// Base ID
			'トップ物件表示' ,		// Name
			array( 'description' => 'トップページに物件を表示します。', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {

		global $is_fudoukaiin,$is_fudoubus;

		$title      = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$item       = isset($instance['item']) ? esc_attr($instance['item']) : '';
		$shubetsu   = isset($instance['shubetsu']) ? esc_attr($instance['shubetsu']) : '';
		$bukken_cat = isset($instance['bukken_cat']) ? esc_attr($instance['bukken_cat']) : '';
		$sort       = isset($instance['sort']) ? esc_attr($instance['sort']) : '';

		$view1 = isset($instance['view1']) ? esc_attr($instance['view1']) : '';
		$view2 = isset($instance['view2']) ? esc_attr($instance['view2']) : '';
		$view3 = isset($instance['view3']) ? esc_attr($instance['view3']) : '';
		$view4 = isset($instance['view4']) ? esc_attr($instance['view4']) : '';
		$view5 = isset($instance['view5']) ? esc_attr($instance['view5']) : '';
		$view6 = isset($instance['view6']) ? esc_attr($instance['view6']) : '';	//バス路線

		$kaiinview = isset($instance['kaiinview']) ? esc_attr($instance['kaiinview']) : '';

		if($item=='') $item = 4;

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		タイトル <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>


		<p><label for="<?php echo $this->get_field_id('item'); ?>">
		表示数 <input class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>" type="text" value="<?php echo $item; ?>" /></label></p>


		<p><label for="<?php echo $this->get_field_id('shubetsu'); ?>">
		種別 <select class="widefat" id="<?php echo $this->get_field_id('shubetsu'); ?>" name="<?php echo $this->get_field_name('shubetsu'); ?>">
			<option value="1"<?php if($shubetsu == 1){echo ' selected="selected"';} ?>>物件すべて</option>
			<option value="2"<?php if($shubetsu == 2){echo ' selected="selected"';} ?>>売買すべて</option>
			<option value="3"<?php if($shubetsu == 3){echo ' selected="selected"';} ?>>売買土地</option>
			<option value="4"<?php if($shubetsu == 4){echo ' selected="selected"';} ?>>売買戸建</option>
			<option value="5"<?php if($shubetsu == 5){echo ' selected="selected"';} ?>>売買マンション</option>
			<option value="6"<?php if($shubetsu == 6){echo ' selected="selected"';} ?>>売買住宅以外の建物全部</option>
			<option value="7"<?php if($shubetsu == 7){echo ' selected="selected"';} ?>>売買住宅以外の建物一部</option>
			<option value="10"<?php if($shubetsu == 10){echo ' selected="selected"';} ?>>賃貸すべて</option>
			<option value="11"<?php if($shubetsu == 11){echo ' selected="selected"';} ?>>賃貸居住用</option>
			<option value="12"<?php if($shubetsu == 12){echo ' selected="selected"';} ?>>賃貸事業用</option>
		</select></label></p>


		<p><label for="<?php echo $this->get_field_id('bukken_cat'); ?>">
		物件カテゴリ <select class="widefat" id="<?php echo $this->get_field_id('bukken_cat'); ?>" name="<?php echo $this->get_field_name('bukken_cat'); ?>">
			<option value="0"<?php if($bukken_cat == 0){echo ' selected="selected"';} ?>>すべて</option>
<?php

		//物件カテゴリ
		$terms = get_terms('bukken', 'hide_empty=0');

		if ( !empty( $terms ) ){
			foreach ( $terms as $term ) {
				echo  '<option value="'.$term->term_id.'"';
				if( $bukken_cat == $term->term_id )	echo ' selected="selected"';
				echo '>'.$term->name.'</option>';
			}
		}
?>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('sort'); ?>">
		並び順 <select class="widefat" id="<?php echo $this->get_field_id('sort'); ?>" name="<?php echo $this->get_field_name('sort'); ?>">
			<option value="2"<?php if($sort == 2){echo ' selected="selected"';} ?>>新しい順</option>
			<option value="3"<?php if($sort == 3){echo ' selected="selected"';} ?>>古い順</option>
			<option value="4"<?php if($sort == 4){echo ' selected="selected"';} ?>>高い順</option>
			<option value="5"<?php if($sort == 5){echo ' selected="selected"';} ?>>安い順</option>
			<option value="6"<?php if($sort == 6){echo ' selected="selected"';} ?>>広い順(面積)</option>
			<option value="7"<?php if($sort == 7){echo ' selected="selected"';} ?>>狭い順(面積)</option>
			<option value="1"<?php if($sort == 1){echo ' selected="selected"';} ?>>ランダム</option>
		</select></label></p>

		表示項目<br />
		<p><label for="<?php echo $this->get_field_id('view1'); ?>">
		タイトル <select class="widefat" id="<?php echo $this->get_field_id('view1'); ?>" name="<?php echo $this->get_field_name('view1'); ?>">
			<option value="1"<?php if($view1 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view1 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view2'); ?>">
		価格 <select class="widefat" id="<?php echo $this->get_field_id('view2'); ?>" name="<?php echo $this->get_field_name('view2'); ?>">
			<option value="1"<?php if($view2 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view2 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view3'); ?>">
		間取り・土地面積 <select class="widefat" id="<?php echo $this->get_field_id('view3'); ?>" name="<?php echo $this->get_field_name('view3'); ?>">
			<option value="1"<?php if($view3 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view3 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view4'); ?>">
		地域 <select class="widefat" id="<?php echo $this->get_field_id('view4'); ?>" name="<?php echo $this->get_field_name('view4'); ?>">
			<option value="1"<?php if($view4 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view4 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view5'); ?>">
		路線・駅 <select class="widefat" id="<?php echo $this->get_field_id('view5'); ?>" name="<?php echo $this->get_field_name('view5'); ?>">
			<option value="1"<?php if($view5 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view5 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

	<?php if( $is_fudoubus ) { ?>
		<p><label for="<?php echo $this->get_field_id('view6'); ?>">
		バス路線 <select class="widefat" id="<?php echo $this->get_field_id('view6'); ?>" name="<?php echo $this->get_field_name('view6'); ?>">
			<option value="2"<?php if($view6 == 2){echo ' selected="selected"';} ?>>表示しない</option>
			<option value="1"<?php if($view6 == 1){echo ' selected="selected"';} ?>>表示する</option>
		</select></label></p>
	<?php } ?>


	<?php if($is_fudoukaiin && get_option('kaiin_users_can_register') == '1' ){ ?>
		<p><label for="<?php echo $this->get_field_id('kaiinview'); ?>">
		会員物件 <select class="widefat" id="<?php echo $this->get_field_id('kaiinview'); ?>" name="<?php echo $this->get_field_name('kaiinview'); ?>">
			<option value="1"<?php if($kaiinview == 1){echo ' selected="selected"';} ?>>会員・一般物件を表示する</option>
			<option value="2"<?php if($kaiinview == 2){echo ' selected="selected"';} ?>>会員物件を表示しない</option>
			<option value="3"<?php if($kaiinview == 3){echo ' selected="selected"';} ?>>会員物件だけ表示</option>
		</select></label></p>
	<?php } ?>

		<?php 
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {

		global $is_fudoukaiin,$is_fudoubus;
		global $wpdb;


		$img_path = get_option('upload_path');
		if ( empty( $img_path ) ){
			$img_path = 'wp-content/uploads';
		}
		//WordPressのアドレス(URL)
		$img_folder_url = site_url( '/' ) . $img_path;


		// outputs the content of the widget

	        extract( $args );

		$title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$item =       isset($instance['item']) ? $instance['item']: 4;
		$shubetsu =   isset($instance['shubetsu']) ? $instance['shubetsu']: '';
		$bukken_cat = isset($instance['bukken_cat']) ? $instance['bukken_cat']: '';

		$sort =  isset($instance['sort'])  ? $instance['sort'] : '';
		$view1 = isset($instance['view1']) ? $instance['view1']: '';
		$view2 = isset($instance['view2']) ? $instance['view2']: '';
		$view3 = isset($instance['view3']) ? $instance['view3']: '';
		$view4 = isset($instance['view4']) ? $instance['view4']: '';
		$view5 = isset($instance['view5']) ? $instance['view5']: '';
		$view6 = isset($instance['view6']) ? $instance['view6']: '';	//バス路線

		$kaiinview = isset($instance['kaiinview']) ? $instance['kaiinview'] : 1 ;

		if( !$is_fudoukaiin || get_option('kaiin_users_can_register') != '1' ){
			$kaiinview = 1;
		}

		//表示数
		if($item =="") 	$item=4;

		//NEW/UP
		$newup_mark = get_option('newup_mark');
		if($newup_mark == '') $newup_mark=14;

		$where_data = "";
		//種別
		switch ($shubetsu) {
			case 1 :	//物件すべて
				break;
			case 2 :	//売買すべて
				$where_data = " AND CAST( PM_1.meta_value AS SIGNED )<3000";
				break;
			case 3 :	//売買土地
				$where_data = " AND Left(PM_1.meta_value,2) ='11'";
				break;
			case 4 :	//売買戸建
				$where_data = " AND Left(PM_1.meta_value,2) ='12'";
				break;
			case 5 :	//売買マンション
				$where_data = " AND Left(PM_1.meta_value,2) ='13'";
				break;
			case 6 :	//売住宅以外の建物全部
				$where_data = " AND Left(PM_1.meta_value,2) ='14'";
				break;
			case 7 :	//売住宅以外の建物一部
				$where_data = " AND Left(PM_1.meta_value,2) ='15'";
				break;

			case 10 :	//賃貸すべて
				$where_data = " AND  CAST( PM_1.meta_value AS SIGNED )>3000";
				break;
			case 11 :	//賃貸居住用
				$where_data = " AND Left(PM_1.meta_value,2) ='31'";
				break;
			case 12 :	//賃貸事業用
				$where_data = " AND Left(PM_1.meta_value,2) ='32'";
				break;

			default:
				$order_data = "";
				break;
		}


		//sort
		switch ($sort) {
			case 1 :	//ランダム
				$order_data = " rand()";
				break;
			case 2 :	//新しい順 (登録日)
				$order_data = " P.post_date DESC";
				break;
			case 3 :	//古い順 (登録日)
				$order_data = " P.post_date ASC";
				break;
			case 4 :	//高い順
				$order_data = " CAST( PM_2.meta_value AS SIGNED ) DESC";
				break;
			case 5 :	//安い順
				$order_data = " CAST( PM_2.meta_value AS SIGNED ) ASC";
				break;
			case 6 :	//広い順
				$order_data = " CAST( PM_3.meta_value AS SIGNED ) DESC";
				break;
			case 7 :	//狭い順
				$order_data = " CAST( PM_3.meta_value AS SIGNED ) ASC";
				break;
			case 8 :	//新しい順 (更新日)
				$order_data = " P.post_modified DESC";
				break;
			case 9 :	//古い順 (更新日)
				$order_data = " P.post_modified ASC";
				break;

			default:
				$order_data = " rand()";
				break;
		}



		//SQL
		$sql = "";
		$sql = $sql . "SELECT DISTINCT P.ID,P.post_title,P.post_modified,P.post_date";
		$sql = $sql . " FROM ((((((($wpdb->posts AS P";
		$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
		//種別
		if( $shubetsu != 1 ){
			$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
		}else{
			$sql = $sql . " )";
		}

		//価格
		if( $sort == 4 || $sort == 5 ){
			$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id) ";
		}else{
			$sql = $sql . " )";
		}

		//面積
		if( $sort == 6 || $sort == 7 ){
			$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id) ";
		}else{
			$sql = $sql . " )";
		}

		//会員
		if( $kaiinview != 1 ){
			$sql = $sql . " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id) ";
		}else{
			$sql = $sql . " )";
		}

		//カテゴリ
		if( $bukken_cat > 0){
			$sql = $sql . " INNER JOIN $wpdb->term_relationships AS TR ON P.ID = TR.object_id) ";
			$sql = $sql . " INNER JOIN $wpdb->term_taxonomy AS TT ON TR.term_taxonomy_id = TT.term_taxonomy_id) ";
		}else{
			$sql = $sql . " ))";
		}

		/*
		 * トップ物件表示 org追加SQL条件 INNER JOIN
		 *
		 * Version: 1.7.4
		 */
		$sql =  apply_filters( 'fudo_top_widget_inner_join_data', $sql, $kaiinview );


			$sql = $sql . " WHERE";
			$sql = $sql . "     P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";

		//種別
		if( $shubetsu != 1 )
			$sql = $sql . " AND PM_1.meta_key='bukkenshubetsu'";

		//価格
		if( $sort == 4 || $sort == 5 )
			$sql = $sql . " AND PM_2.meta_key='kakaku'";

		//面積
		if( $sort == 6 || $sort == 7 ){
			$sql = $sql . " AND (PM_3.meta_key='tatemonomenseki' or PM_3.meta_key='tochikukaku' )";
			$sql = $sql . " AND PM_3.meta_value !='' ";
		}

		//会員物件を表示しない
		if( $kaiinview == 2 ){
			$sql = $sql . " AND PM_4.meta_key='kaiin' AND PM_4.meta_value < 1 ";
		}

		//会員物件だけ表示
		if( $kaiinview == 3 ){
			$sql = $sql . " AND PM_4.meta_key='kaiin' AND PM_4.meta_value > 0 ";
		}

		//画像
		$sql = $sql . " AND (PM.meta_key='fudoimg1' Or PM.meta_key='fudoimg2') ";
		$sql = $sql . " AND PM.meta_value !='' ";

		//カテゴリ
		if( $bukken_cat > 0)
			$sql = $sql . " AND TT.term_id = ".$bukken_cat."";

		/*
		 * トップ物件表示 org追加SQL条件 WHERE
		 *
		 * Version: 1.7.4
		 */
		$sql =  apply_filters( 'fudo_top_widget_where_data', $sql, $kaiinview );


		$sql = $sql . $where_data;
		$sql = $sql . " ORDER BY ".$order_data." limit ".$item."";

	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );


		//ユーザー別会員物件リスト
		$kaiin_users_rains_register = get_option('kaiin_users_rains_register');


		if( !empty( $metas ) ){

			echo $before_widget;

			if ( $title ){
				echo $before_title . $title . $after_title; 
			}

			echo '<div id="box'.$args['widget_id'].'">';
			echo '<ul id="'.$args['widget_id'].'_1" class="grid-content">';

			//grid_count css class
			$grid_count = 1;

			foreach ( $metas as $meta ) {

				$rosen_bus = false;	//路線を「バス」に設定している?

				$post_id	= $meta['ID'];
				$post_title	= $meta['post_title'];
				$post_url	= str_replace('&p=','&amp;p=',get_permalink($post_id));

				//newup_mark
				$post_modified =  $meta['post_modified'];
				$post_date =   $meta['post_date'];
				$post_modified_date =  vsprintf("%d-%02d-%02d", sscanf($post_modified, "%d-%d-%d"));
				$post_date =  vsprintf("%d-%02d-%02d", sscanf($post_date, "%d-%d-%d"));

				$newup_mark_img=  '';
				if( $newup_mark != 0 && is_numeric($newup_mark) ){
					if( ( abs(strtotime($post_modified_date) - strtotime(date("Y/m/d"))) / (60 * 60 * 24) ) < $newup_mark ){
						if($post_modified_date == $post_date ){
							$newup_mark_img = '<div class="new_mark">new</div>';
						}else{
							$newup_mark_img = '<div class="new_mark">up</div>';
						}
					}
				}

				//会員2
				$kaiin = 0;
				if( !is_user_logged_in() && get_post_meta($post_id, 'kaiin', true) > 0 ) $kaiin = 1;
				//ユーザー別会員物件リスト
				$kaiin2 = users_kaiin_bukkenlist( $post_id, $kaiin_users_rains_register, get_post_meta( $post_id, 'kaiin', true ) );


				echo '<li class="'.$args['widget_id'].' box1 grid_count'. $grid_count . '">';

				//grid_count css class
				$grid_count++;
				if( $grid_count > 4 ){
					$grid_count = 1;
				}

				echo $newup_mark_img;

				//会員項目表示判定
				if ( !my_custom_kaiin_view('kaiin_gazo',$kaiin,$kaiin2) ){
					echo '<img class="box1image" src="'.WP_PLUGIN_URL.'/fudou/img/kaiin.jpg" alt="" />';
				}else{

					//サムネイル画像
					$fudoimg1_data = get_post_meta($post_id, 'fudoimg1', true);
					if($fudoimg1_data != '')	$fudoimg_data=$fudoimg1_data;
					$fudoimg2_data = get_post_meta($post_id, 'fudoimg2', true);
					if($fudoimg2_data != '')	$fudoimg_data=$fudoimg2_data;
					$fudoimg_alt = str_replace("　"," ",$post_title);

					echo '<a href="' . $post_url . '">';

					if( $fudoimg_data !="" ){

						/*
						 * Add url fudoimg_data Pre
						 *
						 * Version: 1.7.12
						 *
						 **/
						$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post_id );

						//Check URL
						if ( checkurl_fudou( $fudoimg_data )) {
							echo '<img class="box1image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
						}else{
						//Check attachment
							$sql  = "";
							$sql .=  "SELECT P.ID,P.guid";
							$sql .=  " FROM $wpdb->posts AS P";
							$sql .=  " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
							//$sql = $wpdb->prepare($sql,'');
							$metas = $wpdb->get_row( $sql );

							$attachmentid = '';
							if(!empty($metas)) {
								$attachmentid  =  $metas->ID;
								$guid_url  =  $metas->guid;
							}

							if($attachmentid !=''){
								//thumbnail、medium、large、full 
								$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, 'thumbnail');
								$fudoimg_url = $fudoimg_data1[0];

								if($fudoimg_url !=''){
									echo '<img class="box1image" src="' . $fudoimg_url .'" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}else{
									echo '<img class="box1image" src="' . $guid_url . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}
							}else{

								/*
								 * Add url fudoimg_data
								 *
								 * Version: 1.7.12
								 *
								 **/
								$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $post_id );

								if ( checkurl_fudou( $fudoimg_data )) {
									echo '<img class="box1image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}else{
									echo '<img class="box1image" src="' . WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" />';
								}
							}
						}

					}else{
						echo '<img class="box1image" src="'.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg" alt="" />';
					}
					echo "</a>\n";
				}


				/*
				 * トップ物件表示 追加項目
				 *
				 * Version: 1.7.12
				 */
				do_action( 'fodou_top_bukken0', $post_id, $kaiin, $kaiin2 );


				//タイトル
				if ( my_custom_kaiin_view('kaiin_title',$kaiin,$kaiin2) ){
					if($view1=="1" && $post_title !=''){
							echo '<span class="top_title">';
							echo str_replace("　"," ",$post_title).'';
							echo '</span><br />';
					}
				}


				do_action( 'fodou_top_bukken1', $post_id, $kaiin, $kaiin2 );


				//会員2
				if ( !my_custom_kaiin_view( 'kaiin_kakaku',$kaiin,$kaiin2 ) 
					&& !my_custom_kaiin_view( 'kaiin_madori', $kaiin, $kaiin2 )
					&& !my_custom_kaiin_view( 'kaiin_menseki', $kaiin, $kaiin2 )
					&& !my_custom_kaiin_view( 'kaiin_shozaichi', $kaiin, $kaiin2 )
					&& !my_custom_kaiin_view( 'kaiin_kotsu', $kaiin, $kaiin2) ){
					echo '<span class="top_kaiin">この物件は 会員様限定で公開している物件です</span>';
				}


				do_action( 'fodou_top_bukken2', $post_id, $kaiin, $kaiin2 );


				//価格 v1.7.12
				if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){

						if($view2=="1"){
							echo '<span class="top_price">';
							if( get_post_meta($post_id, 'seiyakubi', true) != "" ){
								echo 'ご成約済　';
							}else{
								//非公開の場合
								if(get_post_meta($post_id,'kakakukoukai',true) == "0"){
									$kakakujoutai_data = get_post_meta($post_id,'kakakujoutai',true);
									if($kakakujoutai_data=="1")	echo '相談　';
									if($kakakujoutai_data=="2")	echo '確定　';
									if($kakakujoutai_data=="3")	echo '入札　';

								}else{
									$kakaku_data = get_post_meta($post_id,'kakaku',true);
									if( is_numeric( $kakaku_data ) ){
										if ( function_exists( 'fudou_money_format_ja' ) ) {
											// Money Format 億万円 表示
											echo apply_filters( 'fudou_money_format_ja', $kakaku_data );
										}else{
											echo floatval($kakaku_data)/10000;
											echo "万円";
										}
									}
								}
							}
							echo '</span>';
						}
				}


				do_action( 'fodou_top_bukken3', $post_id, $kaiin, $kaiin2 );


				//間取り・土地面積
				if($view3=="1"){

					//間取り
					if ( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) ){
							echo '<span class="top_madori">';
							$madorisyurui_data = get_post_meta($post_id,'madorisyurui',true);
							echo get_post_meta($post_id,'madorisu',true);
							if($madorisyurui_data=="10")	echo 'R ';
							if($madorisyurui_data=="20")	echo 'K ';
							if($madorisyurui_data=="25")	echo 'SK ';
							if($madorisyurui_data=="30")	echo 'DK ';
							if($madorisyurui_data=="35")	echo 'SDK ';
							if($madorisyurui_data=="40")	echo 'LK ';
							if($madorisyurui_data=="45")	echo 'SLK ';
							if($madorisyurui_data=="50")	echo 'LDK ';
							if($madorisyurui_data=="55")	echo 'SLDK ';
							echo '</span>';
					}


					//土地面積
					if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){
							echo '<span class="top_menseki">';
							if ( get_post_meta($post_id,'bukkenshubetsu',true) < 1200 ) {
								if( get_post_meta($post_id, 'tochikukaku', true) !="" ) 
									echo ' '.get_post_meta($post_id, 'tochikukaku', true).'m&sup2;';
							}
							echo '</span>';
					}
				}


				do_action( 'fodou_top_bukken4', $post_id, $kaiin, $kaiin2 );


				//所在地
				if ( my_custom_kaiin_view('kaiin_shozaichi',$kaiin,$kaiin2) ){

						if($view4=="1"){
							echo '<span class="top_shozaichi">';
							$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);
							$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichicode_data = myLeft($shozaichicode_data,5);
							$shozaichicode_data = myRight($shozaichicode_data,3);

							if($shozaichiken_data !="" && $shozaichicode_data !=""){
								$sql = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ) echo "<br />".$metas->narrow_area_name."";
							}
							echo get_post_meta($post_id, 'shozaichimeisho', true);
							echo '</span>';
						}
				}


				do_action( 'fodou_top_bukken5', $post_id, $kaiin, $kaiin2 );


				//交通路線
				if ( my_custom_kaiin_view('kaiin_kotsu',$kaiin,$kaiin2) ){

						if($view5=="1"){
							echo '<span class="top_kotsu">';
							$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
							$koutsueki_data = get_post_meta($post_id, 'koutsueki1', true);
							$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);

							if($koutsurosen_data !=""){
								$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id = ".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty( $metas ) ){
									if( $metas->rosen_name == 'バス' ){
										$rosen_bus = true;
									}
									echo "<br />".$metas->rosen_name;
								}
							}

							//交通駅
							if( $koutsurosen_data && $koutsueki_data && !$rosen_bus ){
								$sql = "SELECT DTS.station_name";
								$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
								$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
								$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ){
									if($metas->station_name != '＊＊＊＊'){
										echo $metas->station_name.'駅';
									}
								}
							}
							echo '</span>';
						}
				}


				do_action( 'fodou_top_bukken6', $post_id, $kaiin, $kaiin2 );


				//交通バス路線
				if ( my_custom_kaiin_view( 'kaiin_kotsu', $kaiin,$kaiin2 ) ){
						if( $view6=="1" &&  $is_fudoubus ){
							if( $rosen_bus ){
								echo ' ';
							}else{
								echo '<br />';
							}
							echo '<span class="top_kotsubus">';
							echo apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 1 );
							echo '</span>';
						}
				}


				do_action( 'fodou_top_bukken7', $post_id, $kaiin, $kaiin2 );

				/*
				echo '<br />更新日:';
				echo $post_modified_date;
				*/

				echo '<div>';
				//会員ロゴ
				if( get_post_meta( $post_id, 'kaiin', true ) == 1 ) {
					$kaiin_logo = '<span class="fudo_kaiin_type_logo"><img src="' . WP_PLUGIN_URL . '/fudou/img/kaiin_s.jpg" alt="会員物件" /></span>';
					echo apply_filters( 'fudou_kaiin_logo_view', $kaiin_logo );
				} 
				do_action( 'fudo_kaiin_type_logo', $post_id );	//会員ロゴ


				do_action( 'fodou_top_bukken8', $post_id, $kaiin, $kaiin2 );


				echo '<span style="float:right;" class="box1low"><a href="' . $post_url . '">→物件詳細</a></span>';
				echo '</div>';


				do_action( 'fodou_top_bukken9', $post_id, $kaiin, $kaiin2 );


				echo '</li>';

			}	//loop

			echo '</ul>';

			echo '</div>';
			echo $after_widget;

			$top_widget_id = str_replace( '-' , '_' ,$args['widget_id']);

			//jquery.matchHeight.js
			?>
			<script type="text/javascript">

				<?php if( apply_filters( 'fudou_imagesloaded_use', true ) ){  ?>
					imagesLoaded( '#box<?php echo $args['widget_id']; ?>', function(){
						setTimeout('topbukken<?php echo $top_widget_id; ?>()', 200); 
					});
				<?php }else{ ?>
					setTimeout('topbukken<?php echo $top_widget_id; ?>()', 1000); 
				<?php } ?>

				function topbukken<?php echo $top_widget_id; ?>() { 
					jQuery.noConflict();
					var jtop$ = jQuery;
					jtop$(function() {
					    jtop$('#<?php echo $args['widget_id']; ?>_1 > li').matchHeight();

					});
				}
			</script>
			<?php

		}


	}
} // Class fudo_widget_top_r














// 売買路線カテゴリ
class fudo_widget_b_r extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_b_r', 			// Base ID
			'売買路線カテゴリ' ,		// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? esc_attr($instance['tenkai']) : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('tenkai'); ?>">
		階層展開 <select class="widefat" id="<?php echo $this->get_field_id('tenkai'); ?>" name="<?php echo $this->get_field_name('tenkai'); ?>">
			<option value="0"<?php if($tenkai == 0){echo ' selected="selected"';} ?>>展開する</option>
			<option value="1"<?php if($tenkai == 1){echo ' selected="selected"';} ?>>クリックで展開</option>
		</select></label></p>

		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		global $wpdb;

		$site = home_url( '/' ); 

		//種別
		$bukken_shubetsu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

		// outputs the content of the widget
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? $instance['tenkai'] : '';

		if($tenkai == '1'){
			?>
			<style type="text/css"> 
			<!--
			.children1r { display:none; }
			// -->
			</style>
			<script type="text/javascript">
				function tree1r(menu_class,menu_id) {
					var ul=document.getElementById(menu_id);
					if (ul.style.display == "block") ul.style.display="none";
					else {
						var sib=ul.parentNode.childNodes;
						for (var i=0; i < sib.length; i++)
							if (sib[i].className == menu_class) sib[i].style.display="none";
							ul.style.display="block";
					}
				}
			</script>
			<?php 
		}

	        extract( $args );
		echo $before_widget;

		$shu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$mid = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : '';
		$nor = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : '';

	//	$so  = isset($_GET['so']) ?  esc_attr( stripslashes($_GET['so']))  : apply_filters( 'bukken_sort', '' );
	//	$ord = isset($_GET['ord']) ? esc_attr( stripslashes($_GET['ord'])) : apply_filters( 'bukken_ord', '' );

		if ( $shu == "1" ){
			echo '<style type="text/css">';
			echo "\n<!--\n";
			echo '.children1r_'.$mid.' { display:block; }';
			echo "\n-->\n";
			echo '</style>';
		}



		$sql  = " SELECT DISTINCT DTR.rosen_name,DTR.rosen_id,DTS.station_name, DTS.station_id ,DTS.station_ranking";
		$sql .= " FROM (((((($wpdb->posts AS P ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";
		$sql .= " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON CAST( PM_1.meta_value AS SIGNED ) = DTR.rosen_id) ";
		$sql .= " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTS.rosen_id = DTR.rosen_id AND  CAST( PM.meta_value AS SIGNED ) = DTS.station_id)";

		//検索 SQL 表示制限 INNER JOIN
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

		$sql .= " WHERE";
		$sql .= "  ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki1' ";
		$sql .= " AND PM_1.meta_key='koutsurosen1' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value < 3000 ";

		//検索 SQL 表示制限 WHERE
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

		$sql .= " ) ";
		$sql .= " OR ";
		$sql .= " ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki2' ";
		$sql .= " AND PM_1.meta_key='koutsurosen2' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value < 3000 ";

		//検索 SQL 表示制限 WHERE
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

		$sql .= " ) ";

	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {

			if ( $title ){
				echo $before_title . $title . $after_title; 
			}else{
				echo $before_title . '売買路線カテゴリ' . $after_title; 
			}

			//ソート
			foreach($metas as $key => $row){
				$foo[$key] = $row["rosen_name"];
				$bar[$key] = $row["station_ranking"];
			}
			array_multisort($foo,SORT_DESC,$bar,SORT_ASC,$metas);


			$tmp_rosen_id= '';
			echo '<ul>';
			foreach ( $metas as $meta ) {

				$rosen_name =  $meta['rosen_name'];
				$rosen_id   =  $meta['rosen_id'];
				$station_name =  $meta['station_name'];
				$station_id   =  $meta['station_id'];

				if( $tmp_rosen_id != $rosen_id){
					if( $tmp_rosen_id != '')
						echo "</ul>\n";

					//路線表示
					echo '<li class="cat-item cat-item'.$rosen_id.'">';
					if( $mid == $rosen_id && $bukken_shubetsu == 1 ) echo '<b>';
					if($tenkai == '1'){
						echo "<a href=\"javascript:tree1r('children1r_$rosen_id','children1r_$rosen_id');\">$rosen_name</a>";
					}else{
						echo  '<a href="'.$site.'?bukken=rosen&amp;shu=1&amp;mid='.$rosen_id.'&amp;nor=&amp;paged=&amp;so=&amp;ord=">'.$rosen_name.'</a>';
					}
					if( $mid == $rosen_id && $bukken_shubetsu == 1 ) echo '</b>';
					echo '<ul class="children children1r children1r_'.$rosen_id.'" id="children1r_'.$rosen_id.'">';
				}


				//駅表示
					echo '<li class="cat-item current-cat">';
					if( $nor == $station_id && $bukken_shubetsu == 1 ) echo '<b>';
					echo  '<a href="'.$site.'?bukken=station&amp;shu=1&amp;mid='.$rosen_id.'&amp;nor='.$station_id.'&amp;paged=&amp;so=&amp;ord=">'.$station_name.'</a>';
					if( $nor == $station_id && $bukken_shubetsu == 1 ) echo '</b>';
					echo '</li>';

				$tmp_rosen_id   = $rosen_id;

			}
			echo "</ul>\n";
			echo "</li>\n";
			echo "</ul>\n";
		}
		echo $after_widget;

	}
} // Class fudo_widget_b_r









// 賃貸路線カテゴリ
class fudo_widget_r_r extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_r_r', 			// Base ID
			'賃貸路線カテゴリ' ,		// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? esc_attr($instance['tenkai']) : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('tenkai'); ?>">
		階層展開 <select class="widefat" id="<?php echo $this->get_field_id('tenkai'); ?>" name="<?php echo $this->get_field_name('tenkai'); ?>">
			<option value="0"<?php if($tenkai == 0){echo ' selected="selected"';} ?>>展開する</option>
			<option value="1"<?php if($tenkai == 1){echo ' selected="selected"';} ?>>クリックで展開</option>
		</select></label></p>

		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		global $wpdb;

		$site = home_url( '/' ); 

		//種別
		$bukken_shubetsu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

		// outputs the content of the widget
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? $instance['tenkai'] : '';

		if($tenkai == '1'){
?>
			<style type="text/css"> 
			<!--
			.children2r { display:none; }
			// -->
			</style>
			<script type="text/javascript"> 
				function tree2r(menu_class,menu_id) {
					var ul=document.getElementById(menu_id);
					if (ul.style.display == "block") ul.style.display="none";
					else {
						var sib=ul.parentNode.childNodes;
						for (var i=0; i < sib.length; i++)
							if (sib[i].className == menu_class) sib[i].style.display="none";
							ul.style.display="block";
					}
				}
			</script>
<?php 
		}

	        extract( $args );

		echo $before_widget;

		$shu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$mid = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : '';
		$nor = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : '';

		if ( $shu == "2" ){
			echo '<style type="text/css">';
			echo "\n<!--\n";
			echo '.children2r_'.$mid.' { display:block; }';
			echo "\n-->\n";
			echo '--></style>';
		}


		$sql  = " SELECT DISTINCT DTR.rosen_name,DTR.rosen_id,DTS.station_name, DTS.station_id ,DTS.station_ranking";
		$sql .= " FROM (((((($wpdb->posts AS P ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
		$sql .= " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";
		$sql .= " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON CAST( PM_1.meta_value AS SIGNED ) = DTR.rosen_id) ";
		$sql .= " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTS.rosen_id = DTR.rosen_id AND  CAST( PM.meta_value AS SIGNED ) = DTS.station_id)";

		//検索 SQL 表示制限 INNER JOIN
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

		$sql .= " WHERE";
		$sql .= "  ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki1' ";
		$sql .= " AND PM_1.meta_key='koutsurosen1' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value > 3000 ";

		//検索 SQL 表示制限 WHERE
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

		$sql .= " ) ";
		$sql .= " OR ";
		$sql .= " ( P.post_status='publish' ";
		$sql .= " AND P.post_password = '' ";
		$sql .= " AND P.post_type ='fudo' ";
		$sql .= " AND PM.meta_key='koutsueki2' ";
		$sql .= " AND PM_1.meta_key='koutsurosen2' ";
		$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
		$sql .= " AND PM_2.meta_value > 3000 ";

		//検索 SQL 表示制限 WHERE
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

		$sql .= " ) ";


	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {

			if ( $title ){
				echo $before_title . $title . $after_title; 
			}else{
				echo $before_title . '賃貸路線カテゴリ' . $after_title; 
			}

			//ソート
			foreach($metas as $key => $row){
				$foo[$key] = $row["rosen_name"];
				$bar[$key] = $row["station_ranking"];
			}
			array_multisort($foo,SORT_DESC,$bar,SORT_ASC,$metas);


			$tmp_rosen_id= '';
			echo '<ul>';
			foreach ( $metas as $meta ) {

				$rosen_name =  $meta['rosen_name'];
				$rosen_id   =  $meta['rosen_id'];
				$station_name =  $meta['station_name'];
				$station_id   =  $meta['station_id'];

				if( $tmp_rosen_id != $rosen_id){
					if( $tmp_rosen_id != '')
						echo "</ul>\n";

					//路線表示
					echo '<li class="cat-item cat-item'.$rosen_id.'">';
					if( $mid == $rosen_id && $bukken_shubetsu == 2 ) echo '<b>';
					if($tenkai == '1'){
						echo "<a href=\"javascript:tree2r('children2r_$rosen_id','children2r_$rosen_id');\">$rosen_name</a>";
					}else{
						echo  '<a href="'.$site.'?bukken=rosen&amp;shu=2&amp;mid='.$rosen_id.'&amp;nor=&amp;paged=&amp;so=&amp;ord=">'.$rosen_name.'</a>';
					}
					if( $mid == $rosen_id && $bukken_shubetsu == 2 ) echo '</b>';
					echo '<ul class="children children2r children2r_'.$rosen_id.'" id="children2r_'.$rosen_id.'">';
				}


				//駅表示
					echo '<li class="cat-item current-cat">';
					if( $nor == $station_id && $bukken_shubetsu == 2 ) echo '<b>';
					echo  '<a href="'.$site.'?bukken=station&amp;shu=2&amp;mid='.$rosen_id.'&amp;nor='.$station_id.'&amp;paged=&amp;so=&amp;ord=">'.$station_name.'</a>';
					if( $nor == $station_id && $bukken_shubetsu == 2 ) echo '</b>';
					echo '</li>';

				$tmp_rosen_id   = $rosen_id;

			}

				echo "</ul>\n";

			echo "</li>\n";
			echo "</ul>\n";
		}


		echo $after_widget;

	}
} // Class fudo_widget_r_r









// 売買地域カテゴリ
class fudo_widget_b_c extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_b_c', 			// Base ID
			'売買地域カテゴリ' ,		// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? esc_attr($instance['tenkai']) : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('tenkai'); ?>">
		階層展開 <select class="widefat" id="<?php echo $this->get_field_id('tenkai'); ?>" name="<?php echo $this->get_field_name('tenkai'); ?>">
			<option value="0"<?php if($tenkai == 0){echo ' selected="selected"';} ?>>展開する</option>
			<option value="1"<?php if($tenkai == 1){echo ' selected="selected"';} ?>>クリックで展開</option>
		</select></label></p>
		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		global $wpdb;

		$site = home_url( '/' ); 

		//種別
		$bukken_shubetsu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

		// outputs the content of the widget
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? $instance['tenkai'] : '';

		if($tenkai == '1'){
?>
			<style type="text/css"> 
			<!--
			.children1c { display:none; }
			// -->
			</style>
			<script type="text/javascript"> 
				function tree1c(menu_class,menu_id) {
					var ul=document.getElementById(menu_id);
					if (ul.style.display == "block") ul.style.display="none";
					else {
						var sib=ul.parentNode.childNodes;
						for (var i=0; i < sib.length; i++)
							if (sib[i].className == menu_class) sib[i].style.display="none";
							ul.style.display="block";
					}
				}
			</script>
<?php 
		}

	        extract( $args );

		echo $before_widget;

		$shu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$mid = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : '';
		$nor = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : '';

		if ( $shu == "1" ){
			echo '<style type="text/css">';
			echo "\n<!--\n";
			echo '.children1c_'.$mid.' { display:block; }';
			echo "\n-->\n";
			echo '</style>';
		}

		//県・市区
		$sql_sub  =  " SELECT DISTINCT CAST( LEFT(PM.meta_value,2) AS SIGNED ) AS ken_id, CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) AS shiku_id";
		$sql_sub .=  " FROM (($wpdb->posts AS P ";
		$sql_sub .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
		$sql_sub .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id)";

		//検索 SQL 表示制限 INNER JOIN
		$sql_sub .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

		$sql_sub .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
		$sql_sub .=  " AND PM.meta_key='shozaichicode' AND PM_1.meta_key='bukkenshubetsu' AND PM_1.meta_value < 3000";

		//検索 SQL 表示制限 WHERE
		$sql_sub .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

	//	$sql_sub = $wpdb->prepare($sql_sub,'');
		$ken_shiku_array = $wpdb->get_results( $sql_sub, ARRAY_A );

		//ソート
		if(!empty($ken_shiku_array)) {
			foreach($ken_shiku_array as $key => $row){
				$foo[$key] = $row["ken_id"];
				$bar[$key] = $row["shiku_id"];
			}
			array_multisort($foo,SORT_ASC,$bar,SORT_ASC,$ken_shiku_array);
		}


		//県
		$ken_array = array();
		foreach ( $ken_shiku_array as $ken_shiku_arr ) {
			$k_id   =  $ken_shiku_arr['ken_id'];
			$ken_ok = true;
			$i=0;
			foreach ( $ken_array as $ken_arr ) {
				if( $ken_array[$i]['ken_id'] == $k_id )	$ken_ok = false;
				$i++;
			}
			if($ken_ok)
				array_push($ken_array, array('ken_id' => $k_id));
		}

		if(!empty($ken_array)) {

			//ソート
			sort($ken_array);


			if ( $title ){
				echo $before_title . $title . $after_title; 
			}else{
				echo $before_title . '売買地域カテゴリ' . $after_title; 
			}

			echo '<ul>';
			foreach ( $ken_array as $ken_arr ) {

				$middle_area_id   =  sprintf("%02d", $ken_arr['ken_id'] );
				$middle_area_name = fudo_ken_name($middle_area_id);

				//県表示
				if($middle_area_id != '00'){
					echo '<li class="cat-item current-cat">';
					if( $mid == $middle_area_id && $bukken_shubetsu == 1 ) echo '<b>';
					if($tenkai == '1'){
						echo "<a href=\"javascript:tree1c('children1c_$middle_area_id','children1c_$middle_area_id');\">$middle_area_name</a>";
					}else{
						echo '<a href="'.$site.'?bukken=ken&amp;shu=1&amp;mid='.$middle_area_id.'&amp;nor=&amp;paged=&amp;so=&amp;ord=">'.$middle_area_name.'</a>';
					}
					if( $mid == $middle_area_id && $bukken_shubetsu == 1 ) echo '</b>';


					//市区表示
					if(!empty($ken_shiku_array)) {
						$tmp_code = '0';
						foreach ( $ken_shiku_array as $ken_shiku_arr ) {
							if($middle_area_id == $ken_shiku_arr['ken_id']){
								$tmp_code .= ',' .  $ken_shiku_arr['shiku_id'];
							}
						}
					}

					$sql2  =   " SELECT DISTINCT NA.narrow_area_name, NA.narrow_area_id";
					$sql2 .=   " FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " AS NA ";
					$sql2 .=   " WHERE NA.middle_area_id = $middle_area_id ";
					$sql2 .=   " AND NA.narrow_area_id IN ($tmp_code) ";
					$sql2 .=   " ORDER BY NA.narrow_area_id";
				//	$sql2 = $wpdb->prepare($sql2,'');
					$metas2 = $wpdb->get_results( $sql2, ARRAY_A );
					if(!empty($metas2)) {
						echo '<ul class="children children1c children1c_'.$middle_area_id.'" id="children1c_'.$middle_area_id.'">';
						foreach ( $metas2 as $meta2 ) {
							$narrow_area_name =  $meta2['narrow_area_name'];
							$narrow_area_id =    $meta2['narrow_area_id'];

							echo '<li class="cat-item">';
							if( $mid == $middle_area_id && $nor == $narrow_area_id && $bukken_shubetsu == 1 ) echo '<b>';
							echo '<a href="'.$site.'?bukken=shiku&amp;shu=1&amp;mid='.$middle_area_id.'&amp;nor='.$narrow_area_id.'&amp;paged=&amp;so=&amp;ord=">'.$narrow_area_name.'</a>';
							if( $mid == $middle_area_id && $nor == $narrow_area_id && $bukken_shubetsu == 1 ) echo '</b>';
							echo '</li>';
						}
						echo "</ul>\n";
					}
					echo "</li>\n";
				}
			}
			echo "</ul>\n";

		}

		echo $after_widget;

	}
} // Class fudo_widget_b_c









// 賃貸地域カテゴリ
class fudo_widget_r_c extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_r_c', 			// Base ID
			'賃貸地域カテゴリ' ,		// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? esc_attr($instance['tenkai']) : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('tenkai'); ?>">
		階層展開 <select class="widefat" id="<?php echo $this->get_field_id('tenkai'); ?>" name="<?php echo $this->get_field_name('tenkai'); ?>">
			<option value="0"<?php if($tenkai == 0){echo ' selected="selected"';} ?>>展開する</option>
			<option value="1"<?php if($tenkai == 1){echo ' selected="selected"';} ?>>クリックで展開</option>
		</select></label></p>

		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		global $wpdb;

		$site = home_url( '/' ); 

		//種別
		$bukken_shubetsu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

		// outputs the content of the widget
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$tenkai = isset($instance['tenkai']) ? $instance['tenkai'] : '';

		if($tenkai == '1'){
?>
			<style type="text/css"> 
			<!--
			.children2c { display:none; }
			// -->
			</style>
			<script type="text/javascript"> 
				function tree2c(menu_class,menu_id) {
					var ul=document.getElementById(menu_id);
					if (ul.style.display == "block") ul.style.display="none";
					else {
						var sib=ul.parentNode.childNodes;
						for (var i=0; i < sib.length; i++)
							if (sib[i].className == menu_class) sib[i].style.display="none";
							ul.style.display="block";
					}
				}
			</script>
<?php 
		}

	        extract( $args );

		echo $before_widget;

		$shu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$mid = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : '';
		$nor = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : '';

		if ( $shu == "2" ){
			echo '<style type="text/css">';
			echo "\n<!--\n";
			echo '.children2c_'.$mid.' { display:block; }';
			echo "\n-->\n";
			echo '</style>';
		}

		//県・市区
		$sql_sub  =  " SELECT DISTINCT CAST( LEFT(PM.meta_value,2) AS SIGNED ) AS ken_id, CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) AS shiku_id";
		$sql_sub .=  " FROM (($wpdb->posts AS P ";
		$sql_sub .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
		$sql_sub .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id)";

		//検索 SQL 表示制限 INNER JOIN
		$sql_sub .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

		$sql_sub .=  " WHERE PM.meta_key='shozaichicode' AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' AND PM_1.meta_key='bukkenshubetsu'";
		$sql_sub .=  " AND PM_1.meta_value > 3000";

		//検索 SQL 表示制限 WHERE
		$sql_sub .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

	//	$sql_sub = $wpdb->prepare($sql_sub,'');
		$ken_shiku_array = $wpdb->get_results( $sql_sub, ARRAY_A );

		//ソート
		if(!empty($ken_shiku_array)) {
			foreach($ken_shiku_array as $key => $row){
				$foo[$key] = $row["ken_id"];
				$bar[$key] = $row["shiku_id"];
			}
			array_multisort($foo,SORT_ASC,$bar,SORT_ASC,$ken_shiku_array);
		}

		//県
		$ken_array = array();
		foreach ( $ken_shiku_array as $ken_shiku_arr ) {
			$k_id   =  $ken_shiku_arr['ken_id'];
			$ken_ok = true;
			$i=0;
			foreach ( $ken_array as $ken_arr ) {
				if( $ken_array[$i]['ken_id'] == $k_id )	$ken_ok = false;
				$i++;
			}
			if($ken_ok)
				array_push($ken_array, array('ken_id' => $k_id));
		}

		if(!empty($ken_array)) {

			//ソート
			sort($ken_array);

			if ( $title ){
				echo $before_title . $title . $after_title; 
			}else{
				echo $before_title . '賃貸地域カテゴリ' . $after_title; 
			}

			echo '<ul>';

			foreach ( $ken_array as $ken_arr ) {

				$middle_area_id   =  sprintf("%02d", $ken_arr['ken_id'] );
				$middle_area_name = fudo_ken_name($middle_area_id);


				//県表示
				if($middle_area_id != '00'){
					echo '<li class="cat-item current-cat">';
					if( $mid == $middle_area_id && $bukken_shubetsu == 2 ) echo '<b>';
					if($tenkai == '1'){
						echo "<a href=\"javascript:tree2c('children2c_$middle_area_id','children2c_$middle_area_id');\">$middle_area_name</a>";
					}else{
						echo '<a href="'.$site.'?bukken=ken&amp;shu=2&amp;mid='.$middle_area_id.'&amp;nor=&amp;paged=&amp;so=&amp;ord=">'.$middle_area_name.'</a>';
					}
					if( $mid == $middle_area_id && $bukken_shubetsu == 2 ) echo '</b>';


					//市区表示
					if(!empty($ken_shiku_array)) {
						$tmp_code = '0';
						foreach ( $ken_shiku_array as $ken_shiku_arr ) {
							if($middle_area_id == $ken_shiku_arr['ken_id']){
								$tmp_code .= ',' .  $ken_shiku_arr['shiku_id'];
							}
						}
					}

					$sql2 =   "SELECT DISTINCT NA.narrow_area_name, NA.narrow_area_id";
					$sql2 .=   " FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " AS NA ";
					$sql2 .=   " WHERE NA.middle_area_id = $middle_area_id ";
					$sql2 .=   " AND NA.narrow_area_id IN ($tmp_code) ";
					$sql2 .=   " ORDER BY NA.narrow_area_id";
				//	$sql2 = $wpdb->prepare($sql2,'');
					$metas2 = $wpdb->get_results( $sql2, ARRAY_A );
					if(!empty($metas2)) {
						echo '<ul class="children children2c children2c_'.$middle_area_id.'" id="children2c_'.$middle_area_id.'">';
						foreach ( $metas2 as $meta2 ) {
							$narrow_area_name =  $meta2['narrow_area_name'];
							$narrow_area_id =    $meta2['narrow_area_id'];

							echo '<li class="cat-item">';
							if( $mid == $middle_area_id && $nor == $narrow_area_id && $bukken_shubetsu == 2 ) echo '<b>';
							echo '<a href="'.$site.'?bukken=shiku&amp;shu=2&amp;mid='.$middle_area_id.'&amp;nor='.$narrow_area_id.'&amp;paged=&amp;so=&amp;ord=">'.$narrow_area_name.'</a>';
							if( $mid == $middle_area_id && $nor == $narrow_area_id && $bukken_shubetsu == 2 ) echo '</b>';
							echo '</li>';
						}
						echo "</ul>\n";
					}
					echo "</li>\n";
				}
			}
			echo "</ul>\n";

		}

		echo $after_widget;

	}
} // Class fudo_widget_r_c








// 物件カテゴリ
class fudo_widget_cat extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_cat', 			// Base ID
			'物件カテゴリ' ,		// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$exclude =isset($instance['exclude']) ?  esc_attr($instance['exclude']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>


		<p><label for="exclude">除外カテゴリ(カテゴリID カンマ区切り)
		<input class="widefat" id="<?php echo $this->get_field_name('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $exclude; ?>" /></label></p>

		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		// outputs the content of the widget
	        extract( $args );
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$exclude =isset($instance['exclude']) ?  apply_filters('widget_title', $instance['exclude']) : '';

		echo $before_widget;

		if($title){
			echo $before_title . $title . $after_title; 
		}else{
			echo $before_title . '物件カテゴリ' . $after_title; 
		}

		echo '<ul>';

		$args = array(
			'show_option_all'    => '',
			'orderby'            => 'slug',
			'order'              => 'ASC',
			'show_last_update'   => 0,		//（各カテゴリーに属する）投稿の最終更新日を表示するか。初期値は非表示(FALSE)。 
			'style'              => 'list',
			'show_count'         => 0,		//各カテゴリーに投稿数を表示するか。初期値は false（非表示）。有効値
			'hide_empty'         => 1,		//投稿のないカテゴリーを非表示にするか。有効値： 
			'use_desc_for_title' => 1,		//カテゴリーの概要をリンク（アンカータグ）の title 属性に挿入（<a title="<em>カテゴリー概要</em>"
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => $exclude,	//指定したカテゴリー（複数可）をリストから除外。除外するカテゴリーID をカンマ区切りで昇順に指定。用例を参照
			'exclude_tree'       => '',		//結果から除外するカテゴリーツリー。バージョン 2.7.1 以降のみ。 
			'include'            => '',		//指定したカテゴリーID のみリストに表示。カンマ区切りで昇順に指定。用例を参照。 
			'hierarchical'       => true,
			'title_li'           => __( '' ),
			'number'             => NULL,		//表示するカテゴリー数を設定。SQL の LIMIT 値となります。初期値は無制限
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,		//子カテゴリーの項目を含めてリンクまたは投稿数を計算する。show_counts または hierarchical が true の場合、自動的に true に設定される
			'taxonomy'           => 'bukken',
			'walker'             => 'Walker_Category'
		 );

		wp_list_categories( $args );

		echo '	</ul>';

		echo $after_widget;

	}
} // Class fudo_widget










// 物件投稿タグ(タグクラウド)
class fudo_widget_tag extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_tag', 			// Base ID
			'物件投稿タグ(タグクラウド)' ,	// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$exclude =isset($instance['exclude']) ?  esc_attr($instance['exclude']) : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="exclude">除外タグ(タグID カンマ区切り)
		<input class="widefat" id="<?php echo $this->get_field_name('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $exclude; ?>" /></label></p>
		<?php 

	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		// outputs the content of the widget
	        extract( $args );
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		$exclude =isset($instance['exclude']) ?  apply_filters('widget_title', $instance['exclude']) : '';

		echo $before_widget;

		if ( $title ){
			echo $before_title . $title . $after_title; 
		}

		$args = array(
			'smallest' => 8, 		//一番小さいタグ
			'largest' => 16,		//一番大きいタグ
			'unit' => 'pt', 		//フォントサイズの単位
			'number' => 45,  		//最大タグ数
			'format' => 'flat',		//ホワイトスペース区切り
			'orderby' => 'name', 		//タグ名順に表示 
			'order' => 'ASC',		//ソート
			'exclude' => $exclude, 		//表示しないタグIDを指定
			'include' => '', 		//表示するタグIDを指定
			'link' => 'view', 	
			'taxonomy' => 'bukken_tag', 
			'echo' => true
		);

		echo '<div class="tagcloud">';
		wp_tag_cloud( $args);
		echo '</div>';

		echo $after_widget;

	}
} // Class fudo_widget_tad










// 物件検索(キーワード)
class fudo_widget_search extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_search', 			// Base ID
			'物件検索(キーワード)' ,	// Name
			array( 'description' => '', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {
		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<?php 
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		// outputs the content of the widget
	        extract( $args );
		$title  = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; 
/*
		$form = '<form method="get" id="searchform" action="' . home_url( '/' ) . '" >
			<label class="screen-reader-text assistive-text" for="s">' . __('Search for:') . '</label>
			<input type="text" class="field" value="' . get_search_query() . '" name="s" id="s" placeholder="キーワード" />
			<input type="hidden" value="search" name="bukken" />
			<input type="submit" id="searchsubmit" class="submit" value="検索" />
			</form>';
*/
		//HTML5
		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<input type="hidden" value="search" name="bukken" />
			<label>
				<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
				<input type="search" class="search-field" placeholder="物件キーワード" value="' . get_search_query() . '" name="s" />
			</label>
			<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
		</form>';


		echo $form;
		echo $after_widget;

	}
} // Class fudo_widget_tad

