<?php
/**
 * INcludes theme defaults and starter functions
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
namespace Blogmatic\CustomizerDefault;

if( ! function_exists( 'blogmatic_get_customizer_option' ) ) :
    /**
     * Gets customizer "theme mod" value
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_get_customizer_option( $control_id ) {
        return get_theme_mod( $control_id, blogmatic_get_customizer_default( $control_id ) );
    }
endif;

if( !function_exists( 'blogmatic_get_multiselect_tab_option' ) ) :
    /**
     * Gets customizer "multiselect combine tab" value
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_get_multiselect_tab_option( $key ) {
        $value = blogmatic_get_customizer_option( $key );
        if( !$value["desktop"] && !$value["tablet"] && !$value["mobile"] ) return apply_filters( "blogmatic_get_multiselect_tab_option", false );
        return apply_filters( "blogmatic_get_multiselect_tab_option", true );
    }
endif;

if( ! function_exists( 'blogmatic_customizer_default_array' ) ) :
    /**
     * Returns controls default values
     * 
     * @since 1.0.0
     */
    function blogmatic_customizer_default_array() {

        $box_shadow = function( $append = [] ){
            $default = [
                'option'    => true,
                'hoffset'   => 0,
                'voffset'   => 0,
                'blur'  => 20,
                'spread'    => 0,
                'type'  => 'outset',
                'color' => 'rgb(0 0 0 / 3%)'
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
	        return $default;
        };

        $responsive = function( $desktop = 0, $tablet = 0, $smartphone = 0 ) {
            $default = [
                'desktop'   =>  $desktop,
                'tablet'    =>  $tablet,
                'smartphone'    =>  $smartphone
            ];
            return $default;
        };

        $typography = function( $append = [] ){
            $default = [
                'font_family'   => [ 'value' => 'Jost', 'label' => 'Jost' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'   => [
                    'desktop'   =>  13,
                    'tablet'   =>  13,
                    'smartphone'   =>  13
                ],
                'line_height'   => [
                    'desktop'   =>  21,
                    'tablet'   =>  21,
                    'smartphone'   =>  21
                ],
                'letter_spacing'   => [
                    'desktop'   =>  0,
                    'tablet'   =>  0,
                    'smartphone'   =>  0
                ],
                'text_transform'    => 'unset',
                'text_decoration'    => 'none',
                'preset'    =>  '-1'
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
	        return $default;
        };

        $border = function( $append = [] ) {
            $default = [
                "type"  =>  "none", 
                "width"   =>    [ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1, 'link' => true ],
                "color"   =>    "#000"
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
	        return $default;
        };

        $color = function( $append = [] ) {
            $default = [ 
                'type'  =>  'solid',
                'solid' =>  '#fff'
            ];
            if( ! empty( $append ) && is_array( $append ) ):
                $append_keys = array_keys( $append );
                $default['type'] = $append_keys[0];
                return $append += $default;
            endif;
	        return $default;
        };

        $icon_picker = function( $append = [] ){
            $default = [
                'type'  => 'icon',
                'value' => 'fa-solid fa-arrow-right'
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
	        return $default;
        };

        $array_defaults = apply_filters( 'blogmatic_get_customizer_defaults', [
            'theme_color'   => '#2f338d',
            'gradient_theme_color'   => 'linear-gradient(135deg,#942cddcc 0,#38a3e2cc 100%)',
            'header_textcolor'  =>  '2f338d',
            'site_background_color'  => $color([ 'solid'=> '#f8f8f8']),
            'site_background_animation' =>  'none',
            'animation_object_color' => $color([ 'solid' => '#c06c84' ]),
            'social_share_mobile_option'    => false,
            'show_table_of_content_label_on_mobile'    => true,
            'show_main_banner_excerpt_mobile_option'  =>  false,
            'show_carousel_banner_excerpt_mobile_option'  =>  false,
            'show_archive_excerpt_mobile_option'  =>  true,
            'show_archive_category_in_mobile'  =>  false,
            'show_archive_date_in_mobile'  =>  true,
            'show_author_meta_text'  =>  true,
            'show_archive_author_mobile_option'  =>  true,
            'show_readmore_text_mobile_option'  =>  true,
            'show_readmore_button_mobile_option'  =>  true,
            'show_readtime_mobile_option'  =>  true,
            'show_comment_number_mobile_option'  =>  false,
            'show_left_sidebar_mobile_option'  =>  true,
            'show_right_sidebar_mobile_option'  =>  true,
            'show_video_playlist_in_mobile'  =>  false,
            'show_background_animation_on_mobile'  =>  false,
            'website_layout'    => 'full-width--layout',
            'block_title_layout'    => 'three',
            'website_layout_background_color'  => $color([ 'solid'  => '#FDFDFD' ]),
            'website_box_shadow'    =>  $box_shadow(),
            'website_layout_horizontal_gap'  =>  $responsive( 60, 0, 0 ),
            'website_layout_vertical_gap'  =>  $responsive( 0, 0, 0 ),
            'social_icons_target' => '_blank',
            'footer_social_icons_target' => '_blank',
            'social_icons' => json_encode([
                [
                    'icon_class'    =>  'fab fa-facebook-f',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-instagram',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-youtube',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
            ]),
            'footer_social_icons' => json_encode([
                [
                    'icon_class'    =>  'fab fa-facebook-f',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-instagram',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-youtube',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
            ]),
            'social_icon_official_color_inherit'    =>  false,
            'footer_social_icon_official_color_inherit'    =>  false,
            'global_button_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-arrow-right' ]),
            'global_button_label'   =>  esc_html__( 'continue reading..', 'blogmatic-pro' ),
            'global_button_typo'    => $typography([
                'font_family' =>  [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
            ]),
            'global_button_font_size'    => $responsive( 16, 16, 16 ),
            'global_button_background_color'   =>   [
                'initial'   => $color([ 'solid' => null ]),
                'hover'   => $color([ 'solid' => null ])
            ],
            'global_button_radius'   =>  0,
            'global_button_box_shadow_initial'   =>  $box_shadow([ 'option'  => false ]),
            'global_button_box_shadow_hover'   =>  $box_shadow([ 'option'   => false ]),
            'global_button_border'    => $border([ "color"   =>    "#3858f6" ]),
            'global_button_padding' =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'audio_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' =>  'fa-solid fa-music' ]),
            'gallery_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-layer-group' ]),
            'image_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-image' ]),
            'quote_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-quote-left' ]),
            'standard_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-regular fa-file-lines' ]),
            'video_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-video' ]),
            'stt_text'  =>  esc_html__( '', 'blogmatic-pro' ),
            'stt_icon' => $icon_picker([ 'value' => 'fas fa-angle-up' ]),
            'stt_alignment' => 'right',
            'stt_display_type' => 'fixed',
            'stt_background_color_group' => [
                'initial'   => $color([ 'solid' => '#EDEDED' ]),
                'hover'   => $color([ 'solid' => '#EDEDED' ])
            ],
            'sidebar_sticky_option' =>  false,
            'social_share_option'   =>  true,
            'social_share_icon_color_type'  =>  true,
            'social_share_display_type'  =>  'fixed',
            'social_share_position' =>  'left',
            'social_share_repeater'  =>  [
                [
                    'icon'  =>  'fa-brands fa-facebook',
                    'color'  =>  [
                        'initial'   =>  $color([ 'solid' => '#2f2e2e' ]),
                        'hover'   =>  $color([ 'solid' => '#2f2e2e' ]),
                    ],
                    'background'  =>  [
                        'initial'   =>  $color(),
                        'hover'   =>  $color(),
                    ]
                ],
                [
                    'icon'  =>  'fa-brands fa-square-x-twitter',
                    'color'  =>  [
                        'initial'   =>  $color([ 'solid' => '#2f2e2e' ]),
                        'hover'   =>  $color([ 'solid' => '#2f2e2e' ]),
                    ],
                    'background'  =>  [
                        'initial'   =>  $color(),
                        'hover'   =>  $color(),
                    ]
                ],
                [
                    'icon'  =>  'fa-brands fa-instagram',
                    'color'  =>  [
                        'initial'   =>  $color([ 'solid' => '#2f2e2e' ]),
                        'hover'   =>  $color([ 'solid' => '#2f2e2e' ]),
                    ],
                    'background'  =>  [
                        'initial'   =>  $color(),
                        'hover'   =>  $color(),
                    ]
                ],
                [
                    'icon'  =>  'fa-brands fa-linkedin',
                    'color'  =>  [
                        'initial'   =>  $color([ 'solid' => '#2f2e2e' ]),
                        'hover'   =>  $color([ 'solid' => '#2f2e2e' ]),
                    ],
                    'background'  =>  [
                        'initial'   =>  $color(),
                        'hover'   =>  $color(),
                    ]
                ]
            ],
            'preloader_option'  => false,
            'preloader_styles'  => 'one',
            'display_preloader_animation'   =>  'first-time',
            'preloader_background_color'    =>  $color([ 'solid' => '#ff5959' ]),
            'aos_animation_option'  =>  false,
            'aos_animation_effects'  =>  'fade-up',
            'aos_animation_reset_on_scroll' =>  'once',
            'post_title_hover_effects'  => 'seven',
            'site_image_hover_effects'  => 'one',
            'cursor_animation'  => 'none',
            'site_breadcrumb_option'    => false,
            'site_breadcrumb_type'  => 'default',
            'breadcrumb_separator_icon' => $icon_picker([ 'value' => 'fa-solid fa-angles-right' ]),
            'breadcrumb_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
            ]),
            'breadcrumb_background_color'  => $color([ 'solid' => '#fff' ]),
            'breadcrumb_box_shadow' =>  $box_shadow(),
            'breadcrumb_text_color' =>  $color([ 'solid' => '#131315' ]),
            'site_schema_ready' => true,
            'site_date_format'  => 'default',
            'site_date_to_show' => 'published',
            'disable_admin_notices'   => false,
            'site_title_hover_textcolor'=> '#2f338d',
            'site_description_color'    => '#131315',
            'site_title_tag_for_frontpage'  =>  'h1',
            'site_title_tag_for_innerpage'  =>  'h2',
            'main_banner_option'    => true,
            'main_banner_layouts'    => 'three',
            'main_banner_slider_categories' => [],
            'main_banner_slider_tags' => [],
            'main_banner_slider_posts_to_include' => [],
            'main_banner_slider_posts_to_exclude' => [],
            'default_typo_one'   =>  $typography(),
            'site_title_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 40, 35, 35 ),
                'line_height' =>  $responsive( 45, 42, 40 )
            ]),
            'site_description_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 22, 22, 22 )
            ]),
            'custom_button_label'  =>  'Subscribe',
            'custom_button_icon' => $icon_picker([ 'value' => 'fas fa-bell' ]),
            'custom_button_redirect_href_link' =>  home_url(),
            'custom_button_target' =>  '_self',
            'custom_button_text_typography' =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'header_custom_button_background_color_group'   =>  [
                'initial'   => $color([ 'solid' => '#000' ]),
                'hover'   => $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'search_type'    =>  'live-search',
            'search_icon_size' =>  $responsive( 17, 16, 16 ),
            'search_no_of_post_to_display'  =>  6,
            'search_view_all_button_text'  =>  esc_html__( 'View all results', 'blogmatic-pro' ),
            'search_no_result_found_text'  =>  esc_html__( 'No results found', 'blogmatic-pro' ),
            'search_modal_background_color'    =>  $color([ 'solid' => '#c06c849c' ]),
            'search_post_image_show_hide'  =>  true,
            'search_post_date_show_hide'  =>  true,
            'theme_mode_dark_icon' => $icon_picker([ 'value' => 'fas fa-moon' ]),
            'theme_mode_light_icon' => $icon_picker([ 'value' => 'fas fa-sun' ]),
            'theme_mode_icon_size'    =>  $responsive( 18, 18, 18 ),
            'menu_cutoff_option'    => true,
            'menu_cutoff_after'   =>  8,
            'menu_cutoff_text'   =>  esc_html__( 'More', 'blogmatic-pro' ),
            'header_buiilder_header_sticky'    =>  false,
            'header_first_row_header_sticky'    =>  false,
            'header_second_row_header_sticky'    =>  false,
            'header_third_row_header_sticky'    =>  false,
            'header_sticky_on_scroll_up'    =>  false,
            'header_sticky_on_scroll_down'    =>  false,
            'theme_mode_set_dark_mode_as_default'  =>  false,
            'header_menu_hover_effect' =>  'four',
            'main_menu_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Outfit', 'label' => 'Outfit' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.8, 0.8, 0.8 ),
                'text_transform'    => 'uppercase'
            ]),
            'main_menu_sub_menu_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Outfit', 'label' => 'Outfit' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'header_active_menu_color'    =>    $color([ 'solid' => '#fff' ]),
            'header_sub_menu_background_color' => $color([ 'solid' => '#ffffff' ]),
            'header_sub_menu_box_shadow'    =>  $box_shadow([ 'voffset' => 2, 'blur' => 4 ]),
            'archive_pagination_type'   => 'number',
            'pagination_button_label'    =>  esc_html__( 'Load More', 'blogmatic-pro' ),
            'pagination_button_icon' => $icon_picker([ 'value' => 'fa-solid fa-angles-down' ]),
            'archive_pagination_button_icon_context'    =>  'suffix',
            'pagination_no_more_reults_text'    =>  esc_html__( 'No more results', 'blogmatic-pro' ),
            'pagination_button_background_color'    =>  [
                'initial'   => $color([ 'solid' => '--blogmatic-global-preset-theme-color' ]),
                'hover'   => $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'archive_post_column'    => $responsive( 1, 1, 1 ),
            'archive_post_layout'   => 'list',
            'archive_sidebar_layout'    =>  'right-sidebar',
            'archive_show_social_share' =>  true,
            'archive_post_elements_alignment'=> 'center',
            'archive_title_option'  => true,
            'archive_title_tag'  => 'h2',
            'archive_excerpt_option'  => true,
            'archive_excerpt_length'    =>  17,
            'archive_category_option'  => true,
            'archive_date_option'  => false,
            'archive_date_icon' => $icon_picker([ 'value' => 'far fa-calendar-days' ]),
            'archive_read_time_option'  => true,
            'archive_read_time_icon' => $icon_picker([ 'value' => 'fas fa-book-open-reader' ]),
            'archive_comments_option'  => false,
            'archive_comments_icon' => $icon_picker([ 'value' => 'far fa-comments' ]),
            'archive_author_option'  => true,
            'archive_author_image_option'  => true,
            'archive_button_option'  => true,
            'archive_hide_image_placeholder'  => false,
            'archive_image_size'  =>  'large',
            'archive_responsive_image_ratio'    =>  $responsive( 0.6, 0.8, 0.7 ),
            'archive_image_border'    => $border([ "color"   =>    "#FF376C" ]),
            'archive_image_border_radius'   =>  [ 
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'archive_section_border_radius'   =>  0,
            'archive_image_box_shadow'  =>  $box_shadow([ 'option' => false, 'voffset'=> 6, 'blur' => 20, 'color' => 'rgb(0 0 0 / 25%)' ]),
            'archive_inner_background_color'  =>  $color([ 'solid' => '#ffffff' ]),
            'archive_box_shadow'  =>  $box_shadow(),
            'archive_border_bottom_color'   =>  $border([ "color" => "#f4f4f4" ]),
            'archive_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 28, 28, 35 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Unset',
            ]), 
            'archive_excerpt_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_category_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.5, 0.5, 0.5 )
            ]),
            'archive_date_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_author_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 3,.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'archive_read_time_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_comment_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_category_info_box_option'  => true,
            'archive_category_info_box_icon_option'  => true,
            'archive_category_info_box_icon' => $icon_picker([ 'value' => 'fas fa-layer-group' ]),
            'archive_category_info_box_title_option'  => true,
            'archive_category_info_box_description_option'  => true,
            'archive_category_info_box_title_tag'   =>  'h2',
            'archive_category_info_box_background'    =>  $color(),
            'category_box_shadow'    =>  $box_shadow(),
            'archive_category_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 25, 25, 25 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_category_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'archive_tag_info_box_option'  => true,
            'archive_tag_info_box_icon_option'  => true,
            'archive_tag_info_box_icon' => $icon_picker([ 'value' => 'fas fa-tag' ]),
            'archive_tag_info_box_title_option'  => true,
            'archive_tag_info_box_description_option'  => true,
            'archive_tag_info_box_title_tag'    =>  'h2',
            'archive_tag_info_box_background' =>  $color(),
            'tag_box_shadow'  =>  $box_shadow(),
            'archive_tag_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 25, 25, 25 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_tag_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'archive_author_info_box_option'  => true,
            'archive_author_info_box_image_option'  => true,
            'archive_author_info_box_title_option'  => true,
            'archive_author_info_box_description_option'  => true,
            'archive_author_info_box_title_tag' =>  'h2',
            'archive_author_info_box_background'  =>  $color(),
            'author_box_shadow' =>  $box_shadow(),
            'archive_author_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 25, 25, 25 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_author_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'single_post_layout'   => 'layout-six',
            'single_sidebar_layout'=> 'right-sidebar',
            'single_article_width' =>  $responsive( 100, 100, 100 ),
            'single_title_option'  => true,
            'single_title_tag'  => 'h2',
            'single_thumbnail_option'  => true,
            'single_category_option'  => true,
            'single_date_option'  => true,
            'single_date_icon' => $icon_picker([ 'value' => 'far fa-calendar-days' ]),
            'single_read_time_option'  => true,
            'single_read_time_icon' => $icon_picker([ 'value' => 'fas fa-book-open-reader' ]),
            'single_comments_option'  => true,
            'single_comments_icon' => $icon_picker([ 'value' => 'far fa-comments' ]),
            'single_author_option'  => true,
            'single_author_image_option'  => true,
            'single_gallery_lightbox_option'  => true,
            'single_post_content_alignment' =>  'left',
            'single_image_size'  =>  'large',
            'single_responsive_image_ratio'    =>  $responsive( 0.55, 0.65, 0.88 ),
            'single_image_border'    => $border([ "color" => "#FF376C" ]),
            'single_image_border_radius'   =>  0,
            'single_image_box_shadow'  =>  $box_shadow([ 'option' => false, 'voffset'=> 6, 'blur' => 20, 'color' => 'rgb(0 0 0 / 25%)' ]),
            'single_author_box_option'  => true,
            'single_author_box_image_option'  => true,
            'single_author_info_box_title_option'  => true,
            'single_author_info_box_description_option'  => true,
            'single_post_navigation_option'  => true,
            'single_post_navigation_thumbnail_option'  => true,
            'single_post_navigation_show_date'  => true,
            'single_post_related_posts_option'  => true,
            'related_posts_layouts' =>  'two',
            'single_post_related_posts_title'   => esc_html__( 'Related Articles', 'blogmatic-pro' ),
            'related_posts_no_of_column'   => 2,
            'related_posts_filter_by'   => 'categories',
            'related_posts_author_option'   => true,
            'related_posts_date_option'   => false,
            'related_posts_comment_option'   => true,
            'single_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 34, 27, 25 ),
                'line_height' =>  $responsive( 44, 38, 38 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'single_content_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 26, 26, 26 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'single_category_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.5, 0.5, 0.5 )
            ]),
            'single_date_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'single_author_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 3,.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'single_read_time_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'single_page_background_color'  =>  $color(['solid' => '#ffffff']),
            'single_page_box_shadow'    =>  $box_shadow(),
            'toc_option'    =>  true,
            'toc_heading_option'    =>  esc_html__( 'Table of content', 'blogmatic-pro' ),
            'toc_field_for_heading' =>  [
                [ 'value' =>  'h2', 'label' => esc_html__( 'H2', 'blogmatic-pro' ) ],
                [ 'value' =>  'h3', 'label' => esc_html__( 'H3', 'blogmatic-pro' ) ],
                [ 'value' =>  'h4', 'label' => esc_html__( 'H4', 'blogmatic-pro' ) ]
            ],
            'toc_hierarchical'  =>  'tree',
            'toc_list_type' =>  'number',
            'toc_list_icon' => $icon_picker([ 'value' => 'fa-regular fa-circle-play' ]),
            'toc_display_type' =>  'inline',
            'toc_sticky_width' =>  300,
            'toc_enable_accordion' =>  true,
            'toc_default_toggle' =>  true,
            'toc_open_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-up' ]),
            'toc_close_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-down' ]),
            'page_settings_sidebar_layout'  =>  'right-sidebar',
            'page_title_option'  => true,
            'page_title_tag'  => 'h1',
            'page_thumbnail_option'  => true,
            'page_content_option'  => true,
            'page_image_size'  =>  'large',
            'page_responsive_image_ratio'    =>  $responsive( 0.55, 0.55, 0.55 ),
            'page_image_border'    => $border([ "color"   =>    "#FF376C" ]),
            'page_image_border_radius'   =>  15,
            'page_image_box_shadow'  =>  $box_shadow([ 'voffset' => 2, 'blur' => 4 ]),
            'page_toc_option'    =>  true,
            'page_toc_heading_option'    =>  esc_html__( 'Table of content', 'blogmatic-pro' ),
            'page_toc_field_for_heading' => [
                [ 'value' =>  'h2', 'label' => esc_html__( 'H2', 'blogmatic-pro' ) ],
                [ 'value' =>  'h3', 'label' => esc_html__( 'H3', 'blogmatic-pro' ) ],
                [ 'value' =>  'h4', 'label' => esc_html__( 'H4', 'blogmatic-pro' ) ]
            ],
            'page_toc_hierarchical'  =>  'tree',
            'page_toc_list_type' =>  'number',
            'page_toc_list_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-up' ]),
            'page_toc_display_type' =>  'inline',
            'page_toc_sticky_width' =>  330,
            'page_toc_enable_accordion' =>  false,
            'page_toc_default_toggle' =>  false,
            'page_toc_open_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-up' ]),
            'page_toc_close_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-down' ]),
            'page_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'Jost', 'label' => 'Jost' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 33, 33, 33 ),
                'line_height' =>  $responsive( 31, 31, 31 ),
                'letter_spacing' =>  $responsive( 0.6, 0.6, 0.6 )
            ]),
            'page_content_typo'  => $typography([
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'page_background_color' =>  $color([ 'solid' => null ]),
            'page_box_shadow'  =>  $box_shadow(),
            'header_ads_banner_image'  =>  0,
            'header_ads_banner_image_url'  =>  '',
            'header_ads_banner_image_target_attr'  =>  '_blank',
            'header_ads_banner_image_rel_attr'  =>  'nofollow',
            'header_ads_banner_image_link_url'  =>  false,
            'dark_mode_site_logo'   =>  0,
            'site_logo_width'  =>  $responsive( 160, 160, 160 ),
            'custom_button_icon_size'  =>  $responsive( 12, 12, 12 ),
            'header_custom_button_border_radius'  =>  $responsive( 0, 0, 0 ),
            'header_custom_button_box_shadow'  =>  $box_shadow([ 'option' => false ]),
            'custom_button_padding' =>  [ 
                'desktop' => [ 'top' => 5, 'right' => 15, 'bottom' => 5, 'left' => 15, 'link' => true ],
                'tablet' => [ 'top' => 5, 'right' => 15, 'bottom' => 5, 'left' => 15, 'link' => true ],
                'smartphone' => [ 'top' => 5, 'right' => 15, 'bottom' => 5, 'left' => 15, 'link' => true ]
            ],
            'custom_button_icon_distance'  =>  10,
            'custom_button_icon_prefix_suffix' =>  'prefix',
            'custom_button_animation_type'  =>  'none',
            'header_custom_button_border'    => $border([
                "width"   =>    [ 'top' => 2, 'right' => 2, 'bottom' => 2, 'left' => 2, 'link' => true ],
                "color"   =>    "#FF376C"
            ]),
            'canvas_menu_position'  =>  'left',
            'canvas_menu_width' =>  $responsive( 320, 320, 270 ),
            'canvas_menu_background_color'  =>  $color([ 'solid' => '#333333a3' ]),
            'canvas_menu_top_border'    =>  $border([ "color"   =>    "#3858F6" ]),
            'social_icons_hover_animation'  => true,
            'footer_social_icons_hover_animation'  => true,
            'social_icons_font_size'  => $responsive( 15, 15, 15 ),
            'footer_social_icons_font_size'  => $responsive( 15, 15, 15 ),
            'main_banner_render_in' =>  'front_page',
            'main_banner_show_social_icon' =>  false,
            'main_banner_text_width' =>  $responsive( 80, 80, 80 ),
            'main_banner_slider_authors' => [],
            'main_banner_no_of_posts_to_show'   =>  5,
            'main_banner_post_offset'   =>  0,
            'main_banner_hide_post_with_no_featured_image'  =>  false,
            'main_banner_post_order'    =>  'date-desc',
            'main_banner_show_arrows'   =>  true,
            'main_banner_slider_prev_arrow' => $icon_picker([ 'value' => 'fa-solid fa-arrow-left-long' ]),
            'main_banner_slider_next_arrow' => $icon_picker([ 'value' => 'fa-solid fa-arrow-right-long' ]),
            'main_banner_show_fade'   =>  true,
            'main_banner_slider_infinite_loop'   =>  true,
            'main_banner_slider_autoplay'   =>  false,
            'main_banner_show_arrow_on_hover'   =>  false,
            'main_banner_slider_autoplay_speed'   =>  3000,
            'main_banner_slider_speed'   =>  500,
            'main_banner_post_elements_show_title'  =>  true,
            'main_banner_post_elements_show_categories'  =>  false,
            'main_banner_post_elements_show_date'  =>  false,
            'main_banner_post_elements_show_author'  =>  false,
            'main_banner_post_elements_show_author_image'  =>  true,
            'main_banner_date_icon' => $icon_picker([ 'value' => 'fas fa-calendar-days' ]),
            'main_banner_post_elements_show_excerpt'  =>  true,
            'main_banner_post_elements_excerpt_length'  =>  15,
            'main_banner_post_elements_alignment'  =>  'left',
            'main_banner_image_sizes'  =>  'large',
            'main_banner_responsive_image_ratio'    =>  $responsive( 0.5, 0.6, 0.7 ),
            'main_banner_image_border'    => $border([ "color"   =>    "#000000" ]),
            'main_banner_image_border_radius'   =>  0,
            'main_banner_content_background'   =>  $color([ 'solid' => null ]),
            'main_banner_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 22, 25, 19 ),
                'line_height' =>  $responsive( 30, 30, 30 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'main_banner_design_post_title_html_tag'    =>  'h2',
            'main_banner_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'main_banner_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'main_banner_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 3,.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'main_banner_design_post_date_icon_size'  =>  $responsive( 12, 12, 12 ),
            'main_banner_design_post_excerpt_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'main_banner_design_slider_icon_size' =>  $responsive( 15, 14, 13 ),
            'carousel_option'    => false,
            'carousel_layouts'  =>  'one',
            'carousel_render_in'    =>  'front_page',
            'carousel_no_of_columns'    =>  3,
            'carousel_slider_categories' => [],
            'carousel_slider_tags' => [],
            'carousel_slider_authors' => [],
            'carousel_slider_posts_to_include' => [],
            'carousel_slider_posts_to_exclude' => [],
            'carousel_no_of_posts_to_show'   =>  5,
            'carousel_post_offset'   =>  0,
            'carousel_hide_post_with_no_featured_image'  =>  false,
            'carousel_post_order'    =>  'date-desc',
            'carousel_show_arrows'   =>  true,
            'carousel_slider_prev_arrow' => $icon_picker([ 'value' => 'fa-solid fa-arrow-left-long' ]),
            'carousel_slider_next_arrow' => $icon_picker([ 'value' => 'fa-solid fa-arrow-right-long' ]),
            'carousel_slider_infinite_loop'   =>  true,
            'carousel_slider_autoplay'   =>  true,
            'carousel_show_arrow_on_hover'   =>  false,
            'carousel_slider_autoplay_speed'   =>  3000,
            'carousel_slider_speed'   =>  500,
            'carousel_slides_to_scroll'    =>  1,
            'carousel_post_elements_show_title'  =>  true,
            'carousel_post_elements_show_categories'  =>  true,
            'carousel_post_elements_show_date'  =>  false,
            'carousel_post_elements_show_author'  =>  false,
            'carousel_post_elements_show_author_image'  =>  false,
            'carousel_date_icon' => $icon_picker([ 'value' => 'fas fa-calendar-days' ]),
            'carousel_post_elements_show_excerpt'  =>  false,
            'carousel_post_elements_excerpt_length'  =>  10,
            'carousel_post_elements_alignment'  =>  'center',
            'carousel_image_sizes'  =>  'large',
            'carousel_responsive_image_ratio'    =>  $responsive( 1.1, 1.1, 0.9 ),
            'carousel_image_border'    => $border([ "color"   =>    "#FF376C" ]),
            'carousel_image_border_radius'  =>  [ 
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'carousel_box_shadow'   =>  $box_shadow(),
            'carousel_section_border_radius'   =>  0,
            'carousel_image_box_shadow'  =>  $box_shadow(),
            'carousel_content_background'   =>  $color([ 'solid' => '#ffffff3d' ]),
            'carousel_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Capitalize',
            ]),
            'carousel_design_post_title_html_tag'    =>  'h2',
            'carousel_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'carousel_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'carousel_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive()
            ]),
            'carousel_design_post_date_icon_size'  =>  $responsive( 12, 12, 12 ),
            'carousel_design_post_excerpt_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'carousel_design_slider_icon_size' =>  $responsive( 15, 15, 15 ),
            // video playlist
            'video_playlist_option' =>  false,
            'video_playlist_api_key'    =>  '',
            'video_playlist_layouts'    =>  'one',
            'video_playlist_repeater'   =>  json_encode([
                [
                    'video_url' =>  'https://www.youtube.com/watch?v=zCw0bkswns4',
                    'item_option'   =>  'show'
                ],
                [
                    'video_url' =>  'https://www.youtube.com/watch?v=zCw0bkswns4',
                    'item_option'   =>  'show'
                ],
                [
                    'video_url' =>  'https://www.youtube.com/watch?v=zCw0bkswns4',
                    'item_option'   =>  'show'
                ],
                [
                    'video_url' =>  'https://www.youtube.com/watch?v=zCw0bkswns4',
                    'item_option'   =>  'show'
                ]
            ]),
            'video_playlist_display_position'   =>  'above-archive',
            'video_playlist_play_icon' => $icon_picker([ 'value' => 'fa-solid fa-play' ]),
            'video_playlist_pause_icon' => $icon_picker([ 'value' => 'fa-solid fa-pause' ]),
            'video_playlist_icon_size'  =>  $responsive( 20, 20, 20 ),
            'video_playlist_slider_arrow'   =>  true,
            'video_playlist_slider_show_arrow_on_hover'   =>  false,
            'video_playlist_slider_infinite'   =>  true,
            'video_playlist_slider_autoplay'    =>  true,
            'video_playlist_slider_slides_to_show'  =>  5,
            'video_playlist_previous_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-left' ]),
            'video_playlist_next_icon' => $icon_picker([ 'value' => 'fa-solid fa-chevron-right' ]),
            'video_playlist_slider_icon_size'  =>  16,
            'video_playlist_active_title_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'video_playlist_title_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'video_playlist_video_time_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500 Italic', 'variant' => 'italic' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'video_playlist_active_title_color'   =>  $color(),
            'video_playlist_video_time_color'   =>  $color([ 'solid' => '#000' ]),
            'video_playlist_active_background_color'   =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ]),
            'video_playlist_content_background_color'   =>  $color([ 'solid' => '#fff' ]),
            'video_playlist_border_radius'  =>  0,
            'video_playlist_box_shadow' =>  $box_shadow(),
            // category collection
            'category_collection_option'    =>  false,
            'category_collection_layout'    =>  'one',
            'category_collection_render_in'    =>  'front_page',
            'category_collection_show_count'    =>  false,
            'category_collection_number_of_columns'    =>  $responsive( 3, 2, 1 ),
            'category_to_include' => [],
            'category_to_exclude' => [],
            'category_collection_number' => 4,
            'category_collection_orderby' => 'asc-name',
            'category_collection_offset' => 0,
            'category_collection_hide_empty' =>  true,
            'category_collection_slider_option' =>  false,
            'category_collection_slider_arrow' =>  false,
            'category_collection_next_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-right' ]),
            'category_collection_prev_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-left' ]),
            'category_collection_autoplay_option' =>  true,
            'category_collection_autoplay_speed'  =>  3000,
            'category_collection_slider_infinite' =>  true,
            'category_collection_slider_speed' =>  300,
            'category_collection_slides_to_show' => 3,
            'category_collection_slides_to_scroll' =>  1,
            'category_collection_image_ratio'  =>  $responsive(),
            'category_collection_image_radius'  =>  $responsive( 0, 0, 0 ),
            'category_collection_image_size'  =>  'large',
            'category_collection_hover_effects'  =>  'none',
            'category_collection_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 19, 19, 19 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Uppercase',
            ]),
            'category_collection_content_background'    =>  $color([ 'solid' => '#ffffffcc' ]),
            'category_collection_box_shadow'    =>  $box_shadow(),
            // error page
            'error_page_sidebar_layout'    =>  'right-sidebar',
            'error_page_title_text' =>  esc_html__( 'Oops! That page can’t be found.', 'blogmatic-pro' ),
            'error_page_image'  => 0,
            'error_page_content_text' =>  esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'blogmatic-pro' ),
            'error_page_button_show_hide'    =>  true,
            'error_page_button_text'    =>  esc_html__( 'Back to Home', 'blogmatic-pro' ),
            'error_page_button_icon' => $icon_picker([ 'value' => 'fa-solid fa-tent-arrow-turn-left' ]),
            'error_page_button_icon_size'   =>  $responsive( 18, 18, 18 ),
            'error_page_button_icon_context'    =>  'prefix',
            'error_page_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'Dm sans', 'label' => 'Dm sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 32, 32, 32 ),
                'line_height' =>  $responsive( 40, 38, 30 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'error_page_content_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'error_page_button_text_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'error_page_background_color'   =>  $color(),
            'error_page_button_background_color'   =>  [
                'initial'   => $color([ 'solid' => '--blogmatic-global-preset-theme-color' ]),
                'hover'   => $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'search_page_sidebar_layout'    =>  'right-sidebar',
            'search_page_form_show_hide'    =>  true,
            'search_page_title' =>  esc_html__( 'Search Results for', 'blogmatic-pro' ),
            'search_nothing_found_title' =>  esc_html__( 'Nothing Found', 'blogmatic-pro' ),
            'search_nothing_found_content' =>  esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'blogmatic-pro' ),
            'search_page_button_text' =>  esc_html__( 'Search', 'blogmatic-pro' ),
            'search_box_shadow' =>  $box_shadow(),
            // you may have missed
            'you_may_have_missed_section_option' => true,
            'you_may_have_missed_layouts'  =>  'grid',
            'you_may_have_missed_title_option' => true,
            'you_may_have_missed_title' => esc_html__( 'You May Have Missed', 'blogmatic-pro' ),
            'you_may_have_missed_no_of_columns'    =>  3,
            'you_may_have_missed_categories' => [],
            'you_may_have_missed_tags' => [],
            'you_may_have_missed_authors' => [],
            'you_may_have_missed_posts_to_include' => [],
            'you_may_have_missed_posts_to_exclude' => [],
            'you_may_have_missed_no_of_posts_to_show'   =>  3,
            'you_may_have_missed_post_offset'   =>  0,
            'you_may_have_missed_hide_post_with_no_featured_image'  =>  false,
            'you_may_have_missed_post_order'    =>  'rand-desc',
            'you_may_have_missed_post_elements_show_title'  =>  true,
            'you_may_have_missed_post_elements_show_categories'  =>  true,
            'you_may_have_missed_post_elements_show_date'  =>  false,
            'you_may_have_missed_post_elements_show_author'  =>  false,
            'you_may_have_missed_date_icon' => $icon_picker([ 'value' => 'fas fa-calendar' ]),
            'you_may_have_missed_post_elements_alignment'  =>  'left',
            'you_may_have_missed_image_sizes'  =>  'large',
            'you_may_have_missed_responsive_image_ratio'    =>  $responsive( 0.65, 0.9, 0.7 ),
            'you_may_have_missed_image_border'  =>  $border([
                "width"   =>    [ 'top' => 2, 'right' => 2, 'bottom' => 2, 'left' => 2, 'link' => true ],
                "color"   =>    "#7e43fd"
            ]),
            'you_may_have_missed_image_border_radius'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'you_may_have_missed_image_widgets_box_shadow'  =>  $box_shadow(),
            'you_may_have_missed_title_color'   => $color([ 'solid' => '#000' ]),
            'you_may_have_missed_post_title_color'   => $color([ 'solid' => '#000' ]),
            'you_may_have_missed_design_section_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 19, 19, 19 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Uppercase'
            ]),
            'you_may_have_missed_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Dm sans', 'label' => 'Dm sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 19, 17 ),
                'line_height' =>  $responsive( 29, 29, 29 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'you_may_have_missed_design_post_title_html_tag'    =>  'h2',
            'you_may_have_missed_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.5, 0.5, 0.5 )
            ]),
            'you_may_have_missed_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'you_may_have_missed_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0, 3,.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            // theme footer
            'bottom_footer_site_info'   => esc_html__( 'Blogmatic - Blog WordPress Theme %year%.', 'blogmatic-pro' ),
            'bottom_footer_header_or_custom'    =>  'header',
            'bottom_footer_logo_option'   =>  0,
            'footer_dark_mode_logo'   =>  0,
            'bottom_footer_logo_width'  =>  $responsive( 230, 200, 200 ),
            'heading_one_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 34, 34, 34 ),
                'line_height' =>  $responsive( 44, 44, 44 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_two_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 28, 28, 28 ),
                'line_height' =>  $responsive( 35, 35, 35 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_three_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 24, 24 ),
                'line_height' =>  $responsive( 31, 31, 31 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_four_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_five_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_six_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'sidebar_border_radius'   =>  0,
            'widgets_inner_background_color'  =>  $color([ 'solid' => '#ffffff' ]),
            'widgets_box_shadow'  =>  $box_shadow(),
            'widgets_secondary_border_bottom_color'   =>  $border([ "color"   =>    "#f0f0f0" ]),
            'sidebar_block_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Uppercase'
            ]),
            'sidebar_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'sidebar_category_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'sidebar_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'sidebar_heading_one_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 28, 28, 28 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_two_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 24, 24 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_three_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 22, 22, 22 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_four_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_five_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.2, 0.3 )
            ]),
            'sidebar_heading_six_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_pagination_button_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 13, 13, 13 ),
                'letter_spacing' =>  $responsive( 0.6, 0.6, 0.6 )
            ]),
            'sidebar_pagination_button_background_color'   =>   [
                'initial'   => $color(),
                'hover'   => $color()
            ],
            'sidebar_pagination_button_radius'   =>  2,
            'sidebar_pagination_button_box_shadow_initial'   =>  $box_shadow([ 'blur' => 0, 'spread' => 1, 'color' => '#d7d7d7' ]),
            'sidebar_pagination_button_box_shadow_hover'   =>  $box_shadow([ 'blur' => 0, 'spread' => 1, 'color' => '#d7d7d7' ]),
            'sidebar_pagination_button_padding' =>  [
                'desktop' => [ 'top' => 10, 'right' => 20, 'bottom' => 10, 'left' => 20, 'link' => true ],
                'tablet' => [ 'top' => 10, 'right' => 20, 'bottom' => 10, 'left' => 20, 'link' => true ],
                'smartphone' => [ 'top' => 10, 'right' => 20, 'bottom' => 10, 'left' => 20, 'link' => true ]
            ],
            'advertisement_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogmatic-pro' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogmatic-pro' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ]
            ]),
            // Header instagram
            'instagram_layout'  =>  'one',
            'instagram_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ]
            ]),
            'instagram_url_image_link'  =>  true,
            'instagram_enable_lightbox'  =>  false,
            'instagram_link_target' =>  '_blank',
            'instagram_rel_attribute'   =>  'noopener',
            'instagram_no_of_columns' =>  $responsive( 4, 3, 1 ),
            'show_instagram_button'   =>  false,
            'instagram_button_icon' => $icon_picker([ 'value' => 'fa-brands fa-instagram' ]),
            'instagram_button_text'   =>  esc_html__( 'Instagram', 'blogmatic-pro' ),
            'instagram_button_url'   =>  home_url(),
            'instagram_caption'   =>  false,
            'instagram_enable_slider_in_header' =>  false,
            'instagram_slider_arrow' =>  false,
            'instagram_next_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-right' ]),
            'instagram_prev_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-left' ]),
            'instagram_autoplay_option' =>  true,
            'instagram_autoplay_speed'  =>  3000,
            'instagram_slider_infinite' =>  true,
            'instagram_slider_speed' =>  300,
            'instagram_slides_to_show' =>  4,
            'instagram_slides_to_scroll' =>  1,
            'instagram_image_ratio'  =>  $responsive(),
            'instagram_image_radius'  =>  $responsive( 0, 0, 0 ),
            'instagram_image_size'  =>  'large',
            'instagram_hover_effects'  =>  'one',
            'instagram_button_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 19, 19, 19 )
            ]),
            'instagram_padding' =>  [ 
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'instagram_gap'  =>  $responsive( 10, 10, 10 ),
            'instagram_image_border'  =>  $border(),
            // footer instagram
            'footer_instagram_layout'  =>  'one',
            'footer_instagram_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show'
                ]
            ]),
            'footer_instagram_url_image_link'  =>  true,
            'footer_instagram_enable_lightbox'  =>  false,
            'footer_instagram_link_target' =>  '_blank',
            'footer_instagram_rel_attribute'   =>  'noopener',
            'footer_instagram_no_of_columns' =>  $responsive( 4, 2, 1 ),
            'footer_show_instagram_button'   =>  false,
            'footer_instagram_button_icon' => $icon_picker([ 'value' => 'fa-brands fa-instagram' ]),
            'footer_instagram_button_text'   =>  esc_html__( 'Instagram', 'blogmatic-pro' ),
            'footer_instagram_button_url'   =>  home_url(),
            'footer_instagram_caption'   =>  false,
            'footer_instagram_enable_slider_in_footer' =>  false,
            'footer_instagram_slider_arrow' =>  false,
            'footer_instagram_next_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-right' ]),
            'footer_instagram_prev_arrow' => $icon_picker([ 'value' => 'fa-solid fa-angle-left' ]),
            'footer_instagram_autoplay_option' =>  true,
            'footer_instagram_autoplay_speed'  =>  3000,
            'footer_instagram_slider_infinite' =>  true,
            'footer_instagram_slider_speed' =>  300,
            'footer_instagram_slides_to_show' =>  4,
            'footer_instagram_slides_to_scroll' =>  1,
            'footer_instagram_image_ratio'  =>  $responsive(),
            'footer_instagram_image_radius'  =>  $responsive( 0, 0, 0 ),
            'footer_instagram_image_size'  =>  'large',
            'footer_instagram_hover_effects'  =>  'one',
            'footer_instagram_button_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 19, 19, 19 )
            ]),
            'footer_instagram_padding' =>  [ 
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'footer_instagram_gap'  =>  $responsive( 10, 10, 10 ),
            'footer_instagram_image_border'  =>  $border(),
            'blogdescription_option'    =>  false,
            'footer_title_typography'    => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Uppercase'
            ]),
            'footer_text_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'footer_text_color' =>  $color([ 'solid' => '#2f2e2e' ]),
            'bottom_footer_text_typography'    => $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'bottom_footer_link_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'bottom_footer_text_color' =>  $color([ 'solid' => '#2f2e2e' ]),
            'solid_color_preset' =>  [
                'color_palettes' => [
                    [ '#40E0D0', '#F4C430', '#FF00FF', '#007BA7', '#DC143C', '#7FFF00' ],
                    [ '#007FFF', '#FFBF00', '#50C878', '#8A2BE2', '#FF7F50' ],
                    [ '#008080', '#FFD700', '#E6E6FA', '#800000', '#808000', '#CCCCFF' ]
                ],
                'active_palette'    =>  '0'
            ],
            'gradient_color_preset' =>  [
                'color_palettes' => [
                    [ 'linear-gradient(135deg, #000000, #FFFF00)', 'linear-gradient(135deg, #191970, #FFD700)', 'linear-gradient(135deg, #4B0082, #FFA500)', 'linear-gradient(135deg, #FF8C00, #483D8B)', 'linear-gradient(135deg, #006400, #8B4513)', 'linear-gradient(135deg, #DC143C, #FFD700)' ],
                    [ 'linear-gradient(135deg, #00FFFF, #FF6347)', 'linear-gradient(135deg, #228B22, #8B4513)', 'linear-gradient(135deg, #F4A460, #DAA520)', 'linear-gradient(135deg, #FFD700, #FF6347)', 'linear-gradient(135deg, #9400D3, #87CEEB)', 'linear-gradient(135deg, #00FF00, #00FFFF)' ],
                    [ 'linear-gradient(135deg, #FFD700, #FFA500)', 'linear-gradient(135deg, #FF7F50, #FFD700)', 'linear-gradient(135deg, #483D8B, #00FFFF)', 'linear-gradient(135deg, #DC143C, #8B008B)', 'linear-gradient(135deg, #228B22, #2E8B57)', 'linear-gradient(135deg, #FF6347, #FFA500)' ],
                ],
                'active_palette'    =>  '0'
            ],
            'social_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'footer_social_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'header_menu_color' => [ 
                'initial'   =>  $color([ 'solid' => '#fff' ]),
                'hover' =>  $color([ 'solid' => '#fff' ])
            ],
            'header_sub_menu_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'search_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#171717' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'search_view_all_button_text_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'search_view_all_button_background_color' => [ 
                'initial'   =>  $color([ 'solid' => '#c06c84' ]),
                'hover' =>  $color([ 'solid' => '#f67280' ])
            ],
            'custom_button_text_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'custom_button_icon_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'theme_mode_dark_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#fff' ]),
                'hover' =>  $color([ 'solid' => '#fff' ])
            ],
            'theme_mode_light_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '#2f2e2e' ])
            ],
            'canvas_menu_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#fff' ]),
                'hover' =>  $color([ 'solid' => '#fff' ])
            ],
            'video_playlist_title_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '#000' ])
            ],
            'video_playlist_play_pause_icon_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'category_collection_text_color' => [ 
                'initial'   =>  $color([ 'solid' => '#3A3A3A' ]),
                'hover' =>  $color([ 'solid' => '#3A3A3A' ])
            ],
            'global_button_color' => [ 
                'initial'   =>  $color([ 'solid' => '#44464B' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'breadcrumb_link_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'stt_color_group' => [ 
                'initial'   =>  $color( [ 'solid' => '#000' ] ),
                'hover' =>  $color( [ 'solid' => '#000' ] )
            ],
            'pagination_button_text_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'footer_title_color' => [ 
                'initial'   =>  $color([ 'solid' => '#2f2e2e' ]),
                'hover' =>  $color([ 'solid' => '#2f2e2e' ])
            ],
            'bottom_footer_link_color' => [ 
                'initial'   =>  $color(),
                'hover' =>  $color()
            ],
            'sidebar_pagination_button_color' => [ 
                'initial'   =>  $color([ 'solid' => '#222' ]),
                'hover' =>  $color([ 'solid' => '#222' ])
            ],
            'typography_presets'    =>  [
                'typographies'    =>  [
                    $typography([
                        'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                        'font_size'   => [
                            'desktop' => 16,
                            'tablet' => 16,
                            'smartphone' => 16
                        ],
                        'line_height'   => array(
                            'desktop' => 20,
                            'tablet' => 20,
                            'smartphone' => 20
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0.3,
                            'tablet' => 0.3,
                            'smartphone' => 0.3
                        )
                    ]),
                    $typography([
                        'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                        'font_size'   => [
                            'desktop' => 16,
                            'tablet' => 16,
                            'smartphone' => 16
                        ],
                        'line_height'   => array(
                            'desktop' => 20,
                            'tablet' => 20,
                            'smartphone' => 20
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0.3,
                            'tablet' => 0.3,
                            'smartphone' => 0.3
                        )
                    ]),
                    $typography([
                        'font_family'   => [ 'value' => 'DM Sans', 'label' => 'DM Sans' ],
                        'font_size'   => [
                            'desktop' => 16,
                            'tablet' => 16,
                            'smartphone' => 16
                        ],
                        'line_height'   => array(
                            'desktop' => 20,
                            'tablet' => 20,
                            'smartphone' => 20
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0.3,
                            'tablet' => 0.3,
                            'smartphone' => 0.3
                        )
                    ])
                ],
                'labels'    =>  [ esc_html__( 'Typography 1', 'blogmatic-pro' ), esc_html__( 'Typography 2', 'blogmatic-pro' ), esc_html__( 'Typography 3', 'blogmatic-pro' ) ]
            ],
            'header_builder'    =>  [
                '00'    =>  [ 'search' ],
                '01'    =>  [ 'site-logo' ],
                '02'    =>  [ 'social-icons' ],
                '03'    =>  [],
                '10'    =>  [ 'menu' ],
                '11'    =>  [ 'off-canvas' ],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  []
            ],
            /* Date / Time */
            'date_time_typography'   =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 36, 36, 36 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'date_color'   =>  $color([ 'solid' => '#000' ]),
            'time_color'   =>  $color([ 'solid' => '#000' ]),
            'date_time_background'   =>  $color([ 'solid' => '#FFFFFF00' ]),
            'date_time_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'date_time_padding'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            /* Header builder */
            'header_builder_section_width'   =>  'full-width--layout',
            'header_builder_background'   =>  $color(),
            'header_builder_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'header_builder_box_shadow'   =>  $box_shadow(),
            'header_builder_margin'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 40, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 40, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 40, 'left' => 0, 'link' => true ]
            ],
            /* First row */
            'header_first_row_column'  =>  3,
            'header_first_row_column_layout'  =>  $responsive( 'one', 'two', 'four' ),
            'header_first_row_padding'   =>  [
                'desktop' => [ 'top' => 55, 'right' => 50, 'bottom' => 55, 'left' => 50, 'link' => true ],
                'tablet' => [ 'top' => 35, 'right' => 50, 'bottom' => 35, 'left' => 50, 'link' => true ],
                'smartphone' => [ 'top' => 35, 'right' => 50, 'bottom' => 35, 'left' => 50, 'link' => true ]
            ],
            'header_first_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'header_first_row_background'   =>  $color([ 'solid' => '#f8f8f8' ]),
            'header_first_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'header_first_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'header_first_row_column_three'   =>  $responsive( 'right', 'right', 'right' ),
            'header_first_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Second row */
            'header_second_row_column'  =>  2,
            'header_second_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'header_second_row_padding'   =>  [
                'desktop' => [ 'top' => 15, 'right' => 50, 'bottom' => 15, 'left' => 50, 'link' => true ],
                'tablet' => [ 'top' => 15, 'right' => 50, 'bottom' => 15, 'left' => 50, 'link' => true ],
                'smartphone' => [ 'top' => 15, 'right' => 50, 'bottom' => 15, 'left' => 50, 'link' => true ]
            ],
            'header_second_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'header_second_row_background'  =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ]),
            'header_second_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'header_second_row_column_two'   =>  $responsive( 'right', 'right', 'right' ),
            'header_second_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'header_second_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Third row */
            'header_third_row_column'  =>  2,
            'header_third_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'header_third_row_padding'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'header_third_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'header_third_row_background'   =>  $color([ 'solid' => '#f8f8f8' ]),
            'header_third_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'header_third_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'header_third_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'header_third_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer Builder */
            'footer_builder'    =>  [
                '00'    =>  [ 'instagram' ],
                '01'    =>  [ 'logo' ],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [],
                '11'    =>  [ 'social-icons' ],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [],
                '21'    =>  [ 'copyright' ],
                '22'    =>  [ 'scroll-to-top' ],
                '23'    =>  [],
            ],
            /* Footer builder */
            'footer_builder_section_width'   =>  'boxed--layout',
            'footer_builder_background'   =>  $color([ 'solid' => '#fff' ]),
            'footer_builder_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'footer_builder_margin'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            /* Footer First row */
            'footer_first_row_column'  =>  2,
            'footer_first_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_first_row_row_direction'  =>  'vertical',
            'footer_first_row_vertical_alignment'  =>  'center',
            'footer_first_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'footer_first_row_background'   =>  $color([ 'solid' => '#ffffff00' ]),
            'footer_first_row_padding'   =>  [
                'desktop' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'footer_first_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'footer_first_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_first_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_first_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer  econd row */
            'footer_second_row_column'  =>  3,
            'footer_second_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_second_row_row_direction'  =>  'horizontal',
            'footer_second_row_vertical_alignment'  =>  'center',
            'footer_second_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'footer_second_row_background'  =>  $color([ 'solid' => '#ffffff00' ]),
            'footer_second_row_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ]
            ],
            'footer_second_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'footer_second_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_second_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_second_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer Third row */
            'footer_third_row_column'  =>  3,
            'footer_third_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_third_row_row_direction'  =>  'horizontal',
            'footer_third_row_vertical_alignment'  =>  'center',
            'footer_third_row_border'   =>  $border([ "color"   =>    "#3858f6" ]),
            'footer_third_row_background'   =>  $color([ 'solid' => '#ffffff00' ]),
            'footer_third_row_padding'   =>  [
                'desktop' => [ 'top' => 0, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 0, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 0, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ]
            ],
            'footer_third_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'footer_third_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_third_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_third_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Responsive header builder */
            'responsive_header_builder' =>  [
                '00'    =>  [ 'site-logo' ],
                '01'    =>  [],
                '02'    =>  [ 'toggle-button' ],
                '03'    =>  [],
                '10'    =>  [],
                '11'    =>  [],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  [],
                'responsive-canvas' =>  [ 'menu' ]
            ],
            'mobile_canvas_alignment'   =>  'left',
            'mobile_canvas_icon_color'  =>  [
                'initial'   =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ]),
                'hover'   =>  $color([ 'solid' => '--blogmatic-global-preset-theme-color' ])
            ],
            'mobile_canvas_background'  =>  $color([ 'solid' => '' ]),
            'mobile_canvas_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 50, 'bottom' => 20, 'left' => 50, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 50, 'bottom' => 20, 'left' => 50, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 50, 'bottom' => 20, 'left' => 50, 'link' => true ]
            ],
            'footer_menu_control'   =>  'none',
            'footer_menu_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'Outfit', 'label' => 'Outfit' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.8, 0.8, 0.8 ),
                'text_transform'    => 'uppercase'
            ]),
            'footer_menu_color' =>  [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '#000' ])
            ],
        ]);
        return $array_defaults;
    }
