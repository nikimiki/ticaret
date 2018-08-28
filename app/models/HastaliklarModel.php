<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 27.08.2018
 * Time: 01:42
 */

namespace App\Models;


use App\Core\Model;

class HastaliklarModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMakale($id)
    {
        $makale = $this->db->get('article', array('article_link', '=', $id));
        return $makale;
    }
}