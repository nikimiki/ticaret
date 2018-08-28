<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 17.05.2018
 * Time: 23:38
 */

namespace Routes;


use Helpers\Router\RouteCollection;

class Router
{
    public static $comerURL;

    public function __construct($url)
    {
        self::$comerURL = trim($url, '/');
    }

    public static function get($uri, $action = null)
    {
        return Router::addRouter('GET', $uri, $action);
    }

    public static function post($uri, $action)
    {
        return Router::addRouter('POST', $uri, $action);
    }

    public static function put($uri, $action)
    {
        return Router::addRouter('PUT', $uri, $action);
    }

    public static function delete($uri, $action)
    {
        return Router::addRouter('DELETE', $uri, $action);
    }

    public static function any($uri, $action)
    {
        return Router::addRouter('ANY', $uri, $action);
    }

    protected static function addRouter($method, $uri, $action)
    {
        return RouteCollection::add($method, $uri, $action);
    }
}