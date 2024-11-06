<?php
    /**
     * Adds post meta and title in single
     * 
     * @since 1.0.0
     * @package Blogmatic Pro
    */

    use Blogmatic\CustomizerDefault as BMC;
    $single_category_option = BMC\blogmatic_get_customizer_option( 'single_category_option' );
    $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
    $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';

    /* Category */
    if( $single_category_option && ( ( ! in_array( $single_post_layout, [ 'layout-one', 'layout-six' ] ) && $single_layout_post_meta == 'customizer-layout' ) || ! in_array( $single_layout_post_meta, [ 'layout-one', 'customizer-layout', 'layout-six' ] ) ) ) :
        blogmatic_get_post_categories( get_the_ID(), 20 );
    endif;

    /* Title */
    if( BMC\blogmatic_get_customizer_option( 'single_title_option' ) ) :
        $single_title_tag = BMC\blogmatic_get_customizer_option( 'single_title_tag' );
        the_title( '<' .esc_html( $single_title_tag ). ' class="entry-title" ' .blogmatic_schema_article_name_attributes(). '>', '</' .esc_html( $single_title_tag ). '>' );
    endif;

    /* Meta */
    $single_author_option = BMC\blogmatic_get_customizer_option( 'single_author_option' );
    $single_date_option = BMC\blogmatic_get_customizer_option( 'single_date_option' );
    $single_read_time_option = BMC\blogmatic_get_customizer_option( 'single_read_time_option' );
    $single_comments_option = BMC\blogmatic_get_customizer_option( 'single_comments_option' );
    if( $single_author_option || $single_date_option || $single_read_time_option || $single_comments_option ) :
        ?>
            <div class="post-meta-wrap">
                <?php 
                    /* Author */
                    if( BMC\blogmatic_get_customizer_option( 'single_author_option' ) ) blogmatic_posted_by( 'single-layout-two', get_the_ID() ); 

                    /* Category */
                    if( $single_category_option && ( ( $single_post_layout === 'layout-six' && $single_layout_post_meta === 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-six' ] ) ) ) :
                        blogmatic_get_post_categories( get_the_ID(), 20 );
                    endif;

                    if( $single_date_option || $single_read_time_option || $single_comments_option ) : ?>
                        <span class="post-meta">
                            <?php
                                /* Date */
                                if( BMC\blogmatic_get_customizer_option( 'single_date_option' ) ) blogmatic_posted_on();

                                /* Read Time */
                                if( BMC\blogmatic_get_customizer_option( 'single_read_time_option' ) ) :
                                    $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
                                    $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
                                    $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogmatic_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
                                    if( BMC\blogmatic_get_customizer_option( 'single_read_time_icon' ) ) {
                                        $single_read_time_icon = BMC\blogmatic_get_customizer_option( 'single_read_time_icon' );
                                        $icon_html = blogmatic_get_icon_control_html($single_read_time_icon);
                                        if( $icon_html ) $read_time = $icon_html . $read_time;
                                    }
                                    echo '<span class="post-read-time">' .$read_time. '</span>';
                                endif;

                                /* Comments */
                                if( BMC\blogmatic_get_customizer_option( 'single_comments_option' ) ) :
                                    $comments_num = '<span class="comments-context">' .get_comments_number( get_the_ID() ). '</span>';
                                    if( BMC\blogmatic_get_customizer_option( 'single_comments_icon' ) ) {
                                        $single_comments_icon = BMC\blogmatic_get_customizer_option( 'single_comments_icon' );
                                        $icon_html = blogmatic_get_icon_control_html($single_comments_icon);
                                        if( $icon_html ) $comments_num = $icon_html . $comments_num ;
                                    }
                                    echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                                endif;
                            ?>
                        </span>
                    <?php
                    endif;
                ?>
            </div>
        <?php
    endif;