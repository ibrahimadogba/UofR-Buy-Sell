<?php
session_start();
$validate = true;
$error = "";        
if (array_key_exists("Id", $_GET)) {
       $_SESSION["Id"] = $_GET["Id"];
}
        $sellId =  $_SESSION["Id"];

        $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");
        $q2 = "SELECT sellId , selltitle, sellimage, price, selldescription, sellclassnum, sellisbn, sellauthor, created_dt FROM sellcreation where sellId = '$sellId'" ;     
        $q1 = "SELECT sellId , selltitle, sellimage, price, selldescription, sellclassnum, sellisbn, sellauthor, created_dt FROM sellcreation  ORDER BY created_dt DESC LIMIT 3" ;     
        $r1 = $db->query($q1, PDO::FETCH_ASSOC);
        $r2 = $db->query($q2, PDO::FETCH_ASSOC);
        
        $row= $r2->fetch();
        $selltitle = $row["selltitle"];
        $sellauthor = $row["sellauthor"];
        $sellimage = $row["sellimage"];
        $selldescription = $row["selldescription"];
        $sellisbn = $row["sellisbn"];
        $price = $row["price"];

                if (isset($_POST["deletePost"])) {
                $sellId = $_POST["sellId"];
                $q8 = "DELETE FROM sellcreation WHERE sellId = '{$row["sellId"]}'";
                $r8 = $db->exec($q8);

                if ($r8 !== false) {
                header("Location: myaccount.php");
                exit();
            } else {
                echo '<script>alert("Failed to delete Post")</script>';
                echo '<script>window.location.href="myaccount.php";</script>';
            }
            }
            $db = null;

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">



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
                <li><a class="active" href="books.php">Shop</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="myaccount.php">My account</a></li>
                <li id="lg-bag"><a href="signout.php"><i class="fa-solid fa-person-walking-arrow-right"></i></i></a></li>
                <a href="#" id ="close"><i class="fa-sharp fa-solid fa-xmark"></i></a>
            </ul>
    </div>

        <div id="mobile">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <!--Product section.-->
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
        <?php if (isset($row["sellimage"])) { ?>
          <img src="<?php echo $row["sellimage"]; ?>" width="75%" id="mainimages" />
        <?php } else { ?>
          <img src="https://via.placeholder.com/350x200.png?text=No+Image" height="350" alt="No Image">
        <?php } ?>
        </div>

        <!--Prodct explanation-->
        <div class="single-pro-details">
        <h6><strong>Books</strong></h6>
            <h6><strong><?php echo $selltitle;?></strong></h6>
            <h2>$<?php echo $price;?></h2>
            <form method="post">
            <button class="normal" type="submit" name="deletePost" onclick="return confirm('Are you sure you want to delete this post?')">Delete This Post</button>

            </form>
            <h4>Product Details</h4>
            <h6><strong>The author is:<?php echo $sellauthor;?></strong></h6>
            <h6><strong>The ISBN is:<?php echo $sellisbn;?></strong></h6>
            <h6><strong>Book description</strong></h6>
            <span><?php echo $selldescription;?></span>
        </div>
    </section>

    <!--Featured products-->
    <section id="product1">
        <div class="container my-5">
          <h1 class="text-center">Top Picks</h1>
          <hr>
          <div class="row">
    <?php foreach ($r1 as $row) { ?>
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
              </div></div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  </section>
      

    <!--Newletter-->
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

    <!--Footer-->
    <footer class="section-p1">
        <div class="colum">
        <img class="logo" src="Pictures/homepage/uofr.jpeg" alt="" width="100" height="80">
        <h4><strong>Contact</strong></h4>
            <p><strong>Address:</strong> 31-65 Munroe Pl, Regina, Sk, S4S 6A7</p>
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
              <a href="#"> About Us</a>
              <a href="#"> Delivery information</a>
              <a href="#"> Privacy Policy</a>
              <a href="#"> Contact Us</a>
            </div> 
  
          <div class="colum">
            <h4><Strong>My account</Strong></h4>
            <a href="login.php"> Login</a>
          <a href="signup.php"> Sign-up</a>
            <a href="#"> Notifications</a>
            <a href=""> Contact Us</a>
          </div> 
  
          <div class="colum install">
            <h4><strong>Install App</strong></h4>
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
          <p>@ 2023, Ibrahim etc - HTML CSS Ecommerce Template</p>
          </div>
      </footer>

    <script >
        var mainimages = document.getElementById("mainimages");
        var smallimg= document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            mainimages.src = smallimg[0].src;
        }

        smallimg[1].onclick = function(){
            mainimages.src = smallimg[1].src;
        }

        smallimg[2].onclick = function(){
            mainimages.src = smallimg[2].src;
        }

        smallimg[3].onclick = function(){
            mainimages.src = smallimg[3].src;
        }
    </script>
    <script src="script.js"></script>


</body>


</html>