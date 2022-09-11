$(document).ready(function () {
  $("#accordionSidebar a").each(function (index, element) {
    let pathArray = window.location.pathname.split("/");
    let prefix = `/${pathArray[1]}`;
    if ($(element).attr("href") == prefix) {
      if ($(element).hasClass("collapse-item") == true) {
        $(element).parent().parent().parent().addClass("active");
        $(element).parent().parent().addClass("show");
        $(element).addClass("active");
      } else {
        $(element).parent().addClass("active");
      }
    }
  });
  $("#summernote").summernote({
    placeholder: "Note Content",
    height: 300,
    toolbar: [
      ["font", ["bold", "underline", "clear"]],
      ["fontname", ["fontname"]],
      ["fontsize", ["fontsize"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
    ],
  });
});
$(function () {
  $('[data-toggle="popover"]').popover();
});
