<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:49
 */

namespace App\Controllers;


use App\Core\Controller;

class DvtController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        Controller::View('dvt/dvt');
    }
}