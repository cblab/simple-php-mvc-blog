<?php

namespace Model;

class AuthenticationService implements AuthenticationServiceInterface {

    protected $database;

    public function __construct(PDO $database) {
        $this->database = $database;
    }

    public function register($username, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        save($username, $hash);
    }

    public function login($username, $password) {
        $hash = loadHashByUsername($username);
        if (password_verify($password, $hash)) {
            //login
        } else {
            // failure
        }
    }
}

