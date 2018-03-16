<?php
/**
 * The Template for displaying fudou page posts.
 *
 * Template Name: 賃貸条件検索
 * Template File: page-jyoken-c.php
 * 
 * @package WordPress4.6
 * @subpackage Fudousan Plugin
 * @subpackage Twenty_XXXX
 * Version: 1.7.6
 */

get_header(); 

//賃貸
$shub = 2;

/*
 * If you want to erase from Content
 * Fudousn Share Buttons
 */
if( isset( $fudou_share_buttons ) ){
	remove_filter( 'the_content', array( $fudou_share_buttons, 'fudou_share_the_content' ) );
}

?>
<div id="container" class="site-content">
	<div id="content" role="main" class="jsearch">

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;


		/*
		 * 条件検索ページ(固定ページ)
		 *
		 * @since Fudousan  Plugin 1.7.6
		 * For page-jyoken-XXXXX.php
		 * do_action( 'fudou_page_jyoken_themes', $shub );
		 *
		 * @param int $shub.
		*/
		do_action( 'fudou_page_jyoken_themes', $shub );


		/**
		 * If you would set with other place you can set do_action code .
		 * Fudousan Share Buttons
		 */
		do_action( 'fudou_share_buttons_do', get_the_ID() );
		?>

	</div><!-- .entry-content -->

	</div><!-- .#content -->
</div><!-- .#container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
