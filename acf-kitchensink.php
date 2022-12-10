<?php
/**
 * Plugin Name: ACF Kitchensink
 * Author: Thomas de Visser
 * Description: Generate robust kitchensinks for testing ACF layouts.
 * Version: 1.0.0
 */

defined( 'ABSPATH' ) or die;
define( 'ACFK_ROOT_DIR',  dirname( __FILE__ ) );
define( 'ACFK_ROOT_DIR_URL', plugin_dir_url( __FILE__ ) );

require 'inc/class-acfk.php';

add_action( 'init', 'start_acfk' );

function start_acfk() {
  $acfk = new ACFK();
}