<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:52
 */

namespace App\Controllers;


use App\Core\Controller;

class KalpCerrahisiController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        Controller::View('kalpcerrahisi/kalp');
    }
}