<!DOCTYPE html>
@include("partials.header")

<div class="contentdiv">
    <p>I have used:</p>
    <ul class='shrink-list'>
        <li>PHP</li>
        <li>Linux</li>
        <li>ASP</li>
        <li>Java</li>
        <li>JavaScript</li>
        <li>Python</li>
        <li>MySQL</li>
        <li>VB.NET</li>
        <li>GIMP 2</li>
        <li>jQuery</li>
        <li>WordPress</li>
    </ul>
</div>

<br>

<div class="contentdiv">
    <p>This website uses:</p>
    <ul>
        <li>PHP (<?= phpversion(); ?>)</li>
        <li>Laravel ({{ App::VERSION() }})</li>
        <li>JavaScript</li>
        <li>jQuery</li>
        <li>Git</li>
        <li>MySQL (PDO)</li>
    </ul>
</div>

<br>

<div class="contentdiv">
    <p><a href="{{ config('constants.GITHUB')}}"> My code is available on GitHub</a></p>
</div>

@include("partials.footer")