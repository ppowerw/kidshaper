<?php

namespace Model\Modules;

class MainMenu extends AbstractModule implements Imodule {

    private $listModules = [];
    private $menuTree = [
        'dashboard',
        'dataEditor',
        'siteStructure'
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

    public function getIncludedModules() {
        \Utils\Log::getLog()->debug('Mainmenu model loaded');
        return $this->listModules;
    }

    public function getModuleData() {
        $data = [
            'menuTree' => $this->menuTree
        ];
        return $data;
    }

    public function setModuleData() {
        return null;
    }

    public function getView($data) {
        $path = '\View\\Module\\' . __CLASS__;
        var_dump('$path:' . $path);
        return $data;
    }

}
