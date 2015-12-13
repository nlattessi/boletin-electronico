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
    $('.cargaJustificacion').on('click', function() {
      var id = $(this).attr('data-id');
      $('#justificacionFile' + id).trigger('click');
    });

    // Para la pantalla de /asistencias, usado para cargar justificaciones
    $('.inputJustificacion').on('change', function() {
      var id = $(this).attr('data-id');
      var url = $(this).attr('data-url');

      var form = document.createElement("form");
      form.setAttribute('method', 'post');
      form.setAttribute('action', url);
      form.setAttribute('enctype', 'multipart/form-data');

      $(this).clone().appendTo(form);
      $('<input/>').attr({ type: 'text', id: 'asistenciaId', name: 'asistenciaId', value: id}).appendTo(form);

      document.body.appendChild(form);
      form.submit();
    });

  });
}( jQuery ));
