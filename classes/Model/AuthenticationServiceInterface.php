<?php
namespace Model;

interface AuthenticationServiceInterface {
    public function register($username, $password);
    public function login($username, $password);
}