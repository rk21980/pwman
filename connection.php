<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:17
 */
class Db
{

    private static $_tables;

    private function __construct() {}

    private function __clone() {}

    public static function query( $query, $data = NULL )
    {
        $result = new stdClass();
        $result->count = 0;
        $result->error = NULL;
        $result->rows = NULL;

        $db = new mysqli('217.174.253.159', 'pwmanuser', 'Ch33s3cak3', 'robkantor1');
        if ($_error = $db->connect_errno) {
            $result->error = $db->connect_error;
            return $result;
        }

        $_stmt = $db->stmt_init();
        if($_error = !$_stmt->prepare($query)){
            $result->error = $_error;
            return $result;
        }
        if(is_array($data)) {
            $_paramTypes = "";
            $_paramValues = [];
            foreach($data as $_param) {
                if(!(empty($_param['type']) || empty($_param['value']))) {
                    $_paramTypes .= (string)$_param['type'];
                    $_paramValues[] = mysqli_real_escape_string($db, $_param['value']);
                }
            }
            $_stmt->bind_param($_paramTypes, implode(",", $_paramValues));
        }
        $_stmt->execute();
        $result->count = $_stmt->affected_rows;
        $result->rows = $_stmt->get_result();
        $_stmt->close();
        $db->close();
        return $result;

    }

    public static function hasTable( $tableName = NULL )
    {
        echo "table: " . $tableName;
        if (!empty($tableName)) {
            if (empty(self::$_tables)) {
                self::$_tables = self::query("SHOW TABLES LIKE ?", array(array("type"=>"s","value"=>$tableName)));
                print_r(self::$_tables);
            }
            echo "CC: " . self::$_tables->count;
            if (self::$_tables->count)
                return true;
        }
        return false;
    }

}