<?php
/**
 * Plugin setup functions and definitions.
 *
 * @package Dignity Health
 */

/**
 * Contact Form 7 Custom tags
 *
 * @link https://wordpress.stackexchange.com/questions/291855/how-to-get-current-url-in-contact-form-7s
 */
function dignity_health_wpcf7_tags() {

  // Add shortcode for the form [current_url]
  wpcf7_add_form_tag( 'current_url', 'dignity_health_wpcf7_current_url', array('name-attr' => true) );

}
add_action('wpcf7_init', 'dignity_health_wpcf7_tags');

/**
 * Contact Form 7 Tag Handlers
 */
function dignity_health_wpcf7_current_url($tag) {

  global $wp;

  $url = home_url( $wp->request );
  return '<input type="hidden" name="' . esc_attr($tag['name']) . '" value="' . esc_url($url) . '" />';

}

/**
 * Template Override
 *
 * @link https://stackoverflow.com/questions/50282564/wordpress-plugin-custom-post-type-single-page/50282943#50282943
 */
function dignity_health_override_single_template($single_template) {

  global $post;

  $file = dignity_health_directory() .'/templates/single-'. $post->post_type .'.php';

  if (file_exists($file)) $single_template = $file;

  return $single_template;

}
add_filter('single_template', 'dignity_health_override_single_template');

/*--------------------------------------------------------------
# Plugin Activation
--------------------------------------------------------------*/
function dignity_health_activation() {
}
register_activation_hook(dignity_health_file(), 'dignity_health_activation');

/*--------------------------------------------------------------
# Plugin Deactivation
--------------------------------------------------------------*/
function dignity_health_deactivation() {
}
register_deactivation_hook(dignity_health_file(), 'dignity_health_deactivation');

/*--------------------------------------------------------------
# Plugin Uninstall
--------------------------------------------------------------*/
function dignity_health_uninstall() {

	global $wpdb;

	// $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('opos-sales', 'opos-frames', 'opos-glasses', 'opos-w-customers')");
	// $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT id FROM {$wpdb->posts})");

	// $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'opos-glasses-cat'");

 //  $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('opos_company', 'opos_contactno', 'opos_address', 'opos_city', 'opos_postalcode')");

 //  $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'opos_options'");

}
if ( function_exists('dignity_health_finit') ) {
	dignity_health_finit()->add_action('after_uninstall', 'dignity_health_uninstall');
} else {
	register_uninstall_hook(dignity_health_file(), 'dignity_health_uninstall');
}

/*--------------------------------------------------------------
# Translate Plugin
--------------------------------------------------------------*/
function dignity_health_load_textdomain() {
  load_plugin_textdomain( 'dignity-health', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'dignity_health_load_textdomain');
