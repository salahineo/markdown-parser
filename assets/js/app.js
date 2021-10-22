$(function () {
  let content = $("#_html"),
    sidebar = $("#_toc"),
    sidebarArrow = $("#_side"),
    sidebarArrowIcon = $("#_side i"),
    themesOptions = $("#_toc .toc_color_modes"),
    themesColor = $("#_toc .toc_color_modes span"),
    body = $("body");

  // Check Color Mode
  $("#_mode").on("click", function () {
    themesOptions.slideToggle();
    themesOptions.toggle().css("display", "flex");
  });
  themesColor.on("click", function () {
    let theme = $(this).attr("id").split("_")[1];
    $("html").attr("data-theme", theme);
    localStorage.setItem("MarkdownParserColorMode", theme);
  });

  // Sidebar Functionality
  // Generate TOC
  const toc = (link = (header) => header.level === 6 ? "<a href=\"#separator\">" + header.title + "</a>" : "<a href=\"#" + header.id + "\">" + header.title + "</a>") =>
    Array.from(document.querySelector("#_html_content").childNodes)
      .filter((node) => /h[2-3-6]/i.test(node.tagName))
      .map((node) => ({
        id: node.getAttribute("id"),
        level: parseInt(node.tagName.replace("H", "")),
        title: node.innerText.replace(/</g, "&lt;").replace(/>/g, "&gt;")
      }))
      .reduce((html, header) => {
        html += "<div class=\"_ul\">".repeat(header.level);
        html += link(header);
        html += "</div>".repeat(header.level);
        return html;
      }, "");
  // Append TOC
  $("#_myUL:not(.index_toc)").html(toc());
  // Set After Separator Margin
  $("[href='#separator']").parent().parent().parent().parent().parent().parent().next().addClass("after-separator");
  // Get Links In TOC
  let sidebarLink = $("#_toc ._ul a:not(.file):not([href='#separator']):not(.dir)");
  // Implement Functions On TOC
  sidebarArrow.on("click", function () {
    if ("2px" === sidebar.css("width")) {
      sidebar.css("width", "250px");
      $(this).css("left", "248px");
      sidebarArrowIcon.css("transform", "rotate(180deg)");
    } else {
      sidebar.css("width", "0");
      $(this).css("left", "0");
      sidebarArrowIcon.css("transform", "rotate(0)");
    }
  }),
    content.on("click", function () {
      "250px" === sidebar.css("width") &&
      $(window).outerWidth() < 1200 &&
      (sidebar.css("width", "0"),
        sidebarArrow.css("left", "2px"),
        sidebarArrowIcon.css("transform", "rotate(0)"));
    }),
    sidebarLink.on("click", function (e) {
      e.preventDefault();
      sidebarLink.removeClass("active");
      $(this).addClass("active");
      $("html, body").animate({scrollTop: $($(this).attr("href")).offset().top}, 800);
    });
  // Filter TOC Input
  $("#_filter").on("keyup", function (e) {
    // Loop Through TOC Links
    for (
      let filterValue = document.getElementById("_filter").value.toUpperCase(),
        links = document.getElementById("_myUL").getElementsByTagName("a"),
        i = 0;
      i < links.length;
      i++
    ) {
      let link = links[i];
      link.innerHTML.toUpperCase().indexOf(filterValue) > -1
        ? link.setAttribute("style", "display:block!important")
        : link.setAttribute("style", "display:none!important");
    }
    // Check Input Value
    if (e.target.value !== "") {
      // Hide Separators
      $("[href='#separator']").attr("style", "display:none!important").parent().parent().parent().parent().parent().parent().next().removeClass("after-separator");
    } else {
      // Show Separators
      $("[href='#separator']").attr("style", "display:block!important").parent().parent().parent().parent().parent().parent().next().addClass("after-separator");
    }
  });

  // Copy Icon Append & Wrapper To Every Pre Code
  $(".markdown-body pre").append(`<i class="far fa-clone fa-rotate-180"></i><span class='copied'>copied!</span><span class='copied-arrow'></span>`).wrap("<div style=\"position: relative\"></div>");
  // On Click
  $(".markdown-body pre i").on("click", function () {
    // Make Temp Textarea
    let $temp = $("<textarea id='temp'>");
    // Append It To Body
    body.append($temp);
    // Set Pre Text Content To It
    $temp.val($(this).prev().text()).select();
    // Copy Value
    document.execCommand("copy");
    // Remove Temp Textarea
    $temp.remove();
    // Show Then Hide The Copied Message
    $(this).parent().find(".copied, .copied-arrow").fadeIn(280).delay(500).fadeOut(270);
  });

  // Append HR Before H2 Heading
  $("h2:not(:first-of-type)").before("<hr>");

  // Footer Dynamic Year
  document.getElementById("footer-copyright-year").innerHTML = String(new Date().getFullYear());
});
