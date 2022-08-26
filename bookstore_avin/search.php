<?php
    session_start();

    include "setting/connect.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>search</title>
</head>
<body>
    <?php
        include "header.php";
        $search=$_POST['search'];

        if(isset($_POST['search_sub'])){
            $mysql= new mysqli($mysql_server , $mysql_username , $mysql_password, $mysql_db );
            if($mysql->connect_error)
                die('connection error');
    
            $sql="SELECT * FROM books WHERE name like '%$search%'";
            $result= $mysql->query($sql);
            if($result->num_rows==0){
                echo "<p>No items found</p>";
            }
            else{
                echo "<p>$result->num_rows Book Found...</p>";
            ?>

            <div class="category">
            <?php
               

                for($i=0 ; $i<$result->num_rows ; $i++){
                    $row=$result->fetch_assoc();
                    $bname=$row['name'];
                    $category=$row['category'];
                    $author=$row['author'];
                    $description=$row['description'];
                    $bimg=$row['image'];
                    $bpdf=$row['pdf'];
                    $pid=$row['id'];
                    echo "<a href='books/show_books.php?pid=$pid'>";
                        echo "<div>";
                            echo "<div style='border-bottom:thin solid black;'><img src='image/products/$bimg' style='width:100%; height:300px;'></div>";
                            echo "<div style='padding:5px;'><p>$name</p><p></p></div>";
                        echo "</div>";
                    echo "</a>";
                }

            ?>
            </div>
            <?php
            }

        }
    ?>
</body>
</html>