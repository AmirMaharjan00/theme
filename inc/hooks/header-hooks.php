<?php
/**
 * Header hooks and functions
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */
use Blogmatic\CustomizerDefault as BMC;

if( ! function_exists( 'blogmatic_header_site_branding_part' ) ) :
    /**
     * Header site branding element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_site_branding_part() {
        ?>
            <div class="site-branding">
                <?php
                    $site_title_tag_for_frontpage = BMC\blogmatic_get_customizer_option( 'site_title_tag_for_frontpage' );
                    $site_title_tag_for_innerpage = BMC\blogmatic_get_customizer_option( 'site_title_tag_for_innerpage' );
                    $site_description_show_hide = BMC\blogmatic_get_customizer_option( 'blogdescription_option' );
                    $dark_mode_site_logo = BMC\blogmatic_get_customizer_option( 'dark_mode_site_logo' );

                    the_custom_logo();

                    if( wp_get_attachment_image( $dark_mode_site_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="dark-mode-site-logo">'. wp_get_attachment_image( $dark_mode_site_logo, 'full' ) .'</a>';

                    if ( is_front_page() ) :
                        echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
                    else :
                        echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
                    endif;
                    $blogmatic_description = get_bloginfo( 'description', 'display' );
                    if( $site_description_show_hide ) :
                        if ( $blogmatic_description ) echo '<p class="site-description">'. $blogmatic_description .'</p>';
                    endif;
                ?>
            </div><!-- .site-branding -->
        <?php
    }
    add_action( 'blogmatic_header__site_branding_section_hook', 'blogmatic_header_site_branding_part', 10 );
endif;

if( ! function_exists( 'blogmatic_header_main_advertisement_part' ) ) :
    /**
     * Header advertisement banner element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_main_advertisement_part() {
        $header_ads_banner_image = BMC\blogmatic_get_customizer_option( 'header_ads_banner_image' );
        $header_ads_banner_image_link_url = BMC\blogmatic_get_customizer_option( 'header_ads_banner_image_link_url' );
        if( ! wp_get_attachment_image_url( $header_ads_banner_image, 'full' ) ) return;
        ?>
            <div class="advertisement-banner">
                <?php 
                    $header_ads_banner_image_url = BMC\blogmatic_get_customizer_option( 'header_ads_banner_image_url' );
                    $header_ads_banner_image_target_attr = BMC\blogmatic_get_customizer_option( 'header_ads_banner_image_target_attr' );
                    $header_ads_banner_image_rel_attr = BMC\blogmatic_get_customizer_option( 'header_ads_banner_image_rel_attr' );
                ?>
                <?php if( $header_ads_banner_image_link_url ): ?>
                    <a href="<?php echo esc_url( $header_ads_banner_image_url ); ?>" target="<?php echo esc_attr( $header_ads_banner_image_target_attr ); ?>" rel="<?php echo esc_attr( $header_ads_banner_image_rel_attr ); ?>">
                        <img src="<?php echo esc_url( wp_get_attachment_image_url( $header_ads_banner_image, 'full' ) ); ?>" loading="lazy" />
                    </a>
                <?php else: ?>
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $header_ads_banner_image, 'full' ) ); ?>" loading="lazy" />
                <?php endif; ?>
            </div><!-- .advertisement-banner -->
        <?php
    }
    add_action( 'blogmatic_header_main_advertisement_hook', 'blogmatic_header_main_advertisement_part', 10 );
endif;

if( ! function_exists( 'blogmatic_header_menu_part' ) ) :
    /**
     * Header menu element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_menu_part() {
        $nav_classes = 'hover-effect--' . BMC\blogmatic_get_customizer_option( 'header_menu_hover_effect' );
      ?>
        <div class="site-navigation-wrapper">
            <nav id="site-navigation" class="main-navigation <?php echo esc_attr( $nav_classes ); ?>">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <div id="blogmatic-menu-burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="menu-txt"><?php esc_html_e( 'Menu', 'blogmatic-pro' ); ?></span>
                </button>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'container_class' =>    'blogmatic-primary-menu-container'
                        )
                    );
                ?>
            </nav><!-- #site-navigation -->
        </div>
      <?php
    }
    add_action( 'blogmatic_header__menu_section_hook', 'blogmatic_header_menu_part', 10 );
 endif;

 if( ! function_exists( 'blogmatic_header_custom_button_part' ) ) :
    /**
     * Header custom button element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_custom_button_part() {
        $custom_button_redirect_link = BMC\blogmatic_get_customizer_option( 'custom_button_redirect_href_link' );
        $custom_button_label = BMC\blogmatic_get_customizer_option( 'custom_button_label' );
        $custom_button_icon = BMC\blogmatic_get_customizer_option( 'custom_button_icon' );
        $custom_button_target = BMC\blogmatic_get_customizer_option( 'custom_button_target' );
        $custom_button_icon_context = BMC\blogmatic_get_customizer_option( 'custom_button_icon_prefix_suffix' );
        $custom_button_animation_type = BMC\blogmatic_get_customizer_option( 'custom_button_animation_type' );
        
        $elementClass = 'header-custom-button';
        $elementClass .= ' animation-type--'. $custom_button_animation_type;
        ?>
            <div class="header-custom-button-wrapper">
                <a class="<?php echo esc_attr( $elementClass ); ?>" href="<?php echo esc_url( $custom_button_redirect_link ); ?>" target="<?php echo esc_attr( $custom_button_target ); ?>">
                    <?php
                        if( $custom_button_icon_context == 'prefix' ) :
                            if( $custom_button_icon['type'] == 'icon' ) {
                                if( $custom_button_icon['value'] != 'fas fa-ban' ) echo '<span class="custom-button-icon"><i class="'. esc_attr( $custom_button_icon['value'] ) .'"></i></span>';
                            } else {
                                if( $custom_button_icon['type'] != 'none' ) echo '<span class="custom-button-icon">'. wp_get_attachment_image( $custom_button_icon['value'], 'full' ) .'</span>';
                            }
                        endif;
    
                        if( $custom_button_label ) echo '<span class="custom-button-label">' . esc_html( $custom_button_label ) .'</span>';
    
                        if( $custom_button_icon_context == 'suffix' ) :
                            if( $custom_button_icon['type'] == 'icon' ) {
                                if( $custom_button_icon['value'] != 'fas fa-ban' ) echo '<span class="custom-button-icon icon_after"><i class="'. esc_attr( $custom_button_icon['value'] ) .'"></i></span>';
                            } else {
                                if( $custom_button_icon['type'] != 'none' ) echo '<span class="custom-button-icon icon_after">'. wp_get_attachment_image( $custom_button_icon['value'], 'full' ) .'</span>';
                            }
                        endif;
                    ?>
                </a>
            </div>
        <?php
    }
    add_action( 'blogmatic_header__custom_button_section_hook', 'blogmatic_header_custom_button_part', 10 );
 endif;

 if( ! function_exists( 'blogmatic_header_search_part' ) ) :
    /**
     * Header live search element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_search_part() {
        $search_type = BMC\blogmatic_get_customizer_option( 'search_type' );
        $classes = 'search-wrap';
        $classes .= ' search-type--' . esc_html( $search_type );
        ?>
            <div class="<?php echo esc_attr( $classes ); ?>">
                <button class="search-trigger"><i class="fas fa-search"></i></button>
                <div class="search-form-wrap">
                    <?php echo get_search_form(); ?>
                    <button class="search-form-close"><i class="fas fa-times"></i></button>
                </div>
            </div>
        <?php
    }
    add_action( 'blogmatic_header_search_hook', 'blogmatic_header_search_part', 10 );
 endif;

 if( ! function_exists( 'blogmatic_header_theme_mode_part' ) ) :
    /**
     * Header theme mode element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_theme_mode_part() {
        $light_mode_icon_args = BMC\blogmatic_get_customizer_option( 'theme_mode_light_icon' );
        $dark_mode_icon_args = BMC\blogmatic_get_customizer_option( 'theme_mode_dark_icon' );
        $light_mode_icon_class = ( array_key_exists( 'value', $light_mode_icon_args ) && is_array( $light_mode_icon_args ) ) ? $light_mode_icon_args['value'] : '';
        $dark_mode_icon_class = ( array_key_exists( 'value', $dark_mode_icon_args ) && is_array( $dark_mode_icon_args ) ) ? $dark_mode_icon_args['value'] : '';
        ?>
            <div class="mode-toggle-wrap">
                <span class="mode-toggle">
                    <?php 
                        blogmatic_theme_mode_switch( $light_mode_icon_args, 'light' );
                        blogmatic_theme_mode_switch( $dark_mode_icon_args, 'dark' );
                    ?>
                </span>
            </div>
        <?php
    }
    add_action( 'blogmatic_header_theme_mode_hook', 'blogmatic_header_theme_mode_part', 10 );
 endif;

 if( ! function_exists( 'blogmatic_header_canvas_menu_part' ) ) :
    /**
     * Header canvas menu element
     * 
     * @since 1.0.0
     */
    function blogmatic_header_canvas_menu_part() {
        $elementClass = 'blogmatic-canvas-menu';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <span class="canvas-menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <div class="canvas-menu-sidebar">
                    <?php if( is_active_sidebar( 'canvas-menu-sidebar' ) ) dynamic_sidebar( 'canvas-menu-sidebar' ); ?>
                </div>
            </div>
        <?php
    }
    add_action( 'blogmatic_header_off_canvas_hook', 'blogmatic_header_canvas_menu_part', 10 );
 endif;

 if( ! function_exists( 'blogmatic_before_content_advertisement_part' ) ) :
    /**
     * Blogmatic main banner element
     * 
     * @since 1.0.0
     */
    function blogmatic_before_content_advertisement_part() {
        $advertisement_repeater = BMC\blogmatic_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $before_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_before_post_content' ) ) return ( $element->item_checkbox_before_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $before_content_advertisement ) ) return;
        $image_option = array_column( $before_content_advertisement, 'item_image_option' );
        $alignment = array_column( $before_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogmatic-advertisement-section-before-content blogmatic-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogmatic-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $before_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>" loading="lazy">
                                            </a>
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
    add_action( 'blogmatic_before_single_content_hook', 'blogmatic_before_content_advertisement_part' );
 endif;

 if( ! function_exists( 'blogmatic_after_content_advertisement_part' ) ) :
    /**
     * Blogmatic main banner element
     * 
     * @since 1.0.0
     */
    function blogmatic_after_content_advertisement_part() {
        $advertisement_repeater = BMC\blogmatic_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $after_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_after_post_content' ) ) return ( $element->item_checkbox_after_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $after_content_advertisement ) ) return;
        $image_option = array_column( $after_content_advertisement, 'item_image_option' );
        $alignment = array_column( $after_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogmatic-advertisement-section-after-content blogmatic-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogmatic-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $after_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>" loading="lazy">
                                            </a>
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
    add_action( 'blogmatic_after_single_content_hook', 'blogmatic_after_content_advertisement_part' );
 endif;

 if( ! function_exists( 'blogmatic_get_background_and_cursor_animation' ) ) :
    /**
     * Renders html for cursor and background animation
     * 
     * @since 1.0.0
     */
    function blogmatic_get_background_and_cursor_animation() {
        $site_background_animation = BMC\blogmatic_get_customizer_option( 'site_background_animation' );
        if( $site_background_animation ) blogmatic_shooting_star_animation_html();
        $cursor_animation = BMC\blogmatic_get_customizer_option( 'cursor_animation' );
        $cursorclass = 'blogmatic-cursor';
        if( $cursor_animation != 'none' ) $cursorclass .= ' type--' . $cursor_animation;
        if( in_array( $cursor_animation, [ 'one', 'two' ] ) ) echo '<div class="'. esc_attr( $cursorclass ) .'"></div>';
    }
    add_action( 'blogmatic_animation_hook', 'blogmatic_get_background_and_cursor_animation' );
 endif;

 if( ! function_exists( 'blogmatic_get_toggle_button_html' ) ) :
    /**
     * Toggle Button Widget html
     * 
     * @since 1.0.0
     */
    function blogmatic_get_toggle_button_html() {
        ?>
            <div class="toggle-button-wrapper">
                <span class="canvas-menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
        <?php
    }
  endif;

  if( ! function_exists( 'blogmatic_customizer_social_icons' ) ) :
	/**
	 * Function to get social icons from customizer
	 * 
	 * @since 1.0.0
	 * @package Blogmatic Pro
	 */
	function blogmatic_customizer_social_icons( $type = '' ) {
        $placement = ( $type !== '' ) ? $type . '_' : '';
		$social_icons_target = BMC\blogmatic_get_customizer_option( $placement . 'social_icons_target' );
		$social_icons = BMC\blogmatic_get_customizer_option( $placement . 'social_icons' );
		$social_icon_official_color_inherit = BMC\blogmatic_get_customizer_option( $placement . 'social_icon_official_color_inherit' );
		$social_icons_decode = json_decode( $social_icons );
		$elementClass = 'blogmatic-social-icon';
		if( $social_icon_official_color_inherit ) $elementClass .= ' official-color--enabled';
		echo '<div class="'. esc_attr( $elementClass ) .'">';
			foreach( $social_icons_decode as $social_icon ) :
				if( $social_icon->item_option == 'show' ) echo '<a href="'. esc_url( $social_icon->icon_url ) .'"><i class="'. esc_attr( $social_icon->icon_class ) .'"></i></a>';
			endforeach;
		echo '</div>';
	}
endif;