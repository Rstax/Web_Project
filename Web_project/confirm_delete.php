<?php
include('config.php');
if(isset($_POST['delete_yes']))
    { 
        $email=$_POST['doctor_email'];
        $doctor_available_sql="SELECT * FROM users WHERE `email_address`='".$email."';";
        $doctor_available=$db->query($doctor_available_sql);
        $del1 = $doctor_available->fetch_assoc();
        $doctor_id=$del['id'];
        $del_doctor_details="DELETE FROM doctor_details WHERE `user_id`=$doctor_id";
        $del_doctor_users="DELETE FROM users WHERE `id`=$doctor_id";
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Doctor Deleted Successfully');
                window.location.href='Admin.php';
                </script>");  
    }
?>