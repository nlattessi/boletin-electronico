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

    // Para los "Descargar todos"
    $('#downloadAll').click(function(e) {
      e.preventDefault();
      var passThis = $('#downloadAll').attr('href');
      downloadAll(passThis);
    });

    // Para la pantalla de /asistencias, usado para cargar justificaciones
    $('.inputJustificacion').on('click', function() {
      $(this).val("");
    });
    $('.inputJustificacion').on('change', function() {
      var id = $(this).attr('data-id');
      $('#justificacionForm_' + id).submit();
    });

  });
}( jQuery ));
