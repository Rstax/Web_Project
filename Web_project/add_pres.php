<?php
include('config.php');
if (isset($_POST['pres_form_submitted'])) {
    $disease=$_POST['disease'];
    $allergy=$_POST['allergy'];
    $medicine=$_POST['medicines'];
    $sql = "INSERT INTO `prescriptions`(`a_id`, `Disease`, `Allergy`, `Medicine`) VALUES ('" . $_SESSION['a_id'] . "','" . $disease . "','" . $allergy . "','" . $medicine . "');";
    $sql2="UPDATE appointment SET `status`=1 WHERE `id`='".$_SESSION['a_id']."' ";
    if ($db->query($sql) === TRUE && $db->query($sql2)) {
        unset($_SESSION['a_id']);
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Prescribed Successfully');
                window.location.href='DoctorPortal.php';
                </script>");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
?>