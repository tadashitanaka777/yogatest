<?php
/**
 * The Template for displaying fudou page posts.
 *
 * Template Name: 売買条件検索
 * Template File: page-jyoken-b2016.php
 * 
 * @package WordPress4.6
 * @subpackage Fudousan Plugin
 * @subpackage Twenty_Sixteen
 * Version: 1.7.6
 */

get_header(); 

//売買
$shub = 1;

/*
 * If you want to erase from Content
 * Fudousn Share Buttons
 */
if( isset( $fudou_share_buttons ) ){
	remove_filter( 'the_content', array( $fudou_share_buttons, 'fudou_share_the_content' ) );
}

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<?php twentysixteen_post_thumbnail(); ?>

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

	</article><!-- #post-## -->
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
