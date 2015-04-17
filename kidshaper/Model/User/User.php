<?php
namespace Model\User;

class User {
    private $id = 0; // user ID
    private $profile = array(
        'email' => '', //user email
        'phone' => '375123', //user contact phone
        'name' => 'somebody' //user contact phone
        );
        
    public function __construct(){
        $this->setProperty(1);
    }

    private function setProperty($id){
        $this->id = $id;
        $this->email = "example@com.com";
    }
    
    public function  getProperty(){
        return $this->profile;
    }
    
    public function createUser($profile = '') {
        echo 'empty module' . $profile;
        return 0;
    }
}
