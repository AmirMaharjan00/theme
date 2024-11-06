<?php
/**
 * Footer hooks and functions
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if( ! function_exists( 'blogmatic_footer_logo_part' ) ) :
    /**
     * Bottom Footer logo element
     * 
     * @since 1.0.0
     */
    function blogmatic_footer_logo_part() {
        $logo_from = BMC\blogmatic_get_customizer_option( 'bottom_footer_header_or_custom' );
        $show_site_title = false;
        $footer_dark_mode_logo = '';
        if( $logo_from == 'header' ) {
            $footer_logo = get_theme_mod( 'custom_logo' );
            if( ! $footer_logo ) $show_site_title = true;
        } else {
            $footer_logo = BMC\blogmatic_get_customizer_option( 'bottom_footer_logo_option' );
            $footer_dark_mode_logo = BMC\blogmatic_get_customizer_option( 'footer_dark_mode_logo' );
        };
        ?>
            <div class="footer-logo">
                <?php
                    if( $logo_from !== 'header' ) {
                        if( wp_get_attachment_image( $footer_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="footer-site-logo">'. wp_get_attachment_image( $footer_logo, 'full' ) .'</a>';
                        if( wp_get_attachment_image( $footer_dark_mode_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="footer-dark-mode-site-logo">'. wp_get_attachment_image( $footer_dark_mode_logo, 'full' ) .'</a>';
                    } else {
                        $dark_mode_site_logo = BMC\blogmatic_get_customizer_option( 'dark_mode_site_logo' );
                        $site_title_tag_for_frontpage = BMC\blogmatic_get_customizer_option( 'site_title_tag_for_frontpage' );
                        $site_title_tag_for_innerpage = BMC\blogmatic_get_customizer_option( 'site_title_tag_for_innerpage' );

                        the_custom_logo();

                        if( wp_get_attachment_image( $dark_mode_site_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="dark-mode-site-logo">'. wp_get_attachment_image( $dark_mode_site_logo, 'full' ) .'</a>';

                        if ( is_front_page() && ! get_custom_logo() && ! wp_get_attachment_image( $dark_mode_site_logo, 'full' ) ) :
                            echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
                        else :
                            echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
                        endif;
                    }
                ?>
            </div>
        <?php
    }
    add_action( 'blogmatic_footer_logo_hook', 'blogmatic_footer_logo_part', 10 );
endif;

if( ! function_exists( 'blogmatic_footer_social_icons' ) ) :
   /**
    * Bottom Footer copyright element
    * 
    * @since 1.0.0
    */
    function blogmatic_footer_social_icons() {
        require get_template_directory() . '/inc/hooks/top-header-hooks.php'; // footer hooks.

        $footer_social_icons_hover_animation = BMC\blogmatic_get_customizer_option( 'footer_social_icons_hover_animation' );
        $elementClass = 'social-icons-wrap';
        $elementClass .= ' footer';
        if( $footer_social_icons_hover_animation ) $elementClass .= ' blogmatic-show-hover-animation';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php blogmatic_customizer_social_icons( 'footer' ); ?>
            </div>
        <?php
    }
    add_action( 'blogmatic_footer_social_hook', 'blogmatic_footer_social_icons', 10 );
endif;

if( ! function_exists( 'blogmatic_footer_copyright_part' ) ) :
   /**
    * Bottom Footer copyright element
    * 
    * @since 1.0.0
    */
    function blogmatic_footer_copyright_part() {
      $bottom_footer_site_info = BMC\blogmatic_get_customizer_option( 'bottom_footer_site_info' );
      if( ! $bottom_footer_site_info ) return;
     ?>
        <div class="site-info">
            <?php echo wp_kses_post( str_replace( '%year%', date('Y'), $bottom_footer_site_info ) ); ?>
        </div>
     <?php
    }
    add_action( 'blogmatic_footer_copyright_hook', 'blogmatic_footer_copyright_part', 10 );
endif;

if( ! function_exists( 'blogmatic_you_may_have_missed_html' ) ) :
    /**
     * You May Have Missed Section html
     * 
     * @since 1.0.0
     */
    function blogmatic_you_may_have_missed_html() {
        if( ! BMC\blogmatic_get_customizer_option( 'you_may_have_missed_section_option' ) || is_paged() ) return;
        // post query
        $you_may_have_missed_post_categories = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_categories' );
        $you_may_have_missed_tags = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_tags' );
        $you_may_have_missed_authors = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_authors' );
        $you_may_have_missed_posts_to_include = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_posts_to_include' );
        $you_may_have_missed_posts_to_exclude = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_posts_to_exclude' );
        $you_may_have_missed_post_order = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_order' );
        $you_may_have_missed_no_of_posts_to_show = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_no_of_posts_to_show' );
        $you_may_have_missed_post_offset = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_offset' );
        $hide_posts_with_no_featured_image = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_hide_post_with_no_featured_image' );
        $post_categories_id_args = ( ! empty( $you_may_have_missed_post_categories ) ) ? implode( ",", array_column( $you_may_have_missed_post_categories, 'value' ) ) : '';
        $post_authors_id_args = ( ! empty( $you_may_have_missed_authors ) ) ? implode( ",", array_column( $you_may_have_missed_authors, 'value' ) ) : '';
        $post_tags_id_args = ( ! empty( $you_may_have_missed_tags ) ) ? array_column( $you_may_have_missed_tags, 'value' ) : '';
        $post_to_include_id_args = ( ! empty( $you_may_have_missed_posts_to_include ) ) ? array_column( $you_may_have_missed_posts_to_include, 'value' ) : '';
        $post_to_exclude_id_args = ( ! empty( $you_may_have_missed_posts_to_exclude ) ) ? array_column( $you_may_have_missed_posts_to_exclude, 'value' ) : '';

        // post elements
        $show_title = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_elements_show_title' );
        $show_categories = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_elements_show_categories' );
        $show_date = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_elements_show_date' );
        $show_author = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_elements_show_author' );
        // image settings and slider settings
        $you_may_have_missed_image_sizes = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_image_sizes' );
        $you_may_have_missed_no_of_columns = absint( BMC\blogmatic_get_customizer_option( 'you_may_have_missed_no_of_columns' ) );
        $you_may_have_missed_layouts = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_layouts' ) ;

        $post_title_html_tag = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_design_post_title_html_tag' ) ;

        // element class
        $elementClass = 'blogmatic-you-may-have-missed-section';
        $elementClass .= ( $you_may_have_missed_no_of_columns ) ? ' no-of-columns--'. blogmatic_convert_number_to_numeric_string( $you_may_have_missed_no_of_columns ) : '';

        $you_may_have_missed_aligment = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_post_elements_alignment' );
        $elementClass .= ' you-may-have-missed-align--'. $you_may_have_missed_aligment;
        $elementClass .= ' section--'. $you_may_have_missed_layouts;
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogmatic-you-may-have-missed-section">
                <div class="blogmatic-you-may-missed-inner-wrap">
                    <?php
                        $you_may_have_missed_title_option = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_title_option' );
                        if( $you_may_have_missed_title_option ) :
                            $you_may_have_missed_title = BMC\blogmatic_get_customizer_option( 'you_may_have_missed_title' );
                            if( $you_may_have_missed_title ) :
                                ?>
                                    <div class="section-title"><?php echo esc_html( $you_may_have_missed_title ); ?></div>
                                <?php
                            endif;
                        endif;
                    ?>
                    <div class="you-may-have-missed-wrap">
                        <?php
                            $post_order = explode( '-', $you_may_have_missed_post_order );
                            $post_query_args = [
                                'post_type' =>  'post',
                                'post_status'  =>  'publish',
                                'offset'    =>  absint( $you_may_have_missed_post_offset ),
                                'posts_per_page'    =>  absint( $you_may_have_missed_no_of_posts_to_show ),
                                'order' =>  $post_order[1],
                                'order_by'  =>  $post_order[1],
                                'ignore_sticky_posts'   =>  true
                            ];
                            if( isset( $you_may_have_missed_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
                            if( isset( $you_may_have_missed_tags ) ) $post_query_args['tag__in'] = $post_tags_id_args;
                            if( isset( $you_may_have_missed_authors ) ) $post_query_args['author'] = $post_authors_id_args;
                            if( isset( $you_may_have_missed_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
                            if( isset( $you_may_have_missed_posts_to_exclude ) ) $post_query_args['post__not_in'] = $post_to_exclude_id_args;
                            if( $hide_posts_with_no_featured_image ) :
                                $post_query_args['meta_query'] = [
                                    [
                                        'key'   =>  '_thumbnail_id',
                                        'compare'   =>  'EXISTS'
                                    ]
                                ];
                            endif;
                            $post_query = new \WP_Query( $post_query_args );
                            if( $post_query->have_posts() ) :
                                while( $post_query->have_posts() ) :
                                    $post_query->the_post();
                                    ?>
                                        <article class="post-item">
                                            <figure class="post-thumbnail-wrapper">
                                                <div class="post-thumnail-inner-wrapper">
                                                    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                                        <?php if( has_post_thumbnail() ) the_post_thumbnail( $you_may_have_missed_image_sizes ); ?>
                                                    </a>
                                                </div>
                                            <?php if( $you_may_have_missed_layouts == 'list' ) echo '</figure>'; ?>
                                                <div class="inner-content">
                                                    <div class="content-wrap">
                                                        <div class="blogmatic-inner-content-wrap-fi">
                                                            <?php 
                                                                if( $show_categories ) blogmatic_get_post_categories( get_the_ID(), 2 );
                                                                if( $show_title ) the_title( '<'. esc_html( $post_title_html_tag ) .' class="entry-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></'. esc_html( $post_title_html_tag ) .'>' );
                                                                if( $show_author || $show_date ) :
                                                                    echo '<div class="post-meta">';
                                                                        if( $show_author ) blogmatic_posted_by( 'you-may-have-missed' );
                                                                        if( $show_date ) blogmatic_posted_on( get_the_ID(), 'you-may-have-missed' );
                                                                    echo '</div>';
                                                                endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php if( $you_may_have_missed_layouts == 'grid' ) echo '</figure>'; ?>
                                        </article>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogmatic_you_may_have_missed_hook', 'blogmatic_you_may_have_missed_html', 10 );
endif;

if( ! function_exists( 'blogmatic_footer_menu' ) ) :
    /**
     * Footer menu
     * 
     * @since 1.0.0
     */
    function blogmatic_footer_menu() {
        $footer_menu_control = BMC\blogmatic_get_customizer_option( 'footer_menu_control' );
        if( $footer_menu_control === 'none' ) return;
        wp_nav_menu(
            array(
                'menu'        => $footer_menu_control,
                'container_class' =>    'blogmatic-secondary-menu-container' 
            )
        );
    }
    add_action( 'blogmatic_footer__menu_section_hook', 'blogmatic_footer_menu' );
endif;