<?php
/**
 * Includes functions for selective refresh
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;
if( ! function_exists( 'blogmatic_customize_selective_refresh' ) ) :
    /**
     * Adds partial refresh for the customizer preview
     */
    function blogmatic_customize_selective_refresh( $wp_customize ) {
        if ( ! isset( $wp_customize->selective_refresh ) ) return;

        // dark mode site logo 
        $wp_customize->selective_refresh->add_partial( 'dark_mode_site_logo', [
            'selector'        => '#masthead .site-branding .dark-mode-site-logo',
            'render_callback' => 'blogmatic_dark_mode_site_logo'
        ]);

        // breadcrumb separator icon 
        $wp_customize->selective_refresh->add_partial( 'breadcrumb_separator_icon', [
            'selector'        => 'body.single .blogmatic-breadcrumb-wrap .item-separator',
            'render_callback' => 'blogmatic_breadcrumb_separator_icon'
        ]);

        // scroll to top icon 
        $wp_customize->selective_refresh->add_partial( 'stt_icon', [
            'selector'        => '#blogmatic-scroll-to-top .icon-holder',
            'render_callback' => 'blogmatic_stt_icon_callback'
        ]);

        // instagram button icon
        $wp_customize->selective_refresh->add_partial( 'instagram_button_icon', [
            'selector'        => '.blogmatic-instagram-section .instagram-button .instagram-icon',
            'render_callback' => 'blogmatic_instagram_button_icon_callback'
        ]);

        // footer instagram button icon
        $wp_customize->selective_refresh->add_partial( 'footer_instagram_button_icon', [
            'selector'        => 'footer .blogmatic-instagram-section .instagram-button .instagram-icon',
            'render_callback' => 'blogmatic_instagram_button_icon_callback'
        ]);

        // custom button icon 
        $wp_customize->selective_refresh->add_partial( 'custom_button_icon', [
            'selector'        => 'body .custom-button-icon',
            'render_callback' => 'blogmatic_custom_button_icon_callback'
        ]);

        // theme mode light icon
        $wp_customize->selective_refresh->add_partial( 'theme_mode_dark_icon', [
            'selector'        => 'body .mode-toggle-wrap .mode-toggle',
            'render_callback' => 'blogmatic_theme_mode_callback'
        ]);

        // theme mode light icon
        $wp_customize->selective_refresh->add_partial( 'theme_mode_light_icon', [
            'selector'        => 'body .mode-toggle-wrap .mode-toggle',
            'render_callback' => 'blogmatic_theme_mode_callback'
        ]);

        // 404 button icon
        $wp_customize->selective_refresh->add_partial( 'error_page_button_icon', [
            'selector'        => 'body.error404 .back_to_home_btn a',
            'render_callback' => 'blogmatic_error_page_button_icon_callback'
        ]);

        // archive read more button label
		$wp_customize->selective_refresh->add_partial( 'global_button_icon_picker', [
            'selector'        => 'article .content-wrap .post-button .button-icon',
            'render_callback' => 'blogmatic_global_button',
        ]);

        $post_format_partial_args = [ 'audio', 'gallery', 'image', 'standard', 'video', 'quote' ];
        if( ! empty( $post_format_partial_args ) && is_array( $post_format_partial_args ) ) :
            foreach( $post_format_partial_args as $format ):
                $wp_customize->selective_refresh->add_partial( $format . '_post_format_icon_picker', [
                    'selector'        => 'article.format-'. $format .' .post-format-ss-wrap .post-format-icon',
                    'render_callback' => 'blogmatic_'. $format .'_post_format_icon',
                ]);
            endforeach;
        endif;
    }
    add_action( 'customize_register', 'blogmatic_customize_selective_refresh' );
endif;

// dark mode site logo callback
function blogmatic_dark_mode_site_logo() {
    $dark_mode_site_logo = BMC\blogmatic_get_customizer_option( 'dark_mode_site_logo' );
    return ( '<a href="'. home_url() .'" class="dark-mode-site-logo">'. wp_get_attachment_image( $dark_mode_site_logo, 'full' ) .'</a>' );
}

// breadcrumb separator icon callback
function blogmatic_breadcrumb_separator_icon() {
    $breadcrumb_separator_icon = BMC\blogmatic_get_customizer_option( 'breadcrumb_separator_icon' );
    return blogmatic_get_icon_control_html( $breadcrumb_separator_icon );
}

// scroll to top icon callback
function blogmatic_stt_icon_callback() {
    $stt_icon = BMC\blogmatic_get_customizer_option( 'stt_icon' );
    return blogmatic_get_icon_control_html( $stt_icon );
}

// instagram button icon callback
function blogmatic_instagram_button_icon_callback() {
    $instagram_button_icon = BMC\blogmatic_get_customizer_option( 'instagram_button_icon' );
    return blogmatic_get_icon_control_html( $instagram_button_icon );
}

// custom button icon callback
function blogmatic_custom_button_icon_callback() {
    $custom_button_icon = BMC\blogmatic_get_customizer_option( 'custom_button_icon' );
    return blogmatic_get_icon_control_html( $custom_button_icon );
}

// theme mode callback
function blogmatic_theme_mode_callback() {
    $theme_mode_light_icon = BMC\blogmatic_get_customizer_option( 'theme_mode_light_icon' );
    $theme_mode_dark_icon = BMC\blogmatic_get_customizer_option( 'theme_mode_dark_icon' );
    blogmatic_theme_mode_switch( $theme_mode_light_icon, 'light' );
    blogmatic_theme_mode_switch( $theme_mode_dark_icon, 'dark' );
}

// 404 button icon callback
function blogmatic_error_page_button_icon_callback() {
    $error_page_button_icon = BMC\blogmatic_get_customizer_option( 'error_page_button_icon' );
    $error_page_button_text = BMC\blogmatic_get_customizer_option( 'error_page_button_text' );
    return blogmatic_get_icon_control_html( $error_page_button_icon ) . '<span class="button-label">'. esc_html( $error_page_button_text ) .'</span>';
}

// global button label
function blogmatic_global_button() {
    $global_button_icon_picker = BMC\blogmatic_get_customizer_option( 'global_button_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $global_button_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// audio post format icon
function blogmatic_audio_post_format_icon() {
    $audio_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'audio_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $audio_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// gallery post format icon
function blogmatic_gallery_post_format_icon() {
    $gallery_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'gallery_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $gallery_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// image post format icon
function blogmatic_image_post_format_icon() {
    $image_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'image_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $image_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// standard post format icon
function blogmatic_standard_post_format_icon() {
    $standard_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'standard_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $standard_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// video post format icon
function blogmatic_video_post_format_icon() {
    $video_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'video_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $video_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// quote post format icon
function blogmatic_quote_post_format_icon() {
    $quote_post_format_icon_picker = BMC\blogmatic_get_customizer_option( 'quote_post_format_icon_picker' );
	$icon_html = blogmatic_get_icon_control_html( $quote_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}