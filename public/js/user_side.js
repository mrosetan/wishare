$(document).ready(function(){

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

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



    $(".favorite").on('click', function() {
      var select = $(this);
      var fave = select.attr('data-favestatus');
      var wishid = select.attr('data-wishid');
        // alert(wishid);
      if(fave == "favorite"){
        $.ajax({
            type: 'POST',
            url: '/favorite',
            data: {id: wishid},
            success: function(status)
            {
                $(this).attr('data-favestatus', 'unfave');
                // alert(status);

            },
            error: function()
            {
                alert('Something went wrong.');
            }
        });
        $(this).children().css("color", "#ce5a57");
        $(this).attr('data-favestatus', 'unfave');
      }
      else{
        $.ajax({
            type: 'POST',
            url: '/unfavorite',
            data: {id: wishid},
            success: function(status)
            {
                $this.attr('data-favestatus', 'favorite');
                alert(status);

            },
            error: function()
            {
                alert('Something went wrong.');
            }
        });
        $(this).children().css("color", "#428bca");
        $(this).attr('data-favestatus', 'favorite');
        // alert('unfave');
      }

    });


    $(".trackwish").on('click', function() {
      var select = $(this);
      var track = select.attr('data-trackstatus');
      var wishid = select.attr('data-wishid');
        // alert(wishid);
      if(track == "trackwish"){
        $.ajax({
            type: 'POST',
            url: '/trackwish',
            data: {id: wishid},
            success: function(status)
            {
                $(this).attr('data-trackstatus', 'untrack');
                // alert(status);

            },
            error: function()
            {
                alert('Something went wrong.');
            }
        });
        $(this).children().css("color", "#ce5a57");
        $(this).attr('data-trackstatus', 'untrack');
      }
      else{
        $.ajax({
            type: 'POST',
            url: '/untrackwish',
            data: {id: wishid},
            success: function(status)
            {
                $this.attr('data-trackstatus', 'trackwish');
                alert(status);

            },
            error: function()
            {
                alert('Something went wrong.');
            }
        });
        $(this).children().css("color", "#428bca");
        $(this).attr('data-trackstatus', 'trackwish');
        // alert('unfave');
      }

    });


});
