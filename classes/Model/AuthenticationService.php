<?php

namespace Model;

class AuthenticationService {
    protected $database;

    public function __construct($database) {
        $this->database = $database;
    }

    /**
     * verify password against hash
     *
     * @param $user_login user login
     * @param $user_pass  user pass
     *
     * @return bool
     */
    public function verify($user_login, $user_pass) {
        $hash           = $this->loadHashByUsername($user_login);
        $authentication = AuthenticationFactory::create();

        return $authentication->verify($user_pass, $hash);
    }

    /**
     * @param $user_login user login
     *
     * @return mixed
     * @throws \Exception
     */
    public function loadHashByUsername($user_login) {
        $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt = $this->database->prepare("SELECT user_pass FROM blog_users where user_login = ?");

        if ($stmt->execute(array($user_login))) {
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            $error = $stmt->errorInfo();
            throw new \Exception("SQLSTATE: {$error[0]}. {$error[1]} {$error[2]}");
        }

        return $result['user_pass'];
    }

    /**
     * create new user
     *
     * @param $user_login
     * @param $user_pass
     *
     * @throws \Exception database exception
     */
    public function createUser($user_login, $user_pass) {
        $authentication = AuthenticationFactory::create();
        $hash           = $authentication->createPasswordHash($user_pass);

        $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt = $this->database->prepare("INSERT INTO blog_users (user_login, user_pass) VALUES (:user_login, :user_pass)");

        try {
            $stmt->execute(array(':user_login' => $user_login,
                                 ':user_pass'  => $hash)
                           );

        } catch (\Exception $e) {
            $error = $stmt->errorInfo();
            throw new \Exception("SQLSTATE: {$error[0]}. {$error[1]} {$error[2]}");
        }
    }
}
