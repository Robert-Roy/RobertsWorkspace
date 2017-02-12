<div class="projectcontainer contentdiv">
    <h2><?= $this->title ?></h2>
    <div class="projectdescription">
        <?= $this->description ?>
    </div>
</div>
<div class="crispbutton"><a href=<?= $this->href ?>>See Project</a></div>
<?php
if ($this->githublink !== "") {
    ?>

    <div class="crispbutton"><a  href="<?= $this->githublink ?>">See Code</a>
        <?php
    }
    ?>
</div>