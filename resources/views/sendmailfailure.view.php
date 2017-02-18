<?php include "partials/header.view.php"; ?>

<div class="contentdiv">
    <p>Your message was not for the following reasons:
        <br><br>
        <?= $strInvalidReasons ?>
        <br>
        <a href="<?= $CONTACT ?>">Please try again</a>.
    </p>
</div>

<?php include "partials/footer.view.php"; ?>