<?php

namespace Core\Builder;

class Page {

    private $templateLink = BASE . '/template/cpanel/';
    private $templatePagePath = BASE . '/template/cpanel/html/pages/';
    private $pageList = [
        'dashboard',
        'siteStructure',
        'dataEditor'
    ];
    // old vars
    private $pageContent;
    private $result;
    private $module;
    private $moduleList;
    private $moduleCount = 0;

    public function __construct() {
        
    }

    public function initPage($name) {
        ob_start();
        include $this->templatePagePath . $name . '.html';
        $this->pageContent = ob_get_clean();
        ob_clean();
        $this->pageContent = $this->findModules($this->pageContent);
    }

    private function findModules($str) {
        $strOut = preg_replace_callback('|({{)(.*)(}})|', function ($name) {
            $this->initModule($name[2]);
        }
                , $str);
        \Utils\Log::getLog()->debug($this->moduleList, 'Module list');

    }

    private function initModule($name) {
        $modName = str_replace('module:', '', $name);
        $modStr = 'model\module\\' . $modName;
        try {
            $this->module[$this->moduleCount] = new $modStr;
            $this->moduleList[] = '<br>ModuleList: ' . $modStr;
        } catch (Exception $ex) {
            echo '<hr>Can\'t find module: ' . $ex;
        }
        $this->moduleCount++;
    }

}
