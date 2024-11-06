<?php
    /**
     * Base class for header and footer builder
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    namespace Blogmatic_Builder;
    require 'base.php';
    use Blogmatic\CustomizerDefault as BMC;
    if( ! class_exists( 'Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Header_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BMC\blogmatic_get_customizer_option( 'header_builder' );
                $this->builder_value = $this->original_value;
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Assign values
             * 
             * @since 1.0.0
             */
            public function assign_values() {
                /* Columns count */
                $header_first_row_column = BMC\blogmatic_get_customizer_option( 'header_first_row_column' );
                $header_second_row_column = BMC\blogmatic_get_customizer_option( 'header_second_row_column' );
                $header_third_row_column = BMC\blogmatic_get_customizer_option( 'header_third_row_column' );
                $this->columns_array = [ $header_first_row_column, $header_second_row_column, $header_third_row_column ];
                /* Columns layout */
                $header_first_row_column_layout = BMC\blogmatic_get_customizer_option( 'header_first_row_column_layout' );
                $header_second_row_column_layout = BMC\blogmatic_get_customizer_option( 'header_second_row_column_layout' );
                $header_third_row_column_layout = BMC\blogmatic_get_customizer_option( 'header_third_row_column_layout' );
                $this->column_layouts_array = [ $header_first_row_column_layout, $header_second_row_column_layout, $header_third_row_column_layout ];
                /* Column Alignments */
                $this->column_alignments_array = $this->organize_column_alignments();
            }

            /**
             * Column alignments
             * 
             * @since 1.0.0
             */
            public function organize_column_alignments() {
                $column_alignments = [
                    [
                        /* First Row */
                        BMC\blogmatic_get_customizer_option( 'header_first_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'header_first_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'header_first_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'header_first_row_column_four' )
                    ],
                    [
                        /* Second Row */
                        BMC\blogmatic_get_customizer_option( 'header_second_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'header_second_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'header_second_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'header_second_row_column_four' )
                    ],
                    [
                        /* Third Row */
                        BMC\blogmatic_get_customizer_option( 'header_third_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'header_third_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'header_third_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'header_third_row_column_four' )
                    ]
                ];

                $structured_alignements = [];
                if( count( $this->columns_array ) > 0 ) :
                    for( $i = 0; $i < count( $this->columns_array ); $i++ ) :
                        $structured_alignements[ $i ] = $column_alignments[ $i ];
                    endfor;
                endif;

                return $structured_alignements;
            }

            /**
             * Extra row classes
             * 
             * @since 1.0.0
             */
            public function get_extra_row_classes( $row_index ) {
                $row_widgets = $this->builder_value[ $row_index ];
                $only_widgets = array_reduce( $row_widgets, 'array_merge', [] );
                $header_sticky = $this->get_row_header_sticky_value( $row_index );
                $classes = '';
                if( $header_sticky ) $classes .= ' row-sticky';
                if( in_array( 'instagram', $only_widgets ) ):
                    $instagram_enable_slider = BMC\blogmatic_get_customizer_option( 'instagram_enable_slider_in_header' );
                    $classes .= ' insta-slider--' . ( ( $instagram_enable_slider ) ? 'enabled' : 'disabled' );
                endif;
                if( in_array( 'menu', $only_widgets ) ) $classes .= ' has-menu';
                return $classes;
            }

            /**
             * Header sticky controls in an array
             * 
             * @since 1.0.0
             */
            public function get_row_header_sticky_value( $row_index ) {
                $header_sticky_controls = [
                    BMC\blogmatic_get_customizer_option( 'header_first_row_header_sticky' ),
                    BMC\blogmatic_get_customizer_option( 'header_second_row_header_sticky' ),
                    BMC\blogmatic_get_customizer_option( 'header_third_row_header_sticky' )
                ];
                return $header_sticky_controls[ $row_index ];
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                require get_template_directory() . '/inc/hooks/top-header-hooks.php';
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'site-logo':
                        /**
                        * hook - blogmatic_header__site_branding_section_hook
                        * 
                        * @hooked - blogmatic_header_menu_part - 10
                        */
                        if( has_action( 'blogmatic_header__site_branding_section_hook' ) ) do_action( 'blogmatic_header__site_branding_section_hook' );
                        break;
                    case 'date-time':
                        /**
                        * hook - blogmatic_date_time_hook
                        * 
                        * @hooked - blogmatic_date_time_part - 10
                        */
                        if( has_action( 'blogmatic_date_time_hook' ) ) do_action( 'blogmatic_date_time_hook' );
                        break;
                    case 'social-icons':
                        /**
                        * hook - blogmatic_social_icons_hook
                        * 
                        * @hooked - blogmatic_social_part - 10
                        */
                        if( has_action( 'blogmatic_social_icons_hook' ) ) do_action( 'blogmatic_social_icons_hook' );
                        break;
                    case 'search':
                        /**
                         * hook - blogmatic_header_search_hook
                         * 
                         * @hooked - blogmatic_header_search_part - 10
                         */
                        if( has_action( 'blogmatic_header_search_hook' ) ) do_action( 'blogmatic_header_search_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - blogmatic_header__menu_section_hook
                         * 
                         * @hooked - blogmatic_header_menu_part - 10
                         */
                        if( has_action( 'blogmatic_header__menu_section_hook' ) ) do_action( 'blogmatic_header__menu_section_hook' );
                        break;
                    case 'button':
                        /**
                         * hook - blogmatic_header__custom_button_section_hook
                         * 
                         * @hooked - blogmatic_header_custom_button_part - 10
                         */
                        if( has_action( 'blogmatic_header__custom_button_section_hook' ) ) do_action( 'blogmatic_header__custom_button_section_hook' );
                        break;
                    case 'theme-mode':
                        /**
                         * hook - blogmatic_header_theme_mode_hook
                         * 
                         * @hooked - blogmatic_header_theme_mode_part - 10
                         */
                        if( has_action( 'blogmatic_header_theme_mode_hook' ) ) do_action( 'blogmatic_header_theme_mode_hook' );
                        break;
                    case 'off-canvas':
                        /**
                         * hook - blogmatic_header_off_canvas_hook
                         * 
                         * @hooked - blogmatic_header_canvas_menu_part - 10
                         */
                        if( has_action( 'blogmatic_header_off_canvas_hook' ) ) do_action( 'blogmatic_header_off_canvas_hook' );
                        break;
                    case 'image':
                        /**
                         * hook - blogmatic_header_main_advertisement_hook
                         * 
                         * @hooked - blogmatic_header_main_advertisement_part - 10
                         */
                        if( has_action( 'blogmatic_header_main_advertisement_hook' ) ) do_action( 'blogmatic_header_main_advertisement_hook' );
                        break;
                    case 'instagram':
                        /**
                         * hook - blogmatic_header_instagram_hook
                         * 
                         * @hooked - blogmatic_get_header_instagram - 10
                         */
                        if( has_action( 'blogmatic_header_instagram_hook' ) ) do_action( 'blogmatic_header_instagram_hook' );
                        break;
                endswitch;
            }
        }
    endif;