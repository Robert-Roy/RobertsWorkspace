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

    public function getViewData() {
        //TODO update this so that it makes more sense intuitively
        return[
            "href" => $this->projectlink,
            "githublink" => $this->codelink,
            "title" => $this->title,
            "description" => $this->description
        ];
    }

}