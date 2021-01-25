<?php
namespace Framework\web\routing;

use Framework\interfaces\DispatcherInterface;
use Framework\web\routing\Route;

class Dispatcher implements DispatcherInterface {

  protected static array $routes = array();

  const NOT_FOUND = 0;
  const FOUND = 1;
  const METHOD_NOT_ALLOWED = 2;

  public static function addRoute(string $methods, string $pattern, \Closure $callback):void {
    array_push(self::$routes, new Route($methods, $pattern, $callback));
  }

  public static function dispatch():array {
    foreach(self::$routes as $route) {
      switch($route->check($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])) {
        case self::NOT_FOUND:
          $response = array('status' => self::NOT_FOUND);
          break;
        case self::METHOD_NOT_ALLOWED:
          $response = array('status' => self::METHOD_NOT_ALLOWED);
          break;
        case self::FOUND: 
          $response = array('status' => self::FOUND, 'route' => $route);
          return $response;
          break;
      };
    }   
    return $response;
  }
}
