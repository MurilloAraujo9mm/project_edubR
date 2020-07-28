<?php $v->insert("_theme"); ?>
<div class="box">
    <article class="box_article_content">
        <div class="box_article_content_container">
            <header>
                <h1>Faça o login</h1>
            </header>
            <form action="<?= url("/") ?>" class="box_article_content_container_form" method="POST" enctype="multipart/form-data">
                <div class="ajax_response"><?= flash(); ?></div>
                <?= csrf_input(); ?>
                <input type="mail" name="mail" value="" placeholder="Email">
                <input type="password" name="password" value="" placeholder="Senha">

                <button class="form_btn icon-user">Entrar</button>
                <a class="recovery" href="<?= url("/forget") ?>" title="">Recuperar minha senha</a>
                <a class="recovery" href="<?= url("/cadastrar") ?>">Cadastrar</a>
            </form>
        </div>
    </article>
</div>
