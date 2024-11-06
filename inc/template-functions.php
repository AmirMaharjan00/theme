<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogmatic_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	$archive_post_layout = BMC\blogmatic_get_customizer_option( 'archive_post_layout' );
	if( is_archive() || is_home() ) {
		$archive_sidebar_layout_meta = 'customizer-setting';
		$archive_layout_meta = 'customizer-layout';
		$current_id = get_queried_object_id();
		if( is_category() ) {
			$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_category_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_category_sidebar_custom_meta_field', true ) : 'customizer-setting';
			$archive_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_category_archive_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_category_archive_custom_meta_field', true ) : 'customizer-layout';
		} else if( is_tag() ) {
			$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_post_tag_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_post_tag_sidebar_custom_meta_field', true ) : 'customizer-setting';
			$archive_layout_meta = metadata_exists( 'term', $current_id, '_blogmatic_post_tag_archive_custom_meta_field' ) ? get_term_meta( $current_id, '_blogmatic_post_tag_archive_custom_meta_field', true ) : 'customizer-layout';
		}
		$archive_sidebar_layout = BMC\blogmatic_get_customizer_option( 'archive_sidebar_layout' );
		$archive_post_column = BMC\blogmatic_get_customizer_option( 'archive_post_column' );
		$classes[] = 'archive-desktop-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['desktop'] ) );
		$classes[] = 'archive-tablet-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['tablet'] ) );
		$classes[] = 'archive-mobile-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['smartphone'] ) );
		$classes[] = 'archive--' . esc_attr( ( $archive_layout_meta == 'customizer-layout' ) ? $archive_post_layout : $archive_layout_meta )  . '-layout';
		$classes[] = 'archive--' . esc_attr( ( $archive_sidebar_layout_meta == 'customizer-setting' ) ? $archive_sidebar_layout : $archive_sidebar_layout_meta );
	}

	if( is_single() ) {
		$single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
		$single_sidebar_layout = BMC\blogmatic_get_customizer_option( 'single_sidebar_layout' );
		$single_sidebar_post_meta = metadata_exists( 'post', get_the_ID(), 'post_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'post_sidebar_layout', true ) : 'customizer-setting';
		$single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
		$classes[] = 'single-post--' . esc_attr( ( $single_layout_post_meta == 'customizer-layout' ) ? $single_post_layout : $single_layout_post_meta );
		$classes[] = 'single--' . esc_attr( ( $single_sidebar_post_meta == 'customizer-setting' ) ? $single_sidebar_layout : $single_sidebar_post_meta );
	}

	if( is_search() ) {
		$search_page_sidebar_layout = BMC\blogmatic_get_customizer_option( 'search_page_sidebar_layout' );
		$archive_post_column = BMC\blogmatic_get_customizer_option( 'archive_post_column' );
		$classes[] = 'archive-desktop-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['desktop'] ) );
		$classes[] = 'archive-tablet-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['tablet'] ) );
		$classes[] = 'archive-mobile-column--' . esc_attr( blogmatic_convert_number_to_numeric_string( $archive_post_column['smartphone'] ) );
		$classes[] = 'search-page--' . $search_page_sidebar_layout;
		$classes[] = 'archive--' . esc_attr( $archive_post_layout ) . '-layout';
	}

	if( is_404() ) {
		$error_page_sidebar_layout = BMC\blogmatic_get_customizer_option( 'error_page_sidebar_layout' );
		$classes[] = 'error-page--' . $error_page_sidebar_layout;
	}

	if( is_page() ) {
		$page_settings_sidebar_layout = BMC\blogmatic_get_customizer_option( 'page_settings_sidebar_layout' );
		$page_sidebar_post_meta = metadata_exists( 'post', get_the_ID(), 'page_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) : 'customizer-setting';
		$classes[] = 'page--' . esc_attr( ( $page_sidebar_post_meta == 'customizer-setting' ) ? $page_settings_sidebar_layout : $page_sidebar_post_meta);
	}

	$set_dark_mode_as_default = BMC\blogmatic_get_customizer_option( 'theme_mode_set_dark_mode_as_default' );
	$dark_mode_body_class = ( $set_dark_mode_as_default ) ? 'blogmatic-dark-mode' : 'blogmatic-light-mode';
	if( isset( $_COOKIE['themeMode'] ) ) :
		$classes[] = ( $_COOKIE['themeMode'] == 'light' ) ? 'blogmatic-light-mode' : 'blogmatic-dark-mode';
	else:
		$classes[] = ( $set_dark_mode_as_default ) ? 'blogmatic-dark-mode' : 'blogmatic-light-mode';
	endif;

	$website_layout = BMC\blogmatic_get_customizer_option ('website_layout');
	if( $website_layout ) $classes[] = $website_layout;

	$block_title_layout = BMC\blogmatic_get_customizer_option ('block_title_layout');
	$classes[] = 'block-title--' . esc_attr( $block_title_layout );
	
	$title_hover = BMC\blogmatic_get_customizer_option( 'post_title_hover_effects' );
	$classes[] = 'title-hover--' . esc_attr( $title_hover );

	$image_hover = BMC\blogmatic_get_customizer_option( 'site_image_hover_effects' );
	$classes[] = 'image-hover--' . esc_attr( $image_hover );

	$canvas_menu_position = BMC\blogmatic_get_customizer_option( 'canvas_menu_position' );
	$classes[] = 'blogmatic-canvas-position--' . esc_attr( $canvas_menu_position );

	$global_sidebar_option = BMC\blogmatic_get_customizer_option( 'sidebar_sticky_option' );
	$classes[] = 'blogmatic-stickey-sidebar--'. esc_attr( $global_sidebar_option ? 'enabled' : 'disabled' );
	$classes[] = ' blogmatic_font_typography';
	$classes[] = ' is-desktop';
	
	$site_background_animation = BMC\blogmatic_get_customizer_option( 'site_background_animation' );
	$classes[] = 'background-animation--' . $site_background_animation;

	$archive_hide_image_placeholder  = BMC\blogmatic_get_customizer_option( 'archive_hide_image_placeholder' );	
	if( $archive_hide_image_placeholder ) $classes[] = 'archive-image-placeholder--enabled';

	return $classes;
}
add_filter( 'body_class', 'blogmatic_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogmatic_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blogmatic_pingback_header' );

if( ! function_exists( 'blogmatic_get_multicheckbox_categories_simple_array' ) ) :
	/**
	 * Return array of categories prepended with "*" key.
	 * 
	 */
	function blogmatic_get_multicheckbox_categories_simple_array() {
		$categories_list = get_categories([ 'number' => 6 ]);
		$cats_array = [];
		foreach( $categories_list as $cat ) :
			$cats_array[] = [
				'value'	=> esc_html( $cat->term_id ),
				'label'	=> esc_html( str_replace ( [ '\'', '"' ], '', $cat->name ) )  . ' (' .absint( $cat->count ). ')'
			];
		endforeach;
		return $cats_array;
	}
endif;

if( ! function_exists( 'blogmatic_get_multicheckbox_tags_simple_array' ) ) :
	/**
	 * Return array of tags prepended with "*" key.
	 * 
	 */
	function blogmatic_get_multicheckbox_tags_simple_array() {
		$tags_list = get_tags(['number'=>6]);
		$tags_array = [];
		foreach( $tags_list as $tag ) :
			$tags_array[] = array( 
				'value'	=> esc_html( $tag->term_id ),
				'label'	=> esc_html(str_replace(array('\'', '"'), '', $tag->name))  . ' (' .absint( $tag->count ). ')'
			);
		endforeach;
		return $tags_array;
	}
endif;

if( ! function_exists( 'blogmatic_get_multicheckbox_users_simple_array' ) ) :
	/**
	 * Return array of users prepended with "*" key.
	 * 
	 */
	function blogmatic_get_multicheckbox_users_simple_array() {
		$users_list = get_users(['number' => 6]);
		$users_array = [];
		foreach( $users_list as $user ) :
			$users_array[] = array( 
				'value'	=> esc_html( $user->ID ),
				'label'	=> esc_html(str_replace(array('\'', '"'), '', $user->display_name))
			);
		endforeach;
		return $users_array;
	}
endif;

if( ! function_exists( 'blogmatic_get_multicheckbox_posts_simple_array' ) ) :
	/**
	 * Return array of posts prepended with "*" key.
	 * 
	 */
	function blogmatic_get_multicheckbox_posts_simple_array() {
		$post_args = array( 'numberposts' => 6 );
		$posts_list = get_posts( apply_filters( 'blogmatic_query_args_filter', $post_args ) );
		$posts_array = [];
		foreach( $posts_list as $postItem ) :
			$posts_array[] = array( 
				'value'	=> esc_html( $postItem->ID ),
				'label'	=> esc_html(str_replace(array('\'', '"'), '', $postItem->post_title))
			);
		endforeach;
		return $posts_array;
	}
endif;

if( ! function_exists( 'blogmatic_get_categories_html' ) ) :
	/**
	 * Return categories in <ul> <li> form
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_get_categories_html() {
		$blogmatic_categoies = get_categories( [ 'object_ids' => get_the_ID() ] );
		$post_cagtegories_html = '<ul class="post-categories">';
		foreach( $blogmatic_categoies as $category_key => $category_value ) :
			$post_cagtegories_html .= '<li class="cat-item item-'. ( $category_key + 1 ) .'">'. esc_html( $category_value->name ) .'</li>';
		endforeach;
		$post_cagtegories_html .= '</ul>';
		return $post_cagtegories_html;
	}
endif;

if( ! function_exists( 'blogmatic_post_order_args' ) ) :
	/**
	 * Return post order args
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_post_order_args() {
		return [
			'date-desc' =>  esc_html__( 'Newest - Oldest', 'blogmatic-pro' ),
			'date-asc' =>  esc_html__( 'Oldest - Newest', 'blogmatic-pro' ),
			'title-asc' =>  esc_html__( 'A - Z', 'blogmatic-pro' ),
			'title-desc' =>  esc_html__( 'Z - A', 'blogmatic-pro' ),
			'rand-desc' =>  esc_html__( 'Random', 'blogmatic-pro' ),
			'modified-desc' =>  esc_html__( 'Newsest - Oldest( modified )', 'blogmatic-pro' ),
			'modified-asc' =>  esc_html__( 'Oldest - Newest( modified )', 'blogmatic-pro' ),
			'comment_count-desc' =>  esc_html__( 'Posts with most comments first', 'blogmatic-pro' ),
			'comment_count-asc' =>  esc_html__( 'Posts with least comments first', 'blogmatic-pro' )
		];
	}
endif;

if( ! function_exists( 'blogmatic_get_image_sizes_option_array' ) ) :
	/**
	 * Get list of image sizes
	 * 
	 * @since 1.0.0
	 * @package Blogmatic Pro
	 */
	function blogmatic_get_image_sizes_option_array() {
		$image_sizes = get_intermediate_image_sizes();
		foreach( $image_sizes as $image_size ) :
			$sizes[$image_size] = $image_size;
		endforeach;
		return $sizes;
	}
endif;

add_filter( 'get_the_archive_title_prefix', 'blogmatic_prefix_string' );
function blogmatic_prefix_string($prefix) {
	return apply_filters( 'blogmatic_archive_page_title_prefix', false );
}

if( ! function_exists( 'blogmatic_widget_control_get_tags_options' ) ) :
	/**
	 * @since 1.0.0
	 * @package Blogmatic Pro
	 */
	function blogmatic_widget_control_get_tags_options() {
        check_ajax_referer( 'blogmatic_widget_nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ): '';
        $to_exclude = isset( $_POST['exclude'] ) ? sanitize_text_field( wp_unslash( $_POST['exclude'] ) ): '';
        $type = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ): '';
		if( $type == 'category' ) :
			$posts_list = get_categories( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'tag' ) :
			$posts_list = get_tags( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'user' ):
			$posts_list = new \WP_User_Query([ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ]);
			if( ! empty( $posts_list->get_results() ) ):
				foreach( $posts_list->get_results() as $user ) :
					$user_array[] = [
						'id'	=>	$user->ID,
						'text'	=>	$user->display_name
					];
				endforeach;
				wp_send_json_success( $user_array );
			else:
				wp_send_json_success( '' );
			endif;
		else:
			$post_args = [
				'post_type' =>  'post',
				'post_status'=>  'publish',
				'posts_per_page'    =>  6,
				'post__not_in' => explode( ',', $to_exclude ),
				's' => esc_html( $searchKey )
			];
			$posts_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_args ) );
			if( $posts_query->have_posts() ) :
				while( $posts_query->have_posts() ) :
					$posts_query->the_post();
					$post_array[] =	[
						'id'	=>	get_the_ID(),
						'text'	=>	get_the_title()
					];
				endwhile;
				wp_send_json_success( $post_array );
			endif;
		endif;
		if( ! empty( $posts_list ) ) :
			foreach( $posts_list as $postItem ) :
				$posts_array[] = [	
					'id'	=> esc_html( $postItem->term_taxonomy_id ),
					'text'	=> esc_html( $postItem->name .'('. $postItem->count .')' )
				];
			endforeach;
			wp_send_json_success( $posts_array );
		endif;
        wp_die();
    }
	add_action( 'wp_ajax_blogmatic_widget_control_get_tags_options', 'blogmatic_widget_control_get_tags_options' );
	
