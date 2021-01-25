<?php
namespace Framework;

use Framework\App;

class Core {
  public static App $app;

  public static function start() {
    self::$app = new App();
  }
}
