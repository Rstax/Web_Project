<?php 
include('config.php');
if(isset($_POST["delete_doctor_form"]))
{
    $email=$_POST['doctor_email'];
    $doctor_available_sql="SELECT * FROM users WHERE `email_address`='".$email."';";
    $doctor_available=$db->query($doctor_available_sql);
    if($doctor_available->num_rows<1)
    {
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Sorry no such doctor was found');
                window.location.href='Admin.php';
                </script>");
    }
    else{
        $coun=0;
        $info = $doctor_available -> fetch_array(MYSQLI_ASSOC);
        $_SESSION["doctor_id"]=$info['id'];
        echo '<center><div style="width:35%;background-color:rgb(204, 255, 255);margin-top:10em;border:2px solid black;"><h2> Are you sure you wanto to delete the doctor?</br>Email Address:<span style="color:red;"> '."$email".' </span></h1>
        <p>
        <form action="" method="post" style="float:left;padding-left:8em;">
        <input type="hidden" name="delete_yes" value="1" />
        <input type="submit" value="Yes!" style="font-size:22px;background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px">
        </form>
        <form action="" method="post" ><input type="hidden" name="delete_no" value="1" />
        <input type="submit" value="No!" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></div></p>
        </form></div>
        </center>';
        }
    }
    if(isset($_POST['delete_yes']))
        { 
            $del_doctor_details="DELETE FROM doctor_details WHERE `user_id`='".$_SESSION["doctor_id"]."'";
            $del_doctor_users="DELETE FROM users WHERE `id`='".$_SESSION['doctor_id']."'";
            $db->query($del_doctor_details);
            $db->query($del_doctor_users);
            unset($_SESSION['doctor_id']);
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Doctor Deleted Successfully');
                    window.location.href='Admin.php';
                    </script>");  
        }
        if(isset($_POST['delete_no']))
        {
            unset($_SESSION['doctor_id']);
            header('Location: Admin.php');
        }

?>