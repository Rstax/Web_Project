<?php
include('config.php');
$doctor_list_sql = "
SELECT u.first_name,u.last_name,u.phone_number,u.email_address, dd.specialization, dd.consultancy_fee
FROM users AS u
LEFT JOIN doctor_details AS dd ON dd.user_id = u.id
WHERE u.role_id = 2";
$doctor_list = $db->query($doctor_list_sql);

$patient_list_sql="SELECT * FROM users Where role_id=3";
$patient_list=$db->query($patient_list_sql);

$appointment_list_sql="SELECT * FROM appointment";
$appointment_list=$db->query($appointment_list_sql);

$pres_list_sql="SELECT a.id,a.patient_id,a.d_id,a.date,a.time,p.Disease,p.Allergy,p.Medicine 
FROM prescriptions As p
LEFT JOIN appointment AS a ON p.a_id=a.id;";
$pres_list=$db->query($pres_list_sql);

$query_list_sql="SELECT * FROM contact_us";
$query_list=$db->query($query_list_sql);

if (isset($_POST['doctor_form_submitted'])) {
    $first_name = $_POST['First_Name'];
    $last_name = $_POST['Last_Name'];
    $email_address = $_POST['Email_address'];
    $specialization = $_POST['Specialization'];
    $phno=$_POST['phoneno'];
    $fee = $_POST['fee'];
    $password = md5($_POST['Password']);
    $role_id = 2;
    $gender = $_POST['gender'];
    $sql = "INSERT INTO `users`(`email_address`, `first_name`, `last_name`, `gender`, `password` ,`role_id`,`phone_number`) VALUES (
        '" . $email_address . "','" . $first_name . "','" . $last_name . "'," . $gender . ",'" . $password . "'," . $role_id . ",'" . $password . "');";
    if ($db->query($sql) === TRUE); {
        echo "Data Written Successfully";
    }
    $retrieve = "SELECT id FROM users where `role_id`=2 && `email_address`='" . $email_address . "' && `password` = '" . $password . "'";
    $result = $db->query($retrieve);
    $obj = $result->fetch_object();
    $sql2 = "INSERT INTO `doctor_details`(`user_id`,`specialization`,`consultancy_fee`) VALUES (" . $obj->id . ",'" . $specialization . "'," . $fee . ")";

    if ($db->query($sql2) === TRUE) {
        echo '<script>alert("Data Successfully Written into Database");</script>';
        header('Location: Admin.php');
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
    <title>Admin Page</title>
    <link rel="stylesheet" href="Admin.css">
    <script src="Admin.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="topnav">
        <i class="fa fa-heartbeat" aria-hidden="true" style="font-size:32px;"></i>
        <span id="HealthCare">HealthCare System</span>
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        <a href="homepage.php">LogOut</a>
    </div>
    <p id="user">
        Welcome <?php echo ($_SESSION["name"]); ?>
    </p>
    <div id="mySidenav" class="sidenav">
        <a href="#" id="dashboard" onclick="D()">DashBoard</a>
        <a href="#" id="doctorlist" onclick="DL() ">Doctor List</a>
        <a href="#" id="adddoctor" onclick="AD()">Add Doctor</a>
        <a href="#" id="deldoctor" onclick="DD()">Delete Doctor</a>
        <a href="#" id="appointment" onclick="A()">Appointment Details</a>
        <a href="#" id="patient" onclick="PL()">Patient List</a>
        <a href="#" id="P" onclick="P()">Prescription List</a>
        <a href="#" id="queries" onclick="Q()" style="border-bottom: 2px #818181 solid ;">Queries</a>
    </div>
    <div class="dash" id='dash'>
        <a href="#" class="doctorlist" onclick="DL()"><span class="doctorlist" style="float: left;"><i class="fas fa-notes-medical" aria-hidden="true" style="font-size:50px;"></i>
                <p>Doctor List</p>
            </span></a>
        <a href="#" class="adddoctor" onclick="AD()"><span class="adddoctor" style="float: left;"><i class="fas fa-hospital-user" aria-hidden="true" style="font-size:50px;"></i>
                <p>Add Doctor</p>
            </span></a>
        <a href="#" class="deldoctor" onclick="DD()"><span class="deldoctor" style="float: left;"><i class="fas fa-user-minus" aria-hidden="true" style="font-size:50px;"></i>
                <p>Delete Doctor</p>
            </span></a>
        <a href="#" class="appointment" onclick="A()"><span class="appointment" style="float: left;"><i class="fas fa-list-alt" aria-hidden="true" style="font-size:50px;"></i>
                <p>Appointment Details</p>
            </span></a>
        <a href="#" class="patient" onclick="PL()"><span class="patient" style="float: left;"><i class="fas fa-file-medical" aria-hidden="true" style="font-size:50px;"></i>
                <p>Patient List</p>
            </span></a>
        <a href="#" class="P" onclick="P()"><span class="P" style="float: left;"><i class="fas fa-prescription-bottle-alt" aria-hidden="true" style="font-size:50px;"></i>
                <p>Prescription List</p>
            </span></a>
    </div>
    <div class="doctorlist" style="width:70%; margin-left: 25em;margin-top:6em;display: none;">

        <table width=100% style="text-align: center; font-size: 22px;margin-top:1em;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;">Doctor Name</th>
                <th style="padding-right:12px;">Specialization</th>
                <th style="padding-right:12px;">Email</th>
                <th style="padding-right:12px;">Fees</th>
            </tr>
            </tr>
            <td align="left"colspan="4">----------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($doctor_list->num_rows > 0) {
                // output data of each row
                while ($row = $doctor_list->fetch_assoc()) {
                    echo '<tr>
                        <td style="padding-right:12px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row["specialization"] . '</td>
                        <td style="padding-right:12px;">' . $row["email_address"] . '</td>
                        <td style="padding-right:12px;">' . $row["consultancy_fee"] . '</td>
                    </tr>';
                }
            } else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">0 Doctors Found</td>
                </tr>';
            }
            ?>
        </table>
    </div>
    <div class="adddoctor" style="width:60%; margin-left: 30em;margin-top:6em;display: none;margin-bottom:2em;">
        <form style="border: 2px solid #818181;" action="" method="POST">
            <table width=100% style="text-align: left; font-size: 22px;padding-top:15px;padding-left: 15px;">
                <tr>
                    <th>

                    </th>
                    <th style="font-size: 34px; text-align:left;color: deepskyblue;padding-top: 0.5em;padding-bottom: 1em;">
                        Add A Doctor
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Full Name
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:41%;padding-right:25px;" placeholder="First Name" name="First_Name">
                        <input type="text" style="font-size: 20px;width:41%;" placeholder="Last Name" name="Last_Name">
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Email
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:89%;" name="Email_address" placeholder="Email Address">
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Phone Number
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:89%;" name="phoneno" placeholder="Phn No.">
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Specialization
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:89%;" name="Specialization" placeholder="Specialization">
                    </th>
                </tr>
                <tr>
                    <th>
                        Consultancy Fee
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:89%;" name="fee" placeholder="Fees">
                    </th>
                </tr>
                <tr>
                    <th>
                        Password
                    </th>
                    <th>
                        <input type="password" style="font-size: 20px;width:89%;" name="Password" placeholder="Password">
                    </th>
                </tr>
                <tr>
                    <th>
                        Confirm Password
                    </th>
                    <th>
                        <input type="password" style="font-size: 20px;width:89%;" placeholder="Re-type Password">
                    </th>
                </tr>
                <tr>
                    <th>
                        Gender
                    </th>
                    <th style="font-size: 20px ;">
                        <input type="radio" id="male" name="gender" value="1">
                        <label for="male">Male</label><br>
                    </th>
                </tr>
                <tr>
                    <th>

                    </th>
                    <th style="font-size: 20px ;">
                        <input type="radio" id="female" name="gender" value="2">
                        <label for="female">Female</label>
                    </th>
                </tr>
                <tr>
                    <th>
                        <input type="hidden" name="doctor_form_submitted" value="1" />
                        <center>
                            <p><input type="submit" value="Register" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></p>
                        </center>
                </tr>
                </th>
            </table>
        </form>
    </div>
    <div class="deldoctor" style="width:70%; margin-left: 25em;margin-top:6em;display:none;">
        <h1>Delete Doctor</h1>
        <p>Enter Email Id of Doctor you want to delete</p>
        <form action="delete_doctor.php" method="post">
        <input type="email" name="doctor_email" style="font-size: 20px;width:70%;" placeholder="Email Id">
        <input type="hidden" name="delete_doctor_form" value="1" />
        <p><input type="submit" value="Delete" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></p>
        </form>
    </div>
