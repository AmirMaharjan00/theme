<?php
    /**
     * Base class for responsive header builder
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    namespace Blogmatic_Builder;
    require 'header-builder.php';
    use Blogmatic\CustomizerDefault as BMC;
    if( ! class_exists( 'Responsive_Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Responsive_Header_Builder_Render extends Header_Builder_Render {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BMC\blogmatic_get_customizer_option( 'responsive_header_builder' );
                $this->builder_value = $this->original_value;
                $this->responsive = 'tablet';
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Opening div
             * 
             * @since 1.0.0
             */
            protected function opening_div() {
                $wrapperClass = $this->prefix_class . '-responsive';
                echo '<div class="'. esc_attr( $wrapperClass ) .'">';
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
                    case 'toggle-button':
                        /**
                         * Function - blogmatic_get_toggle_button_html
                         */
                        return blogmatic_get_toggle_button_html();
                        break;
                endswitch;
            }

            /**
             * Mobile canvas
             * 
             * @since 1.0.0
             */
            public function get_mobile_canvas() {
                $rowClass = $this->prefix_class . 'row';
                $rowClass .= ' mobile-canvas';
                $responsive_header_builder = BMC\blogmatic_get_customizer_option( 'responsive_header_builder' );
                $mobile_canvas_alignment = BMC\blogmatic_get_customizer_option( 'mobile_canvas_alignment' );
                $rowClass .= ' alignment--' . $mobile_canvas_alignment;
                $canvas = $responsive_header_builder['responsive-canvas'];
                $only_widgets = array_reduce( $this->original_value, 'array_merge', [] );
                if( ! in_array( 'toggle-button', $only_widgets ) ) return;
                ?>
                    <div class="<?php echo esc_attr( $rowClass ); ?>">
                        <?php
                            if( ! empty( $canvas ) && is_array( $canvas ) ) :
                                foreach( $canvas as $widget_index => $widget ) :
                                    $this->render_widget( $widget, $widget_index );
                                endforeach;
                            endif;
                        ?>
                    </div>
                <?php
            }
        }
    endif;