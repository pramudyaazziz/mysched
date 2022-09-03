$(document).ready(function () {
  $("#accordionSidebar a").each(function (index, element) {
    if ($(element).attr("href") == window.location.pathname) {
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
