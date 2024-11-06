<?php
/**
 * Blogmatic Single
 * 
 * @since 1.0.0
 */
namespace Blogmatic;
if( ! class_exists( 'Single' ) ):
    /**
     * Handle everything related to single
     * 
     * @since 1.0.0
     */
    class Single {
        /**
         * Post id
         * 
         * @since 1.0.0
         */
        public $id = get_the_ID();

        /**
         * Method that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __constructor() {

        }

        /**
         * Render single
         * 
         * @since 1.0.0
         */
        public function render() {
            get_header();
            
            get_footer();
        }

        /**
         * Get single Title
         * 
         * @since 1.0.0
         */
        public function title() {
            
        }

        /**
         * Get single author
         * 
         * @since 1.0.0
         */
        public function author() {

        }

        /**
         * Get single date
         * 
         * @since 1.0.0
         */
        public function date() {

        }

        /**
         * Get single read time
         * 
         * @since 1.0.0
         */
        public function read_time() {

        }

        /**
         * Get single comment
         * 
         * @since 1.0.0
         */
        public function comment() {

        }
    }
endif;