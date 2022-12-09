# acf-kitchensink

A WordPress plugin that extends ACF, allowing testers to generate several kitchensink pages that automatically adds layouts and populates their fields with different kinds of values.

## Classes

### ACFK

The main class for this plugin. Bootstraps and loads all required files.

### ACFK_Data

The interface between the plugin and the data. Data mainly consists of field values grouped by field type. You can retrieve data using the methods of this class.

Example usage:
`$acfk_data = new ACFK_Data();`
`$text_normal = $acfk_data->get_values_for_field( 'text', 'normal' );`
`$wysiwyg_extreme = $acfk_data->get_values_for_field( 'wysiwyg', 'extreme' );`
`$field_values = $acfk_data->get_value_object();`
