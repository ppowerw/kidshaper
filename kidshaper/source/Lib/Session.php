<?php
namespace Lib;
// Class for Initialization or restore session based on cookies without PHP_SESSION

class Session {
    private static $instance = null;
    //Cookie params:
    private $puid; //Session ID //$puid = \Lib\initSession::getInstance()->getGlobal('puid', 'COOKIE');
    private $cookieExpire = 86400; // Time for cookie expiring in seconds 
    private $cookieDomain = '/'; // Domain avialable for cookie

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new session();
        }
        return self::$instance;
    }

    private function __clone() {
        
    }

    private function __construct() {
        $this->checkSession();
    }

    protected function checkSession() {
        $this->puid = $this->getGlobal('puid', 'COOKIE');
        if ($this->puid === '') {
            $this->setSession();
        } else {
            $this->setCookie('puid', $this->puid);
        }
        return $this->puid;
    }

    public function setSession() {
        $this->puid = md5(uniqid(rand(), 1)); //Generate unique string for puid
        $this->setcookie('puid', $this->puid);
    }

    public function setCookie($name, $value, $time = 0) {
        if ($time == 0) {
            $time = $this->cookieExpire;
        }
        $r = setcookie($name, $value, time() + $time, $this->cookieDomain);
        return $r;
    }

    public function getGlobal($name, $type = 'GET') {
        // Acceptable types: GET, POST, COOKIE, SERVER
        if (!isset($this->_globVars[$name])) {
            switch ($type) :
                case 'GET': $inType = INPUT_GET;
                    break;
                case 'POST': $inType = INPUT_POST;
                    break;
                case 'COOKIE': $inType = INPUT_COOKIE;
                    break;
                case 'SERVER': $inType = INPUT_SERVER;
                    break;
                default: $inType = INPUT_GET;
                    break;
            endswitch;
            $this->_globVars[$name] = strtolower((string) filter_input($inType, $name, FILTER_SANITIZE_ENCODED));
        }
        return $this->_globVars[$name];
    }
}

/*
      $this->_globVars['HTTP_HOST'] = strtolower((string) filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL));
      $this->_globVars['HTTP_REFERER'] = strtolower((string) filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL));
      $this->_globVars['REQUEST_URI'] = strtolower((string) filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));
      $this->_globVars['QUERY_STRING'] = strtolower((string) filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_URL));
     */

    /*
      public function setSessionOld() {
      session_set_cookie_params($this->cookieExpire);
      ini_set('session.cookie_httponly', 1);
      $this->sessionName = ini_set('session.name', 'puid');
      if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
      $this->puid = md5(uniqid(rand(), 1));
      $this->setcookie('puid', $this->puid);
      }
      }
     */
