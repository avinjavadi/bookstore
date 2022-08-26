<?php

class signin{

    public $input_error=false;
    public $fname;
    public $lname;
    public $email;
    public $mobile;
    public $addr;
    public $password;
    public $show_form=true;
    private $mysql;
    

//_____________signin error
    function signup_error_check($fname , $lname , $email , $mobile , $addr , $password){
        try{
            if(empty($fname) or empty($lname) or empty($email) or empty($mobile) or empty($addr) or empty($password))
                throw new Exception('<p class="error">Please complete all requested information &#10071;</p>');

            try{
                if(!preg_match('/^[A-Za-z0-9]*$/',$fname))
                    throw new Exception('<p class="error">You can only use A-Z,a-z,0-9 for firstname &#10071;</p>');
            }
            catch(Exception $e){
                echo $e->getMessage();
                $this->input_error=true;
            }

            try{
                if(!preg_match('/^[A-Za-z0-9]*$/',$lname))
                    throw new Exception('<p class="error">You can only use A-Z,a-z,0-9 for lastname &#10071;</p>');
            }
            catch(Exception $e){
                echo $e->getMessage();
                $this->input_error=true;
            }

            try{
                if(strlen($fname)>25 or strlen($lname)>25)
                    throw new Exception('<p class="error"><i>Firstname</i> and <i>lastname</i> shouldnt have more than 25 charecter &#10071;</p>');
            }
            catch(Exception $e){
                echo $e->getMessage();
                $this->input_error=true;
            }

            try{
                if(!ctype_digit($mobile))
                    throw new Exception('<p class="error">Wrong phone number &#10071;</p><br>');
            }
            catch(Exception $e){
                echo $e->getMessage();
                $this->input_error=true;
            }

            try{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    throw new Exception('<p class="error">Worng Email &#10071;</p><br>');
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                $this->input_error=true;
            }
   
        }
        catch(Exception $e){
            echo $e->getMessage();
            $this->input_error=true;
        }

        if($this->input_error==false){
            $this->fname=$fname;
            $this->lname=$lname;
            $this->email=$email;
            $this->mobile=$mobile;
            $this->addr=htmlspecialchars($addr);
            $this->password=md5($password);
        }
    }

//_____________ connect to database
    function connect_db($db_host , $db_username , $db_password , $db_name){
        $this->mysql= new mysqli($db_host , $db_username , $db_password , $db_name);
        if($this->mysql->connect_error)
            die('connection error');
    }

//_____________ save information
    function insert_data(){
        $sql="SELECT * FROM user WHERE email='$this->email'" ;
        $result=$this->mysql->query($sql);
        if($result->num_rows>0){
            echo '<p class="error">This Email already exist!!!!!</p>';
        }
        else{
            $activation_code= substr(rand() * 900000 + 100000 , 0 , 6);
            $sql="INSERT INTO user(firstName , lastName , email , mobile , address, password , confirmCode ,activation)
            VALUE('$this->fname' , '$this->lname' , '$this->email' , '$this->mobile' , '$this->addr' , '$this->password' , '$activation_code' , 'no')";
            $result=$this->mysql->query($sql);
            $this->mysql->close();
            if($result===true){
                echo "<div style='color:darkgreen;background-color: #c1ffb0;padding:7px; font-weight:bold;border: 2px solid darkgreen; margin-top:20px;'>";
                echo "<p>Your account has been created successfully&#9989;</p>";
                echo "<p>Now you can login with your activation code</p>";
                echo "<span style='color:blue;background-color:cyan; padding:5px;'>activation code : $activation_code</span><br>";
                echo "<br><a href='index.php' style='color:blue;'><button>Link to main page</button></a>";
                echo "</div>";
                $this->show_form=false;
            }
        }
    }

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class login{

    public $input_error=false;
    public $email;
    public $password;
    public $active=true;
    public $mysql;

//_____________ login error
    function login_error_check($email , $pass){
        try{
            if(empty($email) or empty($pass))
                throw new Exception('<p class="error">Please complete all requested information &#10071;</p>');

            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                throw new Exception('<p class="error">ERROR! Check your Email &#10071;</p>');
        }
        catch(Exception $e){
            echo $e->getMessage();
            $this->input_error=true;
        }
        if($this->input_error==false){
            $this->email=$email;
            $this->password=md5($pass);
        }  
    }

//_____________ connect to database
    function connect_db($db_host , $db_username , $db_password , $db_name){
        $this->mysql= new mysqli($db_host , $db_username , $db_password , $db_name);
        if($this->mysql->connect_error)
            die('connection error');
            // echo "<p style='color:white;'>aaaaa</p>";
    } 

//_____________ login Permission
    function login_permission(){
        $sql="SELECT * FROM user WHERE email='$this->email' AND password='$this->password'";
        $result=$this->mysql->query($sql);
        $this->mysql->close();
        if($result->num_rows>0){
            $_SESSION['user_login']=$this->email;
            $row=$result->fetch_assoc();
            $_SESSION['fname']=$row['firstname'];
            $_SESSION['lname']=$row['lastname'];
            if($row['activation']=='yes')
                header("location:index.php");
            else{
                $this->active=false;
            }
            
        }
        else{
            echo '<p class="error">Worng Email or Password &#10071;</p>';
        }
    }

//_____________ account activation
    function active_account($activecode){
        $email=$_SESSION['user_login'];
        $sql="SELECT * FROM user WHERE email='$email' AND confirmCode='$activecode'";
        $result=$this->mysql->query($sql);
        if($result->num_rows>0){
            $sql="UPDATE user SET activation='yes' WHERE email='$email' AND confirmCode='$activecode'";
            $result=$this->mysql->query($sql);
            $this->active=true;
            header("location:index.php");
        }
        else{
            echo '<p class="error">Your activation code is WRONG &#10071;</p>';
        }

        
    }
}

class books{
    
}

?>