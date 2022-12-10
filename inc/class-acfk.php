<?php

class ACFK {
  public function __construct() {
    require 'class-acfk-data.php';
    require 'class-acfk-admin.php';
  }

  /**
   * Retrieves all layouts registered to a field name.
   */
  public function get_all_layouts( string $field_name = 'field_blocks' ) : array {
    /**
     * Gets all the layouts and the layout fields from ACF's
     * local storage.
     */
    $fields_data = acf_get_local_store( 'fields' )->get_data();
    $layouts = $fields_data[ $field_name ]['layouts'];
    $layout_fields = acf_get_local_fields( $field_name );

    $blocks = array();
  
    /**
     * Loops through all the layouts to create a block variable
     */
    foreach ( $layouts as $layout ) {
      $fields = array();
  
      /**
       * Loops through all the fields and attach the fields to
       * their matching parent block
       */
      foreach ( $layout_fields as $field ) {
        if ( $field['parent_layout'] === $layout['key'] ) {
          $fields[] = $field;
        }
      }
  
      /**
       * Creates the block and add it to an array
       */
      $block = array(
        'name' => $layout['name'],
        'fields' => $fields,
      );
  
      $blocks[] = $block;
    }

    return $blocks;
  }
}