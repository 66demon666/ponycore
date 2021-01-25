<?php
namespace Framework\interfaces;

/**
 *
 */
interface RouteInterface
{
  // code...
  public function check(string $method, string $url):int;
}
