<?php $v->layout("_theme"); ?>
<div class="app_formbox">

    <form class="app_form" action="<?= url("/app/profile"); ?>" method="post">
        <input type="hidden" name="update" value="true"/>
        <div class="app_formbox_photo">
            <img class="profile_img rounded" src="<?= $photo; ?>">
            <div>
                <input data-image=".j_profile_image" type="file" class="radius"  name="photo"/>
            </div>
        </div>
        <div class="label_group">
            <label>
                <span class="field icon-user">Nome:</span>
                <input class="radius" type="text" placeholder="Name" name="name"  value="<?= $user->name; ?>">
            </label>

            <label>
                <span class="field icon-user">Email:</span>
                <input class="radius" type="email" placeholder="Email" name="mail" value="<?= $user->mail; ?>">
            </label>

            <label>
                <span class="field icon-key">Password:</span>
                <input class="radius" type="password" placeholder="Senha" name="password" value="">
            </label>

            <label>
                <span class="field icon-key">Password:</span>
                <input class="radius"  placeholder="Senha" type="password" name="password" value="">
            </label>
        </div>
        <div class="al-center">
            <div class="app_formbox_actions">
                <button  class="btn btn-green btn-big btn_inline radius transition icon-database">Atualizar</button>
            </div>
        </div>
    </form>
</div>
