<?php

namespace Model\Modules;

class Head extends AbstractModule implements Imodule {

    private $ListModules = [
        //'Meta'
    ];

    public function __construct() {
        
    }

    public function getIncludedModules() {
        \Utils\Log::getLog()->debug('HEAD model loaded');
        $this->getModuleData();
        
        return $this->ListModules;
    }

    public function getModuleData() {
        $page = \View\Page::getInstance();
        $page->addData($this->getCSSLink());
        $page->outputData();
        return null;
    }

    public function setModuleData() {
        return null;
    }
    
    public function setCSSLink($link){
       // not implemented 
       
    }
    
    public function getCSSLink() {
        $CSSLinks = [
            'template/cpanel/css/main.css'
        ];
        $linkList ='';
        foreach ($CSSLinks as $value) {
            $linkList .= '<br id="ff"><link rel="stylesheet" href="'.$value.'">'; 
        }
        
        return $linkList;
    }
    
}
