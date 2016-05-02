
(function(window, document, $) {
    var $form = $('#form');
    $('#padre1Nombre').typeahead({
        minLength: 3,
        source: function (query, process) {
            return $.ajax({
                url: $form.attr('action'),
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

            $('#padre1').val(item.id);
            $('#padre1Nombre').addClass("active");

            return item.nombre +', '+ item.apellido;
        }
    });

    $('#padre2Nombre').typeahead({
        minLength: 3,
        source: function (query, process) {
            return $.ajax({
                url: $form.attr('action'),
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

            $('#padre2').val(item.id);
            $('#padre2Nombre').addClass("active");

            return item.nombre +', '+ item.apellido;
        }
    });

})(window, document, jQuery);
