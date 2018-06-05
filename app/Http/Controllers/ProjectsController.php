<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // different admin and non-admin views
        $adminController = new AdminController();
        if ($adminController->loggedIn()) {
            $projects = Project::all();
            echo view("partials.admineditheader");
            foreach ($projects as $thisProject) {
                echo view("partials.projectedit", $thisProject->getViewData());
            }
            return view("partials.admineditfooter");
        }
        $portfolioController = new PortfolioController();
        return $portfolioController->projects();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $adminController = new AdminController();
        $adminController->checkLogIn();
        return view("newproject");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $adminController = new AdminController();
        $adminController->checkLogIn();
        if (Input::has('title') && Input::has('description')) {
            $title = Input::get('title');
            $codeLink = "";
            if (Input::has('code-link')) {
                $codeLink = Input::get('code-link');
            }
            $projectLink = "";
            if (Input::has('project-link')) {
                $projectLink = Input::get('project-link');
            }
            $description = Input::get('description');
            $project = new Project();
            $project->create($projectLink, $codeLink, $title, $description);
            return $this->create();
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // get specific project
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
