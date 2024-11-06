<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
require get_template_directory() . '/builder/responsive-header.php';
use Blogmatic_Builder as BB;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php blogmatic_schema_body_attributes(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blogmatic-pro' ); ?></a>
	<?php
		if( did_action( 'elementor/loaded' ) && class_exists( 'Nekit_Render_Templates_Html' ) ) :
			$Nekit_render_templates_html = new Nekit_Render_Templates_Html();
			if( $Nekit_render_templates_html->is_template_available('header') ) {
				$header_rendered = true;
				echo $Nekit_render_templates_html->current_builder_template();
			} else {
				$header_rendered = false;
			}
		else :
			$header_rendered = false;
		endif;

		if( ! $header_rendered ) :
			/**
			 * hook - blogmatic_page_prepend_hook
			 * 
			 * hooked - blogmatic_loader_html - 1
			 * hooked - blogmatic_custom_header_html - 20
			 * 
			 * @package Blogmatic Pro
			 * @since 1.0.0
			 */
			do_action( "blogmatic_page_prepend_hook" );

			$header_builder_section_width = BMC\blogmatic_get_customizer_option( 'header_builder_section_width' );
			$headerClass = 'site-header layout--one';
			$headerClass .= ' ' . $header_builder_section_width;
			?>
				<header id="masthead" class="<?php echo esc_attr( $headerClass ); ?>">
					<div class="blogmatic-container">
						<div class="row">
							<?php
								new BB\Header_Builder_Render();
								new BB\Responsive_Header_Builder_Render();
							?>
						</div>
					</div>
					<?php
						if( is_single() || is_page() ) :
							echo '<div class="single-progress"></div>';
						endif;
					?>
				</header><!-- #masthead -->
			<?php

			/**
			 * Hook - blogmatic_header_after_hook
			 * 
			 * Hooked  - blogmatic_main_banner_html - 10
			 * Hooked  - blogmatic_category_collection_html - 20
			 * Hooked  - blogmatic_carousel_html - 30
			 * 
			 * @since 1.0.0
			 */
			do_action( 'blogmatic_header_after_hook' );
			
			/**
			 * Function - blogmatic_get_video_playlist_above_archive
			 * File - hooks.php
			 * 
			 * @since 1.0.0
			 */
			blogmatic_get_video_playlist_above_archive();
		endif;