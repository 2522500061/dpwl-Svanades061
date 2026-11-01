<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';

$url = $_GET['url'] ?? $route['default_controller'] . '/index';
if ($url == '') {
    $url = $route['default_controller']. '/index';
}

$url = trim($url, '/');
$segment = explode('/', $url);

// CEK APAKAH SEGMENT PERTAMA ADALAH FOLDER
if (isset($segment[0]) && strtolower($segment[0]) == 'c_master') {
    // URL = c_master/Mobil_C/index
    $folder = $segment[0]; // c_master
    $controller = $segment[1] ?? $route['default_controller'];
    $method = $segment[2] ?? 'index';
    $parameter = $segment[3] ?? null;

    $controllerName = $controller; // Jangan di ucfirst, biar Mobil_C tetap Mobil_C
    $controllerFile = 'controller/'.$folder.'/'.$controllerName.'.php';
} else {
    // URL = Mobil_C/index
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = $segment[2] ?? null;

    $controllerName = ucfirst($controller);
    // Coba cek 2 lokasi: di root controller dan di dalam c_master
    if (file_exists('controller/'.$controllerName.'.php')) {
        $controllerFile = 'controller/'.$controllerName.'.php';
    } else {
        $controllerFile = 'controller/c_master/'.$controllerName.'.php';
    }
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $objController = new $controllerName();
    if (method_exists($objController, $method)) {
        if ($parameter !== null) {
            $objController->$method($parameter);
        } else {
            $objController->$method();
        }
    } else {
        echo "Method $method tidak ditemukan di $controllerName.";
    }
} else {
    echo "Controller tidak ditemukan: $controllerFile";
}
?>