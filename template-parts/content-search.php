<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
$custom_class = 'has-featured-image';
if( ! has_post_thumbnail() ) $custom_class = 'no-featured-image';
$archive_excerpt_on_mobile = BMC\blogmatic_get_customizer_option( 'show_archive_excerpt_mobile_option' );
$archive_readtime_on_mobile = BMC\blogmatic_get_customizer_option( 'show_readtime_mobile_option' );
$archive_comment_number_on_mobile = BMC\blogmatic_get_customizer_option( 'show_comment_number_mobile_option' );

$excerpt_hide_on_mobile = ( ! $archive_excerpt_on_mobile ) ? '  hide-on-mobile' : '';
$readtime_hide_on_mobile = ( ! $archive_readtime_on_mobile ) ? ' hide-on-mobile' : '';
$comment_number_hide_on_mobile = ( ! $archive_comment_number_on_mobile ) ? ' hide-on-mobile' : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?>>
    <div class="blogmatic-article-inner blogmatic-article-inner">
        <figure class="post-thumbnail-wrapper">
            <div class="post-thumnail-inner-wrapper">
                <?php
                    $archive_image_size = BMC\blogmatic_get_customizer_option( 'archive_image_size' );
                    blogmatic_post_thumbnail( $archive_image_size );
                ?>        
            </div>
                <?php
                if( BMC\blogmatic_get_customizer_option( 'archive_category_option' ) ) blogmatic_get_post_categories(get_the_ID());
            ?>
        </figure>
        <div class="inner-content">
            <div class="content-wrap">
                <?php
                    if( BMC\blogmatic_get_customizer_option( 'archive_date_option' ) ) blogmatic_posted_on();
                    if( BMC\blogmatic_get_customizer_option( 'archive_title_option' ) ) :
                        $archive_title_tag = BMC\blogmatic_get_customizer_option( 'archive_title_tag' );
                        the_title( '<' .esc_html( $archive_title_tag ). ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' .esc_html( $archive_title_tag ). '>' );
                    endif;
                    if( BMC\blogmatic_get_customizer_option( 'archive_excerpt_option' ) ) {
                        echo '<div class="post-excerpt'. esc_attr( $excerpt_hide_on_mobile ) .'">';
                            the_excerpt();
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="post-meta">
                <?php
                    if( BMC\blogmatic_get_customizer_option( 'archive_author_option' ) ) blogmatic_posted_by();
                    ?>
                <span class="post-meta">
                    <?php
                        if( BMC\blogmatic_get_customizer_option( 'archive_read_time_option' ) ) :
                            $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
                            $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
                            $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogmatic_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
                            if( BMC\blogmatic_get_customizer_option( 'archive_read_time_icon' ) ) {
                                $archive_read_time_icon = BMC\blogmatic_get_customizer_option( 'archive_read_time_icon' );
                                $icon_html = blogmatic_get_icon_control_html($archive_read_time_icon);
                                if( $icon_html ) $read_time = $read_time . $icon_html;
                            }
                            echo '<span class="post-read-time'. esc_attr( $archive_readtime_on_mobile ) .'">' .$read_time. '</span>';
                        endif;

                        if( BMC\blogmatic_get_customizer_option( 'archive_comments_option' ) ) :
                            $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                            if( BMC\blogmatic_get_customizer_option( 'archive_comments_icon' ) ) {
                                $archive_comments_icon = BMC\blogmatic_get_customizer_option( 'archive_comments_icon' );
                                $icon_html = blogmatic_get_icon_control_html($archive_comments_icon);
                                if( $icon_html ) $comments_num = $comments_num . $icon_html;
                            }
                            echo '<a class="post-comments-num'. esc_attr( $comment_number_hide_on_mobile ) .'" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                        endif;

                        /**
                     * hook - blogmatic_section_block_view_all_hook
                     * archive post button
                     */
                    if( has_action( 'blogmatic_section_block_view_all_hook' ) ) do_action( 'blogmatic_section_block_view_all_hook', [ 'show_button' => $archive_button_option ] );
                    ?>
                </span>
            </div>
        </div>
        <?php
            /**
             * hook - blogmatic_archive_button_html_hook
             * 
             * @since 1.0.0
             */
            do_action( 'blogmatic_archive_post_append_hook' );
        ?>
    </div>
</article>