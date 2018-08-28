<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 18.05.2018
 * Time: 03:14
 */

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        $data['title'] = "Yrd.Doç.Dr. Mustafa Özer ULUKAN";

        Controller::View('index/index', $data);
    }
}