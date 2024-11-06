<?php
/**
 * Includes helper hooks and function of the theme
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if( ! function_exists( 'blogmatic_get_post_format' ) ) :
    /**
     * Gets the post format string
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_get_post_format( $id = null ) {
        $post_format = ( $id ) ? get_post_format($id): get_post_format();
        return apply_filters( 'blogmatic_post_format_string_filter', $post_format );
    }
endif;

if( ! function_exists( 'blogmatic_main_banner_html' ) ) :
    /**
     * Main banner html
     * MARK: MAIN BANNER
     * 
     * @since 1.0.0
     */
    function blogmatic_main_banner_html() {
        $main_banner_render_in = BMC\blogmatic_get_customizer_option( 'main_banner_render_in' );
        if( ! BMC\blogmatic_get_customizer_option( 'main_banner_option' ) || is_paged() ) :
            return;
        elseif( $main_banner_render_in == 'front_page' && ! is_front_page() ) :
            return;
        elseif( $main_banner_render_in == 'posts_page' && ! is_home() ) :
            return;
        elseif( $main_banner_render_in == 'both' && ( ! is_front_page() && ! is_home() ) ):
            return;
        endif;

        // post query
        $main_banner_post_categories = BMC\blogmatic_get_customizer_option( 'main_banner_slider_categories' );
        $main_banner_post_tags = BMC\blogmatic_get_customizer_option( 'main_banner_slider_tags' );
        $main_banner_post_authors = BMC\blogmatic_get_customizer_option( 'main_banner_slider_authors' );
        $main_banner_posts_to_include = BMC\blogmatic_get_customizer_option( 'main_banner_slider_posts_to_include' );
        $main_banner_posts_to_exclude = BMC\blogmatic_get_customizer_option( 'main_banner_slider_posts_to_exclude' );
        $main_banner_post_order = BMC\blogmatic_get_customizer_option( 'main_banner_post_order' );
        $main_banner_no_of_posts_to_show = BMC\blogmatic_get_customizer_option( 'main_banner_no_of_posts_to_show' );
        $main_banner_post_offset = BMC\blogmatic_get_customizer_option( 'main_banner_post_offset' );
        $hide_posts_with_no_featured_image = BMC\blogmatic_get_customizer_option( 'main_banner_hide_post_with_no_featured_image' );
        
        $post_categories_id_args = ( ! empty( $main_banner_post_categories ) ) ? implode( ",", array_column( $main_banner_post_categories, 'value' ) ) : '';
        $post_authors_id_args = ( ! empty( $main_banner_post_authors ) ) ? implode( ",", array_column( $main_banner_post_authors, 'value' ) ) : '';
        $post_tags_id_args = ( ! empty( $main_banner_post_tags ) ) ? array_column( $main_banner_post_tags, 'value' ) : '';
        $post_to_include_id_args = ( ! empty( $main_banner_posts_to_include ) ) ? array_column( $main_banner_posts_to_include, 'value' ) : '';
        $post_to_exclude_id_args = ( ! empty( $main_banner_posts_to_exclude ) ) ? array_column( $main_banner_posts_to_exclude, 'value' ) : '';

        // post elements
        $show_title = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_title' );
        $show_categories = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_categories' );
        $show_date = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_date' );
        $show_author = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_author' );
        $show_excerpt = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_show_excerpt' );
        $excerpt_length = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_excerpt_length' );

        // image settings and slider settings
        $main_banner_layouts = BMC\blogmatic_get_customizer_option( 'main_banner_layouts' );
        $banner_class = 'blogmatic-main-banner-section';
        $banner_class .= ' layout--' . $main_banner_layouts;
        $main_banner_image_sizes = BMC\blogmatic_get_customizer_option( 'main_banner_image_sizes' );
        $main_banner_show_arrow_on_hover = BMC\blogmatic_get_customizer_option( 'main_banner_show_arrow_on_hover' );
        $banner_class .= ( $main_banner_show_arrow_on_hover ) ? ' arrow-on-hover--on ' : '';

        $main_banner_aligment = BMC\blogmatic_get_customizer_option( 'main_banner_post_elements_alignment' );
        $banner_class .= ' banner-align--'.$main_banner_aligment;
        
        $main_banner_show_arrows = BMC\blogmatic_get_customizer_option('main_banner_show_arrows');
        $banner_class .= ($main_banner_show_arrows) ? ' main-banner-arrow-show' : '';

        $main_banner_excerpt_on_mobile = BMC\blogmatic_get_customizer_option( 'show_main_banner_excerpt_mobile_option' );
        $main_banner_design_post_title_html_tag = BMC\blogmatic_get_customizer_option( 'main_banner_design_post_title_html_tag' );
        $main_banner_show_social_icon = BMC\blogmatic_get_customizer_option( 'main_banner_show_social_icon' );
        $hide_on_mobile = ( ! $main_banner_excerpt_on_mobile ) ? ' hide-on-mobile' : '';

        // Query
        $thumbnails = [];
        $post_order = explode( '-', $main_banner_post_order );
        $post_query_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'offset'    =>  absint( $main_banner_post_offset ),
            'posts_per_page'    =>  absint( $main_banner_no_of_posts_to_show ),
            'order' =>  $post_order[1],
            'order_by'  =>  $post_order[1],
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $main_banner_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
        if( isset( $main_banner_post_tags ) ) $post_query_args['tag__in'] = $post_tags_id_args;
        if( isset( $main_banner_post_tags ) ) $post_query_args['author'] = $post_authors_id_args;
        if( isset( $main_banner_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
        if( isset( $main_banner_posts_to_exclude ) ) $post_query_args['post__not_in'] = $post_to_exclude_id_args;
        if( $hide_posts_with_no_featured_image ) :
            $post_query_args['meta_query'] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
        $post_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_query_args ) ); 
        if( ! $post_query->have_posts() ) return;
        ?>
            <section class="<?php echo esc_attr( $banner_class )?>" id="blogmatic-main-banner-section" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                <div class="blogmatic-container">
                    <div class="row">
                        <div class="main-banner-slider">
                            <div class="main-banner-wrap swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                        while( $post_query->have_posts() ) :
                                            $post_query->the_post();
                                            $thumbnails[] = get_the_post_thumbnail_url();
                                            ?>
                                                <article class="post-item swiper-slide">
                                                    <?php if( $main_banner_layouts !== 'three' ) : ?>
                                                        <figure class="post-thumb">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if( has_post_thumbnail() ) the_post_thumbnail( $main_banner_image_sizes ); ?>
                                                            </a>
                                                            <?php
                                                                /**
                                                                 * hook : blogmatic_social_share_hook
                                                                 */
                                                                if( has_action( 'blogmatic_social_share_hook' ) && $main_banner_show_social_icon ) do_action( 'blogmatic_social_share_hook' );
                                                            ?>
                                                        </figure>
                                                    <?php endif; ?>
                                                    <div class="post-elements">
                                                        <?php if( $main_banner_layouts === 'one' ) echo '<div class="post-meta">'; ?>
                                                            <?php 
                                                                if( $show_categories ) blogmatic_get_post_categories( get_the_ID(), 2 );
                                                            ?>
                                                        <?php if( $main_banner_layouts === 'one' ) echo '</div>'; ?>
                                                        <?php
                                                            if( $show_title ) the_title( '<'. esc_attr( $main_banner_design_post_title_html_tag ) .' class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></'. esc_attr( $main_banner_design_post_title_html_tag ) .'>' );
                                                            if( $show_excerpt ) echo '<div class="post-excerpt'. esc_attr( $hide_on_mobile ) .'">'. esc_html( wp_trim_words( get_the_excerpt(), $excerpt_length ) ) .'</div>';
                                                            echo '<div class="author-date-wrap">';
                                                                if( $show_author ) blogmatic_posted_by( 'banner' );
                                                                if( $show_date ) blogmatic_posted_on( get_the_ID(), 'banner' );
                                                            echo '</div>';
                                                        ?>
                                                    </div>
                                                    <?php if( $main_banner_layouts === 'three' ) : ?>
                                                        <figure class="post-thumb">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if( has_post_thumbnail() ) the_post_thumbnail( $main_banner_image_sizes ); ?>
                                                            </a>
                                                            <?php
                                                                /**
                                                                 * hook : blogmatic_social_share_hook
                                                                 */
                                                                if( has_action( 'blogmatic_social_share_hook' ) && $main_banner_show_social_icon ) do_action( 'blogmatic_social_share_hook' );
                                                            ?>
                                                        </figure>
                                                    <?php endif; ?>
                                                </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                                <!-- If we need navigation buttons -->
                                <?php if( in_array( $main_banner_layouts, [ 'one', 'two' ] ) ) blogmatic_get_slider_navigation_buttons(); ?>
                            </div>

                            <?php if( count( $thumbnails ) > 0  ): ?>
                                <div class="swiper main-banner-swiper-thumbs">
                                    <div class="swiper-wrapper">
                                        <?php
                                            if( $post_query->have_posts() ) :
                                                while( $post_query->have_posts() ) :
                                                    $post_query->the_post();
                                                    echo '<figure class="swiper-slide">';
                                                        the_post_thumbnail( 'post-thumbnail' );
                                                    echo '</figure>';
                                                endwhile;
                                            endif;
                                        ?>
                                    </div>

                                    <!-- If we need navigation buttons -->
                                    <?php if( $main_banner_layouts !== 'one' ) blogmatic_get_slider_navigation_buttons(); ?>
                                </div>
                            <?php endif; ?>

                        </div><!-- .main-banner-slider -->
                        <?php if( in_array( $main_banner_layouts, [ 'three' ] ) ) : ?>
                            <div class="main-banner-sidebar">
                                <h2 class="sidebar-title"><?php echo esc_html__( 'Trending', 'blogmatic-pro' ); ?></h2>
                                <div class="scrollable-posts-wrapper">
                                    <?php
                                        if( $post_query->have_posts() ) :
                                            $count = 1;
                                            while( $post_query->have_posts() ) :
                                                $post_query->the_post();
                                                ?>
                                                    <div class="scrollable-post">
                                                        <div class="count-image-wrapper">
                                                            <span class="post-count"><?php echo esc_html( $count ); ?></span>
                                                            <figure class="post-thumb">
                                                                <?php if( has_post_thumbnail() ) : ?>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_post_thumbnail( $main_banner_image_sizes ); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </figure>
                                                        </div>
                                                        <div class="title-date-wrapper">
                                                            <?php
                                                                the_title( '<h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                                blogmatic_posted_on( get_the_ID(), 'banner' );
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                $count++;
                                            endwhile;
                                        endif;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogmatic_header_after_hook', 'blogmatic_main_banner_html', 10 );
endif;

if( ! function_exists( 'blogmatic_get_slider_navigation_buttons' ) ) :
    /**
     * Main Banner Navigation buttons
     * 
     * @since 1.0.0
     */
    function blogmatic_get_slider_navigation_buttons( $type = 'main_banner' ) {
        $show_arrows = BMC\blogmatic_get_customizer_option( $type .'_show_arrows' );
        if( $show_arrows ) :
            $pagination_array = [
                'prev' => $type .'_slider_prev_arrow',
                'next' => $type .'_slider_next_arrow'
            ];
            foreach( $pagination_array as $pagination_key => $pagination ) :
                $paginationClass = 'custom-button-' . $pagination_key;
                $paginationClass .= ' swiper-arrow';
                ?>
                    <div class="<?php echo esc_attr( $paginationClass ); ?>">
                        <?php
                            $icon = blogmatic_parse_icon_picker_value( BMC\blogmatic_get_customizer_option( $pagination ) );
                            if( $icon['type'] === 'icon' ) :
                                echo '<i class="'. esc_attr( $icon['value'] ) .'"></i>';
                            else: 
                                echo '<img src="'. esc_url( $icon['url'] ) .'" alt="" loading="lazy" />';
                            endif;
                        ?>
                    </div>
                <?php
            endforeach;
        endif;
    }
endif;

if( ! function_exists( 'blogmatic_carousel_html' ) ) :
    /**
     * Carousel html
     * MARK: CAROUSEL
     * 
     * @since 1.0.0
     */
    function blogmatic_carousel_html() {
        $carousel_render_in = BMC\blogmatic_get_customizer_option( 'carousel_render_in' );
        if( ! BMC\blogmatic_get_customizer_option( 'carousel_option' ) || is_paged() ) :
            return;
        elseif( $carousel_render_in == 'front_page' && ! is_front_page() ) :
            return;
        elseif( $carousel_render_in == 'posts_page' && ! is_home() ) :
            return;
        elseif( $carousel_render_in == 'both' && ( ! is_front_page() && ! is_home() ) ):
            return;
        endif;
        $carousel_layouts = BMC\blogmatic_get_customizer_option( 'carousel_layouts' );
        // post query
        $carousel_post_categories = BMC\blogmatic_get_customizer_option( 'carousel_slider_categories' );
        $carousel_post_tags = BMC\blogmatic_get_customizer_option( 'carousel_slider_tags' );
        $carousel_post_authors = BMC\blogmatic_get_customizer_option( 'carousel_slider_authors' );
        $carousel_posts_to_include = BMC\blogmatic_get_customizer_option( 'carousel_slider_posts_to_include' );
        $carousel_posts_to_exclude = BMC\blogmatic_get_customizer_option( 'carousel_slider_posts_to_exclude' );
        $carousel_post_order = BMC\blogmatic_get_customizer_option( 'carousel_post_order' );
        $carousel_no_of_posts_to_show = BMC\blogmatic_get_customizer_option( 'carousel_no_of_posts_to_show' );
        $carousel_post_offset = BMC\blogmatic_get_customizer_option( 'carousel_post_offset' );
        $hide_posts_with_no_featured_image = BMC\blogmatic_get_customizer_option( 'carousel_hide_post_with_no_featured_image' );
        
        $post_categories_id_args = ( ! empty( $carousel_post_categories ) ) ? implode( ",", array_column( $carousel_post_categories, 'value' ) ) : '';
        $post_authors_id_args = ( ! empty( $carousel_post_authors ) ) ? implode( ",", array_column( $carousel_post_authors, 'value' ) ) : '';
        $post_tags_id_args = ( ! empty( $carousel_post_tags ) ) ? array_column( $carousel_post_tags, 'value' ) : '';
        $post_to_include_id_args = ( ! empty( $carousel_posts_to_include ) ) ? array_column( $carousel_posts_to_include, 'value' ) : '';
        $post_to_exclude_id_args = ( ! empty( $carousel_posts_to_exclude ) ) ? array_column( $carousel_posts_to_exclude, 'value' ) : '';

        // post elements
        $show_title = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_title' );
        $show_categories = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_categories' );
        $show_date = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_date' );
        $show_author = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_author' );
        $show_excerpt = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_show_excerpt' );
        $excerpt_length = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_excerpt_length' );

        // image settings and slider settings
        $carousel_image_sizes = BMC\blogmatic_get_customizer_option( 'carousel_image_sizes' );
        $carousel_show_arrow_on_hover = BMC\blogmatic_get_customizer_option( 'carousel_show_arrow_on_hover' );
        $carousel_no_of_columns = absint( BMC\blogmatic_get_customizer_option( 'carousel_no_of_columns' ) );

        // element class
        $elementClass = 'blogmatic-carousel-section';
        $elementClass .= ( $carousel_show_arrow_on_hover ) ? ' arrow-on-hover--on' : '';
        $elementClass .= ( $carousel_no_of_columns ) ? ' no-of-columns--'. blogmatic_convert_number_to_numeric_string( $carousel_no_of_columns ) : '';

        $carousel_aligment = BMC\blogmatic_get_customizer_option( 'carousel_post_elements_alignment' );
        $elementClass .= ' carousel-align--'.$carousel_aligment;

        $carousel_show_arrow = BMC\blogmatic_get_customizer_option('carousel_show_arrows');
        $elementClass .= ( $carousel_show_arrow ) ? ' carousel-banner-arrow-show' : '';
        $elementClass .= ' carousel-layout--'. $carousel_layouts;

        $carousel_banner_excerpt_on_mobile = BMC\blogmatic_get_customizer_option( 'show_carousel_banner_excerpt_mobile_option' );
        $carousel_design_post_title_html_tag = BMC\blogmatic_get_customizer_option( 'carousel_design_post_title_html_tag' );
        $hide_on_mobile = ( ! $carousel_banner_excerpt_on_mobile ) ? ' hide-on-mobile' : '';

        $post_order = explode( '-', $carousel_post_order );
        $post_query_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'offset'    =>  absint( $carousel_post_offset ),
            'posts_per_page'    =>  absint( $carousel_no_of_posts_to_show ),
            'order' =>  $post_order[1],
            'order_by'  =>  $post_order[1],
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $carousel_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
        if( isset( $carousel_post_tags ) ) $post_query_args['tag__in'] = $post_tags_id_args;
        if( isset( $carousel_post_tags ) ) $post_query_args['author'] = $post_authors_id_args;
        if( isset( $carousel_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
        if( isset( $carousel_posts_to_exclude ) ) $post_query_args['post__not_in'] = $post_to_exclude_id_args;
        if( $hide_posts_with_no_featured_image ) :
            $post_query_args['meta_query'] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
        $post_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_query_args ) );
        if( ! $post_query->have_posts() ) return;
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogmatic-carousel-section" <?php esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                <div class="blogmatic-container">
                    <div class="row">
                        <div class="carousel-wrap swiper">
                            <div class="swiper-wrapper">
                                <?php
                                    if( $post_query->have_posts() ) :
                                        while( $post_query->have_posts() ) :
                                            $post_query->the_post();
                                            ?>
                                                <article class="post-item swiper-slide">
                                                    <figure class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if( has_post_thumbnail() ) the_post_thumbnail( $carousel_image_sizes ); ?>
                                                        </a>
                                                    </figure>
                                                    <div class="post-elements">
                                                        <div class="post-meta">
                                                            <?php 
                                                                if( $show_categories ) blogmatic_get_post_categories( get_the_ID(), 2 );
                                                                if( $show_date ) blogmatic_posted_on( get_the_ID(), 'carousel' );
                                                            ?>
                                                        </div>
                                                        <?php
                                                            if( $show_title ) the_title( '<'. esc_attr( $carousel_design_post_title_html_tag ) .' class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></'. esc_attr( $carousel_design_post_title_html_tag ) .'>' );
                                                            if( $show_excerpt ) echo '<div class="post-excerpt'. esc_attr( $hide_on_mobile ) .'"><span class="excerpt-content">'. esc_html( wp_trim_words( get_the_excerpt(), $excerpt_length ) ) .'</span></div>';
                                                            if( $show_author ) blogmatic_posted_by( 'carousel' );
                                                        ?>
                                                    </div>
                                                </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                ?>
                            </div>
                            <?php blogmatic_get_slider_navigation_buttons( 'carousel' ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogmatic_header_after_hook', 'blogmatic_carousel_html', 30 );
endif;

if( ! function_exists( 'blogmatic_get_icon_control_html' ) ) :
    /**
     * Generates output for icon control
     * 
     * @since 1.0.0
     */
    function blogmatic_get_icon_control_html($archive_date_icon) {
        if( $archive_date_icon['type'] == 'none' ) return;
        switch($archive_date_icon['type']) {
            case 'svg' : $output = '<img src="' .esc_url( wp_get_attachment_url( $archive_date_icon['value'] ) ). '" loading="lazy" />';
                    break;
            default: $output = '<i class="' .esc_attr( $archive_date_icon['value'] ). '"></i>';
        }
        return $output;
    }
endif;

if( ! function_exists( 'blogmatic_convert_number_to_numeric_string' )) :
    /**
     * Function to convert int parameter to numeric string
     * MARK: CONVERT NUMBER TO STRING
     * 
     * @return string
     */
    function blogmatic_convert_number_to_numeric_string( $int ) {
        switch( $int ){
            case 2:
                return "two";
                break;
            case 3:
                return "three";
                break;
            case 4:
                return "four";
                break;
            case 5:
                return "five";
                break;
            case 6:
                return "six";
                break;
            case 7:
                return "seven";
                break;
            case 8:
                return "eight";
                break;
            case 9:
                return "nine";
                break;
            case 10:
                return "ten";
                break;
            default:
                return "one";
        }
    }
 endif;

 if( ! function_exists( 'blogmatic_post_read_time' ) ) :
    /**
     * Function derives the read time
     * @return float
     */
    function blogmatic_post_read_time( $string = '' ) {
    	$read_time = 0;
        if( empty( $string ) ) {
            return 0 . esc_html__( ' min', 'blogmatic-pro' );
        } else {
            $read_time = apply_filters( 'blogmatic_content_read_time', round( str_word_count( wp_strip_all_tags( $string ) ) / 100 ), 2 );
            if( $read_time == 0 ) {
            	return 1 . esc_html__( ' min', 'blogmatic-pro' );
            } else {
            	return $read_time . esc_html__( ' mins', 'blogmatic-pro' );
            }
        }
    }
endif;

if( ! function_exists( 'blogmatic_get_post_categories' ) ) :
    /**
     * Function contains post categories html
     * @return float
     */
    function blogmatic_get_post_categories( $post_id, $number = 1, $args = [] ) {
        $hide_on_mobile = '';
    	$n_categories = wp_get_post_categories($post_id, array( 'number' => absint( $number ) ));
        if( array_key_exists( 'hide_on_mobile', $args ) ) :
            $hide_on_mobile = ( ! $args['hide_on_mobile'] ) ? ' hide-on-mobile' : '';
        endif;
		echo '<ul class="post-categories'. esc_attr( $hide_on_mobile ) .'">';
			foreach( $n_categories as $n_category ) :
				echo '<li class="cat-item ' .esc_attr( 'cat-' . $n_category ). '"><a href="' .esc_url( get_category_link( $n_category ) ). '" rel="category tag">' .get_cat_name( $n_category ). '</a></li>';
			endforeach;
		echo '</ul>';
    }
endif;

if( ! function_exists( 'blogmatic_loader_html' ) ) :
	/**
     * Preloader html
     * MARK: PRELOADER
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
	function blogmatic_loader_html() {
        if( ! BMC\blogmatic_get_customizer_option( 'preloader_option' ) ) return;
        $display_preloader_animation = BMC\blogmatic_get_customizer_option( 'display_preloader_animation' );
        if( $display_preloader_animation == 'first-time' ) {
            $show_preloader = isset( $_COOKIE['showPreloader'] ) ? $_COOKIE['showPreloader'] : '';
            if( $show_preloader == 'true' ) return;
        }
        $preloader_styles = BMC\blogmatic_get_customizer_option( 'preloader_styles' );
        $elementClass = 'blogmatic_loading_box';
        $elementClass .= ' preloader-style--'. $preloader_styles;
        $elementClass .= ' display-preloader--'. ( ( $display_preloader_animation == 'first-time' ) ? 'initial-load' : 'every-load' );
	?>
		<div class="<?php echo esc_attr( $elementClass ); ?>" id="blogmatic-preloader">
			<div class="box">
				<div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
                <div class="four"></div>
                <div class="five"></div>
			</div>
		</div>
	<?php
	}
    add_action( 'blogmatic_page_prepend_hook', 'blogmatic_loader_html', 1 );
endif;

 if( ! function_exists( 'blogmatic_custom_header_html' ) ) :
    /**
     * Site custom header html
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_custom_header_html() {
        /**
         * Get custom header markup
         * 
         * @since 1.0.0 
         */
        the_custom_header_markup();
    }
    add_action( 'blogmatic_page_prepend_hook', 'blogmatic_custom_header_html', 20 );
 endif;

 if( ! function_exists( 'blogmatic_pagination_fnc' ) ) :
    /**
     * Renders pagination html
     * MARK: PAGINATION
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        $archive_pagination_type = BMC\blogmatic_get_customizer_option( 'archive_pagination_type' );
        // the_post_navigation
        switch($archive_pagination_type) {
            case 'default': 
                $next_link = get_previous_posts_link( 'Newer Posts' );
                $prev_link = get_next_posts_link( 'Older Posts' );
                ?>
                    <nav class="navigation posts-navigation">
                        <div class="nav-links">
                            <div class="nav-previous"><?php echo $prev_link; ?></div>
                            <div class="nav-next"><?php echo $next_link; ?></div>
                        </div>
                    </nav>
                <?php
                    break;
            case 'ajax-load-more' :
                $pagination_button_label = BMC\blogmatic_get_customizer_option( 'pagination_button_label' );
                $pagination_button_icon = BMC\blogmatic_get_customizer_option( 'pagination_button_icon' );
                $archive_pagination_button_icon_context = BMC\blogmatic_get_customizer_option( 'archive_pagination_button_icon_context' );
                ?>
                    <div class="pagination pagination-type--ajax-load-more">
                        <div class="ajax-load-more-wrap">
                            <?php
                                if( $archive_pagination_button_icon_context == 'prefix' ) :
                                    echo '<span class="pagination-icon icon-context--before">';
                                        if( $pagination_button_icon['type'] == 'icon'  ) echo '<i class="'. esc_attr( $pagination_button_icon['value'] ) .'"></i>';
                                        if( $pagination_button_icon['type'] == 'svg'  ) echo wp_get_attachment_image( $pagination_button_icon['value'] );
                                    echo '</span>';
                                endif;

                                if( ! empty( $pagination_button_label ) ) echo '<h2 class="button-label">' . esc_html( $pagination_button_label ) . '</h2>';

                                if( $archive_pagination_button_icon_context == 'suffix' ) :
                                    echo '<span class="pagination-icon icon-context--after">';
                                        if( $pagination_button_icon['type'] == 'icon'  ) echo '<i class="'. esc_attr( $pagination_button_icon['value'] ) .'"></i>';
                                        if( $pagination_button_icon['type'] == 'svg'  ) echo wp_get_attachment_image( $pagination_button_icon['value'] );
                                    echo '</span>';
                                endif;
                            ?>
                        </div>
                    </div>
                <?php
                    break;
            default: echo '<div class="pagination">' .wp_kses_post( paginate_links( array( 'prev_text' => '<i class="fa-solid fa-angles-left"></i>', 'next_text' => '<i class="fa-solid fa-angles-right"></i>', 'type' => 'list' ) ) ). '</div>';
        }
        
    }
    add_action( 'blogmatic_pagination_link_hook', 'blogmatic_pagination_fnc' );
 endif;

 if( ! function_exists( 'blogmatic_scroll_to_top_html' ) ) :
    /**
     * Scroll to top fnc
     * MARK: SCROLL TO TOP
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_scroll_to_top_html() {
        $stt_text = BMC\blogmatic_get_customizer_option( 'stt_text' );
        $stt_icon = BMC\blogmatic_get_customizer_option( 'stt_icon' );
        $stt_alignment = BMC\blogmatic_get_customizer_option( 'stt_alignment' );
        $stt_display_type = BMC\blogmatic_get_customizer_option( 'stt_display_type' );
        $classes = 'blogmatic-scroll-btn';
        $classes .= ' align--' . $stt_alignment;
        $classes .= ' display--' . $stt_display_type;
        ?>
            <div id="blogmatic-scroll-to-top" class="<?php echo esc_attr( $classes ); ?>">
                <div class="scroll-top-wrap">
                    <?php if( $stt_text ) echo '<span class="icon-text">'. esc_html( $stt_text ) .'</span>'; ?>
                    <div class="scroll-to-top-wrapper">
                        <?php                        
                            if( $stt_icon['type'] == 'icon' ) {
                                if( $stt_icon['value'] != 'fas fa-ban' ) : 
                                    echo '<span class="icon-holder"><i class="'. esc_attr( $stt_icon['value'] ) .'"></i></span>';
                                endif;
                            } else {
                                if( $stt_icon['type'] != 'none' )echo '<span class="icon-holder">'. wp_get_attachment_image( $stt_icon['value'], 'full' ) .'</span>';
                            }
                        ?>
                    </div>
                </div>
            </div><!-- #blogmatic-scroll-to-top -->
        <?php
    }
    add_action( 'blogmatic_scroll_to_top_hook', 'blogmatic_scroll_to_top_html', 10 );
 endif;

 require get_template_directory() . '/inc/hooks/footer-hooks.php'; // footer hooks.

if ( ! function_exists( 'blogmatic_breadcrumb_trail' ) ) :
    /**
     * Theme default breadcrumb function.
     *
     * @since 1.0.0
     */
    function blogmatic_breadcrumb_trail() {
        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            // load class file
            require_once get_template_directory() . '/inc/breadcrumb-trail/breadcrumb-trail.php';
        }

        // arguments variable
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false
        );
        breadcrumb_trail( $breadcrumb_args );
    }
    add_action( 'blogmatic_breadcrumb_trail_hook', 'blogmatic_breadcrumb_trail' );
endif;

if( ! function_exists( 'blogmatic_breadcrumb_html' ) ) :
    /**
     * Theme breadcrumb
     * MARK: BREADCRUMB
     *
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_breadcrumb_html() {
        $site_breadcrumb_option = BMC\blogmatic_get_customizer_option( 'site_breadcrumb_option' );
        $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
	    $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        if ( ! $site_breadcrumb_option ) return;
        if ( is_front_page() || is_home() ) return;
        $site_breadcrumb_type = BMC\blogmatic_get_customizer_option( 'site_breadcrumb_type' );
        $wrapperClass = 'blogmatic-breadcrumb-element';
        if( ( $single_post_layout !== 'layout-six' && $single_layout_post_meta !== 'customizer-layout' ) || $single_layout_post_meta !== 'layout-six' ) $wrapperClass .= ' row';
            ?>
                <div class="<?php echo esc_attr( $wrapperClass ); ?>">
                    <div class="blogmatic-breadcrumb-wrap">
                        <?php
                            switch( $site_breadcrumb_type ) {
                                case 'yoast': if( blogmatic_compare_wand([blogmatic_function_exists( 'yoast_breadcrumb' )] ) ) yoast_breadcrumb();
                                        break;
                                case 'rankmath': if( blogmatic_compare_wand([blogmatic_function_exists( 'rank_math_the_breadcrumbs' )] ) ) rank_math_the_breadcrumbs();
                                        break;
                                case 'bcn': if( blogmatic_compare_wand([blogmatic_function_exists( 'bcn_display' )] ) ) bcn_display();
                                        break;
                                default: do_action( 'blogmatic_breadcrumb_trail_hook' );
                                        break;
                            }
                        ?>
                    </div>
                </div><!-- .row -->
        <?php
    }
endif;
add_action( 'blogmatic_before_main_content', 'blogmatic_breadcrumb_html', 10 );

if( ! function_exists( 'blogmatic_single_header_html' ) ) :
    /**
     * Theme single post header html
     * MARK: SINGLE HEADER
     *
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_single_header_html() {
        $single_post_layout = BMC\blogmatic_get_customizer_option( 'single_post_layout' );
        $single_image_size = BMC\blogmatic_get_customizer_option( 'single_image_size' );
        $single_layout_post_meta = metadata_exists( 'post', get_the_ID(), 'single_layout' ) ? get_post_meta( get_the_ID(), 'single_layout', true ) : 'customizer-layout';
        if( ( in_array( $single_post_layout, [ 'layout-one', 'layout-three', 'layout-six' ] ) && $single_layout_post_meta == 'customizer-layout' ) || in_array( $single_layout_post_meta, [ 'layout-one', 'layout-three', 'layout-six' ] ) ) return;
        if ( ! is_single() ) return;
        if( $single_layout_post_meta == 'layout-three' ) return;
        global $post;
        ?>
            <div class="row blogmatic-single-header">
                <?php
                    $single_thumbnail_option = BMC\blogmatic_get_customizer_option( 'single_thumbnail_option' );
                    if( $single_thumbnail_option ) :
                        ?>
                            <header class="entry-header" >
                                <div class="post-thumb-wrap">
                                    <?php
                                        blogmatic_post_thumbnail( $single_image_size );
                                    ?>
                                </div>
                                <div class="single-header-content-wrap">
                                    <?php get_template_part( 'template-parts/single/partial', 'meta' ); ?>
                                </div>
                            </header><!-- .entry-header -->
                        <?php
                    endif;
                ?>
            </div><!-- .row -->
        <?php
    }
endif;
add_action( 'blogmatic_before_main_content', 'blogmatic_single_header_html', 20 );

if( ! function_exists( 'blogmatic_theme_mode_switch' ) ) :
    /**
     * Function to return either icon html or image html
     * 
     * @param type
     * @since 1.0.0
     */
    function blogmatic_theme_mode_switch( $mode, $theme_mode ) {
        $elementClass = ( $theme_mode == 'light' ) ? 'lightmode' : 'darkmode';
        switch( $mode['type'] ) :
            case 'icon' :
                echo '<i class="'. esc_attr( $mode['value'] . ' ' . $elementClass ) .'"></i>';
                break;
            case 'svg' :
                echo '<img class="'. esc_attr( $elementClass ) .'" src="'. esc_url( wp_get_attachment_image_url( $mode['value'], 'full' ) ) .'" loading="lazy">';
                break;
        endswitch;
    }
 endif;

if( ! function_exists( 'blogmatic_category_collection_html' ) ) :
    /**
     * Category Collection html part
     * MARK: CATEGORY COLLECTION
     * 
     * @since 1.0.0
     * @package Blogmatic Pro
     */
    function blogmatic_category_collection_html() {
        $category_collection_render_in = BMC\blogmatic_get_customizer_option( 'category_collection_render_in' );
        $category_collection_option = BMC\blogmatic_get_customizer_option( 'category_collection_option' );
        if( ! $category_collection_option || is_paged() ) :
            return;
        elseif( $category_collection_render_in == 'front_page' && ! is_front_page() ) :
            return;
        elseif( $category_collection_render_in == 'posts_page' && ! is_home() ) :
            return;
        elseif( $category_collection_render_in == 'both' && ( ! is_front_page() && ! is_home() ) ):
            return;
        endif;
       if( ! $category_collection_option ) return;
       $category_collection_layout = BMC\blogmatic_get_customizer_option( 'category_collection_layout' );
       $category_collection_show_count = BMC\blogmatic_get_customizer_option( 'category_collection_show_count' );
       $category_collection_number_of_columns = BMC\blogmatic_get_customizer_option( 'category_collection_number_of_columns' );    
       $category_to_include = BMC\blogmatic_get_customizer_option( 'category_to_include' );
       $category_to_exclude = BMC\blogmatic_get_customizer_option( 'category_to_exclude' );
       $category_collection_number = BMC\blogmatic_get_customizer_option( 'category_collection_number' );
       $category_collection_orderby = BMC\blogmatic_get_customizer_option( 'category_collection_orderby' );
       $category_collection_sort = explode( '-', $category_collection_orderby );
       $category_collection_offset = BMC\blogmatic_get_customizer_option( 'category_collection_offset' );
       $category_collection_hide_empty = BMC\blogmatic_get_customizer_option( 'category_collection_hide_empty' );
       $category_collection_slider_option = BMC\blogmatic_get_customizer_option( 'category_collection_slider_option' );
       $category_collection_image_size = BMC\blogmatic_get_customizer_option( 'category_collection_image_size' );
       $category_collection_hover_effects = BMC\blogmatic_get_customizer_option( 'category_collection_hover_effects' );       
       $sectionClass = 'blogmatic-category-collection-section';
       $catCollectionWrapperClass = 'category-collection-wrap';
       $catItemClass = 'category-wrap';
       $sectionClass .= ' layout--' . $category_collection_layout;
       $sectionClass .= ' hover-effect--' . $category_collection_hover_effects;
       $sectionClass .= ' column--' . blogmatic_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['desktop'] ) );
       $sectionClass .= ' tab-column--' . blogmatic_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['tablet'] ) );
       $sectionClass .= ' mobile-column--' . blogmatic_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['smartphone'] ) );
       if( $category_collection_slider_option ) :
            $sectionClass .= ' slider-enabled';
            $catCollectionWrapperClass .= ' swiper';
            $catItemClass .= ' swiper-slide';
       endif;
       $category_collection_slider_arrow = BMC\blogmatic_get_customizer_option( 'category_collection_slider_arrow' );
       if( $category_collection_show_count ) $sectionClass .= ' category-count--enabled';
       $category_args = [
            'number'    =>  absint( $category_collection_number ),
            'exclude'   =>  ( ! empty( $category_to_exclude ) ) ? array_column( $category_to_exclude, 'value' ) : [],
            'include'   =>  ( ! empty( $category_to_include ) ) ? array_column( $category_to_include, 'value' ) : [],
            'hide_empty'    =>  is_bool( $category_collection_hide_empty ),
            'offset'    =>  absint( $category_collection_offset ),
            'orderby'   =>  $category_collection_sort[1],
            'order' =>  $category_collection_sort[0]
       ];
       $get_all_categories = get_categories( $category_args );
        ?>
            <section class="<?php echo esc_attr( $sectionClass ); ?>" id="blogmatic-category-collection-section">
                <div class="blogmatic-container">
                    <div class="row">
                        <div class="<?php echo esc_attr( $catCollectionWrapperClass ); ?>">
                            <?php
                                if( $category_collection_slider_option ) echo '<div class="swiper-wrapper">';
                                    if( ! is_null( $get_all_categories ) && is_array( $get_all_categories ) ) :
                                        foreach( $get_all_categories as $cat_key => $cat_value ) :
                                            $category_query_args = [
                                                'cat'   =>  absint( $cat_value->term_id ),
                                                'meta_query'    =>  [
                                                    [
                                                        'key'   =>  '_thumbnail_id',
                                                        'compare'   =>  'EXISTS'
                                                    ]
                                                ],
                                                'ignore_stick_posts'    =>  true
                                            ];
                                            $category_query = new WP_Query( apply_filters( 'blogmatic_query_args_filter', $category_query_args ) );
                                            if( $category_query->have_posts() ) :
                                                $thumbnail_id = ( $category_query->posts[0]->ID != null ) ? $category_query->posts[0]->ID : '';
                                            else:
                                                $thumbnail_id = '';
                                            endif;

                                            ?>
                                                <div class="<?php echo esc_attr( $catItemClass ); ?>">
                                                    <?php if( $category_collection_layout == 'two' ) echo '<div class="category-inner-wrap">'; ?>
                                                        <figure class="category-thumb">
                                                            <a href="<?php echo get_term_link( $cat_value->term_id, 'category' ); ?>">
                                                                <?php if( $thumbnail_id ) echo wp_kses_post( get_the_post_thumbnail( $thumbnail_id, $category_collection_image_size ) ); ?>
                                                            </a>
                                                        </figure>
                                                        <div class="category-item cat-meta">
                                                            <div class="category-item-inner">
                                                                <div class="category-name">
                                                                <a href="<?php echo get_term_link( $cat_value->term_id, 'category' ); ?>">
                                                                    <span class="category-label"><?php echo esc_html( $cat_value->name );?></span>
                                                                    <?php if( $category_collection_show_count ) echo '<span class="category-count">'. esc_html( $cat_value->count . ' posts' ) .'</span>';?>
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if( $category_collection_layout == 'two' ) : ?>
                                                            <div class="category-item-second cat-meta">
                                                                <div class="category-item-inner">
                                                                    <div class="category-name">
                                                                    <a href="<?php echo get_term_link( $cat_value->term_id, 'category' ); ?>">
                                                                        <span class="category-label"><?php echo esc_html( $cat_value->name );?></span>
                                                                        <?php if( $category_collection_show_count ) echo '<span class="category-count">'. esc_html( $cat_value->count . ' posts' ) .'</span>';?>
                                                                    </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; 
                                                    if( $category_collection_layout == 'two' ) echo '</div>';
                                                    ?>
                                                </div>
                                            <?php
                                        endforeach;
                                    endif;
                                if( $category_collection_slider_option ) echo '</div><!-- .swiper-wrapper -->';
                            ?>
                            <?php
                                if( $category_collection_slider_option && $category_collection_slider_arrow ) :
                                    $pagination_array = [
                                        'prev' => 'category_collection_prev_arrow',
                                        'next' => 'category_collection_next_arrow'
                                    ];
                                    foreach( $pagination_array as $pagination_key => $pagination ) :
                                        $paginationClass = 'custom-button-' . $pagination_key;
                                        $paginationClass .= ' swiper-arrow';
                                        ?>
                                            <div class="<?php echo esc_attr( $paginationClass ); ?>">
                                                <?php
                                                    $icon = blogmatic_parse_icon_picker_value( BMC\blogmatic_get_customizer_option( $pagination ) );
                                                    if( $icon['type'] === 'icon' ) :
                                                        echo '<i class="'. esc_attr( $icon['value'] ) .'"></i>';
                                                    else: 
                                                        echo '<img src="'. esc_url( $icon['url'] ) .'" alt="" loading="lazy" />';
                                                    endif;
                                                ?>
                                            </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogmatic_header_after_hook', 'blogmatic_category_collection_html', 20 );
