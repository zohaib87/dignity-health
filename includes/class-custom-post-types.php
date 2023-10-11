<?php
/**
 * Class for adding custom post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @package Dignity Health
 */

if (!class_exists('Dignity_Health_CustomPostTypes')) {

  class Dignity_Health_CustomPostTypes {

    function __construct() {

      add_action( 'init', array($this, 'custom_post_types') );
      register_activation_hook( __FILE__, array($this, 'rewrite_flush') );

    }

    protected function products() {

      $labels = array(
        'name'               => 'Products',
        'singular_name'      => 'Product',
        'menu_name'          => 'Products',
        'name_admin_bar'     => 'Product',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Product',
        'new_item'           => 'New Product',
        'edit_item'          => 'Edit Product',
        'view_item'          => 'View Product',
        'all_items'          => 'All Products',
        'search_items'       => 'Search Products',
        'parent_item_colon'  => 'Parent Products:',
        'not_found'          => 'No Products found.',
        'not_found_in_trash' => 'No Products found in Trash.',
      );

      $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-cart',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'dignity-products' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'thumbnail', 'revisions' ),
      );
      return register_post_type( 'dignity-products', $args );

    }

    public function custom_post_types() {

      $this->products();

    }

    public function rewrite_flush() {

      $this->custom_post_types();
      flush_rewrite_rules();

    }

  }
  new Dignity_Health_CustomPostTypes();

}
