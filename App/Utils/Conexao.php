<?php
namespace App\Utils;

use PDO;

class Conexao{

    private static $instance;

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new PDO(
            "mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8"
            ,USERNAME,PASSWORD);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        }
        return self::$instance;
    }
}