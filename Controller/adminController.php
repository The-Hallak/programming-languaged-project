<?php

include '../Models/Person.php';
include '../Config/DataBase.php';

function addUser(){
    try{
        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $role=$_POST["role"];
        $password=password_hash($password,PASSWORD_BCRYPT);

        $dataBase=new DataBase();
        $person=new Person($dataBase->connect());

        $person->name=$name;
        $person->email=$email;
        $person->password=$password;
        $person->role=$role;
        $resault=$person->addUser()->fetch(PDO::FETCH_ASSOC);
        echo json_encode([
            "status"=>"success",
            "user_id"=>$resault["user_id"]
        ]);
        exit;
    }catch(Exception $e){
        echo json_encode([
            "status"=>"failed",
            "msg"=>$e->getMessage()
        ]);
        exit;
    }    
}

if(isset($_POST["addUser"])){
    addUser();
}

?>