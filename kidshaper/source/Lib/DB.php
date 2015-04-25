<?php
namespace lib;

class DB {
    private static $instance = null;
    private $data = [];
    private $db;
    private $charset;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new DB ( );
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}
    
    private function getConnection() {
        if($this->db === null){
            $this->connect();
        }
    }

    private function connect() {
        $this->db = mysqli_connect(registry::DB_HOST, registry::DB_USER, registry::DB_PASS, registry::DB_NAME, registry::DB_PORT);
        $this->charset = mysqli_set_charset($this->db, 'UTF8');
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function getQuery() {
        // TBD Check input params
        $this->getConnection();
        $query = 'SELECT * FROM name_test';
        $result = mysqli_query($this->db, $query);
        // TBD Check result for errors
        $this->data = mysqli_fetch_object($result);
        return $this->data;
    }

    public function getData($table = '', $queryFields = '*') {
        $this->getConnection();
        if ($table === '') {
           return  'Table not set in: ' . __FUNCTION__;
        }
        $filter="";
        if ($filter === '') {
            $filter = '';
        } else {
            $filter = $this->setParamWhere($filter);
        }
        $query = 'SELECT ' . $queryFields . ' FROM ' . $table ;
        xdebug_var_dump($query);
        $result = mysqli_query($this->db, $query);
        //while ($row = mysqli_fetch_row($result)) {
        $i=1;
        while ($row = mysqli_fetch_assoc($result)){
            $this->data[$i++] = $row;
        }
        return $this->data;
    }
    
    public function setData($table, $fieldsArray) {
        $this->getConnection();
        if (is_array($fieldsArray)){
            foreach ($fieldsArray as $key => $values){
                $keysArray = array_push($key);
                $valuesArray = array_push($values);
            }
        }
        $keysArray = implode(',', $keysArray);
        $valuesArray = implode(',', $valuesArray);
        $query = 'INSERT INTO ' .$table. '(' .$keysArray. ') VALUES ' .  $valuesArray ;
        xdebug_var_dump($query);
        die();
        $result = mysqli_query($this->db, $query);
        //while ($row = mysqli_fetch_row($result)) {
        $i=1;
        while ($row = mysqli_fetch_assoc($result)){
            $this->data[$i++] = $row;
        }
        return $this->data;
    }

    // Set SQL-query params
    private function setParamWhere($filter) {
        if (is_array($filter)) {
            $val = '';
            foreach ($filter as $key => $value) {
                if ($val !== '') {
                    $val . " AND ";
                }
                $val .= ' WHERE ' . $key . '=' . $value . ' ';
            }
            return $val;
        } else {
            return '';
        }
    }

}