<div class="appointment" style="width:70%; margin-left: 25em;margin-top:6em;padding-right: 2em;display: none;">
        <table width=100% style="text-align: center; font-size: 20px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;width:10%;">Appointment ID</th>
                <th style="padding-right:12px;">Patient Name</th>
                <th style="padding-right:12px;">Contact</th>
                <th style="padding-right:12px;">Email</th>
                <th style="padding-right:12px;">Doctor Name</th>
                <th style="padding-right:12px;">Fees</th>
                <th style="padding-right:12px;">Date</th>
                <th style="padding-right:12px;">Time</th>
                <th style="padding-right:12px;">Status</th>
            </tr>
            </tr>
            <td align="left"colspan="9">------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($appointment_list->num_rows > 0) {
                while ($row = $appointment_list->fetch_assoc()) {
                    if($row['status']==1)
                    {
                        $act="Prescribed";
                    }
                    elseif($row['status']==0)
                    {
                        $act="Booked";
                    }
                    else {
                        $act="Cancelled";
                    }
                    $patient_app_details="SELECT * FROM users where `id`='".$row["patient_id"]."'";
                    $doctor_app_details = "SELECT u.first_name,u.last_name, dd.consultancy_fee
                    FROM users AS u
                    LEFT JOIN doctor_details AS dd ON dd.user_id = u.id
                    WHERE u.id = '".$row["d_id"]."'";
                    
                    $temp1=$db->query($patient_app_details);
                    $temp2=$db->query($doctor_app_details);
                    $row2=$temp1->fetch_assoc();
                    $row3=$temp2->fetch_assoc();
                    echo '<tr>
                        <td style="padding-right:12px;width:10%;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row2["first_name"] . ' ' . $row2["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row2["phone_number"] . '</td>
                        <td style="padding-right:12px;">' . $row2["email_address"] . '</td>
                        <td style="padding-right:12px;">' . $row3["first_name"] . ' ' . $row3["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row3["consultancy_fee"] . '</td>
                        <td style="padding-right:12px;">' . $row["date"] . '</td>
                        <td style="padding-right:12px;">' . $row["time"] . '</td>
                        <td style="padding-right:12px;">' . $act . '</td>
                    </tr>';
                }
            } else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">No Appointments Found</td>
                </tr>';
            }
            ?>
        </table>
    </div>
    <div class="patient" style="width:70%; margin-left: 25em;margin-top:6em;display: none;">
        <table width=100% style="text-align: center; font-size: 22px;margin-top:1em;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;">Patient ID</th>
                <th style="padding-right:12px;">Name</th>
                <th style="padding-right:12px;">Gender</th>
                <th style="padding-right:12px;">Email</th>
                <th style="padding-right:12px;">Contact</th>
            </tr>
            </tr>
            <td align="left"colspan="5">--------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($patient_list->num_rows > 0) {
                // output data of each row
                while ($row = $patient_list->fetch_assoc()) {
                    if($row["gender"]==1)
                    $gen="Male";
                    else
                    $gen="Female";
                    echo '<tr>
                        <td style="padding-right:12px;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $gen . '</td>
                        <td style="padding-right:12px;">' . $row["email_address"] . '</td>
                        <td style="padding-right:12px;">' . $row["phone_number"] . '</td>
                    </tr>';
                }
            } else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">0 Doctors Found</td>
                </tr>';
            }
            ?>
        </table>

    </div>
    <div class="P" style="width:70%; margin-left: 25em;margin-top:6em;padding-right: 2em;display: none;">
        <table width=100% style="text-align: center; font-size: 20px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;width:10%;">Doctor Name</th>
                <th style="padding-right:12px;width:10%;">Appointment ID</th>
                <th style="padding-right:12px;width:10%;">Patient Name</th>
                <th style="padding-right:12px;width:10%;">Date</th>
                <th style="padding-right:12px;width:10%;">Time</th>
                <th style="padding-right:12px;width:10%;">Disease</th>
                <th style="padding-right:12px;width:10%;">Allergy</th>
                <th style="padding-right:12px;width:10%;">Prescribe</th>
            </tr>
            </tr>
            <td align="left"colspan="8">----------------------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($pres_list->num_rows > 0) {
                while ($row = $pres_list->fetch_assoc()) {
                    $patient_app_details="SELECT * FROM users where `id`='".$row["patient_id"]."'";
                    $doctor_app_details = "SELECT u.first_name,u.last_name
                    FROM users AS u
                    LEFT JOIN doctor_details AS dd ON dd.user_id = u.id
                    WHERE u.id = '".$row["d_id"]."'";
                    
                    $temp1=$db->query($patient_app_details);
                    $temp2=$db->query($doctor_app_details);
                    $row2=$temp1->fetch_assoc();
                    $row3=$temp2->fetch_assoc();
                    echo '<tr>
                        <td style="padding-right:12px;">' . $row3["first_name"] . ' ' . $row3["last_name"] . '</td>
                        <td style="padding-right:12px;width:10%;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row2["first_name"] . ' ' . $row2["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row["date"] . '</td>
                        <td style="padding-right:12px;">' . $row["time"] . '</td>
                        <td style="padding-right:12px;">' . $row["Disease"] . '</td>
                        <td style="padding-right:12px;">' . $row["Allergy"] . '</td>
                        <td style="padding-right:12px;">' . $row["Medicine"] . '</td>
                    </tr>';
                }
            } else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">No Prescription Found</td>
                </tr>';
            }
            ?>
        </table>
    </div>
    <div class="queries" style="width:70%; margin-left: 25em;margin-top:6em;padding-right: 2em;display: none;">
        <table width=100% style="text-align: center; font-size: 20px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;width:10%;">User Name</th>
                <th style="padding-right:12px;width:10%;">Email</th>
                <th style="padding-right:12px;width:20%;">Message</th>
            </tr>
            </tr>
            <td align="left"colspan="4">----------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($query_list->num_rows > 0) {
                // output data of each row
                while ($row = $query_list->fetch_assoc()) {
                    echo '<tr>
                        <td style="padding-right:12px;width:10%;">' . $row["c_name"] . '</td>
                        <td style="padding-right:12px;width:10%;">' . $row["c_email"] . '</td>
                        <td style="padding-right:12px;width:20%;">' . $row["c_message"] . '</td>
                    </tr>';
                }
            } else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">0 Doctors Found</td>
                </tr>';
            }
            ?>
        </table>
    </div>
</body>