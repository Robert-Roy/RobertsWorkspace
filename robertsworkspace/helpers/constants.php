<?php
//pages
$ANALYTICS = "analytics";
$PRIVACY = "privacy";
$PROJECTS = "projects";
$HOME = ".";
$CONTACT = "contact";
$ROBERTSANALYTICS = "dashboard";
$IPDATA = "ipdata";
$ADMIN = "admin/admin";
$GITHUB = "github";
//Resources
$UNDERCONSTRUCTION = "public_html/images/sign.png";
$MAINSCRIPT = "public_html/js/script.js";
$ANIMSCRIPT = "public_html/js/anim.js";
$CSS = "public_html/css/default.css";
$ICO = "favicon.ico";
$SQLCONNECTOR = "core/sql/sqlconnector.php";
//Information
$PHONE = "555-555-5555";
$SITENAME = "Robert's Workspace";
$ADMINEMAIL = "robert@robertsworkspace.com";
$VIEWROOT = "robertsworkspace/views/";
$FAVICONROOT = "public_html/favicon/";

$isLocalServer = true;
if($_SERVER['SERVER_ADDR'] != "127.0.0.1" && $_SERVER['SERVER_ADDR'] != "::1"){
    $isLocalServer = false;
}
$isTestServer = false;
if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false){
    $isTestServer = true;
}
?>