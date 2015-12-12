function downloadAll(path) {
  var form = document.createElement("form");
  form.setAttribute('method', 'post');
  form.setAttribute('action', path);

  $(".fileId").each(function(index) {
      $(this).clone().appendTo(form);
  });

  document.body.appendChild(form);
  form.submit();
};

(function ($) {
  $(document).ready(function() {
    $('#downloadAll').click(function(e) {
      e.preventDefault();
      var passThis = $('#downloadAll').attr('href');
      downloadAll(passThis);
    });
  });
}( jQuery ));
