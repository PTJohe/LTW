 $(document).on('input', '#slider', function() {
     $('#slider_value').html( $(this).val() );
     });

function getRanges(value){
  if(value.length==0){
    $("#resultRating").html("");
    return;
  }
  $.post("ratingsearch.php",{restRating:value},function(data){
    $("#resultRating").html(data);
  });
}
