<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'sutra' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<?php wp_head(); ?>
</head>

<?php
	$options = philia_get_theme_options();
	if ( 'off' == $options['show_rss_link']
		&& ''  == $options['twitter_url']
		&& ''  == $options['facebook_url']
		&& ''  == $options['google_url']
		&& ''  == $options['flickr_url']
		&& ! is_active_sidebar( 'sidebar-1' )
	)
		return;
?>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="main">
		<div id="header">					
			<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="site-description"><?php bloginfo( 'description' ); ?></div>
			<?php // shows header image if uploaded 
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
			<?php endif; ?>
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

						<?php if ( ''!= $options['gravatar_url'] ) : ?>
							<li><a class="gravatar-link" href="<?php echo esc_url( $options['gravatar_url'] ); ?>" title="<?php esc_attr_e( 'Gravatar', 'sundance' ); ?>"><span><?php _e( 'Gravatar', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['github_url'] ) : ?>
							<li><a class="github-link" href="<?php echo esc_url( $options['github_url'] ); ?>" title="<?php esc_attr_e( 'Github', 'sundance' ); ?>"><span><?php _e( 'Github', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['linkedin_url'] ) : ?>
							<li><a class="linkedin-link" href="<?php echo esc_url( $options['linkedin_url'] ); ?>" title="<?php esc_attr_e( 'Linkedin', 'sundance' ); ?>"><span><?php _e( 'Linkedin', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['pinterest_url'] ) : ?>
							<li><a class="pinterest-link" href="<?php echo esc_url( $options['pinterest_url'] ); ?>" title="<?php esc_attr_e( 'Pinterest', 'sundance' ); ?>"><span><?php _e( 'Pinterest', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['bitbucket_url'] ) : ?>
							<li><a class="bitbucket-link" href="<?php echo esc_url( $options['bitbucket_url'] ); ?>" title="<?php esc_attr_e( 'bitbucket', 'sundance' ); ?>"><span><?php _e( 'bitbucket', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

						<?php if ( ''!= $options['skype_url'] ) : ?>
							<li><a class="skype-link" href="<?php echo esc_url( $options['skype_url'] ); ?>" title="<?php esc_attr_e( 'bitbucket', 'sundance' ); ?>"><span><?php _e( 'bitbucket', 'sundance' ); ?></span></a></li>
						<?php endif; ?>

				</div>
			<?php // mobile menu 
		    wp_nav_menu( array( 
		    	'theme_location' => 'primary', 
		    	'menu_id' => 'mobile-menu',
		    	'menu_class' => 'mobile-menu'
		    )); 
			?>
		</div><!-- #header -->