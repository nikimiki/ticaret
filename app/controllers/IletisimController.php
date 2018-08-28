<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:39
 */

namespace App\Controllers;


use App\Core\Controller;

class IletisimController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        $data['title'] = "İletişim";

        Controller::View('iletisim/iletisim', $data);
    }
}