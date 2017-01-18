<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once "util.php";
$util = new util();
$conn = $util->getConn();
$IP = $util->getUserIP();
$page = $util->getPage();
util::printheader("Robert's Analytics");
?>
<div class="contentdiv">
    <?php
    try {
        //Find out how many times IP has viewed current page
        $statement = $conn->prepare('SELECT DISTINCT PAGE FROM PageViews WHERE IP = ?');
        $statement->execute([$IP]);
        ?>
        You have viewed the following pages:
        <ul>
            <?php
            $totalViews = 0;
            // show user views of ALL pages by getting all pages then showing all views
            foreach ($statement as $row) {
                $rowPage = $row['PAGE'];
                $rowPageViews = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ? AND IP = ?');
                $rowPageViews->execute([$rowPage, $IP]);
                $rowViewCount = $rowPageViews->fetch(PDO::FETCH_NUM)[0];
                $totalViews += $rowViewCount;
                echo "<li>" . $rowPage . " (" . $rowViewCount . " views)</li>";
            }
            ?>
        </ul>
        <p>You have a total of <?= $totalViews ?> page views.</p>
        <?php
        //Find out how many times page has been viewed
        $statement = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ?');
        $statement->execute([$page]);
        $allviewsonthispage = $statement->fetch(PDO::FETCH_NUM)[0];

        //Find out how many times all pages have been viewed
        $statement = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE IP = ?');
        $statement->execute([$IP]);
        $userviewsonallpages = $statement->fetch(PDO::FETCH_NUM)[0];

        //Find out how many times page has been viewed
        $statement = $conn->prepare('SELECT * FROM PageViews');
        $statement->execute();
        $allviewsonallpages = $statement->rowCount();
        //TODO: Display this information somehow
    } catch (Exception $ex) {
        Echo "An error occurred. It has been reported.";
        util::handleerror("Error occurred on " .
                $page . " at " . $time . ". " . $ex->getmesage);
    }
    ?>
</div>
<?php
util::printfooter();
?>