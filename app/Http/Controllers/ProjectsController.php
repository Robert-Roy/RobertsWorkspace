<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

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
            echo view("partials.adminheader");
            foreach ($projects as $thisProject) {
                echo view("partials.projectedit", $thisProject->getViewData());
            }
            echo view("partials.projectotheroptions");
            return view("partials.adminfooter");
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
        if ($request->has('title') && $request->has('description')) {
            $title = $request->get('title');
            $codeLink = "";
            if ($request->has('code-link')) {
                $codeLink = $request->get('code-link');
            }
            $projectLink = "";
            if ($request->has('project-link')) {
                $projectLink = $request->get('project-link');
            }
            $description = $request->get('description');
            $project = new Project();
            $project->create($projectLink, $codeLink, $title, $description);
            $this->redirectToIndex();
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
        $adminController = new AdminController();
        if ($adminController->loggedIn()) {
            $projectModel = new Project;
            $project = $projectModel->find($id);
            echo view("partials.admineditheader");
            echo view("partials.projectedit", $project->getViewData());
            return view("partials.admineditfooter");
        }
        $portfolioController = new PortfolioController();
        return $portfolioController->projects();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $adminController = new AdminController();
        $adminController->checkLogIn();
        $projectModel = new Project;
        $project = $projectModel->find($id);
        return view("editproject", $project->getViewData());  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $adminController = new AdminController();
        $adminController->checkLogIn();
        $projectModel = new Project;
        $project = $projectModel->find($id);
        if ($request->has('title') && $request->has('description')) {
            $title = $request->get('title');
            $codeLink = "";
            if ($request->has('code-link')) {
                $codeLink = $request->get('code-link');
            }
            $projectLink = "";
            if ($request->has('project-link')) {
                $projectLink = $request->get('project-link');
            }
            $description = $request->get('description');
            $project->setTitle($title);
            $project->setCodeLink($codeLink);
            $project->setProjectLink($projectLink);
            $project->setDescription($description);
            return $this->show($id);
        }else{
            return view("editproject", $project->getViewData());  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $adminController = new AdminController();
        $adminController->checkLogIn();
        $project = new Project();
        $project->deleteById($id);
        $this->redirectToIndex();
    }
    private function redirectToIndex(){
        header('Location: ' . config('constants.PROJECTS'));
        die();
    }
}
