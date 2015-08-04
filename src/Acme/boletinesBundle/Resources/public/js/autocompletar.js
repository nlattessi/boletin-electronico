(function($){
  $(function(){
      $("#autocompletarInput").keyup(function(){
          if($("#autocompletarInput").val().length > 2){

              $.ajax({
                  method: "POST",
                  url: "autocompletar",
                  data: { search: $("#autocompletarInput").val()}
              })
                  .done(function( msg ) {
                      $("#autocompletarDiv").text(msg);
                  });
          }
      });

  }); // end of document ready
})(jQuery); // end of jQuery name space
