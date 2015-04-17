<?php
namespace View;

class Module {
    private $outputData;
    private $path;

    private function __clone() {
        
    }

    private function __construct() {
    }

    public function setModule($name, $varList = array()) {
        $this->path = \Core\Route::templatePath;
        $this->loadHTMLTemplate($name, $varList);
    }
    
    public function getModule(){
        if ($this->outputData === null){
            return '<h4>Module [' .__CLASS__. '] output data is empty</h4>';
        }
        return $this->outputData;
    }
    
    private function loadHTMLTemplate($name, $varList) {
        ob_start();
        include($this->path . $name. '.html');
        $output = ob_get_clean();
        $this->outputData = $this->parseModuleParams($output,$varList);
        ob_flush();
    }
    
    private function parseModuleParams($output,$varList){
        foreach ($varList as $key => $value) {
            $data = str_replace("{{" . $key . "}}", $value, $output);
        }
        return $data;
    }
    

}
