<?php
include('config.php');
if (isset($_POST['form_submitted'])) {
    $first_name = $_POST['First_Name'];
    $last_name = $_POST['Last_Name'];
    $email_address = $_POST['Email'];
    $phone_number = $_POST['Phone_Number'];
    $password = md5($_POST['Password']);
    $gender = $_POST['Gender'];
    $sql = "INSERT INTO `users`(`email_address`, `first_name`, `last_name`, `phone_number`, `gender`, `password`) VALUES (
        '" . $email_address . "','" . $first_name . "','" . $last_name . "','" . $phone_number . "'," . $gender . ",'" . $password . "'
        )";

    if ($db->query($sql) === TRUE) {
        echo '<script>alert("Successfully Registered");</script>';
        header('Location: PatientLogin.php');
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
    <title>signup</title>
    <link rel="stylesheet" href="PatientSignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<script type="text/javascript">
            function check(Form)
            {
                var email =/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var password1=Form.Password.value;
                var password2=Form.Confirm_Password.value;
                var count=0;
                if(password1 != password2)
                {
                    alert("Pass and Confirm Pass should match");
                    return(false);
                }
                if (email.match(Form.email_address.value)!=TRUE)
                {
                    alert("You have entered an invalid email address!");
                    return(false);
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
        <a href="PatientSignup.php">Patient</a>
        <a href="DoctorLogin.php">Doctor</a>
        <a href="AdminLogin.php">Admin</a>
    </div>
    <h1 align="center" style="padding-right: 3em;">Register as Patient</h1>
    <div class="Form">
        <center>
            <form action="PatientSignup.php" method="POST" name="form1" onsubmit="return check(this)">
                <table border="0" width="550">
                    <tr>
                        <th align="left" colspan="8"><br><input type="text" required="" name="First_Name" id="First Name " placeholder="   First name"></th>
                        <th align="left" colspan="3"><br><input type="text" required="" name="Last_Name" id="Last Name " placeholder="   Last name"></th>
                    </tr>
                    <tr>
                        <th align="left" colspan="8"> <br><input type="email" required="" name="Email" id="Email" placeholder="   Email"></th>
                        <th align="left" colspan="3"> <br><input type="number" required="" name="Phone_Number" id="Phone Number" placeholder="   Phone Number"></th>
                    </tr>
                    <tr>
                        <th align="left" colspan="8"><br><input type="password" required="" name="Password" id="Password" placeholder="   Password"></th>
                        <th align="left" colspan="3"><br><input type="password" required="" name="Confirm_Password" id="Confirm_Password" placeholder="   Confirm password"></th>
                    </tr>
                    <tr>
                        <th align="left" id="Radio">
                            <input type="radio" id="male" name="Gender" value="1" required="">
                            <label for="male">Male</label><br>
                        </th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="left">
                            <input type="radio" id="female" name="Gender" value="2" required="">
                            <label for="female">Female</label><br>
                        </th>
                    </tr>
                </table>
                <input type="hidden" name="form_submitted" value="1" />
                <p><input type="submit" value="Register" id="sub"></p><br><br>
            </form>
            <span style="padding-right: 20%;"></span>
            <a href="PatientLogin.php">Already have an account?</a>
        </center>
    </div>

</body>

</html>