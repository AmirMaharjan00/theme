<?php 
/**
 * Search form
 * 
 * @since 1.0.0
 * @package Blogmatic Pro
 */
use Blogmatic\CustomizerDefault as BMC;
$search_page_button_text = BMC\blogmatic_get_customizer_option( 'search_page_button_text' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label>
    <span class="screen-reader-text">
        <?php
            /* translators: Hidden accessibility text. */
            _x( 'Search for:', 'label', 'blogmatic-pro' );
        ?>
    </span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blogmatic-pro' ); ?>" value="<?php echo get_search_query()?>" name="s" />
</label>
<input type="submit" class="search-submit" value="<?php echo esc_attr( $search_page_button_text ); ?>" />
</form>