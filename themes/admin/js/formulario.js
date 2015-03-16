$(document).ready(function() {
   $("#general").hide();
  $("#Inscrito_id_rol").change(function(){
    $(".informacion").hide();
    $("#general").fadeOut();

    if( $("#Inscrito_id_rol").val() == 2 ){
      $("#lblasistente").show();
      $("#lblasistente2").show();
    }

    if( $("#Inscrito_id_rol").val() == 3 ){
      $("#lblgratuito").show();
      $("#lblgratuito2").show();
    }

    $("#general").fadeIn();
  });
});