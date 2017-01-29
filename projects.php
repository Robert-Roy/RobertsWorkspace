<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once "util.php";
util::printheader("My Projects");

//TODO: programatically generate list from some sort of database
//TODO: Responsive images/load images

class Project {

    public $href;
    public $title;
    public $description;

    public function __construct($href, $title, $description) {
        $this->href = $href;
        $this->title = $title;
        $this->description = $description;
    }

    public function printHTML() {
        ?>
        <div class="contentdiv projectcontainer">
            <a class='flexFull' href="<?= $this->href ?>">
                <div class='imagediv'>
                    <div class="projectsquare">
                        <div class='contentdiv projectimage'>
                            <div class='flexFull'><h3><?= $this->title ?></h3></div>
                            <p><?= $this->description ?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }

}
?>

<div class="centered" style="max-width:1280px;margin-top:15px;">
    <?php
    // I don't like the way these are formatted, but it's a small price to pay for
    // autoformatting elsewhere.
    $projectRobertsWorkspace = new Project(
            util::$GITHUB, "RobertsWorkspace.com", "This website was created to showcase my programming. 
            Code is available on Github. Click here to see it.");
    $projectMyMoneyFees = new Project(
            "http://web.archive.org/web/20160312232628/http://mymoneyfees.com/", "MyMoneyFees.com", "I did substantial work on this website before I had
            researched responsive design. The website was designed
            on a WordPress platform. The current version has been heavily
            modified since then. An archived version is linked here courtesy
            of archive.org.");
    $projectNumbersIntoWords = new Project(
            "http://www.numbersintowords.com", "NumbersIntoWords.com", "This website takes (almost) any numerical input and outputs it into"
            . "words. (10<sup>3007</sup>-1 to -10<sup>3007</sup>+1 with support"
            . "for up to 3006 characters after the decimal!");
    $projectClockPuncher = new Project(
            "http://clockpuncher.robertsworkspace.com", "Clock Puncher", "A website I'm collaborating with some friedns on. So far it doesn't"
            . "do anything but handle login sessions.");
    $projectLightSpeed = new Project(
            "http://lightspeed.robertsworkspace.com", "Light Speed!", "A javascript animation that looks like you're cruising through space."
            . "Check it out!");
    $projectAnalytics = new Project(
            util::$ROBERTSANALYTICS, "Robert's Analytics", "This page displays analytics information gathered on this website.");
    $projectIPData = new Project(
            util::$IPDATA, "About You", "I've been playing around with some IP geolocating APIs. If you're"
            . "curious what websites can see about you, click here!");
    $projectRobertsWorkspace->printHTML();
    $projectMyMoneyFees->printHTML();
    $projectNumbersIntoWords->printHTML();
    $projectLightSpeed->printHTML();
    $projectClockPuncher->printHTML();
    $projectAnalytics->printHTML();
    $projectIPData->printHTML();
    ?>
    <div class="contentdiv projectcontainer">
        <a class='flexFull' href="<?= util::$ROBERTSANALYTICS ?>">
            <div class='imagediv'>
                <div class="projectsquare">
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
                <div class="projectsquare">
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
</div>
<?php
util::printfooter();
?>