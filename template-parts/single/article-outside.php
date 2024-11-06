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
require_once 'base.php';

if( ! class_exists( 'Outside_Article' ) ) :
	/**
	 * Handles Article
	 * 
	 * @since 1.0.0
	 */
	class Outside_Article extends Base {
		/**
		 * Method that gets called when class is instantiated
		 * 
		 * @since 1.0.0
		 */
		public function __construct() {
			echo 'Outside Article';
		}
	}
	new Outside_Article();
endif;