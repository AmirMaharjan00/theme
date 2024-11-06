<?php
    /**
     * Template part for displaying video playlist
     * 
     * @since 1.0.0
     * @package Blogmatic Pro
     */

    use Blogmatic\CustomizerDefault as BMC;
    $video_playlist_api_key = BMC\blogmatic_get_customizer_option( 'video_playlist_api_key' );
    $check_api_key_valid_or_not = blogmatic_check_youtube_api_key( $video_playlist_api_key );
    if( is_wp_error( $check_api_key_valid_or_not ) || empty( $video_playlist_api_key ) ) :
        if( is_user_logged_in() ) :
            ?>
                <div class="api-key-not-found">
                    <span class="not-found"><?php echo esc_html__( 'The API key may be incorrect or invalid.', 'blogmatic-pro' );?></span>
                </div>
            <?php
        endif;
        return;
    endif;
    $video_playlist_repeater = BMC\blogmatic_get_customizer_option( 'video_playlist_repeater' );
    $video_playlist_play_icon = BMC\blogmatic_get_customizer_option( 'video_playlist_play_icon' );
    $video_playlist_pause_icon = BMC\blogmatic_get_customizer_option( 'video_playlist_pause_icon' );
    $video_playlist_display_position = BMC\blogmatic_get_customizer_option( 'video_playlist_display_position' );
    $video_playlist_layouts = BMC\blogmatic_get_customizer_option( 'video_playlist_layouts' );
    $video_playlist_slider_arrow = BMC\blogmatic_get_customizer_option( 'video_playlist_slider_arrow' );
    $video_playlist_slider_show_arrow_on_hover = BMC\blogmatic_get_customizer_option( 'video_playlist_slider_show_arrow_on_hover' );
    $elementClass = 'video-playlist-wrap';
    if( is_array( $args ) && ! empty( $args ) && array_key_exists( 'widget', $args ) ) :
        $elementClass .= ' layout--'. $video_playlist_layouts;
        $elementClass .= ' blogmatic-widget';
        if( $video_playlist_layouts == 'two' ) $elementClass .= ' show-arrow-on-hover--'. ( $video_playlist_slider_show_arrow_on_hover ? 'active' : 'inactive' );
    endif;
