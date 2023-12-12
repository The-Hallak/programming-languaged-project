<?php

include '../Models/Person.php';
include '../Models/Project.php';
include '../Config/DataBase.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$dataBase = new DataBase();
global $conn;
$conn = $dataBase->connect();

function dropAddProject() {
    try {
        global $conn;
        $person = new Person($conn);
        $person->id = $_SESSION["user_id"];
        if ($_POST["state"] == "drop") {
            $person->projectId = "null";
        } else {
            $person->projectId = $_POST["project_id"];
        }
        $person->dropAddProject();
        $project = new Project($conn);
        $project->id = $_POST["project_id"];
        $project->addRemoveStudent($_POST["state"] == "drop" ? "+1" : "-1");

        if ($_POST["state"] == "drop") {
            $_SESSION["user_project"] = null;
        } else {
            $_SESSION["user_project"] = $_POST["project_id"];
        }

        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "failed", "msg" => $e->getMessage()]);
    }
}

if (isset($_POST["drop_add_project"])) {
    dropAddProject();
}
