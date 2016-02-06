function generarReporteAlumno(){
    $('#countAl').val($(".count:checked").val());
    armarWhere("#whereAl", "Al");

    /*---EVALUACION----*/
    var evalElegida = $('#fevaluacion').val();
    if(evalElegida != ""){
        //Seleccionó evaluación
        $('#joinTBAl').val('Calificacion');
        var calificacionElegida = $('#fcalificacion').val();
        if(calificacionElegida != ""){
            $('#joinWBAl').val("b.alumno and b.evaluacion = " + evalElegida + " and b.valor =" + calificacionElegida);
        }else {
            $('#joinWBAl').val("b.alumno and b.evaluacion = " + evalElegida);
        }
    }
    /*---EVALUACION FIN----*/
    /*---CONVIVENCIA----*/
    var fechaConvivencia = $('input[name=fechaconvivencia]').val();

    var valorConvivencia = $('.convivencia:checked').val();
    if(fechaConvivencia != "" || valorConvivencia != ""){
        //Seleccionó evaluación
        $('#joinTCAl').val('Convivencia');
        $('#joinWCAl').val("c.alumno");
        if(fechaConvivencia != ""){
            fechaConvivencia += ' 00:00:00';
            $('#joinWCAl').val($('#joinWCAl').val() + " and c.fechaSuceso = '" + fechaConvivencia +"'");
        }
        if(valorConvivencia != ""){
            $('#joinWCAl').val($('#joinWCAl').val() + " and c.valor = " + valorConvivencia);
        }
    }
    /*---CONVIVENCIA FIN----*/
    /*---ASISTENCIA----*/

    var valorAsistencia = $('input[name=asistenciavalor]:checked').val();
    var asistenciaId = $('#asistenciaAId').val();
    if(asistenciaId != ""){
        $('#joinTDAl').val('AlumnoAsistencia');
        $('#joinWDAl').val("d.alumno and d.asistencia in (" + asistenciaId + ")");
        if(valorAsistencia != ""){
            $('#joinWDAl').val($('#joinWDAl').val() + "and d.valor ='" + valorAsistencia +"'");
        }
    }
    /*---ASISTENCIA FIN----*/

    enviarConsulta("#formularioAl");
}

function armarWhere(whereID, sufijo){
    var where = "";
    $('.campo' + sufijo).each(function(index){
        if( $(this).val().length > 0) {
            where += "a." + $(this).attr('campo') + " "+ $(this).attr('operador') +" '" + $(this).val() + "' and ";
        }
    });
    $('.radio' + sufijo + ':checked').each(function(index){
        if( $(this).val().length > 0) {
            where += "a." + $(this).attr('campo') + " = '" + $(this).val() + "' and ";
        }
    });
    where = where.substring(0, where.length - 5);
    $(whereID).val(where);
}
function armarJoin(tabla, where){
    var where = "";
    /*$('#joinT').val('AlumnoAsistencia');
     $('#joinW').val("b.alumno and b.asistencia = 16 and b.valor like 'A'");*/
    $('#joinT').val('Calificacion');
    $('#joinW').val("b.alumno and b.evaluacion = 5" );


}

function enviarConsulta(formId){

    $(formId).submit();
}

function joinT(tabla){
    alert(tabla);
}



(function(window, document, $) {
    var $establecimientoAE = $('#festablecimientoAE');
    $establecimientoAE.change(function() {
        var $form = $(this).closest('form');
        var data = {};
        data[$establecimientoAE.attr('name')] = $establecimientoAE.val();
        data['busqmat'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fmateriaAE');
                $materia.empty();
                $materia.append('<option value="">Seleccione una materia </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fmateriaAE').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });
    });

    function actualizarAsistenciaID(){
        var valorFechaAsistencia = $('input[name=fechaasistencia]').val();
        if(valorFechaAsistencia != "") {
            var $form = $('#formularioAl');
            var data = {};
            data[$('input[name=fechaasistencia]').attr('name')] = $('input[name=fechaasistencia]').val();
            data[$materiaAA.attr('name')] = $materiaAA.val();
            data['busqasis'] = true;
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: data,
                dataType: 'json',
                success: function (res) {
                    var $asistenciaIDs = $('#asistenciaAId');
                    $asistenciaIDs.val("");
                    var ids = "";
                    res.forEach(function (item) {
                        ids += item.id + ",";
                    });
                    ids = ids.substring(0, ids.length - 1);
                    $asistenciaIDs.val(ids);
                }
            });
        }
    }
    $materiaAA=$('#fmateriaAA');

    $materiaAA.change(function() {
        var $form = $(this).closest('form');
        var data = {};
        data['fechaasistencia'] = $('input[name=fechaasistencia]').val();
        data[$materiaAA.attr('name')] = $materiaAA.val();
        data['busqasis'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $asistenciaIDs = $('#asistenciaAId');
                $asistenciaIDs.val("");
                var ids = "";
                res.forEach(function (item) {
                    ids += item.id + ",";
                });
                ids = ids.substring(0, ids.length - 1);
                $asistenciaIDs.val(ids);
            }
        });
    });

    $establecimientoAA = $('#festablecimientoAA');
    $establecimientoAA.change(function() {
        var $form = $(this).closest('form');
        var data = {};
        data[$establecimientoAA.attr('name')] = $establecimientoAA.val();
        data['busqmat'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fmateriaAA');
                $materia.empty();
                $materia.append('<option value="">Seleccione una materia </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fmateriaAA').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });
    });

    var $materia = $('#fmateriaAE');
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
                $evaluacion.append('<option value="">Seleccione una evaluacion </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $evaluacion.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fevaluacion').material_select();
                /*$.each(response, function(idx, eval) {
                    $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                });*/
            }
        });
    });

    var $evaluacion = $('#fevaluacion');
    $evaluacion.change(function() {
        var $form = $(this).closest('form');
        var data = {};
        data[$establecimientoAE.attr('name')] = $establecimientoAE.val();
        data['busqcal'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $calificacion = $('#fcalificacion');
                $calificacion.empty();
                $calificacion.append('<option value="">Seleccione un valor </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $calificacion.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fcalificacion').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });
    });

    $('.datepicker').each(function(item){
        $(this).pickadate({formatSubmit: 'yyyy-mm-dd', onClose: function(){
            actualizarAsistenciaID();
        }});
    })

})(window, document, jQuery);
