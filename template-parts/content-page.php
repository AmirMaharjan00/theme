<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
$page_title_option = BMC\blogmatic_get_customizer_option( 'page_title_option' );
$page_title_tag = BMC\blogmatic_get_customizer_option( 'page_title_tag' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if( $page_title_option ) :
	?>
			<header class="entry-header">
				<?php the_title( '<' .esc_html( $page_title_tag ). ' class="entry-title">', '</' .esc_html( $page_title_tag ). '>' ); ?>
			</header><!-- .entry-header -->
	<?php
		endif;

		$page_thumbnail_option = BMC\blogmatic_get_customizer_option( 'page_thumbnail_option' );
		if( $page_thumbnail_option ) :
			$page_thumbnail_option = BMC\blogmatic_get_customizer_option( 'page_thumbnail_option' );
			$page_image_size = BMC\blogmatic_get_customizer_option( 'page_image_size' );
			if( has_post_thumbnail() ) blogmatic_post_thumbnail( $page_image_size );
		endif;

		// table of content
		$page_toc_option = BMC\blogmatic_get_customizer_option( 'page_toc_option' );
		$page_toc_heading_option = BMC\blogmatic_get_customizer_option( 'page_toc_heading_option' );
		$page_toc_hierarchical = BMC\blogmatic_get_customizer_option( 'page_toc_hierarchical' );
		$page_toc_list_type = BMC\blogmatic_get_customizer_option( 'page_toc_list_type' );
		$page_toc_display_type = BMC\blogmatic_get_customizer_option( 'page_toc_display_type' );
		$page_toc_enable_accordion = BMC\blogmatic_get_customizer_option( 'page_toc_enable_accordion' );
		$page_toc_default_toggle = BMC\blogmatic_get_customizer_option( 'page_toc_default_toggle' );
		$page_toc_open_icon = BMC\blogmatic_get_customizer_option( 'page_toc_open_icon' );
		$page_toc_close_icon = BMC\blogmatic_get_customizer_option( 'page_toc_close_icon' );
		$show_table_of_content_label_on_mobile = BMC\blogmatic_get_customizer_option( 'show_table_of_content_label_on_mobile' );
		$hide_on_mobile = ( ! $show_table_of_content_label_on_mobile ) ? ' hide-on-mobile': '';
		if( $page_toc_option && str_contains( get_the_content(), 'wp-block-heading' ) ) :
			$elementClass = 'blogmatic-table-of-content';
			$elementClass .= ' list-type--' . $page_toc_list_type;
			$elementClass .= ' display--' . $page_toc_display_type;
			$elementClass .= ' table-view--'. $page_toc_hierarchical;
			if( $page_toc_enable_accordion ) $elementClass .= ' accordion--enabled';
			?>
				<div class="<?php echo esc_attr( $elementClass ); ?>">
					<span class="toc-fixed-icon">
						<span class="toc-fixed-title<?php echo esc_attr( $hide_on_mobile ); ?>"><?php echo esc_html__( 'Table of content', 'blogmatic-pro' ); ?></span>
						<i class="fa-solid fa-list-check"></i>
					</span>
					<div class="toc-wrapper">
						<div class="table-of-content-title-wrap">
							<h2 class="toc-title"><?php echo esc_html( $page_toc_heading_option ); ?></h2>
							<?php
								$iconClass = 'toc-icon';
								$iconClass .= $page_toc_default_toggle ? ' open' : ' close';
								if( $page_toc_enable_accordion && $page_toc_close_icon['type'] != 'none' && $page_toc_open_icon['type'] != 'none' ) echo '<span class="'. esc_attr( $iconClass ) .'" ><i class="'. esc_attr( $page_toc_open_icon['value'] ) .'"></i></span>';
							?>
						</div>
						<div class="table-of-content-list-wrap" <?php if( $page_toc_enable_accordion ) echo 'style="display:'. ( esc_attr( $page_toc_default_toggle ) ? 'block' : 'none' ) .'"'; ?>></div>
					</div>
				</div>
			<?php
		endif;
	?>

	<div class="entry-content">
		<?php
			$page_content_option = BMC\blogmatic_get_customizer_option( 'page_content_option' );
			if( $page_content_option ) the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogmatic-pro' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'blogmatic-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
