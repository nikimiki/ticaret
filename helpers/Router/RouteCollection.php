<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 18.05.2018
 * Time: 02:07
 */

namespace Helpers\Router;


use Routes\Router;

class RouteCollection
{
    protected static $epxlode;
    protected static $actEnd;
    protected static $urlEnd;
    protected static $count = 0;


    protected static $intId = '';
    protected static $strAny = '';
    protected static $strTxt = '';
    protected static $urlCntrl;
    protected static $comUri;

    public static function add($method, $uri, $action) {
        self::$comUri = Router::$comerURL;
        if($_SERVER['REQUEST_METHOD'] === $method) {
            $reqURI = ltrim($uri, '/');

            if(array_filter(explode('/', Router::$comerURL)) == array_filter(explode('/', $reqURI))) {
                self::$count++;
                self::mainRouter($reqURI, $action);
                exit;
            }

            else {
                //uri 1 den buyukse
                if(self::countURL(Router::$comerURL) === TRUE) {
                    if(self::isDynamicUrl(Router::$comerURL, $reqURI) === TRUE) {
                        self::mainRouter($reqURI, $action);
                        exit;
                    }
                } else {
                    self::$epxlode = explode('/', $reqURI);
                    self::$actEnd = end(self::$epxlode);

                    if(self::$actEnd == "*" && explode('/', $reqURI)[0] == explode('/', Router::$comerURL)[0]) {
                        self::mainRouter($reqURI, $action);
                    }
                }

            }
        }

        return false;
    }

    private static function mainRouter($uri, $action) {
        if(is_object($action)) {
            call_user_func($action);
        }

        if(is_string($action)) {
            $controllerName = explode('@', $action)[0];
            $methodName = explode('@', $action)[1];

            $path = "App\\Controllers\\$controllerName";

            if(class_exists($path)) {
                call_user_func(array(new $path(), $methodName), explode('/', Router::$comerURL));
            }
        }
    }

    private static function isInt($url)
    {
        if(is_numeric($url)) {
            self::$intId = '{id}';
            return self::$intId;
        } else {
            return false;
        }
    }

    private static function isAny($url)
    {
        if(is_string($url) || is_numeric($url)) {
            self::$strAny = '{any}';
            return self::$strAny;
        } else {
            return false;
        }
    }

    private static function isString($url)
    {
        if(! is_numeric($url) && is_string($url)) {
            self::$strTxt = '{string}';
            return self::$strTxt;
        } else {
            return false;
        }
    }

    private static function countURL($url) {
        $exp = explode('/', $url);
        $count = count($exp);

        if($count >= 2) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private static function isDynamicUrl($comer, $requre) {
        $comExp = explode('/', $comer);
        $comCount = count($comExp);

        $reqURIExp = explode('/', $requre);
        $reqCount = count($reqURIExp);

        if($reqCount > 1 && $comCount > 1) {
            if($comExp[0] === $reqURIExp[0]) {

                if(self::isString($comExp[1]) === self::isString($reqURIExp[1])) {
                    return true;
                }
                elseif(self::isInt($comExp[1]) === self::isInt($reqURIExp[1])) {
                    return true;
                }
//                elseif(self::isAny($comExp[1]) === self::isAny($reqURIExp[1])) {
//                    echo 'hello';
//                    return true;
//                }
                else { Redirect::to(404); }
            }
            else { return false; }
        }
    }
}
