<?php
/**
 * The template for displaying the header
 *
 * @package Divina
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * Preloader
 */
?>
<div id="loading">
	<div id="loading-centro">
		<div id="loading-centro-absolute">
			<div class="oggetto" id="oggetto_four"></div>
			<div class="oggetto" id="oggetto_three"></div>
			<div class="oggetto" id="oggetto_two"></div>
			<div class="oggetto" id="oggetto_one"></div>
		</div>
	</div>
</div>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'divina' ); ?></a>

	<div id="sidebar" class="col-md-4 sidebar">

	

	</div><!-- .sidebar -->

	<div id="content" class="col-md-offset-4 col-md-8 site-content">
