<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\Cep;
use Example\Models\User;

$post = filter_input(INPUT_POST, "c", FILTER_SANITIZE_STRIPPED);

$cep = new Cep(["JSON"]);

if (!empty($post)){
    $response = $cep->cepFind($post)["result"];
}

?>

<form action="" method="post">
    <input type="text" name="c" placeholder="buscar CEP">

    <?php if (!empty($response)): ?>
        <input type="text" name="cep" value="<?= (!empty($response) ? $response["cep"] : ""); ?>">
        <input type="text" name="logradouro" value="<?= (!empty($response) ? $response["logradouro"] : ""); ?>">
        <input type="text" name="bairro" value="<?= (!empty($response) ? $response["bairro"] : ""); ?>">
    <?php endif; ?>

    <button>Buscar</button>

</form>
