<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <? foreach($this->people  as $user) { ?>
        <div class="contenttitle">
            <h1><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h1>
            <p>

                <?= $user->getBody() ?>
            </p>
        </div>
        <? } ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>