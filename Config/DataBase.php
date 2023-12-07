<?php

class DataBase{
    public $host='localhost';
    private $username='root';
    private $password='Mohamad@2002';
    private $dbname='projectsManager';
    private $connection;

    public function connect(){
        try {
            $this->connection = new PDO("mysql:host={$this->host};", $this->username, $this->password);
            $this->connection->query("USE {$this->dbname}");
            return $this->connection;
        }catch(PDOException $e){
            $str="SQLSTATE[42000]";
            if(substr($e->getMessage(),0,strlen($str))==$str){
                $this->createDB();
                $this->connect();
                return;
            }
            throw new Exception("could't connecto to database");
        }
    }
    
    private function createDB(){

        $sql="CREATE DATABASE {$this->dbname}";
        $this->connection->query($sql);

        $sql="USE {$this->dbname}";
        $this->connection->query($sql);


        $sql="CREATE TABLE users(
            user_id INT AUTO_INCREMENT NOT NULL,
            full_name VARCHAR(20) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(65) NOT NULL,
            role INT NOT NULL,
            PRIMARY KEY(user_id)
        );";
        $this->connection->query($sql);


        $sql="CREATE TABLE projects(
            project_id INT AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(150),
            teacher_id INT NOT NULL,
            number_of_student INT NOT NULL,
            remaining_number_of_student INT NOT NULL,
            PRIMARY KEY(project_id),
            FOREIGN KEY(teacher_id)
                REFERENCES users(user_id)
        );";
        $this->connection->query($sql);

        $sql="CREATE TABLE student_project(
            student_id INT NOT NULL,
            project_id INT NOT NULL,
            FOREIGN KEY(student_id)
                REFERENCES users(user_id),
            FOREIGN KEY(project_id)
                REFERENCES projects(project_id)
        );";
         $this->connection->query($sql);

        $adminPassword=password_hash("mohamad2002",PASSWORD_BCRYPT);
        $sql="INSERT INTO users(full_name,email,password,role) VALUES('mohamad alhallak','srdamaa777mmm@gmail.com','{$adminPassword}',0);";
        $this->connection->query($sql);
    }
}

?>