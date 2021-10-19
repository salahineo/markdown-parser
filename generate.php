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
  <title>HTML Generator</title>

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
      <!-- Start Generate Form -->
      <form id="generate_form" action="generate-script.php" method="post" name="generate_form">
        <h3>Generate HTML From Markdown</h3>
        <!-- Alert -->
        <div class="alert-container" style="display: none;"></div>

        <label for="title">Page Title</label>
        <input type="text" name="title" id="title" placeholder="Represent Webpage Title">

        <label for="content">Markdown Content</label>
        <textarea name="content" cols="30" rows="10" id="content"
                  placeholder="Expect Markdown Syntax (Example: # One ## Two)"></textarea>

        <input type="checkbox" name="auto_open" id="auto_open" checked>
        <label for="auto_open">Auto open generated page in new tab</label>
        <input type="submit" value="Generate" name="submit">
        <a href="index.php">
          <i class="fas fa-arrow-left"></i> Back To Home
        </a>
      </form>
      <!-- End Generate Form -->
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

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/marked.min.js"></script>
  <script src="assets/js/generate.js"></script>
</body>
</html>
