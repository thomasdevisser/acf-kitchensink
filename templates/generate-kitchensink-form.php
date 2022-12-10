<?php
global $blocks;
$headers = ACFK_Helpers::filter_header_blocks( $blocks );
$overviews = ACFK_Helpers::filter_overview_blocks( $blocks );
?>
<div class="wrap">
  <h1>Generate Kitchensink</h1>

  <form method="post" id="generate-kitchensink-form">
    <h2 class="title">What you need to know</h2>
    <p>This plugin assumes your layouts are registered locally in a Flexible Content field with the key <code>field_blocks</code>. You can only add one Facet per page, so I included options to exclude blocks. This is also the reason you can only add one block with "Overview" in it's label.</p>

    <table class="form-table">
      <tr>
        <th>
          <label for="page-title">Page Title</label>
        </th>
        <td>
          <input id="page-title" name="page-title" type="text" class="regular-text">
        </td>
      </tr>

      <tr>
        <th>
          <label for="variation">Choose a variation</label>
        </th>
        <td>
          <select name="variation" id="variation">
            <option value="normal">Normal</option>
            <option value="extreme">Extreme</option>
          </select>
          <p class="description">The variation decides the type of data that is used to fill every field.</p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="header">Choose a header block</label>
        </th>
        <td>
          <select name="header" id="header">
            <option value="all">All headers</option>
            <?php
            foreach ( $headers as $header ) {
              ?>
              <option value="<?php echo $header['name']; ?>"><?php echo $header['label']; ?></option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>

      <tr>
        <th>
          <label for="overview">Choose an overview block</label>
        </th>
        <td>
          <select name="overview" id="overview">
            <option value="none">None</option>
            <?php
            foreach ( $overviews as $overview ) {
              ?>
              <option value="<?php echo $overview['name']; ?>"><?php echo $overview['label']; ?></option>
              <?php
            }
            ?>
          </select>
          <p class="description">You can only have one block using Facet per page.</p>
        </td>
      </tr>

      <tr>
        <th>
          Choose blocks to exclude
          <p class="description">If there are other blocks using Facet, exclude them here.</p>
        </th>
        <td>
          <fieldset>
            <legend class="screen-reader-text">
              <span>Blocks to exclude</span>
            </legend>
            <?php
            foreach ( $blocks as $block ) {
              ?>
              <label for="exclude-<?php echo $block['name']; ?>">
                <input type="checkbox" name="exclude-<?php echo $block['name']; ?>" id="exclude-<?php echo $block['name']; ?>">
                <?php echo $block['label'];  ?>
              </label>
              <br />
              <?php
            }
            ?>
          </fieldset>
        </td>
      </tr>
    </table>

    <p>
      <button type="submit" class="button button-primary">
        Generate
      </button>
    </p>
  </form>
</div>