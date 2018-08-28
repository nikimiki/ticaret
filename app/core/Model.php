<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 27.08.2018
 * Time: 01:34
 */

namespace App\Core;


use Database\DB;

class Model
{
    public $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}