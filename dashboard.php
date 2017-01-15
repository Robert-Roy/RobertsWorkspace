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
    <p>This page is still in development.</p>
</div>
<br>
<div class="contentdiv">
    <?php
    try {
        //Find out how many times IP has viewed current page
        $statement = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ? and IP = ?');
        $statement->execute([$page, $IP]);
        $userviewsonthispage = $statement->fetch(PDO::FETCH_NUM)[0];
        
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
        ?>
        <p>
            Your views on this page: <?= $userviewsonthispage ?>
            <br>Total views on this page: <?= $allviewsonthispage ?>
            <br>
            <br>Your views on all pages: <?= $userviewsonallpages ?>
            <br>Total views on all pages: <?= $allviewsonallpages ?>
        </p> 
        <?php
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