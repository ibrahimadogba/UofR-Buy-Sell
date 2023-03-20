<?php
session_start();
session_unset();
session_destroy();
session_start();

$validate = true;
$error = "";

$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";

$db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");

if (isset($_POST["SignIn"]) && $_POST["SignIn"]) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["pswd"]);
    
    //Before using form data for anything, validate it!
    $emailMatch = preg_match($reg_Email, $email);
    if($email == null || $email == "" || $emailMatch == false) {
        $validate = false;
        $error .= "Invalid email address.\n<br />";
    }
        
    $pswdLen = strlen($password);
    $passwordMatch = preg_match($reg_Pswd, $password);
    if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false) {
        $validate = false;
        $error .= "Invalid password.\n<br />";
    }
    
    // Only perform the query if all fields are valid
    if($validate == true) {
        try {
           

            //add code here to select * from table User where email = '$email' AND password = '$password'
            // start with 
            $q = "SELECT * FROM Users where email = '$email' AND pswd = '$password' ";
           
           
            // Search for the requested email and password combo
            $r = $db->query($q, PDO::FETCH_ASSOC);
            

            // check result length: should be exactly 1 if there's a match.
            if ($r->rowCount() == 1)
            {
                // if there's a match, get the row
                $row = $r->fetch();
                
                // add identifying information from the row to the session and go to next page
                session_start();
                $_SESSION["email"] = $row["email"];
                $_SESSION["uname"] = $row["username"];
                $_SESSION["userId"] = $row["userId"];
                $_SESSION["photo_img"] = $row ["photo_img"];
               
              
                header("Location: index.php");
                $r = null;
              
                exit();

            // result had wrong length
            } else {
                $validate = false;
                $error .= "The email/password combination was incorrect. Login failed.";
            }
            $r = null;
        } catch (PDOException $e) {
            die("PDO Error >> " . $e->getMessage() . "\n<br />");
            
        }
    }
   




}

?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <link rel="stylesheet" href="mystyle.css">
        <script type="text/javascript" src="validate_login.js"></script>
        <style>
            .err_msg{ color:red;}
         </style>
    </head>
    <body>
        <header>
            <h1>U of R Buy & Sell</h1>
        </header>
        <section id= "form">
        <div class="container" id="container-other">
            <div class="item2">
                <h1>Hello!</h1>
                <h1>Please Login</h1>

                <form id = "SignIn" class="login" method="post" action="login.php" enctype="multipart/form-data">
                <p class ="err_msg"><?=$error?></p>        
                <div class="input">
                        <p><label id="email_msg" class="err_msg"></label></p>
                        <input id="email" inputmode="email" type="text" name="email" class="box" >
                        <div class="username-label"><strong>Email address</strong></div>
                    </div>
                    <div class="input">
                        <p><label id="pswd_msg" class="err_msg"></label></p>
                        <input id="pswd" inputmode="password" type="text" name="pswd" class="box">
                        <div class="password-label" ><strong>Password</strong></div>
                    </div>
                    <input type="button" class="forgot" value="Forgot password?"/>
                    <div class="input">
                        <input type="submit" class="button-continue"  name= "SignIn" id="SignIn" value="Continue" class="box"/>
                    </div>
                    <div class="input">
                        <p>Or <input type="button" class="signup" value="sign up" onclick="window.location.href='signup.php';" class="box"/></p>
                    </div>
                </form>
                <script type="text/javascript" src="validate_login_r.js"></script>
            </div>
        </div>
        </section>
    </body>
</html>