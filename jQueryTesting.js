/* 
 * All rights reserved. Copyright Robert Roy 2016.
 */

var pathname = window.location.pathname;
var $defaultHighlighted; //gets set after pageload
var blnCorrectHighlight = false;   // a bln that notes whether or not something has moved the navbar unusually

function navpop() {
    //hamburger icon click onClick, toggles navbar open/shut
    $('#navtop').toggleClass('open');
    $('#header_burger').toggleClass('open');
}

$(window).load(function () {
    //hamburger clicking anywhere on the screen except the
    // navbar links and burger closes
    //the navtop menu once opened
    //hamburger closes with another function above
    $('body').click(function (event) {
        $target = $(event.target);
        if (!$target.hasClass('header_link')
                && !$target.hasClass('burger')
                && $('#navtop').hasClass('open')) {
            $('#navtop').removeClass('open');
            $('#header_burger').removeClass('open');
        }
        ;

    });



    //$('body').css("background-image", "url(img/untitled2muted.jpg)");
    $defaultHighlighted = $('.header_link:contains("Home")');// $defaultHighlighted is where the header highlighter goes when not actively covering something

    setHighlightedLink(true); // check path on pageload and place highlighter
    $(window).resize(function () {
        if (window.innerWidth < 520) {
            if (!$defaultHighlighted.is($('.header_link:contains("Home")'))) {
                //move highlighter to sitename if it isn't there
                $defaultHighlighted = $('.header_link:contains("Home")');
                $('#highlighter').stop();
                animateTo($('#highlighter'), $defaultHighlighted, 0);
                blnCorrectHighlight = false;
            }
        } else {
            if (!blnCorrectHighlight) {
                //if the page resizes large enough and the path has not been checked
                //since $defaultHighlighted has been chosen last
                //check the path to verify correct header element is in fact chosen
                blnCorrectHighlight = !blnCorrectHighlight;
                setHighlightedLink(true);
            }
            $('#navtop').removeClass('open');
            $('#header_burger').removeClass('open');
        }
    });
    $('.header_link').hover(function () {
        //highlighting header links on hover
        $('#highlighter').stop(true); //needs two to compensate for delay
        if ($('body').width() > 520) {
            animateTo($('#highlighter'), $(this), 0);
        }
    }, function () {
        animateTo($('#highlighter'), $defaultHighlighted, 500);
    });
});

function animateTo($moved, $newParent, intDelayMS) {
    //moves an absolute position element to the position of another element,
    //regardless of parent container. Also changes size of moving object to fit 
    //other object + 10px on each side


    marginLeft = $newParent.css('margin-left');
    marginLeft = Number(marginLeft.replace("px", ""));
    paddingLeft = $newParent.css('padding-left');
    paddingLeft = Number(paddingLeft.replace("px", ""));
    $moved.delay(intDelayMS).animate({left: paddingLeft + marginLeft + $newParent.position().left
                + $newParent.parent().offset().left - $moved.parent().offset().left
                - 2,
        width: $newParent.width() + 4}, 200);

}

function validateContactForm() {
    //clientside check, just makes sure fields are not overlooked
    //no validation occurs client-side on data integrity
    //TODO make this prettier
    //TODO create a system so that I can give forms a particular type/name/something and it will
    //auto check regardless of where the form is IE "Text" "Phone" "Email" "Number"
    inputname = document.getElementsByName("name")[0];
    strname = inputname.value;
    inputemail = document.getElementsByName("email")[0];
    stremail = inputemail.value;
    inputphone = document.getElementsByName("phone")[0];
    strphone = inputphone.value;
    inputmessage = document.getElementsByName("message")[0];
    strmessage = inputmessage.value;
    blnvalidinput = true;

    if (strname === "") {
        blnvalidinput = false;
        $(inputname).css("background", "#ffb3b3");
    } else {
        $(inputname).css("background", "#b3ffb3");
    }
    if (stremail === "") {
        blnvalidinput = false;
        $(inputemail).css("background-color", "#ffb3b3");
    } else {
        $(inputemail).css("background", "#b3ffb3");
    }
    if (strphone === "") {
        blnvalidinput = false;
        $(inputphone).css("background-color", "#ffb3b3");
    } else {
        $(inputphone).css("background", "#b3ffb3");
    }
    if (strmessage === "") {
        blnvalidinput = false;
        $(inputmessage).css("background-color", "#ffb3b3");
    } else {
        $(inputmessage).css("background", "#b3ffb3");
    }

    if (blnvalidinput === false) {
        return false;
    }

}
;

function setHighlightedLink(blnSnapTo) {
    // function checks whether the highlighter should set $defaultHighlighted
    //to something other than the #sitename. blnSnapTo causes the function
    //to send the highlighter instantly to its destination, usually for page loads
    if (window.innerWidth >= 520) {
        //check header only if screen is large enough to display full header
        if (pathname.includes("projects")) {
            $defaultHighlighted = $('.header_link:contains("Projects")');
            if ($defaultHighlighted === null) {
                $defaultHighlighted = $('.header_link:contains("Home")');
            }
            $('#highlighter').stop();
            animateTo($('#highlighter'), $defaultHighlighted, 0);
            if (blnSnapTo) {
                $('#highlighter').finish();
            }
        } else if (pathname.includes("contact")) {
            $defaultHighlighted = $('.header_link:contains("Contact")');
            if ($defaultHighlighted === null) {
                $defaultHighlighted = $('.header_link:contains("Home")');
            }
            $('#highlighter').stop();
            animateTo($('#highlighter'), $defaultHighlighted, 0);
            if (blnSnapTo) {
                $('#highlighter').finish();
            }
        } else {
            $defaultHighlighted = $('.header_link:contains("Home")');
            $('#highlighter').stop();
            animateTo($('#highlighter'), $defaultHighlighted, 0);
            if (blnSnapTo) {
                $('#highlighter').finish();
            }
        };
    } else {
        //checkpath later when the screen is bigger
        blnCorrectHighlight = false;
    }
}

if (!String.prototype.includes) {
    //because ie/opera/safari don't have .includes
    String.prototype.includes = function () {
        'use strict';
        return String.prototype.indexOf.apply(this, arguments) !== -1;
    };
}
;