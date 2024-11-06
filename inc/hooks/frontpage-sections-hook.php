<?php
/**
 * Frontpage section hooks and function for the theme
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;
 
 if( ! function_exists( 'blogmatic_article_masonry' ) ) :
    /**
     * Masonry articles element
     * 
     * @package Blogmatic Pro
     * @since 1.0.0
     */
    function blogmatic_article_masonry() {
        $query_args = [
            'post_type' =>  'post',
            'post_status'   =>  'publish'
        ];
        $post_query = new \WP_Query( apply_filters( 'blogmatic_query_args_filter', $query_args ) );
        if( $post_query->have_posts() ) :
            while( $post_query->have_posts() ) :
                $post_query->the_post();
            endwhile;
        endif;
    }
    add_action( 'blogmatic_masonry_articles_hook', 'blogmatic_article_masonry' );
 endif;
