<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php wp_title('&laquo;', true, 'right'); ?></title>
<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/favicon.ico">
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> >
