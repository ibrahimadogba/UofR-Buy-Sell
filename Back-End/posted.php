<?php
 $validate = true;
 $error = '';
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

        }
                           
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
