<?php
include "config.php"; 
$id = $_GET['id']; 
    echo '<center><div style="width:35%;background-color:rgb(204, 255, 255);margin-top:10em;border:2px solid black;"><h2>Cancel the appointment?</h2>
    <p>
    <form action="" method="post" style="float:left;padding-left:8em;">
    <input type="hidden" name="delete_yes" value="1" />
    <input type="submit" value="Yes!" style="font-size:22px;background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px">   
    </form>
    <form action="" method="post" ><input type="hidden" name="delete_no" value="1" />
    <input type="submit" value="No!" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></div></p>
    </form></div>
    </center>';
if(isset($_POST['delete_yes']))
    { 
        $query1="UPDATE appointment SET `status`=-1 WHERE id='".$id."';";
        $db->query($query1);
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Appointment Cancelled Successfully');
                window.location.href='DoctorPortal.php';
                </script>");  
    }
if(isset($_POST['delete_no']))
    {
        header('Location: DoctorPortal.php');
    }

?>