endif;

if( ! function_exists( 'blogmatic_button_html' ) ) :
    /**
     * View all html
     * MARK: ARCHIVE BUTTON
     * 
     * @package Newsis Pro
     * @since 1.0.0
     */
    function blogmatic_button_html( $args ) {
        if( ! $args['show_button'] ) return;
        $global_button_label = BMC\blogmatic_get_customizer_option( 'global_button_label' );
        $global_button_icon_picker = BMC\blogmatic_get_customizer_option( 'global_button_icon_picker' );
        $archive_read_more_text_on_mobile = BMC\blogmatic_get_customizer_option( 'show_readmore_text_mobile_option' );
        $archive_read_more_button_on_mobile = BMC\blogmatic_get_customizer_option( 'show_readmore_button_mobile_option' );

        $read_more_text_hide_on_mobile = ( ! $archive_read_more_text_on_mobile ) ? ' hide-on-mobile' : '';
        $read_more_button_hide_on_mobile = ( ! $archive_read_more_button_on_mobile ) ? ' hide-on-mobile' : '';
        
        $classes = isset( $args['classes'] ) ? 'post-link-button' . ' ' .$args['classes'] : 'post-button';
        $classes .= $read_more_button_hide_on_mobile;
        $link = isset( $args['link'] ) ? $args['link'] : get_the_permalink();
        $text = isset( $args['text'] ) ? $args['text'] : apply_filters( 'blogmatic_global_button_label_fitler', $global_button_label );
        $icon = isset( $args['icon'] ) ? $args['icon'] : ( $global_button_icon_picker['type'] !== 'none' ? $global_button_icon_picker['value']: '' );
        echo apply_filters( 'blogmatic_button_html', sprintf( '<a class="%1$s" href="%2$s">%3$s<span class="button-icon"><i class="%4$s"></i></span></a>', esc_attr( $classes ), esc_url( $link ), '<span class="button-text'. esc_attr( $read_more_text_hide_on_mobile ) .'">'. esc_html( $text ) .'</span>', esc_attr( $icon ) ) );
    }
    add_action( 'blogmatic_section_block_view_all_hook', 'blogmatic_button_html', 10, 1 );
endif;