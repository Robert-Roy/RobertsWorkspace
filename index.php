<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once "util.php";
util::printheader("My Degree is in Business");
//todo Fix "I have used" section to resize better
?>                    
<div class="contentdiv">
    <p>I also know how to program.</p>
</div>
<br>
<div class="contentdiv">
    <p>Ask any hiring manager in this industry what they need,
        and they will tell you,</p>
    <br>
    <div class="centered">"I need somebody who can communicate."</div>
    <br>
    <p>Does that sound like you or someone you know? I have:</p>
    <ul>
        <li>Communicated directly with clients for years</li>
        <li>Supervised employees</li>
        <li>Interviewed potential employees</li>
    </ul>
</div>
<br>
<div class="contentdiv">
    <p>I have used:</p>
    <ul class='shrink-list'>
        <li>PHP</li>
        <li>Linux</li>
        <li>ASP</li>
        <li>Java</li>
        <li>JavaScript</li>
        <li>Python</li>
        <li>MSSQL</li>
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
        <li>JavaScript</li>
        <li>jQuery</li>
        <li>Git</li>
    </ul>
</div>
<br>
<div class="contentdiv">
    <p><a href=<?= util::$GITHUB?>>Click here for code</a></p>
</div>

<?php
util::printfooter();
?>