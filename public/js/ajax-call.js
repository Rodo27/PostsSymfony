function likes(id){

  let RUTA = Routing.generate('likes');
  $.ajax({
    type: 'POST',
    url: RUTA,
    data: ({id:id}),
    async: true,
    dataType: 'json',
    success: function(data){
      window.location.reload();
    }
  });


}