<?php
    session_start();
    require 'db.php';
    //Accept All fields
    if(isset($_POST["mobile"])){
        
        $fname = $mysqli->escape_string($_POST["fname"]);
        $mname = $mysqli->escape_string($_POST["mname"]);
        $lname = $mysqli->escape_string($_POST["lname"]);
        $taddress = $mysqli->escape_string($_POST["taddress"]);
        $paddress = $mysqli->escape_string($_POST["paddress"]);
        $mobile = $mysqli->escape_string($_POST["mobile"]);
        $email = $mysqli->escape_string($_POST["email"]);
        $memId = $mysqli->escape_string($_POST["memID"]); 
        $poccupation = $mysqli->escape_string($_POST["poccupation"]);
        $pcontact = $mysqli->escape_string($_POST["pcontact"]);
        $studytype = $mysqli->escape_string($_POST["studytype"]);
        $dob = $mysqli->escape_string($_POST["dob"]);
        $numPlate = $mysqli->escape_string($_POST["numPlate"]);
        $imgContent = null;
          
        //Only for Image
        if($_FILES['image']['size'] != 0) {
            
            $file_temp = $_FILES['image']['tmp_name'];
            $image_info = getimagesize($file_temp);
            if($image_info !== false){
                $imgContent = addslashes(file_get_contents($file_temp));
            }
            else $imgContent = null;
        }
        
        //IF Member already
        $result = $mysqli->query("SELECT * FROM members WHERE mobile='$mobile' OR memId = '$memId'") or die($mysqli->error());
        
        if ( $result->num_rows > 0 ) {
    
            $_SESSION['message'] = 'Member with Same Mobile or Member Id already Exists';
            header("location: ../Login/error.php");
    
        } 
        //Duplicate Member Doesnt exist
                               
        else {
            if($imgContent != null) {  //If photo uploaded                   
                $sql = "INSERT INTO members (memId,firstName,middleName,lastName,taddress,paddress,mobile,email,image,poccupation,pcontact,studytype,dob)" .
                "VALUES ('$memId','$fname','$mname','$lname','$taddress','$paddress','$mobile','$email','$imgContent','$poccupation','$pcontact','$studytype','$dob')";

                if($mysqli->query($sql)){
                    echo '<script> alert("Member Added"); </script>';
                    header("refresh:1;url= addUsers.php");
                }
            } 
            else
            { //if no photo uploaded
             $sql = "INSERT INTO members (memId,firstName,middleName,lastName,taddress,paddress,mobile,email,poccupation,pcontact,studytype,dob,numPlate)" .
                "VALUES ('$memId','$fname','$mname','$lname','$taddress','$paddress','$mobile','$email','$poccupation','$pcontact','$studytype','$dob','$numPlate')";

                if($mysqli->query($sql)){ 
                    echo '<script> alert("Member Added  without Photo"); </script>';
                    header("refresh:1;url= addUsers.php");
                }   
            }
        }
        
                               
    } 

    else {
        //Redirect if explicitly visiting the page
        header("location: index.php");
    }
     
                               
?>