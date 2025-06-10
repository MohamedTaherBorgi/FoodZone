<?php
/*session_start();

require_once '../app/controllers/HomeController.php';
$controller = new HomeController();
$controller->index();*/
session_start();

$controllerName = $_GET['controller'] ?? 'plat';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
$categorie_id = $_GET['categorie_id'] ?? null;

require_once "../app/controllers/{$controllerName}Controller.php";

$controllerClass = ucfirst($controllerName) . 'Controller';
$controller = new $controllerClass();

if ($id) {
    $controller->$action($id);
} elseif ($categorie_id) {
    $controller->$action($categorie_id);
} else {
    $controller->$action();
}
