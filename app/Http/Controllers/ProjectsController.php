<?php

namespace App\Http\Controllers;

use App\Project;
use App\Analytics;

class ProjectsController extends Controller {

    public function index() {

        //TODO: add pictures
        //Still needs improvement. Calling the partials in this way seems sloppy.

        $title = "My Projects";
        $analytics = new Analytics();
        $analytics->recordView("projects");
        $projects = Project::all();
        echo view("partials.projectstop", ["title" => $title]);
        foreach ($projects as $thisProject) {
            echo view("partials.project", $thisProject->getViewData());
        }
        return view("partials.projectsbottom");
    }

}