endif;

if( !function_exists( 'blogmatic_get_customizer_default' ) ) :
    /**
     * Gets customizer "theme_mods" value
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_get_customizer_default( $key ) { 
        $array_defaults = blogmatic_customizer_default_array();
        $totalCats = get_categories();
        if( $totalCats ) :
            foreach( $totalCats as $singleCat ) :
                $array_defaults['category_' .absint($singleCat->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                    'hover'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                ];
                $array_defaults['category_background_' .absint($singleCat->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' => '--blogmatic-global-preset-theme-color' 
                    ],
                    'hover' =>  [
                        'type'  =>  'solid',
                        'solid' => '#F67280' 
                    ]
                ];
            endforeach;
        endif;
        $totalTags = get_tags();
        if( $totalTags ) :
            foreach( $totalTags as $singleTag ) :
                $array_defaults['tag_' .absint($singleTag->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                    'hover'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ]
                ];
                $array_defaults['tag_background_' .absint($singleTag->term_id). '_color'] = [
                    'initial'    => [
                        'type'  =>  'solid',
                        'solid' => '--blogmatic-global-preset-theme-color' 
                    ],
                    'hover'    => [
                        'type'  =>  'solid',
                        'solid' => '#EC5F01'
                    ]
                ];
            endforeach;
        endif;
        return $array_defaults[$key];
    }
endif;