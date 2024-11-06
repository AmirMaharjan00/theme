<?php
/**
 * The left sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogmatic Pro
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
use Blogmatic\CustomizerDefault as BMC;
$archive_left_sidebar_on_mobile = BMC\blogmatic_get_customizer_option( 'show_left_sidebar_mobile_option' );
$asideClass = 'widget-area';
if( ! $archive_left_sidebar_on_mobile ) $asideClass .= ' hide-on-mobile';
?>
<aside id="secondary-aside" class="<?php echo esc_attr( $asideClass ); ?>">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside><!-- #secondary-aside -->