endif;

require get_template_directory() . '/inc/extras/helpers.php';
require get_template_directory() . '/inc/extras/extras.php';
require get_template_directory() . '/inc/extras/extend-api.php';
require get_template_directory() . '/inc/widgets/widgets.php'; // widget handlers
require get_template_directory() . '/inc/hooks/hooks.php'; // hooks handlers
require get_template_directory() . '/inc/metabox/metabox.php'; // metabox

/**
 * GEt appropriate color value
 * 
 * @since 1.0.0
 */
if(! function_exists('blogmatic_get_color_format')):
    function blogmatic_get_color_format($color) {
		if( ! is_string( $color ) ) return;
      if( str_contains( $color, '--blogmatic-global-preset' ) ) {
        return( 'var( ' .esc_html( $color ). ' )' );
      } else {
        return $color;
      }
    }
endif;

if( ! function_exists( 'blogmatic_current_styles' ) ) :
	/**
	 * Generates the current changes in styling of the theme.
	 * 
	 * @package Blogmatic Pro
	 * @since 1.0.0
	 */
	function blogmatic_current_styles() {
		// enqueue inline style
		ob_start();
			blogmatic_preset_color_control( 'solid_color_preset', '--blogmatic-global-preset-color-' );
			blogmatic_preset_color_control( 'gradient_color_preset', '--blogmatic-global-preset-gradient-' );
			blogmatic_typography_preset();

			/** Value Change With Responsive **/
			blogmatic_value_change_responsive('body.boxed--layout #page','website_layout_horizontal_gap','margin-left');
			blogmatic_value_change_responsive('body.boxed--layout #page','website_layout_horizontal_gap','margin-right');
			blogmatic_value_change_responsive('body.boxed--layout #page','website_layout_vertical_gap','margin-top');
			blogmatic_value_change_responsive('body.boxed--layout #page','website_layout_vertical_gap','margin-bottom');
			blogmatic_value_change_responsive('body .site-branding img, footer .footer-logo .custom-logo-link img', 'site_logo_width','width');
			blogmatic_value_change_responsive('body .site-header .header-custom-button','header_custom_button_border_radius','border-radius');
			blogmatic_value_change_responsive('body .site-header .header-custom-button .custom-button-icon i','custom_button_icon_size','font-size');
			blogmatic_value_change_responsive('body .site-header .mode-toggle i','theme_mode_icon_size','font-size');
			blogmatic_value_change_responsive('body .site-header .mode-toggle img', 'theme_mode_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-main-banner-section .post-date i ','main_banner_design_post_date_icon_size','font-size');
			blogmatic_value_change_responsive('body .blogmatic-main-banner-section .post-date img ','main_banner_design_post_date_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-main-banner-section .swiper-arrow i ','main_banner_design_slider_icon_size','font-size');
			blogmatic_value_change_responsive('body .blogmatic-main-banner-section .swiper-arrow img ','main_banner_design_slider_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-video-playlist.layout--two .active-player .thumb-controller i, body .blogmatic-video-playlist.layout--one .thumb-controller i','video_playlist_icon_size','font-size');
			blogmatic_value_change_responsive('body .blogmatic-video-playlist.layout--two .active-player .thumb-controller img, body .blogmatic-video-playlist.layout--one .thumb-controller img','video_playlist_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-video-playlist.layout--two .player-list-wrap .swiper-arrow i','video_playlist_slider_icon_size','font-size');
			blogmatic_value_change_responsive('body .blogmatic-video-playlist.layout--two .player-list-wrap .swiper-arrow img','video_playlist_slider_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-carousel-section .post-date i','carousel_design_post_date_icon_size','font-size');
			blogmatic_value_change_responsive('body .blogmatic-carousel-section .post-date img','carousel_design_post_date_icon_size','width');
			blogmatic_value_change_responsive('.back_to_home_btn a i','error_page_button_icon_size','font-size');
			blogmatic_value_change_responsive('.back_to_home_btn a img','error_page_button_icon_size','width');
			blogmatic_value_change_responsive('body .blogmatic-carousel-section .carousel-wrap .swiper-arrow i', 'carousel_design_slider_icon_size', 'font-size');
			blogmatic_value_change_responsive('body .blogmatic-carousel-section .carousel-wrap .swiper-arrow img', 'carousel_design_slider_icon_size', 'width');
			blogmatic_value_change_responsive('.blogmatic-category-collection-section .category-wrap a, .blogmatic-category-collection-section.layout--two .category-wrap figure:before','category_collection_image_radius','border-radius');
			blogmatic_value_change_responsive('.blogmatic-instagram-section .instagram-content .instagram-item a','instagram_image_radius','border-radius');
			blogmatic_value_change_responsive('body .footer-logo img', 'bottom_footer_logo_width','width');
			blogmatic_value_change_responsive('article .content-wrap .post-button i','global_button_font_size','font-size');
			blogmatic_value_change_responsive('.single #blogmatic-main-wrap .blogmatic-container','single_article_width','width', '%');
			blogmatic_value_change_responsive('body .canvas-menu-sidebar','canvas_menu_width','width');
			blogmatic_value_change_responsive('body .site-header .search-trigger i', 'search_icon_size', 'font-size');
			blogmatic_value_change_responsive('body header .social-icons-wrap a', 'social_icons_font_size', 'font-size');
			blogmatic_value_change_responsive('body footer .social-icons-wrap a', 'footer_social_icons_font_size', 'font-size');
			blogmatic_value_change_responsive('header .insta-slider--disabled .blogmatic-instagram-section .instagram-content','instagram_gap','gap');
			blogmatic_value_change_responsive('footer .insta-slider--disabled .blogmatic-instagram-section .instagram-content','footer_instagram_gap','gap');

			blogmatic_spacing_control( 'header .insta-slider--disabled .blogmatic-instagram-section .instagram-container', 'instagram_padding', 'padding' );
			blogmatic_spacing_control( 'footer .insta-slider--disabled .blogmatic-instagram-section .instagram-container', 'footer_instagram_padding', 'padding' );
			blogmatic_spacing_control( 'body .bb-bldr-row.mobile-canvas', 'mobile_canvas_padding', 'padding' );
			blogmatic_spacing_control( '.post-thumbnail-wrapper', 'archive_image_border_radius', 'border-radius' );
			blogmatic_spacing_control( '.blogmatic-carousel-section article.post-item .post-thumb', 'carousel_image_border_radius', 'border-radius' );
			blogmatic_spacing_control( 'body .site-header .header-custom-button', 'custom_button_padding', 'padding' );
			blogmatic_spacing_control( 'body .blogmatic-widget-loader .load-more', 'sidebar_pagination_button_padding', 'padding' );
			blogmatic_spacing_control( 'article .content-wrap .post-button', 'global_button_padding', 'padding' );
			blogmatic_spacing_control( '.top-date-time', 'date_time_padding', 'padding' );
			blogmatic_spacing_control( '.blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper', 'you_may_have_missed_image_border_radius', 'border-radius' );
			blogmatic_spacing_control('.widget ul.wp-block-latest-posts li, .widget ol.wp-block-latest-comments li, .widget ul.wp-block-archives li, .widget ul.wp-block-categories li, .widget ul.wp-block-page-list li, .widget .widget ul.menu li, aside .widget_blogmatic_post_grid_widget .post-grid-wrap .post-item, aside .widget_blogmatic_post_list_widget .post-list-wrap .post-item, .canvas-menu-sidebar .widget_blogmatic_post_list_widget .post-list-wrap .post-item, .canvas-menu-sidebar ul.wp-block-latest-posts li, .canvas-menu-sidebar ol.wp-block-latest-comments li, .canvas-menu-sidebar  ul.wp-block-archives li, .canvas-menu-sidebar  ul.wp-block-categories li, .canvas-menu-sidebar ul.wp-block-page-list li, .canvas-menu-sidebar .widget ul.menu li', 'widgets_secondary_border_bottom_color' , 'border-bottom');
			blogmatic_spacing_control( 'body .site-header', 'header_builder_margin', 'margin' );
			blogmatic_spacing_control( 'body .site-header .row-one', 'header_first_row_padding', 'padding' );
			blogmatic_spacing_control( 'body .site-header .row-two', 'header_second_row_padding', 'padding' );
			blogmatic_spacing_control( 'body .site-header .row-three', 'header_third_row_padding', 'padding' );
			blogmatic_spacing_control( 'body .site-footer .row-one', 'footer_first_row_padding', 'padding' );
			blogmatic_spacing_control( 'body .site-footer .row-two', 'footer_second_row_padding', 'padding' );
			blogmatic_spacing_control( 'body .site-footer .row-three', 'footer_third_row_padding', 'padding' );
			
			/** Value Change **/
			blogmatic_value_change('body .site-header .header-custom-button .custom-button-icon','custom_button_icon_distance','padding-right');
			blogmatic_value_change('.site-header .header-custom-button .custom-button-icon.icon_after','custom_button_icon_distance','padding-left');
			blogmatic_value_change('body .blogmatic-main-banner-section .swiper .swiper-wrapper .post-thumb, body .blogmatic-main-banner-section.layout--one .swiper .swiper-wrapper','main_banner_image_border_radius','border-radius');
			blogmatic_value_change('article .content-wrap .post-button','global_button_radius','border-radius');
			blogmatic_value_change('.blogmatic-widget-loader .load-more','sidebar_pagination_button_radius','border-radius');
			blogmatic_value_change('body .blogmatic-carousel-section article.post-item','carousel_section_border_radius','border-radius');
			blogmatic_value_change('body #blogmatic-main-wrap > .blogmatic-container > .row #primary .blogmatic-inner-content-wrap article.post .blogmatic-article-inner','archive_section_border_radius','border-radius');
			blogmatic_value_change('body .blogmatic-video-playlist .blogmatic-container .video-playlist-wrap','video_playlist_border_radius','border-radius');
			blogmatic_value_change('body .widget, body #widget_block','sidebar_border_radius','border-radius');
			blogmatic_value_change('body.single-post .entry-header .post-thumbnail img, body.single-post .post-thumbnail.no-single-featured-image, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .blogmatic-inner-content-wrap article > div, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .single-related-posts-section-wrap.layout--list, body.single-post #primary article .post-card .bmm-author-thumb-wrap','single_image_border_radius','border-radius');
			blogmatic_value_change('body.page-template-default.blogmatic_font_typography #primary article .post-thumbnail img','page_image_border_radius','border-radius');
			blogmatic_value_change('.single .blogmatic-table-of-content.display--fixed .toc-wrapper', 'toc_sticky_width','width');
			blogmatic_value_change('.page .blogmatic-table-of-content.display--fixed .toc-wrapper', 'page_toc_sticky_width','width');

			/** Value Change Percentage responsive **/
			blogmatic_value_change_responsive_percentage('body .blogmatic-main-banner-section article.post-item .post-elements','main_banner_text_width','width');
			/** Color Group (no Gradient) (Variable) **/
			$bcColorAssign = function($var,$id) {
				blogmatic_assign_var($var,$id);
			};
			blogmatic_assign_var('--blogmatic-global-preset-theme-color','theme_color');
			blogmatic_assign_var('--blogmatic-global-preset-gradient-theme-color','gradient_theme_color');
			/** Text Color (Variable) **/
			blogmatic_variable_color('--blogmatic-scroll-text-color','stt_color_group');
			blogmatic_variable_color('--blogmatic-menu-color', 'header_menu_color');
			blogmatic_variable_color('--blogmatic-footer-menu-color', 'footer_menu_color');
			blogmatic_variable_color('--blogmatic-mobile-canvas-icon-color', 'mobile_canvas_icon_color');
			blogmatic_variable_color('--blogmatic-widget-btn-color', 'sidebar_pagination_button_color');
			blogmatic_variable_color('--blogmatic-readmore-font-color', 'global_button_color');
			blogmatic_variable_color('--blogmatic-header-social-color', 'social_icon_color');
			blogmatic_variable_color('--blogmatic-footer-social-color', 'footer_social_icon_color');
			blogmatic_variable_color('--blogmatic-menu-color-submenu', 'header_sub_menu_color');
			blogmatic_variable_color('--blogmatic-cateegory-collection-color', 'category_collection_text_color');
			blogmatic_variable_color('--blogmatic-video-title-list-color', 'video_playlist_title_color');
			blogmatic_variable_color('--blogmatic-video-play-pause-color', 'video_playlist_play_pause_icon_color');
			blogmatic_variable_color('--blogmatic-custom-button-color', 'custom_button_text_color');
			blogmatic_variable_color('--blogmatic-custom-button-icon-color', 'custom_button_icon_color');
			blogmatic_variable_color('--blogmatic-theme-mode-color', 'theme_mode_light_icon_color');
			blogmatic_variable_color('--blogmatic-theme-darkmode-color', 'theme_mode_dark_icon_color');
			blogmatic_variable_color('--blogmatic-search-icon-color', 'search_icon_color');
			blogmatic_variable_color('--blogmatic-search-viewall-color', 'search_view_all_button_text_color');
			blogmatic_variable_color('--blogmatic-search-viewall-bkcolor', 'search_view_all_button_background_color');
			blogmatic_variable_color('--blogmatic-breadcrumb-link-color', 'breadcrumb_link_color');
			blogmatic_variable_color('--blogmatic-canvas-icon-color', 'canvas_menu_icon_color');
			blogmatic_variable_color('--blogmatic-footer-title-text', 'footer_title_color');
			blogmatic_variable_color('--blogmatic-bottom-footer-link-color', 'bottom_footer_link_color');
			blogmatic_variable_color('--blogmatic-ajax-pagination-color', 'pagination_button_text_color');

			/** variable text color single **/
			blogmatic_variable_color_single('--blogmatic-breadcrumb-color', 'breadcrumb_text_color');
			blogmatic_variable_color_single('--blogmatic-active-video-title-color', 'video_playlist_active_title_color');
			blogmatic_variable_color_single('--blogmatic-video-time-color', 'video_playlist_video_time_color');
			blogmatic_variable_color_single('--blogmatic-bottom-footer-text-color','bottom_footer_text_color');
			blogmatic_variable_color_single('--blogmatic-footer-white-text','footer_text_color');
			blogmatic_variable_color_single('--blogmatic-menu-color-active', 'header_active_menu_color');
			blogmatic_variable_color_single('--blogmatic-youmaymissed-color', 'you_may_have_missed_post_title_color');
			blogmatic_variable_color_single('--blogmatic-animation-object-color','animation_object_color');
			blogmatic_variable_color_single('--blogmatic-youmaymissed-block-title-color','you_may_have_missed_title_color');
			blogmatic_variable_color_single('--blogmatic-date-color','date_color');
			blogmatic_variable_color_single('--blogmatic-time-color','time_color');
			/** Background Color (Variable) **/
			blogmatic_variable_bk_color('--blogmatic-scroll-top-bk-color','stt_background_color_group');
			blogmatic_variable_bk_color('--blogmatic-custom-button-bk-color','header_custom_button_background_color_group');
			blogmatic_variable_bk_color('--blogmatic-widget-btn-bk-color','sidebar_pagination_button_background_color');
			blogmatic_variable_bk_color('--blogmatic-readmore-bk-color','global_button_background_color');
			blogmatic_variable_bk_color('--blogmatic-ajax-pagination-bk-color','pagination_button_background_color');
			blogmatic_variable_bk_color('--blogmatic-404-button-bkcolor','error_page_button_background_color');

			blogmatic_border_option('body .site-header .header-custom-button','header_custom_button_border' );
			blogmatic_border_option('article .content-wrap .post-button','global_button_border' );
			blogmatic_border_option('.top-date-time','date_time_border' );
			blogmatic_border_option('body .blogmatic-main-banner-section article.post-item .post-thumb','main_banner_image_border' );
			blogmatic_border_option('body .blogmatic-carousel-section article.post-item .post-thumb','carousel_image_border' );
			blogmatic_border_option('body #primary article .blogmatic-article-inner .post-thumbnail-wrapper','archive_image_border' );
			blogmatic_border_option('body.single-post #blogmatic-main-wrap .blogmatic-container .row .entry-header .post-thumbnail img, body.single-post.single-post--layout-three #blogmatic-main-wrap .blogmatic-container-fluid .post-thumbnail img','single_image_border' );
			blogmatic_border_option('body.page-template-default #primary article .post-thumbnail img','page_image_border' );
			blogmatic_border_option('body.blogmatic-model-open .canvas-menu-sidebar','canvas_menu_top_border' );
			blogmatic_border_option('footer.site-footer','footer_builder_border' );
			blogmatic_border_option('body article .blogmatic-article-inner','archive_border_bottom_color' );
			blogmatic_border_option('body .blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper','you_may_have_missed_image_border' );
			blogmatic_border_option('body .blogmatic-instagram-section .instagram-content .instagram-item a', 'instagram_image_border' );
			blogmatic_border_option('body .site-header', 'header_builder_border' );
			blogmatic_border_option('body .site-header .row-one', 'header_first_row_border' );
			blogmatic_border_option('body .site-header .row-two', 'header_second_row_border' );
			blogmatic_border_option('body .site-header .row-three', 'header_third_row_border' );
			blogmatic_border_option('body .site-footer .row-one', 'footer_first_row_border' );
			blogmatic_border_option('body .site-footer .row-two', 'footer_second_row_border' );
			blogmatic_border_option('body .site-footer .row-three', 'footer_third_row_border' );
			// Category Bk Color
			blogmatic_category_bk_colors_styles();
			blogmatic_tags_bk_colors_styles();
			blogmatic_social_share_styles();

			/* Typography (Variable) */
			$bTypoCode = function($identifier,$id) {
				blogmatic_get_typo_style($identifier,$id);
			};
			$bTypoCode( "--blogmatic-site-title", 'site_title_typo' );
			$bTypoCode( "--blogmatic-site-description", 'site_description_typo' );
			$bTypoCode("--blogmatic-menu", 'main_menu_typo');
			$bTypoCode("--blogmatic-footer-menu", 'footer_menu_typography');
			$bTypoCode("--blogmatic-date-time", 'date_time_typography');
			$bTypoCode("--blogmatic-submenu", 'main_menu_sub_menu_typo');
			$bTypoCode("--blogmatic-custom-button", 'custom_button_text_typography');
			$bTypoCode("--blogmatic-post-title-font","archive_title_typo");
			$bTypoCode("--blogmatic-post-content-font","archive_excerpt_typo");
			$bTypoCode("--blogmatic-date-font","archive_date_typo");
			$bTypoCode("--blogmatic-readtime-font","archive_read_time_typo");
			$bTypoCode("--blogmatic-comment-font","archive_comment_typo");
			$bTypoCode("--blogmatic-instagram-font","instagram_button_typo");
			$bTypoCode("--blogmatic-footer-instagram-font","footer_instagram_button_typo");
			$bTypoCode("--blogmatic-category-collection-font","category_collection_typo");
			$bTypoCode("--blogmatic-category-font","archive_category_typo");
			$bTypoCode("--blogmatic-widget-block-font","sidebar_block_title_typography");
			$bTypoCode("--blogmatic-widget-title-font","sidebar_post_title_typography");
			$bTypoCode("--blogmatic-widget-date-font","sidebar_date_typography");
			$bTypoCode("--blogmatic-widget-category-font","sidebar_category_typography");
			$bTypoCode("--blogmatic-author-font", "archive_author_typo");
			$bTypoCode("--blogmatic-readmore-font", "global_button_typo");
			$bTypoCode("--blogmatic-youmaymissed-title-font", "you_may_have_missed_design_post_title_typography");
			$bTypoCode("--blogmatic-youmaymissed-block-title-font", "you_may_have_missed_design_section_title_typography");
			$bTypoCode("--blogmatic-youmaymissed-category-font", "you_may_have_missed_design_post_categories_typography");
			$bTypoCode("--blogmatic-youmaymissed-date-font", "you_may_have_missed_design_post_date_typography");
			$bTypoCode("--blogmatic-youmaymissed-author-font", "you_may_have_missed_design_post_author_typography");
			$bTypoCode("--blogmatic-banner-title-font", "main_banner_design_post_title_typography");
			$bTypoCode("--blogmatic-banner-excerpt-font", "main_banner_design_post_excerpt_typography");

			/* typo vale change */
			blogmatic_get_typo_style_value('.blogmatic-main-banner-section .post-categories .cat-item a','main_banner_design_post_categories_typography');
			blogmatic_get_typo_style_value('.blogmatic-main-banner-section .main-banner-wrap .post-elements .post-date','main_banner_design_post_date_typography');
			blogmatic_get_typo_style_value('.blogmatic-main-banner-section .main-banner-wrap .byline','main_banner_design_post_author_typography');
			blogmatic_get_typo_style_value('.blogmatic-carousel-section .carousel-wrap .post-elements .post-title', 'carousel_design_post_title_typography');
			blogmatic_get_typo_style_value('.blogmatic-carousel-section .post-categories .cat-item a','carousel_design_post_categories_typography');
			blogmatic_get_typo_style_value('.blogmatic-carousel-section .carousel-wrap .post-elements .post-excerpt .excerpt-content','carousel_design_post_excerpt_typography');
			blogmatic_get_typo_style_value('.blogmatic-carousel-section .carousel-wrap .post-elements .byline','carousel_design_post_author_typography');
			blogmatic_get_typo_style_value('.blogmatic-carousel-section .carousel-wrap .post-elements .post-date','carousel_design_post_date_typography');
			blogmatic_get_typo_style_value('#blogmatic-main-wrap #primary .not-found .page-title','error_page_title_typo');
			blogmatic_get_typo_style_value('#blogmatic-main-wrap #primary .not-found .page-content p','error_page_content_typo');
			blogmatic_get_typo_style_value('#blogmatic-main-wrap #primary .not-found .page-content .back_to_home_btn span','error_page_button_text_typo');

			/* typo vale body */
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.category .page-header .page-title, .archive.date .page-header .page-title','archive_category_info_box_title_typo');
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.category .page-header .archive-description','archive_category_info_box_description_typo');
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.tag .page-header .page-title','archive_tag_info_box_title_typo');
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.tag .page-header .archive-description','archive_tag_info_box_description_typo');
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.author .page-header .page-title','archive_author_info_box_title_typo');
			blogmatic_get_typo_style_body_value('body.blogmatic_font_typography.archive.author .page-header .archive-description','archive_author_info_box_description_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .site-main article .entry-content','single_content_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .site-main article .entry-title, body.single-post.blogmatic_font_typography .single-header-content-wrap .entry-title','single_title_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .site-main article .post-meta-wrap .byline','single_author_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .post-meta-wrap .post-date','single_date_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography #primary .blogmatic-inner-content-wrap .post-meta  .post-read-time','single_read_time_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography #primary article .post-categories .cat-item a, body.single-post.blogmatic_font_typography .single-header-content-wrap .post-categories .cat-item a','single_category_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta-wrap .byline','single_author_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .single-header-content-wrap.post-meta .post-date','single_date_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta  .post-read-time','single_read_time_typo');
			blogmatic_get_typo_style_body_value('body.single-post.blogmatic_font_typography .single-header-content-wrap .post-meta  .post-comments-num','single_read_time_typo');
			blogmatic_get_typo_style_body_value('body .blogmatic-widget-loader .load-more','sidebar_pagination_button_typo');
			blogmatic_get_typo_style_body_value('body.page.blogmatic_font_typography #blogmatic-main-wrap #primary article .entry-title','page_title_typo');
			blogmatic_get_typo_style_body_value('body.page.blogmatic_font_typography article .entry-content','page_content_typo');
			blogmatic_get_typo_style_body_value('body .blogmatic-breadcrumb-wrap ul li span[itemprop="name"]','breadcrumb_typo');
			blogmatic_get_typo_style_body_value('body .blogmatic-video-playlist.layout--one .player-list-wrap .thumb-video-highlight-text .video-title, body .blogmatic-video-playlist.layout--two .active-player .video-title', 'video_playlist_active_title_typo');
			blogmatic_get_typo_style_body_value('body .blogmatic-video-playlist.layout--one .video-item .title-wrap .video-title, body .blogmatic-video-playlist.layout--two .playlist-items-wrap .video-title', 'video_playlist_title_typo');
			blogmatic_get_typo_style_body_value('body .blogmatic-video-playlist.layout--one .player-list-wrap .video-duration, body .blogmatic-video-playlist.layout--two .video-duration', 'video_playlist_video_time_typo');
			blogmatic_get_typo_style_body_value('body footer .widget_block .wp-block-group__inner-container .wp-block-heading, body footer section.widget .widget-title, body footer .wp-block-heading', 'footer_title_typography');
			blogmatic_get_typo_style_body_value('body footer ul.wp-block-latest-posts a, body footer ol.wp-block-latest-comments li footer, body footer ul.wp-block-archives a, body footer ul.wp-block-categories a, body footer ul.wp-block-page-list a, body footer .widget_blogmatic_post_grid_widget .post-grid-wrap .post-title, body footer .menu .menu-item a, body footer .widget_blogmatic_category_collection_widget .categories-wrap .category-item .category-name, body footer .widget_blogmatic_post_list_widget .post-list-wrap .post-title a', 'footer_text_typography');
			blogmatic_get_typo_style_body_value('body footer .site-info', 'bottom_footer_text_typography');
			blogmatic_get_typo_style_body_value('body footer .site-info a', 'bottom_footer_link_typography');
			blogmatic_get_typo_style_body_value('body article h1','heading_one_typo');
			blogmatic_get_typo_style_body_value('body article h2','heading_two_typo');
			blogmatic_get_typo_style_body_value('body article h3','heading_three_typo');
			blogmatic_get_typo_style_body_value('body article h4','heading_four_typo');
			blogmatic_get_typo_style_body_value('body article h5','heading_five_typo');
			blogmatic_get_typo_style_body_value('body article h6','heading_six_typo');
			blogmatic_get_typo_style_body_value('body aside h1.wp-block-heading','sidebar_heading_one_typography');
			blogmatic_get_typo_style_body_value('body aside h2.wp-block-heading','sidebar_heading_two_typo');
			blogmatic_get_typo_style_body_value('body aside h3.wp-block-heading','sidebar_heading_three_typo');
			blogmatic_get_typo_style_body_value('body aside h4.wp-block-heading','sidebar_heading_four_typo');
			blogmatic_get_typo_style_body_value('body aside h5.wp-block-heading','sidebar_heading_five_typo');
			blogmatic_get_typo_style_body_value('body aside h6.wp-block-heading','sidebar_heading_six_typo');

			/* Image Ratio */
			blogmatic_image_ratio('body .blogmatic-main-banner-section:not(.layout--three) article.post-item .post-thumb','main_banner_responsive_image_ratio');
			blogmatic_image_ratio('body .blogmatic-carousel-section article.post-item .post-thumb, body .blogmatic-carousel-section.carousel-layout--two article.post-item .post-thumb','carousel_responsive_image_ratio');
			blogmatic_image_ratio('body .blogmatic-instagram-section .instagram-container .instagram-content .instagram-item:before','instagram_image_ratio');
			blogmatic_image_ratio('body .blogmatic-category-collection-section .category-wrap:before','category_collection_image_ratio');
			
			blogmatic_image_ratio_variable('--blogmatic-archive-post-image-ratio','archive_responsive_image_ratio');
			blogmatic_image_ratio_variable('--blogmatic-single-post-image-ratio','single_responsive_image_ratio');
			blogmatic_image_ratio_variable('--blogmatic-single-page-image-ratio', 'page_responsive_image_ratio' );
			blogmatic_image_ratio_variable('--blogmatic-youmaymissed-image-ratio', 'you_may_have_missed_responsive_image_ratio' );

			/* box shadow */
			blogmatic_box_shadow_styles('body .site-header .header-custom-button','header_custom_button_box_shadow');
			blogmatic_box_shadow_styles('article .content-wrap .post-button','global_button_box_shadow_initial');
			blogmatic_box_shadow_styles('article .content-wrap .post-button:hover','global_button_box_shadow_hover');
			blogmatic_box_shadow_styles('body .blogmatic-carousel-section article.post-item .post-thumb','carousel_image_box_shadow');
			blogmatic_box_shadow_styles('.blogmatic-category-collection-section:not(.slider-enabled) .category-wrap .category-thumb a','category_collection_box_shadow');
			blogmatic_box_shadow_styles('body .blogmatic-carousel-section.carousel-layout--two article.post-item','carousel_box_shadow');
			blogmatic_box_shadow_styles('body .site-header','header_builder_box_shadow');
			blogmatic_box_shadow_styles('body #primary article .blogmatic-article-inner .post-thumbnail-wrapper','archive_image_box_shadow');
			blogmatic_box_shadow_styles('body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .blogmatic-inner-content-wrap .post-thumbnail img, body.single-post--layout-three .post-thumbnail img, body.single-post--layout-four .post-thumbnail img, body.single-post--layout-five .post-thumbnail img, body.single-post--layout-two .blogmatic-single-header header','single_image_box_shadow');
			blogmatic_box_shadow_styles('body.page-template-default #primary article .post-thumbnail img','page_image_box_shadow');
			blogmatic_box_shadow_styles('body .blogmatic-breadcrumb-element .blogmatic-breadcrumb-wrap','breadcrumb_box_shadow');
			blogmatic_box_shadow_styles('body.boxed--layout #page','website_box_shadow');
			blogmatic_box_shadow_styles('body #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inner, body.search-results #blogmatic-main-wrap > .blogmatic-container .row #primary article .blogmatic-article-inner','archive_box_shadow');
			blogmatic_box_shadow_styles('.blogmatic-widget-loader .load-more','sidebar_pagination_button_box_shadow_initial');
			blogmatic_box_shadow_styles('.blogmatic-widget-loader .load-more:hover','sidebar_pagination_button_box_shadow_hover');
			blogmatic_box_shadow_styles('body.search.search-results #blogmatic-main-wrap .blogmatic-container .page-header','search_box_shadow');
			blogmatic_box_shadow_styles('body.archive.category .site #blogmatic-main-wrap .page-header, body.archive.date #blogmatic-main-wrap .page-header', 'category_box_shadow');
			blogmatic_box_shadow_styles('body.archive.author .site #blogmatic-main-wrap .page-header', 'author_box_shadow');
			blogmatic_box_shadow_styles('body.archive.tag .site #blogmatic-main-wrap .page-header', 'tag_box_shadow');
			blogmatic_box_shadow_styles('body .widget, body #widget_block','widgets_box_shadow');
			blogmatic_box_shadow_styles('body .main-navigation ul.menu ul, body .main-navigation ul.nav-menu ul, body .main-header nav.toggled .blogmatic-primary-menu-container, body .main-header nav.toggled div.menu','header_sub_menu_box_shadow');
			blogmatic_box_shadow_styles('.blogmatic-video-playlist .video-playlist-wrap','video_playlist_box_shadow');
			blogmatic_box_shadow_styles('body.page #primary article.page, body.error404 #primary .error-404','page_box_shadow');
			blogmatic_box_shadow_styles('body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .post-inner, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .comments-area, body.single-post  .single-related-posts-section-wrap, body.single-post  #primary article .post-card .bmm-author-thumb-wrap, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation','single_page_box_shadow');
			blogmatic_box_shadow_styles('.blogmatic-you-may-have-missed-section .post-thumbnail-wrapper .post-thumnail-inner-wrapper','you_may_have_missed_image_widgets_box_shadow');

			blogmatic_initial_bk_color_variable('--blogmatic-submenu-bk-color', 'header_sub_menu_background_color');
			blogmatic_initial_bk_color_variable('--blogmatic-date-time-bk-color', 'date_time_background');
			blogmatic_initial_bk_color_variable('--blogmatic-video-content-bk-color','video_playlist_content_background_color');

			/* background color */
			blogmatic_initial_bk_color ('body .blogmatic-main-banner-section .main-banner-wrap .post-item .post-elements','main_banner_content_background');
			blogmatic_initial_bk_color ('body .blogmatic-category-collection-section.layout--one .category-wrap .cat-meta .category-name .category-label','category_collection_content_background');
			blogmatic_initial_bk_color ('body .blogmatic-carousel-section.carousel-layout--one article.post-item .post-elements, body .blogmatic-carousel-section.carousel-layout--two article.post-item','carousel_content_background');
			blogmatic_initial_bk_color ('body .canvas-menu-sidebar','canvas_menu_background_color');
			blogmatic_initial_bk_color ('body .blogmatic-video-playlist.layout--one .thumb-video-highlight-text','video_playlist_active_background_color');
			blogmatic_initial_bk_color ('body aside .widget, body aside #widget_block','widgets_inner_background_color');
			blogmatic_initial_bk_color ('body.boxed--layout #page','website_layout_background_color');
			blogmatic_initial_bk_color ('body.page #blogmatic-main-wrap #primary article.page','page_background_color');
			blogmatic_initial_bk_color ('body.error404 #blogmatic-main-wrap #primary .not-found','error_page_background_color');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-header','header_builder_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-header .row-one','header_first_row_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-header .row-two','header_second_row_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-header .row-three','header_third_row_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-footer .row-one','footer_first_row_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-footer .row-two','footer_second_row_background');
			blogmatic_initial_bk_color ('body.blogmatic-light-mode .site-footer .row-three','footer_third_row_background');
			blogmatic_initial_bk_color ('body .bb-bldr-row.mobile-canvas','mobile_canvas_background');

			/* Main banner background color group */
			$background_image = get_theme_mod( 'background_image' );
			if( ! $background_image ) :
				blogmatic_get_background_style('body.boxed--layout.blogmatic_font_typography:before','site_background_color');
				blogmatic_get_background_style('body.blogmatic_font_typography:before','site_background_color');
			else:
				echo 'body:before{ display: none; }';
			endif;
			blogmatic_get_background_style('body #page .blogmatic_loading_box', 'preloader_background_color');
			blogmatic_get_background_style('body .search-wrap.search-type--live-search .search-results-wrap', 'search_modal_background_color');
			blogmatic_get_background_style('.blogmatic-breadcrumb-element .blogmatic-breadcrumb-wrap', 'breadcrumb_background_color');
			blogmatic_get_background_style('.blogmatic-light-mode footer.site-footer, .blogmatic-light-mode footer .blogmatic-widget-loader .load-more', 'footer_builder_background');
			blogmatic_get_background_style ('body.archive.category .site #blogmatic-main-wrap .page-header','archive_category_info_box_background');
			blogmatic_get_background_style ('body.archive.tag .site #blogmatic-main-wrap .page-header','archive_tag_info_box_background');
			blogmatic_get_background_style ('body.archive.author .site #blogmatic-main-wrap .page-header','archive_author_info_box_background');
			blogmatic_get_background_style ('body #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inner, body.archive--block-layout #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inner, body.search-results.blogmatic_font_typography #blogmatic-main-wrap > .blogmatic-container > .row #primary article .blogmatic-article-inne, body.search.search-results #blogmatic-main-wrap .blogmatic-container .page-header','archive_inner_background_color');
			blogmatic_get_background_style('body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .post-inner, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .comments-area, body.single-post #primary article .post-card .bmm-author-thumb-wrap, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary nav.navigation, body.single-post #blogmatic-main-wrap .blogmatic-container .row #primary .single-related-posts-section-wrap, .blogmatic-table-of-content.display--fixed .toc-wrapper','single_page_background_color');
		$current_styles = ob_get_clean();
		return apply_filters( 'blogmatic_current_styles', wp_strip_all_tags($current_styles) );
	}
