<?php
/**
 * Adds Blogmatic_Posts_Grid_Two_Column_Widget widget.
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
class Blogmatic_Posts_Grid_Two_Column_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'blogmatic_posts_grid_two_column_widget',
            esc_html__( 'Blogmatic : Posts Grid 2 Column', 'blogmatic-pro' ),
            array( 'description' => __( 'A collection of posts from specific category displayed in grid two column layout.', 'blogmatic-pro' ) )
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
        $posts_count = isset( $instance['posts_count'] ) ? $instance['posts_count'] : 4;
        $posts_cat = isset( $instance['posts_cat'] ) ? $instance['posts_cat'] : true;
        $ajax_load_more_option = isset( $instance['ajax_load_more_option'] ) ? $instance['ajax_load_more_option'] : true;
        echo wp_kses_post( $before_widget );
            if ( ! empty( $widget_title ) ) echo $before_title . $widget_title . $after_title;
            $post_args = [
                'cat'    => absint( $posts_category ),
                'posts_per_page' => absint( $posts_count ),
                'ignore_sticky_posts'    => true
            ];
            $post = new WP_Query( apply_filters( 'blogmatic_query_args_filter', $post_args ) );
            $elementClass = 'posts-wrap posts-grid-two-column-wrap feature-post-block';
            $elementClass .= ( $ajax_load_more_option && $post->max_num_pages > 1 ) ? ' load-more--active' : ' load-more--inactive';
            ?>
                <div class="<?php echo esc_attr( $elementClass ); ?>">
                    <?php
                        if( $post->have_posts() ) :
                            while( $post->have_posts() ) : $post->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID() );
                                $categories = get_categories([ 'object_ids' => get_the_ID(), 'number' => 1 ]);
                            ?>
                            <div class="blaze_box_wrap">
                                <div class="post-item format-standard no-category-bk" <?php echo esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                                    <div class="post_thumb_image post-thumb <?php if( ! $thumbnail_url ) echo esc_attr( 'no-feat-img' ); ?>">
                                        <figure class="post-thumb">
                                            <?php if( $thumbnail_url ) : ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" loading="lazy">
                                                </a>
                                            <?php endif;
                                            if( $posts_cat ) :
                                                echo '<div class="bmm-post-cats-wrap bmm-post-meta-item post-categories">';
                                                    $count = 0;
                                                    foreach( $categories as $cat ) {
                                                        echo '<h5 class="card__content-category cat-item cat-' .esc_attr( $cat->cat_ID ). '"><a href="' .esc_url(get_term_link( $cat->cat_ID )). '">' .esc_html( $cat->name ). '</a></h5>';
                                                        if( $count > 0 ) break;
                                                        $count++;
                                                    }
                                                echo '</div>';
                                            endif;
                                        ?>
                                        </figure>
                                    </div>
                                    <div class="post-content-wrap card__content">
                                        <div class="blogmatic-post-title card__content-title post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    ?>
                </div>
            <?php
                if( $ajax_load_more_option && $post->max_num_pages > 1 ) :
                    ?>
                        <div class="blogmatic-widget-loader">
                            <button class="load-more" data-widget="blogmatic_posts_grid_two_column_widget_ajax_call" data-instance="<?php echo esc_attr( json_encode( $instance ) ); ?>"><?php echo esc_html__( 'Show more', 'blogmatic-pro' ); ?></button>
                        </div>
                    <?php
                endif;
        echo wp_kses_post( $after_widget );
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
                    'default'   => esc_html__( 'Latest News', 'blogmatic-pro' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'blogmatic-pro' ),
                    'description'=> esc_html__( 'Choose the category to display list of posts', 'blogmatic-pro' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'posts_count',
                    'type'      => 'number',
                    'title'     => esc_html__( 'Number of posts to show', 'blogmatic-pro' ),
                    'default'   => 6
                ),
                array(
                    'name'      => 'posts_cat',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show post categories', 'blogmatic-pro' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'ajax_load_more_heading',
                    'type'      => 'heading',
                    'label'     => esc_html__( 'Ajax Load More', 'blogmatic-pro' )
                ),
                array(
                    'name'      => 'ajax_load_more_option',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show load more button', 'blogmatic-pro' ),
                    'default'   => true
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
 
} // class Blogmatic_Posts_Grid_Two_Column_Widget