<?php
include('config.php');
$doctor_list_sql = "SELECT u.first_name,u.last_name,u.phone_number,u.email_address, dd.specialization, dd.consultancy_fee
FROM users AS u
LEFT JOIN doctor_details AS dd ON dd.user_id = u.id
WHERE u.role_id = 2";
$doctor_list = $db->query($doctor_list_sql);

$appointment_hist_sql="SELECT u.first_name,u.last_name,u.phone_number,a.id,a.time,a.date,a.status,dd.consultancy_fee 
FROM appointment AS a
LEFT JOIN users AS u ON u.id=a.d_id
LEFT JOIN doctor_details AS dd ON dd.user_id = a.d_id
WHERE a.patient_id='". $_SESSION["id"] . "';";

$appointment_hist=$db->query($appointment_hist_sql);


$doctor_select_sql = "SELECT `id`,`first_name`,`last_name` FROM users WHERE role_id=2";
$doctor_select = $db->query($doctor_select_sql);

$pres_list_sql="SELECT a.id,a.patient_id,a.d_id,a.date,a.time,p.Disease,p.Allergy,p.Medicine 
FROM prescriptions As p
LEFT JOIN appointment AS a ON p.a_id=a.id
WHERE a.patient_id='". $_SESSION["id"] . "'";
$pres_list=$db->query($pres_list_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal</title>
    <link rel="stylesheet" href="PatientPortal.css">
    <script src="PatientPortal.js"></script>
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
        <a href="#" id="DL" onclick="DL()">Available Doctors</a>
        <a href="#" id="BMA" onclick="BMA()">Book My Appointment</a>
        <a href="#" id="P" onclick="P()">Prescription</a>
        <a href="#" id="AH" onclick="AH()" style="border-bottom: 2px #818181 solid ;">Appointment History</a>
    </div>
    <div class="dash" id='dash'>
    <a href="#" id="DL" onclick="DL()"><span id="doclist" style="float: left;"><i class="fas fa-file-medical" aria-hidden="true" style="font-size:32px;"></i>
                <p>Available Doctors</p>
            </span></a>
        <a href="#" id="BMA" onclick="BMA()"><span id="App" style="float: left;"><i class="fas fa-list-alt" aria-hidden="true" style="font-size:32px;"></i>
                <p>Book My Appointment</p>
            </span></a>
        <a href="#" id="P" onclick="P()"><span id="Pre" style="float: left;"><i class="fas fa-file-medical" aria-hidden="true" style="font-size:32px;"></i>
                <p>Prescription</p>
            </span></a>
        <a href="#" id="AH" onclick="AH()"><span id="His" style="float: left;"><i class="fas fa-history" aria-hidden="true" style="font-size:32px;"></i>
                <p>Appointment History</p>
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
            <td align="left"colspan="4">--------------------------------------------------------------------------------------------------------------------------------------------</td>
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
    <div class="appointment" id='appointment' style="width:60%; margin-left: 30em;margin-top:6em; display:none;">
        <form style="border: 2px solid #818181;" action="create_appointment.php" method="POST">
            <table width=100% style="text-align: left; font-size: 22px;padding-top:15px;padding-bottom: 15px;padding-left: 15px;">
                <tr>
                    <th>

                    </th>
                    <th style="font-size: 34px; text-align:left;color: deepskyblue;padding-top: 0.5em;padding-bottom: 1em;">
                        Create an Appointment
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Doctors:
                    </th>
                    <th>
                        <select id="doctorsavailable" name="doctorid" style="font-size: 20px;width:91%;">
                            <option value="">Choose A Doctor</option>
                            
                            <?php
                                if ($doctor_select->num_rows > 0) {
                                    // output data of each row
                                    while ($row2 = $doctor_select->fetch_assoc()) {
                                        echo '
                                        <option value='.$row2["id"].'>'. $row2["first_name"] . ' ' . $row2["last_name"] .'</option>
                                        ';
                                    }
                                } else {
                                    echo '<tr>
                                        <td style="padding-right:12px;" colspan="4">No Doctors </td>
                                    </tr>';
                                }
                            ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>
                        Date:
                    </th>
                    <th>
                        <input type="date" name='date' style="font-size: 20px;width:90%;">
                    </th>
                </tr>
                <tr>
                    <th>
                        Time:
                    </th>
                    <th>
                        <input type="time"  name='time' style="font-size: 20px;width:90%;">
                    </th>
                </tr>
                <tr >
                    <th>
                <input type="hidden" name="form_submitted" value="1" />
                <center><p><input type="submit" value="Register" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></p></center>
                </tr>
            </table>
        </form>
    </div>
    <div class="prescription" style="width:70%; margin-left: 25em;margin-top:6em;display: none;">
        <table width=100% style="text-align: center; font-size: 22px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;">Doctor Name</th>
                <th style="padding-right:12px;">Appointmnet Id</th>
                <th style="padding-right:12px;">Date</th>
                <th style="padding-right:12px;">Time</th>
                <th style="padding-right:12px;">Disease</th>
                <th style="padding-right:12px;">Allergy</th>
                <th style="padding-right:12px;">Prescription</th>
            </tr>
            </tr>
            <td align="left"colspan="7">-------------------------------------------------------------------------------------------------------------------------------------------</td>
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
    <div class="history" style="width:70%; margin-left: 25em;margin-top:6em;display: none;">
        <table width=100% style="text-align: center; font-size: 22px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;width:15% ;">Doctor Name</th>
                <th style="padding-right:12px;width:18%;">Appointment ID</th>
                <th style="padding-right:12px;">Fees</th>
                <th style="padding-right:12px;">Date</th>
                <th style="padding-right:12px;">Time</th>
                <th style="padding-right:12px;">Phn No.</th>
                <th style="padding-right:12px;">Action</th>
            </tr>
            <style>
            td, th {
                padding: 8px;
            }

            </style>
            </tr>
            <td align="left"colspan="8">------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($appointment_hist->num_rows > 0) {
                // output data of each row
                while ($row = $appointment_hist->fetch_assoc()) {
                    if($row["status"]==0){
                    echo '
                        <td style="padding-right:12px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row["consultancy_fee"] . '</td>
                        <td style="padding-right:12px;">' . $row["date"] . '</td>
                        <td style="padding-right:12px;">' . $row["time"] . '</td>
                        <td style="padding-right:12px;">' . $row["phone_number"] . '</td>
                        <td style="padding-right:12px;"><a href="#" style="text-decoration: none;background-color:powderblue;;border-radius:2px;padding:5px;color:black;">Booked</a></td>
                    </tr>';
                    }
                    elseif($row["status"]==-1)
                    {
                        echo '
                        <td style="padding-right:12px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row["consultancy_fee"] . '</td>
                        <td style="padding-right:12px;">' . $row["date"] . '</td>
                        <td style="padding-right:12px;">' . $row["time"] . '</td>
                        <td style="padding-right:12px;">' . $row["phone_number"] . '</td>
                        <td style="padding-right:12px;"><a href="#" style="text-decoration: none;background-color:purple;;border-radius:2px;padding:5px;color:black;">Cancelled By Doctor</a></td>
                    </tr>';
                    }
                    else{
                        echo '
                        <td style="padding-right:12px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="padding-right:12px;">' . $row["id"] . '</td>
                        <td style="padding-right:12px;">' . $row["consultancy_fee"] . '</td>
                        <td style="padding-right:12px;">' . $row["date"] . '</td>
                        <td style="padding-right:12px;">' . $row["time"] . '</td>
                        <td style="padding-right:12px;">' . $row["phone_number"] . '</td>
                        <td style="padding-right:12px;"><a href="#" style="text-decoration: none;background-color:powderblue;;border-radius:2px;padding:5px;color:black;">Prescribed</a></td>
                    </tr>';
                    }
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