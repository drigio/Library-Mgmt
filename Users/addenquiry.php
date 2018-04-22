<?php

session_start();
require 'db.php';

if(isset($_POST['mobile'])) {
    $fname = $mysqli->escape_string($_POST["fname"]);
    $lname = $mysqli->escape_string($_POST["lname"]);
    $address = $mysqli->escape_string($_POST["address"]);
    $mobile = $mysqli->escape_string($_POST["mobile"]);
    $email = $mysqli->escape_string($_POST["email"]);
    $studytype = $mysqli->escape_string($_POST["studytype"]);
    
    $sql = "INSERT INTO enquiry (fname,lname,address,mobile,email,studytype) VALUES ('$fname','$lname','$address','$mobile','$email','$studytype')";
    
    if($mysqli->query($sql)) {
        echo "<script>alert('Enquiry Added Successfully'); </script>";
        header("refresh:0;url=enquiry.php");
    } else {
        echo "<script>alert('Enquiry Not Added Successfully'); </script>";
        header("refresh:0;url=enquiry.php");
    }
}
else 
{
    echo "<script>alert('Error While Processing Enquiry'); </script>";
    header("refresh:0;url=enquiry.php");
}

?>