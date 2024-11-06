<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
	$single_sidebar_layout = BMC\blogmatic_get_customizer_option( 'single_sidebar_layout' );
	$single_sidebar_layout_meta = metadata_exists( 'post', get_the_ID(), 'post_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'post_sidebar_layout', true ) : 'customizer-setting';
	$array = [
		'post_id'	=>	get_the_ID(),
		'customizer_layout'	=>	$single_sidebar_layout
	];
	$array['position'] = ['left-sidebar', 'both-sidebar'];
	if( in_array( $single_sidebar_layout_meta, [ 'left-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( 'post_sidebar_layout', $array );
	?>
		<main id="primary" class="site-main">
			<?php
				echo '<div class="blogmatic-inner-content-wrap">'; //inner-content-wrap
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'single' );
					endwhile; // End of the loop.
				echo '</div><!-- .blogmatic-inner-content-wrap -->'; //inner-content-wrap
			?>
		</main><!-- #main -->
	<?php
	$array['position'] = ['right-sidebar', 'both-sidebar'];
	if( in_array( $single_sidebar_layout_meta, [ 'right-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( 'post_sidebar_layout', $array );
	do_action( 'blogmatic_main_content_closing' );
endif;

get_footer();