?>
<div class="<?php echo esc_attr( $elementClass ); ?>">
    <div class="active-player">
        <?php 
            if( $video_playlist_layouts == 'two' ) :
                ?>
                    <div class="thumb-video-highlight-text">
                        <div class="thumb-controller isPaused" data-pause="fa-solid fa-pause" data-play="fa-solid fa-play">
                            <?php
                                if( $video_playlist_play_icon['type'] == 'icon' ) echo '<i class="'. esc_attr( $video_playlist_play_icon['value'] ) .'"></i>';
                                if( $video_playlist_play_icon['type'] == 'svg' ) echo wp_get_attachment_image( $video_playlist_play_icon['value'] );
                            ?>
                        </div>
                        <div class="thumb-title-wrap">
                            <h2 class="video-title"></h2><span class="video-duration"></span>
                        </div>
                    </div>
                <?php
            endif;
        ?>
        <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
    </div>
    <div class="player-list-wrap">
        <?php
            $video_playlist_decoded_args = json_decode( $video_playlist_repeater, true );
            if( $video_playlist_decoded_args ) :
                foreach( $video_playlist_decoded_args as $video_key => $video ) :
                    if( $video['item_option'] == 'show' ) :
                        if( $video['video_url'] ) :
                            $parsed_video_url = parse_url( $video['video_url'] );
                            $url_query = array_key_exists( 'query', $parsed_video_url ) ? $parsed_video_url['query'] : '';
                            parse_str( $url_query, $url_query_array );
                            $video_ids[] = array_key_exists( 'v', $url_query_array ) ? $url_query_array['v'] : '';
                        endif;
                    endif;
                endforeach;
            endif;

            if( $video_ids ) :
                $api_url = "https://www.googleapis.com/youtube/v3/videos?id=" . implode( ',', $video_ids ) . "&key=" . $video_playlist_api_key . "&part=snippet,contentDetails";
                $remote_get_video_info = wp_remote_get( $api_url );
                if( is_wp_error( $remote_get_video_info ) ) :
                    if( is_user_logged_in() ) :
                        ?>
                            <div class="api-key-not-found">
                                <span class="not-found"><?php echo esc_html__( 'Could not connect to the server', 'blogmatic-pro' );?></span>
                            </div>
                        <?php
                    endif;
                else: 
                    $remote_get_video_info_array = json_decode( wp_remote_retrieve_body( $remote_get_video_info ) );
                    if( property_exists( $remote_get_video_info_array, 'errors' ) ) :
                        if( is_user_logged_in() ) :
                            ?>
                                <div class="api-key-not-found">
                                    <span class="not-found"><?php echo esc_html__( 'Api key not valid', 'blogmatic-pro' );?></span>
                                </div>
                            <?php
                        endif;
                    else:
                        if( $video_playlist_layouts == 'one' ) :
                            ?>
                                <div class="thumb-video-highlight-text" <?php if( is_array( $args ) && ! empty( $args ) && array_key_exists( 'widget', $args ) ) esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                                    <div class="thumb-controller isPaused" data-pause="fa-solid fa-pause" data-play="fa-solid fa-play">
                                        <?php
                                            if( $video_playlist_play_icon['type'] == 'icon' ) echo '<i class="'. esc_attr( $video_playlist_play_icon['value'] ) .'"></i>';
                                            if( $video_playlist_play_icon['type'] == 'svg' ) echo wp_get_attachment_image( $video_playlist_play_icon['value'] );
                                        ?>
                                    </div>
                                    <div class="thumb-title-wrap">
                                        <h2 class="video-title"></h2><span class="video-duration"></span>
                                    </div>
                                </div>
                            <?php
                        endif;
                        $itemWrapperClass = 'playlist-items-wrap';
                        if( $video_playlist_layouts === 'two' ) $itemWrapperClass .= ' swiper';
                        echo '<div class="'. esc_attr( $itemWrapperClass ) .'">';
                            if( $video_playlist_layouts === 'two' ) echo '<div class="swiper-wrapper">';
                                if( isset( $remote_get_video_info_array->items ) && $remote_get_video_info_array->items ) :
                                    foreach( $remote_get_video_info_array->items as $remote_get_video_info_key => $remote_get_video_info ):
                                        $video_title = $remote_get_video_info->snippet->title;
                                        $video_url = $remote_get_video_info->snippet->thumbnails->high->url;
                                        $video_duration = $remote_get_video_info->contentDetails->duration;
                                        preg_match_all('/(\d+)/', $video_duration, $video_duration_parts);
                                        $parsed_duration =  isset( $video_duration_parts[0][1] ) ? $video_duration_parts[0][0] . ":" .$video_duration_parts[0][1] : "00 : " . $video_duration_parts[0][0];
                                        $elementClass = 'video-item-box-wrap';
                                        if( $video_playlist_layouts === 'two' ) $elementClass .= ' swiper-slide';
                                        ?>
                                        <div class="<?php echo esc_attr( $elementClass ); ?>" <?php if( is_array( $args ) && ! empty( $args ) && array_key_exists( 'widget', $args ) ) esc_attr( blogmatic_set_aos_animation_data_attribute() ); ?>>
                                            <div class="video-item<?php if( $remote_get_video_info_key == 0 ) { echo " activePlayer"; } else { echo ' onWait'; } ?>" data-id="<?php echo esc_attr( $remote_get_video_info->id ); ?>">
                                                <figure class="video-thumb">
                                                    <img src="<?php echo esc_url( $video_url ); ?>" loading="lazy">
                                                </figure>
                                                <div class="title-wrap">
                                                    <h2 class="video-title"><?php echo esc_html( $video_title ); ?></h2>
                                                    <span class="video-duration"><?php echo esc_html( $parsed_duration ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            if( $video_playlist_layouts === 'two' ) echo '</div>';
                            if( $video_playlist_layouts === 'two' ) echo '</div><!-- .swiper-wrapper -->';
                            /* If we need navigation buttons */
                            if( $video_playlist_layouts === 'two' && $video_playlist_slider_arrow ) :
                            $pagination_array = [
                                'prev' => 'video_playlist_previous_icon',
                                'next' => 'video_playlist_next_icon'
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
                        echo '</div><!-- .playlist-items-wrap -->';
                    endif;
                endif;
            endif;
        ?>
    </div>
</div><!-- .video-playlist-wrap -->