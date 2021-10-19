<?php

// Get File Name From Post
$fileName = isset($_GET['file']) && !empty($_GET['file']) ? $_GET['file'] : 'Not Found';

// Set Page Title
$title = file_exists('markdown' . DIRECTORY_SEPARATOR . $fileName . '.md') ? $fileName : 'Not Found';

// Set File Path
$path = isset($_GET['file']) && !empty($_GET['file']) ? __DIR__ . DIRECTORY_SEPARATOR . "markdown" . DIRECTORY_SEPARATOR . $fileName . ".md" : __DIR__ . DIRECTORY_SEPARATOR . "markdown" . DIRECTORY_SEPARATOR;

?>
<!DOCTYPE html>
<html lang="en" data-theme="one-dark">
<head>
  <!-- Meta -->
  <meta charset="UTF-8"/>
  <meta name="author" content="Mohamed Salah"/>
  <meta name="keywords" content="markdown parser, parser, markdown, md parser, salahineo"/>
  <meta name="description" content="Parse Markdown into HTML page with a lot of functionalities"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Title -->
  <title> <?= strpos($title, DIRECTORY_SEPARATOR) ? explode(DIRECTORY_SEPARATOR, $title)[1] : $title ?> </title>

  <!-- Favicon -->
  <link rel="icon" href="assets/images/favicon.ico"/>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/fontawesome.min.css"/>
  <link rel="stylesheet" href="assets/css/style.min.css"/>

  <!-- Check Local Storage Color Mode -->
  <script>
    // Get Local Storage ITem
    let localstorageMode = localStorage.getItem("MarkdownParserColorMode");
    // Check If Exist Or Not, Then Switch Colors
    null === localstorageMode
      ? document.documentElement.setAttribute("data-theme", "one-dark")
      : document.documentElement.setAttribute("data-theme", localstorageMode);
  </script>
</head>
<?php

