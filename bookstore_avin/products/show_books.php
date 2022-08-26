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
        $pid=$_REQUEST['pid'];
        $mysql=new mysqli($mysql_server , $mysql_username , $mysql_password , $mysql_db);
        $sql="SELECT * FROM books WHERE pid='$pid'";
        $result=$mysql->query($sql);
        if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $bname=$row['name'];
        $category=$row['category'];
        $author=$row['author'];
        $description=$row['description'];
        $bimg=$row['image'];
        $bpdf=$row['pdf'];
        $pid=$row['pid'];
    ?>

            <div class="product_container2">
                <div>
                    <?php
                        
                        echo "<div>";
                        echo "<img src='../image/books/$bimg' style='width:250px; height:300px;'>";
                        echo "</div>";
                        
                    ?>
                </div>
                <div class="product-Specifications">
                    <?php
                        echo "<p>Book name : <strong>$bname</strong></p><br>";
                        echo "<p>Book category : <strong>$category</strong></p><br>";
                        echo "<p>Book author : <strong>$author </strong></p><br>";
                        echo "<b>description :</b> <br>";
                        echo "<p>$description</p><br>";
                        echo "<div><a href='download.php?pid=$pid' ' style='padding:10px 20px; background-color:yellow; color:black; border-radius:5px;'>Download</a></div>"

                       
                    ?>
                </div>
            </div>

    <?php } ?>
</body>
</html>