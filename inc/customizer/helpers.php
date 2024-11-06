<?php
use Blogmatic\CustomizerDefault as BMC;
/**
 * Includes panel, section and controls ids and parameters
 * 
 * @since 1.0.0
 * @package Blogmatic Pro
 */

 if( ! class_exists( 'Blogmatic_Customizer_List' ) ) :
    class Blogmatic_Customizer_List {
        /**
         * Returns panels array
         * 
         * @since 1.0.0
         */
        public function get_panels( $id = '' ) {
            $panels_array = [
                'global_panel'    =>  [
                    'title' =>  __( 'Global', 'blogmatic-pro' ),
                    'priority'  => 6
                ],
                'colors_panel'    =>  [
                    'title' =>  __( 'Colors', 'blogmatic-pro' ),
                    'priority'  => 20
                ],
                'archive_panel'    =>  [
                    'title' =>  __( 'Blog / Archives', 'blogmatic-pro' ),
                    'priority'  =>  80
                ],
                'single_section_panel'    =>  [
                    'title' =>  __( 'Single Post', 'blogmatic-pro' ),
                    'priority'  =>  80
                ],
                'page_setting_panel'    =>  [
                    'title' =>  __( 'Page Settings', 'blogmatic-pro' ),
                    'priority'  =>  80
                ]
            ];
            return ( $id ? $panels_array[ $id ] : $panels_array );
        }

        /**
         * Returns sections array
         * 
         * @since 1.0.0
         */
        public function get_sections( $id = '' ) {
            $sections_array =  [
                'about_section' => [
                    'title' => esc_html__( 'About Theme', 'blogmatic-pro' ),
                    'priority'  => 1
                ],
                'header_builder_section' => [
                    'title' => esc_html__( 'Header Builder', 'blogmatic-pro' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'footer_builder_section' => [
                    'title' => esc_html__( 'Footer Builder', 'blogmatic-pro' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'header_builder_section_settings' => [
                    'title' => esc_html__( 'Header Builder', 'blogmatic-pro' ),
                    'priority'  => 20
                ],
                'footer_builder_section_settings' => [
                    'title' => esc_html__( 'Footer Builder', 'blogmatic-pro' ),
                    'priority'  => 80
                ],
                'seo_misc_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'SEO / Misc', 'blogmatic-pro' ),
                ],
                'preloader_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Preloader', 'blogmatic-pro' ),
                ],
                'website_layout_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Website Layout', 'blogmatic-pro' ),
                ],
                'animation_section' => [
                    'title' => esc_html__( 'Animation / Hover Effects', 'blogmatic-pro' ),
                    'panel' => 'global_panel'
                ],
                'social_icons_section' => [
                    'title' => esc_html__( 'Social Icons', 'blogmatic-pro' ),
                ],
                'footer_social_icons_section' => [
                    'title' => esc_html__( 'Social Icons', 'blogmatic-pro' ),
                ],
                'buttons_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Buttons', 'blogmatic-pro' ),
                ],
                'post_format_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Post Format', 'blogmatic-pro' ),
                ],
                'breadcrumb_options_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Breadcrumb Options', 'blogmatic-pro' ),
                ],
                'stt_options_section' => [
                    'title' => esc_html__( 'Scroll To Top', 'blogmatic-pro' ),
                ],
                'global_social_share_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Social Share', 'blogmatic-pro' ),
                ],
                'reset_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Reset To Default', 'blogmatic-pro' ),
                ],
                'advertisement_section' => [
                    'title' =>  esc_html__( 'Advertisement', 'blogmatic-pro' ),
                    'priority'  =>  29
                ],
                'typography_section' => [
                    'title' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'priority'  => 30
                ],
                'widget_styles_section' => [
                    'title' => esc_html__( 'Sidebar / Widget Styles', 'blogmatic-pro' ),
                    'priority'  => 30
                ],
                'mobile_options_section' => [
                    'title' => esc_html__( 'Mobile Options', 'blogmatic-pro' ),
                    'priority'  => 30
                ],
                'theme_presets_section' => [
                    'panel' =>  'colors_panel',
                    'title' =>  esc_html__( 'Theme Colors / Presets', 'blogmatic-pro' ),
                ],
                'category_colors_section' => [
                    'panel' => 'colors_panel',
                    'title' => esc_html__( 'Category Colors', 'blogmatic-pro' ),
                ],
                'tag_colors_section' => [
                    'title' => esc_html__( 'Tag Colors', 'blogmatic-pro' ),
                    'panel' => 'colors_panel',
                ],
                'date_time_section' => [
                    'title' =>  esc_html__( 'Date / Time', 'blogmatic-pro' )
                ],
                'header_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'blogmatic-pro' )
                ],
                'footer_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'blogmatic-pro' )
                ],
                'header_live_search_section' => [
                    'title' =>  esc_html__( 'Search', 'blogmatic-pro' )
                ],
                'custom_button_section' => [
                    'title' =>  esc_html__( 'Custom Button', 'blogmatic-pro' )
                ],
                'theme_mode_section' => [
                    'title' =>  esc_html__( 'Theme Mode', 'blogmatic-pro' )
                ],
                'canvas_menu_section' => [
                    'title' =>  esc_html__( 'Off canvas', 'blogmatic-pro' )
                ],
                'header_advertisement_banner_section' => [
                    'title' =>  esc_html__( 'Advertisement Banner', 'blogmatic-pro' )
                ],
                'main_banner_section' => [
                    'title' =>  esc_html__( 'Main Banner', 'blogmatic-pro' ),
                    'priority'  =>  70
                ],
                'carousel_section' => [
                    'title' =>  esc_html__( 'Carousel', 'blogmatic-pro' ),
                    'priority'  =>  70
                ],
                'video_playlist_section' => [
                    'title' =>  esc_html__( 'Video Playlist', 'blogmatic-pro' ),
                    'priority'  =>  70
                ],
                'category_collection_section' => [
                    'title' =>  esc_html__( 'Category collection', 'blogmatic-pro' ),
                    'priority'  =>  70
                ],
                'archive_general_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'General Settings', 'blogmatic-pro' ),
                ],
                'category_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Category Page', 'blogmatic-pro' ),
                ],
                'tag_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Tag Page', 'blogmatic-pro' ),
                ],
                'author_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Author Page', 'blogmatic-pro' ),
                ],
                'pagination_settings_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Pagination Settings', 'blogmatic-pro' ),
                ],
                'blog_single_general_settings' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'General Settings', 'blogmatic-pro' ),
                ],
                'blog_single_elements_settings_section' => [
                    'title' =>  esc_html__( 'Elements Settings', 'blogmatic-pro' ),
                    'panel' =>  'single_section_panel'
                ],
                'blog_single_toc_section' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'Table of Content', 'blogmatic-pro' )
                ],
                'blog_single_related_posts_section' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'Related Posts', 'blogmatic-pro' )
                ],
                'page_settings_section' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( 'Page Settings', 'blogmatic-pro' )
                ],
                'error_page_settings_section' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( '404 Page', 'blogmatic-pro' )
                ],
                'search_page_settings' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( 'Search Page', 'blogmatic-pro' )
                ],
                'page_table_of_content_section' => [
                    'panel' =>  'page_setting_panel',
                    'title' =>  esc_html__( 'Table of content', 'blogmatic-pro' )   
                ],
                'instagram_section' => [
                    'title' =>  esc_html__( 'Instagram Section', 'blogmatic-pro' )
                ],
                'footer_instagram_section' => [
                    'title' =>  esc_html__( 'Instagram Section', 'blogmatic-pro' )
                ],
                'you_may_have_missed_section' => [
                    'title' => esc_html__( 'You May Have Missed', 'blogmatic-pro' )
                ],
                'testing_inner_section' => [
                    'title' => esc_html__( 'Inner Section', 'blogmatic-pro' ),
                    'priority'  =>  29
                ],
                /* Header builder row settings section */
                'header_first_row' => [
                    'title' => esc_html__( 'Header First Row', 'blogmatic-pro' )
                ],
                'header_second_row' => [
                    'title' => esc_html__( 'Header Second Row', 'blogmatic-pro' )
                ],
                'header_third_row' => [
                    'title' => esc_html__( 'Header Third Row', 'blogmatic-pro' )
                ],
                /* Footer builder row settings section */
                'footer_first_row' => [
                    'title' => esc_html__( 'Footer First Row', 'blogmatic-pro' )
                ],
                'footer_second_row' => [
                    'title' => esc_html__( 'Footer Second Row', 'blogmatic-pro' )
                ],
                'footer_third_row' => [
                    'title' => esc_html__( 'Footer Third Row', 'blogmatic-pro' )
                ],
                'footer_logo' => [
                    'title' => esc_html__( 'Footer Logo Settings', 'blogmatic-pro' )
                ],
                'footer_copyright' => [
                    'title' => esc_html__( 'Footer Copyright', 'blogmatic-pro' )
                ],
                'mobile_canvas_section' => [
                    'title' => esc_html__( 'Mobile Canvas', 'blogmatic-pro' )
                ]
            ];
            return ( $id ? $sections_array[ $id ] : $sections_array );
        }

        /**
         * Returns typography array
         * 
         * @since 1.0.0
         */
        public function get_typography( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ];
            $control_array = [
                'site_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Typography', 'blogmatic-pro' ),
                ]),
                'site_description_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Typography', 'blogmatic-pro' ),
                ]),
                'date_time_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogmatic-pro' ),
                ]),
                'main_menu_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Main Menu Typography', 'blogmatic-pro' ),
                ]),
                'main_menu_sub_menu_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Sub Menu Typography', 'blogmatic-pro' ),
                ]),
                'custom_button_text_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typography', 'blogmatic-pro' ),
                ]),
                'main_banner_design_post_title_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'main_banner_design_post_excerpt_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogmatic-pro' ),
                ]),
                'main_banner_design_post_categories_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogmatic-pro' ),
                ]),
                'main_banner_design_post_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogmatic-pro' ),
                ]),
                'main_banner_design_post_author_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogmatic-pro' ),
                ]),
                'carousel_design_post_title_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'carousel_design_post_excerpt_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogmatic-pro' ),
                ]),
                'carousel_design_post_categories_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogmatic-pro' ),
                ]),
                'carousel_design_post_date_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogmatic-pro' ),
                ]),
                'carousel_design_post_author_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogmatic-pro' ),
                ]),
                'video_playlist_active_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Active Title Typo', 'blogmatic-pro' ),
                ]),
                'video_playlist_title_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'video_playlist_video_time_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Video Time Typo', 'blogmatic-pro' ),
                ]),
                'category_collection_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogmatic-pro' ),
                ]),
                'global_button_typo'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                ]),
                'breadcrumb_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogmatic-pro' ),
                ]),
                'archive_title_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'blogmatic-pro' ),
                ]),
                'archive_excerpt_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogmatic-pro' ),
                ]),
                'archive_category_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogmatic-pro' ),
                ]),
                'archive_date_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogmatic-pro' ),
                ]),
                'archive_author_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogmatic-pro' ),
                ]),
                'archive_read_time_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Typo', 'blogmatic-pro' ),
                ]),
                'archive_comment_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Comment Typo', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Title', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_description_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Description Typo', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Title', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_description_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Description Typo', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_title_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Name', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_description_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Description Typo', 'blogmatic-pro' ),
                ]),
                'single_title_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'single_content_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Typo', 'blogmatic-pro' ),
                ]),
                'single_category_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogmatic-pro' ),
                ]),
                'single_date_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogmatic-pro' ),
                ]),
                'single_author_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogmatic-pro' ),
                ]),
                'single_read_time_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Typo', 'blogmatic-pro' ),
                ]),
                'page_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Page Title Typo', 'blogmatic-pro' ),
                ]),
                'page_content_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Page Content Typo', 'blogmatic-pro' ),
                ]),
                'error_page_title_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'error_page_content_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Typo', 'blogmatic-pro' ),
                ]),
                'error_page_button_text_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Text Typo', 'blogmatic-pro' ),
                ]),
                'instagram_button_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button typo', 'blogmatic-pro' ),
                ]),
                'footer_instagram_button_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button typo', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_section_title_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Title Typo', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_post_title_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_post_categories_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_post_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_post_author_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogmatic-pro' ),
                ]),
                'footer_title_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title Typo', 'blogmatic-pro' ),
                ]),
                'footer_text_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'blogmatic-pro' ),
                ]),
                'bottom_footer_text_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'blogmatic-pro' ),
                ]),
                'bottom_footer_link_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Link Typo', 'blogmatic-pro' ),
                ]),
                'heading_one_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 1', 'blogmatic-pro' ),
                ]),
                'heading_two_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 2', 'blogmatic-pro' ),
                ]),
                'heading_three_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 3', 'blogmatic-pro' ),
                ]),
                'heading_four_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 4', 'blogmatic-pro' ),
                ]),
                'heading_five_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 5', 'blogmatic-pro' ),
                ]),
                'heading_six_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 6', 'blogmatic-pro' ),
                ]),
                'sidebar_block_title_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title', 'blogmatic-pro' ),
                ]),
                'sidebar_post_title_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'blogmatic-pro' ),
                ]),
                'sidebar_category_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category', 'blogmatic-pro' ),
                ]),
                'sidebar_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date', 'blogmatic-pro' ),
                ]),
                'sidebar_pagination_button_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pagination typo', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_one_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 1', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_two_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 2', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_three_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 3', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_four_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 4', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_five_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 5', 'blogmatic-pro' ),
                ]),
                'sidebar_heading_six_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 6', 'blogmatic-pro' ),
                ]),
                'footer_menu_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogmatic-pro' ),
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns Box shadow array
         * 
         * @since 1.0.0
         */
        public function get_box_shadow( $id = '' ) {
            $default = [
                'label' => esc_html__( 'Box Shadow', 'blogmatic-pro' ),
                'tab'   =>  'design'
            ];
            $control_array = [
                'header_builder_box_shadow'    =>  $this->get_params( $default, []),
                'header_sub_menu_box_shadow'    =>  $this->get_params( $default, []),
                'header_custom_button_box_shadow'   =>  $this->get_params( $default, []),
                'carousel_image_box_shadow' =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'carousel_box_shadow'   =>  $this->get_params( $default, [
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'carousel_layouts' )->value() == 'two' );
                    }
                ]),
                'video_playlist_box_shadow' =>  $this->get_params( $default, []),
                'category_collection_box_shadow'    =>  $this->get_params( $default, []),
                'website_box_shadow'    =>  $this->get_params( $default, [
                    'tab'   =>  'general',
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'website_layout' )->value() == 'boxed--layout' );
                    }
                ]),
                'global_button_box_shadow_initial'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Initial box shadow', 'blogmatic-pro' ),
                ]),
                'global_button_box_shadow_hover'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover box shadow', 'blogmatic-pro' ),
                ]),
                'breadcrumb_box_shadow' =>  $this->get_params( $default, []),
                'archive_image_box_shadow'  =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'archive_box_shadow'    =>  $this->get_params( $default, []),
                'category_box_shadow'   =>  $this->get_params( $default, []),
                'tag_box_shadow'    =>  $this->get_params( $default, []),
                'author_box_shadow' =>  $this->get_params( $default, []),
                'single_image_box_shadow'   =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'single_page_box_shadow'    =>  $this->get_params( $default, []),
                'page_image_box_shadow' =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'page_box_shadow'   =>  $this->get_params( $default, []),
                'search_box_shadow' =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'you_may_have_missed_image_widgets_box_shadow'  =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'widgets_box_shadow'    =>  $this->get_params( $default, [
                    'tab'   =>  'general'
                ]),
                'sidebar_pagination_button_box_shadow_initial'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Initial box shadow', 'blogmatic-pro' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_pagination_button_box_shadow_hover'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover box shadow', 'blogmatic-pro' ),
                    'tab'   =>  'general'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns checkbox array
         * 
         * @since 1.0.0
         */
        public function get_checkbox( $id = '' ) {
            $default = [
                'type'  =>  'checkbox'
            ];
            $control_array = [
                'blogdescription_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display site description', 'blogmatic-pro' ),
                    'priority'  =>  40
                ]),
                'show_main_banner_excerpt_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show main banner excerpt on mobile', 'blogmatic-pro' ) 
                ]),
                'show_carousel_banner_excerpt_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show carousel banner excerpt on mobile', 'blogmatic-pro' ) 
                ]),
                'show_video_playlist_in_mobile' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show video playlist on mobile', 'blogmatic-pro' ) 
                ]),
                'show_archive_excerpt_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive excerpt on mobile', 'blogmatic-pro' ) 
                ]),
                'show_archive_category_in_mobile'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive category on mobile', 'blogmatic-pro' ) 
                ]),
                'show_archive_date_in_mobile'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive date on mobile', 'blogmatic-pro' ) 
                ]),
                'show_author_meta_text' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author text on mobile', 'blogmatic-pro' ) 
                ]),
                'show_archive_author_mobile_option' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show archive author on mobile', 'blogmatic-pro' ) 
                ]),
                'show_readmore_text_mobile_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show readmore text on mobile', 'blogmatic-pro' ) 
                ]),
                'show_readmore_button_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show readmore button on mobile', 'blogmatic-pro' ) 
                ]),
                'show_readtime_mobile_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show readtime on mobile', 'blogmatic-pro' ) 
                ]),
                'show_comment_number_mobile_option' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show comment number on mobile', 'blogmatic-pro' ) 
                ]),
                'show_left_sidebar_mobile_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show left sidebar on mobile', 'blogmatic-pro' ) 
                ]),
                'show_right_sidebar_mobile_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show right sidebar on mobile', 'blogmatic-pro' ) 
                ]),
                'show_background_animation_on_mobile'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show background animation on mobile', 'blogmatic-pro' ) 
                ]),
                'social_share_mobile_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show social share on mobile', 'blogmatic-pro' ) 
                ]),
                'show_table_of_content_label_on_mobile'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show table of content label on mobile', 'blogmatic-pro' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns toggle array
         * 
         * @since 1.0.0
         */
        public function get_toggle( $id = '' ) {
            $default = [
                'transport' =>  'refresh'
            ];
            $control_array = [
                'main_banner_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show main banner', 'blogmatic-pro' ),
                ]),
                'carousel_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show carousel', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'video_playlist_option' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show video playlist', 'blogmatic-pro' ),
                ]),
                'category_collection_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable category collection', 'blogmatic-pro' ),
                ]),
                'site_schema_ready' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Make website schema ready', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'disable_admin_notices'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Disabled the theme admin notices', 'blogmatic-pro' ),
                    'description'	      => esc_html__( 'This will hide all the notices or any message shown by the theme like review notices, change log notices', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'preloader_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable site preloader', 'blogmatic-pro' )
                ]),
                'aos_animation_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable AOS Animation', 'blogmatic-pro' ),
                ]),
                'social_share_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Social Share', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show category info box', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show tag info box', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author info box', 'blogmatic-pro' ),
                ]),
                'toc_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable table of content', 'blogmatic-pro' ),
                ]),         
                'single_post_related_posts_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show related articles', 'blogmatic-pro' ),
                ]),       
                'you_may_have_missed_section_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable you may have missed section', 'blogmatic-pro' ),
                ]),
                'page_toc_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable table of content', 'blogmatic-pro' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns simple toggle array
         * 
         * @since 1.0.0
         */
        public function get_simeple_toggle( $id = '' ) {
            $default = [
                'transport' =>  'refresh'
            ];
            $control_array = [
                'instagram_enable_slider_in_header'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable slider', 'blogmatic-pro' )
                ]),
                'footer_instagram_enable_slider_in_footer'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable slider', 'blogmatic-pro' )
                ]),
                'social_icons_hover_animation' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show social icons hover animation', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_social_icons_hover_animation' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show social icons hover animation', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'header_buiilder_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Section Sticky', 'blogmatic-pro' )
                ]),
                'header_first_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 1st row', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_second_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 2nd row', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_third_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 3rd row', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_sticky_on_scroll_up' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky on Scroll Up', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    }
                ]),
                'header_sticky_on_scroll_down' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky on Scroll Down', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    }
                ]),
                'menu_cutoff_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable menu cutoff', 'blogmatic-pro' ),
                    'tab'   => 'general',
                ]),
                'search_post_image_show_hide' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post Image', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    }
                ]),
                'search_post_date_show_hide' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post Date', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    }
                ]),
                'theme_mode_set_dark_mode_as_default' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Set Dark Mode as Default', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]), 
                'main_banner_show_social_icon' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show social share', 'blogmatic-pro' ),
                ]),
                'main_banner_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_title' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Title', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_categories' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Categories', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_date' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Date', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_author' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Author', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_author_image' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Author Image', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_show_excerpt' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Excerpt', 'blogmatic-pro' ),
                ]),
                'main_banner_show_arrows' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show Arrows', 'blogmatic-pro' ),
                ]),
                'main_banner_show_fade' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show Fade', 'blogmatic-pro' ),
                ]),
                'main_banner_slider_infinite_loop' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Infinite Loop', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Repeats the slide items', 'blogmatic-pro' ),
                ]),
                'main_banner_slider_autoplay' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Autoplay', 'blogmatic-pro' ),
                ]),
                'main_banner_show_arrow_on_hover' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show arrow on hover', 'blogmatic-pro' ),
                    'transport' =>  'postMessage',
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_setting( 'main_banner_show_arrows' )->value();
                    }
                ]),
                'carousel_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_title' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Title', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_categories' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Categories', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_date' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Date', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_author' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Author', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_author_image' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Author Image', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_show_excerpt' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Excerpt', 'blogmatic-pro' ),
                ]),
                'carousel_show_arrows' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show Arrows', 'blogmatic-pro' ),
                ]),
                'carousel_slider_infinite_loop' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Infinite Loop', 'blogmatic-pro' ),
                ]),
                'carousel_slider_autoplay' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Autoplay', 'blogmatic-pro' ),
                ]),
                'carousel_show_arrow_on_hover' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show arrow on hover', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'video_playlist_slider_arrow' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Arrow', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    }
                ]),
                'video_playlist_slider_show_arrow_on_hover' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show arrow on hover', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' && $control->manager->get_setting( 'video_playlist_slider_arrow' )->value() );
                    }
                ]),
                'video_playlist_slider_infinite' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Infinite Loop', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    }
                ]),
                'video_playlist_slider_autoplay' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Enable Autoplay', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    }
                ]),
                'category_collection_show_count' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show category count', 'blogmatic-pro' ),
                ]),
                'category_collection_hide_empty' => $this->get_params( $default, [
                    'label' => esc_html__( 'Hide empty category', 'blogmatic-pro' ),
                ]),
                'category_collection_slider_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable slider', 'blogmatic-pro' ),
                ]),
                'category_collection_slider_arrow' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show arrows', 'blogmatic-pro' ),
                ]),
                'category_collection_autoplay_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable autoplay', 'blogmatic-pro' ),
                ]),
                'category_collection_slider_infinite' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable infinite', 'blogmatic-pro' ),
                ]),
                'social_icon_official_color_inherit' => $this->get_params( $default, [
                    'label' => esc_html__( 'Inherit official color', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'footer_social_icon_official_color_inherit' => $this->get_params( $default, [
                    'label' => esc_html__( 'Inherit official color', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'site_breadcrumb_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show breadcrumb trails', 'blogmatic-pro' ),
                ]),
                'sidebar_sticky_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Sidebar Sticky', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'social_share_icon_color_type' => $this->get_params( $default, [
                    'label' => esc_html__( 'Inherit official color', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'archive_show_social_share' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show social share', 'blogmatic-pro' ),
                ]),
                'archive_title_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post title', 'blogmatic-pro' ),
                ]),
                'archive_excerpt_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post excerpt', 'blogmatic-pro' ),
                ]),
                'archive_category_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post category', 'blogmatic-pro' ),
                ]),
                'archive_date_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post date', 'blogmatic-pro' ),
                ]),
                'archive_read_time_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post read time', 'blogmatic-pro' ),
                ]),
                'archive_comments_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show comments number', 'blogmatic-pro' ),
                ]),
                'archive_author_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author', 'blogmatic-pro' ),
                ]),
                'archive_author_image_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author image', 'blogmatic-pro' ),
                ]),
                'archive_button_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show button', 'blogmatic-pro' ),
                ]),
                'archive_hide_image_placeholder' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide image placeholder', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_icon_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show category icon', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show category title', 'blogmatic-pro' ),
                ]),
                'archive_category_info_box_description_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show category description', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_icon_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show tag icon', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show tag title', 'blogmatic-pro' ),
                ]),
                'archive_tag_info_box_description_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show tag description', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_image_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author image', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author title', 'blogmatic-pro' ),
                ]),
                'archive_author_info_box_description_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author description', 'blogmatic-pro' ),
                ]),
                'single_author_box_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author box', 'blogmatic-pro' ),
                ]),
                'single_author_box_image_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author image', 'blogmatic-pro' ),
                ]),
                'single_author_info_box_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author title', 'blogmatic-pro' ),
                ]),
                'single_author_info_box_description_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show author description', 'blogmatic-pro' ),
                ]),
                'single_post_navigation_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Post Navigation', 'blogmatic-pro' ),
                ]),
                'single_post_navigation_thumbnail_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post thumbnail', 'blogmatic-pro' ),
                ]),
                'single_post_navigation_show_date' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Date', 'blogmatic-pro' ),
                ]),
                'single_title_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post title', 'blogmatic-pro' ),
                ]),
                'single_thumbnail_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post thumbnail', 'blogmatic-pro' ),
                ]),
                'single_category_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post category', 'blogmatic-pro' ),
                ]),
                'single_date_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post date', 'blogmatic-pro' ),
                ]),
                'single_read_time_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post read time', 'blogmatic-pro' ),
                ]),
                'single_comments_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show comments number', 'blogmatic-pro' ),
                ]),
                'single_author_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author', 'blogmatic-pro' ),
                ]),
                'single_author_image_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author image', 'blogmatic-pro' ),
                ]),
                'single_gallery_lightbox_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show lightbox', 'blogmatic-pro' ),
                ]),
                'toc_enable_accordion' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable accordion', 'blogmatic-pro' ),
                ]),
                'toc_default_toggle' => $this->get_params( $default, [
                    'label' => esc_html__( 'Default toggle open', 'blogmatic-pro' ),
                ]),
                'related_posts_author_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author', 'blogmatic-pro' ),
                ]),
                'related_posts_date_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show date', 'blogmatic-pro' ),
                ]),
                'related_posts_comment_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show comments', 'blogmatic-pro' ),
                ]),
                'page_title_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show page title', 'blogmatic-pro' ),
                ]),
                'page_thumbnail_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show page thumbnail', 'blogmatic-pro' ),
                ]),
                'page_content_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show post content', 'blogmatic-pro' ),
                ]),
                'page_toc_enable_accordion' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable accordion', 'blogmatic-pro' ),
                ]),
                'page_toc_default_toggle' => $this->get_params( $default, [
                    'label' => esc_html__( 'Default toggle open', 'blogmatic-pro' ),
                ]),
                'error_page_button_show_hide' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show 404 button', 'blogmatic-pro' ),
                ]),
                'search_page_form_show_hide' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show search form', 'blogmatic-pro' ),
                ]),
                'instagram_url_image_link' => $this->get_params( $default, [
                    'label' => esc_html__( 'Link url with image', 'blogmatic-pro' ),
                ]),
                'footer_instagram_url_image_link' => $this->get_params( $default, [
                    'label' => esc_html__( 'Link url with image', 'blogmatic-pro' ),
                ]),
                'instagram_enable_lightbox' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable lightbox', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return ! $control->manager->get_setting( 'instagram_url_image_link' )->value();
                    }
                ]),
                'footer_instagram_enable_lightbox' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable lightbox', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ){
                        return ! $control->manager->get_setting( 'footer_instagram_url_image_link' )->value();
                    }
                ]),
                'show_instagram_button' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show instagram button', 'blogmatic-pro' ),
                ]),
                'footer_show_instagram_button' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show instagram button', 'blogmatic-pro' ),
                ]),
                'instagram_caption' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show image caption', 'blogmatic-pro' ),
                ]),
                'footer_instagram_caption' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show image caption', 'blogmatic-pro' ),
                ]),
                'instagram_slider_arrow' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show arrows', 'blogmatic-pro' ),
                ]),
                'footer_instagram_slider_arrow' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show arrows', 'blogmatic-pro' ),
                ]),
                'instagram_autoplay_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable autoplay', 'blogmatic-pro' ),
                ]),
                'footer_instagram_autoplay_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable autoplay', 'blogmatic-pro' ),
                ]),
                'instagram_slider_infinite' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable infinite', 'blogmatic-pro' ),
                ]),
                'footer_instagram_slider_infinite' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable infinite', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show section title', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'you_may_have_missed_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_elements_show_title' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Title', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_elements_show_categories' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Categories', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_elements_show_date' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Date', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_elements_show_author' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show Author', 'blogmatic-pro' ),
                ]),
                'header_ads_banner_image_link_url' => $this->get_params( $default, [
                    'label' => esc_html__( 'Link Url', 'blogmatic-pro' ),
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_simple_toggle() Method

        /**
         * Get all section tab control
         * 
         * @since 1.0.0
         */
        public function get_section_tab( $id = '' ) {
            $default = [
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                    ]
                ],
                'priority'  =>  1
            ];
            $control_array = [
                'header_builder_section_tab'    =>  $this->get_params( $default, []),
                'site_title_section_tab'    =>  $this->get_params( $default, []),
                'menu_options_section_tab' =>  $this->get_params( $default, []),
                'search_section_tab'    =>  $this->get_params( $default, []),
                'custom_button_section_tab'  =>  $this->get_params( $default, []),
                'theme_mode_section_tab' =>  $this->get_params( $default, []),
                'canvas_menu_setting'   =>  $this->get_params( $default, []),
                'category_collection_section_heading'   =>  $this->get_params( $default, []),
                'breadcrumb_section_tab'    =>  $this->get_params( $default, []),
                'stt_section_tab'   =>  $this->get_params( $default, []),
                'archive_section_heading'   =>  $this->get_params( $default, []),
                'category_archive_section_heading'  =>  $this->get_params( $default, []),
                'tag_archive_section_heading'   =>  $this->get_params( $default, []),
                'author_archive_section_heading'    =>  $this->get_params( $default, []),
                'single_section_heading'    => $this->get_params( $default, []),
                'page_settings_section_tab' =>  $this->get_params( $default, []),
                'error_page_section_tab'   =>  $this->get_params( $default, []),
                'instagram_section_tab' =>  $this->get_params( $default, []),
                'footer_instagram_section_tab' =>  $this->get_params( $default, []),
                'you_may_have_missed_section_tab'   =>  $this->get_params( $default, []),
                'footer_section_tab'    =>  $this->get_params( $default, []),
                'bottom_footer_section_tab' =>  $this->get_params( $default, []),
                'social_icons_section_heading' => $this->get_params( $default, []),
                'footer_social_icons_section_heading' => $this->get_params( $default, []),
                'main_banner_section_heading'  =>  $this->get_params( $default, []),
                'carousel_section_heading' =>  $this->get_params( $default, []),
                'video_playlist_section_heading'   =>  $this->get_params( $default, []),
                /* Header builder row controls */
                'header_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'header_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'header_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                /* Footer builder row controls */
                'footer_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'footer_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'footer_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogmatic-pro' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'mobile_canvas_section_tab'   =>  $this->get_params( $default, [] ),
                'footer_menu_section_tab'   =>  $this->get_params( $default, [] )
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_tab() Method

        /**
         * Get all spacing controls
         * 
         * @since 1.0.0
         */
        public function get_spacing( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Padding ( px )', 'blogmatic-pro' ),
                'tab'   =>  'design',
                'input_attrs' => $this->get_input_attrs([
                    'max'   => 50
                ])
            ];

            $control_array = [
                'custom_button_padding' =>  $this->get_params( $default, []),
                'carousel_image_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius ( Px )', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'general'
                ]),
                'global_button_padding'    =>  $this->get_params( $default, []),
                'archive_image_border_radius'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius ( Px )', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'general'
                ]),
                'instagram_padding'    =>  $this->get_params( $default, []),
                'footer_instagram_padding'    =>  $this->get_params( $default, []),
                'you_may_have_missed_image_border_radius'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_pagination_button_padding'    =>  $this->get_params( $default, []),
                'header_builder_margin'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Margin', 'blogmatic-pro' ),
                ]),
                'footer_builder_margin'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Margin', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                /* Header row paddings */
                'header_first_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design' 
                ]),
                'header_second_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'header_third_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                /* Footer row paddings */
                'footer_first_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design' 
                ]),
                'footer_second_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'footer_third_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'date_time_padding' => $this->get_params( $default, [
                   'label'  =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                ]),
                'mobile_canvas_padding' => $this->get_params( $default, [
                   'label'  =>  esc_html__( 'Padding', 'blogmatic-pro' ),
                   'tab'    =>  'design'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_spacing() Method

        /**
         * Get all radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_radio_tab( $id = '' ) {
            $default = [
                'label' => esc_html__( 'Elements Alignment', 'blogmatic-pro' ),
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'blogmatic-pro' )
                    ]
                ]
            ];
            $control_array = [
                'main_banner_post_elements_alignment'  =>  $this->get_params( $default, []),
                'carousel_post_elements_alignment' =>  $this->get_params( $default, []),
                'site_date_to_show'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Date to display', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Whether to show date published or modified date.', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'published',
                            'label' => esc_html__('Published date', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'modified',
                            'label' => esc_html__('Modified date', 'blogmatic-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'refresh'
                ]),
                'aos_animation_reset_on_scroll'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Display AOS animation', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'once',
                            'label' => esc_html__('Once', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'always',
                            'label' => esc_html__('Always', 'blogmatic-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'aos_animation_option' )->value() );
                    },
                    'double_line'   =>  true,
                    'transport' =>  'refresh'
                ]),
                'stt_alignment'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Button Align', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'stt_display_type' )->value() === 'fixed' );
                    },
                ]),
                'stt_display_type'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Display Type', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'inline',
                            'label' => esc_html__('Inline', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'fixed',
                            'label' => esc_html__('Fixed', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'social_share_display_type'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Display type', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'inline',
                            'label' => esc_html__('Inline', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'fixed',
                            'label' => esc_html__('Fixed', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'social_share_position'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Social share position', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Effect is seen in single only', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'left',
                            'icon'  =>  'editor-alignleft',
                            'label' =>  esc_html__( 'Left', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'right',
                            'icon'  =>  'editor-alignright',
                            'label' =>  esc_html__( 'Right', 'blogmatic-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'social_share_display_type' )->value() == 'fixed' );
                    },
                ]),
                'archive_post_elements_alignment'  =>  $this->get_params( $default, []),
                'single_post_content_alignment'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post content alignment', 'blogmatic-pro' ),
                ]),
                'toc_hierarchical' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Table of content view', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'tree',
                            'label' => esc_html__( 'Tree view', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'flat',
                            'label' => esc_html__( 'Flat view', 'blogmatic-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'refresh'
                ]),
                'toc_display_type' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Display type', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'inline',
                            'label' => esc_html__('Inline', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'fixed',
                            'label' => esc_html__('Fixed', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'page_toc_hierarchical'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Table view', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'tree',
                            'label' => esc_html__( 'Tree view', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'flat',
                            'label' => esc_html__( 'Flat view', 'blogmatic-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'refresh'
                ]),
                'page_toc_display_type'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Display type', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'value' => 'inline',
                            'label' => esc_html__('Inline', 'blogmatic-pro' )
                        ],
                        [
                            'value' => 'fixed',
                            'label' => esc_html__('Fixed', 'blogmatic-pro' )
                        ]
                    ],
                ]),
                'you_may_have_missed_post_elements_alignment'  =>  $this->get_params( $default, []),
                'custom_button_target'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ]
                ]),
                'header_ads_banner_image_target_attr' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value() );
                    }
                ]),
                'instagram_link_target'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'instagram_url_image_link' )->value() );
                    }
                ]),
                'footer_instagram_link_target'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'footer_instagram_url_image_link' )->value() );
                    }
                ]),
                'social_icons_target' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   => [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ]
                ]),
                'footer_social_icons_target' =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Open in', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   => [
                        [
                            'value' =>  '_blank',
                            'label' =>  esc_html__( 'New tab', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  '_self',
                            'label' =>  esc_html__( 'Same tab', 'blog-style-pro' )
                        ]
                    ]
                ]),
                'custom_button_icon_prefix_suffix'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blog-style-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'prefix',
                            'label' =>  esc_html__( 'Before', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'suffix',
                            'label' =>  esc_html__( 'After', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                'canvas_menu_position'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Canvas Position', 'blog-style-pro' ),
                    'choices'   =>  [
                        [
                            'value' => 'left',
                            'icon'  =>  'editor-alignleft'
                        ],
                        [
                            'value' => 'right',
                            'icon'  =>  'editor-alignright'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                'video_playlist_display_position' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display Position', 'blog-style-pro' ),
                    'double_line'   =>  true,
                    'choices'   =>  [
                        [
                            'value' => 'above-archive',
                            'label'  =>  esc_html__( 'Above archive', 'blog-style-pro' )
                        ],
                        [
                            'value' => 'below-archive',
                            'label'  =>  esc_html__( 'Below archive', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'refresh'
                ]),
                'archive_pagination_button_icon_context'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'prefix',
                            'label' =>  esc_html__( 'Before', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'suffix',
                            'label' =>  esc_html__( 'After', 'blog-style-pro' )
                        ]
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                    'transport' =>  'postMessage'
                ]),
                'error_page_button_icon_context'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'prefix',
                            'label' =>  esc_html__( 'Before', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'suffix',
                            'label' =>  esc_html__( 'After', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                /* Footer Builder 1st row */
                'footer_first_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Row Direction', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_first_row_vertical_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Vertical alignment', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'top',
                            'label' =>  esc_html__( 'Top', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'center',
                            'label' =>  esc_html__( 'Center', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'bottom',
                            'label' =>  esc_html__( 'Bottom', 'blog-style-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'postMessage'
                ]),
                /* Footer Builder 2nd row */
                'footer_second_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_second_row_vertical_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'top',
                            'label' =>  esc_html__( 'Top', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'center',
                            'label' =>  esc_html__( 'Center', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'bottom',
                            'label' =>  esc_html__( 'Bottom', 'blog-style-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'postMessage'
                ]),
                /* Footer Builder 3rd row */
                'footer_third_row_row_direction'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                   'choices'   =>  [
                        [
                            'value' =>  'vertical',
                            'label' =>  esc_html__( 'Vertical', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'horizontal',
                            'label' =>  esc_html__( 'Horizontal', 'blog-style-pro' )
                        ]
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_third_row_vertical_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Context', 'blogmatic-pro' ),
                    'choices'   =>  [
                        [
                            'value' =>  'top',
                            'label' =>  esc_html__( 'Top', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'center',
                            'label' =>  esc_html__( 'Center', 'blog-style-pro' )
                        ],
                        [
                            'value' =>  'bottom',
                            'label' =>  esc_html__( 'Bottom', 'blog-style-pro' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'postMessage'
                ]),
                'mobile_canvas_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Alignment', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_tab() Method

        /**
         * Get all info box control
         * 
         * @since 1.0.0
         */
        public function get_info_box( $id = '' ) {
            $control_array = [
                'site_documentation_info' =>  [
                    'label' => esc_html__( 'Theme Documentation', 'blogmatic-pro' ),
                    'description' => esc_html__( 'We have well prepared documentation which includes overall instructions and recommendations that are required in this theme.', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'View Documentation', 'blogmatic-pro' ),
                            'url'   => esc_url( '//doc.blazethemes.com/blogmatic' )
                        ]
                    ]
                ],
                'site_support_info'   =>  [
                    'label' => esc_html__( 'Theme Support', 'blogmatic-pro' ),
                    'description' => esc_html__( 'We provide 24/7 support regarding any theme issue. Our support team will help you to solve any kind of issue. Feel free to contact us.', 'blogmatic-pro' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'Support Form', 'blogmatic-pro' ),
                            'url'   => esc_url( '//blazethemes.com/support' )
                        ]
                    ]
                ],
                'reset_setting_option'    =>  [
                    'label' => esc_html__( 'Restore Theme Default', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Do all the settings seem to be off for you? Do you wish to return to the themes beginning? Once completed, you wont be able to retrieve your prior customizer settings.', 'blogmatic-pro' ),
                    'type'        => 'info-box-action',
                    'choices' => [
                        [
                            'label' => esc_html__( 'Reset Customizer Setting', 'blogmatic-pro' ),
                            'action' => 'blogmatic_customizer_reset_to_default'
                        ]
                    ]
                ],
                'import_setting_info' =>  [
                    'label' => esc_html__( 'Import Free theme setttings', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Switching from blogmatic free? You never have to start from 0. Click below button to import all the settings you have saved while using free theme.', 'blogmatic-pro' ),
                    'type'        => 'info-box-action',
                    'choices' => [
                        [
                            'label' => esc_html__( 'Import Setting', 'blogmatic-pro' ),
                            'action' => 'blogmatic_import_custmomizer_setting'
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_info_box() Method

        /**
         * Get all section heading toggle controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'header_menu_cutoff_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Menu Cutoff Setting', 'blogmatic-pro' ),
                ]),
                'main_banner_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogmatic-pro' ),
                ]),
                'main_banner_post_elements_settings_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogmatic-pro' ),
                ]),
                'main_banner_slider_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                    'initial'   => false,
                ]),
                'main_banner_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogmatic-pro' ),
                    'initial'   =>  false,
                ]),
                'main_banner_design_typography'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'carousel_post_query_settings_heading'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogmatic-pro' ),
                ]),
                'carousel_post_elements_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogmatic-pro' ),
                ]),
                'carousel_slider_settings_heading'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                ]),
                'carousel_image_setting_heading'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'carousel_design_typography'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'video_playlist_general_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogmatic-pro' ),
                ]),
                'video_playlist_slider_settings_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    },
                ]),               
                'video_playlist_typography_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'video_playlist_color_settings_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                ]),
                'video_playlist_slider_settings_heading_design_tab'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    }
                ]),
                'category_collection_query_section_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Query Settings', 'blogmatic-pro' ),
                ]),
                'category_collection_slider_section_heading_toggle'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                ]),
                'category_collection_image_heading_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'archive_layouts_settings_header' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Layouts Settings', 'blogmatic-pro' ),
                ]),
                'archive_elements_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Elements Settings', 'blogmatic-pro' ),
                ]),
                'archive_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'archive_typography_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   => 'design'
                ]),
                'archive_background_settings_header'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                ]),
                'single_general_settings_header'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogmatic-pro' ),
                ]),
                'single_author_box_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Author Box', 'blogmatic-pro' ),
                ]),
                'single_post_navigation_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Navigation', 'blogmatic-pro' ),
                ]),
                'single_image_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'single_typography_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   => 'design',
                ]),
                'single_color_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   => 'design',
                ]),   
                'page_image_setting_heading'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogmatic-pro' ),
                    'initial'   =>  false,
                ]),
                'page_table_of_content_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Table of content', 'blogmatic-pro' ),
                ]),
                'page_typography_section_heading_toggle'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'page_color_settings_section_heading_toggle'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'instagram_section_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogmatic-pro' ),
                ]),
                'footer_instagram_section_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogmatic-pro' ),
                ]),
                'instagram_slider_section_heading_toggle' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                ]),
                'footer_instagram_slider_section_heading_toggle' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Slider Settings', 'blogmatic-pro' ),
                ]),
                'instagram_image_heading_section_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'footer_instagram_image_heading_section_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_elements_settings_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_design_typography'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                ]),
                'you_may_have_missed_design_color_settings'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color settings', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'theme_footer_typography' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                ]),
                'theme_footer_color_settings' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'bottom_footer_typography'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'bottom_footer_color_settings'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                ]),
                'widget_styles_general_settings_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogmatic-pro' ),
                ]),
                'widget_styles_background_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Color Settings', 'blogmatic-pro' ),
                ]),
                'widget_styles_sidebar_settings_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Sidebar Typography', 'blogmatic-pro' ),
                ]),
                'widget_styles_headings_settings_header'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Heading Typography', 'blogmatic-pro' ),
                ]),
                'widget_styles_pagination_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Pagination Settings', 'blogmatic-pro' ),
                ]),
                'logo_and_icon_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Logo & Site Icon', 'blogmatic-pro' ),
                    'priority'  =>  5
                ]),
                'site_title_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Site Title & Tagline', 'blogmatic-pro' ),
                    'priority'  =>  20
                ]),
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                foreach( $totalCats as $singleCat ) :
                    $cat_id = 'category_' . absint( $singleCat->term_id ) . '_color_heading';
                    $control_array[ $cat_id ] = [
                        'label' => esc_html( $singleCat->name ),
                    ];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                foreach( $totalTags as $singleTag ) :
                    $tag_id = 'tag_' . absint( $singleTag->term_id ) . '_color_heading';
                    $control_array += [ $tag_id =>  [
                        'label' => esc_html( $singleTag->name ),
                    ]];
                    $tag_priority += 10;
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading_toggle() Method

        /**
         * Get all item sortable control
         * 
         * @since 1.0.0
         */
        public function get_item_sortable( $id = '' ) {
            $default = [ 'transport' =>  'refresh' ];
            
            $control_array = [];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_item_sortable() Method


        /**
         * Get all number controls
         * 
         * @since 1.0.0
         */
        public function get_number( $id = '' ) {
            $default = [
                'unit'  =>  'px',
                'input_attrs'   =>  $this->get_input_attrs(),
                'responsive'    =>  true
            ];
            $control_array = [
                'social_icons_font_size'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Font Size', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 50,
                        'min'         => 1
                    ]),
                    'responsive'    =>  true,
                    'transport' =>  'postMessage'
                ]),
                'footer_social_icons_font_size'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Font Size', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 50,
                        'min'         => 1
                    ]),
                    'responsive'    =>  true,
                    'transport' =>  'postMessage'
                ]),
                'site_logo_width'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400,
                        'min'   =>  100
                    ])
                ]),
                'search_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'header_custom_button_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'tab'   =>  'design'
                ]),
                'custom_button_icon_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'theme_mode_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]), 
                'canvas_menu_width' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Canvas Width (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400,
                    ])
                ]),
                'main_banner_design_post_date_icon_size'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Date Icon Size', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'main_banner_design_slider_icon_size'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Icon Size (px)', 'blogmatic-pro' ),
                    'tab'   =>  'general',
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_setting( 'main_banner_show_arrows' )->value();
                    }
                ]),
                'main_banner_responsive_image_ratio'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'carousel_design_post_date_icon_size'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Date Icon Size', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'carousel_design_slider_icon_size'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Icon Size (px)', 'blogmatic-pro' ),
                    'tab'   =>  'general',
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'carousel_responsive_image_ratio'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'carousel_section_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'design',
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'carousel_layouts' )->value() == 'two' );
                    },
                    'responsive'    =>  false
                ]),
                'video_playlist_icon_size'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Play / Pause Icon Size', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'category_collection_number_of_columns' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'No. of columns', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  5,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'category_collection_layout' )->value() == 'one' );
                    }
                ]),
                'website_layout_horizontal_gap' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Horizontal Gap', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'responsive'    =>  true,
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    }
                ]),
                'website_layout_vertical_gap'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Vertical Gap', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    }
                ]),
                'global_button_font_size'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Icon Size (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([])
                ]),
                'archive_post_column'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'No. of columns', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 4,
                        'min'   => 1
                    ])
                ]),
                'archive_responsive_image_ratio'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'single_article_width'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content width ( % )', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'single_responsive_image_ratio' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'page_responsive_image_ratio'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'error_page_button_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]), 
                'instagram_no_of_columns'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Number of columns', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  10,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'instagram_layout' )->value() == 'one' );
                    }
                ]),
                'footer_instagram_no_of_columns'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Number of columns', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  10,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'footer_instagram_layout' )->value() == 'one' );
                    }
                ]),
                'instagram_gap' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Item gap', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'tab'   =>  'design'
                ]),
                'footer_instagram_gap' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Item gap', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'tab'   =>  'design'
                ]),
                'you_may_have_missed_responsive_image_ratio'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ])
                ]),
                'bottom_footer_logo_width'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400
                    ])
                ]),
                'instagram_image_ratio' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ]),
                    'responsive'    =>  true
                ]),
                'footer_instagram_image_ratio' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image ratio', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ]),
                    'responsive'    =>  true
                ]),
                'instagram_image_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image radius', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([]),
                    'responsive'    =>  true
                ]),
                'footer_instagram_image_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image radius', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([]),
                    'responsive'    =>  true
                ]),
                'category_collection_image_ratio'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image ratio', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  2,
                        'step'  =>  0.1
                    ]),
                    'responsive'    =>  true
                ]),
                'category_collection_image_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image radius', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([]),
                    'responsive'    =>  true
                ]),
                /* Header Builder row controls */
                'header_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                /* Footer Builder row controls */
                'footer_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'main_banner_text_width'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Width (%)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'main_banner_layouts' )->value() == 'one' );
                    },
                    'transport' =>  'postMessage'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_number() Method

        /**
         * Get all section heading controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading( $id = '' ) {

            $control_array = [
                'header_sub_menu_header'    =>  [
                    'label' => esc_html__( 'Sub Menu', 'blogmatic-pro' ),
                    'tab'   => 'design',
                ],
                'header_main_menu_header'    =>  [
                    'label' => esc_html__( 'Main Menu', 'blogmatic-pro' ),
                    'tab'   => 'design',
                ],
                'typography_preset_header'    =>  [
                    'label' => esc_html__( 'Typography Preset', 'blogmatic-pro' ),
                ],
                'heading_typographies'    =>  [
                    'label' => esc_html__( 'Headings', 'blogmatic-pro' ),
                ],
                'disable_admin_notices_heading' =>  [
                    'label' => esc_html__( 'Admin Settings', 'blogmatic-pro' ),
                ],
                'website_layout_header' =>  [
                    'label' => esc_html__( 'Website Layout', 'blogmatic-pro' ),
                ],
                'website_layout_container_setting_heading'  =>  [
                    'label' => esc_html__( 'Container Setting', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    },
                ],
                'block_title_section_heading'  =>  [
                    'label' => esc_html__( 'Block Title', 'blogmatic-pro' )
                ],
                'aos_site_animation_heading'    =>  [
                    'label' => esc_html__( 'Site Animation', 'blogmatic-pro' ),
                ],
                'site_hover_animation'  =>  [
                    'label' => esc_html__( 'Hover Animation', 'blogmatic-pro' ),
                ],
                'social_icons_settings_header'  =>  [
                    'label' => esc_html__( 'Social Icons Settings', 'blogmatic-pro' ),
                ],
                'footer_social_icons_settings_header'  =>  [
                    'label' => esc_html__( 'Social Icons Settings', 'blogmatic-pro' ),
                ],
                'category_info_elements_settings_heading'   =>  [
                    'label' => esc_html__( 'Elements Setting', 'blogmatic-pro' ),
                ],
                'archive_category_info_box_typography_heading'   =>  [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ],
                'tag_info_elements_settings_heading'    =>  [
                    'label' => esc_html__( 'Elements Setting', 'blogmatic-pro' ),
                ],
                'archive_tag_info_box_typography_heading'   =>  [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ],
                'author_info_elements_settings_heading' =>  [
                    'label' => esc_html__( 'Elements Setting', 'blogmatic-pro' ),
                ],
                'archive_author_info_box_typography_heading'   =>  [
                    'label' => esc_html__( 'Typography', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ],
                'pagination_button_heading' =>  [
                    'label' => esc_html__( 'Button Settings', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    }
               ],
                'single_post_author_heading'    =>  [
                    'label' => esc_html__( 'Post Author', 'blogmatic-pro' ),
                ],
                'instagram_section_header'  =>  [
                    'label' =>  esc_html__( 'Settings', 'blogmatic-pro' ),
                ],
                'footer_instagram_section_header'  =>  [
                    'label' =>  esc_html__( 'Settings', 'blogmatic-pro' ),
                ],
                'site_background_animation_settings_heading'   =>  [
                    'label' => esc_html__( 'Animation Settings', 'blogmatic-pro' ),
                ],
                'theme_colors_section_heading'   =>  [
                    'label' => esc_html__( 'Theme Colors', 'blogmatic-pro' ),
                ],
                'theme_presets_section_heading'   =>  [
                    'label' => esc_html__( 'Presets', 'blogmatic-pro' ),
                ],
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading() Method

        /**
         * Get all redirect controls
         * 
         * @since 1.0.0
         */
        public function get_redirect_control( $id = '' ) {

            $control_array = [
                'canvas_menu_redirects' =>  [
                    'label' => esc_html__( 'Widgets', 'blogmatic-pro' ),
                    'tab'   => 'general',
                    'choices'     => [
                        'canvas-menu-sidebar' => [
                            'type'  => 'section',
                            'id'    => 'sidebar-widgets-canvas-menu-sidebar',
                            'label' => esc_html__( 'Manage canvas menu widget', 'blogmatic-pro' )
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_redirect_control() Method

        /**
         * Get all radio image controls
         * 
         * @since 1.0.0
         */
        public function get_radio_image( $id = '' ) {
            $theme_directory = get_template_directory_uri();
            $control_array = [
                'main_banner_layouts' =>  [
                    'label' => esc_html__( 'Banner Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/banner-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/banner-two.png'
                        ],
                        'three' => [
                            'label' => esc_html__( 'Layout 3', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/banner-three.png'
                        ]
                    ],
                    'transport' =>  'refresh'
                ],
                'carousel_layouts'    =>  [
                    'label' => esc_html__( 'Carousel Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Header 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/carousel-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Header 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/carousel-two.png'
                        ]
                    ]
                ],
                'video_playlist_layouts'  =>  [
                    'label' =>  esc_html__( 'Video Playlist Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/video-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/video-two.png'
                        ]
                    ],
                    'transport' =>  'refresh'
                ],
                'category_collection_layout'  =>  [
                    'label' =>  esc_html__( 'Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/category-collection-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/category-collection-two.png'
                        ]
                    ]
                ],
                'website_layout'  =>  [
                    'choices'  => [
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ],
                    // 'custom_callback'   =>  [
                    //     'boxed--layout' =>  [ 'website_layout_container_setting_heading', 'website_layout_background_color', 'website_box_shadow', 'website_layout_horizontal_gap', 'website_layout_vertical_gap' ]
                    // ]    
                ],
                'block_title_layout'  =>  [
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_two.png'
                        ],
                        'three' => [
                            'label' => esc_html__( 'Layout 3', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_three.png'
                        ],
                        'four' => [
                            'label' => esc_html__( 'Layout 4', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_four.png'
                        ],
                        'five' => [
                            'label' => esc_html__( 'Layout 5', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/block_title_five.png'
                        ],
                    ],
                ],
                'archive_post_layout' =>  [
                   'label' =>  esc_html__( 'Archive Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'grid' => [
                           'label' => esc_html__( 'Grid', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-grid.png'
                       ],
                       'list' => [
                           'label' => esc_html__( 'List', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-list.png'
                       ],
                       'block' => [
                           'label' => esc_html__( 'Block', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-block.png'
                       ],
                       'masonry' => [
                           'label' => esc_html__( 'Masonry', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-masonry.png'
                       ],
                       'mixed' => [
                           'label' => esc_html__( 'Mixed', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-alter.png'
                       ],
                       'list-two' => [
                           'label' => esc_html__( 'List 2', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-list-two.png'
                       ],
                       'list-alter' => [
                           'label' => esc_html__( 'List Alter', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-list-alter.png'
                       ]
                    ],
                    'transport' =>  'refresh'
                ],
                'archive_sidebar_layout'  =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'both-sidebar' => [
                           'label' => esc_html__( 'Both Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'transport' =>  'refresh'
               ],   
                'single_post_layout'  =>  [
                   'label' =>  esc_html__( 'Single Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'layout-one' => [
                           'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-one.png'
                       ],
                       'layout-two' => [
                           'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-two.png'
                       ],
                       'layout-three' => [
                           'label' => esc_html__( 'Layout 3', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-three.png'
                       ],
                       'layout-four' => [
                           'label' => esc_html__( 'Layout 4', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-four.png'
                       ],
                       'layout-five' => [
                           'label' => esc_html__( 'Layout 5', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-five.png'
                       ],
                       'layout-six' => [
                           'label' => esc_html__( 'Layout 6', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/single-six.png'
                       ]
                    ],
                    'transport' =>  'refresh'
                ],
                'single_sidebar_layout'   =>  [
                    'label' =>  esc_html__( 'Sidebar Layout', 'blogmatic-pro' ),
                    'choices'  => [
                        'right-sidebar' => [
                            'label' => esc_html__( 'Right Sidebar', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                        ],
                        'left-sidebar' => [
                            'label' => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                        ],
                        'both-sidebar' => [
                            'label' => esc_html__( 'Both Sidebar', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                        ],
                        'no-sidebar' => [
                            'label' => esc_html__( 'No Sidebar', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                        ]
                    ],
                    'transport' =>  'refresh'
                ],
                'related_posts_layouts'   =>  [
                    'label' =>  esc_html__( 'Related Posts Layout', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Layout 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/related-post-list.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Layout 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/related-post-grid.png'
                        ]
                    ],
                    'transport' =>  'refresh'
                ],
                'page_settings_sidebar_layout'    =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'both-sidebar' => [
                           'label' => esc_html__( 'Both Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'transport' =>  'refresh'
                ],
                'error_page_sidebar_layout'   =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'both-sidebar' => [
                           'label' => esc_html__( 'Both Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'transport' =>  'refresh'
                ],
                'search_page_sidebar_layout'  =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogmatic-pro' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'both-sidebar' => [
                           'label' => esc_html__( 'Both Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/both-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogmatic-pro' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'transport' =>  'refresh'
                ],
                'instagram_layout'    =>  [
                    'label' => esc_html__( 'Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Header 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/instagram-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Header 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/instagram-two.png'
                        ]
                    ],
                ],
                'footer_instagram_layout'    =>  [
                    'label' => esc_html__( 'Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'one' => [
                            'label' => esc_html__( 'Header 1', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/instagram-one.png'
                        ],
                        'two' => [
                            'label' => esc_html__( 'Header 2', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/instagram-two.png'
                        ]
                    ],
                ],
                'you_may_have_missed_layouts' =>  [
                    'label' => esc_html__( 'Layouts', 'blogmatic-pro' ),
                    'choices'  => [
                        'grid' => [
                            'label' => esc_html__( 'Grid', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/carousel-one.png'
                        ],
                        'list' => [
                            'label' => esc_html__( 'List', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/carousel-two.png'
                        ]
                    ],
                    'transport' =>  'refresh'
                ],
                'header_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'blogmatic-pro' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ]
                ],
                'footer_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'blogmatic-pro' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'blogmatic-pro' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_image() Method

        /**
         * Get all icon picker controls
         * 
         * @since 1.0.0
         */
        public function get_icon_picker( $id = '' ) {
            $default = [
                'include_media' =>  true
            ];

            $control_array = [
                'custom_button_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button icon', 'blogmatic-pro' ),
                    'include_media' =>  false
                ]),
                'theme_mode_dark_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Dark Icon', 'blogmatic-pro' ),
                    'include_media' =>  false
                ]), 
                'theme_mode_light_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Light Icon', 'blogmatic-pro' ),
                    'include_media' =>  false
                ]), 
                'main_banner_date_icon'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Date Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'main_banner_slider_prev_arrow'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Prev Arrow', 'blogmatic-pro' ),
                    'transport' =>  'refresh',
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_setting( 'main_banner_show_arrows' )->value();
                    }
                ]),
                'main_banner_slider_next_arrow'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Next Arrow', 'blogmatic-pro' ),
                    'transport' =>  'refresh',
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_setting( 'main_banner_show_arrows' )->value();
                    }
                ]),
                'carousel_date_icon'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Choose Date Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'carousel_slider_prev_arrow'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Prev Arrow', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'carousel_slider_next_arrow'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Next Arrow', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'video_playlist_play_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Play Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'video_playlist_pause_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pause Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'video_playlist_previous_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Prev Icon', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' && $control->manager->get_setting( 'video_playlist_slider_arrow' )->value() );
                   },
                   'transport' =>  'refresh'
                ]),
                'video_playlist_next_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Next Icon', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' && $control->manager->get_setting( 'video_playlist_slider_arrow' )->value() );
                    },
                   'transport' =>  'refresh'
                ]),
                'category_collection_prev_arrow'  =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Prev arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'category_collection_slider_arrow' )->value() );
                    },
                    'transport' =>  'refresh'
                ]),
                'category_collection_next_arrow'  =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Next Arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'category_collection_slider_arrow' )->value() );
                    },
                    'transport' =>  'refresh'
                ]),
                'global_button_icon_picker'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Icon', 'blogmatic-pro' ),
                ]),
                'standard_post_format_icon_picker'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Standard post format', 'blogmatic-pro' ),
                ]),
                'audio_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Audio post format', 'blogmatic-pro' ),
                ]),
                'gallery_post_format_icon_picker' =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Gallery post format', 'blogmatic-pro' ),
                ]),
                'image_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Image post format', 'blogmatic-pro' ),
                ]),
                'quote_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Quote post format', 'blogmatic-pro' ),
                ]),
                'video_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Video post format', 'blogmatic-pro' ),
                ]),
                'breadcrumb_separator_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Separator Icon', 'blogmatic-pro' ),
                ]),
                'stt_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button icon', 'blogmatic-pro' ),
                ]),
                'archive_date_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'archive_read_time_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'archive_comments_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Comments Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'archive_category_info_box_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'archive_tag_info_box_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'pagination_button_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Icon', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                    'transport' =>  'refresh'
                ]),   
                'single_date_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'single_read_time_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'single_comments_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Comments Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'toc_list_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'List icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'active_callback'   =>  function( $control ){
                       return ( $control->manager->get_setting( 'toc_list_type' )->value() == 'icon' );
                    },
                    'transport' =>  'refresh'
                ]),   
                'toc_open_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'transport' =>  'refresh'
                ]),
                'toc_close_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Close icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'transport' =>  'refresh'
                ]),
                'page_toc_list_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'List icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'active_callback'   =>  function( $control ){
                       return ( $control->manager->get_setting( 'page_toc_list_type' )->value() == 'icon' );
                    },
                    'transport' =>  'refresh'
                ]),   
                'page_toc_open_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Open icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'transport' =>  'refresh'
                ]),
                'page_toc_close_icon' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Close icon', 'blogmatic-pro' ),
                    'include_media' =>  false,
                    'transport' =>  'refresh'
                ]),
                'error_page_button_icon'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Icon', 'blogmatic-pro' ),
                ]),
                'instagram_button_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button icon', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'show_instagram_button' )->value() );
                    },
                ]),
                'footer_instagram_button_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button icon', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'footer_show_instagram_button' )->value() );
                    },
                ]),
                'instagram_prev_arrow'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Prev arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'instagram_slider_arrow' )->value() );
                    }
                ]),
                'footer_instagram_prev_arrow'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Prev arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'instagram_slider_arrow' )->value() );
                    }
                ]),
                'instagram_next_arrow'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Next arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'instagram_slider_arrow' )->value() );
                    }
                ]),
                'footer_instagram_next_arrow'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Next arrow', 'blogmatic-pro' ),
                   'active_callback'   =>  function( $control ) {
                       return ( $control->manager->get_setting( 'instagram_slider_arrow' )->value() );
                    }
                ]),
                'you_may_have_missed_date_icon'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Choose Date Icon', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_icon_picker() Method

        /**
         * Get all text controls
         * 
         * @since 1.0.0
         */
        public function get_text( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Button Label', 'blogmatic-pro' ),
                'type'  =>  'text',
                'tab'   => 'general'
            ];

            $control_array = [
                'menu_cutoff_text'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Menu cutoff more text', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'search_view_all_button_text' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'View all button text', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    }
                ]),
                'search_no_result_found_text' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'No result found text', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    }
                ]),
                'custom_button_label' =>  $this->get_params( $default, []),
                'video_playlist_api_key'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Youtube API key is required', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'In order to display proper title and video duration api key is required. Please go throught this url to know how to generate api key https://blog.hubspot.com/website/how-to-get-youtube-api-key.', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]),
                'global_button_label'   =>  $this->get_params( $default, []),
                'stt_text'  =>  $this->get_params( $default, []),
                'pagination_button_label'   =>  $this->get_params( $default, [
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                ]),
                'pagination_no_more_reults_text'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'No more results text', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                ]),
                'toc_heading_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Table of content title', 'blogmatic-pro' ),
                ]),
                'page_toc_heading_option' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Table of content title', 'blogmatic-pro' ),
                ]),
                'error_page_title_text'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( '404 Title Text', 'blogmatic-pro' ),
                ]),
                'error_page_content_text' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( '404 Content Text', 'blogmatic-pro' ),
                ]),
                'error_page_button_text'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( '404 Button Text', 'blogmatic-pro' ),
                ]),
                'search_page_title'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Search page title', 'blogmatic-pro' ),
                ]),
                'search_nothing_found_title'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Nothing found title', 'blogmatic-pro' ),
                ]),
                'search_page_button_text' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button Text', 'blogmatic-pro' ),
                ]),
                'instagram_button_text'   =>  $this->get_params( $default, [
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'show_instagram_button' )->value() );
                    },
                ]),
                'footer_instagram_button_text'   =>  $this->get_params( $default, [
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'footer_show_instagram_button' )->value() );
                    },
                ]),
                'you_may_have_missed_title'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section title', 'blogmatic-pro' ),
                ]),
                'single_post_related_posts_title'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Related articles title', 'blogmatic-pro' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_text() Method

        /**
         * Get all select controls
         * 
         * @since 1.0.0
         */
        public function get_select( $id = '' ) {
            $default = [
                'type'  =>  'select',
                'transport' =>  'refresh'
            ];

            $control_array = [
                'site_title_tag_for_frontpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Frontpage)', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'site_title_tag_for_innerpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Innerpage)', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'header_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover Effect', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'blogmatic-pro' ),
                        'one'  =>  esc_html__( 'Effect 1', 'blogmatic-pro' ),
                        'two'  =>  esc_html__( 'Effect 2', 'blogmatic-pro' ),
                        'three'  =>  esc_html__( 'Effect 3', 'blogmatic-pro' ),
                        'four'  =>  esc_html__( 'Effect 4', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'main_banner_render_in'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display In', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'front_page'    =>  esc_html__( 'Front Page', 'blogmatic-pro' ),
                        'posts_page'    =>  esc_html__( 'Posts Page', 'blogmatic-pro' ),
                        'both'    =>  esc_html__( 'Front and Posts Page', 'blogmatic-pro' )
                    ]
                ]),
                'search_type' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Search Type', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'default'   =>  esc_html__( 'Default', 'blogmatic-pro' ),
                        'live-search'=>  esc_html__( 'Live Search', 'blogmatic-pro' )
                    ]
                ]),
                'header_ads_banner_image_rel_attr'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Rel attribute', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'nofollow'  => esc_html__( 'No Follow', 'blogmatic-pro' ),
                        'noopener'  => esc_html__( 'No Opener', 'blogmatic-pro' ),
                        'noreferrer' => esc_html__( 'No Referrer', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value() );
                    }
                ]),
                'main_banner_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_post_order_args()
                ]),
                'main_banner_design_post_title_html_tag'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'main_banner_image_sizes' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'carousel_render_in'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display In', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'front_page'    =>  esc_html__( 'Front Page', 'blogmatic-pro' ),
                        'posts_page'    =>  esc_html__( 'Posts Page', 'blogmatic-pro' ),
                        'both'    =>  esc_html__( 'Front and Posts Page', 'blogmatic-pro' )
                    ]
                ]),
                'carousel_post_order' =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_post_order_args(),
                ]),
                'carousel_design_post_title_html_tag' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'carousel_image_sizes'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'category_collection_render_in'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display In', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'front_page'    =>  esc_html__( 'Front Page', 'blogmatic-pro' ),
                        'posts_page'    =>  esc_html__( 'Posts Page', 'blogmatic-pro' ),
                        'both'    =>  esc_html__( 'Front and Posts Page', 'blogmatic-pro' )
                    ]
                ]),
                'category_collection_orderby' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Order by', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'asc-name'  =>  esc_html__( 'Ascending Name', 'blogmatic-pro' ),
                        'asc-count'  =>  esc_html__( 'Ascending Count', 'blogmatic-pro' ),
                        'desc-name'  =>  esc_html__( 'Descending Name', 'blogmatic-pro' ),
                        'desc-count'  =>  esc_html__( 'Descending Count', 'blogmatic-pro' )
                    ],
                ]),
                'category_collection_image_size'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'category_collection_hover_effects'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover effects', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'none'   =>  esc_html__( 'None', 'blogmatic-pro' ),
                        'one'   =>  esc_html__( 'Effect 1', 'blogmatic-pro' ),
                        'two'   =>  esc_html__( 'Effect 2', 'blogmatic-pro' ),
                        'three'   =>  esc_html__( 'Effect 3', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'preloader_styles'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Preloader Styles', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'one'   =>  esc_html__( 'Effect One', 'blogmatic-pro' ),
                        'two'   =>  esc_html__( 'Effect Two', 'blogmatic-pro' ),
                        'three'   =>  esc_html__( 'Effect Three', 'blogmatic-pro' ),
                        'four'   =>  esc_html__( 'Effect Four', 'blogmatic-pro' ),
                        'five'   =>  esc_html__( 'Effect Five', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'preloader_option' )->value() );
                    },
                    'transport' =>  'postMessage'
                ]),
                'display_preloader_animation' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display Preloader Animation', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'first-time'   =>  esc_html__( 'On initial website load', 'blogmatic-pro' ),
                        'every-page-load'   =>  esc_html__( 'Each page loads.', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'preloader_option' )->value() );
                    },
                    'transport' =>  'postMessage'
                ]),
                'archive_title_tag'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'archive_image_size'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'archive_category_info_box_title_tag' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Title Html Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'archive_tag_info_box_title_tag'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Title Html Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'archive_author_info_box_title_tag'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Title Html Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'archive_pagination_type' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pagination Type', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_pagination_type_array_filter', [
                        'default'   => esc_html__( 'Default', 'blogmatic-pro' ),
                        'number'    => esc_html__( 'Number', 'blogmatic-pro' ),
                        'ajax-load-more'    =>  esc_html__( 'Ajax Load More', 'blogmatic-pro' )
                    ]),
                ]),
                'single_image_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'single_title_tag'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] )
                ]),
                'toc_list_type'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'List type', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'number'    =>  esc_html__( 'Number', 'blogmatic-pro' ),
                        'symbol'    =>  esc_html__( 'Symbol', 'blogmatic-pro' ),
                        'icon'  =>  esc_html__( 'Icon', 'blogmatic-pro' )
                    ],
                ]),
                'page_title_tag'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'page_image_size' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'page_toc_list_type'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'List type', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'number'    =>  esc_html__( 'Number', 'blogmatic-pro' ),
                        'symbol'    =>  esc_html__( 'Symbol', 'blogmatic-pro' ),
                        'icon'    =>  esc_html__( 'Icon', 'blogmatic-pro' )
                    ],
                ]),
                'instagram_rel_attribute' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Rel attribute', 'blogmatic-pro' ),
                    'description'   =>  esc_html( 'Specifies the relationship between the current document and the linked document.', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'nofollow'  =>  esc_html__( 'No follow', 'blogmatic-pro' ),
                        'noopener'  =>  esc_html__( 'No opener', 'blogmatic-pro' ),
                        'noreferrer'  =>  esc_html__( 'No referrer', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'instagram_url_image_link' )->value() );
                    }
                ]),
                'footer_instagram_rel_attribute' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Rel attribute', 'blogmatic-pro' ),
                    'description'   =>  esc_html( 'Specifies the relationship between the current document and the linked document.', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'nofollow'  =>  esc_html__( 'No follow', 'blogmatic-pro' ),
                        'noopener'  =>  esc_html__( 'No opener', 'blogmatic-pro' ),
                        'noreferrer'  =>  esc_html__( 'No referrer', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'footer_instagram_url_image_link' )->value() );
                    }
                ]),
                'instagram_image_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'footer_instagram_image_size'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'instagram_hover_effects' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover effects', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'none'   =>  esc_html__( 'None', 'blogmatic-pro' ),
                        'one'   =>  esc_html__( 'Effect 1', 'blogmatic-pro' ),
                        'two'   =>  esc_html__( 'Effect 2', 'blogmatic-pro' ),
                        'three'   =>  esc_html__( 'Effect 3', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_instagram_hover_effects' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover effects', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'none'   =>  esc_html__( 'None', 'blogmatic-pro' ),
                        'one'   =>  esc_html__( 'Effect 1', 'blogmatic-pro' ),
                        'two'   =>  esc_html__( 'Effect 2', 'blogmatic-pro' ),
                        'three'   =>  esc_html__( 'Effect 3', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'you_may_have_missed_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_post_order_args(),
                ]),
                'you_may_have_missed_design_post_title_html_tag'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Title Tag', 'blogmatic-pro' ),
                    'tab'   =>  'design',
                    'choices'   =>  apply_filters( 'blogmatic_get_title_tags_array_filter', [] ),
                ]),
                'you_may_have_missed_image_sizes' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogmatic-pro' ),
                    'choices'   =>  blogmatic_get_image_sizes_option_array_for_customizer(),
                ]),
                'bottom_footer_header_or_custom'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo From', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'header'  =>  esc_html__( 'Default Site Logo', 'blogmatic-pro' ),
                        'custom'  =>  esc_html__( 'Custom', 'blogmatic-pro' )
                    ],
                ]),
                'site_date_format'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Date format', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Date format applied to single and archive pages.', 'blogmatic-pro' ),
                    'choices'   => [
                        'theme_format'  => esc_html__( 'Default by theme', 'blogmatic-pro' ),
                        'default'   => esc_html__( 'Wordpress default date', 'blogmatic-pro' )
                    ],
                ]),
                'aos_animation_effects'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'AOS animation effects', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Applied to main banner, carousel, video playlist, articles of archive pages and widget(only blogmatic).', 'blogmatic-pro' ),
                    'choices'   => [
                        'fade-up'   =>  esc_html__( 'Fade Up', 'blogmatic-pro' ),
                        'fade-down'   =>  esc_html__( 'Fade Down', 'blogmatic-pro' ),
                        'fade-up-right'   =>  esc_html__( 'Fade Up Right', 'blogmatic-pro' ),
                        'fade-up-left'   =>  esc_html__( 'Fade Up Left', 'blogmatic-pro' ),
                        'fade-down-right'   =>  esc_html__( 'Fade Down Right', 'blogmatic-pro' ),
                        'fade-down-left'   =>  esc_html__( 'Fade Down Left', 'blogmatic-pro' ),
                        'flip-left'   =>  esc_html__( 'Flip Left', 'blogmatic-pro' ),
                        'flip-right'   =>  esc_html__( 'Flip Right', 'blogmatic-pro' ),
                        'flip-up'   =>  esc_html__( 'Flip Up', 'blogmatic-pro' ),
                        'flip-down'   =>  esc_html__( 'Flip Down', 'blogmatic-pro' ),
                        'zoom-in'   =>  esc_html__( 'Zoom In', 'blogmatic-pro' ),
                        'zoom-in-up'   =>  esc_html__( 'Zoom In Up', 'blogmatic-pro' ),
                        'zoom-in-down'   =>  esc_html__( 'Zoom In Down', 'blogmatic-pro' ),
                        'zoom-in-left'   =>  esc_html__( 'Zoom In Left', 'blogmatic-pro' ),
                        'zoom-in-right'   =>  esc_html__( 'Zoom In Right', 'blogmatic-pro' ),
                        'zoom-out'   =>  esc_html__( 'Zoom Out', 'blogmatic-pro' ),
                        'zoom-out-up'   =>  esc_html__( 'Zoom Out Up', 'blogmatic-pro' ),
                        'zoom-out-down'   =>  esc_html__( 'Zoom Out Down', 'blogmatic-pro' ),
                        'zoom-out-right'   =>  esc_html__( 'Zoom Out Right', 'blogmatic-pro' ),
                        'zoom-out-left'   =>  esc_html__( 'Zoom Out Left', 'blogmatic-pro' )
                    ],
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'aos_animation_option' )->value() );
                    },
                ]),
                'post_title_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Post title hover effects', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Applied to post titles listed in archive pages.', 'blogmatic-pro' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogmatic-pro' ),
                        'one'  => esc_html__( 'Effect one', 'blogmatic-pro' ),
                        'two'  => esc_html__( 'Effect Two', 'blogmatic-pro' ),  
                        'three'  => esc_html__( 'Effect Three', 'blogmatic-pro' ),  
                        'four'  => esc_html__( 'Effect Four', 'blogmatic-pro' ),  
                        'five'  => esc_html__( 'Effect Five', 'blogmatic-pro' ),
                        'six'  => esc_html__( 'Effect Six', 'blogmatic-pro' ),
                        'seven'  => esc_html__( 'Effect Seven', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_image_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Image hover effects', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Applied to post thumbanails listed in archive pages.', 'blogmatic-pro' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogmatic-pro' ),
                        'one'  => esc_html__( 'Effect One', 'blogmatic-pro' ),
                        'two'  => esc_html__( 'Effect Two', 'blogmatic-pro' ),
                        'three'  => esc_html__( 'Effect Three', 'blogmatic-pro' ),  
                        'four'  => esc_html__( 'Effect Four', 'blogmatic-pro' ),  
                        'five'  => esc_html__( 'Effect Five', 'blogmatic-pro' ) 
                    ],
                    'transport' =>  'postMessage'
                ]),
                'cursor_animation'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Cursor animation', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Applied to mouse pointer.', 'blogmatic-pro' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogmatic-pro' ),
                        'one'  => esc_html__( 'Animation 1', 'blogmatic-pro' ),
                        'two'  => esc_html__( 'Animation 2', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_breadcrumb_type'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Breadcrumb type', 'blogmatic-pro' ),
                    'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'blogmatic-pro' ),
                    'choices'   => [
                        'default' => esc_html__( 'Default', 'blogmatic-pro' ),
                        'bcn'  => esc_html__( 'NavXT', 'blogmatic-pro' ),
                        'yoast'  => esc_html__( 'Yoast SEO', 'blogmatic-pro' ),
                        'rankmath'  => esc_html__( 'Rank Math', 'blogmatic-pro' )
                    ]
                ]),
                'custom_button_animation_type'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Animation Type', 'blogmatic-pro' ),
                    'choices'   => [
                        'none'  => esc_html__( 'None', 'blogmatic-pro' ),
                        'one'   => esc_html__( 'Effect one', 'blogmatic-pro' ),
                        'two'   => esc_html__( 'Effect Two', 'blogmatic-pro' ),  
                        'three' => esc_html__( 'Effect Three', 'blogmatic-pro' ),  
                        'four'  => esc_html__( 'Effect Four', 'blogmatic-pro' ),  
                        'five'  => esc_html__( 'Effect Five', 'blogmatic-pro' )  
                    ],
                    'transport' =>  'postMessage'
                ]),
                'related_posts_filter_by'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Filter By', 'blogmatic-pro' ),
                    'choices'   =>  [
                        'categories'    =>  esc_html__( 'Categories', 'blogmatic-pro' ),
                        'tags'    =>  esc_html__( 'Tags', 'blogmatic-pro' )
                    ],
                ]),
                'site_background_animation'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Background animation', 'blogmatic-pro' ),
                    'choices'	=>	[
                        'none'	=>	esc_html__( 'None', 'blogmatic-pro' ),
                        'one'	=>	esc_html__( 'Animation 1', 'blogmatic-pro' ),
                        'two'	=>	esc_html__( 'Animation 2', 'blogmatic-pro' ),
                        'three'	=>	esc_html__( 'Animation 3', 'blogmatic-pro' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'footer_menu_control'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Select a menu', 'blogmatic-pro' ),
                    'choices'	=>	blogmatic_get_all_menus()
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_select() Method

        /**
         * Get all border controls
         * 
         * @since 1.0.0
         */
        public function get_border( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Border', 'blogmatic-pro' ),
                'input_attr'    =>  [
                    'max'   =>  100,
                    'min'   =>  0,
                    'step'  =>  1
                ]
            ];

            $control_array = [
                'header_custom_button_border' =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'canvas_menu_top_border'  =>  $this->get_params( $default, [
                    'label'       => esc_html__( 'Canvas Border', 'blogmatic-pro' ),
                    'tab'   =>  'design'
                ]),
                'main_banner_image_border'    =>  $this->get_params( $default, []),
                'carousel_image_border'   =>  $this->get_params( $default, []),
                'global_button_border'    =>  $this->get_params( $default, []),
                'archive_image_border'    =>  $this->get_params( $default, []),
                'archive_border_bottom_color' =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'single_image_border' =>  $this->get_params( $default, []), 
                'page_image_border'   =>  $this->get_params( $default, []),
                'you_may_have_missed_image_border'    =>  $this->get_params( $default, []),
                'widgets_secondary_border_bottom_color'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Bottom', 'blogmatic-pro' ),
                ]),
                'instagram_image_border'   =>  $this->get_params( $default, []),
                'footer_instagram_image_border'   =>  $this->get_params( $default, []),
                'header_builder_border'   =>  $this->get_params( $default, [
                    'tab'   =>  'design'
                ]),
                'footer_builder_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                /* Header row border */
                'header_first_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'header_second_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'header_third_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                /* Footer row border */
                'footer_first_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'footer_second_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'footer_third_row_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
                'date_time_border'   =>  $this->get_params( $default, [
                    'tab'   => 'design'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_border() Method

        /**
         * Get all preset controls
         * 
         * @since 1.0.0
         */
        public function get_preset_colors( $id = '' ) {
            $default = [
            ];

            $control_array = [
                'solid_color_preset'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Solid Presets', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Set color presets', 'blogmatic-pro' ),
                ]),
                'gradient_color_preset'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Gradient Presets', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Set gradient presets', 'blogmatic-pro' ),
                    'blend' =>  'gradient',
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_preset_colors() Method

        /**
         * Get all color controls
         * 
         * @since 1.0.0
         */
        public function get_colors( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'involve'   =>  [ 'solid' ],
                'hover' =>  false,
            ];
            
            $control_array = [
                // blogmatic_sanitize_color_picker_control
                'animation_object_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Animation object color', 'blogmatic-pro' ),
                    'tab'   =>  'general'
                ]),
                'header_active_menu_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Active Color', 'blogmatic-pro' ),
                ]),
                'video_playlist_active_title_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Active Title Color', 'blogmatic-pro' ),
                ]),
                'video_playlist_video_time_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Video Time Color', 'blogmatic-pro' ),
                ]),
                'breadcrumb_text_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Text Color', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_title_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Block title color', 'blogmatic-pro' ),
                ]),
                'you_may_have_missed_post_title_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Post title color', 'blogmatic-pro' ),
                ]),
                'footer_text_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Block Title Color', 'blogmatic-pro' ),
                ]),
                'bottom_footer_text_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Text Color', 'blogmatic-pro' ),
                ]),
                // solid and gradient
                // sanitize_text_field
                'header_sub_menu_background_color'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ]
                ]),
                'search_modal_background_color'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Modal Background Color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    },
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'canvas_menu_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'main_banner_content_background' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'carousel_content_background' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'video_playlist_active_background_color'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Active Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'video_playlist_content_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Content Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'category_collection_content_background'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'preloader_background_color'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'preloader_option' )->value() );
                    },
                    'involve'   =>  [ 'solid', 'gradient' ]
                ]),
                'website_layout_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Container Background Color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting('website_layout')->value() == 'boxed--layout' );
                    },
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'tab'   =>  'general',
                ]),
                'breadcrumb_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'archive_inner_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Inner Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ]
                ]),
                'single_page_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                ]),
                'error_page_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ]
                ]),
                'widgets_inner_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Inner Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'tab'   =>  'general',
                ]),
                'site_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'tab'   =>  'general'
                ]),
                // solid initial hover
                'social_icon_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Social Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'footer_social_icon_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Social Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'header_menu_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'header_sub_menu_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'search_icon_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'search_view_all_button_text_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'View all button text color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    },
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'search_view_all_button_background_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'View all button background color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    },
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'custom_button_text_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'custom_button_icon_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_dark_icon_color'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Dark Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_light_icon_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Light Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'canvas_menu_icon_color'   => $this->get_params( $default, [
                    'label'     => esc_html__( 'Canvas Menu Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'video_playlist_title_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Title Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'video_playlist_play_pause_icon_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Play / Pause Icon Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'category_collection_text_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'global_button_color'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'tab'   =>  'general',
                    'hover' =>  true,
                ]), 
                'breadcrumb_link_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Link Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'stt_color_group' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Icon Text', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'pagination_button_text_color'   => $this->get_params( $default, [
                    'label'     => esc_html__( 'Button Text Color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                    'involve'   =>  [ 'solid' ],
                    'tab'   =>  'general',
                    'hover' =>  true
                ]),
                'footer_title_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'bottom_footer_link_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Link Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'sidebar_pagination_button_color'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid' ],
                    'tab'   =>  'general',
                    'hover' =>  true,
                ]),
                // initial hover solid gradient
                // sanitize_text_field
                'header_custom_button_background_color_group'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ], 
                    'hover' =>  true
                ]),
                'global_button_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'tab'   =>  'general',
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true,
                ]),
                'stt_background_color_group'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Background', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true
                ]),
                'pagination_button_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Button Background Color', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'archive_pagination_type' )->value() == 'ajax-load-more' );
                    },
                    'tab'   =>  'general',
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true
                ]),
                'error_page_button_background_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Button Background Color', 'blogmatic-pro' ),
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true
                ]),
                'sidebar_pagination_button_background_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                    'tab'   =>  'general',
                    'involve'   =>  [ 'solid', 'gradient' ],
                    'hover' =>  true,
                ]),
                // solid gradient image
                // blogmatic_sanitize_color_image_group_control
                'archive_category_info_box_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'archive_tag_info_box_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'archive_author_info_box_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'page_background_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'header_builder_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient', 'image' ]
                ]),
                'footer_builder_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ],
                   'tab'   =>  'design'
                ]),
                /* Header builder row settings section */
                'header_first_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'header_second_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'header_third_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                /* Footer builder row settings section */
                'footer_first_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'footer_second_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'footer_third_row_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                /* Date / Time */
                'date_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Date Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid' ]
                ]),
                'time_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Time Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid' ]
                ]),
                'date_time_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ]
                ]),
                'mobile_canvas_icon_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Icon Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid' ],
                   'hover'  =>  true,
                   'tab'   =>  'design'
                ]),
                'mobile_canvas_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Canvas Background', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ],
                   'tab'   =>  'design'
                ]),
                'footer_menu_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Color', 'blogmatic-pro' ),
                   'involve' => [ 'solid', 'gradient' ],
                   'tab'   =>  'design',
                   'hover'  =>  true
                ])
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                foreach( $totalCats as $key => $singleCat ) :
                    $cat_color_id = 'category_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ 'category_top_spacing_' . $key ] = [];
                    $control_array[ $cat_color_id ] = [
                        'label' => esc_html__( 'Text Color', 'blogmatic-pro' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                    ];

                    $background_id = 'category_background_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ $background_id ] = [
                        'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                    ];
                    if( count( $totalCats ) != ( $key + 1 ) ) $control_array[ 'category_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                foreach( $totalTags as $key => $singleTag ) :
                    $tag_color_id = 'tag_' . absint( $singleTag->term_id ) . '_color';
                    $control_array[ 'tag_top_spacing_' . $key ] = [];
                    $control_array += [ $tag_color_id =>  [
                        'label' => esc_html__( 'Text Color', 'blogmatic-pro' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                    ]];

                    $background_id = 'tag_background_' . absint( $singleTag->term_id ) . '_color';
                    $control_array += [ $background_id   =>  [
                        'label' => esc_html__( 'Background', 'blogmatic-pro' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                    ]];
                    $tag_priority += 10;
                    if( count( $totalTags ) != ( $key + 1 ) ) $control_array[ 'tag_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_colors() Method

        /**
         * Get all editor controls
         * 
         * @since 1.0.0
         */
        public function get_editor_control( $id = '' ) {
            $control_array = [
                'bottom_footer_site_info' =>  [
                    'label' => esc_html__( 'Copyright Text', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Add %year% to retrieve current year.', 'blogmatic-pro' ),
                    'transport' =>  'refresh'
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_editor_control() Method

        /**
         * Get all Media controls
         * 
         * @since 1.0.0
         */
        public function get_media_control( $id = '' ) {
            $default = [
                'mime_type' => 'image',
                'transport' =>  'refresh'
            ];

            $control_array = [
                'dark_mode_site_logo' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Site logo ( Dark Mode )', 'blogmatic-pro' ),
                    'description' => esc_html__( 'This logo image will be displayed when the site is in dark mode.', 'blogmatic-pro' ),
                    'transport' =>  'postMessage'
                ]),
                'header_ads_banner_image' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Ads Banner Image', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Upload ads banner image', 'blogmatic-pro' ),
                ]),
                'error_page_image'    =>  $this->get_params( $default, [
                    'label' => esc_html__( '404 Image', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Upload image that shows you are on 404 error page', 'blogmatic-pro' ),
                ]),
                'bottom_footer_logo_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Footer Logo', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Upload image for bottom footer', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
                    },
                ]),
                'footer_dark_mode_logo'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Dark Mode Logo', 'blogmatic-pro' ),
                    'description' => esc_html__( 'Upload image for footer dark mode logo', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
                    },
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_media_control() Method

        /**
         * Get all wordpress default color controls
         * 
         * @since 1.0.0
         */
        public function get_predefined_colors( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'priority'  =>  20
            ];

            $control_array = [
                'site_title_hover_textcolor'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Hover Color', 'blogmatic-pro' )
                ]),
                'site_description_color'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Color', 'blogmatic-pro' )
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_predefined_colors() Method

        /**
         * Get all custom repeater controls
         * 
         * @since 1.0.0
         */
        public function get_custom_repeaters( $id = '' ) {
            $default = [ 'transport' =>  'refresh' ];

            $control_array = [
                'video_playlist_repeater' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Video Playlist', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => esc_html__( 'Video', 'blogmatic-pro' ),
                    'add_new_label' => esc_html__( 'Add new url', 'blogmatic-pro' ),
                    'fields'        => [
                        'video_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for Video', 'blogmatic-pro' ),
                            'default'   => 'https:www.youtube.com/watch?v=zCw0bkswns4'
                        ],
                        'item_option'             => 'show'
                    ],
                ]),
                'social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => 'inherit-icon_class',
                    'add_new_label' => esc_html__( 'Add New Icon', 'blogmatic-pro' ),
                    'fields'        => [
                        'icon_class'   => [
                            'type'          => 'fontawesome-icon-picker',
                            'label'         => esc_html__( 'Social Icon', 'blogmatic-pro' ),
                            'description'   => esc_html__( 'Select from dropdown.', 'blogmatic-pro' ),
                            'default'       => esc_attr( 'fab fa-instagram' ),
                            'families'  =>  'social'
                        ],
                        'icon_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'blogmatic-pro' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ]
                ]),
                'footer_social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => 'inherit-icon_class',
                    'add_new_label' => esc_html__( 'Add New Icon', 'blogmatic-pro' ),
                    'fields'        => [
                        'icon_class'   => [
                            'type'          => 'fontawesome-icon-picker',
                            'label'         => esc_html__( 'Social Icon', 'blogmatic-pro' ),
                            'description'   => esc_html__( 'Select from dropdown.', 'blogmatic-pro' ),
                            'default'       => esc_attr( 'fab fa-instagram' ),
                            'families'  =>  'social'
                        ],
                        'icon_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'blogmatic-pro' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ]
                ]),
                'instagram_repeater'   =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Instagram', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => esc_html__( 'Insta Post', 'blogmatic-pro' ),
                    'add_new_label' => esc_html__( 'Add New Post', 'blogmatic-pro' ),
                    'fields'        => [
                        'item_image'   => [
                            'type'          => 'image',
                            'label'         => esc_html__( 'Image', 'blogmatic-pro' ),
                            'default'       => 0
                        ],
                        'item_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL', 'blogmatic-pro' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ],
                ]),
                'footer_instagram_repeater'   =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Instagram', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => esc_html__( 'Insta Post', 'blogmatic-pro' ),
                    'add_new_label' => esc_html__( 'Add New Post', 'blogmatic-pro' ),
                    'fields'        => [
                        'item_image'   => [
                            'type'          => 'image',
                            'label'         => esc_html__( 'Image', 'blogmatic-pro' ),
                            'default'       => 0
                        ],
                        'item_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL', 'blogmatic-pro' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ],
                ]),
                'advertisement_repeater'  =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Advertisements', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'row_label'     => esc_html__( 'Advertisement', 'blogmatic-pro' ),
                    'add_new_label' => esc_html__( 'Add New Advertisement', 'blogmatic-pro' ),
                    'fields'        => [
                        'item_image'   => [
                            'type'          => 'image',
                            'label'         => esc_html__( 'Image', 'blogmatic-pro' ),
                            'default'       => 0
                        ],
                        'item_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL', 'blogmatic-pro' ),
                            'default'   => ''
                        ],
                        'item_target'   =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Open in', 'blogmatic-pro' ),
                            'default'   =>  '_self',
                            'options'   =>  [
                                '_blank'    =>  esc_html__( 'New tab', 'blogmatic-pro' ),
                                '_self'    =>  esc_html__( 'Same tab', 'blogmatic-pro' )
                            ]
                        ],
                        'item_rel_attribute'    =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Rel', 'blogmatic-pro' ),
                            'default'   =>  'opener',
                            'options'   =>  [
                                'nofollow'  =>  esc_html__( 'No follow', 'blogmatic-pro' ),
                                'noopener'  =>  esc_html__( 'No opener', 'blogmatic-pro' ),
                                'noreferrer'  =>  esc_html__( 'No referrer', 'blogmatic-pro' )
                            ]
                        ],
                        'item_heading'  =>  [
                            'type'  =>  'heading',
                            'label' =>  esc_html__( 'Display Area', 'blogmatic-pro' )
                        ],
                        'item_checkbox_before_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Before post content', 'blogmatic-pro' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_after_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'After post content', 'blogmatic-pro' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_random_post_archives' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Random post archives', 'blogmatic-pro' ),  
                            'default'   =>  false
                        ],
                        'item_alignment'    =>   [
                            'type'  =>  'alignment',
                            'label' =>  esc_html__( 'Ad Alignment', 'blogmatic-pro' ),
                            'default'   =>  'left',
                            'options'   =>  [
                                'left'  =>  esc_html__( 'fa-solid fa-align-left', 'blogmatic-pro' ),
                                'center'  =>  esc_html__( 'fa-solid fa-align-center', 'blogmatic-pro' ),
                                'right'  =>  esc_html__( 'fa-solid fa-align-right', 'blogmatic-pro' )
                            ]
                        ],
                        'item_image_option' =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Image Option', 'blogmatic-pro' ),
                            'default'   =>  'original',
                            'options'   =>  [
                                'full_width'  =>  esc_html__( 'Full Width', 'blogmatic-pro' ),
                                'original'  =>  esc_html__( 'Original', 'blogmatic-pro' )
                            ]
                        ],
                        'item_option'             => 'show'
                    ]
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_custom_repeaters() Method

        /**
         * Get all controls rendered using predefined number control
         * 
         * @since 1.0.0
         */
        public function get_custom_number_controls( $id = '' ) {
            $default = [
                'type'  =>  'number',
                'input_attrs'   =>  $this->get_input_attrs([
                    'min'   =>  1
                ]),
                'transport' =>  'refresh'
            ];

            $control_array = [
                'menu_cutoff_after'  => $this->get_params( $default, [
                    'label' =>  esc_html( 'Menu cutoff up to', 'blogmatic-pro' ),
                ]),
                'search_no_of_post_to_display'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'No of posts to show', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'search_type' )->value() == 'live-search' );
                    }
                ]),
                'main_banner_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogmatic-pro' ),
                ]),
                'main_banner_post_offset'  => $this->get_params( $default, [
                    'label' =>  esc_html( 'Offset', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs()
                ]), 
                'main_banner_post_elements_excerpt_length'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Length', 'blogmatic-pro' ),
                    'input_attrs'   =>    $this->get_input_attrs([
                        'max'   => 1000
                    ])
                ]), 
                'main_banner_slider_autoplay_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Autoplay Speed', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Speed of autoplay in milliseconds', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'main_banner_slider_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Speed', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Slide / Fade animation speed', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'main_banner_image_border_radius'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'transport' =>  'postMessage'
                ]),
                'carousel_no_of_columns'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'No of Columns', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   =>  2,
                        'max'   =>  5
                    ])
                ]),
                'carousel_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogmatic-pro' ),
                ]),
                'carousel_post_offset'  => $this->get_params( $default, [
                    'label' =>  esc_html( 'Offset', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs()
                ]), 
                'carousel_post_elements_excerpt_length'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Excerpt Length', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 1000
                    ])
                ]),
                'carousel_slider_autoplay_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Autoplay Speed', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Speed of autoplay in milliseconds', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   => 100,
                        'max'   => 10000,
                        'step'  => 100
                    ])
                ]),
                'carousel_slider_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Speed', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Slide / Fade animation speed', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   => 100,
                        'max'   => 10000,
                        'step'  => 100
                    ])
                ]),
                'carousel_slides_to_scroll'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to Scroll', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  5,
                        'min'   =>  1
                    ])
                ]),
                'video_playlist_slider_slides_to_show' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to show', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' );
                    },
                ]),
                'category_collection_number'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Number of category', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  10,
                        'min'   =>  1
                    ])
                ]),
                'category_collection_offset'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Offset', 'blogmatic-pro' )
                ]),
                'category_collection_autoplay_speed'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Autoplay speed', 'blogmatic-pro' ),
                    'active_callback'  =>   function( $control ){
                        return ( $control->manager->get_setting( 'category_collection_autoplay_option' )->value() );
                    },
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'category_collection_slider_speed'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slider Speed', 'blogmatic-pro' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   => 1000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'category_collection_slides_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to show', 'blogmatic-pro' )
                ]),
                'category_collection_slides_to_scroll' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to scroll', 'blogmatic-pro' )
                ]),
                'archive_excerpt_length'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Length', 'blogmatic-pro' ),
                    'input_attrs'   =>  [
                        'min'   =>  0,
                        'max'   =>  1000
                    ],
                ]),
                'single_image_border_radius'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 100
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'page_image_border_radius' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'transport' =>  'postMessage'
                ]),
                'instagram_autoplay_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Autoplay speed', 'blogmatic-pro' ),
                    'active_callback'  =>   function( $control ){
                        return ( $control->manager->get_setting( 'instagram_autoplay_option' )->value() );
                    },
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'footer_instagram_autoplay_speed' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Autoplay speed', 'blogmatic-pro' ),
                    'active_callback'  =>   function( $control ){
                        return ( $control->manager->get_setting( 'footer_instagram_autoplay_option' )->value() );
                    },
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ])
                ]),
                'instagram_slider_speed'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slider Speed', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ]),
                ]),
                'footer_instagram_slider_speed'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slider Speed', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 10000,
                        'min'   => 100,
                        'step'  => 100
                    ]),
                ]),
                'instagram_slides_to_show' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to show', 'blogmatic-pro' )
                ]),
                'footer_instagram_slides_to_show' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to show', 'blogmatic-pro' )
                ]),
                'instagram_slides_to_scroll'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to scroll', 'blogmatic-pro' )
                ]),
                'footer_instagram_slides_to_scroll'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Slides to scroll', 'blogmatic-pro' )
                ]),
                'you_may_have_missed_no_of_columns' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'No of Columns', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   =>  2,
                        'max'   =>  4
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'you_may_have_missed_no_of_posts_to_show' => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  4,
                        'min'   =>  1
                    ])
                ]),
                'you_may_have_missed_post_offset'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'Offset', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs()
                ]),
                'custom_button_icon_distance'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Distance (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  50
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'video_playlist_slider_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Previous / Next Icon Size', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  500
                    ]),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'video_playlist_layouts' )->value() == 'two' && $control->manager->get_setting( 'video_playlist_slider_arrow' )->value() );
                    },
                    'transport' =>  'postMessage'
                ]),
                'video_playlist_border_radius'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   =>  1
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'global_button_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Border radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 200
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'archive_section_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'design',
                    'transport' =>  'postMessage'
                ]),
                'toc_sticky_width'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Table of content width', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  500,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'toc_display_type' )->value() == 'fixed' );
                    },
                    'transport' =>  'postMessage'
                ]),
                'related_posts_no_of_column'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'No of Column', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  3,
                        'min'   =>  2
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'page_toc_sticky_width' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Table of content width', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  500,
                        'min'   =>  1
                    ]),
                    'active_callback'   =>  function( $control ){
                        return ( $control->manager->get_setting( 'page_toc_display_type' )->value() == 'fixed' );
                    },
                    'transport' =>  'postMessage'
                ]),
                'sidebar_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  50
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'sidebar_pagination_button_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Border radius (px)', 'blogmatic-pro' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 200
                    ]),
                    'transport' =>  'postMessage'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_custom_number_controls() Method

        /**
         * Get a list of all url controls
         * 
         * @since 1.0.0
         */
        public function get_url( $id = '' ) {
            $default = [
                'type'  =>  'url',
                'transport' =>  'refresh'
            ];

            $control_array = [
                'custom_button_redirect_href_link'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Redirect URL', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Add url for the button to redirect', 'blogmatic-pro' ),
                ]),
                'header_ads_banner_image_url' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Banner Url', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'Add url for the ads banner to redirect', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'header_ads_banner_image_link_url' )->value() );
                    }
                ]),
                'instagram_button_url' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button url', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'show_instagram_button' )->value() );
                    },
                ]),
                'footer_instagram_button_url' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Button url', 'blogmatic-pro' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'footer_show_instagram_button' )->value() );
                    },
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_url() Method

        /**
         * Get all social share controls
         * 
         * @since 1.0.0
         */
        public function get_social_share( $id = '' ) {

            $control_array = [
                'social_share_repeater'    =>  [
                    'label'         => esc_html__( 'Social Shares', 'blogmatic-pro' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogmatic-pro' ),
                    'library'   =>  blogmatic_get_all_social_share(),
                    'color_genre'   =>  [ 'solid' ],
                    'background_genre'   =>  [ 'solid', 'gradient' ],
                    'to_include'   =>  [ 'icons', 'colors', 'backgrounds' ],
                    'icon_picker_genre' =>  [ 'icon', 'none' ],
                    'color_hover'   =>  true,
                    'background_hover'   =>  true
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_social_share() Method


        /**
         * Get all multiselect controls
         * 
         * @since 1.0.0
         */
        public function get_multiselect_controls( $id = '' ) {
            $default = [
                'endpoint'   =>  'extend/get_taxonomy',
                'purpose'   =>  'post',
                'transport' =>  'refresh'
            ];

            $control_array = [
                // category
                'main_banner_slider_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogmatic-pro' ),
                    'purpose'   =>  'category'
                ]),
                'carousel_slider_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogmatic-pro' ),
                    'purpose'   =>  'category'
                ]),
                'category_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to include', 'blogmatic-pro' ),
                    'purpose'   =>  'category'
                ]),
                'category_to_exclude' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to exclude', 'blogmatic-pro' ),
                    'purpose'   =>  'category'
                ]),
                'you_may_have_missed_categories' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogmatic-pro' ),
                    'purpose'   =>  'category'
                ]),
                // posts
                'main_banner_slider_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'main_banner_slider_posts_to_exclude'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Exclude', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'carousel_slider_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'carousel_slider_posts_to_exclude'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Exclude', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'you_may_have_missed_posts_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                'you_may_have_missed_posts_to_exclude' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Exclude', 'blogmatic-pro' ),
                    'endpoint'   =>  'extend/get_posts'
                ]),
                // tags
                'main_banner_slider_tags'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Tags', 'blogmatic-pro' ),
                    'purpose'   =>  'post_tag'
                ]),
                'carousel_slider_tags'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Tags', 'blogmatic-pro' ),
                    'purpose'   =>  'post_tag'
                ]),
                'you_may_have_missed_tags' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Tags', 'blogmatic-pro' ),
                    'purpose'   =>  'post_tag'
                ]),
                // users
                'main_banner_slider_authors'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Authors', 'blogmatic-pro' ),
                    'purpose'   =>  'users',
                    'endpoint'   =>  'extend/get_users'
                ]),
                'carousel_slider_authors'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Authors', 'blogmatic-pro' ),
                    'purpose'   =>  'users',
                    'endpoint'   =>  'extend/get_users'
                ]),
                'you_may_have_missed_authors' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Authors', 'blogmatic-pro' ),
                    'purpose'   =>  'users',
                    'endpoint'   =>  'extend/get_users'
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_multiselect_controls() Method

        /**
         * Get all normal multiselect controls
         * 
         * @since 1.0.0
         */
        public function get_normal_multiselect_controls( $id = '' ) {
            $default = [
                'label'     => esc_html__( 'Field of headings', 'blogmatic-pro' ),
                'choices'   => [
                    [
                        'value' => 'h1',
                        'label' => esc_html__('H1', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'h2',
                        'label' => esc_html__('H2', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'h3',
                        'label' => esc_html__('H3', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'h4',
                        'label' => esc_html__('H4', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'h5',
                        'label' => esc_html__('H5', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'h6',
                        'label' => esc_html__('H6', 'blogmatic-pro' )
                    ]
                ],
                'transport' =>  'refresh'
            ];

            $control_array = [
                'toc_field_for_heading' => $this->get_params( $default, []),
                'page_toc_field_for_heading'  => $this->get_params( $default, [])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_normal_multiselect_controls() Method

        /**
         * Get all reflector controls
         * 
         * @since 1.0.0
         */
        public function get_builder_reflector_controls( $id ) {
            $default = [
                'label' =>  esc_html__( 'Row Widgets', 'blogmatic-pro' )
            ];
            $control_array = [
                /* Header builder reflectors */
                'header_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	1,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                'header_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	2,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                'header_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	3,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder'
                ]),
                /* Footer builder reflectors */
                'footer_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	1
                ]),
                'footer_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	2
                ]),
                'footer_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	3
                ]),
                /* Responsive Header Builder reflector */
                'mobile_canvas_reflector' => $this->get_params( $default, [
                    'placement'	=>	'responsive-header',
                    'builder'	=>	'responsive_header_builder',
                    'row'	=>	4
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_builder_reflector_controls() Method

        /**
         * Get all responsive radio image  controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_image( $id ) {
            $default = [];
            $theme_directory = get_template_directory_uri();
            $column_layouts = [
                'one' => [
                    'label' => esc_html__( 'Layout One', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_one.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 1 ]
                ],
                'two' => [
                    'label' => esc_html__( 'Layout One', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_two.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'three' => [
                    'label' => esc_html__( 'Layout Two', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_three.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'four' => [
                    'label' => esc_html__( 'Layout Three', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'five' => [
                    'label' => esc_html__( 'Layout One', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'six' => [
                    'label' => esc_html__( 'Layout Two', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'seven' => [
                    'label' => esc_html__( 'Layout Three', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'eight' => [
                    'label' => esc_html__( 'Layout Four', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'nine' => [
                    'label' => esc_html__( 'Layout One', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'ten' => [
                    'label' => esc_html__( 'Layout Two', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'eleven' => [
                    'label' => esc_html__( 'Layout Three', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'twelve' => [
                    'label' => esc_html__( 'Layout Four', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'thirteen' => [
                    'label' => esc_html__( 'Layout Four', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 2 ]
                ],
                'fourteen' => [
                    'label' => esc_html__( 'Layout Five', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
                'fifteen' => [
                    'label' => esc_html__( 'Layout Six', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
                'sixteen' => [
                    'label' => esc_html__( 'Layout Seven', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
                'seventeen' => [
                    'label' => esc_html__( 'Layout Five', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 4 ]
                ],
                'eighteen' => [
                    'label' => esc_html__( 'Layout Six', 'blogmatic-pro' ),
                    'url'   => $theme_directory . '/assets/images/customizer/footer_column_four.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 4 ]
                ]
            ];
            $control_array = [
                /* Header layout row controls */
                'header_first_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'choices'  => $column_layouts
                ],
                'header_second_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'row'   =>  2,
                    'choices'  => $column_layouts
                ],
                'header_third_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'row'   =>  3,
                    'choices'  => $column_layouts
                ],
                /* Footer layout row controls */
                'footer_first_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'builder'   =>  'footer',
                    'choices'  => $column_layouts
                ],
                'footer_second_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'row'   =>  2,
                    'builder'   =>  'footer',
                    'choices'  => $column_layouts
                ],
                'footer_third_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogmatic-pro' ),
                    'row'   =>  3,
                    'builder'   =>  'footer',
                    'choices'  => $column_layouts
                ],
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_responsive_radio_image() Method

        /**
         * Gets all textarea controls
         * 
         * @since 1.0.0
         */
        public function get_textareas( $id = '' ){
            $default = [];
            $control_array = [
                'search_nothing_found_content' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Nothing Found Content', 'blogmatic-pro' ),
                    'type'  =>  'textarea'
                    
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Gets all responsive radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_tab( $id = '' ){
            $default = [
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'blogmatic-pro' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'blogmatic-pro' )
                    ]
                ]
            ];
            $control_array = [
                /* Header builder first row */
                'header_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Header builder second row */
                'header_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Header builder third row */
                'header_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder first row */
                'footer_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder second row */
                'footer_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder third row */
                'footer_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogmatic-pro' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all typography preset controls
         * 
         * @since 1.0.0
         */
        public function get_typography_preset_controls( $id = '' ) {

            $control_array = [
                'typography_presets' =>   [
                    'label' =>  esc_html__( 'Typography Preset', 'blogmatic-pro' ),
                    'description'   =>  esc_html__( 'This is the control to use in future projects.', 'blogmatic-pro' ),
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all preset color controls
         * 
         * @since 1.0.0
         */
        public function get_theme_colors( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];

            $control_array = [
                // preset colors
                'theme_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Theme Color', 'blogmatic-pro' ),
                    'variable'   => '--blogmatic-global-preset-theme-color'
                ]),
                'gradient_theme_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Gradient Theme Color', 'blogmatic-pro' ),
                    'variable'   => '--blogmatic-global-preset-gradient-theme-color',
                    'involve'   =>  'gradient'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all divider controls
         * 
         * @since 1.0.0
         */
        public function get_divider_controls( $design_tab = false ) {
            return $design_tab ? [ 'tab' => 'design' ] : [];
        }

        /**
         * Returns all builder controls
         * 
         * @since 1.0.0
         */
        public function get_builder_controls( $id = '' ) {

            $default = [
                'transport' =>  'refresh'
            ];

            $control_array = [
                'header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'responsive_builder'	=>	'responsive_header_builder',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'blogmatic-pro' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'blogmatic-pro' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogmatic-pro' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'blogmatic-pro' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Menu', 'blogmatic-pro' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'blogmatic-pro' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'blogmatic-pro' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'blogmatic-pro' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ],
                        'image'	=>	[
                            'label' 	=>	esc_html__( 'Image', 'blogmatic-pro' ),
                            'icon' 	=>	'format-image',
                            'section'	=>	'header_advertisement_banner_section'
                        ],
                        'instagram'	=>	[
                            'label' 	=>	esc_html__( 'Instagram', 'blogmatic-pro' ),
                            'icon' 	=>	'instagram',
                            'section'	=>	'instagram_section'
                        ],
                    ]
                ]),
                'footer_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'footer_builder_section_settings',
                    'placement'	=>	'footer',
                    'widgets'	=>	[
                        'logo'	=>	[
                            'label' 	=>	esc_html__( 'Logo', 'blogmatic-pro' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'footer_logo'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogmatic-pro' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'footer_social_icons_section'
                        ],
                        'copyright'	=>	[
                            'label' 	=>	esc_html__( 'Copyright', 'blogmatic-pro' ),
                            'icon' 	=>	'privacy',
                            'section'	=>	'footer_copyright'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Menu', 'blogmatic-pro' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'footer_menu_options_section'
                        ],
                        'sidebar-one'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 1', 'blogmatic-pro' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-one'
                        ],
                        'sidebar-two'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 2', 'blogmatic-pro' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-two'
                        ],
                        'sidebar-three'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 3', 'blogmatic-pro' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-three'
                        ],
                        'sidebar-four'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 4', 'blogmatic-pro' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-four'
                        ],
                        'instagram'	=>	[
                            'label' 	=>	esc_html__( 'Instagram', 'blogmatic-pro' ),
                            'icon' 	=>	'instagram',
                            'section'	=>	'footer_instagram_section'
                        ],
                        'you-may-have-missed'	=>	[
                            'label' 	=>	esc_html__( 'You may have missed', 'blogmatic-pro' ),
                            'icon' 	=>	'star-filled',
                            'section'	=>	'you_may_have_missed_section'
                        ],
                        'scroll-to-top'	=>	[
                            'label' 	=>	esc_html__( 'Scroll to Top', 'blogmatic-pro' ),
                            'icon' 	=>	'arrow-up-alt2',
                            'section'	=>	'stt_options_section'
                        ],
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all responsive builder controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_builder_controls( $id = '' ) {

            $default = [
                'transport' =>  'refresh'
            ];

            $control_array = [
                'responsive_header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'placement'	=>	'header',
                    'responsive_canvas_id'	=>	'responsive-canvas',
                    'responsive_section'	=>	'mobile_canvas_section',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'blogmatic-pro' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'blogmatic-pro' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogmatic-pro' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'blogmatic-pro' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Menu', 'blogmatic-pro' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'blogmatic-pro' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'blogmatic-pro' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'blogmatic-pro' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ],
                        'image'	=>	[
                            'label' 	=>	esc_html__( 'Image', 'blogmatic-pro' ),
                            'icon' 	=>	'format-image',
                            'section'	=>	'header_advertisement_banner_section'
                        ],
                        'instagram'	=>	[
                            'label' 	=>	esc_html__( 'Instagram', 'blogmatic-pro' ),
                            'icon' 	=>	'instagram',
                            'section'	=>	'instagram_section'
                        ],
                        'toggle-button'	=>	[
                            'label' 	=>	esc_html__( 'Toggle Button', 'blogmatic-pro' ),
                            'icon' 	=>	'ellipsis',
                            'section'	=>	'mobile_canvas_section'
                        ]
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Get controls parameters necessary in add_control function
         * 
         * @since 1.0.0
         */
        public function get_params( $default = [], $append = [] ) {
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }

        /**
         * Get input_attrs array
         * 
         * @since 1.0.0
         */
        public function get_input_attrs( $append = [] ) {
            $default = [
                'max'   =>  100,
                'min'   =>  0,
                'step'   =>  1,
                'reset'   =>  true
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }
    }
 endif;