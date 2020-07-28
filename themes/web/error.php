<?php $v->layout("_theme"); ?>
<article class="not_found">
    <div class="container content">
        <header class="not_found_header">
            <p class="error">&bull;<?= $error->code; ?>&bull;</p>
            <h1><?= $error->title; ?></h1>
            <p><?= $error->message; ?></p>

            <?php if ($error->link): ?>
                <a class="not_found_btn gradient gradient-green gradient-hover transition radius"
                   title="<?= $error->linkTitle; ?>" href="<?= $error->link; ?>"><?= $error->linkTitle; ?></a>
            <?php endif; ?>
        </header>
    </div>
</article><script async src="https://www.googletagmanager.com/gtag/js?id=UA-53658515-18"></script>
    <script src="<?= theme("/assets/scripts.js", CONF_VIEW_APP); ?>"></script>
<?= $v->section("scripts"); ?>