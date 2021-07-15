<?php
session_start();

if (isset($_GET["view"])) {
    require_once "app/view/" . $_GET["view"] . ".php";
} else if (isset($_GET["action"]) && isset($_GET["class"])) {
    $controller = $_GET["class"]."Controller";
    $action = $_GET["action"];
    require_once "app/controller/" . $controller . ".php";
    $controller = new $controller();
    $controller->$action();
} else if (isset($_SESSION["loggedUser"])) {
    require_once "app/view/dashboard.php";
} else {
    require_once "app/view/signIn.php";
}
