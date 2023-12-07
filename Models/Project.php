<?php

class Project{
    public $id;
    public $name;
    public $description;
    public $teacherId;
    public $numberOfStudents;
    public $numberOfStudentsChoseProject;

    private $table="projects";
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }


}

?>