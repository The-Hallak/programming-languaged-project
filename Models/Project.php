<?php

class Project{
    public $id;
    public $name;
    public $description;
    public $teacherId;
    public $numberOfStudents;
    public $numberOfStudentsChoseProject;

    private $tableName="projects";
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    function showProjects(){
        $sql="SELECT P.project_id,name,description,full_name,number_of_student,remaining_number_of_student
        FROM {$this->tableName} as P
        INNER JOIN users 
        ON teacher_id = user_Id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }


}

?>