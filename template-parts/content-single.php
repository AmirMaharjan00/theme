<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
$single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
$single_post_content_alignment = BMC\blogmatic_get_customizer_option( 'single_post_content_alignment' );
$social_share_display_type = BMC\blogmatic_get_customizer_option( 'social_share_display_type' );
$social_share_position = BMC\blogmatic_get_customizer_option( 'social_share_position' );
?>
<article <?php blogmatic_schema_article_attributes(); ?> id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">
		<?php
			$single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
			$single_image_size = BMC\blogmatic_get_customizer_option( 'single_image_size' );
			if( ( in_array( $single_post_layout, [ 'layout-one' ] ) && $single_layout_post_meta == 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-one' ] ) ) :
				$single_thumbnail_option = BMC\blogmatic_get_customizer_option( 'single_thumbnail_option' );
				$single_category_option = BMC\blogmatic_get_customizer_option( 'single_category_option' );
				if( $single_thumbnail_option ) :
						?>
						<header class="entry-header" >
							<?php
								blogmatic_post_thumbnail( $single_image_size );
								if( $single_category_option ) blogmatic_get_post_categories( get_the_ID(), 20 );
							?>
						</header><!-- .entry-header -->
					<?php
				endif;
				get_template_part( 'template-parts/single/partial', 'meta' );
			endif;

			if( ( in_array( $single_post_layout, [ 'layout-six' ] ) && $single_layout_post_meta == 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-six' ] ) ) :
				blogmatic_post_thumbnail( $single_image_size );
			endif;

			// social share
			$elementClass = 'post-format-ss-wrap';
			$elementClass .= ' display--' . $social_share_display_type;
			$elementClass .= ' position--' . $social_share_position;
			echo '<div class="'. esc_attr( $elementClass ) .'">';
				/**
				 * Hook - blogmatic_social_share_hook
				 * File - hooks.php
				 * 
				 * @since 1.0.0
				 */
				if( has_action( 'blogmatic_social_share_hook' ) && has_post_thumbnail() ) do_action( 'blogmatic_social_share_hook' );
			echo '</div><!-- .post-format-ss-wrap -->';

			// table of content
			$toc_option = BMC\blogmatic_get_customizer_option( 'toc_option' );
            $toc_heading_option = BMC\blogmatic_get_customizer_option( 'toc_heading_option' );
            $toc_hierarchical = BMC\blogmatic_get_customizer_option( 'toc_hierarchical' );
            $toc_list_type = BMC\blogmatic_get_customizer_option( 'toc_list_type' );
            $toc_display_type = BMC\blogmatic_get_customizer_option( 'toc_display_type' );
            $toc_enable_accordion = BMC\blogmatic_get_customizer_option( 'toc_enable_accordion' );
            $toc_default_toggle = BMC\blogmatic_get_customizer_option( 'toc_default_toggle' );
            $toc_open_icon = BMC\blogmatic_get_customizer_option( 'toc_open_icon' );
            $toc_close_icon = BMC\blogmatic_get_customizer_option( 'toc_close_icon' );
			$show_table_of_content_label_on_mobile = BMC\blogmatic_get_customizer_option( 'show_table_of_content_label_on_mobile' );
			$hide_on_mobile = ( ! $show_table_of_content_label_on_mobile ) ? ' hide-on-mobile': '';
			if( $toc_option && str_contains( get_the_content(), 'wp-block-heading' ) ) :
				$elementClass = 'blogmatic-table-of-content';
				$elementClass .= ' list-type--' . $toc_list_type;
				$elementClass .= ' display--' . $toc_display_type;
				$elementClass .= ' table-view--'. $toc_hierarchical;
				if( $toc_enable_accordion ) $elementClass .= ' accordion--enabled';
				?>
					<div class="<?php echo esc_attr( $elementClass ); ?>">
						<span class="toc-fixed-icon">
							<span class="toc-fixed-title<?php echo esc_attr( $hide_on_mobile ); ?>"><?php echo esc_html__( 'Table of content', 'blogmatic-pro' ); ?></span>
							<i class="fa-solid fa-list-check"></i>
						</span>
						<div class="toc-wrapper">
							<div class="table-of-content-title-wrap">
								<h2 class="toc-title"><?php echo esc_html( $toc_heading_option ); ?></h2>
								<?php if( $toc_enable_accordion && $toc_close_icon['type'] != 'none' && ! $toc_default_toggle ) echo '<span class="toc-icon"><i class="'. esc_attr( $toc_close_icon['value'] ) .'"></i></span>'; ?>
								<?php if( $toc_enable_accordion && $toc_close_icon['type'] != 'none' && $toc_default_toggle ) echo '<span class="toc-icon"><i class="'. esc_attr( $toc_open_icon['value'] ) .'"></i></span>'; ?>
							</div>
							<div class="table-of-content-list-wrap" <?php if( $toc_enable_accordion ) echo 'style="display:'. ( esc_attr( $toc_default_toggle ) ? 'block' : 'none' ) .'"'; ?>></div>
						</div>
					</div>
				<?php
			endif;
		?>
		<div <?php blogmatic_schema_article_body_attributes(); ?> class="entry-content<?php echo esc_attr( ' content-alignment--' . $single_post_content_alignment ); ?>">
			<?php
				do_action( 'blogmatic_before_single_content_hook' );
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogmatic-pro' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				do_action( 'blogmatic_after_single_content_hook' );

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogmatic-pro' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
				$tag_count = get_tags([ 'object_ids' => get_the_ID() ]);
				if( count( $tag_count ) != 0 ) :
					blogmatic_tags_list();
				endif;
					blogmatic_entry_footer();
			?>
		</footer><!-- .entry-footer -->

	</div>

	<?php
		$author_box_option = BMC\blogmatic_get_customizer_option( 'single_author_box_option' );
		$single_author_image_option = BMC\blogmatic_get_customizer_option( 'single_author_box_image_option' );
		$single_author_title_option = BMC\blogmatic_get_customizer_option( 'single_author_info_box_title_option' );
		$single_author_description_option = BMC\blogmatic_get_customizer_option( 'single_author_info_box_description_option' );
		if( $author_box_option ) : 
	?>
			<div class="post-card author-wrap">
				<div class="bmm-author-thumb-wrap">
					<?php
						if( $single_author_image_option ) echo '<figure class="post-thumb">'. get_avatar( get_the_author_meta( 'ID' ) ) .'</figure>';
					?>
					<div class="author-elements">
						<?php
							if( $single_author_title_option ) echo '<h2 class="author-name"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. get_the_author() .'</a></h2>';
							if( $single_author_description_option && ! empty( get_the_author_meta( 'description' ) ) ) echo '<div class="author-desc">'. get_the_author_meta( 'description' ) .'</div>';
						?>
					</div>
				</div>
			</div>
		<?php endif;
		

		$post_navigation_option = BMC\blogmatic_get_customizer_option( 'single_post_navigation_option' );
		if( $post_navigation_option ) :
			$post_navigation_thumbnail_option = BMC\blogmatic_get_customizer_option( 'single_post_navigation_thumbnail_option' );
			$post_navigation_date_option = BMC\blogmatic_get_customizer_option( 'single_post_navigation_show_date' );
			$prev_post_date = $prev_post_thumbnail = $prev_post_navigation_sub_title = '';
			$next_post_date = $next_post_thumbnail = $next_post_navigation_sub_title = '';
			$previous = get_previous_post();
			$next = get_next_post();
			
			// date
			if( $post_navigation_date_option ) :
				$prev_post_date = ! empty( $previous ) ? '<span class="nav-post-date">' . blogmatic_posted_on( $previous->ID, '', [ 'return' => true ] ) . '</span>' : '';
				$next_post_date = ! empty( $next ) ? '<span class="nav-post-date">' . blogmatic_posted_on( $next->ID, '', [ 'return' => true ] ) . '</span>' : '';
			endif;

			// thumbnail
			if( $post_navigation_thumbnail_option ) :
				$prev_post_thumbnail = ( ! empty( $previous ) ) ? get_the_post_thumbnail_url( $previous->ID ) : '';
				$next_post_thumbnail = ( ! empty( $next ) ) ? get_the_post_thumbnail_url( $next->ID  ) : '';
			endif;

			// sub-title
			$prev_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-left"></i></span>';
			$next_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-right"></i></span>';

			// title
			$post_navigation_title = '<span class="nav-title">%title</span>';	
			
			echo get_the_post_navigation(
				[
					'prev_text' => '<div class="button-thumbnail">'. $prev_post_navigation_sub_title .'<figure class="nav-thumb" style="background-image:url('. $prev_post_thumbnail .')"></figure></div><div class="nav-post-elements">'. $prev_post_date . '<div class="nav-title-wrap">' . $post_navigation_title. '</div></div>',
					'next_text' => '<div class="nav-post-elements">'. $next_post_date . '<div class="nav-title-wrap">' . $post_navigation_title .'</div></div><div class="button-thumbnail"><figure class="nav-thumb" style="background-image:url('. $next_post_thumbnail .')"></figure>'. $next_post_navigation_sub_title .'</div>'
				]
			);
		endif;
	?>
		
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php
	/**
	 * hook - blogmatic_single_post_append_hook
	 * 
	 * @since 1.0.0
	 */
	do_action( 'blogmatic_single_post_append_hook' );