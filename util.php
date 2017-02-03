<?php
include_once 'forcehttps.php';

//TODO: Only show animation for first pageload of the day

Class util {

    //If uninitialized, static functions are useful all over the website.
    //If initialized, creates a mysql connection ($conn) using sqlconnector.php
    //For security reasons, sqlconnector.php is not included in this repository.
    public static $BACKGROUND = "img/spiral.jpg";
    public static $UNDERCONSTRUCTION = "img/sign.png";
    public static $HAMBURGER = "img/hamburger.png";
    public static $HOME = "index.php";
    public static $ICO = "favicon.ico";
    public static $CONTACT = "contact.php";
    public static $PROJECTS = "projects.php";
    public static $ROBERTSANALYTICS = "dashbosard.php";
    public static $ANALYTICS = "analytics.php";
    public static $ABOUT = "about.php";
    public static $PHONE = "555-555-5555";
    public static $TITLE = "Robert's Workspace";
    public static $IPDATA = "ipdata.php";
    public static $CSS = "default.css";
    public static $WWW = "img/www.jpg";
    public static $PRIVACY = "privacy.php";
    public static $ADMIN = "admin/admin.php";
    public static $GITHUB = "github.php";
    public static $ADMINEMAIL = "robertproy@live.com";
    private $conn = false;

    public function __construct() {
        include_once("sql/sqlconnector.php");
        $this->conn = SQLConnector::Conn();
        if ($this->conn === null) {
            util::handleerror("Could not make SQL connection");
        }
    }

    public function &getConn() {
        return $this->conn;
    }

    public function query($query) {
        //Avoid use of this if at all possible. Use prepared statements.
        $return = false;
        try {
            $return = $this->conn->query($query);
        } catch (Exception $e) {
            util::handleerror("PDO: " . $e->getMessage());
        }
        return $return;
    }

    public function printviews($page, $IP) {
        //Find out how many times IP has viewed current page
        $statement = $this->conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ? and IP = ?');
        $statement->execute([$page, $IP]);
        $viewsonthispage = $statement->fetch(PDO::FETCH_NUM)[0];

        //Find out how many times page has been viewed
        $statement = $this->conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ?');
        $statement->execute([$page]);
        $allviews = $statement->fetch(PDO::FETCH_NUM)[0];

        //TODO: Display this information somehow
        ?>
        <div id="pageviews">Your views on this page: <?= $viewsonthispage ?>
            <br>Total views on this page: <?= $allviews ?></div>
        <?php
    }

    //TODO: Language constants
    //TODO: SQL Demonstration page
    //TODO: admin page to delete sql posts


    public static function getUserIP() {
        return htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
    }

    public static function getPage() {
        return $page = htmlspecialchars(\filter_var(\trim($_SERVER['PHP_SELF']), FILTER_SANITIZE_STRING));
    }

    public static function getTime() {
        return $time = date("Y-m-d H:i:s");
    }

    public static function mailadmin($subject, $message) {
        if ($_SERVER['SERVER_ADDR'] != "::1") {
            mail(util::$ADMINEMAIL, $subject, $message);
        } else {
            echo $subject . "<br>" . $message . "<br>";
        }
    }

    public static function handleerror($errorcode) {
        util::mailadmin("Site Error", "Error " . $errorcode . " occurred on " . $_SERVER['PHP_SELF'] . ".");
    }

    public static function printheader($title) {
        //Prints the page header, title (as string), printed in title format
        //used at the top of every page
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title><?= util::$TITLE; ?></title>
                <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
                <link rel="icon" type="favicon/png" href="image/favicon-32x32.png" sizes="32x32">
                <link rel="icon" type="favicon/png" href="image/favicon-16x16.png" sizes="16x16">
                <link rel="manifest" href="favicon/manifest.json">
                <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
                <link rel="shortcut icon" href="favicon/favicon.ico">
                <meta name="msapplication-config" content="favicon/browserconfig.xml">
                <meta name="theme-color" content="#ffffff">
                <link rel="stylesheet" href=<?= util::$CSS; ?>>
                <link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="javascript.js"></script>
                <script src="anim.js"></script>
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
                                    <div class='burger'>Menu</div>
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
                        <h1><?= $title ?></h1>
                    </div>
                    <br>
                    <?php
                }

                public static function printfooter() {
                    //Prints the page footer
                    //used at the bottom of every page
                    ?>          <div id="footerdiv">
                        <a id="privacy" href="<?= util::$PRIVACY ?>">Privacy</a>
                        <a href="<?= util::$CONTACT ?>">Get in touch with Robert</a>
                        <a id="admin" href="<?= util::$ADMIN ?>">Admin</a>
                    </div>
                </div>
            </body>
        </html><?php
    }

}

if ($_SERVER['SERVER_ADDR'] != "::1") {
    include_once util::$ANALYTICS;
}
?>