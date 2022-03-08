<?php
include('config.php');
if (isset($_POST['form_submitted'])) {
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_message = $_POST['c_message'];
    $sql = "INSERT INTO `contact_us`(`c_name`, `c_email`, `c_message`) VALUES (
        '" . $c_name . "','" . $c_email . "','" . $c_message . "')";
    if ($db->query($sql) === TRUE) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Meesage Sent');
        window.location.href='homepage.php';
        </script>");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Contactus.css">
</head>
<body>
    <div class="topnav" >
        <a href="homepage.php">Home</a>
        <a href="PatientLogin.php">Login</a>
        <a href="Aboutus.php">About Us</a>
        <a href="Contactus.php">Contact Us</a>
    </div>
    <div class="d1">
    <h2>Please get in touch and our expert suport will answer all your questions.</h2></div>
    <div>
        <form action="" style="background-color: aquamarine;width: 40%;margin: auto; padding-left: 40px;padding-top: 20px;" method="POST">
            <div class="d4">Full Name*</div>
            <div class="d2"><input type="text" name="c_name" placeholder="Full name"></div>
            <div class="d4">Email*</div>
            <div class="d2"><input type="email" name="c_email" placeholder="Email"></div>
            <div class="d4">Enter your message</div>
            <div class="d2"><textarea name="c_message" id="message" cols="30" rows="10"></textarea></div>
            <input type="hidden" name="form_submitted" value="1" />
            <button type="Submit">Send message</button>
        </form>
    </div>
</body>
</html>