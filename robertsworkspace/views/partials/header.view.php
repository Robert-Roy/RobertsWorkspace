<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $SITENAME; ?></title>
        <?php require "favicon.view.php"; ?>
        <link rel="stylesheet" href=<?= $CSS; ?>>
        <link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="<?= $MAINSCRIPT ?>"></script>
        <script src="<?= $ANIMSCRIPT ?>"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="navwrapper">
                    <canvas id="highlighter">                            </canvas>
                    <div id="namebar">
                        <a id="sitename" href="<?= $HOME ?>"><?= $SITENAME ?></a>

                        <a id="header_burger" href="#" onClick="navpop();return false;">
                            <div class='burger'>Menu</div>
                        </a>
                    </div>
                    <nav id="navtop">
                        <a class="header_link" href="<?= $HOME ?>">Home</a>
                        <a class="header_link" href="<?= $PROJECTS ?>">Projects</a>
                        <a class="header_link" href="<?= $CONTACT ?>">Contact</a>
                    </nav>
                </div>

            </div>
            <div class="contentdiv titlediv">
                <h1><?= $title ?></h1>
            </div>
            <br>