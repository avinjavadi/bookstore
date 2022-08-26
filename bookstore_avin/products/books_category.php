<?php
    session_start();
    include "../setting/connect.php";
    include "../class.php";
    // if(!isset($_SESSION['user_login']))
    //     header("location:../index.php");

    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Books</title>
</head>
<body>
    <?php
        // include "../header.php" ;
        $type=$_REQUEST['category'];
        $mysql=new mysqli($mysql_server , $mysql_username , $mysql_password , $mysql_db);

        $sql="SELECT * FROM books WHERE category='$type'";
        $result=$mysql->query($sql);
        if($result->num_rows>0){
            echo "<br><p style='text-align:center; font-size:20px;'>$result->num_rows product exist</p>";
            echo "<div class='category' style='margin-top:100px;'>";
            for($i=0 ; $i<$result->num_rows ; $i++){
                $row=$result->fetch_assoc();
                $bname=$row['name'];
                $category=$row['category'];
                $author=$row['author'];
                $description=$row['description'];
                $bimg=$row['image'];
                $bpdf=$row['pdf'];
                $pid=$row['pid'];
                echo "<a href='show_books.php?pid=$pid'>";
                    echo "<div style='border:thin solid black;'>";
                        echo "<div style='border-bottom:thin solid black;'><img src='../image/books/$bimg' style='width:100%; height:600px;'></div>";
                        echo "<div style='padding:5px;'><p>$bname</p><p></p></div>";
                    echo "</div>";
                echo "</a>";
            }
            echo "</div>";
        }

        else{
            echo "no item exist";
        }




        
    ?>

</body>
</html>