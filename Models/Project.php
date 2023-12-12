<?php

class Project {
    public $id;
    public $name;
    public $description;
    public $teacherId;
    public $numberOfStudents;
    public $numberOfStudentsChoseProject;

    private $tableName = "projects";
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function showProjects() {
        try {
            $sql = "SELECT P.project_id,name,description,full_name,number_of_student,remaining_number_of_student
            FROM {$this->tableName} as P
            INNER JOIN users 
            ON teacher_id = user_Id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function getTeacherProjects() {
        try {
            $sql = "SELECT project_id,name FROM {$this->tableName} WHERE teacher_id={$this->teacherId}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function getProjectInfo() {
        try {
            $sql = "SELECT name,description,number_of_student FROM {$this->tableName} WHERE project_id={$this->id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function addProject() {
        try {
            $sql = "INSERT INTO {$this->tableName}
            (name,description,teacher_id,number_of_student,remaining_number_of_student) 
            VALUES('{$this->name}','{$this->description}','{$this->teacherId}','{$this->numberOfStudents}','{$this->numberOfStudents}')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function modifyProject() {
        try {
            $sql = "UPDATE {$this->tableName}
            SET name = '{$this->name}',description='{$this->description}'
            ,remaining_number_of_student = remaining_number_of_student + {$this->numberOfStudents} - number_of_student 
            ,number_of_student = '{$this->numberOfStudents}'
            WHERE project_id={$this->id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function addRemoveStudent($inc){
        try {
            $sql = "UPDATE {$this->tableName}
            SET  remaining_number_of_student=remaining_number_of_student {$inc}
            WHERE project_id={$this->id}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
