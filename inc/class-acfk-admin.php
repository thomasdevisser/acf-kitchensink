<?php

class ACFK_Admin {
  public function __construct() {
    add_action( 'admin_menu', array( $this, 'acfk_admin_page' ) );
  }

  /**
   * Adds the admin page
   */
  public function acfk_admin_page() {
    add_menu_page(
      'Generate Kitchensink',
      'Kitchensink',
      'manage_options',
      'acfakitchensink',
      array( $this, 'acfa_kitchensink_html' ),
    );
  }  

  /**
   * Adds the markup
   */
  public function acfa_kitchensink_html() {
    require ACFK_ROOT_DIR . '/templates/generate-kitchensink-form.php';
  }
}
