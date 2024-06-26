<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Exalt
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

		/**
		 * Before Main Content Hook
		 */
		do_action( 'exalt_before_main_content' );

		while ( have_posts() ) :
			
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		/**
		 * After Main Content Hook
		 */
		do_action( 'exalt_after_main_content' );

		?>

	</main><!-- #main -->

<?php
$exalt_post_layout = exalt_get_layout();
if ( 'right-sidebar' === $exalt_post_layout || 'left-sidebar' === $exalt_post_layout ) {
	get_sidebar();
}
get_footer();
