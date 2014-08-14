<?php
namespace Model;

class AuthenticationFactory {
    /**
     * Create authentification class
     *
     * @return AuthenticationService|CompatibilityAuthentication
     */
    public static function create() {
        if (self::checkVersion()) {
            return new Authentication();
        } else {
            return new CompatibilityAuthentication();
        }
    }

    /**
     * Check php version
     *
     * @return int
     */
    private static function checkVersion() {
        if (version_compare(phpversion(), '5.5.0', '>')) {
            // php version isn't high enough
            return 1;
        } else {
            return 0;
        }
    }
}
