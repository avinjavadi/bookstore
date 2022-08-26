<?php
    include "setting/connect.php";
    include "class.php";  
    $show=true;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/f2f0c7f07a.js" crossorigin="anonymous"></script>
    <title>Sign-in</title>
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
<body class="signin-container">
    <?php include "header.php";?>
    <div class="error-show">
    <?php
        if(isset($_POST['submit'])){

            $myDB=new signin();
            $myDB->signup_error_check($_POST['fname'] , $_POST['lname'] , $_POST['email'] , $_POST['mobile'] , $_POST['address'] , $_POST['password']);
            
            if($myDB->input_error===false){
                $myDB->connect_db($mysql_server , $mysql_username , $mysql_password , $mysql_db);
                $myDB->insert_data();
                if($myDB->show_form==false)
                    $show=false;
            }   
        }
    ?>

    </div>
    <?php if($show==true){ ?>
    <div class="form">
        <h2>SIGN-IN</h2>
        <form action="#" method="POST">
            <div>
                <input type="text" name="fname" placeholder=" First name ..." value="<?php if(isset($_POST['fname'])){echo $_POST['fname'] ;} ?>">
            </div>

            <div>
                <input type="text" name="lname" placeholder=" Last name ..." value="<?php if(isset($_POST['lname'])){echo $_POST['lname'] ;} ?>">
            </div>

            <div>
                <input type="text" name="email" placeholder=" Email ..." value="<?php if(isset($_POST['email'])){echo $_POST['email'] ;} ?>">
            </div>

            <div>
                <input type="text" name="mobile" placeholder=" Phone number ..." value="<?php if(isset($_POST['mobile'])){echo $_POST['mobile'] ;} ?>">
            </div>

            <div>
                <input type="text" name="address" placeholder=" Address ..." value="<?php if(isset($_POST['address'])){echo $_POST['address'] ;} ?>">
            </div>

            <div class="password">
                <input type="password" name="password" id="pass" placeholder=" Password ..." value="<?php if(isset($_POST['password'])){echo $_POST['password'] ;} ?>">
                <div class="show-pass">
                    <i class="fa-solid fa-eye" id="show_pass" onclick="show()" title="show password"></i>
                </div>
            </div>
            
           <div>
                <input type="submit" name="submit" value="Sign-in" id="submit" >
           </div> 
            
            
        </form>
    </div>
    <?php } ?>
    
</body>
</html>

