<?php
/**
 * Handle the wigets files and hooks
 * 
 * @package Blogmatic Pro
 * @since 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogmatic_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blogmatic-pro' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// left sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'blogmatic-pro' ),
			'id'            => 'sidebar-left',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// header toggle sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Canvas Menu Sidebar', 'blogmatic-pro' ),
			'id'            => 'canvas-menu-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);
	
	// footer sidebar - column 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 1', 'blogmatic-pro' ),
			'id'            => 'footer-sidebar-column-one',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 2', 'blogmatic-pro' ),
			'id'            => 'footer-sidebar-column-two',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 3', 'blogmatic-pro' ),
			'id'            => 'footer-sidebar-column-three',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 4
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 4', 'blogmatic-pro' ),
			'id'            => 'footer-sidebar-column-four',
			'description'   => esc_html__( 'Add widgets here.', 'blogmatic-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_widget( 'Blgocast_WP_Heading_Widget' );
	register_widget( 'Blogmatic_Author_Info_Widget' );
	register_widget( 'Blogmatic_Category_Collection_Widget' );
	register_widget( 'Blogmatic_Tags_Collection_Widget' );
	register_widget( 'Blogmatic_Post_Grid_Widget' );
	register_widget( 'Blogmatic_Post_List_Widget' );
	register_widget( 'Blogmatic_Social_Platforms_Widget' );
	register_widget( 'Blogmatic_Video_Playlist_Widget' );
	register_widget( 'Blogmatic_Instagram_Widget' );
	register_widget( 'Blogmatic_Carousel_Widget' );
	register_widget( 'Blogmatic_Posts_Grid_Two_Column_Widget' );
}
add_action( 'widgets_init', 'blogmatic_widgets_init' );

if( ! function_exists( 'blogmatic_widget_scripts' ) ) :
	/**
	 * Enqueue styles and scripts for widget
	 * 
	 * @since 1.0.0
	 * @package Blogmatic Pro
	 */
	function blogmatic_widget_scripts( $hook ) {
		if( $hook != 'widgets.php' ) return;
		wp_enqueue_style( 'blogmatic-widget', get_template_directory_uri() .'/inc/widgets/assets/widget.css', [], BLOGMATIC_VERSION );
		wp_enqueue_style( 'fontaweseome', get_template_directory_uri() . '/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );
		wp_enqueue_style( 'blogmatic-select2', get_template_directory_uri() . '/assets/external/select2/select2.min.css', [], '4.1.0', 'all' );
		wp_enqueue_media();
		wp_enqueue_script( 'blogmatic-widget', get_template_directory_uri() .'/inc/widgets/assets/widget.js', ['jquery'], BLOGMATIC_VERSION, true );
		wp_enqueue_script( 'blogmatic-select2', get_template_directory_uri() .'/assets/external/select2/select2.min.js', ['jquery'], BLOGMATIC_VERSION, true );
		wp_localize_script( 'blogmatic-widget', 'widgetData', [
			'widgetAjaxUrl'	=>	admin_url( 'admin-ajax.php' ),
			'widgetNonce'	=>	wp_create_nonce( 'blogmatic_widget_nonce' )
		]
		);
	}
	add_action( 'admin_enqueue_scripts', 'blogmatic_widget_scripts' );
endif;

require get_template_directory() . '/inc/widgets/heading.php';
require get_template_directory() . '/inc/widgets/author-info.php';
require get_template_directory() . '/inc/widgets/category-collection.php';
require get_template_directory() . '/inc/widgets/tags-collection.php';
require get_template_directory() . '/inc/widgets/post-grid.php';
require get_template_directory() . '/inc/widgets/post-list.php';
require get_template_directory() . '/inc/widgets/social-platforms.php';
require get_template_directory() . '/inc/widgets/video-playlist.php';
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/instagram.php';
require get_template_directory() . '/inc/widgets/carousel.php';
require get_template_directory() . '/inc/widgets/posts-grid-two-column.php';