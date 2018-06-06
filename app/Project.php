<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    
    public function create($projectLink, $codeLink, $title, $description) {
        // A blank github link may be passed if no github link is available.
        $this->projectlink = $projectLink;
        $this->codelink = $codeLink;
        $this->title = $title;
        $this->description = $description;
        $this->save();
    }
    
    public function setCodeLink($codeLink){
        $this->codelink = $codeLink;
        $this->save();
    }

    public function setTitle($title){
        $this->title = $title;
        $this->save();
    }
    
    public function setProjectLink($projectLink){
        $this->projectlink = $projectLink;
        $this->save();
    }
    
    public function setDescription($description){
        $this->description = $description;
        $this->save();
    }
    
    public function getViewData() {
        //TODO update this so that it makes more sense intuitively
        return[
            "id" => $this->id,
            "href" => $this->projectlink,
            "githublink" => $this->codelink,
            "title" => $this->title,
            "description" => $this->description
        ];
    }
    
    public function deleteById($id){
        $project = $this->find($id);
        $project->delete();
    }

}