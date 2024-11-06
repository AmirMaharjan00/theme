<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;

get_header();

if( did_action( 'elementor/loaded' ) && class_exists( 'Nekit_Render_Templates_Html' ) ) :
	$Nekit_render_templates_html = new Nekit_Render_Templates_Html();
	if( $Nekit_render_templates_html->is_template_available('single') ) {
		$single_rendered = true;
		echo $Nekit_render_templates_html->current_builder_template();
	} else {
		$single_rendered = false;
	}
else :
	$single_rendered = false;
endif;

if( ! $single_rendered ) :
	do_action( 'blogmatic_main_content_opening' );
	$page_settings_sidebar_layout = BMC\blogmatic_get_customizer_option( 'page_settings_sidebar_layout' );
	$page_sidebar_layout_meta = metadata_exists( 'post', get_the_ID(), 'page_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) : 'customizer-setting';
	$array = [
		'post_id'	=>	get_the_ID(),
		'customizer_layout'	=>	$page_settings_sidebar_layout
	];
	$array['position'] = ['left-sidebar', 'both-sidebar'];
	if( in_array( $page_sidebar_layout_meta, [ 'left-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( 'page_sidebar_layout', $array );
	?>
		<main id="primary" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

	<?php
	$array['position'] = ['right-sidebar', 'both-sidebar'];
	if( in_array( $page_sidebar_layout_meta, [ 'right-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( 'page_sidebar_layout', $array );
	do_action( 'blogmatic_main_content_closing' );
endif;

get_footer();