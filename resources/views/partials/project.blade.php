<div class="projectcontainer contentdiv">
    <h2>{{ $title }}</h2>
    <div class="projectdescription">
        {!! $description !!}
    </div>
</div>
<div class="crispbutton"><a href="{{ $href }}">See Project</a></div>
<?php
if ($githublink !== "") {
    ?>

    <div class="crispbutton"><a  href="{{ $githublink }}">See Code</a></div>
    <?php
}
?>