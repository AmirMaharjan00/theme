<?php
use Blogmatic\CustomizerDefault as BMC;

/**
 * Binds JS handlers to make theme customizer preview reload changes asynchronously
 */
add_action( 'customize_preview_init', function() {
    wp_enqueue_script(
        'blogmatic-customizer-preview',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-preview.js',
        ['customize-preview'],
        BLOGMATIC_VERSION,
        true
    );

    // localize scripts
    wp_localize_script(
        'blogmatic-customizer-preview',
        'blogmaticPreviewObject', 
        [
            '_wpnonce'  =>  wp_create_nonce( 'blogmatic-customizer-nonce' ),
            'ajaxUrl'   =>  admin_url( 'admin-ajax.php' ),
            'totalCats' => get_categories() ? get_categories() : [],
            'totalTags' => get_tags() ? get_tags() : []
        ]
    );
});

add_action( 'customize_controls_enqueue_scripts', function(){
    $buildControlsDeps = apply_filters(  'blogmatic_customizer_build_controls_dependencies', 
        [
            'react',
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-i18n',
            'wp-polyfill',
            'jquery',
            'wp-components'
        ]
    );

    wp_enqueue_style(
        'blogmatic-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-controls.css',
        ['wp-components'],
        BLOGMATIC_VERSION,
        'all'
    );

    wp_enqueue_style(
        'blogmatic-builder-style',
        get_template_directory_uri() .'/inc/customizer/assets/builder.css',
        ['wp-components'],
        BLOGMATIC_VERSION,
        'all'
    );
    
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );

    wp_enqueue_script(
        'blogmatic-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-extends.js',
        $buildControlsDeps,
        BLOGMATIC_VERSION,
        true
    );

    // wp_enqueue_script(
    //     'blogmatic-customizer-control',
    //     get_template_directory_uri() .'/inc/customizer/controller/build/index.js',
    //     $buildControlsDeps,
    //     BLOGMATIC_VERSION,
    //     true
    // );

    wp_enqueue_script( 
        'customizer-customizer-extras',
        get_template_directory_uri() . '/inc/customizer/assets/extras.js',
        [ 'jquery', 'customize-controls' ],
        BLOGMATIC_VERSION,
        true
    );

    wp_localize_script(
        'blogmatic-customizer-control',
        'customizerControlsObject', [
            'categories'    =>  blogmatic_get_multicheckbox_categories_simple_array(),
            'tags'  =>  blogmatic_get_multicheckbox_tags_simple_array(),
            'users' =>  blogmatic_get_multicheckbox_users_simple_array(),
            'posts' =>  blogmatic_get_multicheckbox_posts_simple_array(),
            '_wpnonce'  =>  wp_create_nonce( 'blogmatic-customizer-controls-live-nonce' ),
            'ajaxUrl'   =>  admin_url( 'admin-ajax.php' )
        ]
    );

    wp_localize_script(
        'customizer-customizer-handlers',
        'handlersObject', [
            'controlDefaults'   =>  BMC\blogmatic_customizer_default_array(),
            'pathToImage'   =>  get_template_directory_uri() . '/assets/images/customizer/'
        ]
    );

    $nexus_collective = function( $type ) {
        return blogmatic_wp_query( $type );
    };
    wp_localize_script( 
        'customizer-customizer-extras', 
        'customizerExtrasObject', [
            '_wpnonce'	=> wp_create_nonce( 'blogmatic-customizer-controls-nonce' ),
            'ajaxUrl' => esc_url( admin_url('admin-ajax.php') ),
            'custom'    =>  [
                'single_section_panel'   =>  $nexus_collective( 'post' ),
                'page_settings_section'   =>  $nexus_collective( 'page' ),
                'archive_general_section'   =>  home_url() . '/',
                'category_archive_section'  =>  $nexus_collective( 'category' ),
                'tag_archive_section'  =>  $nexus_collective( 'tag' ),
                'author_archive_section'  =>  $nexus_collective( 'author' ),
                'error_page_settings_section'   =>  home_url() . '/~~~hfieojfw',
                'search_page_settings'  =>  home_url() . '?s=a',
            ],
            'custom_callback'   =>  [
                'preloader_option'  =>  [
                    'true'    =>  [ 'preloader_styles', 'display_preloader_animation', 'preloader_background_color' ]
                ],
                'aos_animation_option'  =>  [
                    'true'    =>  [ 'aos_animation_effects', 'aos_animation_reset_on_scroll' ]
                ],
                'website_layout' =>  [
                    'boxed--layout' =>  [ 'website_layout_container_setting_heading', 'website_layout_background_color', 'website_box_shadow', 'website_layout_horizontal_gap', 'website_layout_vertical_gap', 'website_layout_first_divider', 'website_layout_second_divider' ]
                ],
                'search_type' =>  [
                    'live-search'   =>  [ 'search_no_of_post_to_display', 'search_view_all_button_text', 'search_no_result_found_text', 'search_post_image_show_hide', 'search_post_date_show_hide' ]
                ],
                'bottom_footer_header_or_custom'    =>  [
                    'custom'    =>  [ 'bottom_footer_logo_option', 'footer_dark_mode_logo' ]
                ],
                'show_instagram_button' =>  [
                    'true'  =>  [ 'instagram_button_icon', 'instagram_button_text', 'instagram_button_url' ]
                ],
                'footer_show_instagram_button' =>  [
                    'true'  =>  [ 'footer_instagram_button_icon', 'footer_instagram_button_text', 'footer_instagram_button_url' ]
                ],
                'instagram_url_image_link'  =>  [
                    'true'  =>  [ 'instagram_link_target', 'instagram_rel_attribute' ],
                    'false' =>  [ 'instagram_enable_lightbox' ]
                ],
                'footer_instagram_url_image_link'  =>  [
                    'true'  =>  [ 'footer_instagram_link_target', 'footer_instagram_rel_attribute' ],
                    'false' =>  [ 'footer_instagram_enable_lightbox' ]
                ],
                'main_banner_layouts'   =>  [
                    'one'   =>  [ 'main_banner_text_width' ]
                ],
                'video_playlist_layouts'   =>  [
                    'two'   =>  [ 'video_playlist_slider_settings_heading', 'video_playlist_slider_arrow', 'video_playlist_slider_show_arrow_on_hover', 'video_playlist_slider_infinite', 'video_playlist_slider_autoplay', 'video_playlist_slider_slides_to_show', 'video_playlist_previous_icon', 'video_playlist_next_icon', 'video_playlist_slider_icon_size' ]
                ],
                'archive_pagination_type'   =>  [
                    'ajax-load-more'    =>  [ 'pagination_button_heading', 'pagination_button_label', 'pagination_button_icon', 'archive_pagination_button_icon_context', 'pagination_no_more_reults_text', 'pagination_button_text_color', 'pagination_button_background_color', 'pagination_section_first_divider', 'pagination_section_second_divider' ],
                ],
                'carousel_layouts'  =>  [
                    'two'   =>  [ 'carousel_box_shadow', 'carousel_section_border_radius' ]
                ],
                'toc_list_type' =>  [
                    'icon'  =>  [ 'toc_list_icon' ]
                ],
                'page_toc_list_type' =>  [
                    'icon'  =>  [ 'page_toc_list_icon' ]
                ],
                'toc_display_type'  =>  [
                    'fixed' =>  [ 'toc_sticky_width' ]
                ],
                'page_toc_display_type'  =>  [
                    'fixed' =>  [ 'page_toc_sticky_width' ]
                ],
                'social_share_display_type' =>  [
                    'fixed' =>  [ 'social_share_position' ]
                ],
                'instagram_layout'  =>  [
                    'one'   =>  [ 'instagram_no_of_columns' ]
                ],
                'footer_instagram_layout'  =>  [
                    'one'   =>  [ 'footer_instagram_no_of_columns' ]
                ],
                'category_collection_layout'    =>  [
                    'one'   =>  [ 'category_collection_number_of_columns' ]
                ],
                'instagram_slider_arrow'    =>  [
                    'true'  =>  [ 'instagram_prev_arrow', 'instagram_next_arrow' ]
                ],
                'footer_instagram_slider_arrow'    =>  [
                    'true'  =>  [ 'footer_instagram_prev_arrow', 'footer_instagram_next_arrow' ]
                ],
                /* Header Builder custom callbacks */
                'header_first_row_column'   =>  [
                    '1' =>  [ 'header_first_row_column_one' ],
                    '2' =>  [ 'header_first_row_column_one', 'header_first_row_column_two' ],
                    '3' =>  [ 'header_first_row_column_one', 'header_first_row_column_two', 'header_first_row_column_three' ],
                    '4' =>  [ 'header_first_row_column_one', 'header_first_row_column_two', 'header_first_row_column_three', 'header_first_row_column_four' ],
                ],
                'header_second_row_column'  =>  [
                    '1' =>  [ 'header_second_row_column_one' ],
                    '2' =>  [ 'header_second_row_column_one', 'header_second_row_column_two' ],
                    '3' =>  [ 'header_second_row_column_one', 'header_second_row_column_two', 'header_second_row_column_three' ],
                    '4' =>  [ 'header_second_row_column_one', 'header_second_row_column_two', 'header_second_row_column_three', 'header_second_row_column_four' ],
                ],
                'header_third_row_column'   =>  [
                    '1' =>  [ 'header_third_row_column_one' ],
                    '2' =>  [ 'header_third_row_column_one', 'header_third_row_column_two' ],
                    '3' =>  [ 'header_third_row_column_one', 'header_third_row_column_two', 'header_third_row_column_three' ],
                    '4' =>  [ 'header_third_row_column_one', 'header_third_row_column_two', 'header_third_row_column_three', 'header_third_row_column_four' ],
                ],
                /* Footer Builder custom callbacks */
                'footer_first_row_column'   =>  [
                    '1' =>  [ 'footer_first_row_column_one' ],
                    '2' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two' ],
                    '3' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three' ],
                    '4' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three', 'footer_first_row_column_four' ],
                ],
                'footer_second_row_column'  =>  [
                    '1' =>  [ 'footer_second_row_column_one' ],
                    '2' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two' ],
                    '3' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three' ],
                    '4' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three', 'footer_second_row_column_four' ],
                ],
                'footer_third_row_column'   =>  [
                    '1' =>  [ 'footer_third_row_column_one' ],
                    '2' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two' ],
                    '3' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three' ],
                    '4' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three', 'footer_third_row_column_four' ],
                ],
                'header_ads_banner_image_link_url'   =>  [
                    'true'  =>  [ 'header_ads_banner_image_url', 'header_ads_banner_image_target_attr' ,'header_ads_banner_image_rel_attr' ]
                ],
                'stt_display_type'  =>  [
                    'fixed' =>  [ 'stt_alignment' ]
                ],
                'header_buiilder_header_sticky' =>  [
                    'true'  =>  [ 'header_sticky_divider', 'header_first_row_header_sticky', 'header_second_row_header_sticky', 'header_third_row_header_sticky', 'header_sticky_on_scroll_up', 'header_sticky_on_scroll_down' ]
                ],
                'main_banner_show_arrows'   =>  [
                    'true'  =>  [ 'main_banner_slider_prev_arrow', 'main_banner_slider_next_arrow', 'main_banner_design_slider_icon_size', 'main_banner_arrows_divider', 'main_banner_show_arrow_on_hover' ]
                ],
                'carousel_show_arrows'   =>  [
                    'true'  =>  [ 'carousel_slider_prev_arrow', 'carousel_slider_next_arrow', 'carousel_design_slider_icon_size', 'carousel_arrows_divider', 'carousel_show_arrow_on_hover' ]
                ],
                'video_playlist_slider_arrow'   =>  [
                    'true'  =>  [ 'video_playlist_previous_icon', 'video_playlist_next_icon', 'video_playlist_slider_icon_size', 'video_playlist_slider_show_arrow_on_hover' ]
                ],
                'category_collection_slider_arrow'   =>  [
                    'true'  =>  [ 'category_collection_prev_arrow', 'category_collection_next_arrow' ]
                ]
            ]
        ]
    );
});

