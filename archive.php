<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;

get_header();

if( did_action( 'elementor/loaded' ) && class_exists( 'Nekit_Render_Templates_Html' ) ) :
	$Nekit_render_templates_html = new Nekit_Render_Templates_Html();
	if( $Nekit_render_templates_html->is_template_available('archive') ) {
		$archive_rendered = true;
		echo $Nekit_render_templates_html->current_builder_template();
	} else {
		$archive_rendered = false;
	}
else :
	$archive_rendered = false;
endif;

if( ! $archive_rendered ) :
	do_action( 'blogmatic_main_content_opening' );
	$archive_sidebar_layout = BMC\blogmatic_get_customizer_option( 'archive_sidebar_layout' );
	$elementClass = ' archive-align--' . BMC\blogmatic_get_customizer_option('archive_post_elements_alignment');

	$current_id = get_queried_object_id();
	if( is_category() ) {
		$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_category_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_category_sidebar_custom_meta_field', true ) : 'customizer-setting';
		$array = [
			'post_id'	=>	$current_id,
			'customizer_layout'	=>	$archive_sidebar_layout
		];
		$array['position'] = ['left-sidebar', 'both-sidebar'];
		$array['meta_type'] = 'term';
		if( in_array( $archive_sidebar_layout_meta, [ 'left-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( '_blogmatic_category_sidebar_custom_meta_field', $array );
	} elseif( is_tag() ) {
		$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_post_tag_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_post_tag_sidebar_custom_meta_field', true ) : 'customizer-setting';
		$array = [
			'post_id'	=>	$current_id,
			'customizer_layout'	=>	$archive_sidebar_layout
		];
		$array['position'] = ['left-sidebar', 'both-sidebar'];
		$array['meta_type'] = 'term';
		if( in_array( $archive_sidebar_layout_meta, [ 'left-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( '_blogmatic_post_tag_sidebar_custom_meta_field', $array );
	} else {
		if( in_array( $archive_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
	}

	?>
		<main id="primary" class="site-main">
			<?php
				/**
				 * Hook - blogmatic_page_header_hook
				 * 
				 * Hooked - blogmatic_archive_header_html - 10
				 */
				do_action( 'blogmatic_page_header_hook' );
				if ( have_posts() ) :
					$ads_info = blogmatic_algorithm_to_push_ads_in_archive();
					$count = 0;
					echo '<div class="blogmatic-inner-content-wrap'. esc_attr( $elementClass ) .'">'; //inner-content-wrap
						while ( have_posts() ) : the_post();
							if( ! is_null( $ads_info ) ) :
								if( in_array( $wp_query->current_post, $ads_info['random_numbers'] ) ) :
									blogmatic_random_post_archive_advertisement_part( is_array( $ads_info['ads_to_render'] ) ? $ads_info['ads_to_render'][$count] : $ads_info['ads_to_render'] );
									$count++;
								endif;
							endif;
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/archive/content', blogmatic_get_post_format(), [ 'archive'	=>	true ] );
							// $post_counter++;
						endwhile;
					echo '</div>'; //  end: blogmatic-inner-content-wrap
					
					/**
					 * hook - blogmatic_pagination_link_hook
					 * 
					 * @package Blogmatic Pro
					 * @since 1.0.0
					 */
					do_action( 'blogmatic_pagination_link_hook' );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
			?>
		</main><!-- #main -->

	<?php
	if( is_category() ) {
		$array['position'] = ['right-sidebar', 'both-sidebar'];
		if( in_array( $archive_sidebar_layout_meta, [ 'right-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( '_blogmatic_category_sidebar_custom_meta_field', $array );
	} elseif( is_tag() ) {
		$array['position'] = ['right-sidebar', 'both-sidebar'];
		if( in_array( $archive_sidebar_layout_meta, [ 'right-sidebar', 'both-sidebar', 'customizer-setting' ] ) ) blogmatic_get_sidebar( '_blogmatic_post_tag_sidebar_custom_meta_field', $array );
	} else {
		if( in_array( $archive_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
	}
	do_action( 'blogmatic_main_content_closing' );
endif;

get_footer();