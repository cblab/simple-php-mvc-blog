<?php
namespace Model;

/**
 * Interface AuthenticationInterface
 * @package Model
 */
interface AuthenticationInterface {
    public function createPasswordHash($password);
    public function verify($password, $hash);
}