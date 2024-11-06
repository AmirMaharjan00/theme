<?php
/**
 * Top Header hooks and functions
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if( ! function_exists( 'blogmatic_date_time_part' ) ) :
    /**
     * Top header menu element
     * 
    * @since 1.0.0
    */
    function blogmatic_date_time_part() {
        $elementClass = 'top-date-time';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <span class="top-date-time-inner">
                    <span class="time"></span>
                    <span class="date"><?php echo date_i18n( get_option( 'date_format' ), current_time( 'timestamp' )); ?></span>
                </span>
            </div>
        <?php
    }
    add_action( 'blogmatic_date_time_hook', 'blogmatic_date_time_part', 10 );
endif;

if( ! function_exists( 'blogmatic_social_part' ) ) :
    /**
     * Top header social element
     * 
     * @since 1.0.0
     */
    function blogmatic_social_part() {
        $social_icons_hover_animation = BMC\blogmatic_get_customizer_option( 'social_icons_hover_animation' );
        $elementClass = 'social-icons-wrap';
        if( $social_icons_hover_animation ) $elementClass .= ' blogmatic-show-hover-animation';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php blogmatic_customizer_social_icons(); ?>
            </div>
        <?php
    }
    add_action( 'blogmatic_social_icons_hook', 'blogmatic_social_part', 10 );
endif;