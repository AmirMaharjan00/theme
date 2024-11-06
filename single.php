<?php
/**
 * Blogmatic Single
 * 
 * @since 1.0.0
 */
namespace Blogmatic;
use Blogmatic\CustomizerDefault as BMC;
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
        public $id;

        /**
         * Method that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __construct() {
			$this->render();
        }

        /**
         * Render single
         * 
         * @since 1.0.0
         */
        public function render() {
            get_header();
			?>
				<div class="blogmatic-main-wrap">
					<?php
						$this->outside_article();
						$this->inside_article();
					?>
				</div>
			<?php
            get_footer();
        }

		/**
		 * Inside article
		 * 
		 * @since 1.0.0
		 */
		public function inside_article() {
			?>
				<div class="blogmatic-container">
					<div class="row">
						<main id="primary" class="site-main">
							<div class="blogmatic-inner-content-wrap">
								<?php
									get_template_part( 'template-parts/single/article', 'inside' );
								?>
							</div>
						</main>
					</div>
				</div>
			<?php
		}

		/**
		 * outside article
		 * 
		 * @since 1.0.0
		 */
		public function outside_article() {
			?>
				<div class="blogmatic-container">
					<div class="row">
						<header class="entry-header">
							<div class="single-header-content-wrap">
								<?php
									get_template_part( 'template-parts/single/article', 'outside' );
								?>
							</div>
						</header>
					</div>
				</div>
			<?php
		}
    }
	new Single();
endif;