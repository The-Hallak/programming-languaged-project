<?php

include "../Config/DataBase.php";
include "../Models/Project.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $conn;
$dataBase = new DataBase();
$conn = $dataBase->connect();

function getTeacherProjects() {
    try {
        global $conn;
        $teacherId = $_SESSION["user_id"];
        $project = new Project($conn);
        $project->teacherId = $teacherId;
        $response = $project->getTeacherProjects();
        $result = [];
        while ($row = $response->fetch(PDO::FETCH_ASSOC)) {
            $result[$row["project_id"]] = $row["name"];
        }
        echo json_encode(["status" => "success", "projects" => $result]);
    } catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => "getTeacherProjects".$e->getMessage()]);
    }
}

function getProjectInfo() {
    try {
        global $conn;
        $project=new Project($conn);
        $project->id=$_POST["project_id"];
        $response=$project->getProjectInfo();
        $result=$response->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["status"=>"success","info"=>$result]);
    } catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => "getProjectInfo".$e->getMessage()]);
    }
}

function addProject(){
    try{
        global $conn;
        $project=new Project($conn);
        $project->name=$_POST["name"];
        $project->description=$_POST["description"];
        $project->teacherId=$_SESSION["user_id"];
        $project->numberOfStudents=$_POST["number_students"];
        $project->addProject();
        echo json_encode(["status"=>"success"]);
    }catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => "addProject".$e->getMessage()]);
    }
}

function modifyProject(){
    try{
        global $conn;
        $project=new Project($conn);
        $project->name=$_POST["name"];
        $project->description=$_POST["description"];
        $project->id=$_POST["existing_projects"];
        $project->numberOfStudents=$_POST["number_students"];
        $project->modifyProject();
        echo json_encode(["status"=>"success"]);
    }catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => "modifyProject".$e->getMessage()]);
    }
}

if (isset($_POST["show_teacher_projects"])) {
    getTeacherProjects();
}
if (isset($_POST["get_project_info"])) {
    getProjectInfo();
}
if(isset($_POST["add_project"])){
    addProject();
}
if(isset($_POST["modify_project"])){
    modifyProject();
}