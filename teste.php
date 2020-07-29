<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\Cep;

$post = filter_input(INPUT_POST, "c", FILTER_SANITIZE_STRIPPED);

$cep = new Cep(["JSON"]);

if ($post){
    $response = $cep->cepFind($post)["result"];
}
$response = $cep->cepFind($post)["result"];

?>

<form action="" method="post">
    <input type="text" name="c" placeholder="buscar CEP">

    <?php if ($response): ?>

        <input type="text" name="cep" value="<?= $response["cep"] ?>">
        <input type="text" name="logradouro" value="<?= $response["logradouro"] ?>">
        <input type="text" name="bairro" value="<?= $response["bairro"] ?>">

    <?php endif; ?>

    <button>Buscar</button>

</form>
