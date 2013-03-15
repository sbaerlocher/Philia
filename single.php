<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="entry-meta">
						<?php sutra_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php if (has_post_thumbnail()) { ?>
							<div class="featured-image-single">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php } ?>
						

						
						<?php the_content(); ?>
						
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sutra' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php if ( count( get_the_category() ) ) : ?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'sutra' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
							</span>
							<span class="meta-sep">|</span>
						<?php endif; ?>
						<?php
							$tags_list = get_the_tag_list( '', ', ' );
							if ( $tags_list ):
						?>
							<span class="tag-links">
								<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'sutra' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
							</span>
							<span class="meta-sep">|</span>
						<?php endif; ?>
						<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sutra' ), __( '1 Comment', 'sutra' ), __( '% Comments', 'sutra' ) ); ?></span>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; /* end of the loop */ ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>