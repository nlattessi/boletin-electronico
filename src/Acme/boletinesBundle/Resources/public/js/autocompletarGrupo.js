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
                            apellido: obj.apellido
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
            return item.query.replace( regex, "<span style='font-weight: bold'>$1</span>" );
        },
        updater: function (obj) {
            var item = JSON.parse(obj);
            var exists = false;
            $(".miembros").each(function() {
                if($(this).val() == item.id){
                    exists = true;
                    return false;
                }
            });
            if(!exists) {

                $('#miembros').append(
                '<li class="collection-item">'
                +'<input type="hidden" class="miembros" name="idMiembro[]" value="'
                + item.id
                +'"/><span>'
                +item.nombre + ', ' + item.apellido
                +'</span><a href="#" data-position="left" data-delay="25" data-tooltip="Eliminar" class="coll-btn-fix secondary-content tooltipped btn-small btn waves-effect waves-light noAgregar"><i class="icon-linear-trash"></i></a>'
                +'</li>'
                );
                $(".noAgregar").click(function(e){
                    e.preventDefault();
                    $(this).parent().remove();/*
                    if ($('#miembros div').length < 1) {
                        $('#newMensajeSubmit').addClass("disabled");
                        $('#newMensajeSubmit').prop("disabled", true);
                    }*/
                });
                /*
                $('#newMensajeSubmit').removeClass("disabled");
                $('#newMensajeSubmit').prop("disabled", false);
                */
            }

            return '';
        }
    });
})(window, document, jQuery);
