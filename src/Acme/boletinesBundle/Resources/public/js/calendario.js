$(document).ready(function() {

  $('#calendar').fullCalendar({

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'agendaWeek,agendaDay'
    },

    defaultView: 'agendaWeek',

    eventSources: [
      {
        url: '/actividad/getByUser',
        type: 'GET',
        error: function() {
          console.log("ERROR :: No puedo obtener actividades");
        },
      }
    ],

  });
});
