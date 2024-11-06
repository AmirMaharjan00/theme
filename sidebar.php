<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogmatic Pro
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
use Blogmatic\CustomizerDefault as BMC;
$archive_right_sidebar_on_mobile = BMC\blogmatic_get_customizer_option( 'show_right_sidebar_mobile_option' );
$asideClass = 'widget-area';
if( ! $archive_right_sidebar_on_mobile ) $asideClass .= ' hide-on-mobile';
?>

<aside id="secondary" class="<?php echo esc_attr( $asideClass ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
