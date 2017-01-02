<?php

Class util {

    public static $BACKGROUND = "img/Sample.jpg";
    public static $UNDERCONSTRUCTION = "img/under-const.png";
    public static $HAMBURGER = "img/hamburgerwhite.png";
    public static $MCSLOGO = "img/mcs-logo.jpg";
    public static $HOME = "index.php";
    public static $S404 = "404me.php";
    public static $ICO = "favicon.ico";
    public static $CONTACT = "contact.php";
    public static $PROJECTS = "projects.php";
    public static $ANALYTICS = "analytics.php";
    public static $ABOUT = "about.php";
    public static $PHONE = "555-555-5555";
    public static $TITLE = "Robert's Workspace";
    public static $IPDATA = "ipdata.php";
    public static $CSS = "default.css";
    public static $WWW = "img/WWW.jpg";

    //TODO: Language constants
    //TODO: SQL Demonstration page
    //TODO: anti injection of sql
    //TODO: admin page to delete sql posts
    //TODO: About page
    //todo: set header bar to sit over current page

    public static function printheader($title) {
        //Prints the page header, title (as string), printed in title format
        //used at the top of every page
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title><?= util::$TITLE; ?></title>
                <link rel="icon" href=<?= util::$ICO; ?>>
                <link rel="stylesheet" href=<?= util::$CSS; ?>>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="jQueryTesting.js"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1">
            </head>
            <body>
                <div id="main">
                    <div id="header">
                        <div id="navwrapper">
                            <canvas id="highlighter">                            </canvas>
                            <div id="namebar">
                                <a id="sitename" href="<?= util::$HOME ?>"><?= util::$TITLE ?></a>

                                <a id="header_burger" href="#" onClick="navpop();return false;">
                                    <img class='burger' src="<?= util::$HAMBURGER ?>"/>
                                </a>
                            </div>
                            <nav id="navtop">
                                <a class="header_link" href="<?= util::$HOME ?>">Home</a>
                                <!--<a class="header_link" href="<?= util::$ABOUT ?>">About</a>-->
                                <a class="header_link" href="<?= util::$PROJECTS ?>">Projects</a>
                                <a class="header_link" href="<?= util::$CONTACT ?>">Contact</a>
                            </nav>
                        </div>

                    </div>
                    <div class="contentdiv titlediv">
                        <h2><?= $title ?></h2>
                    </div>
                    <br>
                    <?php
                }

                public static function printfooter() {
                    //Prints the page footer
                    //used at the bottom of every page
                    ?>          <div id="footerdiv">
                        <a href="<?= util::$CONTACT ?>">Get in touch with Robert</a>
                    </div>
                </div>
            </body>
        </html><?php
    }

}

include_once "analytics.php"
?>