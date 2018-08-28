<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:44
 */

namespace App\Controllers;


use App\Core\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        Controller::View('blog/blog');
    }
}