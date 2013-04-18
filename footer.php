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

<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
				&copy; <?php echo date(Y); ?><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> <?php bloginfo( 'name' ); ?></a>
				<span class="sep"> | </span>
				<?php if ( ! dynamic_sidebar( 'primary-footer-area' ) ) : ?>	
				<?php printf( __( 'Theme: %1$s by %2$s.', 'Philia' ), '<a href="http://sbaerlocher.ch/philia" rel="designer">Philia</a>', '<a href="http://sbaerlocher.ch/" rel="designer">sbaerlocher.ch</a>' ); ?>
				<span class="sep"> | </span>
				<?php printf( __( 'Hosting: by %1$s.', 'Philia' ), '<a href="http://p7v.net/" rel="designer">p7v.net</a>' ); ?>	
				<?php endif;  ?>
			</div><!-- #site-info -->
		</div><!-- #colophon -->
	</div><!-- #footer -->	
</div><!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>