<?php
/**
 * Plugin functions and definitions.
 *
 * @package Dignity Health
 */

use Helpers\Dignity_Health_Helpers as Helper;
use Helpers\Dignity_Health_Defaults as De;

class Dignity_Health_Options {

  // Global
  public $localhost;

  function __construct() {

    // Assign Option values to variables
    add_action('wp', array($this, 'init_vars'));

  }

  /**
   * Initialize variables for use.
   */
	public function init_vars() {

    // Global
    $this->localhost = Helper::localhost();

  }

}
global $dignity_opt;
$dignity_opt = new Dignity_Health_Options();
