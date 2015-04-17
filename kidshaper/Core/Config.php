<?php

namespace Core;

class Config {

    private static $instance = null;
    private $data = [];

    public static function init() {
        if (is_null(self::$instance)) {
            self::$instance = new config();
        }
        return self::$instance;
    }

    private function __clone() {
        
    }

    private function __construct() {
        $this->setParams();
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        if (is_null(self::$instance)) {
            echo 'CFG NOT SET';
        }
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    private function setParams() {
        $data = parse_ini_file("config.ini", 0);
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

}
