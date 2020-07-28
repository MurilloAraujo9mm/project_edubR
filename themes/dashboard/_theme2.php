<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2020-05-25T19:18:09-03:00+48759">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?= $head; ?>
    <link rel="stylesheet" href="<?= theme("/assets/css/reset.css"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/pack-de-icones/fonticon.css"); ?>"/>
</head>
<body>
<!--HEADER-->
<header class="main_header">
    <div class="container">
        <div class="main_menu_content_header">
            <div class="main_menu">
                <button class="icon-menu icon-notext menu_mobile"></button>
            </div>
            <h1 class="main_title">Fatec administration servers</h1>
            <div class="main_itens_header">
                <div class="profile icon-user-plus">
                    <a href=""><?= (user())->name() ;?></a>
                    <a href="<?= url("/app/sair"); ?>" class="icon-exit">Sair</a>
                </div>
                <div class="user_profile_final">

                </div>
            </div>
        </div>
    </div>
</header>
<div class="dash">
    <main class="container_section">
        <aside class="main_menu_aside">
            <div class="main_menu_aside_content">
                <ul class="main_menu_item_one">
                    <header class="photo_user">
                        <?php if (user()->photo()): ?>
                            <img class="rounded" alt="<?= user()->name; ?>" title="<?= user()->name; ?>"
                                 src="<?= image(user()->photo, 260, 260); ?>"/>
                        <?php else: ?>
                            <img class="rounded" alt="<?= user()->name; ?>" title="<?= user()->name; ?>"
                                 src="<?= theme("/assets/images/avatar.jpg", CONF_VIEW_APP); ?>"/>
                        <?php endif; ?>
                        <span><?= user()->name; ?></span>
                    </header>
                    <li class="icon-home"><a href="<?= url("/app"); ?>">Home</a></li>
                    <li class="icon-terminal"><a href="<?= url("app/desktop"); ?>">Gerencias máquinas</a></li>
                    <li class="icon-user-check"><a href="<?= url("/app/profile"); ?>">Gerenciar usuário</a></li>
                </ul>
            </div>
        </aside>
        <?= $v->section("content"); ?>
    </main>
</div>
</body>
</html>