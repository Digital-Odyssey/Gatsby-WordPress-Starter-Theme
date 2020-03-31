<?php

add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

function pm_ln_theme_setup() {

	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;

	/***** CUSTOMIZER ***************************************************************************************************/
	include_once(get_template_directory() . "/includes/classes/customizer/customizer.php");

	/***** REST API ***************************************************************************************************/
	include_once(get_template_directory() . "/includes/classes/rest_api/customizer_options.class.php");
	include_once(get_template_directory() . "/includes/classes/rest_api/sidebars.class.php");

	/***** CUSTOM POST TYPES ***************************************************************************************************/
	include_once(get_template_directory() . "/includes/cpt/portfolio_cpt.php");

	/***** WIDGETS
	 ****************************************************************************************************/	
	include_once(get_template_directory() . "/includes/widgets/video_widget.php");
	
	/***** THEME SUPPORT ***************************************************************************************************/
	add_theme_support('custom-logo');
	add_theme_support('menus');
	add_theme_support('post-thumbnails');	

	/***** ACTIONS ***************************************************************************************************/
	add_action('init', 'pm_ln_create_portfolio_post_type');
	add_action('save_post', 'pm_ln_build_netlify');	
	add_action('widgets_init', 'pm_ln_widgets_init');
	add_action('rest_api_init', 'pm_ln_register_rest_routes');

}

// Function to register our new routes from the controller.
function pm_ln_register_rest_routes() {
    $controller = new My_Customizer_Options_Controller();
	$controller->register_routes();

	$sidebars = new My_Sidebars_Controller();
	$sidebars->register_routes();
}


function pm_ln_widgets_init() {
		
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'gatsby-starter' ),
		'id'            => 'page-sidebar',
		'description'   => esc_html__( 'Adding widgets here will appear in your page template sidebar.', 'gatsby-starter' ),
		'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'gatsby-starter' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Adding widgets here will appear in your blog template sidebar.', 'gatsby-starter' ),
		'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'gatsby-starter' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Adding widgets here will appear in the footer area.', 'gatsby-starter' ),
		'before_widget' => '<div id="%1$s" class="widget pm-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}

function pm_ln_build_netlify() {
	wp_remote_post(NT_HOOK);
}
