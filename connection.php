<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:17
 */
class Db
{

    private static $_instance = NULL;
    private static $_tables;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            try {
                self::$_instance = new PDO('mysql:host=217.174.253.159;dbname=robkantor1', 'pwmanuser', 'Ch33s3cak3', $pdo_options);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$_instance;
    }

    public static function hasTable( $tableName = NULL )
    {
        echo "table: " . $tableName;
        if (!empty($tableName)) {
            if (empty(self::$_tables)) {
                $db = self::getInstance();
                $_tables = $db->prepare("SHOW TABLES LIKE ':table'");
                $_tables->execute(array(":table" => $tableName));
                self::$_tables = $_tables;
                $_tables->errorInfo();
                $_tables->debugDumpParams();
            }
            echo "CC: " . self::$_tables->columnCount();
            self::$_tables->fetchAll();
            if (self::$_tables->columnCount())
                return true;
        }
        return false;
    }

}