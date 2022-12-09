<?php

class ACFK_Data {
  private $value_object;
  private $path_to_data;
  private $json;

  public function __construct() {
    /**
     * Loads the JSON from the data file and parse it to an array.
     */
    $this->path_to_data = ACFK_ROOT_DIR . '/data/field-values.json';
    $this->json = file_get_contents( $this->path_to_data );
    $this->value_object = json_decode( $this->json );
  }

  /**
   * Retrieves the value object in the only way possible as
   * the property is private. This way it can't be altered directly.
   */
  public function get_value_object() : object {
    return $this->value_object;
  }

  /**
   * Gets values for a specific field type and variant in an easy way.
   */
  public function get_values_for_field( string $type = 'text', string $variant = 'normal' ) : array {
    return $this->value_object?->$type?->$variant;
  }
}