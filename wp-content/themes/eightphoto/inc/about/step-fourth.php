<?php
/**
 * Changelog
 */

$eightphoto = wp_get_theme( 'eightphoto' );
?>
<div class="featured-section changelog">
<?php
	WP_Filesystem();
	global $wp_filesystem;
	$eightphoto_changelog       = $wp_filesystem->get_contents( get_template_directory() . '/readme.txt' );
	$changelog_start = strpos($eightphoto_changelog,'== Changelog ==');
	$eightphoto_changelog_before = substr($eightphoto_changelog,0,($changelog_start+17));
	$eightphoto_changelog = str_replace($eightphoto_changelog_before,'',$eightphoto_changelog);
	$eightphoto_changelog_lines = explode( PHP_EOL, $eightphoto_changelog );
	foreach ( $eightphoto_changelog_lines as $eightphoto_changelog_line ) {
		if ( substr( $eightphoto_changelog_line, 0, 5 ) === "= 1.0" ) {
			echo '<h4>' . substr( $eightphoto_changelog_line,0, 10 ) . '</h4>';
		} else {
			echo esc_html( $eightphoto_changelog_line ), '<br/>';
		}
	}
	echo '<hr />';
	?>
</div>