// extract to the customizer js
$blogmaticAddAction = function() {
    $action_prefix = "wp_ajax_" . "blogmatic_";
    // retrieve posts with search key
    add_action( $action_prefix . 'get_multicheckbox_posts_simple_array', function() {
        check_ajax_referer( 'blogmatic-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $post_args = [ 'numberposts' => 10, 's' => esc_html( $searchKey ) ];
        $posts_list = get_posts( apply_filters( 'blogmatic_query_args_filter', $post_args ) );
        foreach( $posts_list as $postItem ) :
            $posts_array[] = [ 
                'value'	=> absint( $postItem->ID ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $postItem->post_title ) )
            ];
        endforeach;
        wp_send_json_success( $posts_array );
        wp_die();
    });

    // retrieve categories with search key
    add_action( $action_prefix . 'get_multicheckbox_categories_simple_array', function() {
        check_ajax_referer( 'blogmatic-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $categories_list = get_categories( [ 'number' => 10, 'search' => esc_html( $searchKey ) ] );
        $categories_array = [];
        foreach( $categories_list as $categoryItem ) :
            $categories_array[] = [
                'value'	=> absint( $categoryItem->term_id ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $categoryItem->name ) ) . ' (' .absint( $categoryItem->count ) . ')'
            ];
        endforeach;
        wp_send_json_success( $categories_array );
        wp_die();
    });

    // retrieve tags with search key
    add_action( $action_prefix . 'get_multicheckbox_tags_simple_array', function() {
        check_ajax_referer( 'blogmatic-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $tags_list = get_tags( [ 'number' => 10, 'search' => esc_html( $searchKey ) ] );
        $tags_array = [];
        foreach( $tags_list as $tagItem ) :
            $tags_array[] = [
                'value'	=> absint( $tagItem->term_id ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $tagItem->name ) )
            ];
        endforeach;
        wp_send_json_success( $tags_array );
        wp_die();
    });

    // retrieve authors with search key
    add_action( $action_prefix . 'get_multicheckbox_authors_simple_array', function() {
        check_ajax_referer( 'blogmatic-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $users_list = get_users( [ 'number' => 10, 'search' => esc_html($searchKey ) ] );
        foreach( $users_list as $userItem ) :
            $users_array[] = [
                'value'	=> absint( $userItem->ID ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $userItem->display_name ) )
            ];
        endforeach;
        wp_send_json_success( $users_array );
        wp_die();
    });

    // typography fonts url
    add_action( $action_prefix . 'typography_fonts_url', function() {
        check_ajax_referer( 'blogmatic-customizer-nonce', 'security' );
		// enqueue inline style
		ob_start();
			echo esc_url( blogmatic_typo_fonts_url() );
        $blogmatic_typography_fonts_url = ob_get_clean();
		echo apply_filters( 'blogmatic_typography_fonts_url', esc_url( $blogmatic_typography_fonts_url ) );
		wp_die();
	});
};
$blogmaticAddAction();

