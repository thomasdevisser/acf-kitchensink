<?php

class ACFK_Helpers {
  static public function filter_header_blocks( array $blocks ) : array {
    function header_filter( $block ) {
      return str_contains( $block['name'], 'header' );
    }
    
    return array_filter( $blocks, 'header_filter' );
  }

  static public function filter_overview_blocks( array $blocks ) : array {
    function overview_filter( $block ) {
      return str_contains( $block['name'], 'overview' );
    }
    
    return array_filter( $blocks, 'overview_filter' );
  }
}