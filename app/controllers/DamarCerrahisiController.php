<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:51
 */

namespace App\Controllers;


use App\Core\Controller;

class DamarCerrahisiController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        Controller::View('damarcerrahisi/damar');
    }
}