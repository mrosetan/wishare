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
        $('.my-select').searchableOptionList({
          showSelectAll: true,
          showSelectionBelowList: true,
          maxHeight: 100,

        });
    });

    $('#stream').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event,onclosed: function(){
                setTimeout(function(){
                    $("body").css("overflow","");
                },200);
            }},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };


});
