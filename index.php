<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 17.05.2018
 * Time: 23:22
 */

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/bootstraps/config.php';
require_once __DIR__.'/bootstraps/needle.php';

use Routes\Router;

new Router(@$_GET['url']);
require_once __DIR__.'/routes/web.php';
