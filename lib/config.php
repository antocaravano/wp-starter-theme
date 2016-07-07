<?php 
/*********************************************************
CONFIG
*********************************************************/
$my_site_name = 'Wp Starter Theme';
$my_site_slug = 'wpstartertheme';
$my_wp_version = $wp_version;
$my_site_version = '07/2016';

if (!defined('SITE_PREFIX')) {
	define("SITE_PREFIX", "wpstartertheme");
}
define("GOOGLE_MAPS_API_KEY", "");
define("CONTATTI_PAGE_ID", 16);

define("GOOGLE_FONT1", "Lato");
define("GOOGLE_FONT1_WEIGHT", "300,400");

define("GOOGLE_FONT2", "Roboto");
define("GOOGLE_FONT2_WEIGHT", "300,400");



/*------------------------------------------------------------------------*\
	Mail from
\*------------------------------------------------------------------------*/
define("DEFAULT_EMAIL_CONTACT", "test@test.it"); // non dovrebbe servire dato che è impostato da backend wp
define("DEFAULT_EMAIL_MITTENTE", "test@test.it");
define("DEFAULT_NAME_MITTENTE", "Nome mittente");
add_filter( 'wp_mail_from', function ( $email ) {
	$email_mittente = get_field('contatti_email_mittente', 'option');
	if (!$email_mittente) $email_mittente = DEFAULT_EMAIL_MITTENTE;
    return $email_mittente;
});
add_filter( 'wp_mail_from_name', function ( $name ) {
	$nome_mittente = get_field('contatti_nome_mittente', 'option');
	if (!$nome_mittente) $nome_mittente = DEFAULT_NAME_MITTENTE;
    return $nome_mittente;
});


/*------------------------------------------------------------------------*\
	Allow SVG uploads
\*------------------------------------------------------------------------*/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');