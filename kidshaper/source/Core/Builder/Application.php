<?php

namespace Core\Builder;

class Application {

    private $session; // For all session params
    private $controller; // For current controllers
    private $route; // For all routing controllers and actions
    private $page; // For current page

    public function __construct() {
        $this->initApplication();
    }

    private function initApplication() {
        $this->session = \Lib\Session::getInstance(); // Init session
        $this->route = \Core\Route::getInstance(); // Init route
        $curController = "\Controller\\" . $this->route->getController(); // Set controller
        $this->controller = new $curController;
        $this->controller->doAction();
    }

}
