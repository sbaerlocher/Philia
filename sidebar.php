<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Philia
 * @since Philia
 */

$options = philia_get_theme_options();
?>
		<div id="sidebar" class="widget-area" role="complementary">
			<ul class="xoxo">
				<div id="syndicate">
					<?php if ( 'off' != $options['show_rss_link'] ) : ?>
						<li><a class="rss-link" href="<?php echo get_feed_link( 'rss2' ); ?>" title="<?php esc_attr_e( 'RSS', 'sundance' ); ?>"><span><?php _e( 'RSS Feed', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['facebook_url'] ) : ?>
						<li><a class="facebook-link" href="<?php echo esc_url( $options['facebook_url'] ); ?>" title="<?php esc_attr_e( 'Facebook', 'sundance' ); ?>"><span><?php _e( 'Facebook', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['twitter_url'] ) : ?>
						<li><a class="twitter-link" href="<?php echo esc_url( $options['twitter_url'] ); ?>" title="<?php esc_attr_e( 'Twitter', 'sundance' ); ?>"><span><?php _e( 'Twitter', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['google_url'] ) : ?>
						<li><a class="google-link" href="<?php echo esc_url( $options['google_url'] ); ?>" title="<?php esc_attr_e( 'Google+', 'sundance' ); ?>"><span><?php _e( 'Google Plus', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['instagram_url'] ) : ?>
						<li><a class="instagram-link" href="<?php echo esc_url( $options['instagram_url'] ); ?>" title="<?php esc_attr_e( 'Instagram', 'sundance' ); ?>"><span><?php _e( 'Instagram', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['pinterest_url'] ) : ?>
						<li><a class="pinterest-link" href="<?php echo esc_url( $options['pinterest_url'] ); ?>" title="<?php esc_attr_e( 'Pinterest', 'sundance' ); ?>"><span><?php _e( 'Pinterest', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['linkedin_url'] ) : ?>
						<li><a class="linkedin-link" href="<?php echo esc_url( $options['linkedin_url'] ); ?>" title="<?php esc_attr_e( 'Linkedin', 'sundance' ); ?>"><span><?php _e( 'Linkedin', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['xing_url'] ) : ?>
						<li><a class="xing-link" href="<?php echo esc_url( $options['xing_url'] ); ?>" title="<?php esc_attr_e( 'Xing', 'sundance' ); ?>"><span><?php _e( 'Xing', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['gravatar_url'] ) : ?>
						<li><a class="gravatar-link" href="<?php echo esc_url( $options['gravatar_url'] ); ?>" title="<?php esc_attr_e( 'Gravatar', 'sundance' ); ?>"><span><?php _e( 'Gravatar', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['github_url'] ) : ?>
						<li><a class="github-link" href="<?php echo esc_url( $options['github_url'] ); ?>" title="<?php esc_attr_e( 'Github', 'sundance' ); ?>"><span><?php _e( 'Github', 'sundance' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( ''!= $options['bitbucket_url'] ) : ?>
						<li><a class="bitbucket-link" href="<?php echo esc_url( $options['bitbucket_url'] ); ?>" title="<?php esc_attr_e( 'bitbucket', 'sundance' ); ?>"><span><?php _e( 'bitbucket', 'sundance' ); ?></span></a></li>
					<?php endif; ?>
				</div>
				<div>
				<li id="sidebar-menu" class="widget-container">
					<h3 class="widget-title">Menu</h3>
					<?php wp_nav_menu( array( 
						'container_class' => 'menu-header', 
						'theme_location' => 'primary' 
						) ); 
					?>
				</li>
				</div>
			<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
				<li id="categories" class="widget-container">
					<h3 class="widget-title">Categories</h3>
					<ul>
						<?php wp_list_categories('title_li'); ?>
					</ul>
				</li>		
			
				<li id="archives" class="widget-container">
					<h3 class="widget-title"><?php _e( 'Archives', 'philia' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</li>

			<?php endif;  ?>
		
			</ul>
		</div><!-- #sidebar .widget-area -->
