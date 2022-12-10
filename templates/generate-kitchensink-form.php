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
            <option value="header-home">Header Home</option>
            <option value="header">Header</option>
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
            <option value="news-overview">News Overview</option>
            <option value="team-overview">Team Overview</option>
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
            <label for="exclude-header">
              <input type="checkbox" name="exclude-header" id="exclude-header">
              Header
            </label>
            <br />
            <label for="exclude-header-home">
              <input type="checkbox" name="exclude-header-home" id="exclude-header-home">
              Header Home
            </label>
            <br />
            <label for="exclude-news-overview">
              <input type="checkbox" name="exclude-news-overview" id="exclude-news-overview">
              News Overview
            </label>
            <br />
            <label for="exclude-team-overview">
              <input type="checkbox" name="exclude-team-overview" id="exclude-team-overview">
              Team Overview
            </label>
            <br />
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