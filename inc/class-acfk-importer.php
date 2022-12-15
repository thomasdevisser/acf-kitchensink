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

  static public function populate_sub_field( $field, $page_id, $variation, $key, $sub_key, $sub_field ) {
    $acfk_data = new ACFK_Data();

    switch ( $sub_field['type'] ) {
      case 'message':
      case 'tab':
        break;
      case 'relationship':
        $value = self::get_value_for_relationship_field( $sub_field );
        break;
      case 'radio':
        $value = self::get_value_for_radio_field( $sub_field );
        break;
      case 'image':
        $value = self::get_value_for_image_field( $sub_field );
        break;
      case 'gallery':
        $value = self::get_value_for_gallery_field( $sub_field );
        break;
      case 'text':
      case 'textarea':
      case 'wysiwyg':
      case 'link':
        $value = $acfk_data->get_random_value_for_field( $sub_field['type'], $variation );
        break;
      default:
        break;
    }
  
    if ( ! $value || empty( $value ) ) {
      return;
    }

    $field_name = $field['name'];
    $field_key = $field['key'];
    $sub_field_name = $sub_field['name'];
    $sub_field_key = $sub_field['key'];

    /**
     * Update the field value
     */
    update_post_meta( $page_id, "blocks_{$key}_{$field_name}_{$sub_key}_{$sub_field_name}", $value );
    update_post_meta( $page_id, "_blocks_{$key}_{$field_name}_{$sub_key}_{$sub_field_name}", $sub_field_key );
  }

  static public function populate_field( $field, $page_id, $variation, $key ) {
    $acfk_data = new ACFK_Data();

    switch ( $field['type'] ) {
      case 'message':
      case 'tab':
        break;
      case 'relationship':
        $value = self::get_value_for_relationship_field( $field );
        break;
      case 'radio':
        $value = self::get_value_for_radio_field( $field );
        break;
      case 'image':
        $value = self::get_value_for_image_field( $field );
        break;
      case 'gallery':
        $value = self::get_value_for_gallery_field( $field );
        break;
      case 'text':
      case 'textarea':
      case 'wysiwyg':
      case 'link':
        $value = $acfk_data->get_random_value_for_field( $field['type'], $variation );
        break;
      default:
        break;
    }

    if ( 'repeater' === $field['type'] ) {
      $amount = 3;

      if ( isset( $field['min'] ) && $field['min'] > 3 ) {
        $amount = $field['min'];
      }
  
      if ( isset( $field['max'] ) && $field['max'] < 3 ) {
        $amount = $field['max'];
      }

      $value = $amount;

      for ( $i = 0; $i < $amount; $i++ ) {
        foreach ( $field['sub_fields'] as $sub_key => $sub_field ) {
          self::populate_sub_field( $field, $page_id, $variation, $key, $i, $sub_field );
        }
      }
    }

    if ( ! $value || empty( $value ) ) {
      return;
    }

    $field_name = $field['name'];
    $field_key = $field['key'];

    /**
     * Update the field value
     */
    update_post_meta( $page_id, "blocks_{$key}_{$field_name}", $value );
    update_post_meta( $page_id, "_blocks_{$key}_{$field_name}", $field_key );
  }

  /**
   * Adds values to all the block fields
   */
  static public function add_field_values_to_blocks( int $page_id, string $variation ) {
    global $blocks;
    $blocks_on_page = get_field( 'blocks', $page_id );

    /**
     * Loop through all the blocks on the page
     */
    foreach ( $blocks_on_page as $key => $block ) {
      $block_name = $block['acf_fc_layout'];
      
      /**
       * Loop through the array that has the field information for each block
       */
      foreach ( $blocks as $block ) {
        if ( $block['name'] === $block_name ) {
          $block_fields = $block['fields'];

          /**
           * Loop through the block's fields
           */
          foreach ( $block_fields as $field ) {
            self::populate_field( $field, $page_id, $variation, $key );
          }
        }
      }
    }
  }

  static public function get_value_for_relationship_field( array $field ) {
    $amount = 3;
    $post_types = array( 'page' );

    if ( isset( $field['min'] ) && $field['min'] > 3 ) {
      $amount = $field['min'];
    }

    if ( isset( $field['max'] ) && $field['max'] < 3 ) {
      $amount = $field['max'];
    }

    if ( isset( $field['post_type'] ) && ! empty( $field['post_type'] ) ) {
      $post_types = $field['post_type'];
    }

    $value = get_posts(
      array(
        'numberposts' => $amount,
        'post_type' => $post_types,
        'post_status' => 'publish',
        'fields' => 'ids',
      )
    );

    return $value;
  }

  static public function get_value_for_radio_field( array $field ) {
    $choices = array();

    if ( isset( $field['choices'] ) ) {
      foreach ( $field['choices'] as $name => $label ) {
        $choices[] = $name;
      }
    } else {
      return false;
    }

    $value = $choices[array_rand( $choices, 1 )];

    return $value;
  }

  static public function get_value_for_image_field( array $field ) {
    $value = null;

    /**
     * Set up the loop to only get jpegs and pngs
     */
    $args = array(
      'post_type' => 'attachment',
      'post_mime_type' => array( 'image/png', 'image/jpeg' ),
      'fields' => 'ids',
    );

    /**
     * Add a min_height and min_width filter if set, for this to work you
     * need a filter (see README)
     */
    if ( isset( $field['min_height'] ) && isset( $field['min_width'] ) ) {
      $args['meta_query'] = array(
        'relation' => 'AND',
        array(
          'key'     => 'height',
          'value'   => $field['min_height'],
          'type'    => 'numeric',
          'compare' => '>',
        ),
        array(
          'key'     => 'width',
          'value'   => $field['min_width'],
          'type'    => 'numeric',
          'compare' => '>',
        ),
      );
    }

    $images = get_posts( $args );

    if ( ! empty( $images ) ) {
      $value = $images[ array_rand( $images, 1) ];
      return $value;
    }

    return false;
  }

  static public function get_value_for_gallery_field( array $field ) {
    $amount = 3;
    $value = null;

    if ( isset( $field['min'] ) && $field['min'] > 3 ) {
      $amount = $field['min'];
    }

    if ( isset( $field['max'] ) && $field['max'] < 3 ) {
      $amount = $field['max'];
    }

    /**
     * Set up the loop to only get jpegs and pngs
     */
    $args = array(
      'numberposts' => $amount,
      'post_type' => 'attachment',
      'post_mime_type' => array( 'image/png', 'image/jpeg' ),
      'fields' => 'ids',
    );

    /**
     * Add a min_height and min_width filter if set, for this to work you
     * need a filter (see README)
     */
    if ( isset( $field['min_height'] ) && isset( $field['min_width'] ) ) {
      $args['meta_query'] = array(
        'relation' => 'AND',
        array(
          'key'     => 'height',
          'value'   => $field['min_height'],
          'type'    => 'numeric',
          'compare' => '>',
        ),
        array(
          'key'     => 'width',
          'value'   => $field['min_width'],
          'type'    => 'numeric',
          'compare' => '>',
        ),
      );
    }

    $images = get_posts( $args );

    if ( ! empty( $images ) ) {
      $value = $images;
      return $value;
    }

    return false;
  }
}