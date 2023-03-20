<?php

$validate = true;
$error = "";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Pswdr = "/^(\S*)?\d+(\S*)?$/";
$reg_Uname = "/^[a-zA-Z0-9_-]+$/";



if (isset($_POST["Signup"]) && $_POST["Signup"]) {
    $email = trim($_POST["email"]);
    $uname = trim($_POST["username"]);
    $password = trim($_POST["pswd"]);
    $confirmpassword = trim($_POST["pswdr"]);
   
 
    try {

        $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");    
    
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false) {
            $validate = false;
            $error .= "Invalid email address.\n<br />";
        }

        $q1 = "SELECT COUNT(*) FROM Users WHERE email = '$email'";
        $count = $db->query($q1)->fetchColumn(); 
        if($count > 0) {
            $validate = false;
            $error .= "Email address already exists.\n";
        } 

        $unamematch = preg_match($reg_Uname, $uname);
        if($unamematch == null || $unamematch == "" || $unamematch == false) {
            $validate = false;
            $error .= "Invalid UserName .\n<br />";
        }


        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $pswdMatch == false) {
            $validate = false;
            $error .= "Invalid password.\n<br />";
        }

        $pswdrLen = strlen($confirmpassword);
        $pswdrMatch = preg_match($reg_Pswdr, $confirmpassword);
        if($confirmpassword == null || $confirmpassword == "" || $pswdrLen < 8 || $pswdrMatch == false || $password!=$confirmpassword  ) {
            $validate = false;
            $error .= "Invalid Confrim password && Confirm Password Must Match.\n<br />";
        }



        $target_dir = "uploads/";
              $target_file = $target_dir . basename($_FILES["photo_img"]["name"]);
              $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          $check = getimagesize($_FILES["photo_img"]["tmp_name"]);
        if($check !== false) {
            $error .= "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            $error .= "File is not an image.";
            $uploadOk = 0;
          }
          if ($_FILES["photo_img"]["size"] > 500000) {
            $error .= "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            $error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
          
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            $error .= "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["photo_img"]["tmp_name"], $target_file)) {
              
            } else {
              $error .= "Sorry, there was an error uploading your file.";
            }
          }

          if($validate == true) {
          
            
            $q2 = "INSERT INTO Users ( username , email , pswd, photo_img )
                    VALUES ('$uname' ,'$email', '$password', '$target_file' )";

        
            $r2 = $db->exec($q2);
            
            if ($r2 != false) {
              // echo "a";
                header("Location: index.php");
               
                $r2 = null;
                $db = null;
                exit();

            } else {
                $r2 = null;
                $validate = false;
                $error .= "Trouble adding new user to database!\n<br />";
            }         
        }
        
        if ($validate == false) {
            $error .= "Signup failed.";
        }
        $db = null;
  
    } catch (PDOException $e) {
        echo "PDO Error >> " . $e->getMessage() . "\n<br />";
    }
    }
?>


<!DOCTYPE html>
<html lang="en"> 
<link rel="stylesheet" href="mystyle.css">
    <head>
        <meta charset="utf-8"/>
        <title>Signup</title>
        <script type="text/javascript" src="validate_signup.js"></script>
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
                <h1>Please create an account</h1>

                <form class="login" id="Signup" method="post" action="signup.php" enctype="multipart/form-data">
                <p class ="err_msg"><?=$error?></p>    
                <div class="input">
                        <p><label id="email_msg" class="err_msg"></label></p>
                        <input  inputmode="email" name="email" type="text" id="email" class="box">
                        <div class="username-label" ><strong>Email address</strong></div>
                    </div>
                    <div class="input">
                        <p><label id="uname_msg" class="err_msg"></label></p>
                        <input inputmode="username" name="username" type="text" id="username" class="box">
                        <div class="username-label" ><strong>Username</strong></div>
                    </div>
                    <div class="input">
                        <p><label id="pswd_msg" class="err_msg"></label></p>
                        <input  inputmode="password" name="pswd" type="text" id="pswd" class="box">
                        <div class="password-label"><strong>Password</strong></div>
                    </div>
                    <div class="input">
                    <p><label id="pswdr_msg" class="err_msg"></label></p>
                        <input inputmode="password" name="pswdr" type="text" id="pswdr" class="box">
                        <div class="password-label"><strong>Confirm password</strong></div>
                    </div>
                    <div class="input">
                        <p><label id="photo_msg" class="err_msg"></label></p>
                        <p><strong>Upload a profile picture: </strong><input type="file" id="photo_img" name="photo_img"/></p>
                    </div>
                    <div class="input">
                        <input type="submit" class="button-continue"  name="Signup" id= "Signup" >
                    </div>
                </form>
                <script type = "text/javascript"  src = "validate_signup_r.js" ></script>
            </div>
        </div>
        </section>
    </body>
</html>
