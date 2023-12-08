<?php
include "../Config/DataBase.php";
include "../Models/Person.php";
include "../Models/Project.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $conn;
$dataBase = new DataBase();
$conn=$dataBase->connect();

function login() {
    global $conn;
    $id = $_POST["userId"];
    $password = $_POST["password"];

    $person = new Person($conn);

    $person->id = $id;
    $resault = $person->login();
    if ($resault->rowCount() == 0) {
        echo json_encode([
            "status" => "failed",
            "reason" => "no user was found with this id"
        ]);
        exit;
    }
    $resault = $resault->fetch(PDO::FETCH_ASSOC);



    if (!password_verify($password, $resault["password"])) {
        echo json_encode([
            "status" => "failed",
            "reason" => "wrong passowrd"
        ]);
        exit;
    }

    $_SESSION["userId"] = $id;

    echo json_encode([
        "status" => "success",
        "role" => $resault["role"],
    ]);
    exit;
}

function getStudentsNames($projectId) {
    global $conn;
    try{
        $person=new Person($conn);
        $person->projectId=$projectId;
        $respons=$person->getStudentsNames();
        $resault="";
        while($row=$respons->fetch(PDO::FETCH_ASSOC)){
            if($resault!="")$resault.=" - ";
            $resault.=$row["full_name"];
        }
        return $resault;
    }catch(Exception $e){
        throw $e;
    }
}

function showProjects() {
    global $conn;
    try {
        $project = new Project($conn);
        $respons = $project->showProjects();
        $resault = [];
        $idx = 0;
        while ($row = $respons->fetch(PDO::FETCH_ASSOC)) {
            $row["studentsNames"] = getStudentsNames($row["project_id"]);
            $resault[$idx] = $row;
            $idx++;
        }
        echo json_encode(["status" => "success", "table" => $resault]);
    } catch (Exception $e) {
        echo json_encode(["status" => "failed","msg"=>$e->getMessage()]);
    }
}

function logout() {
    try {
        unset($_SESSION["userId"]);
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => $e->getMessage()]);
    }
}

if (isset($_POST["login"])) {
    login();
    exit;
}
if (isset($_POST["showProjects"])) {
    showProjects();
    exit;
}
if (isset($_POST["logout"])) {
    logout();
    exit;
}
