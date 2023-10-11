<?php
/**
 * Plugin Name: Dignity Health
 * Description: Single page product showcase with ajax search.
 * Version:     0.0.1
 * Author:      Muhammad Zohaib
 * Author URI:  https://www.xecreators.pk
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dignity-health
 */

if ( ! defined('ABSPATH') ) exit; // Exit if accessed directly

require 'helpers/functions.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require dignity_health_directory() . '/includes/setup.php';

/**
 * Object for containing default values.
 */
require dignity_health_directory() . '/helpers/class-defaults.php';

/**
 * Class that holds helper methods.
 */
require dignity_health_directory() . '/helpers/class-helpers.php';

/**
 * Class to get and use plugin options.
 */
require dignity_health_directory() . '/helpers/class-plugin-options.php';

/**
 * Enqueue scripts and styles for admin and front end.
 */
require dignity_health_directory() . '/includes/scripts.php';

/**
 * MetaBoxes
 */
require dignity_health_directory() . '/includes/metaboxes/products.php';

/**
 * Class for adding custom post types.
 */
require dignity_health_directory() . '/includes/class-custom-post-types.php';

/**
 * Class for adding custom taxonomies.
 */
require dignity_health_directory() . '/includes/class-custom-taxonomies.php';

/**
 * Shortcodes
 */
require dignity_health_directory() . '/includes/shortcodes/products.php';
