<?php
/**
 * Theme hooks and functions
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;
if( ! function_exists( 'blogmatic_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     * @package Blogmatic Pro
     */
    function blogmatic_single_related_posts() {
        if( get_post_type() != 'post' ) return;
        $single_post_related_posts_option = BMC\blogmatic_get_customizer_option( 'single_post_related_posts_option' );
        if( ! $single_post_related_posts_option ) return;
        $related_posts_title = BMC\blogmatic_get_customizer_option( 'single_post_related_posts_title' );
        $related_posts_filter_by = BMC\blogmatic_get_customizer_option( 'related_posts_filter_by' );
        $related_posts_layouts = BMC\blogmatic_get_customizer_option( 'related_posts_layouts' );
        $related_posts_no_of_column = BMC\blogmatic_get_customizer_option( 'related_posts_no_of_column' );
        $related_posts_author_option = BMC\blogmatic_get_customizer_option( 'related_posts_author_option' );
        $related_posts_date_option = BMC\blogmatic_get_customizer_option( 'related_posts_date_option' );
        $related_posts_comment_option = BMC\blogmatic_get_customizer_option( 'related_posts_comment_option' );
        $related_posts_args = array(
            'posts_per_page'   => 4,
            'post__not_in'  => array( get_the_ID() ),
            'ignore_sticky_posts'    => true
        );
        if( $related_posts_filter_by == 'categories' ) :
            $post_categories = wp_get_post_categories( get_the_ID() );
            $related_posts_args['category__in'] = $post_categories;
        endif;
        if( $related_posts_filter_by == 'tags' ) :
            $post_tags = wp_get_post_tags( get_the_ID() );
            if( ! empty( $post_tags ) && is_array( $post_tags ) ) :
                foreach( $post_tags as $tag ) :
                    $tags_arg[] = $tag->term_id;
                endforeach;
                $related_posts_args['tag__in'] = $tags_arg;
            endif;
        endif;
        $related_posts = new WP_Query( apply_filters( 'blogmatic_query_args_filter', $related_posts_args ) );
        if( ! $related_posts->have_posts() ) return;
        $elementClass = 'single-related-posts-section-wrap layout--list';
        $elementClass .= ' layout--'. $related_posts_layouts;
        $elementClass .= ' column--' . blogmatic_convert_number_to_numeric_string( $related_posts_no_of_column );
  ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <div class="single-related-posts-section">
                    <?php
                        if( $related_posts_title ) echo '<h2 class="blogmatic-block-title"><span>' .esc_html( $related_posts_title ). '</span></h2>';
                            echo '<div class="single-related-posts-wrap">';
                                while( $related_posts->have_posts() ) : $related_posts->the_post();
                            ?>
                                <article post-id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <figure class="post-thumb-wrap <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                                        <?php blogmatic_post_thumbnail( 'medium' ); ?>
                                    <?php if( $related_posts_layouts === 'two' ) echo '</figure>'; ?>
                                    <div class="post-element">
                                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-meta">
                                            <?php
                                                if( $related_posts_author_option ) blogmatic_posted_by();
                                                if( $related_posts_date_option ) blogmatic_posted_on();
                                                if( $related_posts_comment_option ) :
                                                    $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                                                    if( BMC\blogmatic_get_customizer_option( 'single_comments_icon' ) ) {
                                                        $single_comments_icon = BMC\blogmatic_get_customizer_option( 'single_comments_icon' );
                                                        $icon_html = blogmatic_get_icon_control_html($single_comments_icon);
                                                        if( $icon_html ) $comments_num = $icon_html . $comments_num ;
                                                    }
                                                    echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                    <?php if( $related_posts_layouts === 'one' ) echo '</figure>'; ?>
                                </article>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            echo '</div>';
                    ?>
                </div>
            </div>
    <?php
    }
endif;
add_action( 'blogmatic_single_post_append_hook', 'blogmatic_single_related_posts' );

