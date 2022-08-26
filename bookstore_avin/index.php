<?php
    session_start();
    include "setting/connect.php";

    $user_login=false;
    $username="";
    if(isset($_SESSION['user_login'])){
        $user_login=true;
        $username=$_SESSION['fname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>BOOKSHOP</title>
</head>
<body>
    <header>
        <?php include "header.php";?>
        <div class="home_welcome">
            <h1>Welcome To Our Book Store</h1>
            <h2></h2>
        </div>
    </header>
    <section>
    <div>
            <h3 class="catrgory-title">Category of Books :</h3>
            <div class="categories">
                <a href="products/books_category.php?category=Literature">
                    <div class="product">
                        <div>
                            <img src="image/category/1.png" alt="Literature">
                        </div>
                        <div class="product-type">
                            <p>Literature Books</p>
                        </div>
                    </div>
                </a>

                <a href="products/books_category.php?category=Adventure">
                    <div class="product">
                        <div>
                            <img src="image/category/2.png" alt="Adventure">
                        </div>
                        <div class="product-type">
                            <p>Adventure Books</p>
                        </div>
                    </div>
                </a>

                <a href="products/books_category.php?category=Short Story">
                    <div class="product">
                        <div>
                            <img src="image/category/3.png" alt="Short Story">
                        </div>
                        <div class="product-type">
                            <p>Short Story Books</p>
                        </div>
                    </div>
                </a>

                <a href="products/books_category.php?category=Fiction">
                    <div class="product">
                        <div>
                            <img src="image/category/4.png" alt="Fiction">
                        </div>
                        <div class="product-type">
                            <p>Fiction Books</p>
                        </div>
                    </div>
                </a>


                <a href="products/books_category.php?category=poetry">
                    <div class="product">
                        <div>
                            <img src="image/category/5.png" alt="poetry">
                        </div>
                        <div class="product-type">
                            <p>Poetry Books</p>
                        </div>
                    </div>
                </a>
               
            </div>
        </div>
    </section>

</body>
</html>