<?php
include('config.php');
$ong_app_sql = "SELECT u.first_name,u.last_name,u.gender,u.phone_number,a.id,a.time,a.date,a.status
FROM appointment AS a
LEFT JOIN users AS u ON u.id=a.patient_id
WHERE a.d_id='". $_SESSION["id"] . "' and a.status=0;";
$ong_app = $db->query($ong_app_sql);


$app_history_sql="SELECT u.first_name,u.last_name,a.id,a.time,a.date,a.status
FROM appointment AS a
LEFT JOIN users AS u ON u.id=a.patient_id
WHERE a.status!=0 and a.d_id='". $_SESSION["id"] . "'; ";
$app_history=$db->query($app_history_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal</title>
    <link rel="stylesheet" href="DoctorPortal.css">
    <script src="DoctorPortal.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="topnav">
        <i class="fa fa-heartbeat" aria-hidden="true" style="font-size:32px;"></i>
        <span id="HealthCare">HealthCare System</span>
        <i class="fa fa-sign-out" aria-hidden="true" ></i>
        <a href="homepage.php">LogOut</a>
    </div>
    <p id="user">
        Welcome <?php echo ($_SESSION["name"]); ?>
    </p>
    <div id="mySidenav" class="sidenav">
        <a href="#" id="dashboard" onclick="D()" >DashBoard</a>
        <a href="#" id="BMA" onclick="BMA()">Ongoing Appointment</a>
        <a href="#" id="P" onclick="P()" style="border-bottom: 2px #818181 solid ;">Appointmnet History</a>
    </div>
    <div class="dash" id='dash'>
            <a href="#" id="BMA" onclick="BMA()"><span id="App" style="float: left;"><i class="fas fa-list-alt" aria-hidden="true" style="font-size:32px;"></i>
            <p>Ongoing Appointment</p></span></a>
            <a href="#" id="P" onclick="P()"><span id="Pre" style="float: left;"><i class="fas fa-file-medical" aria-hidden="true" style="font-size:32px;"></i>
            <p>Appointmnet History</p></span></a>
    </div>
    <div class="Appointment" style="width:70%; margin-left: 25em;margin-top:6em;display:none;">
        <table width=100% style="text-align: center; font-size: 22px;margin-top:1em;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="width:10%;padding-bottom:20px;">Appointment ID</th>
                <th style="width:10%;padding-bottom:20px;">Name</th>
                <th style="width:8%;padding-bottom:20px;">Gender</th>
                <th style="width:10%;padding-bottom:20px;">Contact</th>
                <th style="width:10%;padding-bottom:20px;">Date</th>
                <th style="width:10%;padding-bottom:20px;">Time</th>
                <th colspan="2" style="width:16%;padding-bottom:20px;">Action</th>
            </tr>
            </tr>
            <td align="left"colspan="8">----------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($ong_app->num_rows > 0) {
                // output data of each row
                while ($row = $ong_app->fetch_assoc()) {
                    if($row["gender"]==1)
                        $gender="Male";
                    else
                        $gender="Female";
                        echo '<tr>
                        <td style="width:10% ;padding-bottom:10px;">' . $row["id"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="width:8%;padding-bottom:10px;">' . $gender . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["phone_number"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["date"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["time"] . '</td>
                        <td style="width:8%;padding-bottom:10px;"><a href="prescribe.php?id='.$row['id'].'" style="text-decoration: none;background-color:powderblue;;border-radius:5px;padding:3px;color:black;">Prescribe</a></td>
                        <td style="width:8%;padding-bottom:10px;"><a href="app_cancel.php?id='.$row['id'].'" style="text-decoration: none;background-color:red;;border-radius:5px;padding:3px;color:white;">Cancel</a></td>
                    </tr>';
                    }
                }
             else {
                echo '<tr>
                    <td style="color:grey;" colspan="7">No Ongoing Apointments</td>
                </tr>';
            }
            ?>
        </table>
    </div>
    <div class="Appointmnet_History" style="width:70%; margin-left: 25em;margin-top:6em;display:none">
        <table width=100% style="text-align: center; font-size: 22px;padding-top:5px;padding-bottom: 10px;padding-left: 15px;border: 2px #818181 solid;">
            <tr>
                <th style="padding-right:12px;width:10%; ;">Appointment ID</th>
                <th style="padding-right:12px;width:10%;"> Name</th>
                <th style="padding-right:12px;width:10%; ;">Date</th>
                <th style="padding-right:12px;width:10%; ;">Time</th>
                <th style="padding-right:12px;width:15%; ;">Status</th>
            </tr>
            </tr>
            <td align="left"colspan="5">-------------------------------------------------------------------------------------------------------------------------------------------</td>
            </tr>
            <?php
            if ($app_history->num_rows > 0) {
                // output data of each row
                while ($row = $app_history->fetch_assoc()) {
                    
                    if($row["status"]==-1)
                        $temp="Appointment Cancelled";
                    else
                        $temp="Prescribed";
                        echo '<tr>
                        <td style="width:10% ;padding-bottom:10px;">' . $row["id"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["date"] . '</td>
                        <td style="width:10%;padding-bottom:10px;">' . $row["time"] . '</td>
                        <td style="width:15%;padding-bottom:10px;"><a href="#" style="text-decoration: none;background-color:powderblue;;border-radius:5px;padding:3px;color:black;">'.$temp.'</a></td>
                    </tr>';
                    }
                }
             else {
                echo '<tr>
                    <td style="padding-right:12px;" colspan="4">No History</td>
                </tr>';
            }
            ?>
        </table>
    </div>
</body>
