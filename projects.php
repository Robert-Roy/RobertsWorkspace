<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once "util.php";
util::printheader("Robert's Project Portfolio");
//TODO: programatically generate list from some sort of database
//TODO: Wider text, wider images (doesn't look good atm)
//TODO: Responsive images/load images
//TODO: Swappy layout
//TODO: clean up
//TODO: collapsible margin expiriments
?>

<div class="centered" style="max-width:1280px;margin-top:15px;">
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$HOME ?>">
            <div class='imagediv'>
                <div class="projectsquare"style="background-image:url(<?= util::$BACKGROUND ?>);" align="center">
                    <div class='contentdiv projectimage'>
                        <div class='flexFull'><h3>RobertsWorkspace.com</h3></div>
                        <p>This website was created to showcase my programming.
                            Right now it doesn't do me much justice.
                            When past and future projects are added, it will form a more complete picture.</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$IPDATA ?>">
            <div class='imagediv'>
                <div class="projectsquare"style="background-image:url(<?= util::$BACKGROUND ?>);" align="center">
                    <div class='contentdiv projectimage'>
                        <div class='flexFull'><h3>Robert's Analytics</h3></div>
                        <p>I've been playing around with some IP geolocating APIs.
                            If you're curious what websites can see about you,
                            click here!</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentdiv projectcontainer">
        <a class='flexFull'  href="http://www.mymoneyfees.com">
            <div class="projectsquare"style="background-image:url(<?= util::$WWW ?>);" align="center">
                <div class='contentdiv projectimage'>
                    <div class='flexFull'><h3>MyMoneyFees.com</h3></div>
                    <p>I did substantial work on this website before I had
                        researched responsive design. The website was designed
                        on a WordPress platform.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="titlediv contentdiv imagediv centered"style="height:250px;width:250px;">
        <div class="projectsquare"style="background-image:url(<?= util::$UNDERCONSTRUCTION ?>);" align="center">
        </div>
        <div class="captionbox">
            <p>More Coming Soon</p>
        </div>
    </div>
</div>
<?php
util::printfooter();
?>