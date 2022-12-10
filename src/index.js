import axios from "axios";

const kitchensinkForm = document.getElementById("generate-kitchensink-form");

if (kitchensinkForm) {
  kitchensinkForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const pageTitle = document.getElementById("page-title").value;
    const variation = document.getElementById("variation").value;
    const header = document.getElementById("header").value;
    const overview = document.getElementById("overview").value;
    const excluded = document.querySelectorAll(".excluded-blocks input[type=checkbox]:checked");
    let excludedBlocks = [];

    excluded.forEach((checkbox) => {
      excludedBlocks.push(checkbox.value);
    });

    const kitchensinkOptions = { pageTitle, variation, header, overview, excludedBlocks };

    const data = {
      action: "generate_kitchensink",
      kitchensinkOptions,
    };

    try {
      const response = await axios(ajaxurl, {
        method: "post",
        data: data,
        headers: {
          "content-type": "application/x-www-form-urlencoded",
        },
      });
      console.log(response.data);
    } catch (error) {
      console.error(error);
    }
  });
}
