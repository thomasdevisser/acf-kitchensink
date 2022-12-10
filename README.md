# acf-kitchensink

A WordPress plugin that extends ACF, allowing testers to generate several kitchensink pages that automatically adds layouts and populates their fields with different kinds of values.

## Classes

### ACFK

The main class for this plugin. Bootstraps and loads all required files.

### ACFK_Data

The interface between the plugin and the data. Data mainly consists of field values grouped by field type. You can retrieve data using the methods of this class.

Example usage:

```php
$acfk_data = new ACFK_Data();
$text_normal = $acfk_data->get_values_for_field( 'text', 'normal' );
$wysiwyg_extreme = $acfk_data->get_values_for_field( 'wysiwyg', 'extreme' );
$field_values = $acfk_data->get_value_object();
```

### ACFK_Admin

Takes care of creating and rendering the admin page where you'll find the Generate Kitchensink form.

### ACFK_Importer

Responsible for creating pages, importing blocks, and updating block field values.

Example usage:

```php
$kitchensink_id = ACFK_Importer::create_kitchensink_page( $page_title );
ACFK_Importer::add_blocks_to_page( $kitchensink_id, $blocks_on_page );
ACFK_Importer::add_field_values_to_blocks( $kitchensink_id, $variation );
```

### ACFK_Helpers

Has helper functions, mainly used for filtering blocks and selections.

Example usage:

```php
$headers = ACFK_Helpers::filter_header_blocks( $blocks );
$overviews = ACFK_Helpers::filter_overview_blocks( $blocks );
```
