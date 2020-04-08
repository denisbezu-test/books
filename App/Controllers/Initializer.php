<?php


namespace App\Controllers;


use App\DbInitializer;
use Core\Controller;

class Initializer extends Controller
{
    public function indexAction()
    {
        $dbInitializer = new DbInitializer();
        $dbInitializer->initDb();
        die('Db initialized');
    }
}