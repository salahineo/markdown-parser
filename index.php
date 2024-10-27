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
  <title>Markdown Parser</title>

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
    <div id="_myUL" class="index_toc">
      <?php
      // List Files Of Specific Dir Method
      function listFolderFiles($dir) {
        // Get List Of Files
        $files_list = array_diff(scandir($dir), array('.', '..'));
        // Set Empty String To Store Files Links
        $items = '';
        // Loop Through All Files
        foreach($files_list as $file) {
          // Assign Each File To String
          $items .= '<div class="_ul">
            <div class="_ul">
              <div class="_ul">
                <a class="file"
                   href="parse.php?file=' . explode(DIRECTORY_SEPARATOR, $dir)[1] . DIRECTORY_SEPARATOR . explode(".md", $file)[0] . '"
                   target="_blank">' . explode(".md", $file)[0] . '</a>
              </div>
            </div>
          </div>';
        }
        // Return All Files Nodes
        return $items;
      }

      // List Main Files Method
      function listFiles($dir) {
        // Set Valid Directories Number
        $directories_number = 0;
        // Total Number Of Files
        $total = 0;
        // Get List Of Files
        $files_list = array_diff(scandir($dir), array('.', '..'));
        // Calculate Total files
        foreach($files_list as $file) {
          // Exclude Empty Directories
          if(is_dir($dir . DIRECTORY_SEPARATOR . $file) && count(array_diff(scandir($dir . DIRECTORY_SEPARATOR . $file), array('.', '..'))) === 0) {
            continue;
          }
          // Increase Total
          $total++;
        }
        // Check If There Is No Files
        if($total > 1) {
          // Loop Through All Files
          foreach($files_list as $file) {
            // Check If Current Is Directory (List Directories & Their Files First)
            if(is_dir($dir . DIRECTORY_SEPARATOR . $file) && count(array_diff(scandir($dir . DIRECTORY_SEPARATOR . $file), array('.', '..'))) > 0) {
              // Increase Valid Directories Numbers
              $directories_number++;
              ?>
              <div class="_ul">
                <div class="_ul">
                  <a class="dir"
                     href="javascript:void();">
                    <?= $file ?>
                  </a>
                </div>
              </div>
              <?php
              // List Files Of This Directory Under It
              echo listFolderFiles($dir . DIRECTORY_SEPARATOR . $file);
            }
          }
          // Check If There Are Valid Directories
          if($directories_number > 0 && $total > $directories_number + 1) {
            ?>
            <div class="_ul">
              <div class="_ul">
                <a class="dir"
                   href="javascript:void();">
                  Uncategorized
                </a>
              </div>
            </div>
            <?php
            // Loop Through Uncategorized Files
            foreach($files_list as $file) {
              // Check If It Is File Only
              if(!is_dir($dir . DIRECTORY_SEPARATOR . $file) && explode(".md", $file)[0] !== 'index') {
                ?>
                <div class="_ul">
                  <div class="_ul">
                    <div class="_ul">
                      <a class="file"
                         href="parse.php?file=<?= explode(".md", $file)[0] ?>"
                         target="_blank"><?= explode(".md", $file)[0] ?></a>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          } else {
            // Loop Through Uncategorized Files
            foreach($files_list as $file) {
              // Check If It Is File Only
              if(!is_dir($dir . DIRECTORY_SEPARATOR . $file) && explode(".md", $file)[0] !== 'index') {
                ?>
                <div class="_ul">
                  <div class="_ul">
                    <a class="file"
                       href="parse.php?file=<?= explode(".md", $file)[0] ?>"
                       target="_blank"><?= explode(".md", $file)[0] ?></a>
                  </div>
                </div>
                <?php
              }
            }
          }
        } else {
          // No Files Message
          ?>
          <div class="_ul" style="text-align: center;opacity: 0.3;">
            <a class="dir"
               href="javascript:void();">
              No Markdown Files
            </a>
          </div>
          <?php
        }
      }

      // Generate Files Tree
      listFiles('markdown');
      ?>
    </div>
    <h1></h1>
  </div>
  <!-- End Table Of Content -->

  <!-- Start Main Content -->
  <div id="_html" class="markdown-body">
    <div id="_collapse"></div>
    <div id="_side"><i class="fas fa-chevron-circle-right"></i></div>
    <!-- Start Content -->
    <div id="_html_content">
      <div class="alert alert-warning" style="display: flex;justify-content: space-between;align-items: center;">
        <span>
          <strong>Warning!</strong> Please restore the "markdown/index.md" file to generate this page content
        </span>
        <i class="fas fa-times" onclick="$(this).parent().fadeOut(300)"></i>
      </div>
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
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/marked.min.js"></script>
  <script>
    // Parse To HTML, Then Set Content
    document.getElementById("_html_content").innerHTML = marked(<?= json_encode(file_get_contents('markdown' . DIRECTORY_SEPARATOR . 'index.md')) ?>);
  </script>
  <script src="assets/js/prism.min.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>
