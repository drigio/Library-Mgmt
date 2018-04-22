<?php
require 'db.php';
session_start();
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newFirstName = $_POST['fname'];
    $newLastName = $_POST['lname'];
    $mobile = $_SESSION['mobile'];
    
    $sql = "UPDATE users SET firstName='$newFirstName',lastName='$newLastName' WHERE mobile='$mobile'";
    
    if($mysqli->query($sql)) {
        
        $_SESSION['message'] = "Your details has been updated successfully!";
        phpAlert("Password Reset");
        header("location: logout.php");    
    }
    else {
        $_SESSION['message'] = "Some Error Occured!";
        header("location: error.php");    
    }
}