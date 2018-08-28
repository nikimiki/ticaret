<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 25.05.2018
 * Time: 16:31
 */

namespace App\Controllers;


use App\Core\Controller;
use App\Models\HastaliklarModel;
use Helpers\Router\Redirect;

class HastaliklarController extends Controller
{
    public $db;
    public $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new HastaliklarModel();
    }

    public function home()
    {
        Controller::View('hastaliklar/hastaliklar');
    }

    public function subPages($id)
    {
        $makale = $this->model->getMakale($id[1]);

        $data['title'] = $makale->first()->article_name." - Hastalıklar";
        $data['makale'] = $makale->first();

        if($makale->count() > 0) {
            Controller::View("hastaliklar/sub-page", $data);
        } else {
            Redirect::to(404);
        }
    }
}