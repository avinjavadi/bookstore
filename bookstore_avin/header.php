<?php

    $user_login=false;
    $username="";
    if(isset($_SESSION['user_login'])){
        $user_login=true;
        $username=$_SESSION['fname'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <div class="top-bar">
        <div class="search">
            <form action="search.php" method="POST">
                <input type="text" name="search" placeholder=" Search ..."><input type="submit" id="search_button" value="Search" name="search_sub">
            </form>
        </div>

        <div class="logo">
            <a href="index.php" title="Main Page">
                <img src="image/icons8-storytelling-100.png" alt="logo">
            </a>                
        </div>
            <div class="account_button">
                <?php
                    if($user_login==true){
                        echo '<a href="logout.php">Logout</a>';
                        echo "<a href='#'>$username</a>";
                    }
                    else{
                ?>
                <a href="login.php">Login</a>
                <a href="signin.php">Sign-in</a>
                <?php } ?>
            </div>
    </div>
</body>
</html>