(function(window, document, $) {
    var $materia = $('#fmateria');
    $materia.change(function() {
        var $form = $(this).closest('form');
        var data = {};
        data[$materia.attr('name')] = $materia.val();
        data['busqeval'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $evaluacion = $('#fevaluacion');
                $evaluacion.empty();
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(eval){
                    $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                });
                $('#fevaluacion').material_select();
                /*$.each(response, function(idx, eval) {
                    $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                });*/
            }
        });
    });
})(window, document, jQuery);
