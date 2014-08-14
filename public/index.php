<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../bootstrap/Autoloader.php");

//require_once '../model/BlogService.php';
//$blogService = new BlogService(require '../config/db_config.php');

require_once '../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('../views/');

use App\TwigEscapingGuesser as TwigEscapingGuesser;
use App\Router as Router;
use App\Request as HTTPRequest;


$twig   = new Twig_Environment($loader, array(
    'autoescape' => array(new TwigEscapingGuesser(), 'guess'),
));

$action = null;
$action = isset ($_REQUEST['action']) ? $_REQUEST['action'] : null;
$routes = array('index', 'login', 'login_success', 'logout', 'blog_post');


$params = HTTPRequest::getParams();

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