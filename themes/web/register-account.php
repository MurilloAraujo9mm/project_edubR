<?php $v->insert("_theme"); ?>
<div class="box">
    <article class="box_article_content">
        <div class="box_article_content_container">
            <header>
                <h1>Cadastre-se</h1>
            </header>
            <form action="<?= url("/cadastrar") ?>" class="box_article_content_container_form" method="POST" enctype="multipart/form-data">
                <div class="ajax_response"><?= flash(); ?></div>
                <?= csrf_input(); ?>
                <input type="name" name="name"  placeholder="Name">
                <input type="mail" name="mail"  placeholder="Email">
                <input type="password" name="password"  placeholder="Senha">
                <button class="form_btn icon-info recovery">
                    Cadastrar
                </button>
            </form>
            <p>Já tem uma conta? <a title="Fazer login!" href="<?= url("/"); ?>">Fazer login!</a></p>
        </div>
    </article>
</div>