endif;

if( ! function_exists( 'blogmatic_custom_excerpt_more' ) ) :
	/**
	 * Filters the excerpt content
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_custom_excerpt_more($more) {
		if( is_admin() ) return $more;
		return '';
	}
	add_filter('excerpt_more', 'blogmatic_custom_excerpt_more');
endif;

if( ! function_exists( 'blogmatic_live_search_ajax_call' ) ) :
	/**
	 * Live search ajax call
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_live_search_ajax_call() {
		check_ajax_referer( 'blogmatic-security-nonce', '_wpnonce' );
		$no_of_post = ( isset( $_POST['no_of_post'] ) ) ? $_POST['no_of_post'] : '';
		$search_item = ( isset( $_POST['search_item'] ) ) ? $_POST['search_item'] : '';
		$show_post_image = ( isset( $_POST['show_post_image'] ) ) ? $_POST['show_post_image'] : '';
		$show_post_date = ( isset( $_POST['show_post_date'] ) ) ? $_POST['show_post_date'] : '';
		$view_all_button_text = ( isset( $_POST['view_all_button_text'] ) ) ? $_POST['view_all_button_text'] : '';
		$post_args = [
			'post_type'	=>	'post',
			'post_status'	=>	'publish',
			'posts_per_page'	=>	absint( $no_of_post ),
			's'	=>	esc_html( $search_item )
		];
		$post_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_args ) );
		if( $post_query->have_posts() ) :
			echo '<div class="search-results-wrap">';
				echo '<div class="search-posts-wrap">';
					while( $post_query->have_posts() ) :
						$post_query->the_post();
						?>
							<div class="article-item">
								<?php
									if( has_post_thumbnail() && ( $show_post_image == '1' ) ):
										echo '<figure class="post-thumb-wrap"><a href="'. get_the_permalink() .'">'. get_the_post_thumbnail() .'</a></figure>';
									endif;
								?>
								<div class="post-element">
									<h2 class="post-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self">
											<?php the_title(); ?>
										</a>
									</h2>
									<?php if( $show_post_date == '1' ) : ?>
										<span class="date-meta-wrap">
											<?php
												$archive_date_icon = BMC\blogmatic_get_customizer_option( 'archive_date_icon' );
												$icon_html = blogmatic_get_icon_control_html( $archive_date_icon );
												blogmatic_posted_on( get_the_ID(), '', [ 'icon_html' =>	$icon_html ] );
											?>
										</span>
									<?php endif; ?>
								</div>
							</div>
						<?php
					endwhile;
				echo '</div>';
				?>
					<a class="view-all-search-button" href="<?php echo esc_url( get_search_link( esc_html( $search_item ) ) ); ?>" target="_self"><?php echo esc_html( $view_all_button_text ); ?></a>
				<?php
			echo '</div><!-- .search-results-wrap -->';
		else:
			?>
				<div class="search-results-wrap no-posts-found">
					<h2 class="no-posts-found-title"><?php echo esc_html( $_POST['no_results_found_text'] ); ?></h2>
				</div><!-- .search-results-wrap -->
			<?php
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_blogmatic_live_search_ajax_call', 'blogmatic_live_search_ajax_call' );
	add_action( 'wp_ajax_nopriv_blogmatic_live_search_ajax_call', 'blogmatic_live_search_ajax_call' );
endif;

if( ! function_exists( 'blogmatic_pagination_load_more_ajax_call' ) ) :
	/**
	 * pagination load more ajax call
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_pagination_load_more_ajax_call() {
		check_ajax_referer( 'blogmatic-security-nonce', '_wpnonce' );
		$no_results_text = isset( $_POST['no_results_text'] ) ? $_POST['no_results_text'] : '';
		$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : '';
		$archive_query_args = [
			'post_type'	=>	'post',
			'post_status'	=>	'publish',
			'paged'	=>	absint( $paged )
		];
		$archive_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $archive_query_args ) );
		$result['continue'] = false;
		if( $archive_query->have_posts() ) :
			ob_start();
			if( $archive_query->max_num_pages != ( $paged ) ) $result['continue'] = true;
			$ads_parameters = [
				'max_number_of_pages'	=>	$archive_query->max_num_pages,
				'paged'	=>	$paged,
				'post_count'	=>	$archive_query->post_count
			];
			$ads_info = blogmatic_algorithm_to_push_ads_in_archive( $ads_parameters );
			$count = 0;
			while( $archive_query->have_posts() ) :
				$archive_query->the_post();
				if( ! is_null( $ads_info ) ) :
					if( in_array( $archive_query->current_post, $ads_info['random_numbers'] ) && $result['continue'] ) :
						blogmatic_random_post_archive_advertisement_part( is_array( $ads_info['ads_to_render'] ) ? $ads_info['ads_to_render'][$count] : $ads_info['ads_to_render'] );
						$count++;
					endif;
				endif;
				get_template_part( 'template-parts/archive/content', blogmatic_get_post_format() );
			endwhile;
			$result['paged'] = $paged;
			$result['posts'] = ob_get_clean();
			wp_reset_postdata();
			echo json_encode( $result );
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_blogmatic_pagination_load_more_ajax_call', 'blogmatic_pagination_load_more_ajax_call' );
	add_action( 'wp_ajax_nopriv_blogmatic_pagination_load_more_ajax_call', 'blogmatic_pagination_load_more_ajax_call' );
endif;

if( ! function_exists( 'blogmatic_post_grid_widget_ajax_call' ) ) :
	/**
	 * post grid widget load more ajax call
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_post_grid_widget_ajax_call() {
		check_ajax_referer( 'blogmatic-security-nonce', '_wpnonce' );
		$option = isset( $_POST['option'] ) ? $_POST['option'] : '';
		$paged = isset( $_POST['paged'] ) ? $_POST['paged'] : '';
		$image_size = isset( $option['image_size'] ) ? $option['image_size'] : 'medium';
		$post_grid_query_args = [
			'post_type'	=>	'post',
			'post_status'	=>	'publish',
			'posts_per_page'	=>	absint( $option['number_of_posts_to_show'] ),
			'paged'	=>	absint( $paged )
		];
		if( ! empty( $option['post_catgories'] ) ) $post_grid_query_args['cat'] = $option['post_catgories'];
		if( ! empty( $option['post_tags'] ) ) $post_grid_query_args['tag_id'] = $option['post_tags'];
		if( ! empty( $option['post_authors'] ) ) $post_grid_query_args['author'] = $option['post_authors'];
		if( ! empty( $option['post_to_include'] ) ) $post_grid_query_args['post__in'] = explode( ',', $option['post_to_include'] );
		if( ! empty( $option['post_to_exclude'] ) ) $post_grid_query_args['post__not_in'] = explode( ',', $option['post_to_exclude'] );
		$post_grid_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_grid_query_args ) );
		$result['continue'] = false;
		if( $post_grid_query->have_posts() ) :
			ob_start();
			if( $post_grid_query->max_num_pages != ( $paged ) ) $result['continue'] = true;
			while( $post_grid_query->have_posts() ) :
				$post_grid_query->the_post();
				?>
					<div class="post-item format-standard" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
						<div class="post-thumb-image<?php if( ! has_post_thumbnail() ) echo ' no-feat-img'?>">
							<figure class="post-thumb">
								<?php if( has_post_thumbnail() ) the_post_thumbnail( $image_size ); ?>
							</figure>
							<?php echo blogmatic_get_post_categories( get_the_ID() ); ?>
						</div>
						<div class="post-content-wrap">
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php 
								echo '<div class="post-meta">';
									$archive_date_icon = BMC\blogmatic_get_customizer_option( 'archive_date_icon' );
									$icon_html = blogmatic_get_icon_control_html( $archive_date_icon );
									blogmatic_posted_on( get_the_ID(), '', [ 'icon_html' =>	$icon_html ] );
								echo '</div>';
							?>
						</div>
					</div>
				<?php
			endwhile;
			wp_reset_postdata();
			$result['posts'] = ob_get_clean();
			echo json_encode( $result );
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_blogmatic_post_grid_widget_ajax_call', 'blogmatic_post_grid_widget_ajax_call' );
	add_action( 'wp_ajax_nopriv_blogmatic_post_grid_widget_ajax_call', 'blogmatic_post_grid_widget_ajax_call' );
endif;

if( ! function_exists( 'blogmatic_post_list_widget_ajax_call' ) ) :
	/**
	 * post list widget load more ajax call
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_post_list_widget_ajax_call() {
		check_ajax_referer( 'blogmatic-security-nonce', '_wpnonce' );
		$option = isset( $_POST['option'] ) ? $_POST['option'] : '';
		$paged = isset( $_POST['paged'] ) ? $_POST['paged'] : '';
		$image_size = isset( $option['image_size'] ) ? $option['image_size'] : 'medium';
		$post_list_argss = [
			'post_type'	=>	'post',
			'post_status'	=>	'publish',
			'posts_per_page'	=>	absint( $option['number_of_posts_to_show'] ),
			'paged'	=>	absint( $paged ),
			'ignore_sticky_posts'   =>  true
		];
		if( ! empty( $option['post_catgories'] ) ) $post_list_argss['cat'] = $option['post_catgories'];
		if( ! empty( $option['post_tags'] ) ) $post_list_argss['tag_id'] = $option['post_tags'];
		if( ! empty( $option['post_authors'] ) ) $post_list_argss['author'] = $option['post_authors'];
		if( ! empty( $option['post_to_include'] ) ) $post_list_argss['post__in'] = explode( ',', $option['post_to_include'] );
		if( ! empty( $option['post_to_exclude'] ) ) $post_list_argss['post__not_in'] = explode( ',', $option['post_to_exclude'] );
		$post_list_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_list_argss ) );
		$result['continue'] = false;
		if( $post_list_query->have_posts() ) :
			ob_start();
			if( $post_list_query->max_num_pages != ( $paged ) ) $result['continue'] = true;
			while( $post_list_query->have_posts() ) :
				$post_list_query->the_post();
				?>
					<div class="post-item format-standard" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
						<div class="post-thumb-image<?php if( ! has_post_thumbnail() ) echo ' no-feat-img'?>">
							<?php
								echo ( has_post_thumbnail() ) ? '<figure class="post-thumb"><a href="'. get_the_permalink() .'">'. get_the_post_thumbnail( get_the_ID(), $image_size ) .'</a></figure>' : '';
							?>
						</div>
						<div class="post-content-wrap">
							<?php echo blogmatic_get_post_categories( get_the_ID() ); ?>

							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<div class="post-meta">
								<?php 
									$archive_date_icon = BMC\blogmatic_get_customizer_option( 'archive_date_icon' );
									$icon_html = blogmatic_get_icon_control_html( $archive_date_icon );
									blogmatic_posted_on( get_the_ID(), '', [ 'icon_html' =>	$icon_html ] );
								?>
							</div>
						</div>
					</div>
				<?php
			endwhile;
			wp_reset_postdata();
			$result['posts'] = ob_get_clean();
			echo json_encode( $result );
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_blogmatic_post_list_widget_ajax_call', 'blogmatic_post_list_widget_ajax_call' );
	add_action( 'wp_ajax_nopriv_blogmatic_post_list_widget_ajax_call', 'blogmatic_post_list_widget_ajax_call' );
endif;

if( ! function_exists( 'blogmatic_posts_grid_two_column_widget_ajax_call' ) ) :
	/**
	 * Post grid two column posts ajax function
	 *
	 * @package Blogmatic Pro
	 * @since 1.0.0
	 */
	function blogmatic_posts_grid_two_column_widget_ajax_call() {
		check_ajax_referer( 'blogmatic-security-nonce', '_wpnonce' );
		$option = isset( $_POST['option'] ) ? $_POST['option'] : '';
		$paged = isset( $_POST['paged'] ) ? $_POST['paged'] : '';
		$post_count = ( ! empty( $option['posts_count'] ) ) ? $option['posts_count'] : 4;
		$show_categories = isset( $option['posts_cat'] ) ? ( $option['posts_cat'] === 'true' ) : true;
		$post_grid_two = [
			'posts_per_page'	=>	absint( $post_count ),
			'paged'	=>	absint( $paged ),
			'ignore_sticky_posts'   =>  true
		];
		if( ! empty( $option['posts_category'] ) ) $post_grid_two['cat'] = $option['posts_category'];
		$n_posts = new WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_grid_two ) );
		$res['loaded'] = false;
		$res['continue'] = false;
		if ( $n_posts->have_posts() ) :
			ob_start();
			$res['loaded'] = true;
			if( $n_posts->max_num_pages != $paged ) $res['continue'] = true;
				/* Start the Loop */
				while ( $n_posts->have_posts() ) :
					$n_posts->the_post();
					$thumbnail_url = get_the_post_thumbnail_url();
					$categories = get_categories([ 'object_ids' => get_the_ID(), 'number' => 1 ]);
					?>
					<div class="blaze_box_wrap">
							<div class="post-item format-standard" <?php echo esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
								<div class="post_thumb_image post-thumb <?php if( ! $thumbnail_url ) echo esc_attr( 'no-feat-img' ); ?>">
									<figure class="post-thumb">
										<?php if( $thumbnail_url ) : ?>
											<a href="<?php the_permalink(); ?>">
												<img src="<?php echo esc_url( $thumbnail_url ); ?>" loading="lazy">
											</a>
										<?php endif;
											if( $show_categories ) :
												echo '<div class="bmm-post-cats-wrap bmm-post-meta-item post-categories">';
													$count = 0;
													foreach( $categories as $cat ) {
														echo '<h5 class="card__content-category cat-item cat-' .esc_attr( $cat->cat_ID ). '"><a href="' .get_term_link( $cat->cat_ID ). '">' .esc_html( $cat->name ). '</a></h5>';
														if( $count > 0 ) break;
														$count++;
													}
												echo '</div>';
											endif;
										?>
									</figure>
								</div>
								<div class="post-content-wrap card__content">
									<div class="blogmatic-post-title card__content-title post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div>
								</div>
							</div>
						</div>
					<?php
				endwhile;
			$res['posts'] = ob_get_clean();
		endif;
		echo json_encode( $res );
		wp_die();
	}
	add_action( 'wp_ajax_blogmatic_posts_grid_two_column_widget_ajax_call', 'blogmatic_posts_grid_two_column_widget_ajax_call');
	add_action( 'wp_ajax_nopriv_blogmatic_posts_grid_two_column_widget_ajax_call', 'blogmatic_posts_grid_two_column_widget_ajax_call' );
