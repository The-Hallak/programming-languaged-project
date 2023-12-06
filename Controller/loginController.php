<?php
include "../Config/DataBase.php";
include "../Models/Person.php";

$id=$_POST["userId"];
$password=$_POST["password"];

$dataBase=new DataBAse();
$person=new Person($dataBase->connect());

$person->id=$id;
$resault=$person->login();
if($resault->rowCount()==0){
    $_SESSION["user not found"]=true;
    header('location: ../View/login.php');
    exit;
}

?>