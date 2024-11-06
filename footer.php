<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
require get_template_directory() . '/builder/footer-builder.php';
use Blogmatic_Builder as BB;

if( did_action( 'elementor/loaded' ) && class_exists( 'Nekit_Render_Templates_Html' ) ) :
	$Nekit_render_templates_html = new Nekit_Render_Templates_Html();
	if( $Nekit_render_templates_html->is_template_available('footer') ) {
		$footer_rendered = true;
		echo $Nekit_render_templates_html->current_builder_template();
	} else {
		$footer_rendered = false;
	}
else :
	$footer_rendered = false;
endif;

if( ! $footer_rendered ) :

	/**
	 * Function - blogmatic_get_video_playlist_below_archive
	 * File - hooks.php
	 * 
	 * @since 1.0.0
	 */
	blogmatic_get_video_playlist_below_archive();

	$footer_builder_section_width = BMC\blogmatic_get_customizer_option( 'footer_builder_section_width' );
	$footerClass = 'site-footer dark_bk';
	$footerClass .= ' ' . $footer_builder_section_width;
	?>
		<footer id="colophon" class="<?php echo esc_attr( $footerClass ); ?>">
			<div class="blogmatic-container">
				<div class="row">
					<?php
						new BB\Footer_Builder_Render();
					?>
				</div>
			</div>
		</footer><!-- #colophon -->
		<?php
			/**
			 * hook - blogmatic_animation_hook
			 * 
			 * hooked - blogmatic_get_background_and_cursor_animation
			 */
			do_action( 'blogmatic_animation_hook' );
		?>
<?php
endif;
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
