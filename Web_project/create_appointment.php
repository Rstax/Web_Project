<?php
include('config.php');
if (isset($_POST['form_submitted'])) {
    $doctor_id=$_POST['doctorid'];
    $app_date=$_POST['date'];
    $app_time=$_POST['time'];

    $sql = "INSERT INTO `appointment`(`patient_id`, `d_id`, `date`, `time`,`status`) 
    VALUES ('" . $_SESSION["id"] . "','" . $doctor_id . "','" . $app_date . "','" . $app_time . "',0)";

    if ($db->query($sql) === TRUE) {
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Doctor Deleted Successfully');
                window.location.href='PatientPortal.php';
                </script>");  
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    $_POST['form_submitted']=0;
}
?>