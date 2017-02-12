<?php
//TODO: programatically generate list from some sort of database
//TODO: Responsive images/load images
$title = "My Projects";
class Project {

    public $href;
    public $githublink;
    public $title;
    public $description;

    public function __construct($href, $githublink, $title, $description) {
        // A blank github link may be passed if no github link is available.
        $this->href = $href;
        $this->githublink = $githublink;
        $this->title = $title;
        $this->description = $description;
    }

    public function printHTML() {
        global $VIEWROOT;
        require $VIEWROOT . "partials/project.view.php";
    }

}

require $VIEWROOT . "partials/projectstop.view.php";
// I don't like the way these are formatted, but it's a small price to pay for
// autoformatting elsewhere.
$projectRobertsWorkspace = new Project(
        $HOME, "https://github.com/Robert-Roy/RobertsWorkspace", "RobertsWorkspace.com", "This website was created to showcase my programming. 
            Code is available on Github.");
$projectMyMoneyFees = new Project(
        "http://web.archive.org/web/20160312232628/http://mymoneyfees.com/", "", "MyMoneyFees.com", "I did substantial work on this website before I had
            researched responsive design. The website was designed
            on a WordPress platform. The current version has been heavily
            modified since then. An archived version is linked here courtesy
            of archive.org.");
$projectNumbersIntoWords = new Project(
        "http://www.numbersintowords.com", "https://github.com/Robert-Roy/numbersintowords.com", "NumbersIntoWords.com", "This website takes (almost) any numerical input and outputs it into "
        . "words. (10<sup>3007</sup>-1 to -10<sup>3007</sup>+1 with support "
        . "for up to 3006 characters after the decimal.");
$projectClockPuncher = new Project(
        "http://clockpuncher.robertsworkspace.com", "https://github.com/Robert-Roy/clockpuncher", "Clock Puncher", "A website I'm collaborating with some friends on. So far it doesn't "
        . "do anything but handle login sessions.");
$projectLightSpeed = new Project(
        "http://lightspeed.robertsworkspace.com", "https://github.com/Robert-Roy/lightspeed", "Light Speed!", "A javascript animation that looks like you're cruising through space. "
        . "Check it out!");
$projectAnalytics = new Project(
        $ROBERTSANALYTICS, "https://github.com/Robert-Roy/RobertsWorkspace/blob/master/dashboard.php", "Robert's Analytics", "This page displays analytics information gathered on this website.");
$projectIPData = new Project(
        $IPDATA, "https://github.com/Robert-Roy/RobertsWorkspace/blob/master/ipdata.php", "About You", "I've been playing around with some IP geolocating APIs. If you're "
        . "curious what websites can see about you, check it out.");
$projectRobertsWorkspace->printHTML();
$projectMyMoneyFees->printHTML();
$projectNumbersIntoWords->printHTML();
$projectLightSpeed->printHTML();
$projectClockPuncher->printHTML();
$projectAnalytics->printHTML();
$projectIPData->printHTML();
require $VIEWROOT . "partials/projectsbottom.view.php";