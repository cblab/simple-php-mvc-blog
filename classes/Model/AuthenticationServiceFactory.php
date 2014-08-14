<?php
namespace Model;

class AuthenticationServiceFactory {

    public static function create() {
        if (self::checkVersion()) {
            return new AuthenticationService();
        } else {
            return new CompatibilityAuthenticationService();
        }
}


    private static function checkVersion() {
        if (version_compare(phpversion(), '5.5.0', '>')) {
            // php version isn't high enough
            return 0;
        } else {
            return 1;
        }
    }
}
