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
                                 

                          
        
    }


    


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


    <title>HomePage</title>
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <script type="text/javascript" src="script.js"> </script>
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
                    <li><a class="active" href="about.php">About</a></li>
                    <li><a href="myaccount.php">My account</a></li>
                    <li id="lg-bag"><a href="signout.php"><i class="fa-solid fa-person-walking-arrow-right"></i></a></li>
                    <a href="#" id ="close"><i class="fa-sharp fa-solid fa-xmark"></i></a>
                </ul>
        </div>

        <div id="mobile">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <!--About sesction.-->
    <section id="page-header" class="about-header">
        <h2 style="color:white; ">#KnowUs</h2>
        <p style="color:white">Get to know us and how we create our products</p>
    </section>

    <section id="about-head" class="section-p1">
        <img src="Pictures/about/a6.jpg" alt="">
        <div>
        <h2>Who We Are ? </h2>
            <p>
            We are a platform that allows university students to purchase and sell old books online is becoming increasingly necessary. 
            Finding secondhand books may be difficult for students, especially when they're seeking for particular editions or out-of-print titles. Students must also 
            find a way to augment their income by selling their secondhand textbooks.With the rising cost of Post-secondary education, costs of textbooks follow. It may be 
            difficult for students to browse and locate the books they require within existing online markets since they are not designed to meet their unique demands. 
            For students, the absence of a specific online marketplace for buying and selling old school books might result in increased prices and hassle. A site that is 
            specifically designed for university students' requirements can solve this issue.
            </p>
            <br><br>
            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">Created by The Coding Conquistadors: Ibrahim Adogba  | Wilbur Dulce | James Sieben</marquee>
        </div>
    </section>

    <!--About App-->
    <section id="about-app" class="section-p1">
        <h1>Download our <a href="https://play.google.com/store/games">App</a>22/08/2023</h1>
        <video autoplay muted loop src="Pictures/about/1.mp4" style="width: 70% ;
        height: 100%; margin: 30px auto 0 auto;"></video>
    </section>

    <!--NewLetter-->
    <section id="newsletter" class="section-p1">
        <div class="newstext">
            <h4>Sign Up For Our Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>Special offers.</span> 
            </p>
        </div>

        <div class="form">
            <input type="text" placeholder="Your E-mail address">
            <button class="normal">Sign Up.</button>
        </div>
    </section>


    <!--footer-->
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
</body>
</html>