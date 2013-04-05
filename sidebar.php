
		<div id="sidebar" class="widget-area" role="complementary">
			<ul class="xoxo">

				<li id="sidebar-menu" class="widget-container">
					<h3 class="widget-title">Menu</h3>
					<?php wp_nav_menu( array( 
						'container_class' => 'menu-header', 
						'theme_location' => 'primary' 
						) ); 
					?>
				</li>

			<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
				<li id="categories" class="widget-container">
					<h3 class="widget-title">Categories</h3>
					<ul>
						<?php wp_list_categories('title_li'); ?>
					</ul>
				</li>		
			
				<li id="archives" class="widget-container">
					<h3 class="widget-title"><?php _e( 'Archives', 'sutra' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</li>

			<?php endif;  ?>
		
			</ul>
		</div><!-- #sidebar .widget-area -->
