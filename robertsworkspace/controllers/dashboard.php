<?php
$title = "Robert's Analytics";

$util = new util();
$conn = $util->getConn();
$IP = getUserIP();
$page = getPage();

$userTotalViews = 0;
$allUsersTotalViews = 0;

$pageViewData = [];

try {
    //Find out how many times IP has viewed current page
    $statement = $conn->prepare('SELECT DISTINCT PAGE FROM PageViews');
    $statement->execute();
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
        $pageViewData[] = ["page" => $currentPage,
            "userViews" => $userPageViews,
            "totalPageViews" => $totalPageViews
        ];
        $userTotalViews += $userPageViews;
        $allUsersTotalViews += $totalPageViews;
    }
} catch (Exception $ex) {
    handleerror("Error occurred on " .
            $page . " at " . $time . ". " . $ex->getmesage);
}

require $VIEWROOT . "dashboard.view.php";
?>