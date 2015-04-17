<?php
namespace Core;

use \Lib\Session as Session;

class Route {

    private static $instance = null;
    private $session;
    private $path;
    private $pathArray;
    private $actionArray; 
    private $controller = '';
    private $SEOQuery = [];

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new route ( );
        }
        return self::$instance;
    }

    private function __clone() {
        
    }

    public function __construct() {
        $this->pathArray = $this->parseUrl(); // Uri array without GET params
        $this->controller = $this->defineController($this->path); // Defined Controller name        
        $this->actionArray = array_slice($this->pathArray, 2);
    }
    
    private function parseUrl(){
        $this->session = Session::getInstance();
        $urlParse = parse_url($this->session->getGlobal('REQUEST_URI', 'SERVER'));
        $url = $urlParse['path'];
        if(strpos($url, "%3f")){
            $this->path = substr($url, 0, strpos($url, "%3f"));
            echo PHP_EOL, "seoQuery: " , substr($url, strpos($url, "%3f")) . PHP_EOL;
            $this->SEOQuery = $this->parseSEOQuery(substr($url, strpos($url, "%3f")+3));
        }else{
            $this->path = $url;
        }
        echo 'Path:';
        var_dump($this->path);
        $arr = explode("%2f", substr($this->path,0,250));
        if (isset($arr[1])){
            return $arr;
        }else{
            return ['','index.html'];
        }
    }

    private function defineController() {
        $intController = $this->pathArray[1];
        if ($intController === 'index.html' || $intController === 'index.php') {
            return "cPanel";
        } else {
            $controllerList = [
                'api', //as Default controller
                'content'
            ];
            foreach ($controllerList as $value) {
                if ($intController === strtolower($value)) {
                    return $value;
                }

                return 'cPanel'; //$controllerList[1]; //Default controller 'classname'
            }
        }
    }

    public function getController() {
        return $this->controller;
    }
    
    public function getActionArray() {
        return $this->actionArray;
    }
    
    private function parseSEOQuery($str){
        $arrStr = explode("%26", $str); //%26  %3d
        foreach ($arrStr as $value) {
            $param = explode("%3d", $value);
            $arr[$param[0]] = $param[1];
        }
        \Utils\Log::getLog()->debug($arr);
        return $arr;
    }

    public function getSEOQuery() {
        return $this->SEOQuery;
    }

    public function _errorPage404() {
//$host = 'http://' . $this->globVars['HTTP_HOST'];
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
//header('Location:' . $host . '4.04'); //Needbuild output page 404
        echo ('<html><head><title>' . SITENAME . ' - Page not found</title></head><h3>404 Page not found </h3></head>');
    }

}
