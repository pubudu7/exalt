<?php

/**
 * Header Top Bar
 */
function exalt_header_top_bar() {
    if ( has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : ?>
        <div class="exalt-top-bar desktop-only">
            <div class="top-bar-inner exalt-container">
                
                <?php do_action( 'exalt_before_top_bar_main' ); ?>

                <?php do_action( 'exalt_top_bar_main' ); ?>

                <?php do_action( 'exalt_after_top_bar_main' ); ?>

            </div><!-- .top-bar-inner .exalt-container -->
        </div><!-- .exalt-top-bar -->
    <?php endif; 
}
add_action( 'exalt_header_top', 'exalt_header_top_bar' );

/**
 * Header top bar menu.
 */
function exalt_header_top_menu() {
    if ( has_nav_menu( 'secondary') ) : ?>
        <nav class="secondary-menu exalt-menu" area-label="<?php esc_attr_e( 'Secondary Menu', 'exalt' ); ?>">
            <?php exalt_secondary_nav(); ?>
        </nav>
    <?php endif; 
}
add_action( 'exalt_top_bar_main', 'exalt_header_top_menu' );

/**
 * Header Image.
 */
function exalt_header_image_location() {
    $exalt_header_image_loc = get_theme_mod( 'exalt_header_image_location', 'before-header-inner' );
    if ( 'before-header-inner' === $exalt_header_image_loc ) {
        add_action( 'exalt_header_top', 'exalt_header_image', 15 );
    } elseif ( 'after-header-inner' === $exalt_header_image_loc ) {
        add_action( 'exalt_header_bottom', 'exalt_header_image', 5 );
    } elseif ( 'before-site-header' === $exalt_header_image_loc ) {
        add_action( 'exalt_before_header', 'exalt_header_image', 15 );
    } elseif ( 'after-site-header' === $exalt_header_image_loc ) {
        add_action( 'exalt_after_header', 'exalt_header_image', 5 );
    }
}
add_action( 'wp', 'exalt_header_image_location' );


/**
 * Sidebar header after.
 */
function exalt_sidebar_after_header() {
    if ( is_active_sidebar( 'header-3' ) ) :
    ?>
		<div class="exalt-sidebar-header-after">
			<div class="exalt-container">
				<?php dynamic_sidebar( 'header-3' ); ?>
			</div>
		</div>
    <?php
    endif;
}
add_action( 'exalt_after_header', 'exalt_sidebar_after_header' );

/**
 * Get Header Template Part.
 */
function exalt_header_template() {
    get_template_part( 'template-parts/header/header' );
}
add_action( 'exalt_header', 'exalt_header_template' );

/**
 * Header Sidebar
 */
function exalt_header_sidebar() {
    if ( is_active_sidebar( 'header-2' ) ) : ?>
        <div class="exalt-header-sidebar">
            <?php dynamic_sidebar( 'header-2' ); ?>
        </div>
    <?php endif;
}
add_action( 'exalt_after_header_main', 'exalt_header_sidebar', 7 );

/**
 * Mobile Menu toggle.
 */
function exalt_mobile_menu_toggle() {
    ?>
        <button class="exalt-mobile-menu-toggle">
            <span class="screen-reader-text"><?php esc_html_e( 'Main Menu', 'exalt' ); ?></span>
            <?php exalt_the_icon_svg( 'menu-bars' ); ?>
        </button>
    <?php
}
add_action( 'exalt_after_header_main', 'exalt_mobile_menu_toggle', 6 );

/**
 * Site branding.
 */
if ( ! function_exists( 'exalt_site_title' ) ) : 

	function exalt_site_title() {

		$exalt_site_title = get_bloginfo( 'title' );
		$exalt_description = get_bloginfo( 'description', 'display' );

		$hide_title = ( get_theme_mod( 'exalt_hide_site_title', false ) || '' == $exalt_site_title ) ? true : false;
		$hide_tagline = ( get_theme_mod( 'exalt_hide_site_tagline', false ) || '' == $exalt_description ) ? true : false;

		?>
		<div class="site-branding-container">
			<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif; ?>

			<div class="site-branding">
				<?php

				if ( ! $hide_title ) :

					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;

				endif;
				
				if ( ! $hide_tagline ) :
					?>
					<p class="site-description"><?php echo $exalt_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
		</div><!-- .site-branding-container -->
		<?php
	}
    add_action( 'exalt_before_header_main', 'exalt_site_title', 5 );

endif;