// Check If This File Exists
if(file_exists('markdown' . DIRECTORY_SEPARATOR . $fileName . '.md')) {
  // Get Content Of File
  $content = json_encode(file_get_contents('markdown' . DIRECTORY_SEPARATOR . $fileName . '.md'));
  ?>
  <body class="_toc-left">
    <!-- Start No Js Enabled Warning -->
    <noscript>
      <div class="noJS">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Please Enable JavaScript In Your Browser To Render Page Correctly</span>
        <i class="fas fa-exclamation-triangle"></i>
      </div>
    </noscript>
    <!-- End No Js Enabled Warning -->

    <!-- Start Table Of Content -->
    <div id="_toc">
      <form>
        <span id="_searchIco">
          <a href="index.php"><i class="fas fa-home"></i></a>
        </span>
        <input type="text" id="_filter" placeholder="Find Something" autofocus/>
        <span id="_mode"><i class="fas fa-adjust"></i></span>
      </form>
      <div class="toc_color_modes">
        <span id="theme_light" title="Light Theme"></span>
        <span id="theme_semi-light" title="Semi-Light Theme"></span>
        <span id="theme_one-dark" title="One-Dark Theme"></span>
        <span id="theme_dark-ocean" title="Dark-Ocean Theme"></span>
        <span id="theme_dark" title="Dark Theme"></span>
      </div>
      <h1></h1>
      <!-- TOC Content -->
      <div id="_myUL"></div>
      <h1></h1>
    </div>
    <!-- End Table Of Content -->

    <!-- Start Main Content -->
    <div id="_html" class="markdown-body">
      <div id="export_file" title="Export To HTML">
        <i class="fas fa-file-export"></i>
      </div>
      <div class="alert-container"></div>
      <div id="_collapse"></div>
      <div id="_side"><i class="fas fa-chevron-circle-right"></i></div>
      <!-- Start Content -->
      <div id="_html_content"></div>
      <!-- End Content -->
      <hr>
      <!-- Start Footer -->
      <div class="footer">
        <div class="credits">
            <span class="copyright">
              &copy; <span id="footer-copyright-year">2021</span>
              | <strong>Mohamed Salah</strong>
            </span>
        </div>
        <div class="links">
          <a href="https://www.github.com/salahineo" target="_blank">
            <i class="fab fa-github"></i>
          </a>
          <a href="https://www.linkedin.com/in/salahineo/" target="_blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="https://www.twitter.com/salahineo" target="_blank">
            <i class="fab fa-twitter"> </i>
          </a>
          <a href="https://www.facebook.com/salahineo/" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://salahineo.github.io/salahineo/" target="_blank">
            <i class="fas fa-globe-africa"></i>
          </a>
          <a href="mailto:salahineo.work@gmail.com" target="_blank">
            <i class="fas fa-envelope"></i>
          </a>
        </div>
      </div>
      <!-- End Footer -->
    </div>
    <!-- End Main Content -->

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/marked.min.js"></script>
    <script>
      // Parse To HTML, Then Set Content
      document.getElementById("_html_content").innerHTML = marked(<?= $content ?>);

      // Generate Form
      let exportButton = document.getElementById("export_file");

      // Set New Alert
      const setAlert = (color, state, message) => {
        // Alert Container
        const alertContainer = document.querySelector(".alert-container");
        // Append Alert
        alertContainer.innerHTML =
          `<div class="alert alert-${color}" id="generate_alert">
              <span style="margin-right: 20px;">
                <strong>${state}!</strong> ${message}
              </span>
              <i class="fas fa-times" onclick="$(this).parent().fadeOut(300)"></i>
            </div>`;
        // Fade Alert
        $(".alert-container").fadeIn(300);
      };

      // Generate Markdown & Send It Method
      const generateHTML = async () => {
        // Get Title
        let title = "<?= strpos($title, DIRECTORY_SEPARATOR) ? explode(DIRECTORY_SEPARATOR, $title)[1] : $title ?>";
        // Get Markdown Content (Compiled)
        let content = marked(<?= $content ?>);
        // Prepare Data
        const data = {
          title,
          content
        };
        // Send Data In Background
        await $.ajax({
          url: "generate-script.php",
          method: "POST",
          data: data,
          success: async function (data) {
            // Remove Export Button
            exportButton.remove();
            // Trigger Error Alert
            setAlert("success", "Success", "File created in: <br>" + "<small>" + data.split("/\\")[1] + "</small>");
          },
          error: function (err) {
            // Trigger Error Alert
            setAlert("danger", "Error", err.message);
          }
        });
      };

      // Submit Form Listener
      exportButton.addEventListener("click", generateHTML);
    </script>
    <script src="assets/js/prism.min.js"></script>
    <script src="assets/js/app.js"></script>

  </body>

  <?php
} else {
  ?>
  <body>
    <!-- Start No Js Enabled Warning -->
    <noscript>
      <div class="noJS">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Please Enable JavaScript In Your Browser To Render Page Correctly</span>
        <i class="fas fa-exclamation-triangle"></i>
      </div>
    </noscript>
    <!-- End No Js Enabled Warning -->

    <!-- Start Main Content -->
    <div id="_html" class="markdown-body">
      <div id="_collapse"></div>
      <div id="_side"><i class="fas fa-chevron-circle-right"></i></div>
      <!-- Start Content -->
      <div id="_html_content">
        <h1>This File Doesn't Exist</h1>
        <p style="margin: 50px auto;text-align: center;">
          Please check if your file exists:
          <br>
          <?= $path ?>
        </p>
      </div>
      <!-- End Content -->
      <hr>
      <!-- Start Footer -->
      <div class="footer">
        <div class="credits">
            <span class="copyright">
              &copy; <span id="footer-copyright-year"></span>
              | <strong>Mohamed Salah</strong>
            </span>
        </div>
        <div class="links">
          <a href="https://www.github.com/salahineo" target="_blank">
            <i class="fab fa-github"></i>
          </a>
          <a href="https://www.linkedin.com/in/salahineo/" target="_blank">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="https://www.twitter.com/salahineo" target="_blank">
            <i class="fab fa-twitter"> </i>
          </a>
          <a href="https://www.facebook.com/salahineo/" target="_blank">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://salahineo.github.io/salahineo/" target="_blank">
            <i class="fas fa-globe-africa"></i>
          </a>
          <a href="mailto:salahineo.work@gmail.com" target="_blank">
            <i class="fas fa-envelope"></i>
          </a>
        </div>
      </div>
      <!-- End Footer -->
    </div>
    <!-- End Main Content -->

  </body>
  <?php
}
?>
</html>
