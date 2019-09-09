<?php
/**
 * Changelog
 */

$Matrix_lite = wp_get_theme( 'matrix' );

?>
<div class="matrix-lite-tab-pane" id="changelog">

	<div class="matrix-tab-pane-center">
	
		<h1>matrix Lite <?php if( !empty($Matrix_lite['Version']) ): ?> <sup id="matrix-lite-theme-version"><?php echo esc_attr( $Matrix_lite['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$Matrix_lite_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
	$Matrix_lite_changelog_lines = explode(PHP_EOL, $Matrix_lite_changelog);
	foreach($Matrix_lite_changelog_lines as $Matrix_lite_changelog_line){
		if(substr( $Matrix_lite_changelog_line, 0, 3 ) === "###"){
			echo '<h1>'.substr($Matrix_lite_changelog_line,3).'</h1>';
		} else {
			echo $Matrix_lite_changelog_line,'<br/>';
		}
	}

	?>
	
</div>