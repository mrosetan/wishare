$(document).ready(function(){

    $(".friendActions").submit(function(){
      $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');

    return true;
    });

    $('#example-post').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 200,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%'
    });

    $(function() {
        // initialize sol
        $('#my-select').searchableOptionList({
          showSelectAll: true,
          showSelectionBelowList: true,

        });
    });

});
