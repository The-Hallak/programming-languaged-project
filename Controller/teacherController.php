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
        echo json_encode(["status" => "failed", "msg" => $e->getMessage()]);
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
        echo json_encode(["status" => "failed", "msg" => $e->getMessage()]);
    }
}

if (isset($_POST["show_teacher_projects"])) {
    getTeacherProjects();
}
if (isset($_POST["get_project_info"])) {
    getProjectInfo();
}