/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/pages/form-editor.init.js ***!
  \************************************************/
$(document).ready(function () {
  0 < $("#elm1").length && tinymce.init({
    selector: "textarea#elm1",
    height: 630,
    plugins: ['autoresize',"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    autoresize_overflow_padding: 50,
    style_formats: [{
      title: "Bold text",
      inline: "b"
    }, {
      title: "Red text",
      inline: "span",
      styles: {
        color: "#ff0000"
      }
    }, {
      title: "Red header",
      block: "h1",
      styles: {
        color: "#ff0000"
      }
    }, {
      title: "Example 1",
      inline: "span",
      classes: "example1"
    }, {
      title: "Example 2",
      inline: "span",
      classes: "example2"
    }, {
      title: "Table styles"
    }, {
      title: "Table row 1",
      selector: "tr",
      classes: "tablerow1"
    }]
  });
});
/******/ })()
;
