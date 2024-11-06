<?php
/**
 * Adds blogmatic video playlist widget
 * 
 * @since 1.0.0
 * @package Blogmatic Pro
 */

 class Blogmatic_Video_Playlist_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogmatic_video_playlist_widget',
            esc_html__( 'Blogmatic: Video Playlist', 'blogmatic-pro' ),
            [ 'description' =>  __( 'A playlist of videos', 'blogmatic-pro' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        echo wp_kses_post( $before_widget );
            if( $widget_title ) echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            ?>
                <div class="video-playlist-widget">
                    <?php get_template_part( 'template-parts/video-playlist/video-playlist', '', ['widget'  =>  true] ); ?>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        return [
            [
                'title' =>  esc_html__( 'Widget Title', 'blogmatic-pro' ),
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'description'   =>  esc_html__( 'Add the widget title here', 'blogmatic-pro' ),
                'default'   =>  esc_html__( 'Video Playlist', 'blogmatic-pro' )
            ]
        ];
    }

    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if( isset( $instance[ $widget_field['name'] ] ) ) :
                $field_value = $instance[ $widget_field['name'] ];
            elseif( isset( $widget_field['default'] ) ) :
                $field_value = $widget_field['default'];
            else:
                $field_value = '';
            endif;
            blogmatic_widget_fields( $this, $widget_field, $field_value );
        endforeach;
        ?>
            <div class="refer-note">
                <p>
                    <?php echo esc_html__( 'Manage video playlist from customizer ', 'blogmatic-pro' ); ?>
                    <a href="<?php echo admin_url( 'customize.php?autofocus[control]=video_playlist_option' ); ?>" target="_blank"><?php echo esc_html__( 'go to manage video playlist', 'blogmatic-pro' ); ?></a>
                </p>
            </div>
        <?php
    }

    public function update( $new_instance, $old_instance ){
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) return;
        foreach( $widget_fields as $widget_field ) :
            $instance[ $widget_field['name'] ] = blogmatic_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;
        return $instance;
    }
 }