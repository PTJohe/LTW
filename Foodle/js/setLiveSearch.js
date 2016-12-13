function getStates(value){
  if(value.length==0){
    $("#results").html("");
    return;
  }
  $.post("search/livesearch.php",{partialState:value},function(data){
    $("#results").html(data);
  });
}
