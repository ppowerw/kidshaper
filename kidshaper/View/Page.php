<?php

namespace View;

class Page {

    private static $instance = null;
    private $outputBuffer = '';

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Page ( );
        }
        return self::$instance;
    }

    private function __clone() {
        
    }

    private function __construct() {
        ob_start();
    }

    public function addDebugInfo($param) {
        $dbgDIV = '<div>' . $param .'<div>';
        $this->outputBuffer = $dbgDIV . $this->outputBuffer;
    }

    public function addData($data) {
        $this->outputBuffer .= $data;
    }

    public function outputData() {
        \Utils\Log::getLog()->getDebugInfo();
        ob_flush();
    }

    public function loadTemplate($link, $varList = array()) { //link to html template
        ob_start();
        include($link);
        $template = ob_get_clean();
        foreach ($varList as $key => $value) {
            $template = str_replace("{{" . $key . "}}", $value, $template);
        }
        echo $template . "";
        ob_flush();
    }

    public function loadModuleView($moduleName, $varList = array()) {
        ob_start();
        include($moduleName);
        $template = ob_get_clean();
        foreach ($varList as $key => $value) {
            $template = str_replace("{{" . $key . "}}", $value, $template);
        }
        echo $template . "";
        ob_flush();
    }

}
