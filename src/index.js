import axios from "axios";

const kitchensinkForm = document.getElementById("generate-kitchensink-form");

kitchensinkForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = {
    action: "generate_kitchensink",
  };

  try {
    const response = await axios(ajaxurl, {
      method: "post",
      data: data,
      headers: { "content-type": "application/x-www-form-urlencoded" },
    });
    console.log(response.data);
  } catch (error) {
    console.error(error);
  }
});
