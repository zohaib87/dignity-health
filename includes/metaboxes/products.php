<?php
/**
 * Custom Fields functions for Sample CPT.
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/#adding-meta-boxes
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 *
 * @package Dignity Health
 */

use Helpers\Dignity_Health_Helpers as Helper;

abstract class Dignity_Health_ProductsMetaBox {

  /**
   * Set up and add the meta box.
   */
  public static function add() {

    $screens = [
      'dignity-products'
    ];

    foreach ($screens as $screen) {
      add_meta_box(
        'products_meta_box', // Unique ID
        'Product Detail', // Box title
        [ self::class, 'html' ], // Content callback, must be of type callable
        $screen, // Post type
        'normal', // The context within the screen where the box should display
        'default' // Priority
      );
    }

  }

  /**
   * Display the meta box HTML to the user.
   */
  public static function html( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('dignity_products_meta_box', 'dignity_products_meta_box_nonce');

    $type = get_post_meta($post->ID, '_type', true);
    $composition = get_post_meta($post->ID, '_composition', true);
    $pack_size = get_post_meta($post->ID, '_pack_size', true);
    $reg_no = get_post_meta($post->ID, '_reg_no', true);

    ?>
      <!-- Type -->
      <div class="dignity-health-field">
        <div class="dignity-health-label">
          <label for="type">Type:</label>
        </div>
        <div class="dignity-health-input">
          <input type="text" name="type" id="type" value="<?php echo esc_attr($type); ?>">
        </div>
      </div>

      <!-- Composition -->
      <div class="dignity-health-field">
        <div class="dignity-health-label">
          <label for="composition">Composition:</label>
        </div>
        <div class="dignity-health-input">
          <textarea name="composition" id="composition" cols="25" rows="4"><?php echo esc_attr($composition); ?></textarea>
        </div>
      </div>

      <!-- Pack Size -->
      <div class="dignity-health-field">
        <div class="dignity-health-label">
          <label for="pack_size">Pack Size:</label>
        </div>
        <div class="dignity-health-input">
          <input type="text" name="pack_size" id="pack_size" value="<?php echo esc_attr($pack_size); ?>" placeholder="comma separated list">
        </div>
      </div>

      <!-- Registration Number -->
      <div class="dignity-health-field">
        <div class="dignity-health-label">
          <label for="reg_no">UK Registration Number:</label>
        </div>
        <div class="dignity-health-input">
          <input type="number" name="reg_no" id="reg_no" value="<?php echo esc_attr($reg_no); ?>">
        </div>
      </div>
    <?php

  }

  /**
   * Save the meta box selections.
   */
  public static function save( int $post_id ) {

    // Check if our nonce is set.
    if ( !isset($_POST['dignity_products_meta_box_nonce']) ) {
      return $post_id;
    }

    $nonce = $_POST['dignity_products_meta_box_nonce'];

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce($nonce, 'dignity_products_meta_box') ) {
      return $post_id;
    }

    // If this is an autosave, our form has not been submitted,
    // so we don't want to do anything.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
      return $post_id;
    }

    // Check the user's permissions.
    if ( 'dignity-products' == $_POST['post_type'] ) {
      if ( !current_user_can('edit_page', $post_id) ) {
        return $post_id;
      }
    } else {
      if ( !current_user_can('edit_post', $post_id) ) {
        return $post_id;
      }
    }

    // Saving or Updating the data
    Helper::update_field($post_id, 'type', false, 'text', '_type');
    Helper::update_field($post_id, 'composition', false, 'textarea', '_composition');
    Helper::update_field($post_id, 'pack_size', false, 'text', '_pack_size');
    Helper::update_field($post_id, 'reg_no', false, 'intval', '_reg_no');

  }

}
add_action( 'add_meta_boxes', ['Dignity_Health_ProductsMetaBox', 'add'] );
add_action( 'save_post_dignity-products', ['Dignity_Health_ProductsMetaBox', 'save'] );
