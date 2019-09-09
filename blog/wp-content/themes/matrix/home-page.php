<?php
/* Template Name: Home */
get_header();
$matrix_theme_options = matrix_theme_options();
foreach($matrix_theme_options['home_sections'] as $section){
	get_template_part('home',$section);
}
get_footer();
?>