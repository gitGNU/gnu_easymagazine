<?php include("sidebar.php");?>

<div id="content">

<div class="post">

    <h1><?= $this->person->getName() ?></h1>

    <? foreach($this->articles  as $article) { ?>

    <h2>
        <? echo '<a href="'.URIMaker::article($article).'"> '.$article->getTitle()." </a>"; ?>
    </h2>

    <div class="date"><small><?= $article->getCreatedFormatted() ?></small> by
            <?
        foreach ($article->users() as $user) {
             echo $user->getName().' ';
        }
        ?>
    </div>

    <div class="entry">

         <? if ($article->imageExists()) { ?>
        <img src="<?= URIMaker::fromBasePath($article->imagePath()) ?>" width="100" align="left">
         <? } ?>

        <?= $article->getSummary() ?>

    </div>

    <p class="date">
        <? echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
    </p>

    <? } ?>

    <p>
        <?= $this->paginator->renderFullNav(URIMaker::articlesperson($this->person))  ?>
    </p>

</div>