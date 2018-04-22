<?php

session_start();
require 'db.php';

$memId = $_GET['memId'];

$sql = "Select image,firstName,lastName from members where memId = '$memId'";
$result = $mysqli->query($sql);
    if(mysqli_num_rows($result) > 0){
        if($row = mysqli_fetch_array($result)){
            $img = $row['image'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
        }
        if($img == null)
            echo '<script>alert("No image Uploaded");</script>';
    }
    else
        echo '<script>alert("Invalid Member ID");</script>';
?>

<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            
        }
    </style>
    <title>
        <?php echo $firstName." ".$lastName ?>
    </title>
</head>
<body>
    <?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" style="height:100%;width:100%;" alt="Member Image will be displayed here After entering the member ID">'
    ?>
</body>

</html>