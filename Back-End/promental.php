<?php
$validate = true;
$error = "";
session_start();
        if (!isset($_SESSION["email"]))
        {
            header("Location: login.php");
            exit();
        }
        else{

                            $email=$_SESSION["email"] ; 
                            $username=$_SESSION["uname"];
                            $userId= $_SESSION["userId"];
                            $photo_img=$_SESSION["photo_img"] ;
                 
                            $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");
                            $q5 = "SELECT COUNT(*) FROM sellcreation WHERE userId = '$userId'";
                            $count = $db->query($q5)->fetchColumn(); 


                           
                    if (isset($_POST["Createsell"]) && $_POST["Createsell"])
                     {
                      $selltitle = trim($_POST["book=title"]);
                      $sellauthor = trim($_POST["book-author"]);
                      $sellisbn = trim($_POST["book-isbn"]);
                      $sellclassnum = trim($_POST["book-class"]);
                      $selldescription = trim($_POST["post-content"]);
                      $price = trim($_POST["book-price"]);
                      $currenttime=time();
                      try {

                        if($selltitle == null || $selltitle == "" || $selltitle == false) {
                            $validate = false;
                            $error .= "Book Title Is empty.\n<br />";
                        }
                        
                      
                        
                        // Check if an image file was uploaded
                        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                          $target_dir = "uploads/";
                          $target_file = $target_dir . basename($_FILES["image"]["name"]);
                          $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                      $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check !== false) {
                        $error .= "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                      } else {
                        $error .= "File is not an image.";
                        $uploadOk = 0;
                      }
                      if ($_FILES["image"]["size"] > 500000) {
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
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                          
                        } else {
                          $error .= "Sorry, there was an error uploading your file.";
                        }
                      }
                                              
                       if($validate == true) {
                            $created_dt=date("Y-m-d H:i:s",$currenttime);
                            $q2 = "INSERT INTO sellcreation (selltitle, sellauthor, sellisbn, sellimage, selldescription, created_dt, price, userId) 
                            VALUES ('$selltitle', '$sellauthor', '$sellisbn', '$target_file', '$selldescription', '$created_dt', '$price', '$userId')";

                
                             
                            $r2 = $db->exec($q2);
                            
                            

                            if ($r2 != false) {
                               header("Location: myaccount.php");
                            
                                $r2 = null;
                                $db = null;
                                exit();
                
                            } else {
                                $r2 = null;
                                $validate = false;
                                $error .= "Trouble adding product to database!\n<br />";
                            }         
                        }
                        
                        if ($validate == false) {
                            $error .= "Selling Creation failed.";
                        }
                      }
                        
                        $db = null;
                         } catch (PDOException $e) {
                                 die("PDO Error >> " . $e->getMessage() . "\n<br />");            
                             }       
                    

                 } 
                }
              $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");                                             
              $q =  "SELECT s.sellId, s.selltitle, s.sellimage
              FROM favorites f
              INNER JOIN sellcreation s ON f.sellId = s.sellId
              WHERE f.userId = (SELECT userId FROM Users WHERE email = '$email')";
                $r=$db->query($q, PDO::FETCH_ASSOC);
                $row = $r->fetchAll();
                /*if (!empty($row)) {
                  $selltitle = $row["selltitle"];
                  $sellimage = $row["sellimage"];
                  $sellId = $row["sellId"];
              } /*else {
                $sellimage = null;
              }*/

                $q3 = "SELECT sellId, selltitle, sellimage, selldescription, created_dt, price 
                FROM sellcreation 
                WHERE userId = '$userId'";
                $r3 = $db->query($q3, PDO::FETCH_ASSOC);
                $rows = $r3->fetchAll();
            
  ?>      
                      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Custom StyleSheet -->
    <script src="https://kit.fontawesome.com/a241594fe2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


    <title>MyAccount</title>
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <script type="text/javascript" src="sellcreation.js"></script>
    <script type="text/javascript" src="script.js"> </script>
    <style>
            .err_msg{ color:red;}
         </style>
</head>

