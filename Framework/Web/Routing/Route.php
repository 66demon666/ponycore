<?php

namespace Framework\web\routing;

use Framework\interfaces\RouteInterface;

class Route implements RouteInterface {

    public array $methods = array();
    public string $pattern;
    public \Closure $callback;

    public function __construct(string $methods, string $pattern, \Closure $callback) {
        $this->methods = explode(',', $methods);
        $this->pattern = $pattern;
        $this->callback = $callback;
    }

    public function check(string $method, string $url):int {
        preg_match_all('|^' . $this->pattern . '$|', $url, $route_matches);
        if (!empty($route_matches[0])) {
            if (in_array($method, $this->methods)) {
                return Dispatcher::FOUND;
            }
            else {
                return Dispatcher::METHOD_NOT_ALLOWED;
            }
        }
        return Dispatcher::NOT_FOUND;
    }
}