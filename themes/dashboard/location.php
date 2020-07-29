<?php $v->layout("_theme"); ?>
<div class="app_formbox">
    <?php if (!$local): ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Novo local</h2>
        </header>
        <header class="dash_content_app_header">
            <h2 class="icon-user">Buscar cep</h2>

           
                <form action="<?= url("/app/location"); ?>" class="app_search_form jquery_search">
                    <input type="text" name="search" placeholder="Buscar cep">
                    <input type="hidden" name="cepSearch" value="true">
                    <button class="btn btn-green transition radius icon-search icon-notext"></button>
                </form>
           

        </header>

        <div class="app_formbox">
            <form class="app_form" action="<?= url("/app/location"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="create" value="true"/>
                <div class="label_group">

                    <label>
                        <span class="field icon-user">Nome:</span>
                        <input class="radius" type="text" placeholder="Name" name="nome" value="<?= "" ?>">
                    </label>

                    <label>
                        <span class="field icon-user">Cep:</span>
                        <input class="radius" type="text" placeholder="Cep" name="cep">
                    </label>

                    <label>
                        <span class="field icon-key">logradouro:</span>
                        <input class="radius" type="text" placeholder="logradouro" name="logradouro"">
                    </label>

                    <label>
                        <span class="field icon-key">Complemento:</span>
                        <input class="radius" placeholder="complemento" type="text" name="complemento">
                    </label>

                    <label>
                        <span class="field icon-key">Número:</span>
                        <input class="radius" placeholder="Número" type="text" min="1" name="numero"">
                    </label>

                    <label>
                        <span class="field icon-key">Bairro:</span>
                        <input class="radius" placeholder="Bairro" type="text" name="bairro">
                    </label>

                    <label>
                        <span class="field icon-key">UF:</span>
                        <input class="radius" placeholder="UF" type="text" name="uf">
                    </label>

                    <label>
                        <span class="field icon-key">Cidade:</span>
                        <input class="radius" placeholder="UF" type="text" name="cidade"">
                    </label>
                </div>
                <div class="app_form_footer">
                    <button class="btn btn-green icon-check">Criar localização</button>
                </div>
            </form>
        </div>

    <?php else: ?>
        <form class="app_form" action="<?= url("/app/location/{$local->id_local}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="update" value="true"/>
            <div class="label_group">

                <label>
                    <span class="field icon-user">Nome:</span>
                    <input class="radius" type="text" placeholder="Name" name="nome" value="<?= $local->nome ?>">
                </label>

                <label>
                    <span class="field icon-user">Cep:</span>
                    <input class="radius" type="text" placeholder="Cep" name="cep" value="<?= $local->cep ?>">
                </label>

                <label>
                    <span class="field icon-key">logradouro:</span>
                    <input class="radius" type="text" placeholder="logradouro" name="logradouro"
                           value="<?= $local->logradouro ?>">
                </label>

                <label>
                    <span class="field icon-key">Complemento:</span>
                    <input class="radius" placeholder="complemento" type="text" name="complemento"
                           value="<?= $local->complemento ?>">
                </label>

                <label>
                    <span class="field icon-key">Número:</span>
                    <input class="radius" placeholder="Número" type="text" name="numero" value="<?= $local->numero ?>">
                </label>

                <label>
                    <span class="field icon-key">Bairro:</span>
                    <input class="radius" placeholder="Bairro" type="text" name="bairro" value="<?= $local->bairro ?>">
                </label>

                <label>
                    <span class="field icon-key">UF:</span>
                    <input class="radius" placeholder="UF" type="text" name="uf" value="<?= $local->uf ?>">
                </label>

                <label>
                    <span class="field icon-key">Cidade:</span>
                    <input class="radius" placeholder="UF" type="text" name="cidade" value="<?= $local->cidade ?>">
                </label>
            </div>
            <div class="app_form_footer">
                <button class="btn btn-blue icon-check-square-o">Atualizar</button>
            </div>
        </form>

        <form class="app_form" action="<?= url("/app/location/{$local->id_local}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="delete" value="true"/>

            <div class="app_form_footer">
                <button class="btn btn-red icon-check-square-o">excluir</button>
            </div>
        </form>
    <?php endif; ?>
</div>

</div>

