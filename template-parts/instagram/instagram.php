<?php
    /**
     * Template part for displaying instagram
     * 
     * @since 1.0.0
     * @package Blogmatic Pro
     */
    use Blogmatic\CustomizerDefault as BMC;
    $prefix = array_key_exists( 'prefix', $args ) ? $args['prefix'] : '';
    $instagram_repeater = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_repeater' );
    $instagram_repeater_decoded = json_decode( $instagram_repeater, true );
    $instagram_url_image_link = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_url_image_link' );
    $instagram_enable_lightbox = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_enable_lightbox' );
    $instagram_link_target = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_link_target' );
    $instagram_rel_attribute = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_rel_attribute' );
    $instagram_image_size = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_image_size' );
    $show_instagram_button = BMC\blogmatic_get_customizer_option( $prefix . 'show_instagram_button' );
    $instagram_button_url = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_button_url' );
    $instagram_caption = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_caption' );
    $instagram_button_icon = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_button_icon' );
    $instagram_button_text = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_button_text' );
    $instagram_hover_effects = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_hover_effects' );
    $instagram_slider_arrow = BMC\blogmatic_get_customizer_option( $prefix . 'instagram_slider_arrow' );
    $elementClass = 'instagram-container';
    $enable_slider = false;
    if( array_key_exists( 'slider_enable', $args ) && $args['slider_enable'] ) $enable_slider = true;
    if( is_array( $args ) && ! empty( $args ) && array_key_exists( 'widget', $args ) ) :
        $elementClass .= ' hover-effect--' . $instagram_hover_effects;
        if( array_key_exists( 'widget_slider', $args ) && $args['widget_slider'] ) $enable_slider = true;
    endif;
    if( $enable_slider ) $elementClass .= ' slider-enabled swiper';

    $featureClass = 'instagram-content';
    if( $enable_slider ) $featureClass .= ' swiper-wrapper';
    if( ! $instagram_url_image_link ) $featureClass .= ' url-disabled';
    if( $instagram_enable_lightbox ) $featureClass .= ' lightbox-enabled';
?>
<div class="<?php echo esc_attr( $elementClass ); ?>">
    <div class="<?php echo esc_attr( $featureClass ); ?>">
        <?php
            if( ! is_null( $instagram_repeater_decoded ) && is_array( $instagram_repeater_decoded ) ) :
                foreach( $instagram_repeater_decoded as $insta_key => $insta_value ) :
                    if( $insta_value['item_option'] == 'show' ) :
                        $itemClass = 'instagram-item';
                        if( $enable_slider ) $itemClass .= ' swiper-slide';
                        if( is_array( $args ) && ! empty( $args ) && array_key_exists( 'widget', $args ) ) :
                            $itemClass .= ( wp_attachment_is( 'image', $insta_value['item_image'] ) ) ? '' : ' no-insta-image';
                        endif;
                        ?>
                            <div class="<?php echo esc_attr( $itemClass ); ?>">
                                <div class="insta-image">
                                    <a href="<?php echo esc_url( $insta_value['item_url'] ); ?>" target="<?php echo esc_attr( $instagram_link_target ); ?>" rel="<?php echo esc_attr( $instagram_rel_attribute ); ?>">
                                        <?php echo wp_get_attachment_image( $insta_value['item_image'], $instagram_image_size ); ?>
                                    </a>
                                </div>
                                <?php 
                                    if( ! empty( wp_get_attachment_caption( $insta_value['item_image'] ) ) && $instagram_caption ) echo '<span class="instagram-caption">' . wp_get_attachment_caption( $insta_value['item_image'] ) . '</span>';
                                ?>
                            </div>
                        <?php
                    endif;
                endforeach;
            endif;
        ?>
    </div>
    <!-- If we need navigation buttons -->
    <?php
        if( $instagram_slider_arrow && $enable_slider ) :
            $pagination_array = [
                'prev' => $prefix . 'instagram_prev_arrow',
                'next' => $prefix . 'instagram_next_arrow'
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
    <?php if( $show_instagram_button ) : ?>
        <div class="instagram-button">
            <a href="<?php echo esc_url( $instagram_button_url ); ?>">
                <span class="instagram-icon">
                    <?php echo ( $instagram_button_icon['type'] == 'icon' ) ? '<i class="'. esc_attr( $instagram_button_icon['value'] ) .'"></i>' : wp_get_attachment_image( $instagram_button_icon['value'] ); ?>
                </span>
                <span class="instagram-label">
                    <?php echo esc_html( $instagram_button_text ); ?>
                </span>
            </a>
        </div>
    <?php endif; ?>
</div>