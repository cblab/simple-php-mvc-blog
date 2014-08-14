<?php

namespace Model;

class Authentication implements AuthenticationInterface {

    /**
     * create password hash
     *
     * @param $password
     * @return bool|string
     */
    public function createPasswordHash($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * compare password with hash
     *
     * @param $password
     * @param $hash
     * @return bool
     */
    public function verify($password, $hash) {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}

