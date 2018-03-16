<?php
/*
 * 不動産プラグインウィジェット
 * @package WordPress4.3
 * @subpackage Fudousan Plugin
 * Version: 1.6.5
*/

//トップテキスト(タイトル非表示)
function fudou_widgetInit_top_txt() {
	register_widget('fudou_widget_top_txt');
}
add_action('widgets_init', 'fudou_widgetInit_top_txt');

//トップテキスト(タイトル非表示)
class fudou_widget_top_txt extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {
		parent::__construct(
			'fudo_top_txt', 			// Base ID
			'テキスト(HTML可)' ,		// Name
			array( 'description' => 'タイトルや装飾無しでテキスト(HTML可)表示', )	// Args
		);
	}


	//@see WP_Widget::form	
	function form($instance) {
		$title =   isset($instance['title']) ? esc_attr($instance['title']) : '';
		$top_txt = isset($instance['top_txt']) ? $instance['top_txt'] : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		管理用タイトル (非公開) <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('top_txt'); ?>">
		テキスト/HTML <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('top_txt'); ?>" name="<?php echo $this->get_field_name('top_txt'); ?>"><?php echo esc_textarea( $top_txt ); ?></textarea></label></p>
		<?php 
	}

	// @see WP_Widget::update
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	// @see WP_Widget::widget
	function widget($args, $instance) {
		// outputs the content of the widget
	        extract( $args );
	        $top_txt = isset($instance['top_txt']) ? $instance['top_txt'] : '';

		//	echo $before_widget;
			echo $top_txt;
		//	echo $after_widget;

	}
}
