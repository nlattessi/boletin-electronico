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
            $('#joinWBAl').val("a.id = b.alumno and b.evaluacion = " + evalElegida + " and b.valor =" + calificacionElegida);
        }else {
            $('#joinWBAl').val("a.id = b.alumno and b.evaluacion = " + evalElegida);
        }
    }
    /*---EVALUACION FIN----*/
    /*---CONVIVENCIA----*/
    var fechaConvivencia = $('input[name=fechaconvivencia]').val();

    var valorConvivencia = $('.convivencia:checked').val();
    if(fechaConvivencia != "" || valorConvivencia != ""){
        //Seleccionó evaluación
        $('#joinTCAl').val('Convivencia');
        $('#joinWCAl').val("a.id = c.alumno");
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
        $('#joinWDAl').val("a.id = d.alumno and d.asistencia in (" + asistenciaId + ")");
        if(valorAsistencia != ""){
            $('#joinWDAl').val($('#joinWDAl').val() + "and d.valor ='" + valorAsistencia +"'");
        }
    }
    /*---ASISTENCIA FIN----*/

    enviarConsulta("#formularioAl");
}

function generarReporteEvaluacion(){
    $('#countEv').val($(".count:checked").val());

    var fechaHasta = $('input[name=fechaHastaEv]').val();
    var fechaDesde = $('input[name=fechaDesdeEv]').val();
    var where = "";

    if (fechaHasta != ""){
        where += "a.fecha < '" + fechaHasta + ' 00:00:00' + "'";
    }
    if (fechaDesde != ""){
        if(where != ""){
            where += " and "
        }
        where += "a.fecha > '" + fechaDesde + ' 00:00:00'+ "'";
    }

    $("#whereEv").val(where);


    /*JOINS*/

    var materiaElegida = $('#fmateriaEv').val();
    if(materiaElegida != ""){
        //Seleccionó evaluación
        $('#joinTBEv').val('Materia');

        $('#joinWBEv').val("a.materia = b.id and a.materia = " + materiaElegida );
        $('#joinSBEv').val('b.nombre');
    }
    var docenteElegido = $('#fdocenteEv').val();
    if(docenteElegido != ""){
        //Seleccionó evaluación
        $('#joinTCEv').val('Docente');

        $('#joinWCEv').val("a.docente = c.id and a.docente = " + docenteElegido );
        $('#joinSCEv').val(' c.nombre, c.apellido');
    }


    enviarConsulta("#formularioEv");
}

function generarReporteCalificacion(){
    $('#countCa').val($(".count:checked").val());
    armarWhere("#whereCa", "Ca");
    //no tiene where sobre la misma tabla

    /*---EVALUACION----*/
    var evaluacionId = $('#evaluacionCId').val();
    var valorCalificacion = $('#valorcalificacionC').val();
    if(evaluacionId != ""){
        $('#joinTBAl').val('Evaluacion');
        $('#joinWBAl').val("a.evaluacion = b.id and a.evaluacion in (" + evaluacionId + ")");
    }

    /*---EVALUACION FIN----*/


    enviarConsulta("#formularioCa");
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
    $establecimientoAE.change(function() {formajax
        var $form = $('#formajax');
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

    var $establecimientoEV = $('#festablecimientoEv');
    $establecimientoEV.change(function() {
        var $form = $('#formajax');
        var data = {};
        data[$establecimientoEV.attr('name')] = $establecimientoEV.val();
        data['busqmat'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fmateriaEv');
                $materia.empty();
                $materia.append('<option value="">Seleccione una materia </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fmateriaEv').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/

            }
        });
        /*DOCENTES*/
        var data2 = {};
        data2[$establecimientoEV.attr('name')] = $establecimientoEV.val();
        data2['busqdoc'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data2,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fdocenteEv');
                $materia.empty();
                $materia.append('<option value="">Seleccione un docente </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.apellido + ', ' + item.nombre + '</option>');
                });
                $('#fdocenteEv').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });

    });

    var $establecimientoCA = $('#festablecimientoCa');
    $establecimientoCA.change(function() {
        var $form = $('#formajax');
        var data = {};
        data[$establecimientoCA.attr('name')] = $establecimientoCA.val();
        data['busqmat'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fmateriaCa');
                $materia.empty();
                $materia.append('<option value="">Seleccione una materia </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
                $('#fmateriaCa').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/

            }
        });
        /*DOCENTES*/
        var data2 = {};
        data2[$establecimientoCA.attr('name')] = $establecimientoCA.val();
        data2['busqdoc'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data2,
            dataType: 'json',
            success : function(res) {
                var $materia = $('#fdocenteCa');
                $materia.empty();
                $materia.append('<option value="">Seleccione un docente </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $materia.append('<option value="' + item.id + '">' + item.apellido + ', ' + item.nombre + '</option>');
                });
                $('#fdocenteCa').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });

        /*VALORES CALIFICACION*/

        var data3 = {};
        data3[$establecimientoCA.attr('name')] = $establecimientoCA.val();
        data3['busqcal'] = true;
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data3,
            dataType: 'json',
            success : function(res) {
                var $calificaciones = $('#valorcalificacionC');
                $calificaciones.empty();
                $calificaciones.append('<option value="">Seleccione un valor </option>');
                //var $newEvaluacionData = $(html).find('#fevaluacion option');
                res.forEach(function(item){
                    $calificaciones.append('<option value="' + item.id + '">' +  item.nombre + '</option>');
                });
                $('#valorcalificacionC').material_select();
                /*$.each(response, function(idx, eval) {
                 $evaluacion.append('<option value="' + eval.id + '">' + eval.nombre + '</option>');
                 });*/
            }
        });

    });


    var $fmateriaCA = $('#fmateriaCa');
    var $fdocenteCA = $('#fdocenteCa');
    $fmateriaCA.change(function() {
        var $form = $('#formajax');
        var data = {};
        data[$fdocenteCA.attr('name')] = $fdocenteCA.val();
        data[$fmateriaCA.attr('name')] = $fmateriaCA.val();
        data['busqevalmatdoc'] = true;
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            dataType: 'json',
            success: function (res) {
                var $evaluacionIDs = $('#evaluacionCId');
                $evaluacionIDs.val("");
                var ids = "";
                res.forEach(function (item) {
                    ids += item.id + ",";
                });
                ids = ids.substring(0, ids.length - 1);
                $evaluacionIDs.val(ids);
            }
        });
    });
    $fdocenteCA.change(function() {
        var $form = $('#formajax');
        var data = {};
        data[$fdocenteCA.attr('name')] = $fdocenteCA.val();
        data[$fmateriaCA.attr('name')] = $fmateriaCA.val();
        data['busqevalmatdoc'] = true;
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            dataType: 'json',
            success: function (res) {
                var $evaluacionIDs = $('#evaluacionCId');
                $evaluacionIDs.val("");
                var ids = "";
                res.forEach(function (item) {
                    ids += item.id + ",";
                });
                ids = ids.substring(0, ids.length - 1);
                $evaluacionIDs.val(ids);
            }
        });
    });

    function actualizarAsistenciaID(){
        var valorFechaAsistencia = $('input[name=fechaasistencia]').val();
        if(valorFechaAsistencia != "") {
            var $form = $('#formajax');
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
        var $form = $('#formajax');
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
        var $form = $('#formajax');
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
        var $form = $('#formajax');
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
        var $form = $('#formajax');
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
