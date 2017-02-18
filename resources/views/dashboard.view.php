<?php include "partials/header.view.php"; ?>

<div class="contentdiv">
    You have viewed the following pages:
    <ul>
        <?php
        foreach ($pageViewData as $viewData) {
            echo "<li>" . $viewData["page"] . " (" . $viewData["userViews"] . "/" . $viewData["totalPageViews"] . " views)</li>";
        }
        ?>
    </ul>
    <p>You have a total of <?= $userTotalViews ?>/<?= $allUsersTotalViews ?> page views.</p>
</div>

<?php include "partials/footer.view.php"; ?>