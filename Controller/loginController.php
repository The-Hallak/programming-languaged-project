<?php
include "../Config/DataBase.php";
include "../Models/Person.php";

$id=$_POST["userId"];
$password=$_POST["password"];

$dataBase=new DataBase();
$person=new Person($dataBase->connect());

$person->id=$id;
$resault=$person->login();
if($resault->rowCount()==0){
    echo json_encode([
        "status"=>"failed",
        "reason"=>"no user was found with this id"
    ]);
    exit;
}
$resault=$resault->fetch(PDO::FETCH_ASSOC);



if(!password_verify($password,$resault["password"])){
    echo json_encode([
        "status"=>"failed",
        "reason"=>"wrong passowrd"
    ]);
    exit;
}

echo json_encode([
    "status"=>"success",
    "role"=>$resault["role"],
]);

?>