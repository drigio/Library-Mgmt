<?php
session_start();
require 'db.php';
$onemonth = 600;

if(isset($_POST['memId']) or isset($_POST['mob'])){
    
    $memId = $mysqli->escape_string($_POST['memId']);
    $mobile = $mysqli->escape_string($_POST['mob']);
    $paymentType = $mysqli->escape_string($_POST['paymentType']);
    $discount = $mysqli->escape_string($_POST['discount']);
    $gapfee = $mysqli->escape_string($_POST['gapfee']);
    $paymentMode = $mysqli->escape_string($_POST['mode']);
    $actual = $mysqli->escape_string($_POST['afee']);
    $locker = $mysqli->escape_string($_POST['locker']);
    $admfee = $mysqli->escape_string($_POST['adm']);
    $balance = $mysqli->escape_string($_POST['balance']);
    $deposit = $mysqli->escape_string($_POST['deposit']);
    
    $sql = "SHOW TABLE STATUS LIKE 'payments'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['recieptno'] = $row['Auto_increment'];
    
     //Find Member Info
    $sql = "SELECT * from members where memId = '$memId' or mobile = '$mobile'";
    $result = $mysqli->query($sql);
    if($result->num_rows <= 0){   
        echo '<script>alert("Invalid Member ID or Mobile No"); </script>';
            header("refresh:0;url=payfees.php");
    }
    
    $paymentDate = date("Y-m-d");
    $validUntil = date('Y-m-d',strtotime("+".$paymentType." months",strtotime($paymentDate)));
    $userId = $_SESSION['userId'];
    
    
    
    
    //If Gapfee Or Discount Or Admission Fee doesnt Apply
    if($gapfee == null) $gapfee = 0;
    if($discount == null) $discount = 0;
    if($admfee == null) $admfee = 0;
    if($balance == null) $balance = 0;
    if($deposit == null) $deposit = 0;
    if($locker == null) $locker = 0;
    
    $total = $actual +$admfee + $gapfee +$locker + $deposit - $discount;
    
    //Assigning Variables to Pass.
    
    $_SESSION['paymentType'] = $paymentType;
    $_SESSION['discount'] = $discount;
    $_SESSION['gapfee'] = $gapfee;
    $_SESSION['paymentDate'] = $paymentDate;
    $_SESSION['validUntil'] = $validUntil;
    $_SESSION['total'] = $total;
    $_SESSION['actual'] = $actual;
    $_SESSION['locker'] = $locker;
    $_SESSION['admfee'] = $admfee;
    $_SESSION['balance'] = $balance;
    $_SESSION['deposit'] = $deposit;
    
}

?>

<table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Name</th>
                                    	<th>Mobile</th>
                                    	<th>Address</th>
                                    	<th>Email</th>
                                    </thead>
                                    <tbody>
                                        <?php $list = $result->fetch_assoc() ?>
                                        <tr>
                                        	<td><?php echo $list['memId'];?></td>
                                        	<td><?php echo $list['firstName']." ".$list['lastName'];?></td>
                                        	<td><?php echo $list['mobile'];?></td>
                                        	<td><?php echo $list['taddress'];?></td>
                                        	<td><?php echo $list['paddress'];?></td>
                                        	<td><?php echo $list['middleName']." ".$list['lastName'];?></td>
                                        	<td><?php echo $list['pcontact'];?></td>
                                        	<td><?php echo $list['studytype'];?></td>
                                        	<td><?php echo $list['email'];?></td>
                                        	<td><?php echo $list['numPlate'];?></td>
                                        	<td><?php echo $list['dob'];?></td>
                                        </tr>
                                    </tbody>
                                </table>

<button type="submit" onclick="window.open('fees.php','Generated Fees   ','height=700px,width=1000px');">Print PDF</button>
<button type="submit" onclick="window.open('payFinal.php','Payment Done','height=500px,width=500px');">Pay Fees</button>

<?php
    $memId = $list['memId'];
    $_SESSION['mfirstname'] = $list['firstName'];
    $_SESSION['mlastname'] = $list['lastName'];
    $_SESSION['mmobile'] = $list['mobile'];
    $_SESSION['maddress'] = $list['taddress'];
    $_SESSION['memail'] = $list['email'];
    $_SESSION['memId'] = $memId;
?>