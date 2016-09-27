<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:17
 */
class Db
{

    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if( !isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=robkantor1', 'pwmanager', 'Ch33s3cak3', $pdo_options);
        }
        return self::$instance;
    }

}