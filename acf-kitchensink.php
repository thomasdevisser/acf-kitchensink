<?php
/**
 * Plugin Name: ACF Kitchensink
 * Author: Thomas de Visser
 * Description: Generate robust kitchensinks for testing ACF layouts.
 */

defined( 'ABSPATH' ) or die;

add_action( 'init', 'get_all_layouts' );
function get_all_layouts() {
  /**
   * Get all the layouts and the layout fields from ACF's local storage.
   */
  $layouts = acf_get_local_store( 'fields' )->get_data()['field_blocks']['layouts'];
  $layout_fields = acf_get_local_fields( 'field_blocks' );
  $blocks = array();

  /**
   * Loop through all the layouts to create a block variable
   */
  foreach ( $layouts as $layout ) {
    $fields = array();

    /**
     * Loop through all the fields and attach the fields to their matching parent block
     */
    foreach ( $layout_fields as $field ) {
      if ( $field['parent_layout'] === $layout['key'] ) {
        $fields[] = $field;
      }
    }

    /**
     * Create the block and add it to an array
     */
    $block = array(
      'name' => $layout['name'],
      'fields' => $fields,
    );

    $blocks[] = $block;
  }
  
  var_dump( $blocks );
  die;
}