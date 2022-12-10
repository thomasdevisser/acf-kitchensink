<?php
$blocks = ACFK::get_all_layouts();
$headers = ACFK_Helpers::filter_header_blocks( $blocks );
$overviews = ACFK_Helpers::filter_overview_blocks( $blocks );
?>
<div class="wrap">
  <h1>Generate Kitchensink</h1>

  <form action="" method="post">
    <h2 class="title">A few things you need to know</h2>
    <p>You can only have one block with a Facet per page, so every block with "Overview" in it's label won't be added by default. If there are other blocks using Facet, exclude them by checking their checkbox in the "Choose blocks to exclude" setting. I added the option to choose your own page title, so you can generate different kitchensinks.</p>

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
        <th>Choose blocks to exclude</th>
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
      <button class="button button-primary">
        Generate
      </button>
    </p>
  </form>
</div>