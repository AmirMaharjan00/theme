<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;

get_header();

if( did_action( 'elementor/loaded' ) && class_exists( 'Nekit_Render_Templates_Html' ) ) :
	$Nekit_render_templates_html = new Nekit_Render_Templates_Html();
	if( $Nekit_render_templates_html->is_template_available('404') ) {
		$single_rendered = true;
		echo $Nekit_render_templates_html->current_builder_template();
	} else {
		$single_rendered = false;
	}
else :
	$single_rendered = false;
endif;

if( ! $single_rendered ) :
	do_action( 'blogmatic_main_content_opening' );
	$error_page_sidebar_layout = BMC\blogmatic_get_customizer_option( 'error_page_sidebar_layout' );
	$error_page_title_text = BMC\blogmatic_get_customizer_option( 'error_page_title_text' );
	$error_page_content_text = BMC\blogmatic_get_customizer_option( 'error_page_content_text' );
	$error_page_button_show_hide = BMC\blogmatic_get_customizer_option( 'error_page_button_show_hide' );
	$error_page_button_text = BMC\blogmatic_get_customizer_option( 'error_page_button_text' );
	$error_page_button_icon = BMC\blogmatic_get_customizer_option( 'error_page_button_icon' );
	$error_page_button_icon_context = BMC\blogmatic_get_customizer_option( 'error_page_button_icon_context' );
	if( in_array( $error_page_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
	?>
		<main id="primary" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<?php if( ! empty( $error_page_title_text ) ) : ?>
						<h1 class="page-title"><?php echo esc_html( $error_page_title_text ); ?></h1>
					<?php endif; ?>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php
						$error_page_image = BMC\blogmatic_get_customizer_option( 'error_page_image' );
						if( $error_page_image != 0 ) {
							echo wp_get_attachment_image( $error_page_image, 'full' );
						}
					?>
					<p><?php if( ! empty( $error_page_content_text ) ) echo esc_html( $error_page_content_text ); ?></p>
					<?php if( $error_page_button_show_hide ) : ?>
						<div class="back_to_home_btn">
							<a href="<?php echo esc_url( home_url() ); ?>">
								<?php
									if( $error_page_button_icon_context == 'prefix' ) echo blogmatic_get_icon_control_html( $error_page_button_icon );
									
									if( ! empty( $error_page_button_text ) ) echo '<span class="button-label">'. esc_html( $error_page_button_text ) .'</span>';

									if( $error_page_button_icon_context == 'suffix' ) echo blogmatic_get_icon_control_html( $error_page_button_icon );
								?>
							</a>	
						</div>
					<?php endif; ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->

	<?php
	if( in_array( $error_page_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
	do_action( 'blogmatic_main_content_closing' );
endif;

get_footer();