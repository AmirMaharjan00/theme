<?php
/**
 * Responsive Builder Control
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
if( ! class_exists( 'Blogmatic_WP_Responsive_Builder_Control' ) ) :
    class Blogmatic_WP_Responsive_Builder_Control extends Blogmatic_WP_Base_Control {
        // control type
        public $type = 'responsive-builder';
        public $widgets = [];
        public $placement = 'header';
        public $related_section = [
            'count'	=>	'_row_count',
            'layout'	=>	'_row_column_layout'
        ];
        public $builder_settings_section = '';
        public $responsive_canvas_id = '';
        public $responsive_section = '';

        /**
         * Loads the jQuery UI button script and custom scripts/styles
         * 
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'blogmatic-responsive-builder-js', get_template_directory_uri() . '/inc/customizer/custom-controls/responsive-builder/responsive-builder.js', ['jquery'], BLOGMATIC_VERSION, true );
        }
    
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['widgets'] = $this->widgets;
            $this->json['placement'] = $this->placement;
            $this->json['related_section'] = $this->related_section;
            $this->json['builder_settings_section'] = $this->builder_settings_section;
            $this->json['responsive_canvas_id'] = $this->responsive_canvas_id;
            $this->json['responsive_section'] = $this->responsive_section;
        }
    }
endif;