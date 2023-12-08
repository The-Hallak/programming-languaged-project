<?php

class Person {
    public $id;
    public $name;
    public $email;
    public $password;
    public $projectId;
    public $role;

    private $tableName = "users";
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function login() {
        try {
            $sql = "SELECT role,password FROM {$this->tableName} WHERE user_id={$this->id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function addUser() {
        try {
            $sql = "INSERT INTO {$this->tableName}(full_name,email,password,role) VALUES('{$this->name}','{$this->email}','{$this->password}','{$this->role}')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function getStudentsNames() {
        try {
            $sql = "SELECT full_name FROM {$this->tableName} WHERE project_id={$this->projectId}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
