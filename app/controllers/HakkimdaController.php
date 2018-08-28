<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:27
 */

namespace App\Controllers;


use App\Core\Controller;

class HakkimdaController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        $data['title'] = "Yrd. Doç. Dr. Mustafa Özer ULUKAN Kimdir ?";

        Controller::View('hakkimda/hakkimda', $data);
    }
}