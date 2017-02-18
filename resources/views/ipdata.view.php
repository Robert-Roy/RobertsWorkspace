<?php include "partials/header.view.php"; ?>

<div class="contentdiv" style="text-align:center">
    <p>Your IP:<br><?= $IP ?></p>
</div>
<br>
<div class="contentdiv">
    <p>
        Country: <?= $country ?> (<?= $countryCode ?>)<br>
        Region: <?= $regionName ?> (<?= $region ?>)<br>
        City: <?= $city ?><br>
        Zip: <?= $zip ?><br>
        Coordinates: (<?= $lat ?>, <?= $lon ?>)<br>
        Time Zone: <?= $timezone ?><br>
        Internet Service Provider: <?= $isp ?><br>
        Organization: <?= $org ?><br>
        As Number/Name: <?= $as ?>
    </p>
</div>
<br>
<div class="contentdiv">
    <p>Powered by: <a href="http://ip-api.com/">ip-api.com</a></p>
</div>

<?php include "partials/footer.view.php"; ?>