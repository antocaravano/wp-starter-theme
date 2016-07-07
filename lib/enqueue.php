<?php


/*********************************************************
					CSS
*********************************************************/
function add_css_styles() {
	
	// add bootstrap
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/assets/css/bootstrap.css');

	// add main style
    wp_enqueue_style( 'app-css', get_template_directory_uri().'/assets/css/app.css');
    
    // add google fonts
    wp_register_style('googleFont', 'http://fonts.googleapis.com/css?family='.GOOGLE_FONT1.':'.GOOGLE_FONT1_WEIGHT.'|'.GOOGLE_FONT2.':'.GOOGLE_FONT2_WEIGHT.'');
    wp_enqueue_style('googleFont');

}

add_action( 'wp_enqueue_scripts', 'add_css_styles' );


function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin.css');
  
}
add_action('admin_enqueue_scripts', 'admin_style');

remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// load css into the login page
function enqueue_login_style() {
    wp_enqueue_style( 'login-admin-style', get_template_directory_uri() . '/assets/css/login.css' ); 
}
add_action( 'login_enqueue_scripts', 'enqueue_login_style' );



/*********************************************************
				JS
*********************************************************/


function add_js_scripts() {
	


	wp_register_script( 'vendor-js', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), '1.0', false );
	wp_enqueue_script( 'vendor-js' );
	
	
	if(is_page_template('tpl-contatti.php')) {
		wp_register_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_MAPS_API_KEY.'&callback=initMap', array('gmap-js'), '1.0', true); // Custom scripts
		wp_enqueue_script('gmaps'); // Enqueue it!
		wp_register_script('gmap-js', get_template_directory_uri() . '/assets/js/gmap.js', array('jquery'), '1.0', true ); // Custom scripts
		wp_enqueue_script('gmap-js'); // Enqueue it!
		wp_localize_script( 'gmap-js', 'gmap_js_data', array( 
			'marker_uri' => get_template_directory_uri() . "/assets/img/map_marker.png"
		));	
	}
	
	wp_register_script( 'app-js', get_template_directory_uri() . '/assets/js/app.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'app-js' );
}

add_action( 'wp_enqueue_scripts', 'add_js_scripts' );





