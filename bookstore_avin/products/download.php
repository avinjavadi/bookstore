<?php
include ("../setting/connect.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
</head>
<body>
    <?php
    $pid=$_REQUEST['pid'];
    $mysql=new mysqli($mysql_server , $mysql_username , $mysql_password , $mysql_db);
    $sql="SELECT pdf FROM books WHERE pid='$pid'";
    $result=$mysql->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $bookpdf=$row['pdf'];
        echo $bookpdf;

        
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=$bookpdf");
        readfile("../file/$bookpdf");


    }



    ?>
    
</body>
</html>