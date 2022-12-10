<?php

class ACFK_Importer {
  static public function add_blocks_to_page( int $page_id, array $layouts, string $field_name = 'field_blocks' ) {
    update_post_meta( $page_id, 'blocks', $layouts );
    update_post_meta( $page_id, '_blocks', $field_name );
  }
}