<?php
namespace Framework\web\routing;

use Framework\interfaces\RouterInterface;
use Framework\web\routing\Dispatcher;


class Router implements RouterInterface{

  public function __construct() {
  }

  public function route() {
    Dispatcher::addRoute('POST,GET', '/test-route', function(){
      echo 'post, get method';
    });

    $dispatchResult = Dispatcher::dispatch();
    switch ($dispatchResult['status']) {
      case Dispatcher::NOT_FOUND:
        echo "error 404";
        break;
      case Dispatcher::METHOD_NOT_ALLOWED:
        echo "method not allowed";
        break;
      case Dispatcher::FOUND:
        echo "Found:<br>";
        call_user_func($dispatchResult['route']->callback);
        break;
    }
  }
}
