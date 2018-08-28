<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:46
 */

namespace App\Controllers;


use App\Core\Controller;

class YayinlarController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        Controller::View('yayinlar/yayinlar');
    }
}