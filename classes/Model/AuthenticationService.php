<?php

namespace Model;

class AuthenticationService {

    function register($username, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        save($username, $hash);
    }

    function login($username, $password) {
        $hash = loadHashByUsername($username);
        if (password_verify($password, $hash)) {
            //login
        } else {
            // failure
        }
    }
}

