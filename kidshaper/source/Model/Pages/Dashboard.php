<?php

namespace Model\Pages;

class Dashboard extends AbstractPage implements Ipage {

    private $listModules = [
        'Head',
        'PageHeader',
        'PageContainer'];
    /* ,
      'Content',
      'Footer'
      ]; */
    public $pageModules = [];

    public function __construct() {
        
    }

    public function buildPage() {
        $this->listModules = $this->initModules($this->listModules);
        var_dump('$this->pageModules: ', $this->pageModules);
        var_dump($this->getListModules());

        // loading template
        $this->pageTemplate = $this->loadModuleTemplate($this->listModules);
        $this->pageHTML = $this->loadDataToTemplate();

        var_dump('$this->pageModules: ', $this->pageModules);
        var_dump($this->getListModules());
        var_dump('$this->pageTemplate:', $this->pageTemplate);
        var_dump('$this->pageHTML:', $this->pageHTML);
        return 1;
    }

    private function initModules($currentModuleList) {
        foreach ($currentModuleList as $value) {
            $path = '\model\modules\\' . $value;
            $this->pageModules['value'] = new $path;
            if ($value == 'PageHeader') {
                array_push($this->listModules, $this->pageModules['value']->initModule());
            }
        }
        return $this->listModules;
    }

    public function getListModules() {
        return $this->listModules;
    }

    private function loadModuleTemplate($varList) {
        $template ='';
        $link = '\template\cpanel\html\modules\\';
        foreach ($varList as $value) {
            if (is_array($value)) {
                $template = $this->loadModuleTemplate($value);
            } else {
                ob_start();
                include($link . $value . '.html');
                $template = ob_get_clean();
            }
        }
        ob_flush();
        return $template;
    }

    private function loadDataToTemplate() {
        $template = '<h4>This HTML template</h4>';
        return $template;
    }

}
