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
                 
        
    }

        $db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");

           // Retrieve latest three items from the database
        $q1 = "SELECT sellId , selltitle, sellimage, price, selldescription, sellclassnum, sellisbn, sellauthor, created_dt FROM sellcreation  ORDER BY created_dt DESC LIMIT 3" ;     
            $r1 = $db->query($q1, PDO::FETCH_ASSOC);
           // Retrieve all items from the database

            $q2 = "SELECT sellId, selltitle, sellimage, price, selldescription, sellclassnum, sellisbn, sellauthor, created_dt FROM sellcreation";
            $r2 = $db->query($q2, PDO::FETCH_ASSOC);            
           
                $row = $r2->fetch();
                $selltitle = $row["selltitle"];
                $sellauthor = $row["sellauthor"];
                $sellimage = $row["sellimage"];
                $selldescription = $row["selldescription"];
                $sellisbn = $row["sellisbn"];
                $price = $row["price"];

                if (isset($_POST["submit"])) {
                    $result = trim($_POST["search"]);
                    $search_by = $_POST["search-by"];

                    // Prepare SQL query based on the selected search criteria
                if ($search_by == "name") {
                    $query = "SELECT * FROM sellcreation WHERE selltitle LIKE :search_term";
                } else if ($search_by == "author") {
                    $query = "SELECT * FROM sellcreation WHERE sellauthor LIKE :search_term";
                } else if ($search_by == "isbn") {
                    $query = "SELECT * FROM sellcreation WHERE sellisbn LIKE :search_term";
                } else if ($search_by == "class") {
                    $query = "SELECT * FROM sellcreation WHERE sellclassnum LIKE :search_term";
                }

                    // Execute the search query
    $stmt = $db->prepare($query);
    $stmt->bindValue(":search_term", "%" . $result . "%");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $search_results = $stmt->fetchAll();
}
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
                        <li><a href="books.php">Shop</a></li>
                        <li><a class="active" href="search.php">Search</a></li>
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
        <style>
            /* add your CSS code here */
    
            
        </style>
        <section id="search_books"> 
        <h1>Search for Avaliable Textbooks</h1>
        <form id="search" action="search.php" method = "POST" enctype = "multipart/form-data" >
            <label for="search">Search Textbooks:</label>
                <input type="text" id="search" name="search" placeholder="Search" i class="fa-solid fa-magnifying-glass"><br>
            <label for="search-by">Search By:</label>
            <select id="search-by" name="search-by">
                <option value="name">Name</option>
                <option value="author">Author Name</option>
                <option value="isbn">ISBN</option>
                <option value="class">Class</option>
            </select><br><br>
            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="all">All Categories</option>
                <option value="art">Art</option>
                <option value="sciences">Sciences</option>
                <option value="reading-books">Reading Books</option>
                <option value="medicine">Medicine</option>
                <option value="english">English</option>
            </select><br><br>
            <input type="submit" value="Search" name="submit" id= "search">
        </form>
    
        <h1>Results</h1>
       <?php
            if (isset($search_results)) {
                foreach ($search_results as $row) {
                    echo "<div>";
                    echo "<h2>" . $row["selltitle"] . "</h2>";
                    echo "<p>Author: " . $row["sellauthor"] . "</p>";
                    echo "<p>ISBN: " . $row["sellisbn"] . "</p>";
                    echo "<p>Price: $" . $row["price"] . "</p>";
                    echo "</div>";
                }
            }?>
                <a href="#" class="btn btn-primary" onclick="window.location.href='learnmore.php?Id=<?=$row['sellId']?>'" id="learnmore">Learn More</a>


    
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
      

      <!-- Footer -->
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
              <h4><Strong>My Account</Strong></h4>
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
      <script src="script.js"></script>

</body>
</html>