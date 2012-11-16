<?php

/** Tell WordPress to run sutra_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'sutra_setup' );


function sutra_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	if ( ! isset( $content_width ) ) $content_width = 1100;

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'sutra', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'sutra' ),
	) );
	
	// This theme allows users to set a custom background
	add_custom_background();
}

/* 
Add first & last class to navigation 
*/

function sutra_add_markup_pages($output) {
    $output= preg_replace('/menu-item/', 'first-menu-item menu-item', $output, 1);
	$output=substr_replace($output, "last-menu-item menu-item", strripos($output, "menu-item"), strlen("menu-item"));
    return $output;
}
add_filter('wp_nav_menu', 'sutra_add_markup_pages');

/*
Add Google Font
*/ 
add_action('wp_head', 'sutra_my_google_webfont', 5); // hook my_google_webfont() into wp_head()
function sutra_my_google_webfont(){
wp_register_style('OFL+Sorts+Mill+Goudy+TT', 'http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT', array(), false, 'screen'); // register the stylesheet
wp_enqueue_style('OFL+Sorts+Mill+Goudy+TT'); // print the stylesheet into page
}

/*
Various Post Thumbnail Sizes
*/

add_image_size( 'large', 640, 640, true ); // Large thumbnails
add_image_size( 'medium', 300, 300, true ); // Medium thumbnails
add_image_size( 'small', 150, 150, true ); // Small thumbnails

/*
Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
*/
function sutra_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'sutra' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'sutra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running sutra_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'sutra_widgets_init' );

/* 
category id in body and post class 
*/
function sutra_category_id_class($classes) {
	global $post;
	if( isset( $post ) ):
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	endif;
}

/*
Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
*/
function sutra_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sutra_page_menu_args' );

/*
Sets the post excerpt length to 40 characters.
*/
function sutra_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'sutra_excerpt_length' );

/*
Returns a "Continue Reading" link for excerpts
*/
function sutra_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sutra' ) . '</a>';
}

/*
Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sutra_continue_reading_link().
 */
function sutra_auto_excerpt_more( $more ) {
	return ' &hellip;' . sutra_continue_reading_link();
}
add_filter( 'excerpt_more', 'sutra_auto_excerpt_more' );

/*
Adds a pretty "Continue Reading" link to custom post excerpts.
*/
function sutra_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= sutra_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sutra_custom_excerpt_more' );

/*
Remove inline styles printed when the gallery shortcode is used.
*/
function sutra_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'sutra_remove_gallery_css' );

/*
Template for comments and pingbacks.
Used as a callback by wp_list_comments() for displaying the comments.
*/
function sutra_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'sutra' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'sutra' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'sutra' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'sutra' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sutra' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'sutra'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

/*
Removes the default styles that are packaged with the Recent Comments widget.
*/
function sutra_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'sutra_remove_recent_comments_style' );

/*
Prints HTML with meta information for the current post—date/time and author.
 */
function sutra_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'sutra' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'sutra' ), get_the_author() ),
			get_the_author()
		)
	);
}

function sutra_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sutra' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sutra' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sutra' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

/*
Styling body classes:
- Adds classes to <body> for unique page styles. ie. Contact page gets body class 'page-contact'.
*/
function add_body_class( $classes )
{
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_body_class' );

/*
Pagination 
*/
function sutra_navigation(){
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain'
		);
	
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	
	echo paginate_links( $pagination );
}

?>