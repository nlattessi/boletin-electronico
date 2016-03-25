(function(window, document, $) {
    $('#typeahead').typeahead({
      minLength: 3,
      source: function (query, process) {
        return $.ajax({
          url: 'autocompletar',
          type: 'GET',
          data: {
            query: query,
          },
          dataType: 'json',
          success: function(result) {
            var data = [];
            $.each(result, function(i, obj) {
              var item = {
                id: obj.id,
                query: obj.nombre + ' ' + obj.apellido,
                nombre: obj.nombre,
                apellido: obj.apellido,
                fotoWebPath: obj.fotoWebPath
              };
              data.push(JSON.stringify(item));
            });

            return process(data);
          },
          error: function(result) {
            console.log(result);
            console.log('error');
          }
        });
      },
      matcher: function(obj) {
        var item = JSON.parse(obj);
        if (item.query.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
            return true;
        }
      },
      sorter: function (items) {
        return items.sort();
      },
      highlighter: function (obj) {
        var item = JSON.parse(obj);
        var regex = new RegExp( '(' + this.query + ')', 'gi' );
        return item.query.replace( regex, "<strong>$1</strong>" );
      },
      updater: function (obj) {
        var item = JSON.parse(obj);
        var exists = false;
        $(".destinatarios").each(function() {
          if($(this).val() == item.id){
            exists = true;
            return false;
          }
        });
        if(!exists) {

          var assetPath = (item.fotoWebPath) ? item.fotoWebPath : "bundles/boletines/images/user-blank.png";

          $('#destinatarios').append(
              '<div class="chip">'
              + '<img src="/' + assetPath + '" alt="">'
              + '<input type="hidden" class="destinatarios" name="idUsuarioRecibe[]" value="' + item.id + '"/>'
              + item.nombre
              + ' <a class="chipclose noAgregar"><i class="icon-linear-cross"></i></a>'
              + '</div>'
          );
          $(".noAgregar").click(function(e){
            e.preventDefault();
            $(this).parent().remove();
            if ($('#destinatarios div').length < 1) {
              $('#newMensajeSubmit').addClass("disabled");
              $('#newMensajeSubmit').prop("disabled", true);
            }
          });
          $('#newMensajeSubmit').removeClass("disabled");
          $('#newMensajeSubmit').prop("disabled", false);
        }

        return '';
      }
    });
})(window, document, jQuery);
