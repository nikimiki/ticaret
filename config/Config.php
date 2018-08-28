<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 20.08.2018
 * Time: 23:13
 */

namespace Config;


class Config
{
    public static function get($path = null) {
        if($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach($path as $bit) {
                if(isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}