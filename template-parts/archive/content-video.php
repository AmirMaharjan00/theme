<?php
/**
 * Template part for displaying posts with video format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
$custom_class = 'has-featured-image';
if( ! has_post_thumbnail() ) $custom_class = 'no-featured-image';
$archive_post_layout = BMC\blogmatic_get_customizer_option( 'archive_post_layout' );
$archive_excerpt_length = BMC\blogmatic_get_customizer_option( 'archive_excerpt_length' );
$archive_excerpt_on_mobile = BMC\blogmatic_get_customizer_option( 'show_archive_excerpt_mobile_option' );
$archive_readtime_on_mobile = BMC\blogmatic_get_customizer_option( 'show_readtime_mobile_option' );
$archive_comment_number_on_mobile = BMC\blogmatic_get_customizer_option( 'show_comment_number_mobile_option' );
$archive_show_social_share = BMC\blogmatic_get_customizer_option( 'archive_show_social_share' );
$archive_button_option = BMC\blogmatic_get_customizer_option( 'archive_button_option' );

$excerpt_hide_on_mobile = ( ! $archive_excerpt_on_mobile ) ? ' hide-on-mobile' : '';
$readtime_hide_on_mobile = ( ! $archive_readtime_on_mobile ) ? ' hide-on-mobile' : '';
$comment_number_hide_on_mobile = ( ! $archive_comment_number_on_mobile ) ? ' hide-on-mobile' : '';
$show_archive_category_in_mobile = $show_archive_date_in_mobile = '';
if( array_key_exists( 'archive', $args ) && $args['archive'] ) :
    $show_archive_category_in_mobile = BMC\blogmatic_get_customizer_option( 'show_archive_category_in_mobile' );
    $show_archive_date_in_mobile = BMC\blogmatic_get_customizer_option( 'show_archive_date_in_mobile' );
endif;
$current_id = get_queried_object_id();
$archive_layout_meta = 'customizer-layout';
if( is_category() ) :
    $archive_meta_key = '_blogmatic_category_archive_custom_meta_field';
    $archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
elseif ( is_tag() ) :
    $archive_meta_key = '_blogmatic_post_tag_archive_custom_meta_field';
    $archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
endif;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?> <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
    <div class="blogmatic-article-inner">
        <?php
            if( ( in_array( $archive_post_layout, [ 'block', 'list-two' ] ) && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && in_array( $archive_layout_meta, [ 'block', 'list-two' ] ) ) ) :
                if( ( $archive_post_layout == 'block' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta == 'block' ) ) {
                    echo '<div class="top-inner-content">';
                    if( BMC\blogmatic_get_customizer_option( 'archive_date_option' ) ) blogmatic_posted_on( '', '', [ 'hide_on_mobile' => $show_archive_date_in_mobile ] );
                }
                    if( BMC\blogmatic_get_customizer_option( 'archive_title_option' ) ) :
                        $archive_title_tag = BMC\blogmatic_get_customizer_option( 'archive_title_tag' );
                        the_title( '<' .esc_html( $archive_title_tag ). ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' .esc_html( $archive_title_tag ). '>' );
                    endif;
                if( ( $archive_post_layout == 'block' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta == 'block' ) ) echo '</div>';
            endif;
            if( ( $archive_post_layout == 'list-two' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta == 'list-two' ) ) echo '<div class="blog-inner-wrapper">';
        ?>
        <figure class="post-thumbnail-wrapper">
            <div class="post-thumnail-inner-wrapper">
                <?php
                    if( has_block('core/video') || has_block('core/embed') ) :
                        $blocksArray = parse_blocks( get_the_content() );
                        foreach( $blocksArray as $singleBlock ) :
                            if( 'core/video' === $singleBlock['blockName'] ) { echo wp_kses_post( apply_filters( 'the_content', render_block( $singleBlock ) ) ); break; }
                        endforeach;
                    else :
                        $archive_image_size = BMC\blogmatic_get_customizer_option( 'archive_image_size' );
                        blogmatic_post_thumbnail( $archive_image_size );
                    endif;
                ?>        
            </div>
            <?php
                if( BMC\blogmatic_get_customizer_option( 'archive_category_option' ) ) blogmatic_get_post_categories( get_the_ID(), 1, [ 'hide_on_mobile' => $show_archive_category_in_mobile ] );
                echo '<div class="post-format-ss-wrap">';
                    $control_id = is_string( blogmatic_get_post_format() ) ? blogmatic_get_post_format() . '_post_format_icon_picker' : 'standard_post_format_icon_picker';
                    $icon_picker = BMC\blogmatic_get_customizer_option( $control_id );
                    $post_format_icon = blogmatic_get_icon_control_html( $icon_picker );
                    $postFormatClass = 'post-format-icon';
                    if( ! empty( $icon_picker ) && is_array( $icon_picker ) && array_key_exists( 'type', $icon_picker ) && $icon_picker['type'] == 'svg' ) $postFormatClass .= ' type--svg';
                    if( $post_format_icon ) echo '<span class="'. esc_attr( $postFormatClass ) .'">'. $post_format_icon .'</span>';
                    echo '</div><!-- .post-format-ss-wrap -->';
                    /**
                     * Hook - blogmatic_social_share_hook
                     * File - hooks.php
                     * 
                     * @since 1.0.0
                     */
                    if( has_action( 'blogmatic_social_share_hook' ) && $archive_show_social_share ) do_action( 'blogmatic_social_share_hook' );
            ?>
        </figure>
        <div class="inner-content">
            <div class="content-wrap">
                <?php
                    if( ( $archive_post_layout != 'block' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta != 'block' ) ) :
                        if( BMC\blogmatic_get_customizer_option( 'archive_date_option' ) ) blogmatic_posted_on( '', '', [ 'hide_on_mobile' => $show_archive_date_in_mobile ] );
                        if( ( $archive_post_layout != 'list-two' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta != 'list-two' ) ) :
                            if( BMC\blogmatic_get_customizer_option( 'archive_title_option' ) ) :
                                $archive_title_tag = BMC\blogmatic_get_customizer_option( 'archive_title_tag' );
                                the_title( '<' .esc_html( $archive_title_tag ). ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' .esc_html( $archive_title_tag ). '>' );
                            endif;
                        endif;
                    endif;
                    // post meta
                    $archive_author_option = BMC\blogmatic_get_customizer_option( 'archive_author_option' );
                    $archive_read_time_option = BMC\blogmatic_get_customizer_option( 'archive_read_time_option' );
                    $archive_comments_option = BMC\blogmatic_get_customizer_option( 'archive_comments_option' );
                    if( $archive_author_option || $archive_read_time_option || $archive_comments_option ) : ?>
                        <div class="post-meta">
                            <?php
                                if( $archive_author_option ) blogmatic_posted_by(); 
                                if( $archive_read_time_option ) :
                                    $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
                                    $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
                                    $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogmatic_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
                                    if( BMC\blogmatic_get_customizer_option( 'archive_read_time_icon' ) ) {
                                        $archive_read_time_icon = BMC\blogmatic_get_customizer_option( 'archive_read_time_icon' );
                                        $icon_html = blogmatic_get_icon_control_html($archive_read_time_icon);
                                        if( $icon_html ) $read_time = $read_time . $icon_html;
                                    }
                                    echo '<span class="post-read-time'. esc_attr( $readtime_hide_on_mobile ) .'">' .$read_time. '</span>';
                                endif;

                                if( $archive_comments_option ) :
                                    $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                                    if( BMC\blogmatic_get_customizer_option( 'archive_comments_icon' ) ) {
                                        $archive_comments_icon = BMC\blogmatic_get_customizer_option( 'archive_comments_icon' );
                                        $icon_html = blogmatic_get_icon_control_html($archive_comments_icon);
                                        if( $icon_html ) $comments_num = $comments_num . $icon_html;
                                    }
                                    echo '<a class="post-comments-num'. esc_attr( $comment_number_hide_on_mobile ) .'" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                                endif;
                            ?>
                        </div>
                    <?php 
                    endif;
                    // post excerpt
                    if( BMC\blogmatic_get_customizer_option( 'archive_excerpt_option' ) ) {
                        echo '<div class="post-excerpt'. esc_attr( $excerpt_hide_on_mobile ) .'">';
                            echo wp_trim_words( get_the_excerpt(), $archive_excerpt_length );
                        echo '</div>';
                    }
                    /**
                     * hook - blogmatic_section_block_view_all_hook
                     * archive post button
                     */
                    if( has_action( 'blogmatic_section_block_view_all_hook' ) ) do_action( 'blogmatic_section_block_view_all_hook', [ 'show_button' => $archive_button_option ] );
                ?>
            </div>
        </div>
        <?php
            if( ( $archive_post_layout == 'list-two' && $archive_layout_meta == 'customizer-layout' ) || ( $archive_layout_meta != 'customizer-layout' && $archive_layout_meta == 'list-two' ) ) echo '</div><!-- .blog-inner-wrapper -->';
            /**
             * hook - blogmatic_archive_button_html_hook
             * 
             * @since 1.0.0
             */
            do_action( 'blogmatic_archive_post_append_hook' );
        ?>
    </div>
    <?php blogmatic_entry_footer(); ?>
</article>