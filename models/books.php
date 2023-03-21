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
    $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");
    $q2 = "SELECT sellcreation.selltitle, sellcreation.sellId, sellcreation.sellimage, sellcreation.price, sellcreation.created_dt, Users.username, Users.photo_img 
    FROM sellcreation
    INNER JOIN Users ON sellcreation.userId = Users.userId
    ORDER BY sellcreation.created_dt DESC";    
    $r2 = $db->query($q2, PDO::FETCH_ASSOC);

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Custom StyleSheet -->
    <script src="https://kit.fontawesome.com/a241594fe2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">


    <title>Shop Page</title>
    <link rel ="stylesheet" type="text/css" href="stylesheet.css">
    <script type="text/javascript" src="script.js"> </script>
</head>

<body>
    <!--Header.-->
        <section id="header">
            <a href="index.php"><img src= "Pictures/homepage/uofr.jpeg" class="logo" alt="" width="80" 
                height="80"></a>
            <div>
                    <ul id="navbar">
                        <li><a href="index.php">Home</a></li>
                        <li><a class="active" href="books.php">Shop</a></li>
                        <li><a href="search.php">Search</a></li>
                        <li><a href="about.php">About</a></li>
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
        
    <!--Product-->
    <section id="product1">
        <div class="container my-5">
          <h1 class="text-center">Top Picks</h1>
          <hr>
        <div class="row">
        <?php foreach ($r2 as $row) { ?>
          <div class="col-md-4">
            <div class="card">
            <?php if (isset($row["sellimage"])) { ?>
              <img src="<?php echo $row["sellimage"]; ?>" height="350" />
            <?php } else { ?>
              <img src="https://via.placeholder.com/350x200.png?text=No+Image" height="350" alt="No Image">
            <?php } ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["selltitle"] ?? '';?></h5>
                <h4>$<?php echo $row["price"] ?? '';?></h4>
                <a href="#" class="btn btn-primary" onclick="window.location.href='learnmore.php?Id=<?=$row['sellId']?>'" id="learnmore">Learn More</a>
                <div class="d-flex justify-content-between">
                  <div class="seller-info">
                    <img src= "<?php echo $row["photo_img"]; ?>" height=40 width=40 />
                    <p class="seller-name"><?php echo $row["username"]; ?></p>
                  </div></div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
      
    <!-- Newsletter -->
        <section id="newsletter" class="section-p1">
          <div class="newstext">
              <h4>Sign Up For Our Newsletter</h4>
              <p>Get E-mail updates about our latest shop and <span>Special offers.</span> 
              </p>
          </div>
      
          <div class="form">
              <input type="text" placeholder="Your E-mail address">
              <button class="normal">Sign Up</button>
          </div>
        </section>

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


</html>