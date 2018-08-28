<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 23.08.2018
 * Time: 15:49
 */

namespace Helpers\Router;


class Redirect
{
    public static function redirect()
    {

    }

    public static function to($path = null)
    {
        if($path) {
            if(is_numeric($path)) {
                switch($path) {
                    case 200:
                        break;
                    case 301:
                        break;
                    case 302:
                        break;
                    case 303:
                        break;
                    case 305:
                        break;
                    case 401:
                        break;
                    case 403:
                        break;
                    case 404:
                        @header('HTTP/1.0 404 Not Found');
                        include_once 'resources/views/404/index.html';
                        break;
                    case 500:
                        break;
                }
            }
        }

        return false;
    }

    public static function back()
    {

    }
}