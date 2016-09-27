<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:17
 */
echo __FILE__;
class Db
{

    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if( !isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;db=robkanto1', 'pwmananger', 'Ch33s3cak3', $pdo_options);
        }
        return self::$instance;
    }

}