<?php
use Blogmatic\CustomizerDefault as BMC;
/**
 * Class that handles everything related to customizer
 * 
 * @since 1.0.0
 * @package Blogmatic Pro
 */
 if( ! class_exists( 'Blogmatic_Customizer' ) ) :
    class Blogmatic_Customizer extends Blogmatic_Customizer_List {
        /**
         * Instance of this class
         * 
        * @since 1.0.0
        */
        private static $_instance = null;

        /**
         * customizer variable
         * 
        * @since 1.0.0
        */
        protected $customize;

        /**
         * Has current Section id
         * 
         * @since 1.0.0
         */
        public $section;

        /**
         * Creates only one instance of class
         * 
         * @since 1.0.0
         */
        static function instance( $wp_customize ) {
            if( is_null( self::$_instance ) ) self::$_instance = new self( $wp_customize );
            return self::$_instance;
        }

        /**
         * Function that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __construct( $wp_customize ) {
            $this->customize = $wp_customize;
            $this->customize();
            $this->register();
        }

        /**
         * Function to customizer predefined panels, sections and controls
         * 
         * @since 1.0.0
         */
        public function customize() {
            $this->customize->get_section( 'title_tagline' )->title = esc_html__( 'Site Identity', 'blogmatic-pro' );
            $this->customize->get_control( 'custom_logo' )->priority = 10;
            $this->customize->get_control( 'site_icon' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->section = 'title_tagline';
            $this->customize->get_control( 'header_textcolor' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'blogmatic-pro' );
            $this->customize->get_control( 'blogname' )->section = 'title_tagline';
            $this->customize->get_control( 'blogname' )->priority = 30;
            $this->customize->get_control( 'blogdescription' )->section = 'title_tagline';
            $this->customize->get_control( 'blogdescription' )->priority = 30;
            $this->customize->get_control( 'display_header_text' )->section = 'title_tagline';
            $this->customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'blogmatic-pro' );
            $this->customize->get_control( 'display_header_text' )->priority = 40;
        }

        /**
         * Register panels, sections and control in the customizer
         * 
         * @since 1.0.0
         */
        protected function register() {
            // About theme section
            $this->add_section( 'about_section' );
            if( get_option( 'theme_mods_blogmatic' ) ) $this->add_control( 'import_setting_info', 'info_box' );
            $this->add_control( 'site_documentation_info', 'info_box' );
            $this->add_control( 'site_support_info', 'info_box' );
            // Site Logo & Title
            $this->section = 'title_tagline';
            $this->add_control( 'site_title_section_tab', 'section_tab' );
            $this->add_control( 'logo_and_icon_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'dark_mode_site_logo', 'media' );
            $this->add_control( 'site_logo_width', 'number' );
            $this->add_control( 'site_logo_divider', 'divider' );
            $this->add_control( 'site_title_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'title_tagline_divider', 'divider' );
            $this->customize->get_control( 'title_tagline_divider' )->priority = 30;
            $this->add_control( 'site_title_tag_for_frontpage', 'select' );
            $this->add_control( 'site_title_tag_for_innerpage', 'select' );
            $this->add_control( 'blogdescription_option', 'checkbox' );
            $this->add_control( 'site_title_typo', 'typography' );
            $this->add_control( 'site_description_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'site_title_hover_textcolor', 'predefined_color' );
            $this->add_control( 'site_description_color', 'predefined_color' );
            // Global Panel
            $this->add_panel( 'global_panel' );
            // SEO / Misc
            $this->add_section( 'seo_misc_section' );
            $this->add_control( 'site_schema_ready', 'toggle' );
            $this->add_control( 'site_date_to_show', 'radio_tab' );
            $this->add_control( 'site_date_format', 'select' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'disable_admin_notices_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'disable_admin_notices', 'toggle' );
            // Preloader
            $this->add_section( 'preloader_section' );
            $this->add_control( 'preloader_option', 'toggle' );
            $this->add_control( 'preloader_styles', 'select' );
            $this->add_control( 'display_preloader_animation', 'select' );
            $this->add_control( 'preloader_background_color', 'color' );
            // Website Layout
            $this->add_section( 'website_layout_section' );
            $this->add_control( 'website_layout_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'website_layout', 'radio_image' );
            $this->add_control( 'website_layout_first_divider', 'divider' );
            $this->customize->get_control( 'website_layout_first_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'website_layout' )->value() === 'boxed--layout';
            };
            $this->add_control( 'website_layout_container_setting_heading', 'section_heading' );
            $this->add_control( 'website_layout_second_divider', 'divider' );
            $this->customize->get_control( 'website_layout_second_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'website_layout' )->value() === 'boxed--layout';
            };
            $this->add_control( 'website_layout_background_color', 'color' );
            $this->add_control( 'website_box_shadow', 'box_shadow' );
            $this->add_control( 'website_layout_horizontal_gap', 'number' );
            $this->add_control( 'website_layout_vertical_gap', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'block_title_section_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'block_title_layout', 'radio_image' );
            // Animation / Hover Effect
            $this->add_section( 'animation_section' );
            $this->add_control( 'aos_site_animation_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'aos_animation_option', 'toggle' );
            $this->add_control( 'aos_animation_effects', 'select' );
            $this->add_control( 'aos_animation_reset_on_scroll', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'site_hover_animation', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'post_title_hover_effects', 'select' );
            $this->add_control( 'site_image_hover_effects', 'select' );
            $this->add_control( 'cursor_animation', 'select' );
            // Social Icons
            $this->add_section( 'social_icons_section' );
            $this->add_control( 'social_icons_section_heading', 'section_tab' );
            $this->add_control( 'social_icons_settings_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'social_icons_target', 'radio_tab' );
            $this->add_control( 'social_icons', 'custom_repeater' );
            $this->add_control( 'social_icon_official_color_inherit', 'simple_toggle' );
            $this->add_control( 'social_icons_hover_animation', 'simple_toggle' );
            $this->add_control( 'social_icons_font_size', 'number' );
            $this->add_control( 'social_icon_color', 'color' );
            // Buttons
            $this->add_section( 'buttons_section' );
            $this->add_control( 'global_button_label', 'text' );
            $this->add_control( 'global_button_icon_picker', 'icon_picker' );
            $this->add_control( 'global_button_font_size', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'global_button_typo', 'typography' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'global_button_color', 'color' );
            $this->add_control( 'global_button_background_color', 'color' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'global_button_border', 'border' );
            $this->add_control( 'global_button_radius', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'global_button_box_shadow_initial', 'box_shadow' );
            $this->add_control( 'global_button_box_shadow_hover', 'box_shadow' );
            $this->add_control( 'global_button_padding', 'spacing' );
            // Post Format
            $this->add_section( 'post_format_section' );
            $this->add_control( 'standard_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'audio_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'gallery_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'image_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'quote_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'video_post_format_icon_picker', 'icon_picker' );
            // Breadcrumb Options
            $this->add_section( 'breadcrumb_options_section' );
            $this->add_control( 'breadcrumb_section_tab', 'section_tab' );
            $this->add_control( 'site_breadcrumb_option', 'simple_toggle' );
            $this->add_control( 'site_breadcrumb_type', 'select' );
            $this->add_control( 'breadcrumb_separator_icon', 'icon_picker' );
            $this->add_control( 'breadcrumb_typo', 'typography' );
            $this->add_control( 'breadcrumb_text_color', 'color' );
            $this->add_control( 'breadcrumb_link_color', 'color' );
            $this->add_control( 'breadcrumb_background_color', 'color' );
            $this->add_control( 'breadcrumb_box_shadow', 'box_shadow' );
            // Scroll to Top
            $this->add_section( 'stt_options_section' );
            $this->add_control( 'stt_section_tab', 'section_tab' );
            $this->add_control( 'stt_text', 'text' );
            $this->add_control( 'stt_icon', 'icon_picker' );
            $this->add_control( 'stt_alignment', 'radio_tab' );
            $this->add_control( 'stt_display_type', 'radio_tab' );
            $this->add_control( 'stt_color_group', 'color' );
            $this->add_control( 'stt_background_color_group', 'color' );
            // Social Share
            $this->add_section( 'global_social_share_section' );
            $this->add_control( 'social_share_option', 'toggle' );
            $this->add_control( 'social_share_repeater', 'social_share' );
            $this->add_control( 'social_share_icon_color_type', 'simple_toggle' );
            $this->add_control( 'social_share_display_type', 'radio_tab' );
            $this->add_control( 'social_share_position', 'radio_tab' );
            // Reset To Default
            $this->add_section( 'reset_section' );
            $this->add_control( 'reset_setting_option', 'info_box' );
            // Colors Panel
            $this->add_panel( 'colors_panel' );
            // Theme Colors / Preset
            $this->add_section( 'theme_presets_section' );
            $this->add_control( 'theme_colors_section_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'theme_color', 'preset_color' );
            $this->add_control( 'gradient_theme_color', 'preset_color' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'theme_presets_section_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'solid_color_preset', 'preset' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'gradient_color_preset', 'preset' );
            // Category Colors
            $this->add_section( 'category_colors_section' );
            $totalCats = get_categories();
            if( $totalCats ) :
                foreach( $totalCats as $key => $singleCat ) :
                    $this->add_control( 'category_' . absint( $singleCat->term_id ) . '_color_heading', 'section_heading_toggle' );
                    $this->add_control( '', 'divider' );
                    $this->add_control( 'category_' . absint( $singleCat->term_id ) . '_color', 'color' );
                    $this->add_control( 'category_background_' . absint( $singleCat->term_id ) . '_color', 'color' );
                    if( count( $totalCats ) != ( $key + 1 ) ) $this->add_control( '', 'divider' );
                endforeach;
            endif;
            // Tags Colors
            $this->add_section( 'tag_colors_section' );
            $totalTags = get_tags();
            if( $totalTags ) :
                foreach( $totalTags as $key => $singleTag ) :
                    $this->add_control( 'tag_' . absint( $singleTag->term_id ) . '_color_heading', 'section_heading_toggle' );
                    $this->add_control( '', 'divider' );
                    $this->add_control( 'tag_' . absint( $singleTag->term_id ) . '_color', 'color' );
                    $this->add_control( 'tag_background_' . absint( $singleTag->term_id ) . '_color', 'color' );
                    if( count( $totalTags ) != ( $key + 1 ) ) $this->add_control( '', 'divider' );
                endforeach;
            endif;
            // Header Builder
            $this->add_section( 'header_builder_section_settings' );
            $this->add_control( 'header_builder_section_tab', 'section_tab' );
            $this->add_control( 'header_builder_section_width', 'radio_image' );
            $this->add_control( 'header_buiilder_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_first_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_second_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_third_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_sticky_divider', 'divider' );
            $this->customize->get_control( 'header_sticky_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'header_buiilder_header_sticky' )->value();
            };
            $this->add_control( 'header_sticky_on_scroll_up', 'simple_toggle' );
            $this->add_control( 'header_sticky_on_scroll_down', 'simple_toggle' );
            $this->add_control( 'header_builder_background', 'color' );
            $this->add_control( 'header_builder_border', 'border' );
            $this->add_control( 'header_builder_box_shadow', 'box_shadow' );
            $this->add_control( 'header_builder_margin', 'spacing' );
            // Advertisement Section
            $this->add_section( 'advertisement_section' );
            $this->add_control( 'advertisement_repeater', 'custom_repeater' );
            // Typography Section
            $this->add_section( 'typography_section' );
            $this->add_control( 'typography_preset_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'typography_presets', 'typography_preset' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'heading_typographies', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'heading_one_typo', 'typography' );
            $this->add_control( 'heading_two_typo', 'typography' );
            $this->add_control( 'heading_three_typo', 'typography' );
            $this->add_control( 'heading_four_typo', 'typography' );
            $this->add_control( 'heading_five_typo', 'typography' );
            $this->add_control( 'heading_six_typo', 'typography' );
            // Widget Styles Section
            $this->add_section( 'widget_styles_section' );
            $this->add_control( 'widget_styles_general_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'sidebar_sticky_option', 'simple_toggle' );
            $this->add_control( 'sidebar_border_radius', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'widget_styles_background_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'widgets_inner_background_color', 'color' );
            $this->add_control( 'widgets_box_shadow', 'box_shadow' );
            $this->add_control( 'widgets_secondary_border_bottom_color', 'border' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'widget_styles_sidebar_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'sidebar_block_title_typography', 'typography' );
            $this->add_control( 'sidebar_post_title_typography', 'typography' );
            $this->add_control( 'sidebar_category_typography', 'typography' );
            $this->add_control( 'sidebar_date_typography', 'typography' );
            $this->add_control( 'sidebar_pagination_button_typo', 'typography' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'widget_styles_headings_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'sidebar_heading_one_typography', 'typography' );
            $this->add_control( 'sidebar_heading_two_typo', 'typography' );
            $this->add_control( 'sidebar_heading_three_typo', 'typography' );
            $this->add_control( 'sidebar_heading_four_typo', 'typography' );
            $this->add_control( 'sidebar_heading_five_typo', 'typography' );
            $this->add_control( 'sidebar_heading_six_typo', 'typography' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'widget_styles_pagination_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'sidebar_pagination_button_color', 'color' );
            $this->add_control( 'sidebar_pagination_button_background_color', 'color' );
            $this->add_control( 'sidebar_pagination_button_radius', 'predefined_number' );
            $this->add_control( 'sidebar_pagination_button_box_shadow_initial', 'box_shadow' );
            $this->add_control( 'sidebar_pagination_button_box_shadow_hover', 'box_shadow' );
            $this->add_control( 'sidebar_pagination_button_padding', 'spacing' );
            // Mobile Options Section
            $this->add_section( 'mobile_options_section' );
            $this->add_control( 'show_main_banner_excerpt_mobile_option', 'checkbox' );
            $this->add_control( 'show_carousel_banner_excerpt_mobile_option', 'checkbox' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'show_video_playlist_in_mobile', 'checkbox' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'show_archive_excerpt_mobile_option', 'checkbox' );
            $this->add_control( 'show_archive_category_in_mobile', 'checkbox' );
            $this->add_control( 'show_archive_date_in_mobile', 'checkbox' );
            $this->add_control( 'show_author_meta_text', 'checkbox' );
            $this->add_control( 'show_archive_author_mobile_option', 'checkbox' );
            $this->add_control( 'show_readmore_text_mobile_option', 'checkbox' );
            $this->add_control( 'show_readmore_button_mobile_option', 'checkbox' );
            $this->add_control( 'show_readtime_mobile_option', 'checkbox' );
            $this->add_control( 'show_comment_number_mobile_option', 'checkbox' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'show_left_sidebar_mobile_option', 'checkbox' );
            $this->add_control( 'show_right_sidebar_mobile_option', 'checkbox' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'show_background_animation_on_mobile', 'checkbox' );
            $this->add_control( 'social_share_mobile_option', 'checkbox' );
            $this->add_control( 'show_table_of_content_label_on_mobile', 'checkbox' );
            // Top Header Section
            $this->add_section( 'date_time_section' );
            $this->add_control( 'date_time_typography', 'typography' );
            $this->add_control( 'date_color', 'color' );
            $this->add_control( 'time_color', 'color' );
            $this->add_control( 'date_time_background', 'color' );
            $this->add_control( 'date_time_border', 'border' );
            $this->add_control( 'date_time_padding', 'spacing' );
            // Menu Options Section
            $this->add_section( 'header_menu_options_section' );
            $this->add_control( 'menu_options_section_tab', 'section_tab' );
            $this->add_control( 'main_menu_typo', 'typography' );
            $this->add_control( 'main_menu_sub_menu_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'header_main_menu_header', 'section_heading' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'header_menu_color', 'color' );
            $this->add_control( 'header_active_menu_color', 'color' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'header_sub_menu_header', 'section_heading' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'header_sub_menu_color', 'color' );
            $this->add_control( 'header_sub_menu_background_color', 'color' );
            $this->add_control( 'header_sub_menu_box_shadow', 'box_shadow' );
            $this->add_control( 'header_menu_hover_effect', 'select' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'header_menu_cutoff_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'menu_cutoff_option', 'simple_toggle' );
            $this->add_control( 'menu_cutoff_after', 'predefined_number' );
            $this->add_control( 'menu_cutoff_text', 'text' );
            // Live Search Section
            $this->add_section( 'header_live_search_section' );
            $this->add_control( 'search_section_tab', 'section_tab' );
            $this->add_control( 'search_type', 'select' );
            $this->add_control( 'search_icon_size', 'number' );
            $this->add_control( 'search_no_of_post_to_display', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'search_view_all_button_text', 'text' );
            $this->add_control( 'search_no_result_found_text', 'text' );
            $this->add_control( 'search_post_image_show_hide', 'simple_toggle' );
            $this->add_control( 'search_post_date_show_hide', 'simple_toggle' );
            $this->add_control( 'search_icon_color', 'color' );
            $this->add_control( 'search_modal_background_color', 'color' );
            $this->add_control( 'search_view_all_button_text_color', 'color' );
            $this->add_control( 'search_view_all_button_background_color', 'color' );
            // Custom Button Section
            $this->add_section( 'custom_button_section' );
            $this->add_control( 'custom_button_section_tab', 'section_tab' );
            $this->add_control( 'custom_button_label', 'text' );
            $this->add_control( 'custom_button_icon', 'icon_picker' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'custom_button_redirect_href_link', 'url' );
            $this->add_control( 'custom_button_target', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'custom_button_icon_size', 'number' );
            $this->add_control( 'custom_button_icon_distance', 'predefined_number' );
            $this->add_control( 'custom_button_icon_prefix_suffix', 'radio_tab' );
            $this->add_control( 'custom_button_animation_type', 'select' );
            $this->add_control( 'custom_button_text_typography', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'custom_button_text_color', 'color' );
            $this->add_control( 'custom_button_icon_color', 'color' );
            $this->add_control( 'header_custom_button_background_color_group', 'color' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'header_custom_button_border', 'border' );
            $this->add_control( 'header_custom_button_border_radius', 'number' );
            $this->add_control( 'header_custom_button_box_shadow', 'box_shadow' );
            $this->add_control( 'custom_button_padding', 'spacing' );
            // Theme Mode Section
            $this->add_section( 'theme_mode_section' );
            $this->add_control( 'theme_mode_section_tab', 'section_tab' );            
            $this->add_control( 'theme_mode_dark_icon', 'icon_picker' );
            $this->add_control( 'theme_mode_light_icon', 'icon_picker' );
            $this->add_control( 'theme_mode_set_dark_mode_as_default', 'simple_toggle' );
            $this->add_control( 'theme_mode_icon_size', 'number' );
            $this->add_control( 'theme_mode_dark_icon_color', 'color' );
            $this->add_control( 'theme_mode_light_icon_color', 'color' );
            // Canvas Menu Section
            $this->add_section( 'canvas_menu_section' );
            $this->add_control( 'canvas_menu_setting', 'section_tab' );
            $this->add_control( 'canvas_menu_position', 'radio_tab' );
            $this->add_control( 'canvas_menu_width', 'number' );
            $this->add_control( 'canvas_menu_redirects', 'redirect_control' );
            $this->add_control( 'canvas_menu_icon_color', 'color' );
            $this->add_control( 'canvas_menu_background_color', 'color' );
            $this->add_control( 'canvas_menu_top_border', 'border' );
            // Advertisement Banner Section
            $this->add_section( 'header_advertisement_banner_section' );
            $this->add_control( 'header_ads_banner_image', 'media' );
            $this->add_control( 'header_ads_banner_image_link_url', 'simple_toggle' );
            $this->add_control( 'header_ads_banner_image_url', 'url' );
            $this->add_control( 'header_ads_banner_image_target_attr', 'radio_tab' );
            $this->add_control( 'header_ads_banner_image_rel_attr', 'select' );
            // Main Banner Section
            $this->add_section( 'main_banner_section' );
            $this->add_control( 'main_banner_section_heading', 'section_tab' );
            $this->add_control( 'main_banner_option', 'toggle' );
            $this->add_control( 'main_banner_layouts', 'radio_image' );
            $this->add_control( 'main_banner_render_in', 'select' );
            $this->add_control( 'main_banner_text_width', 'number' );
            $this->add_control( 'main_banner_show_social_icon', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_slider_categories', 'multiselect' );
            $this->add_control( 'main_banner_slider_posts_to_include', 'multiselect' );
            $this->add_control( 'main_banner_slider_posts_to_exclude', 'multiselect' );
            $this->add_control( 'main_banner_slider_tags', 'multiselect' );
            $this->add_control( 'main_banner_slider_authors', 'multiselect' );
            $this->add_control( 'main_banner_post_order', 'select' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'main_banner_post_offset', 'predefined_number' );
            $this->add_control( 'main_banner_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_post_elements_show_title', 'simple_toggle' );
            $this->add_control( 'main_banner_design_post_title_html_tag', 'select' );
            $this->add_control( 'main_banner_post_elements_show_categories', 'simple_toggle' );
            $this->add_control( 'main_banner_post_elements_show_author', 'simple_toggle' );
            $this->add_control( 'main_banner_post_elements_show_author_image', 'simple_toggle' );
            $this->add_control( 'main_banner_post_elements_show_date', 'simple_toggle' );
            $this->add_control( 'main_banner_design_post_date_icon_size', 'number' );
            $this->add_control( 'main_banner_date_icon', 'icon_picker' );
            $this->add_control( 'main_banner_post_elements_show_excerpt', 'simple_toggle' );
            $this->add_control( 'main_banner_post_elements_excerpt_length', 'predefined_number' );
            $this->add_control( 'main_banner_post_elements_alignment', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_slider_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_show_arrows', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_prev_arrow', 'icon_picker' );
            $this->add_control( 'main_banner_slider_next_arrow', 'icon_picker' );
            $this->add_control( 'main_banner_design_slider_icon_size', 'number' );
            $this->add_control( 'main_banner_arrows_divider', 'divider' );
            $this->customize->get_control( 'main_banner_arrows_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'main_banner_show_arrows' )->value();
            };
            $this->add_control( 'main_banner_show_fade', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_infinite_loop', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_autoplay', 'simple_toggle' );
            $this->add_control( 'main_banner_slider_autoplay_speed', 'predefined_number' );
            $this->add_control( 'main_banner_slider_speed', 'predefined_number' );
            $this->add_control( 'main_banner_show_arrow_on_hover', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_content_background', 'color' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'main_banner_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'main_banner_image_sizes', 'select' );
            $this->add_control( 'main_banner_responsive_image_ratio', 'number' );
            $this->add_control( 'main_banner_image_border', 'border' );
            $this->add_control( 'main_banner_image_border_radius', 'predefined_number' );
            $this->add_control( 'main_banner_design_typography', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'main_banner_design_post_title_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_excerpt_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_categories_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_date_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_author_typography', 'typography' );
            // Carousel Section
            $this->add_section( 'carousel_section' );
            $this->add_control( 'carousel_section_heading', 'section_tab' );
            $this->add_control( 'carousel_option', 'toggle' );
            $this->add_control( 'carousel_layouts', 'radio_image' );
            $this->add_control( 'carousel_render_in', 'select' );
            $this->add_control( 'carousel_no_of_columns', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_slider_categories', 'multiselect' );
            $this->add_control( 'carousel_slider_posts_to_include', 'multiselect' );
            $this->add_control( 'carousel_slider_posts_to_exclude', 'multiselect' );
            $this->add_control( 'carousel_slider_tags', 'multiselect' );
            $this->add_control( 'carousel_slider_authors', 'multiselect' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_post_order', 'select' );
            $this->add_control( 'carousel_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'carousel_post_offset', 'predefined_number' );
            $this->add_control( 'carousel_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_post_elements_show_title', 'simple_toggle' );
            $this->add_control( 'carousel_design_post_title_html_tag', 'select' );
            $this->add_control( 'carousel_post_elements_show_categories', 'simple_toggle' );
            $this->add_control( 'carousel_post_elements_show_author', 'simple_toggle' );
            $this->add_control( 'carousel_post_elements_show_author_image', 'simple_toggle' );
            $this->add_control( 'carousel_post_elements_show_date', 'simple_toggle' );
            $this->add_control( 'carousel_date_icon', 'icon_picker' );
            $this->add_control( 'carousel_design_post_date_icon_size', 'number' );
            $this->add_control( 'carousel_post_elements_show_excerpt', 'simple_toggle' );
            $this->add_control( 'carousel_post_elements_excerpt_length', 'predefined_number' );
            $this->add_control( 'carousel_post_elements_alignment', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_slider_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_show_arrows', 'simple_toggle' );
            $this->add_control( 'carousel_slider_prev_arrow', 'icon_picker' );
            $this->add_control( 'carousel_slider_next_arrow', 'icon_picker' );
            $this->add_control( 'carousel_design_slider_icon_size', 'number' );
            $this->add_control( 'carousel_arrows_divider', 'divider' );
            $this->customize->get_control( 'carousel_arrows_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'carousel_show_arrows' )->value();
            };
            $this->add_control( 'carousel_slider_infinite_loop', 'simple_toggle' );
            $this->add_control( 'carousel_slider_autoplay', 'simple_toggle' );
            $this->add_control( 'carousel_slider_autoplay_speed', 'predefined_number' );
            $this->add_control( 'carousel_slider_speed', 'predefined_number' );
            $this->add_control( 'carousel_slides_to_scroll', 'predefined_number' );
            $this->add_control( 'carousel_show_arrow_on_hover', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'carousel_image_sizes', 'select' );
            $this->add_control( 'carousel_responsive_image_ratio', 'number' );
            $this->add_control( 'carousel_image_border', 'border' );
            $this->add_control( 'carousel_image_border_radius', 'spacing' );
            $this->add_control( 'carousel_image_box_shadow', 'box_shadow' );
            $this->add_control( 'carousel_content_background', 'color' );
            $this->add_control( 'carousel_section_border_radius', 'number' );
            $this->add_control( 'carousel_box_shadow', 'box_shadow' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'carousel_design_typography', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'carousel_design_post_title_typography', 'typography' );
            $this->add_control( 'carousel_design_post_excerpt_typography', 'typography' );
            $this->add_control( 'carousel_design_post_categories_typography', 'typography' );
            $this->add_control( 'carousel_design_post_date_typography', 'typography' );
            $this->add_control( 'carousel_design_post_author_typography', 'typography' );
            // Video Playlist Section
            $this->add_section( 'video_playlist_section' );
            $this->add_control( 'video_playlist_section_heading', 'section_tab' );
            $this->add_control( 'video_playlist_general_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'video_playlist_option', 'toggle' );
            $this->add_control( 'video_playlist_api_key', 'text' );
            $this->add_control( 'video_playlist_layouts', 'radio_image' );
            $this->add_control( 'video_playlist_repeater', 'custom_repeater' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'video_playlist_display_position', 'radio_tab' );
            $this->add_control( 'video_playlist_play_icon', 'icon_picker' );
            $this->add_control( 'video_playlist_pause_icon', 'icon_picker' );
            $this->add_control( 'video_playlist_icon_size', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'video_playlist_slider_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'video_playlist_slider_arrow', 'simple_toggle' );
            $this->add_control( 'video_playlist_slider_show_arrow_on_hover', 'simple_toggle' );
            $this->add_control( 'video_playlist_previous_icon', 'icon_picker' );
            $this->add_control( 'video_playlist_next_icon', 'icon_picker' );
            $this->add_control( 'video_playlist_slider_icon_size', 'predefined_number' );
            $this->add_control( 'video_playlist_slider_infinite', 'simple_toggle' );
            $this->add_control( 'video_playlist_slider_autoplay', 'simple_toggle' );
            $this->add_control( 'video_playlist_slider_slides_to_show', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'video_playlist_typography_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'video_playlist_active_title_typo', 'typography' );
            $this->add_control( 'video_playlist_title_typo', 'typography' );
            $this->add_control( 'video_playlist_video_time_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'video_playlist_color_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'video_playlist_active_title_color', 'color' );
            $this->add_control( 'video_playlist_title_color', 'color' );
            $this->add_control( 'video_playlist_video_time_color', 'color' );
            $this->add_control( 'video_playlist_active_background_color', 'color' );
            $this->add_control( 'video_playlist_content_background_color', 'color' );
            $this->add_control( 'video_playlist_play_pause_icon_color', 'color' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'video_playlist_border_radius', 'predefined_number' );
            $this->add_control( 'video_playlist_box_shadow', 'box_shadow' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'video_playlist_slider_settings_heading_design_tab', 'section_heading_toggle' );
            // Category Collection Section
            $this->add_section( 'category_collection_section' );
            $this->add_control( 'category_collection_section_heading', 'section_tab' );
            $this->add_control( 'category_collection_option', 'toggle' );
            $this->add_control( 'category_collection_layout', 'radio_image' );
            $this->add_control( 'category_collection_render_in', 'select' );
            $this->add_control( 'category_collection_show_count', 'simple_toggle' );
            $this->add_control( 'category_collection_number_of_columns', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_query_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_to_include', 'multiselect' );
            $this->add_control( 'category_to_exclude', 'multiselect' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_orderby', 'select' );
            $this->add_control( 'category_collection_number', 'predefined_number' );
            $this->add_control( 'category_collection_offset', 'predefined_number' );
            $this->add_control( 'category_collection_hide_empty', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_slider_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_slider_option', 'simple_toggle' );
            $this->add_control( 'category_collection_slider_arrow', 'simple_toggle' );
            $this->add_control( 'category_collection_prev_arrow', 'icon_picker' );
            $this->add_control( 'category_collection_next_arrow', 'icon_picker' );
            $this->add_control( 'category_collection_autoplay_option', 'simple_toggle' );
            $this->add_control( 'category_collection_autoplay_speed', 'predefined_number' );
            $this->add_control( 'category_collection_slider_infinite', 'simple_toggle' );
            $this->add_control( 'category_collection_slider_speed', 'predefined_number' );
            $this->add_control( 'category_collection_slides_to_show', 'predefined_number' );
            $this->add_control( 'category_collection_slides_to_scroll', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_image_heading_section_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_collection_image_size', 'select' );
            $this->add_control( 'category_collection_image_ratio', 'number' );
            $this->add_control( 'category_collection_image_radius', 'number' );
            $this->add_control( 'category_collection_hover_effects', 'select' );
            $this->add_control( 'category_collection_typo', 'typography' );
            $this->add_control( 'category_collection_text_color', 'color' );
            $this->add_control( 'category_collection_content_background', 'color' );
            $this->add_control( 'category_collection_box_shadow', 'box_shadow' );
            // Blog / Archives Panel
            $this->add_panel( 'archive_panel' );
            // General Settings Section
            $this->add_section( 'archive_general_section' );
            $this->add_control( 'archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_layouts_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_post_column', 'number' );
            $this->add_control( 'archive_post_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_sidebar_layout', 'radio_image' );
            $this->add_control( 'archive_show_social_share', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_elements_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_post_elements_alignment', 'radio_tab' );
            $this->add_control( 'archive_title_option', 'simple_toggle' );
            $this->add_control( 'archive_title_tag', 'select' );
            $this->add_control( 'archive_excerpt_option', 'simple_toggle' );
            $this->add_control( 'archive_excerpt_length', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_category_option', 'simple_toggle' );
            $this->add_control( 'archive_date_option', 'simple_toggle' );
            $this->add_control( 'archive_date_icon', 'icon_picker' );
            $this->add_control( 'archive_read_time_option', 'simple_toggle' );
            $this->add_control( 'archive_read_time_icon', 'icon_picker' );
            $this->add_control( 'archive_comments_option', 'simple_toggle' );
            $this->add_control( 'archive_comments_icon', 'icon_picker' );
            $this->add_control( 'archive_author_option', 'simple_toggle' );
            $this->add_control( 'archive_author_image_option', 'simple_toggle' );
            $this->add_control( 'archive_button_option', 'simple_toggle' );
            $this->add_control( 'archive_hide_image_placeholder', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_image_size', 'select' );
            $this->add_control( 'archive_responsive_image_ratio', 'number' );
            $this->add_control( 'archive_image_border', 'border' );
            $this->add_control( 'archive_image_border_radius', 'spacing' );
            $this->add_control( 'archive_image_box_shadow', 'box_shadow' );
            $this->add_control( 'archive_background_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_inner_background_color', 'color' );
            $this->add_control( 'archive_section_border_radius', 'predefined_number' );
            $this->add_control( 'archive_box_shadow', 'box_shadow' );
            $this->add_control( 'archive_border_bottom_color', 'border' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_typography_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_title_typo', 'typography' );
            $this->add_control( 'archive_excerpt_typo', 'typography' );
            $this->add_control( 'archive_category_typo', 'typography' );
            $this->add_control( 'archive_date_typo', 'typography' );
            $this->add_control( 'archive_author_typo', 'typography' );
            $this->add_control( 'archive_read_time_typo', 'typography' );
            $this->add_control( 'archive_comment_typo', 'typography' );
            // Category Page Section
            $this->add_section( 'category_archive_section' );
            $this->add_control( 'category_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_category_info_box_option', 'toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'category_info_elements_settings_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_category_info_box_icon_option', 'simple_toggle' );
            $this->add_control( 'archive_category_info_box_icon', 'icon_picker' );
            $this->add_control( 'archive_category_info_box_title_option', 'simple_toggle' );
            $this->add_control( 'archive_category_info_box_title_tag', 'select' );
            $this->add_control( 'archive_category_info_box_description_option', 'simple_toggle' );
            $this->add_control( 'archive_category_info_box_background', 'color' );
            $this->add_control( 'category_box_shadow', 'box_shadow' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_category_info_box_typography_heading', 'section_heading' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_category_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_category_info_box_description_typo', 'typography' );
            // Tag Page Section
            $this->add_section( 'tag_archive_section' );
            $this->add_control( 'tag_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_tag_info_box_option', 'toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'tag_info_elements_settings_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_tag_info_box_icon_option', 'simple_toggle' );
            $this->add_control( 'archive_tag_info_box_icon', 'icon_picker' );
            $this->add_control( 'archive_tag_info_box_title_option', 'simple_toggle' );
            $this->add_control( 'archive_tag_info_box_title_tag', 'select' );
            $this->add_control( 'archive_tag_info_box_description_option', 'simple_toggle' );
            $this->add_control( 'archive_tag_info_box_background', 'color' );
            $this->add_control( 'tag_box_shadow', 'box_shadow' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_tag_info_box_typography_heading', 'section_heading' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_tag_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_tag_info_box_description_typo', 'typography' );
            // Author Page Section
            $this->add_section( 'author_archive_section' );
            $this->add_control( 'author_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_author_info_box_option', 'toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'author_info_elements_settings_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'archive_author_info_box_image_option', 'simple_toggle' );
            $this->add_control( 'archive_author_info_box_title_option', 'simple_toggle' );
            $this->add_control( 'archive_author_info_box_description_option', 'simple_toggle' );
            $this->add_control( 'archive_author_info_box_title_tag', 'select' );
            $this->add_control( 'archive_author_info_box_background', 'color' );
            $this->add_control( 'author_box_shadow', 'box_shadow' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_author_info_box_typography_heading', 'section_heading' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'archive_author_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_author_info_box_description_typo', 'typography' );
            // Pagination Settings Section
            $this->add_section( 'pagination_settings_section' );
            $this->add_control( 'archive_pagination_type', 'select' );
            $this->add_control( 'pagination_section_first_divider', 'divider' );
            $this->customize->get_control( 'pagination_section_first_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'archive_pagination_type' )->value() === 'ajax-load-more';
            };
            $this->add_control( 'pagination_button_heading', 'section_heading' );
            $this->add_control( 'pagination_section_second_divider', 'divider' );
            $this->customize->get_control( 'pagination_section_second_divider' )->active_callback = function( $control ){
                return $control->manager->get_setting( 'archive_pagination_type' )->value() === 'ajax-load-more';
            };
            $this->add_control( 'pagination_button_label', 'text' );
            $this->add_control( 'pagination_button_icon', 'icon_picker' );
            $this->add_control( 'archive_pagination_button_icon_context', 'radio_tab' );
            $this->add_control( 'pagination_no_more_reults_text', 'text' );
            $this->add_control( 'pagination_button_text_color', 'color' );
            $this->add_control( 'pagination_button_background_color', 'color' );
            // Single Post Panel
            $this->add_panel( 'single_section_panel' );
            //  General Settings Section
            $this->add_section( 'blog_single_general_settings' );
            $this->add_control( 'single_section_heading', 'section_tab' );
            $this->add_control( 'single_general_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_post_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_sidebar_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_article_width', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_author_box_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_author_box_option', 'simple_toggle' );
            $this->add_control( 'single_author_box_image_option', 'simple_toggle' );
            $this->add_control( 'single_author_info_box_title_option', 'simple_toggle' );
            $this->add_control( 'single_author_info_box_description_option', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_post_navigation_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_post_navigation_option', 'simple_toggle' );
            $this->add_control( 'single_post_navigation_thumbnail_option', 'simple_toggle' );
            $this->add_control( 'single_post_navigation_show_date', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_image_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_image_size', 'select' );
            $this->add_control( 'single_responsive_image_ratio', 'number' );
            $this->add_control( 'single_image_border', 'border' );
            $this->add_control( 'single_image_border_radius', 'predefined_number' );
            $this->add_control( 'single_image_box_shadow', 'box_shadow' );
            $this->add_control( 'single_typography_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'single_title_typo', 'typography' );
            $this->add_control( 'single_content_typo', 'typography' );
            $this->add_control( 'single_category_typo', 'typography' );
            $this->add_control( 'single_date_typo', 'typography' );
            $this->add_control( 'single_author_typo', 'typography' );
            $this->add_control( 'single_read_time_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'single_color_settings_header', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'single_page_background_color', 'color' );
            $this->add_control( 'single_page_box_shadow', 'box_shadow' );
            //  Elements Settings Section
            $this->add_section( 'blog_single_elements_settings_section' );
            $this->add_control( 'single_title_option', 'simple_toggle' );
            $this->add_control( 'single_title_tag', 'select' );
            $this->add_control( 'single_thumbnail_option', 'simple_toggle' );
            $this->add_control( 'single_category_option', 'simple_toggle' );
            $this->add_control( 'single_date_option', 'simple_toggle' );
            $this->add_control( 'single_date_icon', 'icon_picker' );
            $this->add_control( 'single_read_time_option', 'simple_toggle' );
            $this->add_control( 'single_read_time_icon', 'icon_picker' );
            $this->add_control( 'single_comments_option', 'simple_toggle' );
            $this->add_control( 'single_comments_icon', 'icon_picker' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_post_author_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_author_option', 'simple_toggle' );
            $this->add_control( 'single_author_image_option', 'simple_toggle' );
            $this->add_control( 'single_gallery_lightbox_option', 'simple_toggle' );
            $this->add_control( 'single_post_content_alignment', 'radio_tab' );
            //  Table of Content Section
            $this->add_section( 'blog_single_toc_section' );
            $this->add_control( 'toc_option', 'toggle' );
            $this->add_control( 'toc_heading_option', 'text' );
            $this->add_control( 'toc_field_for_heading', 'multiselect_normal' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'toc_hierarchical', 'radio_tab' );
            $this->add_control( 'toc_list_type', 'select' );
            $this->add_control( 'toc_list_icon', 'icon_picker' );
            $this->add_control( 'toc_display_type', 'radio_tab' );
            $this->add_control( 'toc_sticky_width', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'toc_enable_accordion', 'simple_toggle' );
            $this->add_control( 'toc_default_toggle', 'simple_toggle' );
            $this->add_control( 'toc_open_icon', 'icon_picker' );
            $this->add_control( 'toc_close_icon', 'icon_picker' );
            //  Related Posts Section
            $this->add_section( 'blog_single_related_posts_section' );
            $this->add_control( 'single_post_related_posts_option', 'toggle' );
            $this->add_control( 'related_posts_layouts', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'single_post_related_posts_title', 'text' );
            $this->add_control( 'related_posts_no_of_column', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'related_posts_filter_by', 'select' );
            $this->add_control( 'related_posts_author_option', 'simple_toggle' );
            $this->add_control( 'related_posts_date_option', 'simple_toggle' );
            $this->add_control( 'related_posts_comment_option', 'simple_toggle' );
            // Page Settings panel
            $this->add_panel( 'page_setting_panel' );
            // Page Settings Section
            $this->add_section( 'page_settings_section' );
            $this->add_control( 'page_settings_section_tab', 'section_tab' );
            $this->add_control( 'page_settings_sidebar_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'page_title_option', 'simple_toggle' );
            $this->add_control( 'page_title_tag', 'select' );
            $this->add_control( 'page_thumbnail_option', 'simple_toggle' );
            $this->add_control( 'page_content_option', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'page_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'page_image_size', 'select' );
            $this->add_control( 'page_responsive_image_ratio', 'number' );
            $this->add_control( 'page_image_border', 'border' );
            $this->add_control( 'page_image_border_radius', 'predefined_number' );
            $this->add_control( 'page_image_box_shadow', 'box_shadow' );
            $this->add_control( 'page_typography_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'page_title_typo', 'typography' );
            $this->add_control( 'page_content_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'page_color_settings_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'page_background_color', 'color' );
            $this->add_control( 'page_box_shadow', 'box_shadow' );
            // 404 Page Section
            $this->add_section( 'error_page_settings_section' );
            $this->add_control( 'error_page_section_tab', 'section_tab' );
            $this->add_control( 'error_page_sidebar_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'error_page_title_text', 'text' );
            $this->add_control( 'error_page_image', 'media' );
            $this->add_control( 'error_page_content_text', 'text' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'error_page_button_show_hide', 'simple_toggle' );
            $this->add_control( 'error_page_button_text', 'text' );
            $this->add_control( 'error_page_button_icon', 'icon_picker' );
            $this->add_control( 'error_page_button_icon_size', 'number' );
            $this->add_control( 'error_page_button_icon_context', 'radio_tab' );
            $this->add_control( 'error_page_title_typo', 'typography' );
            $this->add_control( 'error_page_content_typo', 'typography' );
            $this->add_control( 'error_page_button_text_typo', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'error_page_background_color', 'color' );
            $this->add_control( 'error_page_button_background_color', 'color' );
            // Search Page Section
            $this->add_section( 'search_page_settings' );
            $this->add_control( 'search_page_sidebar_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'search_page_form_show_hide', 'simple_toggle' );
            $this->add_control( 'search_page_title', 'text' );
            $this->add_control( 'search_nothing_found_title', 'text' );
            $this->add_control( 'search_nothing_found_content', 'textarea' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'search_page_button_text', 'text' );
            $this->add_control( 'search_box_shadow', 'box_shadow' );
            // Page table of content
            $this->add_section( 'page_table_of_content_section' );
            $this->add_control( 'page_toc_option', 'toggle' );
            $this->add_control( 'page_toc_heading_option', 'text' );
            $this->add_control( 'page_toc_field_for_heading', 'multiselect_normal' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'page_toc_hierarchical', 'radio_tab' );
            $this->add_control( 'page_toc_list_type', 'select' );
            $this->add_control( 'page_toc_list_icon', 'icon_picker' );
            $this->add_control( 'page_toc_display_type', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'page_toc_sticky_width', 'predefined_number' );
            $this->add_control( 'page_toc_enable_accordion', 'simple_toggle' );
            $this->add_control( 'page_toc_default_toggle', 'simple_toggle' );
            $this->add_control( 'page_toc_open_icon', 'icon_picker' );
            $this->add_control( 'page_toc_close_icon', 'icon_picker' );
            // Instagram Section 
            $this->add_section( 'instagram_section' );
            $this->add_control( 'instagram_section_tab', 'section_tab' );
            $this->add_control( 'instagram_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_section_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_repeater', 'custom_repeater' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_url_image_link', 'simple_toggle' );
            $this->add_control( 'instagram_enable_lightbox', 'simple_toggle' );
            $this->add_control( 'instagram_link_target', 'radio_tab' );
            $this->add_control( 'instagram_rel_attribute', 'select' );
            $this->add_control( 'instagram_no_of_columns', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_caption', 'simple_toggle' );
            $this->add_control( 'show_instagram_button', 'simple_toggle' );
            $this->add_control( 'instagram_button_icon', 'icon_picker' );
            $this->add_control( 'instagram_button_text', 'text' );
            $this->add_control( 'instagram_button_url', 'url' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_slider_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_enable_slider_in_header', 'simple_toggle' );
            $this->add_control( 'instagram_slider_arrow', 'simple_toggle' );
            $this->add_control( 'instagram_prev_arrow', 'icon_picker' );
            $this->add_control( 'instagram_next_arrow', 'icon_picker' );
            $this->add_control( 'instagram_autoplay_option', 'simple_toggle' );
            $this->add_control( 'instagram_autoplay_speed', 'predefined_number' );
            $this->add_control( 'instagram_slider_infinite', 'simple_toggle' );
            $this->add_control( 'instagram_slider_speed', 'predefined_number' );
            $this->add_control( 'instagram_slides_to_show', 'predefined_number' );
            $this->add_control( 'instagram_slides_to_scroll', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_image_heading_section_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'instagram_image_size', 'select' );
            $this->add_control( 'instagram_image_ratio', 'number' );
            $this->add_control( 'instagram_image_radius', 'number' );
            $this->add_control( 'instagram_image_border', 'border' );
            $this->add_control( 'instagram_hover_effects', 'select' );
            $this->add_control( 'instagram_button_typo', 'typography' );
            $this->add_control( 'instagram_padding', 'spacing' );
            $this->add_control( 'instagram_gap', 'number' );
            // You May Have Missed Section  
            $this->add_section( 'you_may_have_missed_section' );
            $this->add_control( 'you_may_have_missed_section_tab', 'section_tab' );
            $this->add_control( 'you_may_have_missed_section_option', 'toggle' );
            $this->add_control( 'you_may_have_missed_layouts', 'radio_image' );
            $this->add_control( 'you_may_have_missed_no_of_columns', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_title_option', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_title', 'text' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_categories', 'multiselect' );
            $this->add_control( 'you_may_have_missed_posts_to_include', 'multiselect' );
            $this->add_control( 'you_may_have_missed_posts_to_exclude', 'multiselect' );
            $this->add_control( 'you_may_have_missed_tags', 'multiselect' );
            $this->add_control( 'you_may_have_missed_authors', 'multiselect' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_post_order', 'select' );
            $this->add_control( 'you_may_have_missed_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'you_may_have_missed_post_offset', 'predefined_number' );
            $this->add_control( 'you_may_have_missed_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_post_elements_show_title', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_design_post_title_html_tag', 'select' );
            $this->add_control( 'you_may_have_missed_post_elements_show_categories', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_post_elements_show_author', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_post_elements_show_date', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_date_icon', 'icon_picker' );
            $this->add_control( 'you_may_have_missed_post_elements_alignment', 'radio_tab' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'you_may_have_missed_image_sizes', 'select' );
            $this->add_control( 'you_may_have_missed_responsive_image_ratio', 'number' );
            $this->add_control( 'you_may_have_missed_image_border', 'border' );
            $this->add_control( 'you_may_have_missed_image_widgets_box_shadow', 'box_shadow' );
            $this->add_control( 'you_may_have_missed_image_border_radius', 'spacing' );
            $this->add_control( 'you_may_have_missed_design_color_settings', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'you_may_have_missed_title_color', 'color' );
            $this->add_control( 'you_may_have_missed_post_title_color', 'color' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'you_may_have_missed_design_typography', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'you_may_have_missed_design_section_title_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_title_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_categories_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_date_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_author_typography', 'typography' );
            // Footer Builder
            $this->add_section( 'footer_builder_section_settings' );
            $this->add_control( 'footer_builder_section_width', 'radio_image' );
            $this->add_control( 'footer_builder_background', 'color' );
            $this->add_control( 'footer_builder_border', 'border' );
            $this->add_control( 'footer_builder_margin', 'spacing' );
            $this->add_control( 'footer_section_tab', 'section_tab' );
            $this->add_control( 'theme_footer_typography', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'footer_title_typography', 'typography' );
            $this->add_control( 'footer_text_typography', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'theme_footer_color_settings', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'footer_text_color', 'color' );
            $this->add_control( 'footer_title_color', 'color' );
            /* Footer Copyright */
            $this->add_section( 'footer_copyright' );
            $this->add_control( 'bottom_footer_section_tab', 'section_tab' );
            $this->add_control( 'bottom_footer_site_info', 'editor_control' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'bottom_footer_typography', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'bottom_footer_text_typography', 'typography' );
            $this->add_control( 'bottom_footer_link_typography', 'typography' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'bottom_footer_color_settings', 'section_heading_toggle' );
            $this->add_control( '', 'divider', true );
            $this->add_control( 'bottom_footer_text_color', 'color' );
            $this->add_control( 'bottom_footer_link_color', 'color' );
            /* Footer Logo */
            $this->add_section( 'footer_logo' );
            $this->add_control( 'bottom_footer_logo_option', 'media' );
            $this->add_control( 'footer_dark_mode_logo', 'media' );
            $this->add_control( 'bottom_footer_header_or_custom', 'select' );
            $this->add_control( 'bottom_footer_logo_width', 'number' );
            // Background Section
            $this->section = 'background_image';
            $this->add_control( 'site_background_color', 'color' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'site_background_animation_settings_heading', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'site_background_animation', 'select' );
            $this->add_control( 'animation_object_color', 'color' );
            // Header builder row one sections
            $this->add_section( 'header_first_row' );
            $this->add_control( 'header_first_row_section_tab', 'section_tab' );
            $this->add_control( 'header_first_row_column', 'number' );
            $this->add_control( 'header_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_first_row_reflector', 'builder_reflector' );
            $this->add_control( 'header_first_row_background', 'color' );
            $this->add_control( 'header_first_row_border', 'border' );
            $this->add_control( 'header_first_row_padding', 'spacing' );
            $this->add_control( 'header_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_four', 'responsive_radio_tab' );
            // Header second row section
            $this->add_section( 'header_second_row' );
            $this->add_control( 'header_second_row_section_tab', 'section_tab' );
            $this->add_control( 'header_second_row_column', 'number' );
            $this->add_control( 'header_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_second_row_reflector', 'builder_reflector' );
            $this->add_control( 'header_second_row_background', 'color' );
            $this->add_control( 'header_second_row_border', 'border' );
            $this->add_control( 'header_second_row_padding', 'spacing' );
            $this->add_control( 'header_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_four', 'responsive_radio_tab' );
            // Header third row section
            $this->add_section( 'header_third_row' );
            $this->add_control( 'header_third_row_section_tab', 'section_tab' );
            $this->add_control( 'header_third_row_column', 'number' );
            $this->add_control( 'header_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_third_row_reflector', 'builder_reflector' );
            $this->add_control( 'header_third_row_background', 'color' );
            $this->add_control( 'header_third_row_border', 'border' );
            $this->add_control( 'header_third_row_padding', 'spacing' );
            $this->add_control( 'header_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_four', 'responsive_radio_tab' );
            // Footer builder row one sections
            $this->add_section( 'footer_first_row' );
            $this->add_control( 'footer_first_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_first_row_column', 'number' );
            $this->add_control( 'footer_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_first_row_reflector', 'builder_reflector' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_first_row_row_direction', 'radio_tab' );
            $this->add_control( 'footer_first_row_vertical_alignment', 'radio_tab' );
            $this->add_control( 'footer_first_row_background', 'color' );
            $this->add_control( 'footer_first_row_border', 'border' );
            $this->add_control( 'footer_first_row_padding', 'spacing' );
            $this->add_control( 'footer_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_four', 'responsive_radio_tab' );
            // Footer second row section
            $this->add_section( 'footer_second_row' );
            $this->add_control( 'footer_second_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_second_row_column', 'number' );
            $this->add_control( 'footer_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_second_row_reflector', 'builder_reflector' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_second_row_row_direction', 'radio_tab' );
            $this->add_control( 'footer_second_row_vertical_alignment', 'radio_tab' );
            $this->add_control( 'footer_second_row_background', 'color' );
            $this->add_control( 'footer_second_row_border', 'border' );
            $this->add_control( 'footer_second_row_padding', 'spacing' );
            $this->add_control( 'footer_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_four', 'responsive_radio_tab' );
            // Footer third row section
            $this->add_section( 'footer_third_row' );
            $this->add_control( 'footer_third_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_third_row_column', 'number' );
            $this->add_control( 'footer_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_third_row_reflector', 'builder_reflector' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_third_row_row_direction', 'radio_tab' );
            $this->add_control( 'footer_third_row_vertical_alignment', 'radio_tab' );
            $this->add_control( 'footer_third_row_background', 'color' );
            $this->add_control( 'footer_third_row_border', 'border' );
            $this->add_control( 'footer_third_row_padding', 'spacing' );
            $this->add_control( 'footer_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_four', 'responsive_radio_tab' );
            // Mobile Canvas
            $this->add_section( 'mobile_canvas_section' );
            $this->add_control( 'mobile_canvas_section_tab', 'section_tab' );
            $this->add_control( 'mobile_canvas_reflector', 'builder_reflector' );
            $this->add_control( 'mobile_canvas_alignment', 'radio_tab' );
            $this->add_control( 'mobile_canvas_icon_color', 'color' );
            $this->add_control( 'mobile_canvas_background', 'color' );
            $this->add_control( 'mobile_canvas_padding', 'spacing' );
            // Footer Menu Options
            $this->add_section( 'footer_menu_options_section' );
            $this->add_control( 'footer_menu_section_tab', 'section_tab' );
            $this->add_control( 'footer_menu_control', 'select' );
            $this->add_control( 'footer_menu_typography', 'typography' );
            $this->add_control( 'footer_menu_color', 'color' );
            // Footer Social Icons
            $this->add_section( 'footer_social_icons_section' );
            $this->add_control( 'footer_social_icons_section_heading', 'section_tab' );
            $this->add_control( 'footer_social_icons_settings_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_social_icons_target', 'radio_tab' );
            $this->add_control( 'footer_social_icons', 'custom_repeater' );
            $this->add_control( 'footer_social_icon_official_color_inherit', 'simple_toggle' );
            $this->add_control( 'footer_social_icons_hover_animation', 'simple_toggle' );
            $this->add_control( 'footer_social_icons_font_size', 'number' );
            $this->add_control( 'footer_social_icon_color', 'color' );
            // Footer Instagram Section 
            $this->add_section( 'footer_instagram_section' );
            $this->add_control( 'footer_instagram_section_tab', 'section_tab' );
            $this->add_control( 'footer_instagram_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_layout', 'radio_image' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_section_header', 'section_heading' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_repeater', 'custom_repeater' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_url_image_link', 'simple_toggle' );
            $this->add_control( 'footer_instagram_enable_lightbox', 'simple_toggle' );
            $this->add_control( 'footer_instagram_link_target', 'radio_tab' );
            $this->add_control( 'footer_instagram_rel_attribute', 'select' );
            $this->add_control( 'footer_instagram_no_of_columns', 'number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_caption', 'simple_toggle' );
            $this->add_control( 'footer_show_instagram_button', 'simple_toggle' );
            $this->add_control( 'footer_instagram_button_icon', 'icon_picker' );
            $this->add_control( 'footer_instagram_button_text', 'text' );
            $this->add_control( 'footer_instagram_button_url', 'url' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_slider_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_enable_slider_in_footer', 'simple_toggle' );
            $this->add_control( 'footer_instagram_slider_arrow', 'simple_toggle' );
            $this->add_control( 'footer_instagram_prev_arrow', 'icon_picker' );
            $this->add_control( 'footer_instagram_next_arrow', 'icon_picker' );
            $this->add_control( 'footer_instagram_autoplay_option', 'simple_toggle' );
            $this->add_control( 'footer_instagram_autoplay_speed', 'predefined_number' );
            $this->add_control( 'footer_instagram_slider_infinite', 'simple_toggle' );
            $this->add_control( 'footer_instagram_slider_speed', 'predefined_number' );
            $this->add_control( 'footer_instagram_slides_to_show', 'predefined_number' );
            $this->add_control( 'footer_instagram_slides_to_scroll', 'predefined_number' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_image_heading_section_heading', 'section_heading_toggle' );
            $this->add_control( '', 'divider' );
            $this->add_control( 'footer_instagram_image_size', 'select' );
            $this->add_control( 'footer_instagram_image_ratio', 'number' );
            $this->add_control( 'footer_instagram_image_radius', 'number' );
            $this->add_control( 'footer_instagram_image_border', 'border' );
            $this->add_control( 'footer_instagram_hover_effects', 'select' );
            $this->add_control( 'footer_instagram_button_typo', 'typography' );
            $this->add_control( 'footer_instagram_padding', 'spacing' );
            $this->add_control( 'footer_instagram_gap', 'number' );
            /* Header Builder Section */
            $this->add_section( 'header_builder_section' );
            $this->add_control( 'header_builder', 'builder' );
            $this->add_control( 'responsive_header_builder', 'responsive_builder' );
            /* Footer Builder Section */
            $this->add_section( 'footer_builder_section' );
            $this->add_control( 'footer_builder', 'builder' );
        }

        /**
         * Add a panel in the customizer
         * 
         * @since 1.0.0
         */
        public function add_panel( $id ) {
            if( $id ) :
                $params = $this->get_panels( $id );
                return $this->customize->add_panel( $id, $params );
            endif;
        }

        /**
         * Add a section in the customizer
         * 
         * @since 1.0.0
         */
        public function add_section( $id ) {
            if( $id ) :
                $this->section = $id;
                $params = $this->get_sections( $id );
                return $this->customize->add_section( $id, $params );
            endif;
        }

        /**
         * Add a control in the customizer
         * 
         * @since 1.0.0
         */
        public function add_control( $id, $control_type = 'text', $design_tab = false ) {
            if( $id || $control_type === 'divider' ) :
                $function = $this->get_class_or_sanitize_function( $control_type, 'function' );
                $params = $this->$function( $control_type === 'divider' ? $design_tab : $id );
                $params['section'] = $this->section;
                $transport = true;
                
                if( array_key_exists( 'transport', $params ) ) :
                    if( $params['transport'] === 'refresh' ) $transport = false;
                    unset( $params['transport'] );
                endif;
                $this->customize->add_setting( $id, $this->get_add_setting_params( $id, $control_type, $transport ) );   // register setting

                if( in_array( $control_type, [ 'checkbox', 'text', 'select', 'url', 'textarea', 'predefined_number' ] ) ) :
                    $this->customize->add_control( $id, $params );  // register controls
                else :
                    $class_name = $this->get_class_or_sanitize_function( $control_type, 'class' );
                    $this->customize->add_control( new $class_name( $this->customize, $id, $params ) ); // register custom controls
                endif;
            endif;
        }

        /**
         * Get add_settings() parameters
         * 
         * @since 1.0.0
         */
        public function get_add_setting_params( $control_id = '', $control_type = '', $transport = false ) {
            if( ! $control_id ) return;
            $value = [];
            if( ! in_array( $control_type, [ 'info_box', 'section_heading_toggle', 'section_heading', 'redirect_control', 'divider', 'builder_reflector' ] ) ) :
                $default_value = ( $control_type == 'section_tab' ) ? 'general' : BMC\blogmatic_get_customizer_default( $control_id );
                $value['default'] = $default_value;
            endif;
            if( $control_type ) $value['sanitize_callback'] = $this->get_class_or_sanitize_function( $control_type, 'sanitize' );
            if( $control_type === 'number' ) :
                $function = $this->get_class_or_sanitize_function( $control_type, 'function' );
                $params = $this->$function( $control_id );
                if( array_key_exists( 'responsive', $params ) && ! $params['responsive'] ) $value['sanitize_callback'] = 'absint';
            endif; 
            if( $transport ) $value['transport'] = 'postMessage';
            return $value;
        }

        /**
         * return class or sanitize function
         * 
         * @since 1.0.0
         */
        public function get_class_or_sanitize_function( $type, $class_sanitize_func ) {
            switch( $type ) :
                case 'typography' :
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Typography_Control',
                        'sanitize'  =>  'blogmatic_sanitize_typo_control',
                        'function'  =>  'get_typography'
                    ];
                    break;
                case 'box_shadow' :
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Box_Shadow_Control',
                        'sanitize'  =>  'blogmatic_sanitize_box_shadow_control',
                        'function'  =>  'get_box_shadow'
                    ];
                    break;
                case 'checkbox' :
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_checkbox',
                        'function'  =>  'get_checkbox'
                    ];
                    break;
                case 'toggle' :
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Toggle_Control',
                        'sanitize'  =>  'blogmatic_sanitize_toggle_control',
                        'function'  =>  'get_toggle'
                    ];
                    break;
                case 'simple_toggle' :
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Simple_Toggle_Control',
                        'sanitize'  =>  'blogmatic_sanitize_toggle_control',
                        'function'  =>  'get_simeple_toggle'
                    ];
                    break;
                case 'section_tab': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Section_Tab_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_section_tab'
                    ];
                    break;
                case 'spacing': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Spacing_Control',
                        'sanitize'  =>  'blogmatic_sanitize_spacing_control',
                        'function'  =>  'get_spacing'
                    ];
                    break;
                case 'radio_tab': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Radio_Tab_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_radio_tab'
                    ];
                    break;
                case 'info_box': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Info_Box_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_info_box'
                    ];
                    break;
                case 'section_heading_toggle': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Section_Heading_Toggle_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_section_heading_toggle'
                    ];
                    break;
                case 'item_sortable': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Item_Sortable_Control',
                        'sanitize'  =>  'blogmatic_sanitize_sortable_control',
                        'function'  =>  'get_item_sortable'
                    ];
                    break;
                case 'number': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Number_Range_Control',
                        'sanitize'  =>  'blogmatic_sanitize_responsive_range',
                        'function'  =>  'get_number'
                    ];
                    break;
                case 'section_heading': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Section_Heading_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_section_heading'
                    ];
                    break;
                case 'redirect_control': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Redirect_Control',
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_redirect_control'
                    ];
                    break;
                case 'radio_image': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Radio_Image_Control',
                        'sanitize'  =>  'blogmatic_sanitize_select_control',
                        'function'  =>  'get_radio_image'
                    ];
                    break;
                case 'icon_picker': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Icon_Picker_Control',
                        'sanitize'  =>  'blogmatic_sanitize_icon_picker_control',
                        'function'  =>  'get_icon_picker'
                    ];
                    break;
                case 'editor_control': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Editor_Control',
                        'sanitize'  =>  'wp_kses_post',
                        'function'  =>  'get_editor_control'
                    ];
                    break;
                case 'text': 
                    $control_array = [
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_text'
                    ];
                    break;
                case 'select': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_select_control',
                        'function'  =>  'get_select'
                    ];
                    break;
                case 'border': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Border_Control',
                        'sanitize'  =>  'blogmatic_sanitize_array',
                        'function'  =>  'get_border'
                    ];
                    break;
                case 'preset': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Preset_Control',
                        'sanitize'  =>  'blogmatic_sanitize_preset_colors',
                        'function'  =>  'get_preset_colors'
                    ];
                    break;
                case 'color': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Color_Control',
                        'sanitize'  =>  'blogmatic_sanitize_color_control',
                        'function'  =>  'get_colors'
                    ];
                    break;
                case 'media': 
                    $control_array = [
                        'class' =>  'WP_Customize_Media_Control',
                        'sanitize'  =>  'absint',
                        'function'  =>  'get_media_control'
                    ];
                    break;
                case 'predefined_color': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Default_Color_Control',
                        'sanitize'  =>  'sanitize_hex_color',
                        'function'  =>  'get_predefined_colors'
                    ];
                    break;
                case 'custom_repeater': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Custom_Repeater',
                        'sanitize'  =>  'blogmatic_sanitize_repeater_control',
                        'function'  =>  'get_custom_repeaters'
                    ];
                    break;
                case 'social_share': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Social_Share_Control',
                        'sanitize'  =>  'blogmatic_sanitize_social_share_control',
                        'function'  =>  'get_social_share'
                    ];
                    break;
                case 'predefined_number': 
                    $control_array = [
                        'sanitize'  =>  'absint',
                        'function'  =>  'get_custom_number_controls'
                    ];
                    break;
                case 'url': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_url',
                        'function'  =>  'get_url'
                    ];
                    break;
                case 'multiselect': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Post_Multiselect_Control',
                        'sanitize'  =>  'blogmatic_sanitize_async_multiselect_control',
                        'function'  =>  'get_multiselect_controls'
                    ];
                    break;
                case 'multiselect_normal': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Multiselect_Control',
                        'sanitize'  =>  'blogmatic_sanitize_normal_multiselect_control',
                        'function'  =>  'get_normal_multiselect_controls'
                    ];
                    break;
                case 'typography_preset': 
                    $control_array = [
                        'class' =>  'Blogmatic_WP_Typography_Preset_Control',
                        'sanitize'  =>  'blogmatic_sanitize_typography_preset_control',
                        'function'  =>  'get_typography_preset_controls'
                    ];
                    break;
                case 'textarea': 
                    $control_array = [
                        'sanitize'  =>  'sanitize_textarea_field',
                        'function'  =>  'get_textareas'
                    ];
                    break;
                case 'preset_color': 
                    $control_array = [
                        'sanitize'  =>  'sanitize_text_field',
                        'function'  =>  'get_theme_colors',
                        'class' =>  'Blogmatic_WP_Theme_Color_Control'
                    ];
                    break;
                case 'divider': 
                    $control_array = [
                        'sanitize'  =>  '', // not needed as no value is sent
                        'function'  =>  'get_divider_controls',
                        'class' =>  'Blogmatic_WP_Divider_Control'
                    ];
                    break;
                case 'builder_reflector': 
                    $control_array = [
                        'sanitize'  =>  '', // not needed as no value is sent
                        'function'  =>  'get_builder_reflector_controls',
                        'class' =>  'Blogmatic_WP_Builder_Reflector_Control'
                    ];
                    break;
                case 'responsive_radio_image': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_responsive_radio_image',
                        'function'  =>  'get_responsive_radio_image',
                        'class' =>  'Blogmatic_WP_Responsive_Radio_Image'
                    ];
                    break;
                case 'responsive_radio_tab': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_responsive_radio_tab',
                        'function'  =>  'get_responsive_radio_tab',
                        'class' =>  'Blogmatic_WP_Responsive_Radio_Tab_Control'
                    ];
                    break;
                case 'builder': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_builder_control',
                        'function'  =>  'get_builder_controls',
                        'class' =>  'Blogmatic_WP_Builder_Control'
                    ];
                    break;
                case 'responsive_builder': 
                    $control_array = [
                        'sanitize'  =>  'blogmatic_sanitize_builder_control',
                        'function'  =>  'get_responsive_builder_controls',
                        'class' =>  'Blogmatic_WP_Responsive_Builder_Control'
                    ];
                    break;
            endswitch;
            return $control_array[ $class_sanitize_func ];
        }   // End of get_class_or_sanitize_function() Method
    }
   add_action( 'customize_register', function( $wp_customize ){
      Blogmatic_Customizer::instance( $wp_customize );
   }, 10 );
 endif;