<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

//initialisierung (autoload, container, globale funktionen, routing table)
require_once __DIR__."/init.php";
//look for pathinfo
$path_info = $_SERVER['PATH_INFO'] ?? '';
$script = $_SERVER['SCRIPT_NAME'];
//start building the page(s)
require_once __DIR__."/views/views_parts/page_parts_head.php";

if (isset($routes[$path_info])) {

    $route = $routes[$path_info];
    $controller = $container->create($route['controller']);
    $method = $route['method'];
    $controller->$method();

}else if(isset($links[$path_info])){

    $link = $links[$path_info];
    include_once __DIR__. $link;

}else{
    
    include_once __DIR__."/views/page_main_welcome.php";
}
//nav wird nach main eingebunden, wegen Problemen mit header()  :(
include_once __DIR__."/views/views_parts/page_parts_nav.php";
include_once __DIR__."/views/views_parts/page_parts_foot.php";