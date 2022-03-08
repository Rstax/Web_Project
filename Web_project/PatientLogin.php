<?php
include('config.php');
if (isset($_POST['form_submitted'])) {
    $email_address = $_POST['email_address'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE `role_id`=3 && `email_address`='" . $email_address . "' && `password` = '" . $password . "'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        $_SESSION["name"] = $info['first_name'].$info['last_name'];
        $_SESSION["id"] = $info['id'];
        header('Location: PatientPortal.php');
    } else {
        echo '<script>alert("Invalid Password or Username");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="PatientLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<script type="text/javascript">
            function check(Form)
            {
                var email =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (email.test(Form.email_address.value))
                {
                    return(true);
                }
                else
                {
                    alert("You have entered an invalid email address!");
                    return (false);
                }
            }      
    </script>
    <div class="topnav">
        <i class="fa fa-heartbeat" aria-hidden="true" style="font-size:32px;"></i>
        <span id="HealthCare">HealthCare System</span>
        <a href="homepage.php">Home</a>
        <a href="Aboutus.php">About Us</a>
        <a href="Contactus.php">Contact Us</a>
    </div>
    <div class="midnav">
        <a href="PatientLogin.php">Patient</a>
        <a href="DoctorLogin.php">Doctor</a>
        <a href="AdminLogin.php">Admin</a>

        <h1 align="center">Patient Login</h1>
        <center>
            <form style="margin-top: 0%;padding-top: 0%;" action="" method="POST" onsubmit="return check(this)">
                <table border="0" width="550">
                    <tr>
                        <th align="left" colspan="8" style="font-size: 18px;padding-bottom: 20px;">UserName:<br><input type="text" required="" name="email_address" id="Text" placeholder=" Username"></th>
                    </tr>
                    <tr>
                        <th align="left" colspan="8" style="font-size: 18px;"> Password:<br><input type="password" required="" name="password" id="Password" placeholder=" Password"><br>
                            <a id="Forgot" href="ForgotPassword.html">Forgot Password?</a>
                        </th>
                    </tr>
                    <tr></tr>
                </table>
                <input type="hidden" name="form_submitted" value="1" />
                <p  id="sub"><input type="submit" value="Login" ></p><br><br>
            </form>
        </center>
        <span style="padding: 0.2em 30px 0.2em 0px; font-size:25px; font-weight: 600; padding-left: 25%;float: left;">Register as new Patient?</span>
        <a id="Register" style=" float:left;" href="PatientSignup.php">Sign Up</a>
    </div>
</body>