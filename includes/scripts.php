<?php
/**
 * Enqueue scripts and styles for admin panel and front end.
 *
 * @package Dignity Health
 */

function dignity_health_scripts() {

  // Version Control
  $mainCSS = filemtime(dignity_health_directory() . '/assets/css/main.css');
  $mainJS = filemtime(dignity_health_directory() . '/assets/js/main.js');
  $bootstrapCSS = filemtime(dignity_health_directory() . '/assets/css/bootstrap.min.css');
  $bootstrapJS = filemtime(dignity_health_directory() . '/assets/js/bootstrap.bundle.min.js');

  /**
   * Styles
   */
  wp_enqueue_style('dashicons');
  wp_enqueue_style( 'bootstrap', dignity_health_directory_uri() . '/assets/css/bootstrap.min.css', array(), esc_attr($bootstrapCSS) );
  wp_enqueue_style( 'dignity-health-main', dignity_health_directory_uri() . '/assets/css/main.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'bootstrap', dignity_health_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), esc_attr($bootstrapJS), true );
  wp_enqueue_script( 'dignity-health-main', dignity_health_directory_uri() . '/assets/js/main.js', array('jquery'), esc_attr($mainJS), true );

}
add_action('wp_enqueue_scripts', 'dignity_health_scripts');

/**
 * Enqueue scripts and styles for admin panel.
 */
function dignity_health_admin_scripts() {

  // Version Control
  $mainCSS = filemtime(dignity_health_directory() . '/assets/css/admin.css');
  $mainJS = filemtime(dignity_health_directory() . '/assets/js/admin.js');

	/**
   * Styles
   */
  wp_enqueue_style( 'dignity-health-admin', dignity_health_directory_uri() . '/assets/css/admin.css', array(), esc_attr($mainCSS) );

  /**
   * Scripts
   */
  wp_enqueue_script( 'dignity-health-admin', dignity_health_directory_uri() . '/assets/js/admin.js', array(), esc_attr($mainJS), true );

}
add_action( 'admin_enqueue_scripts', 'dignity_health_admin_scripts', 9999 );
