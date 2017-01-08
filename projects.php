<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once "util.php";
util::printheader("Robert's Project Portfolio");
//TODO: programatically generate list from some sort of database
//TODO: Responsive images/load images
?>

<div class="centered" style="max-width:1280px;margin-top:15px;">
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$GITHUB ?>">
            <div class='imagediv'>
                <div class="projectsquare" style="background-image:url(<?= util::$BACKGROUND ?>);" align="center">
                    <div class='contentdiv projectimage'>
                        <div class='flexFull'><h3>RobertsWorkspace.com</h3></div>
                        <p>This website was created to showcase my programming.
                            Code is available on GitHub. Click here to see it.</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$ROBERTSANALYTICS ?>">
            <div class='imagediv'>
                <div class="projectsquare" style="background-image:url(<?= util::$BACKGROUND ?>);" align="center">
                    <div class='contentdiv projectimage'>
                        <div class='flexFull'><h3>Robert's Analytics</h3></div>
                        <p>This page displays analytics information gathered on this website.
                            It is going to supply more information in the very near future.</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$IPDATA ?>">
            <div class='imagediv'>
                <div class="projectsquare" style="background-image:url(<?= util::$BACKGROUND ?>);" align="center">
                    <div class='contentdiv projectimage'>
                        <div class='flexFull'><h3>About You</h3></div>
                        <p>I've been playing around with some IP geolocating APIs.
                            If you're curious what websites can see about you,
                            click here!</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="contentdiv projectcontainer">
        <a class='flexFull'  href="http://web.archive.org/web/20160312232628/http://mymoneyfees.com/">
            <div class="projectsquare" style="background-image:url(<?= util::$WWW ?>);" align="center">
                <div class='contentdiv projectimage'>
                    <div class='flexFull'><h3>MyMoneyFees.com</h3></div>
                    <p>I did substantial work on this website before I had
                        researched responsive design. The website was designed
                        on a WordPress platform. The current version has been heavily
                        modified since then. An archived version is linked here courtesy
                        of archive.org.</p>
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