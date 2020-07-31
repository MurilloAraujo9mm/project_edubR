<?php $v->layout("_theme"); ?>
<div class="container_section_section_one">
    <section class="imagem_section_content">
        <header class="server_content">
            <h1 class="icon-home">Locais</h1>
        </header>
        <table class="table_server">
            <tr>
                <th class="icon-location">Nome</th>
                <th class="icon-hour-glass">data</th>
                <th class="icon-hour-glass">UF</th>
                <th class="icon-heart">Editar</th>
            </tr>
            <?php if (!empty($local)): ?>
                <?php foreach ($local as $locais): ?>

                    <?php if ($locais->uf == "MG"): ?>
                        <tr class="color-setup-mg">
                            <td class="color-setup-mg"><?= $locais->nome; ?></td>
                            <td class="color-setup-mg"><?= date("d/m/Y", strtotime($locais->data)); ?></td>
                            <td class="color-setup-mg"><?= $locais->uf; ?></td>
                            <form action="<?= url("/app/location/{$locais->id_local}") ?>" method="post">
                                <input type="hidden" name="action" value="update"/>
                                <td><a href="<?= url("/app/location/{$locais->id_local}"); ?>" class="btn btn-yellow transition radius icon-home3">Gerenciar</a></td>
                            </form>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><?= $locais->nome; ?></td>
                            <td><?= date_fmt($locais->data, "d/m/Y"); ?></td>
                            <td><?= $locais->uf; ?></td>
                            <form action="<?= url("/app/location/{$locais->id_local}") ?>" method="post">
                                <input type="hidden" name="action" value="update"/>
                                <td><a href="<?= url("/app/location/{$locais->id_local}"); ?>" class="btn btn-yellow transition radius icon-home3">Gerenciar</a></td>
                            </form>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php else: ?>
                <p class="no_users">Desculpe! Ainda não existem locais disponíveis</p>
            <?php endif; ?>
        </table>
        <a class="btn required-color required-color-text icon-database radius"href="<?= url("/app/location"); ?>">Criar novo local</a>
    </section>
</div>
</body>
</html>