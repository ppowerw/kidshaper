<?php
namespace Model\Modules;

class PageHeader extends AbstractModule implements Imodule{
    
    private $listModules = [
        'Mainmenu'
        //'Logon'
    ];
    
    public function __construct() {
        
    }
    
    public function initModule() {
        foreach ($this->listModules as $value) {
            $path = '\model\modules\\' . $value;
            $this->pageModules['value'] = new $path;
            array_push($this->listModules, $this->pageModules['value']->initModule());
        }
        return $this->listModules;
    }
    
    public function getIncludedModules(){
            return $this->listModules;
    }
    
    public function getModuleData(){
        return null;
    }
    
    public function setModuleData(){
            return null;
    }
}