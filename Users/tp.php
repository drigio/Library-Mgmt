<?php 
require 'db.php';

$currentDate = date("Y-m-d");

$sql = "SELECT * from members where memId IN (Select memId From validity where validUntil > '$currentDate')";
$result = $mysqli->query($sql);
while($row = $result->fetch_assoc()){
    echo $row['memId']."<br>";
}

?>
