<?php 
    session_start();
    require 'db.php';

    if(!empty($_POST['profit'])) {
        $profit = $mysqli->escape_string($_POST['profit']);
        $date = date("Y-m-d");
        $userId = $_SESSION['userId'];
        
        
        if(isset($_POST['income'])) {
            $income = $mysqli->escape_string($_POST['income']);
            $incomename = $mysqli->escape_string($_POST['incomename']);
        }
        else {
            $income = 0;
            $incomename = "No";
        }
        if(isset($_POST['expense'])) {
            $expense = $mysqli->escape_string($_POST['expense']);
            $expensename = $mysqli->escape_string($_POST['expensename']);
        }
        else {
            $expense = 0;
            $expensename = "No"; 
        }
        
        $sql = "INSERT INTO records(date,userId,income,expense,profit,incomename,expensename)"."VALUES('$date','$userId','$income','$expense','$profit','$incomename','$expensename')";
        
        if($mysqli->query($sql)) {
            echo "<script>alert('Record added Successfully');
            </script>";
            header("refresh:0,url=addrecord.php");
            
        }
        else {
            echo "<script>alert('Record not Added');</script>";
            header("refresh:0,url=addrecord.php");
        }
        
        
    }
    else {
        echo "<script>alert('Error adding record');</script>";
        header("refresh:0,url=addrecord.php");
    }

?>