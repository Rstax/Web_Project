<?php
include('config.php');
$id = $_GET['id']; 
$_SESSION['a_id']=$id;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="adddoctor" style="width:60%; margin-left: 5em;margin-top:6em;;margin-bottom:2em;">
        <form style="border: 2px solid #818181;" action="add_pres.php" method="POST">
            <table width=100% style="text-align: left; font-size: 22px;padding-top:15px;padding-left: 15px;">
                <tr>
                    <th>
                    </th>
                    <th style="font-size: 34px; text-align:left;color: deepskyblue;padding-top: 0.5em;padding-bottom: 1em;">
                        Prescribe
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Disease
                    </th>
                    <th>
                        <input type="text" cols="30" rows="10" style="font-size: 20px;width:89%;" name="disease" placeholder="Disease">
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Allergy
                    </th>
                    <th>
                        <input type="text" style="font-size: 20px;width:89%;" name="allergy" placeholder="Allergies">
                    </th>
                </tr>
                <tr>
                    <th style="width:35%;">
                        Medicines
                    </th>
                    <th>
                    <textarea name="medicines" id="Med"  style="font-size: 20px;" placeholder="Medicines and time to take" cols="44" rows="5"></textarea>
                    </th>
                </tr>
                <tr>
                    <th>
                        <input type="hidden" name="pres_form_submitted" value="1" />
                        <center>
                            <p><input type="submit" value="Prescribe" style="font-size:22px; background-color:rgb(206, 69, 216);color:white;border:0px;border-radius:5px"></p>
                            <td style="width:25%;padding-bottom:10px;"><a href="DoctorPortal.php" style="text-decoration: none;background-color:red;;border-radius:5px;padding:3px;color:white;">Cancel</a></td>
                        </center>
                </tr>
                </th>
            </table>
        </form>
    </div>
</body>
</html>