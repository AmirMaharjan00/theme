<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
namespace Blogmatic;
use Blogmatic\CustomizerDefault as BMC;

if( ! class_exists( 'Base' ) ) :
	/**
	 * Handles Article
	 * 
	 * @since 1.0.0
	 */
	class Base {
		/**
		 * Method that gets called when class is instantiated
		 * 
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->title();
		}

		/**
         * Get single Title
         * 
         * @since 1.0.0
         */
        public function title() {
			$single_title_tag = BMC\blogmatic_get_customizer_option( 'single_title_tag' );
			the_title( '<' .esc_html( $single_title_tag ). ' class="entry-title" ' .blogmatic_schema_article_name_attributes(). '>', '</' .esc_html( $single_title_tag ). '>' );
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