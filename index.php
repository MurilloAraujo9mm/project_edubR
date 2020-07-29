<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */

//auth
$route->group(null);
$route->get("/", "Web:login");
$route->post("/", "Web:login");

/** Register Create **/
$route->get("/cadastrar", "Web:register");
$route->post("/cadastrar", "Web:register");

/** Forget Location **/
$route->get("/forget", "Web:forget");
$route->post("/forget", "Web:forget");

/**
 * APP
 */
$route->group("/app");
$route->get("/", "App:home");

/** Profile **/
$route->get("/profile", "App:profile");
$route->post("/profile", "App:profile");

/** Logout **/
$route->get("/sair", "App:logout");

/** Location update **/
$route->get("/location", "App:location");
$route->post("/location", "App:location");
$route->get("/location/{id_local}", "App:location");
$route->post("/location/{id_local}", "App:location");

$route->post("/search", "App:search");
$route->get("/search", "App:search");





//END ADMIN
$route->namespace("Source\App");
/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();