<?php

class Person{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    private $tableName="users";
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    function login(){
        $sql ="SELECT role,password FROM {$this->tableName} WHERE user_id={$this->id}";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}

?>