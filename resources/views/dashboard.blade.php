@include("partials.header")

<div class="contentdiv">
    You have viewed the following pages:<br>
    <ul>
        <?php
        foreach ($pageViewData as $viewData) {
            echo "<li>" . $viewData["page"] . " (" . $viewData["userViews"] . "/" . $viewData["totalPageViews"] . " views)</li>";
        }
        ?>
    </ul>
    <p>You have a total of <?= $userTotalViews ?>/<?= $allUsersTotalViews ?> page views.</p>
</div>