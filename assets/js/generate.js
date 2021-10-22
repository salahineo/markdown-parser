$(function () {
  // Generate Form
  let submitForm = document.getElementById("generate_form");

  // Set New Alert
  const setAlert = (color, state, message) => {
    // Alert Container
    const alertContainer = document.querySelector(".alert-container");
    // Append Alert
    alertContainer.innerHTML =
      `<div class="alert alert-${color}" id="generate_alert">
      <span>
        <strong>${state}!</strong> ${message}
      </span>
      <i class="fas fa-times" onclick="$(this).parent().fadeOut(300)"></i>
    </div>`;
    // Fade Alert
    $(".alert-container").fadeIn(300);
  };

  // Set Loading State
  const loading = (state) => {
    if (state) {
      // Set Loading State
      submitForm.submit.classList.add("loading");
      submitForm.submit.setAttribute("disabled", "true");
    } else {
      // Remove Loading State
      submitForm.submit.classList.remove("loading");
      submitForm.submit.removeAttribute("disabled");
    }
  };

  // Check Empty Values Method
  const empty = (val) => {
    // Check Input Value Length
    return val.length === 0;
  };

  // Generate Markdown & Send It Method
  const generateHTML = async (e) => {
    // Change Loading State
    loading(true);

    // Prevent Default Submit
    e.preventDefault();

    // Get Title
    let title = e.target.title.value;
    // Get Markdown Content (Compiled)
    let content = marked(e.target.content.value);

    // Check Empty Inputs
    if (empty(title) || empty(content)) {
      // Set Loading State
      loading(false);
      // Trigger Error Alert
      setAlert("danger", "Error", "All Fields Are Required");
    } else {
      // Prepare Data
      const data = {
        title,
        content
      };
      // Send Data In Background
      await $.ajax({
        url: "/generate-script.php",
        method: "POST",
        data: data,
        success: async function (data) {
          // Change Loading State
          loading(false);
          // Trigger Error Alert
          setAlert("success", "Success", "File created in: <br>" + "<small>" + data.split("/\\")[1] + "</small>");
          // Check Open In New Tab
          submitForm.auto_open.checked ? window.open("/generated/" + data.split("/\\")[0] + ".html") : "";
        },
        error: function (err) {
          // Change Loading State
          loading(false);
          // Trigger Error Alert
          setAlert("danger", "Error", err.message);
        }
      });
    }
  };

  // Submit Form Listener
  submitForm.addEventListener("submit", generateHTML);

  // Check If Checkbox Exists
  if (submitForm.auto_open !== undefined) {
    // Set State Of Auto Open
    localStorage.getItem("auto_open") === "checked"
      ? submitForm.auto_open.checked
      : submitForm.auto_open.removeAttribute("checked");

    // Save Checked State To LocalStorage
    submitForm.auto_open.addEventListener("change", () => {
      // Save To LocalStorage
      submitForm.auto_open.checked ? localStorage.setItem("auto_open", "checked") : localStorage.setItem("auto_open", "");
    });
  }


  // Footer Dynamic Year
  document.getElementById("footer-copyright-year").innerHTML = String(new Date().getFullYear());
});
