<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";
use Jarouche\ViaCEP\HelperViaCep;

//tipos permitidos
//$array_tipos =['Querty','Piped','JSON','JSONP','XML'];
//
//
//// testando todos os tipos de requisição
//foreach ($array_tipos as $tipo){
//    //helper retorna da dados do cep através dos parâmetros tipo e cep
//    $class_cep = HelperViaCep::getBuscaViaCEP($tipo,'03983020');
//    var_dump($class_cep);
//}
//
//
////Utilizando via Classe
//$class = new Jarouche\ViaCEP\BuscaViaCEPJSONP();
///*como é JSONP, existe a opção de setar o nome da callback function,
// * ESTÁ OPÇÃO ESTÁ SOMENTE DISPONÍVEL SE UTILIZAR A CLASSE Jarouche\ViaCEP\BuscaViaCEPJSONP();
// */
//$class->setCallbackFunction('teste_teste');
//
////Faz o retorno do CEP
//$result = $class->retornaCEP('01311300');
//echo $class->retornaConteudoRequisicao();
//print_r($result);

use Source\Models\Cep;

$cep = new Cep(['JSON']);

$cep->cepFind('03983020');

foreach ($cep->cepFind('03983020') as $item) {
    var_dump($item);
}
///**
// * BOOTSTRAP
// */
//
//use CoffeeCode\Router\Router;
//use Source\Core\Session;
//
//$session = new Session();
//$route = new Router(url(), ":");
//$route->namespace("Source\App");
//
///**
// * WEB ROUTES
// */
//
////auth
//$route->group(null);
//$route->get("/", "Web:login");
//$route->post("/", "Web:login");
//
///** Register Create **/
//$route->get("/cadastrar", "Web:register");
//$route->post("/cadastrar", "Web:register");
//
///** Forget Location **/
//$route->get("/forget", "Web:forget");
//$route->post("/forget", "Web:forget");
//
///**
// * APP
// */
//$route->group("/app");
//$route->get("/", "App:home");
//
///** Profile **/
//$route->get("/profile", "App:profile");
//$route->post("/profile", "App:profile");
//
///** Logout **/
//$route->get("/sair", "App:logout");
//
///** Location update **/
//$route->get("/location", "App:location");
//$route->post("/location", "App:location");
//$route->get("/location/{id_local}", "App:location");
//$route->post("/location/{id_local}", "App:location");
//
//
//
//
//
//
//
////END ADMIN
//$route->namespace("Source\App");
///**
// * ERROR ROUTES
// */
//$route->group("/ops");
//$route->get("/{errcode}", "Web:error");
//
///**
// * ROUTE
// */
//$route->dispatch();
//
///**
// * ERROR REDIRECT
// */
//if ($route->error()) {
//    $route->redirect("/ops/{$route->error()}");
//}
//
//ob_end_flush();