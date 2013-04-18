<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Philia
 * @since Phila
 */
?>

	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">
			<div id="site-info">
				&copy; <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->
		</div><!-- #colophon -->
	</div><!-- #footer -->	
</div><!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>