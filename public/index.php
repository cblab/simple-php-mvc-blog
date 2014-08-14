<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../bootstrap/Autoloader.php');
require_once '../vendor/autoload.php';

//require_once '../Model/BlogService.php';
//$blogService = new BlogService(require '../config/db_config.php');

$loader = new Twig_Loader_Filesystem('../views/');

use App\TwigEscapingGuesser as TwigEscapingGuesser;
use App\Router as Router;
use App\RequestMethod as RequestMethod;

$twig = new Twig_Environment($loader, array(
    'autoescape' => array(new TwigEscapingGuesser(), 'guess'),
));

$action = null;
$action = isset ($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $params = $_GET;
} else {
    throw new RuntimeException('HTTP Method not allowed');
}

$routes = array('index', 'login', 'login_success', 'logout', 'blog_post');

if (isset($action) && in_array($action, $routes)) {
    try {
        $router = new Router($params, $twig);
        $router->$action;
    } catch (RuntimeException $e){
        echo "An Exception occured: " . $e->getMessage();
    }
} else {
    $router = new Router($params, $twig);
    $router->index();
}