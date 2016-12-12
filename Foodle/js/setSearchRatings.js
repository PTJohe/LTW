function getRatings(value){
  if(value.length==0){
    $("#resultRating").html("");
    return;
  }
  $.post("ratingsearch.php",{restRating:value},function(data){
    $("#resultRating").html(data);
  });
}
