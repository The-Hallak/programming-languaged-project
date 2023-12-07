<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <?php
        include 'Config/DataBase.php';

        try{
            $DB=new DataBase();
            $DB->connect();
            header("location:View/login.html");
            exit;
        }catch(Exception $e){
            echo $e;
        }
    ?>
</body>
</html>