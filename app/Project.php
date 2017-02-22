<?php

namespace App;

class Project{

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


    public function getViewData() {
        return[
            "href" => $this->href,
            "githublink" => $this->githublink,
            "title" => $this->title,
            "description" => $this->description
        ];
    }

}
