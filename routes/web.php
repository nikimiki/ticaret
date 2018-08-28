<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 18.05.2018
 * Time: 03:11
 */

use Routes\Router;


Router::get('/', 'HomeController@home');
Router::get('hakkimda', 'HakkimdaController@home');
Router::get('hastaliklar', 'HastaliklarController@home');
Router::get('hastaliklar/{string}', 'HastaliklarController@subPages');
Router::get('kalp-cerrahisi', 'KalpCerrahisiController@home');
Router::get('damar-cerrahisi', 'DamarCerrahisiController@home');
Router::get('dvt', 'DvtController@home');
Router::get('varis', 'VarisController@home');
Router::get('yayinlar', 'YayinlarController@home');
Router::get('blog', 'BlogController@home');
Router::get('iletisim', 'IletisimController@home');