<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

		?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'exalt' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php 
				/**
				 * Before blog entries hook.
				 * @since 1.0.0
				 */
				do_action( 'exalt_before_blog_entries' );
			?>

			<div id="blog-entries">

			<?php
			
			/**
			 * Before search loop hook
			 */
			do_action( 'exalt_before_loop', 'search' );

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			/**
			 * After index loop hook
			 */
			do_action( 'exalt_after_loop', 'search' );

			?>

			</div><!-- #blog-entries -->

		<?php

			exalt_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		/**
		 * After Main Content Hook
		 */
		do_action( 'exalt_after_main_content' );

		?>

	</main><!-- #main -->

<?php
$exalt_archive_layout = get_theme_mod( 'exalt_archive_layout', 'right-sidebar' );
if ( 'right-sidebar' === $exalt_archive_layout || 'left-sidebar' === $exalt_archive_layout ) {
	get_sidebar();
}
get_footer();
