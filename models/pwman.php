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
        var_dump(Db::hasTable(self::PIECE_TABLE));

        if(!Db::hasTable(self::PIECE_TABLE)) {
            $_result = Db::query("CREATE TABLE ? (
                                      piece_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                      name VARCHAR(255) NOT NULL,
                                      status TINYINT(3) DEFAULT 0 COMMENT '0-disabled, 1-enabled'
                                 )", array("type"=>"s","value"=>self::PIECE_TABLE));
            if($_result->count) {
                Db::query("INSERT INTO ? (name, status) VALUES('pwman_ground', 1)", array("type"=>"s","value"=>self::PIECE_TABLE));
            }
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
     * @param $piece
     * @return $this
     */
    public function introduce($piece)
    {
        if(is_array($piece) && count($piece) && !empty($piece["name"])) {
            // check if installed
            $_params = array(
                array("type"=>"s","value"=>self::PIECE_TABLE),
                array("type"=>"s","value"=>$piece['name'])
            );
            $_result = Db::query("SELECT * FROM ? WHERE name = ?", $_params);

            echo "<br>".__LINE__;
            var_dump($_result);

            // install if not
            if (!$_result->error && !$_result->count) {
                $_result = Db::query("INSERT INTO ? (name, status) VALUES(?, 1)", $_params);
                echo "<br>".__LINE__;
                var_dump($_result);
            }
        }
        return $this;
    }
}
$PWGround = new PWMan_Ground;