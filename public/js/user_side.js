$(document).ready(function(){

    $(".friendActions").submit(function(){
      $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');

    return true;
    });



});