<body>
    <!--Header.-->
    <section id="header">
        <a href="#"><img src= "Pictures/homepage/uofr.jpeg" class="logo" alt="" width="80" 
            height="80"></a>
        <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="books.php">Shop</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a class="active" href="myaccount.php">My account</a></li>
                    <li id="lg-bag"><a href="signout.php"><i class="fa-solid fa-person-walking-arrow-right"></i></i></a></li>
                    <a href="#" id ="close"><i class="fa-sharp fa-solid fa-xmark"></i></a>
                </ul>
        </div>

        <div id="mobile">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="myaccount">
        <h1>My Account</h1>

  <div class="user-details">
  <?= "<img src=".$photo_img." height=100 width=100 />"?>
    <div>
      <p>username: <?=$username?></p>
      <p>Email: <?=$email?></p>
      <p><strong>Please Buy and Sell Responsiblely.</strong></p>
    </div>
  </div>

  <div class="favorites-section">
    <h2>Favorite Books</h2>
    <?php

    // code to retrieve favorites goes here
    if (count($row) > 0) {
        echo '<ul class="favorites-list">';
        foreach ($row as $r) {
            echo '<li class="favorites-item">';
            echo '<img src="' . $r['sellimage'] . '" height="300" width="250" onclick="window.location.href=\'learnmore.php?Id=' . $r['sellId'] . '\'"/>';
            echo '<h3>' . $r['selltitle'] . '</h3>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo "<p>You haven't added any favorites yet.</p>";
    }
    ?>
</div>
<div class="favorites-section">
    <h2>Posted Books</h2>
    <p>P.S: You can click on post to delect them. 
    <?php

    // code to retrieve favorites goes here
    if (count($rows) > 0) {
        echo '<ul class="favorites-list">';
        foreach ($rows as $row) {
            echo '<li class="favorites-item">';
            echo '<img src="' . $row['sellimage'] . '" height="300" width="250" onclick="window.location.href=\'deletepost.php?Id=' . $row['sellId'] . '\'"/>';
            echo '<h3>' . $row['selltitle'] . '</h3>';
            echo' <form method="POST">';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo "<p>You haven't added any posts yet.</p>";
    }
    ?>

    
</div>
                
  <div class="post-form">
    <h2>Add a Post</h2>
    <form id="SellCreation" action = "myaccount.php" method="post" enctype="multipart/form-data">
    <p class = "err_msg"><?=$error?></p>
    <label for="book=title">Title:</label>
    <label id="msg_selltitle" class="err_msg"></label>
      <input type="text" id="book=title" name="book=title" onkeyup="countChars()" required><br>
      <p id="msg_characterscount"></p>
      

      <label for="book-author">Author:</label>
      <label id="msg_sellauthor" class="err_msg"></label>
      <input type="text" id="book-author" name="book-author" onkeyup="countChars_author()"><br>

      <label for="book-isbn">ISBN:</label>
      <label id="msg_sellisbn" class="err_msg"></label>
      <input type="text" id="book-isbn" name="book-isbn" onkeyup="countChars_isbn()" required><br>
      <p id="msg_characterscount"></p>
      
      <label for="book-price">Price:</label>
      <label id="msg_price" class="err_msg"></label>
      <input type="text" id="book-isbn" name="book-price" onkeyup="countChars_price()" required><br>
      <p id="msg_characterscount"></p>

      <label for="book-class">Class Number:</label>
      <label id="msg_sellclassnum" class="err_msg"></label>
      <input type="text" id="book-class" name="book-class" onkeyup="countChars_classnum()" required><br>
      <p id="msg_characterscount"></p>
      

      <label for="post-content">Content:</label>
      <label id="msg_selldescription" class="err_msg"></label>
      <textarea id="post-content" name="post-content" onkeyup="countChars_description()" required></textarea><br>
      <p id="msg_characterscount"></p>

      <label for="sellimage">Image:</label>
      <label id="msg_sellimage" class="err_msg"></label>
      <input type="file" accept=".jpg,.png,.jpeg" name="image" id="sellimage" required>
      

      <input type="submit" value="Add Post" name="Createsell" id= "Createsell" />
    </form>
        </div>
    </section>

    <!--Footer-->
    <footer class="section-p1">
    <div class="colum">
      <img class="logo" src="Pictures/homepage/uofr.jpeg" alt="" width="100" height="80">
      <h4><strong>Contact</strong></h4>
          <p><strong>Address:</strong> 3737 Wascana Pkwy, Regina, SK S4S 0A2</p>
          <p><strong>Phone:</strong>306-342-2345</p>
          <p><strong>Hours:</strong>10:00-18:00, Mon-Sat</p>
            <div class="follow">
              <h4>Follow Us</h4>
                <div class="icon">
                  <i class="fab fa-facebook-f"></i>
                  <i class="fab fa-twitter"></i>
                  <i class="fab fa-instagram"></i>
                  <i class="fab fa-pinterest-p"></i>
                  <i class="fab fa-youtube "></i>
                </div>
            </div>
          </div>


          <div class="colum">
            <h4><strong>About</strong></h4>
            <a href="about.php"> About Us</a>
            <a href="#"> Delivery information</a>
            <a href="about.php"> Privacy Policy</a>
          </div> 

        <div class="colum">
          <h4><Strong>My account</Strong></h4>
          <a href="login.php"> Login</a>
          <a href="signup.php"> Sign-up</a>
          <a href="myaccount.php"> Notifications</a>
        </div> 

        <div class="colum install">
          <h4><strong>Install App on: 08/22/2023</strong></h4>
          <div class="roww">
              <img src="Pictures/homepage/app.png" alt="" width="150" 
              height="65" >
              <img src="Pictures/homepage/play.png" alt="" width="150" 
              height="65">
          </div>
          <p> Secure paymeny Getway</p>
          <img src="Pictures/homepage/Secure paymeny Getway.jpeg" alt="" width="250" 
          height="80" >
        </div>
      <div class="copyright">
        <p>@ 2023, UofR buy & sell - HTML CSS Template</p>
        </div>
  </footer>
  <script src="script.js"></script>
  <script type ="text/javascript" src="sellcreation_r.js"> </script>



</body>


</html>
