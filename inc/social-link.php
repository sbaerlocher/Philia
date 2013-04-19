<?php
/**
 * Philia Social Links
 *
 * @package Philia
 * @since Philia 1.0
 */

/**
 * Register the form setting for our philia_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, philia_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Philia 1.0
 */
function philia_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === philia_get_theme_options() )
		add_option( 'philia_theme_options', philia_get_default_theme_options() );

	register_setting(
		'philia_options', // Options group, see settings_fields() call in philia_theme_options_render_page()
		'philia_theme_options', // Database option, see philia_get_theme_options()
		'philia_theme_options_validate' // The sanitization callback, see philia_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see philia_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'show_rss_link', // Unique identifier for the field for this section
		__( 'RSS Link', 'philia' ), // Setting field label
		'philia_settings_field_checkbox', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see philia_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'twitter_url', __( 'Twitter Link', 'philia' ), 'philia_twitter_text_input', 'theme_options', 'general' );
	add_settings_field( 'facebook_url', __( 'Facebook Link', 'philia' ), 'philia_facebook_text_input', 'theme_options', 'general' );
	add_settings_field( 'twitter_url', __( 'twitter Link', 'philia' ), 'philia_twitter_text_input', 'theme_options', 'general' );
	add_settings_field( 'google_url', __( 'Google Plus Link', 'philia' ), 'philia_google_text_input', 'theme_options', 'general' );
	add_settings_field( 'gravatar_url', __( 'Gravatar Link', 'philia' ), 'philia_gravatar_text_input', 'theme_options', 'general' );
	add_settings_field( 'github_url', __( 'Github Link', 'philia' ), 'philia_github_text_input', 'theme_options', 'general' );
	add_settings_field( 'linkedin_url', __( 'Linkedin Plus Link', 'philia' ), 'philia_linkedin_text_input', 'theme_options', 'general' );
	add_settings_field( 'pinterest_url', __( 'Pinterest Link', 'philia' ), 'philia_pinterest_text_input', 'theme_options', 'general' );
	add_settings_field( 'bitbucket_url', __( 'Bitbucket Link', 'philia' ), 'philia_bitbucket_text_input', 'theme_options', 'general' );
	add_settings_field( 'skype_url', __( 'Skype Link', 'philia' ), 'philia_skype_text_input', 'theme_options', 'general' );
}
add_action( 'admin_init', 'philia_theme_options_init' );

/**
 * Change the capability required to save the 'philia_options' options group.
 *
 * @see philia_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see philia_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function philia_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_philia_options', 'philia_option_page_capability' );

/**
 * Add our Social Links page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since philia 1.0
 */
function philia_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Social Links', 'philia' ), // Name of page
		__( 'Social Links', 'philia' ), // Label in menu
		'edit_theme_options', // Capability required
		'theme_options', // Menu slug, used to uniquely identify the page
		'philia_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;
}
add_action( 'admin_menu', 'philia_theme_options_add_page' );

/**
 * Returns the default options for philia.
 *
 * @since philia 1.0
 */
