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
            try {
                //self::$instance = new PDO('mysql:host=127.0.0.1;dbname=robkantor1', 'pwmanager@localhost', 'Ch33s3cak3', $pdo_options);
                self::$instance = mysqli_connect( "localhost", "pwmanager", 'Ch33s3cak3');
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$instance;
    }

}