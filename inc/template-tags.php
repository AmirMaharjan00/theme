<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;

 if ( ! function_exists( 'blogmatic_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blogmatic_posted_on( $post_id = '', $for = '', $args = [] ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time = $post_id ? get_the_time( 'U', $post_id ) : get_the_time( 'U' );
		$modified_time = $post_id ? get_the_modified_time( 'U', $post_id ) : get_the_modified_time( 'U' );
		if ( $time !== $modified_time ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$hide_on_mobile = '';
		if( array_key_exists( 'hide_on_mobile', $args ) ) :
            $hide_on_mobile = ( ! $args['hide_on_mobile'] ) ? ' hide-on-mobile' : '';
        endif;
		$time_string = sprintf(
			$time_string,
			esc_attr( $post_id ? get_the_date( DATE_W3C, $post_id ) : get_the_date( DATE_W3C ) ),
			esc_html( blogmatic_get_published_date($post_id) ),
			esc_attr( $post_id ? get_the_modified_date( DATE_W3C, $post_id ) : get_the_modified_date( DATE_W3C ) ),
			esc_html( blogmatic_get_modified_date($post_id) )
		);
		$year = get_the_date( 'Y' );
		$month = get_the_date( 'm' );
		$posted_on = '<a href="' . esc_url( get_month_link( $year, $month ) ) . '" rel="bookmark">' . $time_string . '</a>';
		if( $for == 'banner' ) { 
			$main_banner_date_icon = BMC\blogmatic_get_customizer_option( 'main_banner_date_icon' );
			$icon_html = blogmatic_get_icon_control_html( $main_banner_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'carousel' ) {
			$carousel_date_icon = BMC\blogmatic_get_customizer_option( 'carousel_date_icon' );
			$icon_html = blogmatic_get_icon_control_html( $carousel_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'you-may-have-missed' ) {
			$you_may_have_missed_date_icon = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_date_icon' );
			$icon_html = blogmatic_get_icon_control_html( $you_may_have_missed_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		}else if( is_home() || is_archive() || is_search() ) {
			$archive_date_icon = BMC\blogmatic_get_customizer_option( 'archive_date_icon' );
			$icon_html = blogmatic_get_icon_control_html( $archive_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( is_single() ) {
			$single_date_icon = BMC\blogmatic_get_customizer_option( 'single_date_icon' );
			$icon_html = blogmatic_get_icon_control_html( $single_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		}

		if( array_key_exists( 'icon_html', $args ) ) :
			$posted_on = $args['icon_html'] . $posted_on;
		endif;

		if( array_key_exists( 'return', $args ) && $args['return'] ) :
			$posted_on = $icon_html . '<span class="post-nav-time-string">'. $time_string .'</span>';
			return '<span class="post-date posted-on'. esc_attr( $hide_on_mobile ) .' '.esc_attr( BMC\blogmatic_get_customizer_option( 'site_date_to_show' ) ). '">' . $posted_on . '</span>';
		else:
			echo '<span class="post-date posted-on'. esc_attr( $hide_on_mobile ) .' '.esc_attr( BMC\blogmatic_get_customizer_option( 'site_date_to_show' ) ). '">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
	}
endif;

if ( ! function_exists( 'blogmatic_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function blogmatic_posted_by( $for = '', $blogmatic_post_id = 0 ) {
		$show_author_meta_text_on_mobile = BMC\blogmatic_get_customizer_option( 'show_author_meta_text' );
		$hide_on_mobile = ( ! $show_author_meta_text_on_mobile ) ? ' hide-on-mobile' : '';
		if( $blogmatic_post_id > 0 ) :
			$author_id = get_post_field( 'post_author', $blogmatic_post_id );
		else :
			$author_id = get_the_author_meta( 'ID' );
		endif;
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'blogmatic-pro' ),
			'<span class="author vcard'. esc_attr( $hide_on_mobile ) .'"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
		);

		if( $for == 'banner' ) {
			$banner_author_options = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_author_image' );
			if( $banner_author_options ):
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
		} else if( $for == 'carousel' ) {
			$carousel_author_options = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_author_image' );
			if( $carousel_author_options ):
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
		} else {
			if( is_home() || is_archive() ) :
				$archive_author_image_option = BMC\blogmatic_get_customizer_option( 'archive_author_image_option' );
				if( $archive_author_image_option ) {
					$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
					if( $author_image ) $byline = $author_image . $byline;
				}
			endif;
	
			if( is_single() ) :
				$single_author_image_option = BMC\blogmatic_get_customizer_option( 'single_author_image_option' );
				if( $single_author_image_option ) {
					$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
					if( $author_image ) $byline = $author_image . $byline;
				}
			endif;
	
			if( is_search() ) :
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
		}

		$archive_author_text_on_mobile = BMC\blogmatic_get_customizer_option( 'show_archive_author_mobile_option' );
		$hide_on_mobile = ( ! $archive_author_text_on_mobile ) ? ' hide-on-mobile' : '';

		echo '<span class="byline'. esc_attr( $hide_on_mobile ) .'"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if( ! function_exists( 'blogmatic_tags_list' ) ) :
	/**
	 * print the html for tags list
	 */
	function blogmatic_tags_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ' ' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'blogmatic-pro' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'blogmatic_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogmatic_entry_footer() {
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
	}
endif;

if ( ! function_exists( 'blogmatic_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function blogmatic_post_thumbnail( $size = 'thumbnail' ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<div class="post-thumbnail<?php if( ! has_post_thumbnail() ) echo ' no-single-featured-image'; ?>">
				<?php the_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if( ! function_exists( 'blogmatic_get_published_date' ) ) :
	// Get post pusblished date
	function blogmatic_get_published_date($post_id='') {
		$site_date_format = BMC\blogmatic_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
												$post_id ? get_the_date('', $post_id) : get_the_date() : 
												human_time_diff($post_id ? get_the_time('U',$post_id) : get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'blogmatic-pro');
		return apply_filters( "blogmatic_inherit_published_date", $n_date );
	}
endif;

if( ! function_exists( 'blogmatic_get_modified_date' ) ) :
	// Get post pusblished date
	function blogmatic_get_modified_date($post_id='') {
		$site_date_format = BMC\blogmatic_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
											$post_id ? get_the_modified_date('', $post_id) : get_the_modified_date() : 
												human_time_diff($post_id ? get_the_modified_time('U', $post_id): get_the_modified_time('U'), current_time('timestamp')) .' '. __('ago', 'blogmatic-pro');
		return apply_filters( "blogmatic_inherit_published_date", $n_date );
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
