<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';


$db = new PDO("mysql:host=localhost; dbname=ioa388", "ioa388", "Dante112");

$error = "";

if (isset($_POST["submit"])) {
    $fromEmail = trim($_POST["email"]);
    $subjectName = trim($_POST["subject"]);
    $content = trim($_POST["content"]);

    // Validate sellId
    if (!isset($_GET["Id"]) || !filter_var($_GET["Id"], FILTER_VALIDATE_INT)) {
        $error = "Invalid sellId.";
    } else {
        $sellId = $_GET["Id"];

        // Fetch seller email from database based on sellId
        $q = "SELECT Users.email FROM sellcreation INNER JOIN Users ON sellcreation.userId = Users.userId WHERE sellId = ?";
        $stmt = $db->prepare($q);
        $stmt->execute([$sellId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !isset($row["email"])) {
            $error = "Seller's email not found.";
        } else {
            $toEmail = $row["email"];
            
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'uofrbuyandsell@gmail.com';
                $mail->Password   = 'pppxhtwcfhzbhqtk';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                
                //Recipients
                $mail->setFrom($fromEmail, $fromEmail);
                $mail->addAddress($toEmail);
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = $subjectName;
                $mail->Body    = $content;
                
                //for reply
                $mail->addReplyTo($fromEmail);
                
                $mail->send();
                echo '<script>alert("Email sent successfully!")</script>';
                echo '<script>window.location.href="index.php";</script>';
            } catch (Exception $e) {
                $error = "There was an error sending the email.";
                error_log($e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
      /* Styles for the form */
      form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
        font-family: Arial, sans-serif;
        font-size: 16px;
      }
      
      label {
        margin: 10px;
        text-align: left;
        font-weight: bold;
        color: #333;
      }
      
      input[type="text"],
      input[type="email"],
      textarea {
        width: 100%;
        padding: 10px;
        margin: 10px;
        border: 2px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        font-size: 16px;
      }
      
      input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }
      
      input[type="submit"]:hover {
        background-color: #45a049;
      }
      
      /* Styles for the page */
      body {
        background-color: #f2f2f2;
      }
      
      h1 {
        text-align: center;
        font-size: 36px;     
        color: #333;
        margin-top: 50px;
        font-family: Arial, sans-serif;
      }
    </style>
</head>
<body>
    <h1>Email the Seller</h1>
<form method="post" action="email.php?Id=<?php echo $_GET["Id"]; ?>">
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" placeholder="Your email address.." required>
    <label for="subject">Subject</label>

    <input type="text" id="subject" name="subject" placeholder="Subject.." required>
  
    <label for="content">Content</label>
    <textarea id="content" name="content" placeholder="Write your message here.." required></textarea>
  
    <input type="submit" value="Submit" name="submit">
</form>
    <?php 
    if ($error) {
        echo '<p>' . $error . '</p>';
    }
    ?>
</body>
</html>