// Imports previous customizer settings on exists
add_action( "wp_ajax_blogmatic_import_custmomizer_setting", function() {
    check_ajax_referer( 'blogmatic-customizer-controls-nonce', 'security' );
    $n_setting = wp_get_theme()->get_stylesheet();
    $old_setting = get_option( 'theme_mods_blogmatic' );
    if( ! $old_setting ) return;
    $current_setting = get_option( 'theme_mods_' . $n_setting );
    if( update_option( 'theme_mods_' .$n_setting. '-old', $current_setting ) ) {
        if( update_option( 'theme_mods_' . $n_setting, $old_setting ) ) {
            return true;
        }
    }
    return;
    wp_die();
});


// blogmatic reset to default ajax call
add_action( 'wp_ajax_blogmatic_customizer_reset_to_default', function () {
    check_ajax_referer( 'blogmatic-customizer-controls-nonce', 'security' );
    /**
     * Filter the settings that will be removed.
     *
     * @param array $settings Theme modifications.
     * @return array
     * @since 1.1.0
     */
    remove_theme_mods();
    wp_send_json_success();
});

if( ! function_exists( 'blogmatic_wp_query' ) ) :
    /**
     * Returns permalink
     * 
     * @param post_type
     * @since 1.0.0
     * @package Blogmatic Pro
     */
    function blogmatic_wp_query( $type ) {
        $permalink = home_url();
        switch( $type ) :
            case ( in_array( $type, [ 'page', 'post' ] ) ):
                    $type_args = [
                        'post_type'	=>	$type,
                        'posts_per_page'	=>	1,
                        'orderby'	=>	'rand'	
                    ];
                    if( $type == 'search' ) $type_args['s'] = 'a';
                    $type_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $type_args ) );
                    if( $type_query->have_posts() ) :
                        while( $type_query->have_posts() ):
                            $type_query->the_post();
                            $permalink = get_the_permalink();
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    return $permalink;
                break;
            case ( in_array( $type, [ 'tag', 'category' ] ) ):
                    $nexus_collective = function( $args ){
                        return get_terms( $args );
                    };
                    $taxonomy = ( $type == 'category' ) ? 'category' : 'post_tag';
                    $total = count( $nexus_collective([ 'taxonomy'  =>  $taxonomy, 'number' => 0 ]) );
                    $random_number = rand( 0, ( $total - 1 ) );
                    $taxonomy_args = [
                        'orderby'   =>  'rand',
                        'number'    =>  1,
                        'taxonomy'  =>  $taxonomy,
                        'offset'	=>	$random_number
                    ];
                    $get_taxonomies = $nexus_collective( $taxonomy_args );
                    if( ! empty( $get_taxonomies ) && is_array( $get_taxonomies ) ) :
                        foreach( $get_taxonomies as $taxonomy ) :
                            $permalink = get_term_link( $taxonomy->term_id );
                        endforeach;
                    endif;
                    return $permalink;
                break;
            case 'author':
                    $nexus_collective = function( $args ) {
                        return new \WP_User_Query( $args );
                    };
                    $total = $nexus_collective( [ 'number' => 0 ] )->get_total();
                    $random_number = rand( 0, ( $total - 1 ) );
                    $author_args = [
                        'number'    =>  1,
                        'offset'    =>  $random_number
                    ];
                    $user_query = $nexus_collective( $author_args );
                    if ( ! empty( $user_query->get_results() ) ) :
                        foreach ( $user_query->get_results() as $user ) :
                            $permalink = get_author_posts_url( $user->data->ID );
                        endforeach;
                    endif;
                    wp_reset_postdata();
                    return $permalink;
                break;
        endswitch;
    }
endif;