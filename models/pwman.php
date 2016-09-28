<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 23:46
 */
class PWMan_Ground
{

    const PIECE_BOX_PATH = 'dynamics/pieces/';
    const PIECE_TABLE = 'pw_pieces';
    const LOG_FILE = 'dynamics/log/pwground.log';

    public function __construct()
    {
        $db = Db::getInstance();
        if(!Db::hasTable(self::PIECE_TABLE)) {
            $_statement = $db->prepare("CREATE TABLE :table 
                                      piece_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                      name VARCHAR(255) NOT NULL,
                                      status TINYINT(3) DEFAULT 0 COMMENT '0-disabled, 1-enabled'");
            $_statement->execute(array(":table"=>self::PIECE_TABLE));

            $_statement = $db->prepare("INSERT INTO :table (name, status) VALUES('pwman', 1)");
            $_statement->execute(array(":table"=>self::PIECE_TABLE));
        }
        return $this;
    }

    public function pwlog($object)
    {
        if(!empty($object->msg) && defined("PW_DEBUG") && PW_DEBUG) {
            $_logFile = fopen(self::LOG_FILE, "a");
            fwrite($_logFile, $object->msg.PHP_EOL);
            fclose($_logFile);
        }
        return $this;
    }


    /**
     * @param array $object
     * @return $this
     */
    public function introduce($object)
    {
        if(is_array($object) && count($object) && !empty($object["name"])) {
            $db = Db::getInstance();
            // check if installed
            $_statement = $db->query("SELECT * FROM :table WHERE `name` = ':name'");
            if (!($_result = $_statement->execute(array(":table" => self::PIECE_TABLE, ":name" => $object['name'])))) {
                $package = new stdClass();
                $package->msg = print_r($_statement->errorInfo(), true);
                $this->pwlog($package);
                return $this;
            }
            // install if not
            if (!$_result->fetchColumn()) {
                $_statement = $db->prepare("INSERT INTO :table (name, status) VALUES(':name', 1)");
                $_statement->execute(array(":table" => self::PIECE_TABLE, ":name" => $object['name']));
            }
        }
        return $this;
    }
}
$PWGround = new PWMan_Ground;