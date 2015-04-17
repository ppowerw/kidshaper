<?php
namespace Model\Modules;

class PageFooter extends AbstractModule implements Imodule{
    
    private $ListModules = [
        'FooterMenu',
        'InfoBar'
    ];
    
    public function __construct() {
        
    }
    public function getIncludedModules(){
            return $this->ListModules;
    }
    
    public function getModuleData(){
        return null;
    }
    
    public function setModuleData(){
            return null;
    }
}