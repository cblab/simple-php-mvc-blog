<?php
namespace App;

class Router {

    protected $twig   = null;
    protected $params = null;

    public function __construct($params, $twig) {
        $this->params = $params;
        $this->twig   = $twig;
    }

    public function index(){
        echo $this->twig->render('index.twig');
    }

    public function login(){
        echo $this->twig->render('login.twig');
    }

    public function login_success() {
        echo $this->twig->render('login_success.twig');
    }

    public function logout(){
        echo $this->twig->render('logout.twig');
    }

    public function blog_post(){
        echo $this->twig->render('blog_post.twig');
    }
}
