<?php

namespace Controller;

// Main class for admin.panel
class CPanel extends Controller {

    private $route;
    private $pageName;
    private $action;
    private $model;
    private $user;

    public function __construct() {
        parent::__construct();
        $this->route = \Core\Route::getInstance();
        $this->initController();
    }

    private function initController() {
        $this->initAction();
        //$this->getUser();
        //$this->checkRole();
    }

    private function getUser() {
        $this->user = new \Model\User\User;
        print_r($this->user->getProperty());
        echo "<hr>";
    }

    private function checkRole() {
        // not implemented
    }

    private function initAction() {
        $this->action = 'get';
        $page = $this->route->getActionArray();
        if (!isset($page[0])) {
            $this->pageName = 'dashboard';
            $this->object = 'page';
        } else {
            switch (strtolower($page[0])) {
                case 'siteStructure':
                    $this->pageName = 'siteStructure';
                    break;
                case 'dataeditor':
                    $this->pageName = 'dataEditor';
                    break;
                default:
                    $this->pageName = 'dashboard';
                    break;
            }
        }
    }

    public function getAction() {
        $params = array(
            'action' => $this->action,
            'object' => 'page',
            'pageName' => $this->pageName
        );
        return $params;
    }

    public function doAction() {
        // now static Page
        $this->model = new \Model\Pages\Dashboard();
        $this->model->buildPage();
    }

}
