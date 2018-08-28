<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 17.05.2018
 * Time: 23:36
 */

define('BASE_ROOT', 'http://localhost:8888/ozerulukan/');
define('APP_ROOT', __DIR__);
define('HEADER', 'resources/templates/header.php');
define('FOOTER', 'resources/templates/footer.php');
define('FOOTER_BIG', 'resources/templates/footer-big.php');
define('TOP_MENU', 'resources/templates/top-menu.php');
define('MOBILE_MENU', 'resources/templates/mobile-menu.php');
define('FOOTER_MENU', 'resources/templates/footer-menu.php');
define('SLIDER', 'resources/templates/slider.php');
define('EBULTEN', 'resources/templates/ebulten.php');
define('CONTACT_FORMS', 'resources/templates/contact-forms.php');

date_default_timezone_set('Europe/Istanbul');
date_default_timezone_get();


$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'db' => 'ozerulukan'
    )
);

/**
 *
 * gonder şimdi
 */

error_reporting(E_ALL); // Error engine - always ON!

ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

ini_set('log_errors', TRUE); // Error logging

ini_set('error_log', 'logs.txt'); // Logging file

ini_set('log_errors_max_len', 1024); // Logging file size