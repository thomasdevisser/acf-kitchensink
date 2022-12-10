<?php

class ACFK_Importer {
  /**
   * Creates the page
   */
  static public function create_kitchensink_page( string $page_title = 'Kitchensink' ) : int {
    $post_data = array(
      'post_title' => $page_title,
      'post_type' => 'page',
      'post_status' => 'publish',
    );

    $kitchensink_id = wp_insert_post( $post_data );

    return $kitchensink_id;
  }

  /**
   * Adds the blocks to the created page
   */
  static public function add_blocks_to_page( int $page_id, array $layouts, string $field_name = 'field_blocks' ) {
    update_post_meta( $page_id, 'blocks', $layouts );
    update_post_meta( $page_id, '_blocks', $field_name );
  }

  /**
   * Adds values to all the block fields
   */
  static public function add_field_values_to_blocks( int $page_id, string $variation ) {
    global $blocks;
    $blocks_on_page = get_field( 'blocks', $page_id );

    foreach ( $blocks_on_page as $key => $block ) {
      $block_name = $block['acf_fc_layout'];
      
      foreach ( $blocks as $block ) {
        if ( $block['name'] === $block_name ) {
          $block_fields = $block['fields'];

          foreach ( $block_fields as $field ) {
            $acfk_data = new ACFK_Data();
            
            if ( 'message' === $field['type'] ) {
              continue;
            }

            $value = $acfk_data->get_random_value_for_field( $field['type'], $variation );

            $field_name = $field['name'];
            $field_key = $field['key'];

            update_post_meta( $page_id, "blocks_{$key}_{$field_name}", $value );
            update_post_meta( $page_id, "_blocks_{$key}_{$field_name}", $field_key );
          }
        }
      }
    }
  }
}