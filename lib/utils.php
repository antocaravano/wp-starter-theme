<?php 
/*********************************************************
					 UTILS
*********************************************************/
function main_setup() {

	global $my_site_slug;

	// rendo tutto traducibile
	load_theme_textdomain( $my_site_slug, get_template_directory() . '/languages' );

	// aggiunge lo stile per admin
	add_editor_style();

	// aggiunge il feed rss
	add_theme_support( 'automatic-feed-links' );
	
	// aggiunge title tag
	add_theme_support( 'title-tag' );
	
	// aggiunge il supporto alle immagini di anteprima e relativi formati
	add_theme_support( 'post-thumbnails');
	//add_image_size( 'img-370x220', 370, 220, true );

	
	// registra i menu di navigazione
	function custom_menu() {
		$locations = array(
			'top-menu' => __( 'Top Menu'),
			'footer-menu' => __( 'Footer Menu'),
		);
	
		register_nav_menus( $locations );
	}
		
	add_action( 'init', 'custom_menu' );
	
	

}
add_action( 'after_setup_theme', 'main_setup' );


// Add Altrosito Favicon
function favicon_admin(){
echo '<link rel="shortcut icon" href="http://www.altrosito.it/favicon.ico" />',"\n";
}

add_action('admin_head','favicon_admin');


// Remove Wp Emoji :)
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


/*------------------------------------------------------------------------*\
	Search query
\*------------------------------------------------------------------------*/
add_action( 'pre_get_posts', function ( $query ) {
	if (is_search()) {
    	$query->set( 'posts_per_page', 20 );
		return; 
	}
}, 1 );


/*------------------------------------------------------------------------*\
	LOG fn
\*------------------------------------------------------------------------*/
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
		ob_start();
		var_dump($message);
		$message = ob_get_clean();
        error_log( $message );
      } else {
        error_log( $message );
      }
    }
  }
}

/*------------------------------------*\
	CUSTOM EXCERPT
\*------------------------------------*/
if (!function_exists('getCustomExcerpt')) {
	function getCustomExcerpt($text, $length = 20, $strip_tags = false) {
		$text = $strip_tags ? strip_tags($text) : $text;
		$text = explode(' ', $text, $length);
		if (count($text)>=$length) {
			array_pop($text);
			$text = implode(" ",$text).'...';
		} else {
			$text = implode(" ",$text);
		}	
		$text = preg_replace('/\[.+\]/','', $text);
		//$text = apply_filters('the_content', $text); 
		$text = str_replace(']]>', ']]&gt;', $text);
		return $text;
	}
}

function set_maintenance_mode($on_or_off) {
	$fileOn = $_SERVER['DOCUMENT_ROOT']."/.maintenance";
	$fileOff = $_SERVER['DOCUMENT_ROOT']."/.maintenance.off";
	if ($on_or_off == 'on') {
		if (file_exists($fileOff)) rename($fileOff, $fileOn);
	} else {
		if (file_exists($fileOn)) rename($fileOn, $fileOff);
	}
}



/*********************************************************
					DASHBOARD
*********************************************************/

// aggiunge immagine di login personalizzata al login
function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_template_directory_uri()."/assets/img/logo.png') no-repeat scroll center top transparent;
		width:320px;
		height:80px;
		
	}
	</style>
	";
}

add_action("login_head", "my_login_head");

// rimuove il logo di wp nella barra di admin
function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);



// aggiunge testo personalizzato nel footer dell'admin
function remove_footer_admin () {
	global $my_site_name;
    echo '&copy; '.$my_site_name; 
}

add_filter('admin_footer_text', 'remove_footer_admin');


// rimuove i commenti
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// aggiunge benvenuto e versione
function wpc_dashboard_widget_function() {
	global $my_site_version;
	global $wp_version;
	// Entering the text between the quotes
	echo "<ul>";
	echo "<li>Versione ".$my_site_version."</li>";
	echo '<li>Versione Wordpress in uso: '.$wp_version.'</li>';
	echo "</ul>";
}


// aggiungi metabox dashboard
function wpc_add_dashboard_widgets() {
	global $my_site_name;
	wp_add_dashboard_widget('wp_dashboard_widget', $my_site_name, 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );


// rimuove widget dashboard
function wpc_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');



