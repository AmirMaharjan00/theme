<?php
    /**
     * Footer Builder
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    namespace Blogmatic_Builder;
    // require 'base.php';
    use Blogmatic\CustomizerDefault as BMC;
    if( ! class_exists( 'Footer_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Footer_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BMC\blogmatic_get_customizer_option( 'footer_builder' );
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
                /* Column count */
                $footer_first_row_column = BMC\blogmatic_get_customizer_option( 'footer_first_row_column' );
                $footer_second_row_column = BMC\blogmatic_get_customizer_option( 'footer_second_row_column' );
                $footer_third_row_column = BMC\blogmatic_get_customizer_option( 'footer_third_row_column' );
                $this->columns_array = [ $footer_first_row_column, $footer_second_row_column, $footer_third_row_column ];
                /* Columns layout */
                $footer_first_row_column_layout = BMC\blogmatic_get_customizer_option( 'footer_first_row_column_layout' );
                $footer_second_row_column_layout = BMC\blogmatic_get_customizer_option( 'footer_second_row_column_layout' );
                $footer_third_row_column_layout = BMC\blogmatic_get_customizer_option( 'footer_third_row_column_layout' );
                $this->column_layouts_array = [ $footer_first_row_column_layout, $footer_second_row_column_layout, $footer_third_row_column_layout];
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
                        BMC\blogmatic_get_customizer_option( 'footer_first_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'footer_first_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'footer_first_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'footer_first_row_column_four' )
                    ],
                    [
                        /* Second Row */
                        BMC\blogmatic_get_customizer_option( 'footer_second_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'footer_second_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'footer_second_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'footer_second_row_column_four' )
                    ],
                    [
                        /* Third Row */
                        BMC\blogmatic_get_customizer_option( 'footer_third_row_column_one' ),
                        BMC\blogmatic_get_customizer_option( 'footer_third_row_column_two' ),
                        BMC\blogmatic_get_customizer_option( 'footer_third_row_column_three' ),
                        BMC\blogmatic_get_customizer_option( 'footer_third_row_column_four' )
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
                $row_direction_array = [
                    BMC\blogmatic_get_customizer_option( 'footer_first_row_row_direction' ),
                    BMC\blogmatic_get_customizer_option( 'footer_second_row_row_direction' ),
                    BMC\blogmatic_get_customizer_option( 'footer_third_row_row_direction' )
                ];

                $vertical_alignment_array = [
                    BMC\blogmatic_get_customizer_option( 'footer_first_row_vertical_alignment' ),
                    BMC\blogmatic_get_customizer_option( 'footer_second_row_vertical_alignment' ),
                    BMC\blogmatic_get_customizer_option( 'footer_third_row_vertical_alignment' )
                ];

                $row_widgets = $this->builder_value[ $row_index ];
                $only_widgets = array_reduce( $row_widgets, 'array_merge', [] );
                $classes = '';
                if( array_key_exists( $row_index, $row_direction_array ) ) $classes .= ' is-' . $row_direction_array[ $row_index ];
                if( array_key_exists( $row_index, $vertical_alignment_array ) ) $classes .= ' vertical-align--' . $vertical_alignment_array[ $row_index ];
                if( in_array( 'instagram', $only_widgets ) ) :
                    $instagram_enable_slider = BMC\blogmatic_get_customizer_option( 'footer_instagram_enable_slider_in_footer' );
                    $classes .= ' insta-slider--' . ( ( $instagram_enable_slider ) ? 'enabled' : 'disabled' );
                endif;
                return $classes;
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'logo':
                        /**
                         * hook - blogmatic_footer_logo_hook
                         * 
                         * @hooked - blogmatic_footer_logo_part - 10
                         */
                        if( has_action( 'blogmatic_footer_logo_hook' ) ) do_action( 'blogmatic_footer_logo_hook' );
                        break;
                    case 'social-icons':
                        /**
                         * hook - blogmatic_footer_social_hook
                         * 
                         * @hooked - blogmatic_footer_social_icons - 10
                         */
                        if( has_action( 'blogmatic_footer_social_hook' ) ) do_action( 'blogmatic_footer_social_hook' );
                        break;
                    case 'copyright':
                        /**
                         * hook - blogmatic_footer_copyright_hook
                         * 
                         * @hooked - blogmatic_footer_copyright_part - 10
                         */
                        if( has_action( 'blogmatic_footer_copyright_hook' ) ) do_action( 'blogmatic_footer_copyright_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - blogmatic_footer__menu_section_hook
                         * 
                         * @hooked - blogmatic_footer_menu - 10
                         */
                        if( has_action( 'blogmatic_footer__menu_section_hook' ) ) do_action( 'blogmatic_footer__menu_section_hook' );
                        break;
                    case 'sidebar-one':
                        /**
                         * sidebar-id = 'footer-sidebar-column-1'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-1' );
                        break;
                    case 'sidebar-two':
                        /**
                         * sidebar-id = 'footer-sidebar-column-2'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-2' );
                        break;
                    case 'sidebar-three':
                        /**
                         * sidebar-id = 'footer-sidebar-column-3'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-3' );
                        break;
                    case 'sidebar-four':
                        /**
                         * sidebar-id = 'footer-sidebar-column-4'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-4' );
                        break;
                    case 'instagram':
                         /**
                         * hook - blogmatic_footer_instagram_hook
                         * 
                         * @hooked - blogmatic_get_footer_instagram - 10
                         */
                        if( has_action( 'blogmatic_footer_instagram_hook' ) ) do_action( 'blogmatic_footer_instagram_hook' );
                        break;
                    case 'you-may-have-missed':
                         /**
                         * hook - blogmatic_you_may_have_missed_hook
                         * 
                         * @hooked - blogmatic_you_may_have_missed_html - 10
                         */
                        if( has_action( 'blogmatic_you_may_have_missed_hook' ) ) do_action( 'blogmatic_you_may_have_missed_hook' );
                        break;
                    case 'scroll-to-top':
                         /**
                         * hook - blogmatic_scroll_to_top_hook
                         * 
                         * @hooked - blogmatic_scroll_to_top_html - 10
                         */
                        if( has_action( 'blogmatic_scroll_to_top_hook' ) ) do_action( 'blogmatic_scroll_to_top_hook' );
                        break;
                endswitch;
            }
        }
    endif;