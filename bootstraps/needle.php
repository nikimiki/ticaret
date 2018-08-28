<?php
/**
 * Created by PhpStorm.
 * User: Mehmet
 * Date: 17.05.2018
 * Time: 23:36
 */

if(! function_exists('view')) {
    /**
     * @param string $file
     * @param array $vars
     * @return mixed
     */
    function view($file, $data = []) {
        extract($data);

        $folderName = explode('/', $file)[0];
        @$fileName = explode('/', $file)[1];

        $path = "resources/views";
        $type = ".view.php";

        if(! isset($fileName) && empty($fileName)) {
            notFound();
        } else {
            include_once $path . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR . $fileName . $type;
        }
    }
}

if(! function_exists('test')) {
    function test($path) {
        echo '<pre>';
        print_r($path);
        echo '</pre>';
    }
}

if(! function_exists('escape')) {
    function escape($string) {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}

if(! function_exists('notFound')) {
    function notFound() {
        $path = "resources/views";
        $folder = "404";
        include  $path . DIRECTORY_SEPARATOR . $folder. DIRECTORY_SEPARATOR . "index.html";
    }
}

function topButtons()
{
    $db = \Database\DB::getInstance();
    $pages = $db->query("SELECT * FROM page");
    return $pages->results();
}

function menu($kategori, $ust_id = null)
{
    echo "<ul>";
    foreach($kategori as $liste) {
        if($liste['ust_id'] == $ust_id) {
            echo "<li>{$liste['ad']}";
            menu($kategori, $liste['id']);
            echo "</li>";
        }
    }
    echo "</ul>";
}