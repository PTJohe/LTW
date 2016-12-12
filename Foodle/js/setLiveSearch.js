function getStates(value){
  if(value.length==0){
    $("#results").html("");
    return;
  }
  $.post("livesearch.php",{partialState:value},function(data){
    $("#results").html(data);
  });
}
