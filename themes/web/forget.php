<?php $v->insert("_theme"); ?>
<div class="box">
    <article class="box_article_content">
        <div class="box_article_content_container">
            <header>
                <h1>Recuperar senha</h1>
            </header>
            <form action="<?= url("/forget") ?>" class="box_article_content_container_form" method="POST" enctype="multipart/form-data">
                <div class="ajax_response"><?= flash(); ?></div>
                <?= csrf_input(); ?>
                <input type="mail" name="mail" value="" placeholder="Email">
                <button class="form_btn icon-forward">Recuperar</button>
                <a href="<?= url("/"); ?>">Fazer login</a>
            </form>
        </div>
    </article>
</div>