if( ! function_exists( 'blogmatic_archive_header_html' ) ) :
    /**
     * Archive info box hook
     * 
     * @since 1.0.0
     */
    function blogmatic_archive_header_html() {
        if( ! is_archive() ) return;
        if( is_category() && ! BMC\blogmatic_get_customizer_option( 'archive_category_info_box_option' ) ) return;
        if( is_tag() && ! BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_option' ) ) return;
        if( is_author() && ! BMC\blogmatic_get_customizer_option( 'archive_author_info_box_option' ) ) return;
        echo '<header class="page-header">';
            if( is_category() ) {
                $archive_category_info_box_icon_option = BMC\blogmatic_get_customizer_option( 'archive_category_info_box_icon_option' );
                $archive_category_info_box_icon = BMC\blogmatic_get_customizer_option( 'archive_category_info_box_icon' );
                $archive_category_info_box_title_option = BMC\blogmatic_get_customizer_option( 'archive_category_info_box_title_option' );
                $archive_category_info_box_description_option = BMC\blogmatic_get_customizer_option( 'archive_category_info_box_description_option' );
                $archive_category_info_box_title_tag = BMC\blogmatic_get_customizer_option( 'archive_category_info_box_title_tag' );
                $icon_html = blogmatic_get_icon_control_html( $archive_category_info_box_icon );
                echo '<div class="archive-title">';
                    if( $icon_html && $archive_category_info_box_icon_option ) echo $icon_html;
                    if( $archive_category_info_box_title_option ) the_archive_title( '<'. esc_attr( $archive_category_info_box_title_tag ) .' class="page-title">', '</'. esc_attr( $archive_category_info_box_title_tag ) .'>' );
                echo '</div>';
                if( $archive_category_info_box_description_option ) the_archive_description( '<div class="archive-description">', '</div>' );
            } else if( is_tag() ) {
                $archive_tag_info_box_icon_option = BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_icon_option' );
                $archive_tag_info_box_icon = BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_icon' );
                $archive_tag_info_box_title_option = BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_title_option' );
                $archive_tag_info_box_description_option = BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_description_option' );
                $archive_tag_info_box_title_tag = BMC\blogmatic_get_customizer_option( 'archive_tag_info_box_title_tag' );
                $icon_html = blogmatic_get_icon_control_html($archive_tag_info_box_icon);
                echo '<div class="archive-title">';
                    if( $icon_html && $archive_tag_info_box_icon_option ) echo $icon_html;
                    if( $archive_tag_info_box_title_option ) the_archive_title( '<'. esc_attr( $archive_tag_info_box_title_tag ) .' class="page-title">', '</'. esc_attr( $archive_tag_info_box_title_tag ) .'>' );
                echo '</div>';
                if( $archive_tag_info_box_description_option ) the_archive_description( '<div class="archive-description">', '</div>' );
            } else if( is_author() ) {
                $archive_author_info_box_image_option = BMC\blogmatic_get_customizer_option( 'archive_author_info_box_image_option' );
                $archive_author_info_box_title_option = BMC\blogmatic_get_customizer_option( 'archive_author_info_box_title_option' );
                $archive_author_info_box_description_option = BMC\blogmatic_get_customizer_option( 'archive_author_info_box_description_option' );
                $archive_author_info_box_title_tag = BMC\blogmatic_get_customizer_option( 'archive_author_info_box_title_tag' );
                echo '<div class="archive-title">';
                    if( $archive_author_info_box_image_option ) {
                        $author_image = get_avatar( get_queried_object_id(), 90 );
                        if( $author_image ) echo $author_image;
                    }
                    if( $archive_author_info_box_title_option ) the_archive_title( '<'. esc_attr( $archive_author_info_box_title_tag ) .' class="page-title">', '</'. esc_attr( $archive_author_info_box_title_tag ) .'>' );
                echo '</div>';
                if( $archive_author_info_box_description_option ) the_archive_description( '<div class="archive-description">', '</div>' );
            } else {
                the_archive_title( '<h1 class="page-title">', '</h1>' );
            }
        echo '</header><!-- .page-header -->';
    }
    add_action( 'blogmatic_page_header_hook', 'blogmatic_archive_header_html' );
endif;

if( ! function_exists( 'blogmatic_social_share_html' ) ) :
    /**
     * Social share hook
     * 
     * @since 1.0.0
     */
    function blogmatic_social_share_html() {
        if( ! BMC\blogmatic_get_customizer_option( 'social_share_option' ) ) return;
        $social_share_icon_color_type = BMC\blogmatic_get_customizer_option( 'social_share_icon_color_type' );
        $social_share_repeater = BMC\blogmatic_get_customizer_option( 'social_share_repeater' );
        $social_share_mobile_option = BMC\blogmatic_get_customizer_option( 'social_share_mobile_option' );
        $social_share_array_list = blogmatic_get_all_social_share();
        $elementClass = 'blogmatic-social-share';
        $elementClass .= ' color-inherit--' . ( $social_share_icon_color_type ? 'global' : 'custom' );
        if( ! $social_share_mobile_option ) $elementClass .= ' hide-on-mobile';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <ul class="social-shares">
                    <?php
                        if( is_array( $social_share_repeater ) && ! empty( $social_share_repeater ) ) :
                            foreach( $social_share_repeater as $index => $social_share ):
                                if( array_key_exists( 'icon', $social_share ) && $social_share['icon'] ) :
                                    $icon = $social_share['icon'];
                                    if( ( is_home() || is_archive() || is_search() ) && $index > 3 ) break;
                                    $social_share_url = ( array_key_exists( $icon, $social_share_array_list ) ) ? $social_share_array_list[ $icon ] : '';
                                    $full_url = ( strpos( $icon, 'instagram' ) ) ? $social_share_url['value'] : $social_share_url['value'] . get_the_permalink();
                                    $iconClass = 'social-share';
                                    if( ! $social_share_icon_color_type ) $iconClass .= ' social-item--' . esc_attr( $index + 1 );
                                    if( $icon == 'fa-solid fa-copy' ) $iconClass .= ' copy_link';
                                    if( $icon == 'fa-solid fa-print' ) $iconClass .= ' print';
                                    ?>
                                        <li class="<?php echo esc_attr( $iconClass ); ?>">
                                            <a href="<?php echo esc_url( $full_url ); ?>" target="_blank">
                                                <span class="social-share-icon">
                                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                                </span>
                                            </a>
                                        </li>
                                    <?php
                                endif;
                            endforeach;
                        endif;
                    ?>
                </ul>
            </div><!-- .blogmatic-social-share -->
        <?php
    }
    add_action( 'blogmatic_social_share_hook', 'blogmatic_social_share_html', 10 );
endif;

if( ! function_exists( 'blogmatic_video_playlist_html' ) ) :
    /**
     * video playlist hook
     * 
     * @since 1.0.0
     * @package Blogmatic Pro
     */
    function blogmatic_video_playlist_html() {
        if( ! BMC\blogmatic_get_customizer_option( 'video_playlist_option' ) ) return;
        if( ( ! is_front_page() && ! is_home() ) ) :
            return;
        elseif( is_paged() ) :
            return;
        elseif( ! is_home() ) :
            return;
        endif;
        $video_playlist_api_key = BMC\blogmatic_get_customizer_option( 'video_playlist_api_key' );
        $check_api_key_valid_or_not = blogmatic_check_youtube_api_key( $video_playlist_api_key );
        $video_playlist_display_position = BMC\blogmatic_get_customizer_option( 'video_playlist_display_position' );
        $video_playlist_layouts = BMC\blogmatic_get_customizer_option( 'video_playlist_layouts' );
        $video_playlist_slider_show_arrow_on_hover = BMC\blogmatic_get_customizer_option( 'video_playlist_slider_show_arrow_on_hover' );
        $show_video_playlist_in_mobile = BMC\blogmatic_get_customizer_option( 'show_video_playlist_in_mobile' );
        $elementClass = 'blogmatic-video-playlist';
        $elementClass .= ' layout--'. $video_playlist_layouts;
        $elementClass .= ' display-position--'. $video_playlist_display_position;
        if( ! $show_video_playlist_in_mobile ) $elementClass .= ' hide-on-mobile';
        if( $video_playlist_layouts == 'two' ) :
            $elementClass .= ' show-arrow-on-hover--' . ( ( $video_playlist_slider_show_arrow_on_hover ) ? 'active' : 'inactive' );
        endif;
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogmatic-video-playlist" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                <div class="blogmatic-container">
                    <div class="row">
                        <?php
                            if( is_wp_error( $check_api_key_valid_or_not ) || empty( $video_playlist_api_key ) ) :
                                if( is_user_logged_in() ) :
                                    ?>
                                        <div class="api-key-not-found">
                                            <span class="not-found"><?php echo esc_html__( 'The API key may be incorrect or invalid.', 'blogmatic-pro' );?></span>
                                        </div>
                                    <?php
                                endif;
                            else:
                                get_template_part( 'template-parts/video-playlist/video-playlist' );
                            endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogmatic_video_playlist_hook', 'blogmatic_video_playlist_html', 10 );
endif;

if( ! function_exists( 'blogmatic_instagram_html' ) ) :
    /**
     * Instagram hook
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_instagram_html( $args ) {
        $prefix = array_key_exists( 'prefix', $args ) ? $args['prefix'] : '';
        $instagram_layout = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_layout' );
        $instagram_hover_effects = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_hover_effects' ); 
        $instagram_no_of_columns = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_no_of_columns' ); 
        $sectionClass = 'blogmatic-instagram-section';
        if( array_key_exists( 'section', $args ) ) $sectionClass .= ' ' . $args['section'];
        if( array_key_exists( 'slider_enable', $args ) && $args['slider_enable'] ) $sectionClass .= ' slider-enabled';
        $sectionClass .= ' hover-effect--' . $instagram_hover_effects;
        $sectionClass .= ' layout--' . $instagram_layout;
        $sectionClass .= ' column--' . blogmatic_convert_number_to_numeric_string( absint( $instagram_no_of_columns['desktop'] ) );
        $sectionClass .= ' tab-column--' . blogmatic_convert_number_to_numeric_string( absint( $instagram_no_of_columns['tablet'] ) );
        $sectionClass .= ' mobile-column--' . blogmatic_convert_number_to_numeric_string( absint( $instagram_no_of_columns['smartphone'] ) );
        ?>
            <section class="<?php echo esc_attr( $sectionClass ); ?>">
                <?php get_template_part( 'template-parts/instagram/instagram', '', $args ); ?>
            </section><!-- .blogmatic-instagram-section -->
        <?php
    }
    add_action( 'blogmatic_instagram_hook', 'blogmatic_instagram_html', 10 );
endif;

if( ! function_exists( 'blogmatic_shooting_star_animation_html' ) ) :
    /**
     * Background animation one
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_shooting_star_animation_html() {
        $show_background_animation_on_mobile = BMC\blogmatic_get_customizer_option( 'show_background_animation_on_mobile' ); 
        $elementClass = 'blogmatic-background-animation';
        if( ! $show_background_animation_on_mobile ) $elementClass .= ' hide-on-mobile';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php
                    for( $i = 0; $i < 13; $i++ ) :
                        echo '<span class="item"></span>';
                    endfor;
                ?>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'blogmatic_get_header_instagram' ) ) :
    /**
     * Render instagram in header
     * 
     * @since 1.0.0
     */
    function blogmatic_get_header_instagram() {
        $instagram_enable_slider_in_header = BMC\blogmatic_get_customizer_option( 'instagram_enable_slider_in_header' );
        $instagram_args = [
            'section'	=>	'insta-header',
        ];
        $instagram_args['slider_enable'] = $instagram_enable_slider_in_header;
        do_action( 'blogmatic_instagram_hook', $instagram_args );
    }
    add_action( 'blogmatic_header_instagram_hook', 'blogmatic_get_header_instagram', 10 );
endif;

if( ! function_exists( 'blogmatic_get_footer_instagram' ) ) :
    /**
     * Render instagram in footer
     * 
     * @since 1.0.0
     */
    function blogmatic_get_footer_instagram() {
        $enable_slider = BMC\blogmatic_get_customizer_option( 'footer_instagram_enable_slider_in_footer' );
        $instagram_args = [
            'section'	=>	'insta-footer'
        ];
        $instagram_args['slider_enable'] = $enable_slider;
        $instagram_args['prefix'] = 'footer_';
        do_action( 'blogmatic_instagram_hook', $instagram_args );
    }
    add_action( 'blogmatic_footer_instagram_hook', 'blogmatic_get_footer_instagram', 10 );
endif;

if( ! function_exists( 'blogmatic_get_video_playlist_above_archive' ) ) :
    /**
     * Render video playlist above archive
     * 
     * @since 1.0.0
     */
    function blogmatic_get_video_playlist_above_archive() {
        $video_playlist_display_position = BMC\blogmatic_get_customizer_option( 'video_playlist_display_position' );
        if( $video_playlist_display_position == 'above-archive' ) do_action( 'blogmatic_video_playlist_hook' );
    }
endif;

if( ! function_exists( 'blogmatic_get_video_playlist_below_archive' ) ) :
    /**
     * Render video playlist below archive
     * 
     * @since 1.0.0
     */
    function blogmatic_get_video_playlist_below_archive() {
        $video_playlist_display_position = BMC\blogmatic_get_customizer_option( 'video_playlist_display_position' );
        if( $video_playlist_display_position == 'below-archive' ) do_action( 'blogmatic_video_playlist_hook' );
    }
endif;

if( ! function_exists( 'blogmatic_get_opening_div_main_wrap' ) ) :
    /**
     * Renders the opening div to wrap main content
     */
    function blogmatic_get_opening_div_main_wrap() {
        echo '<div id="blogmatic-main-wrap" class="blogmatic-main-wrap">';
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_opening_div_main_wrap', 10 );
endif;

if( ! function_exists( 'blogmatic_get_page_header_hook' ) ) :
    function blogmatic_get_page_header_hook() {
        /**
         * Hook - blogmatic_page_header_hook
         * 
         * Hooked - blogmatic_archive_header_html - 10
         */
        if( ! is_archive() ) do_action( 'blogmatic_page_header_hook' );
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_page_header_hook', 20 );
endif;

if( ! function_exists( 'blogmatic_get_layout_three_part' ) ) :
    /**
     * Renders contents of single post only for layout three 
     * 
     * @since 1.0.0
     */
    function blogmatic_get_layout_three_part() {
        if( ! is_single() ) return;
        $single_image_size = BMC\blogmatic_get_customizer_option( 'single_image_size' );
        $single_thumbnail_option = BMC\blogmatic_get_customizer_option( 'single_thumbnail_option' );
        $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
        $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        if( ( in_array( $single_post_layout, [ 'layout-three' ] ) && $single_layout_post_meta == 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-three' ] ) ) :
            echo '<div class="blogmatic-container-fluid">';
                if( $single_thumbnail_option ) blogmatic_post_thumbnail( $single_image_size );
                
                $single_custom_class = '';
                if( ! has_post_thumbnail() || $single_thumbnail_option ) $single_custom_class = 'no-single-featured-image';
                ?>
                    <header class="entry-header <?php echo esc_attr($single_custom_class); ?>" >
                        <div class="single-header-content-wrap">
                            <?php
                                get_template_part( 'template-parts/single/partial', 'meta' );
                            ?>
                        </div>
                    </header><!-- .entry-header -->
                <?php
                blogmatic_breadcrumb_html();
            echo '</div>';
        endif;
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_layout_three_part', 30 );
endif;

if( ! function_exists( 'blogmatic_get_layout_six_part' ) ) :
    /**
     * Renders contents of single post only for layout three 
     * 
     * @since 1.0.0
     */
    function blogmatic_get_layout_six_part() {
        if( ! is_single() ) return;
        $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
        $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        if( ( in_array( $single_post_layout, [ 'layout-six' ] ) && $single_layout_post_meta == 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-six' ] ) ) :
            $single_custom_class = 'entry-header';
            ?>
                <div class="blogmatic-container">
                    <div class="row">
                        <?php blogmatic_breadcrumb_html(); ?>
                        <header class="<?php echo esc_attr( $single_custom_class ); ?>" >
                            <div class="single-header-content-wrap">
                                <?php
                                    get_template_part( 'template-parts/single/partial', 'meta' );
                                ?>
                            </div>
                        </header><!-- .entry-header -->
                    </div>
                </div>
            <?php
        endif;
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_layout_six_part', 30 );
endif;

if( ! function_exists( 'blogmatic_get_opening_div_container' ) ) :
    /**
     * Renders the opening div for .blogmatic-container class
     * 
     * @since 1.0.0
     */
    function blogmatic_get_opening_div_container() {
        echo '<div class="blogmatic-container">';
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_opening_div_container', 40 );
endif;

if( ! function_exists( 'blogmatic_get_single_content_exclude_layout_three' ) ) :
    /**
     * Renders contents of single post excluding layout three
     * 
     * @since 1.0.0
     */
    function blogmatic_get_single_content_exclude_layout_three() {
        /**
         * hook - blogmatic_before_main_content
         * 
         * hooked - blogmatic_breadcrumb_html - 10
         * hooked - blogmatic_single_header_html - 20
         */
        $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
        $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        if( $single_layout_post_meta !== 'customizer-layout' && is_single() ) {
            if( ! in_array( $single_layout_post_meta, [ 'layout-three', 'layout-six' ] ) ) do_action( 'blogmatic_before_main_content' );
        } else {
            if( ! in_array( $single_post_layout, [ 'layout-three', 'layout-six' ] ) ) do_action( 'blogmatic_before_main_content' );
        }
        if( ! is_single() ) do_action( 'blogmatic_before_main_content' );
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_single_content_exclude_layout_three', 50 );
endif;

if( ! function_exists( 'blogmatic_get_opening_div_row' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogmatic_get_opening_div_row() {
        echo '<div class="row">';
    }
    add_action( 'blogmatic_main_content_opening', 'blogmatic_get_opening_div_row', 60 );
endif;

if( ! function_exists( 'blogmatic_get_closing_div_row' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogmatic_get_closing_div_row() {
        echo '</div><!-- .row -->';
    }
    add_action( 'blogmatic_main_content_closing', 'blogmatic_get_closing_div_row', 10 );
endif;

if( ! function_exists( 'blogmatic_get_closing_div_container' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogmatic_get_closing_div_container() {
        echo '</div><!-- .row -->';
    }
    add_action( 'blogmatic_main_content_closing', 'blogmatic_get_closing_div_container', 20 );
endif;

if( ! function_exists( 'blogmatic_get_closing_div_main_wrap' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogmatic_get_closing_div_main_wrap() {
        echo '</div><!-- .blogmatic-main-wrap -->';
    }
    add_action( 'blogmatic_main_content_closing', 'blogmatic_get_closing_div_main_wrap', 30);
endif;

