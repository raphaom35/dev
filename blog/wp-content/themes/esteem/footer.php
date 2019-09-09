<?php 
/**
 * Theme Footer Section for our theme.
 * 
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage Esteem
 * @since Esteem 1.0
 */
?>
</div><!--#main -->
<?php do_action( 'esteem_before_footer' ); ?>
<footer id="colophon" class="clearfix">
	<?php get_sidebar( 'footer' ); ?>
	<div id="site-generator" class="inner-wrap">
		<?php do_action( 'esteem_footer_copyright' ); ?>
	</div><!-- #site-generator -->
</footer>
<a href="#masthead" id="scroll-up"><i class="icon-angle-up"></i></a>
</div>
<?php wp_footer(); ?>
</body>
</html>