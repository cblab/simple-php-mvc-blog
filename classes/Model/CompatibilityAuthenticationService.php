<?php
namespace Model;

class CompatibilityAuthenticationService implements AuthenticationServiceInterface {

    protected $bcrypt   = null;
    protected $database = null;

    public function __construct(PDO $database) {
        $this->database = $database;
        $this->$bcrypt = new Bcrypt(15);
    }

    public function register($username, $password) {
        $hash = $this->bcrypt->hash($password);
        save($username, $hash);
    }

    public function login($username, $password) {
        $hash = loadHashByUsername($username);

        if ($this->bcrypt->verify($password, $hash)) {
            //login
        } else {
            // failure
        }
    }

}