endif;

if( ! function_exists( 'blogmatic_check_youtube_api_key' ) ) :
	/**
	 * function to check whether the api key is valid or not
	 * 
	 * @since 1.0.0
	 * @package Blogmatic Pro
	 */
	function blogmatic_check_youtube_api_key( $api_key ) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?key=" . $api_key . "&part=snippet,contentDetails";
        $remote_get_video_info = wp_remote_get( $api_url );
		return $remote_get_video_info;
	}
endif;

if( ! function_exists( 'blogmatic_random_post_archive_advertisement_part' ) ) :
    /**
     * Blogmatic main banner element
     * 
     * @since 1.0.0
     */
    function blogmatic_random_post_archive_advertisement_part( $ads_rendered ) {
		if( is_null( $ads_rendered ) ) return;
        $advertisement_repeater = BMC\blogmatic_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $random_post_archive_advertisement ) ) return;
        $image_option = array_column( $random_post_archive_advertisement, 'item_image_option' );
        $alignment = array_column( $random_post_archive_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <div class="blogmatic-advertisement-block post <?php echo esc_html( $elementClass ); ?>" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                <a href="<?php echo esc_url( $random_post_archive_advertisement[$ads_rendered]->item_url ); ?>" target="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_target ); ?>" rel="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_rel_attribute ); ?>">
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $random_post_archive_advertisement[$ads_rendered]->item_image, 'full' ) ); ?>" loading="lazy">
                </a>
            </div>
        <?php
    }
 endif;

 if( ! function_exists( 'blogmatic_random_post_archive_advertisement_number' ) ) :
    /**
     * Blogmatic archive ads number
     * 
     * @since 1.0.0
     */
    function blogmatic_random_post_archive_advertisement_number() {
        $advertisement_repeater = BMC\blogmatic_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        });
        return sizeof( $random_post_archive_advertisement );
    }
 endif;

 if( ! function_exists( 'blogmatic_get_sidebar' ) ) :
	/**
	 * Adds sidebar
	 * 
	* @since 1.0.0
	 * @param layout
	 * @return sidebar
	 */
	function blogmatic_get_sidebar( $meta_key, $args ) {
		if( array_key_exists( 'meta_type', $args ) && $args['meta_type'] == 'term' ) :
			$single_sidebar_layout_meta = metadata_exists( 'term', $args['post_id'], $meta_key ) ? get_term_meta( $args['post_id'], $meta_key, true ) : 'customizer-setting';
		else:
			$single_sidebar_layout_meta = metadata_exists( 'post', $args['post_id'], $meta_key ) ? get_post_meta( $args['post_id'], $meta_key, true ) : 'customizer-setting';
		endif;
		if( $single_sidebar_layout_meta == 'customizer-setting' ) {
			if( in_array( $args['customizer_layout'], $args['position'] ) && in_array( 'right-sidebar', $args['position'] ) ) get_sidebar();
			if( in_array( $args['customizer_layout'], $args['position'] ) && in_array( 'left-sidebar', $args['position'] ) ) get_sidebar('left');
		} 
		if( in_array( $single_sidebar_layout_meta, [ 'left-sidebar', 'both-sidebar' ] ) && in_array( 'left-sidebar', $args['position'] ) ) get_sidebar('left');
		if( in_array( $single_sidebar_layout_meta, [ 'right-sidebar', 'both-sidebar' ] ) && in_array( 'right-sidebar', $args['position'] ) ) get_sidebar();
	}
 endif;

 if( ! function_exists( 'blogmatic_set_aos_animation_data_attribute' ) ) :
	/**
	 * Adds data attribute for aos animation
	 * 
	 * @since 1.0.0
	 * @return data-attribute
	 * @param none
	 */
	function blogmatic_set_aos_animation_data_attribute() {
		$aos_animation_option = BMC\blogmatic_get_customizer_option( 'aos_animation_option' );
		if( ! $aos_animation_option ) return;
		$aos_animation_effects = BMC\blogmatic_get_customizer_option( 'aos_animation_effects' );
		$aos_animation_reset_on_scroll = BMC\blogmatic_get_customizer_option( 'aos_animation_reset_on_scroll' );
		$elementAttributes = 'data-aos=' . esc_attr( $aos_animation_effects );
		$elementAttributes .= ' data-aos-duration="1500"';
		if( $aos_animation_reset_on_scroll == 'once' ) $elementAttributes .= ' data-aos-once="once"';
		echo $elementAttributes;
	}
 endif;

 if( ! function_exists( 'blogmatic_algorithm_to_push_ads_in_archive' ) ) :
	/**
	 * Algorithm to push ads into archive
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_algorithm_to_push_ads_in_archive( $args = [] ) {
		global $wp_query;
		$archive_ads_number = blogmatic_random_post_archive_advertisement_number();
		if( $archive_ads_number <= 0 ) return;
		if( empty( $args ) ) :
			$max_number_of_pages = absint( $wp_query->max_num_pages );
			$paged = absint( ( get_query_var( 'paged' ) == 0 ) ? 0 : ( get_query_var( 'paged' ) - 1 ) );
		else:
			if( ( $args['paged'] - 1 ) == $archive_ads_number ) return;
			$max_number_of_pages = absint( $args['max_number_of_pages'] );
			$paged = absint( $args['paged'] - 1 );
		endif;
		$count = 1;
		$ads_id = 0;
		$loop_var = 0;
		for( $i = $archive_ads_number ; $i > 0; $i-- ) :
			if( $count <= $max_number_of_pages ):
				$ads_to_render_in_a_single_page = ceil( $i / $max_number_of_pages );
				$ads_to_render = [];
				if( $ads_to_render_in_a_single_page > 1 ) :
					$to_loop = $ads_id + $ads_to_render_in_a_single_page;
					for( $j = $ads_id; $j < $to_loop; $j++ ) :
						if( ! in_array( $ads_id, $ads_to_render ) ) $ads_to_render[] = $ads_id;
						$ads_id++;
					endfor;
					$ads_to_render_in_current_page[$loop_var] = $ads_to_render;
				else:
					$ads_to_render_in_current_page[$loop_var] = $ads_id;
					$ads_id++;
				endif;
				$count++;
				$loop_var++;
			endif;
		endfor;
		$current_page_count = empty( $args ) ? absint( $wp_query->post_count ) : absint( $args['post_count'] );
		$ads_of_current_page = array_key_exists( $paged, $ads_to_render_in_current_page ) ? $ads_to_render_in_current_page[$paged] : null;
		$ads_count = is_array( $ads_of_current_page ) ? sizeof( $ads_of_current_page ) : 1;
		$random_numbers = [];
		for( $i = 0; $i < $ads_count; $i++ ) :
			if( ! in_array( $i, $random_numbers ) ) :
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			else:
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			endif;
		endfor;
		return [
			'random_numbers'	=>	$random_numbers,
			'ads_to_render'	=>	$ads_of_current_page
		];
	}
 endif;

 if( ! function_exists( 'blogmatic_get_all_menus' ) ) :
	/**
	 * Get all menus
	 * 
	 * @since 1.0.0
	 */
	function blogmatic_get_all_menus() {
		$menus_array = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$value = [
			'none'	=>	esc_html__( 'None', 'blogmatic-pro' ),
		];
		if( ! empty( $menus_array ) && is_array( $menus_array ) ) :
			foreach( $menus_array as $menu ) :
				$value[ $menu->slug ] = $menu->name;
			endforeach;
			return $value;
		endif;
	}
 endif;