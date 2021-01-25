<?php
namespace Framework;

use Framework\web\routing\Router;

class App {

  protected Router $router;

  public function __construct() {
      $this->router = new Router();
      echo $this->router->route();
  }
}