function philia_get_default_theme_options() {
	$default_theme_options = array(
		'show_rss_link'	=> 'off',
		'twitter_url'	=> '',
		'facebook_url'	=> '',
		'google_url'	=> '',
		'gravatar_url'	=> '',
		'github_url'	=> '',
		'linkedin_url'	=> '',
		'pinterest_url'	=> '',
		'bitbucket_url'	=> '',
		'skype_url'	=> ''
	);

	return apply_filters( 'philia_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for philia.
 *
 * @since philia 1.0
 */
function philia_get_theme_options() {
	return get_option( 'philia_theme_options', philia_get_default_theme_options() );
}

/**
 * Renders the checkbox setting field.
 */
function philia_settings_field_checkbox() {
	$options = philia_get_theme_options();
	?>
	<label for="show-rss-link">
		<input type="checkbox" name="philia_theme_options[show_rss_link]" id="show-rss-link" <?php checked( 'on', $options['show_rss_link'] ); ?> />
		<?php _e( 'Show RSS Link in the Sidebar', 'philia' );  ?>
	</label>
	<?php
}

/**
 * Renders the input setting fields.
 */
function philia_twitter_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[twitter_url]" id="twitter_url" value="<?php echo esc_attr( $options['twitter_url'] ); ?>" />
		<label class="description" for="twitter-url"><?php _e( 'Enter your Twitter URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_facebook_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[facebook_url]" id="facebook_url" value="<?php echo esc_attr( $options['facebook_url'] ); ?>" />
		<label class="description" for="facebook-url"><?php _e( 'Enter your Facebook URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_google_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[google_url]" id="google_url" value="<?php echo esc_attr( $options['google_url'] ); ?>" />
		<label class="description" for="google-url"><?php _e( 'Enter your Google+ URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_gravatar_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[gravatar_url]" id="gravatar_url" value="<?php echo esc_attr( $options['gravatar_url'] ); ?>" />
		<label class="description" for="gravatar-url"><?php _e( 'Enter your Gravatar URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_github_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[github_url]" id="github_url" value="<?php echo esc_attr( $options['github_url'] ); ?>" />
		<label class="description" for="github-url"><?php _e( 'Enter your Github URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_linkedin_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[linkedin_url]" id="linkedin_url" value="<?php echo esc_attr( $options['linkedin_url'] ); ?>" />
		<label class="description" for="linkedin-url"><?php _e( 'Enter your Linkedin URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_pinterest_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[pinterest_url]" id="pinterest_url" value="<?php echo esc_attr( $options['pinterest_url'] ); ?>" />
		<label class="description" for="pinterest-url"><?php _e( 'Enter your Pinterest URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_bitbucket_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[bitbucket_url]" id="bitbucket_url" value="<?php echo esc_attr( $options['bitbucket_url'] ); ?>" />
		<label class="description" for="bitbucket-url"><?php _e( 'Enter your Bitbucket URL', 'philia' ); ?></label>
	</div>
	<?php
}

function philia_skype_text_input() {
	$options = philia_get_theme_options();
	?>
	<div>
		<input type="text" name="philia_theme_options[skype_url]" id="skype_url" value="<?php echo esc_attr( $options['skype_url'] ); ?>" />
		<label class="description" for="skype-url"><?php _e( 'Enter your Flickr URL', 'philia' ); ?></label>
	</div>
	<?php
}

/**
 * Returns the options array for philia.
 *
 * @since philia 1.0
 */
function philia_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Social Link', 'philia' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'philia_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see philia_theme_options_init()
 *
 * @since philia 1.0
 */
function philia_theme_options_validate( $input ) {
	$output = $defaults = philia_get_default_theme_options();

	// The checkbox should either be on or off
	if ( ! isset( $input['show_rss_link'] ) )
		$input['show_rss_link'] = 'off';
		$output['show_rss_link'] = ( $input['show_rss_link'] == 'on' ? 'on' : 'off' );

	// The text input must be safe text with no HTML tags and encode the URL
	if ( isset( $input['twitter_url'] ) ) :
		$output['twitter_url'] = esc_url_raw( $input['twitter_url'] );
	endif;

	if ( isset( $input['facebook_url'] ) ) :
		$output['facebook_url'] = esc_url_raw( $input['facebook_url'] );
	endif;

	if ( isset( $input['google_url'] ) ) :
		$output['google_url'] = esc_url_raw( $input['google_url'] );
	endif;

	if ( isset( $input['gravatar_url'] ) ) :
		$output['gravatar_url'] = esc_url_raw( $input['gravatar_url'] );
	endif;

	if ( isset( $input['github_url'] ) ) :
		$output['github_url'] = esc_url_raw( $input['github_url'] );
	endif;

	if ( isset( $input['linkedin_url'] ) ) :
		$output['linkedin_url'] = esc_url_raw( $input['linkedin_url'] );
	endif;

	if ( isset( $input['pinterest_url'] ) ) :
		$output['pinterest_url'] = esc_url_raw( $input['pinterest_url'] );
	endif;

	if ( isset( $input['bitbucket_url'] ) ) :
		$output['bitbucket_url'] = esc_url_raw( $input['bitbucket_url'] );
	endif;

	if ( isset( $input['skype_url'] ) ) :
		$output['skype_url'] = esc_url_raw( $input['skype_url'] );
	endif;




	return apply_filters( 'philia_theme_options_validate', $output, $input, $defaults );
}