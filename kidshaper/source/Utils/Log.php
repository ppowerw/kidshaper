<?php

namespace Utils;

class Log {

    private static $instance = null;
    private static $dbgInfo = '';
    private static $logArr = '';

    private function __clone() {
        
    }

    private function __construct() {
        
    }

    public static function getLog() {
        if (is_null(self::$instance)) {
            self::$instance = new Log();
        }
        return self::$instance;
    }

    public function debug($info, $label = '') {
        if (DEBUG_STATE === 0) {
            return 0;
        }
        if (is_array($info)) {
            xdebug_var_dump($info);
            $info = $this->parseArray($info);
        }
        if ($label !== '') {
            $label . ': ';
        }
        self::$dbgInfo .= '<h6>' . $label . ': ' . $info . '</h6>' . PHP_EOL;
        return 0;
    }

    public function getDebugInfo() {
        echo self::$dbgInfo;
        return 0;
    }

    public function errorLog($info, $label) {
        if (is_array($info)) {
            $row = print_r($info);
        } elseif (is_string($info)) {
            $row = $info;
        }
        if ($label !== '') {
            $label . ': ';
        }
        $logStr = gmDate("Y-m-d H:i:s") . ' - ' . $label . $row . PHP_EOL;
        error_log($logStr, 4, "/logpath/php_err.log");
        return 0;
    }

    private function parseArray($data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                self::$logArr .= "YUY";
                $this->parseArray($value);
            }
            self::$logArr .= "[" . $key . "]: " . $value . "; ..." . PHP_EOL;
        }
        return self::$logArr;
    }

}
