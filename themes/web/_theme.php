<link rel="stylesheet" href="<?= theme("/assets/css/style.css"); ?>"/>
<link rel="stylesheet" href="<?= theme("/pack-de-icones/fonticon.css"); ?>"/>
<link rel="stylesheet" href="<?= theme("/assets/css/login.css"); ?>"/>
<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53658515-18"></script>
<script src="<?= theme( DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR ."scripts.js", CONF_VIEW_THEME); ?>"></script>
<?= $v->section("scripts"); ?>
