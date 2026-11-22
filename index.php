<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
if (!defined('BASEURL')) define('BASEURL', $config['base_url']);
require_once 'helper/url_helper.php';

$url = $_GET['url'] ?? '';
if ($url == '') {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = dirname($_SERVER['SCRIPT_NAME']);
    if ($base != '/' && $base != '\\' && strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base));
    }
    $url = trim($uri, '/');
    if ($url == '' || $url == 'index.php') $url = $route['default_controller'].'/index';
}
$url = trim($url, '/');
$segment = explode('/', $url);

if (isset($segment[0]) && is_dir('controller/'.$segment[0])) {
    $folder = $segment[0];
    $controller = $segment[1] ?? $route['default_controller'];
    $method = $segment[2] ?? 'index';
    $parameter = isset($segment[3]) ? urldecode($segment[3]) : null;
    $controllerName = $controller;
    $controllerFile = 'controller/'.$folder.'/'.$controllerName.'.php';
} else {
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = isset($segment[2]) ? urldecode($segment[2]) : null;
    $controllerName = ucfirst($controller);
    $controllerFile = 'controller/'.$controllerName.'.php';
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $obj = new $controllerName();
    if (method_exists($obj, $method)) {
        if ($parameter !== null) $obj->$method($parameter);
        else $obj->$method();
    } else echo "Method $method tidak ditemukan";
} else echo "Controller tidak ditemukan: $controllerFile";
?>