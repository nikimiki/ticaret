<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 18.05.2018
 * Time: 03:15
 */

namespace App\Core;


use Database\DB;

class Controller
{
    public $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function View($view, $datas = null)
    {
        $data = $datas;

        return view($view, compact('data'));
    }
}