<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
require_once "util.php";
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
        $statement = $conn->prepare('SELECT DISTINCT PAGE FROM PageViews');
        $statement->execute();
        ?>
        You have viewed the following pages:
        <ul>
            <?php
            $totalViews = 0;
            // show user views of ALL pages by getting all pages then showing all views
            foreach ($statement as $row) {
                $currentPage = $row['PAGE'];
                // get user's views on current page
                $userPageViewsStatement = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ? AND IP = ?');
                $userPageViewsStatement->execute([$currentPage, $IP]);
                $userPageViews = $userPageViewsStatement->fetch(PDO::FETCH_NUM)[0];
                // get all user's views on current page
                $totalPageViewsStatement = $conn->prepare('SELECT COUNT(*) FROM PageViews WHERE PAGE = ?');
                $totalPageViewsStatement->execute([$currentPage]);
                $totalPageViews = $totalPageViewsStatement->fetch(PDO::FETCH_NUM)[0];
                
                $userTotalViews += $userPageViews;
                $allUsersTotalViews += $totalPageViews;
                echo "<li>" . $currentPage . " (" . $userPageViews . "/" . $totalPageViews . " views)</li>";
            }
            ?>
        </ul>
        <p>You have a total of <?= $userTotalViews ?>/<?= $allUsersTotalViews ?> page views.</p>
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