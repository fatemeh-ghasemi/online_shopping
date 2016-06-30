<?php

class Db {

    static private $db;

    private function __construct() {
        
    }

    /**
     * 
     * @return MyMySqli
     */
    static function get() {
        if (self::$db === NULL) {
            self::$db = new MyMySqli("localhost", "root", "", "shopping");
            self ::$db->query("SET NAMES 'utf8'");
        }
            return self::$db;
    }

}
