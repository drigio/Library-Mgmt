<?php
session_start();
require 'db.php';

if(isset($_SESSION['total'])) {
    
     $memId = $_SESSION['memId'];
     $paymentType = $_SESSION['paymentType'];
     $userId = $_SESSION['userId'];
     $paymentDate = $_SESSION['paymentDate'];
     $validUntil = $_SESSION['validUntil'];
    $recieptid = $_SESSION['recieptno'];
    
    //Final Fees
    $sql = "INSERT INTO payments(paymentId,memId,paymentType,paymentDate,validUntil,userId)".
        "VALUES ('$recieptid','$memId','$paymentType','$paymentDate','$validUntil','$userId')";
    
    $sql2 = "SELECT * from validity where memId = '$memId'";
    $result = $mysqli->query($sql2);
    if($result->num_rows <= 0) 
    {
        $sql3 = "INSERT INTO validity (paymentId,memId,validUntil)".
            "VALUES('$recieptid','$memId','$validUntil')";
        if($mysqli->query($sql) and $mysqli->query($sql3)){
            echo '<script>window.close();</script>';
        }else {
             echo '<script>alert("Fees Already Paid");</script>';
            echo '<script>window.close();</script>';
        }
    }
    else 
    {
        $sql4 = "UPDATE validity SET paymentId = '$recieptid' where memId = '$memId'";
        $sql5 = "UPDATE validity SET validUntil = '$validUntil' where memId = '$memId'";
        if($mysqli->query($sql4) and $mysqli->query($sql5) and $mysqli->query($sql))
        {
            echo '<script>alert("Fees Paid");</script>';
            echo '<script>window.close();</script>';
        }
        else {
             echo '<script>alert("Fees Already Paid");</script>';
            echo '<script>window.close();</script>';
        }
            
    }
    
}

 
?>
