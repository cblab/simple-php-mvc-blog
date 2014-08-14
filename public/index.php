<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../model/BlogService.php';
//$blogService = new BlogService(require '../config/db_config.php');

require_once '../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('../views/');
$twig   = new Twig_Environment($loader, array(
    'autoescape' => array(new TwigEscapingGuesser(), 'guess'),
));

$action = null;
$action = isset ($_REQUEST['action']) ? $_REQUEST['action'] : null;
$routes = array('index', 'login', 'login_success', 'logout', 'blog_post');

if (isset($action) && in_array($action, $routes)) {
    try {
        Router::$action(BlogHTTPRequest::getParams(), $twig);
    } catch (RuntimeException $e){
        echo "An Exception occured: " . $e->getMessage();
    }
} else {
    Router::index(BlogHTTPRequest::getParams(), $twig);
}

class Router {
    public static function index($params, $twig){
        echo $twig->render('index.twig');
    }

    public static function login($params, $twig){
        echo $twig->render('login.twig');
    }

    public static function login_success($params , $twig) {
            echo $twig->render('login_success.twig');
    }

    public static function logout($params , $twig){
        echo $twig->render('logout.twig');
    }

    public static function blog_post($params , $twig){
        echo $twig->render('blog_post.twig');
    }
}


class BlogHTTPRequest {
    public static function getParams() {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
          case 'PUT':
            throw new HttpRequestMethodException('HTTP-Method not supported');
            break;
          case 'POST':
            return $_POST;
            break;
          case 'GET':
            return $_GET;
            break;
          case 'HEAD':
              throw new HttpRequestMethodException('HTTP-Method not supported');
            break;
          case 'DELETE':
              throw new HttpRequestMethodException('HTTP-Method not supported');
            break;
          case 'OPTIONS':
              throw new HttpRequestMethodException('HTTP-Method not supported');
            break;
          default:
              throw new HttpRequestMethodException('HTTP-Method not supported');
            break;
        }
    }
}

class TwigEscapingGuesser
{
    function guess($filename)
    {
        // get the format
        $format = substr($filename, strrpos($filename, '.') + 1);

        switch ($format) {
            case 'js':
                return 'js';
            case 'css':
                return 'css';
            case 'html':
            default:
                return 'html';
        }
    }
}