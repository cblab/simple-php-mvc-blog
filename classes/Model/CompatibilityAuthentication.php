<?php
namespace Model;

class CompatibilityAuthentication implements AuthenticationInterface {

    protected $bcrypt   = null;

    public function __construct() {
        $this->$bcrypt = new \Security\Bcrypt(15);
    }

    /**
     * create password hash - use custom bcrypt class
     *
     * @param $password
     * @return bool|string
     */
    public function createPasswordHash($password) {
       return $this->bcrypt->hash($password);
    }

    /**
     * compare password with hash
     *
     * @param $password
     * @param $hash
     * @return bool
     */
    public function verify($password, $hash) {
        if ($this->bcrypt->verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

}