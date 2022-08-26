<?php
    session_start();
    if(isset($_SESSION['user_login'])){
        header("location:index.php");
    }
    $show_login_form=true;
    include "setting/connect.php";
    include "class.php";  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/f2f0c7f07a.js" crossorigin="anonymous"></script>
    <script>
        function show(){
            let show=document.getElementById('show_pass');
            let password=document.getElementById('pass');
            if(password.type==="password"){
                password.setAttribute('type','text');
                show.setAttribute('style','color:#ffdb003d');
                show.setAttribute('title','hide password');
            }
            else{
                password.setAttribute('type','password');
                show.setAttribute('style','color:#ffbf00');
                show.setAttribute('title','show password');
            }
        }
    </script>
</head>
<body class="login-container">
    <?php include "header.php";?>
    <div class="error-show">
        <?php
            if(isset($_POST['submit'])){
                $myDB= new login();
                $myDB->login_error_check($_POST['email'] , $_POST['password']);

                if($myDB->input_error==false){
                    $myDB->connect_db($mysql_server , $mysql_username , $mysql_password , $mysql_db);
                    $myDB->login_permission();
                    if($myDB->active==false)
                        $show_login_form=false;
                }
            }

            if(isset($_POST['active'])){
                $active_user= new login();
                $active_user->connect_db($mysql_server , $mysql_username , $mysql_password , $mysql_db);
                $active_user->active_account($_POST['act_code']);
            }
        ?>
    </div>
    <div class="form">
        <?php if($show_login_form==true){ ?>
            <h2>LOGIN</h2>
            <form action="#" method="POST">
                <div>
                    <input type="text" name="email" placeholder=" Email ..." value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>">
                </div>

                <div class="password">
                    <input type="password" id="pass" name="password" placeholder=" Password ...">
                    <div class="show-pass">
                        <i class="fa-solid fa-eye" id="show_pass" onclick="show()" title="show password"></i>
                    </div>
                </div>

                <div>
                    <input type="submit" name="submit" value="Login" id="submit">
                </div>
            </form>
        <?php } ?>
        <?php
            if(isset($myDB)){
                if($myDB->active==false){

        ?>
        <h2>Login</h2>
        <form action="#" method="POST">
            <div>
                <input type="text" name="act_code" placeholder="Enter your activation code ...">
            </div>
            <div>
                <input type="submit" name="active" value="Active" id="submit">
            </div>
        </form>
        <?php
                }
            }
        ?>
    </div>
</body>
</html>