<?php

namespace App\Http\Controllers;

use App\Project;
use App\Analytics;

class ProjectsController extends Controller {

    public function index() {

        //TODO: programatically generate list from some sort of database
        //TODO: Responsive images/load images
        //this is NOT the right way to implement this. Will improve after laravel refactor

        $title = "My Projects";
        $analytics = new Analytics();
        $analytics->recordView();

        echo view("partials.projectstop", ["title" => $title]);
        $projectRobertsWorkspace = new Project(
                config("constants.HOME"), "https://github.com/Robert-Roy/RobertsWorkspace", "RobertsWorkspace.com", "This website was created to showcase my programming. 
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
                config("constants.ROBERTSANALYTICS"), "https://github.com/Robert-Roy/RobertsWorkspace/blob/master/dashboard.php", "Robert's Analytics", "This page displays analytics information gathered on this website.");
        $projectIPData = new Project(
                config("constants.IPDATA"), "https://github.com/Robert-Roy/RobertsWorkspace/blob/master/ipdata.php", "About You", "I've been playing around with some IP geolocating APIs. If you're "
                . "curious what websites can see about you, check it out.");
        echo view("partials.project", $projectRobertsWorkspace->getViewData());
        echo view("partials.project", $projectMyMoneyFees->getViewData());
        echo view("partials.project", $projectNumbersIntoWords->getViewData());
        echo view("partials.project", $projectLightSpeed->getViewData());
        echo view("partials.project", $projectClockPuncher->getViewData());
        echo view("partials.project", $projectAnalytics->getViewData());
        echo view("partials.project", $projectIPData->getViewData());
        return view("partials.projectsbottom");
    }

}
