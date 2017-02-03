$(document).ready(function() {

    // function to show our popups
    function showPopup(whichpopup) {
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').show().css({
            'height': docHeight
        }); //display your popup background and set height to the page height
        $('.popup' + whichpopup).show().css({
            'top': scrollTop + 20 + 'px'
        }); //show the appropriate popup and set the content 20px from the window top
    }

    // function to close our popups
    function closePopup() {
        $('.overlay-bg, .overlay-content').hide(); //hide the overlay
    }

    // timer if we want to show a popup after a few seconds.
    //get rid of this if you don't want a popup to show up automatically
    /*setTimeout(function() {
        // Show popup3 after 2 seconds
        showPopup(200000);
    }, 2000);*/


    // show popup when you click on the link
    $('.show-popup').click(function(event) {
        event.preventDefault(); // disable normal link function so that it doesn't refresh the page
        var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show

        showPopup(selectedPopup); //we'll pass in the popup number to our showPopup() function to show which popup we want
    });

    $('#overToMail').click(function(event) {
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');

        showPopup(selectedPopup);
    });

    $('#reportItems').click(function(event) {
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');

        showPopup(selectedPopup);
    });

    $('#updateToItem').click(function(event) {
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');

        showPopup(selectedPopup);
    });

    $('#reportThisPage').click(function(event) {
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');

        showPopup(selectedPopup);
    });

    $('#updateToPage').click(function(event) {
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');

        showPopup(selectedPopup);
    });

    $('.close-btn, .overlay-bg').click(function() {
        closePopup();
    });

    // hide the popup when user presses the esc key
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // if user presses esc key
            closePopup();
        }
    });
});
$(function() {
    var moveLeft = 20;
    var moveDown = 10;

    $('a#trigger').hover(function(e) {
        $('div#pop-up').show();
        //.css('top', e.pageY + moveDown)
        //.css('left', e.pageX + moveLeft)
        //.appendTo('body');
    }, function() {
        $('div#pop-up').hide();
    });

    $('a#trigger').mousemove(function(e) {
        $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    });

});
