<?php

class ACFK_Helpers {
  /**
   * Returns only blocks that have 'header' in their name
   */
  static public function filter_header_blocks( array $blocks ) : array {
    function header_filter( $block ) {
      return str_contains( $block['name'], 'header' );
    }
    
    return array_filter( $blocks, 'header_filter' );
  }

  /**
   * Returns only blocks that have 'overview' in their name
   */
  static public function filter_overview_blocks( array $blocks ) : array {
    function overview_filter( $block ) {
      return str_contains( $block['name'], 'overview' );
    }
    
    return array_filter( $blocks, 'overview_filter' );
  }

  /**
   * Returns only blocks that will be on the page
   */
  static public function filter_blocks_for_page( array $options ) {
    global $blocks;
    $blocks_on_page = array();
    $headers = ACFK_Helpers::filter_header_blocks( $blocks );
    $overviews = ACFK_Helpers::filter_overview_blocks( $blocks );

    /**
     * Extracts all post data
     */
    $selected_header = $options['header'] ?? 'header';
    $selected_overview = $options['overview'] ?? 'none';
    $excluded_blocks = $options['excludedBlocks'] ?? array();

    /**
     * Combine headers, overviews and excluded blocks
     */
    $excluded = array_merge( $headers, $overviews, $excluded_blocks );

    foreach ( $headers as $header ) {
      if ( $header['name'] !== $selected_header && 'all' !== $selected_header ) {
        $excluded[] = $header['name'];
      }
    }

    foreach ( $overviews as $overview ) {
      if ( 'none' === $selected_overview || $overview['name'] !== $selected_overview ) {
        $excluded[] = $overview['name'];
      }
    }

    /**
     * If a block is not excluded, add it to blocks on the page
     */
    foreach ( $blocks as $block ) {
      if ( ! in_array( $block['name'], $excluded ) ) {
        $blocks_on_page[] = $block['name'];
      }
    }

    return $blocks_on_page;
  }
}