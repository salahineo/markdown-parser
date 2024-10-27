<?php

// Get Data From Form
$title = $_POST['title'];
$content = $_POST['content'];

// Check Data
if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($title) && !empty($content)) {
  // Set Document Content
  $document = '<!DOCTYPE html>
<html lang="en" data-theme="one-dark">
<head>
  <!-- Meta -->
  <meta charset="UTF-8"/>
  <meta name="author" content="Mohamed Salah"/>
  <meta name="keywords" content="markdown parser, parser, markdown, md parser, salahineo"/>
  <meta name="description" content="Parse Markdown into HTML page with a lot of functionalities"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <!-- Title -->
  <title>' . $title . '</title>' . '
  
  <!-- Favicon -->
  <link rel="icon" href="../assets/images/favicon.ico"/>
  
  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/fontawesome.min.css"/>
  <link rel="stylesheet" href="../assets/css/style.min.css"/>
  
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
          <a href="../index.php"><i class="fas fa-home"></i></a>
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
    <div id="_collapse"></div>
    <div id="_side"><i class="fas fa-chevron-circle-right"></i></div>
    <!-- Start Content -->
    <div id="_html_content">
    ' . $content . '
    </div> 
    <!-- End Content -->
    <hr>
    <!-- Start Footer -->
    <div class="footer">
      <div class="credits">
           <span class="copyright">
             &copy; <span id="footer-copyright-year"></span>
             | <a href="https://salahineo.com" target="_blank" rel="noopener">Mohamed Salah</a>
           </span>
      </div>
    </div>
    <!-- End Footer -->
  </div>
  <!-- End Main Content -->
  
  <!-- Scripts -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/prism.min.js"></script>
  <script src="../assets/js/app.js"></script>
</body>
</html>';

  // Create New File
  $generatedHTML = fopen("generated" . DIRECTORY_SEPARATOR . $title . ".html", 'wb');
  // Write Content To File
  fwrite($generatedHTML, $document);
  // Close File
  fclose($generatedHTML);
  // Change Mode Of File
  chmod("generated" . DIRECTORY_SEPARATOR . $title . ".html", 0777);
  // Return New File Path In Response
  echo $title . '/\\';
  echo __DIR__ . DIRECTORY_SEPARATOR . "generated" . DIRECTORY_SEPARATOR . $title . ".html";
}

