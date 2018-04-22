<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$mobile = $mysqli->escape_string($_POST['mobile']);
$result = $mysqli->query("SELECT * FROM users WHERE mobile='$mobile'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['mobile'] = $user['mobile'];
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['userType'] = $user['userType'];  
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        //$_SESSION['active'] = $user['active'];
        $_SESSION['logged_in'] = true;

        header("location: ../Users/");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

