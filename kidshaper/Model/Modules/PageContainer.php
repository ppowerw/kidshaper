<?php

namespace Model\Modules;

class PageContainer extends abstractModule implements Imodule {

    private $ListModules = [
        //'Greating'
    ];

    public function __construct() {
        
    }

    public function getIncludedModules() {
        return $this->ListModules;
    }

    public function getModuleData() {
        return null;
    }

    public function setModuleData() {
        return null;
    }

}
