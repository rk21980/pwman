<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 23:46
 */
abstract class PWMan_Treasure_Chest {
    /**
     * @param array $object
     * @return $this
     */
    public function isInstalled($object = []) {
        if(is_array($object) && count($object)) {

        }
        return $this;
    }
}