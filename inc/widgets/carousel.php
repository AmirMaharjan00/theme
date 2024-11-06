<?php
/**
 * Adds Blogmatic_Carousel_Widget widget.
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
class Blogmatic_Carousel_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'blogmatic_carousel_widget',
            esc_html__( 'Blogmatic : Carousel Posts', 'blogmatic-pro' ),
            array( 'description' => __( 'A collection of posts from specific category for carousel slide.', 'blogmatic-pro' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_category = isset( $instance['posts_category'] ) ? $instance['posts_category'] : '';
        $slider_auto = isset( $instance['slider_auto'] ) ? $instance['slider_auto'] : true;
        $slider_arrows = isset( $instance['slider_arrows'] ) ? $instance['slider_arrows'] : true;
        $slider_loop = isset( $instance['slider_loop'] ) ? $instance['slider_loop'] : true;
        $slide_direction = isset( $instance['slide_direction'] ) ? $instance['slide_direction'] : 'vertical';
        
        echo wp_kses_post($before_widget);
            // Slider direction
            $blogmatic_widget_attr = '';
            if( $slide_direction == 'horizontal' ) {
                $blogmatic_widget_attr .= ' blogmatic_horizontal_slider';
            } else {
                $blogmatic_widget_attr .= ' blogmatic_vertical_slider';
            }
            if( empty( $widget_title ) ) $blogmatic_widget_attr .= ' no_heading_widget';
            ?>
            <div class="blogmatic-widget-carousel-posts<?php echo esc_attr( $blogmatic_widget_attr ); ?>">
                <?php if ($widget_title ): ?>
                    <h2 class="widget-title">
                        <span><?php echo esc_html($widget_title); ?></span>
                    </h2>
                <?php endif; ?>
                <div class="carousel-posts-wrap blogmatic-card swiper" data-auto="<?php echo esc_attr( json_encode( $slider_auto ) ); ?>" data-arrows="<?php echo esc_attr( json_encode( $slider_arrows ) ); ?>" data-loop="<?php echo esc_attr( json_encode( $slider_loop ) ); ?>" data-vertical="<?php echo esc_attr( $slide_direction ); ?>">
                    <div class="swiper-wrapper">
                        <?php
                            $carousel_posts_args = array( 
                                        'numberposts' => -1,
                                        'cat' => absint( $posts_category )
                                    );
                            if( empty( $posts_category ) ) $carousel_posts_args['numberposts'] = 4;
                            $carousel_posts = get_posts( apply_filters( 'blogmatic_query_args_filter', $carousel_posts_args ) );
                            if( $carousel_posts ) :
                                $total_posts = sizeof($carousel_posts);
                                foreach( $carousel_posts as $carousel_post_key => $carousel_post ) :
                                    $carousel_post_id  = $carousel_post->ID;
                                ?>
                                        <article class="post-item swiper-slide <?php if(!has_post_thumbnail($carousel_post_id)){ echo esc_attr(' no-feat-img');} ?>">
                                            <figure class="post-thumb-wrap">
                                                <?php if( has_post_thumbnail($carousel_post_id) ): ?> 
                                                    <a href="<?php echo esc_url(get_the_permalink($carousel_post_id)); ?>">
                                                        <img src="<?php echo esc_url( get_the_post_thumbnail_url($carousel_post_id, 'blogmatic-list') ); ?>" loading="lazy"/>
                                                        <div class="thumb-overlay"></div>
                                                    </a>
                                                <?php endif; ?>
                                                <?php blogmatic_get_post_categories( $carousel_post_id, 2 ); ?>
                                            </figure>
                                            <div class="post-element">
                                                <h2 class="post-title"><a href="<?php the_permalink($carousel_post_id); ?>"><?php echo wp_kses_post( get_the_title($carousel_post_id) ); ?></a></h2>
                                                <div class="post-meta">
                                                    <?php blogmatic_posted_on( $carousel_post_id ); ?>
                                                </div>
                                            </div>
                                        </article>
                                <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                    <?php if( $slider_arrows ) : ?>
                        <div class="custom-button-prev swiper-arrow"><i class="fas fa-chevron-left"></i></div>
                        <div class="custom-button-next swiper-arrow"><i class="fas fa-chevron-right"></i></div>
                    <?php endif; ?>
                </div>
            </div>
    <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $categories = get_categories();
        $categories_options[''] = esc_html__( 'Select category', 'blogmatic-pro' );
        foreach( $categories as $category ) :
            $categories_options[$category->term_id] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'blogmatic-pro' ),
                    'description'=> esc_html__( 'Add the widget title here', 'blogmatic-pro' ),
                    'default'   => esc_html__( 'Highlights', 'blogmatic-pro' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'blogmatic-pro' ),
                    'description'=> esc_html__( 'Choose the category to display for carousel posts', 'blogmatic-pro' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'slider_auto',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Enable slider item to auto slide', 'blogmatic-pro' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'slider_arrows',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show slider controller arrows', 'blogmatic-pro' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'slider_loop',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Enable infinite loop', 'blogmatic-pro' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'slide_direction',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Slide Direction', 'blogmatic-pro' ),
                    'options'   => array(
                        'vertical'    => esc_html__( 'Vertical', 'blogmatic-pro' ),
                        'horizontal'    => esc_html__( 'Horizontal', 'blogmatic-pro' )
                    ),
                    'default'   =>  'horizontal'
                )
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            blogmatic_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = blogmatic_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class Blogmatic_Carousel_Widget