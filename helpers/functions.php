<?php
/**
 * Functions that helps to ease plugin development.
 *
 * @package Dignity Health
 */

function dignity_health_directory() {
	return ABSPATH . 'wp-content/plugins/dignity-health';
}

function dignity_health_directory_uri() {
	return plugins_url() . '/dignity-health';
}

function dignity_health_file() {
	return dignity_health_directory() . '/dignity-health.php';
}

function dignity_health_data() {
	return get_plugin_data( dignity_health_file() );
}
