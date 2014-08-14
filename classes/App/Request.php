<?php
namespace App;

class Request {
    public static function getParams() {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
          case 'PUT':
            throw new \HttpRuntimeException('HTTP-Method not supported');
            break;
          case 'POST':
            return $_POST;
            break;
          case 'GET':
            return $_GET;
            break;
          case 'HEAD':
              throw new \HttpRuntimeException('HTTP-Method not supported');
            break;
          case 'DELETE':
              throw new \HttpRuntimeException('HTTP-Method not supported');
            break;
          case 'OPTIONS':
              throw new \HttpRuntimeException('HTTP-Method not supported');
            break;
          default:
              throw new \HttpRuntimeException('HTTP-Method not supported');
            break;
        }
    }
}