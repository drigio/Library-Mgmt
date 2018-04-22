<?php
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Cannot Find Page";
  header("location: ../Login/error.php");    
}
else {
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $mobile = $_SESSION['mobile'];
}
require 'db.php';

$currentDate = date("Y-m-d");
$sql = "SELECT * from members where memId IN (Select memId From validity where validUntil < '$currentDate')";
$result = $mysqli->query($sql);

$sql2 = "SELECT mobile FROM members where memId IN (Select memId From validity where validUntil < '$currentDate')";
$result2 = $mysqli->query($sql2);

while($emailrows = $result2->fetch_assoc()) {
            if(!empty($emailrows['mobile']))
              $allEmails[]=$emailrows['mobile'];
}

$string=implode("," , $allEmails);
?> 

<html>
<head>
	<title>Unpaid Fees Members</title>
    
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
    <script>
            //Function to Generate Image of the member
            function showImg(memId) {
                var newWin = window.open('','Member Photo','height=600px,width=500px');
                
                newWin.location.href = 'memImg.php?memId=' + memId;
            }
        
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    
    </script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                    Library Name
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="showUsers.php">
                        <i class="pe-7s-users"></i>
                        <p>Show Members</p>
                    </a>
                </li>
                
                <li>
                    <a href="addUsers.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Add Members</p>
                    </a>
                </li>
                
                <li>
                    <a href="deleteUsers.php">
                        <i class="pe-7s-delete-user"></i>
                        <p>Delete Members</p>
                    </a>
                </li>

            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="userInfo.php">
                               Welcome <?= $first_name.' '.$last_name ?>
                            </a>
                        </li>
                        <li>
                           <a href="../Login/logout.php">
                               Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Fees Not Paid Members</h4>
                                <div id="nos" style="display:none;">
                                    <?php 
                                        echo $string;
                                    ?>
                                </div>
                                <button onclick="copyToClipboard('#nos')" type="button" >Copy Mobile Numbers</button>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Name</th>
                                    	<th>Mobile</th>
                                    	<th>Temporary Address</th>
                                    	<th>Permanent Address</th>
                                    	<th>Parent's Name</th>
                                    	<th>Parent's Contact</th>
                                    	<th>Type Of Study</th>
                                    	<th>Email</th>
                                    	<th>Car/Bike Number</th>
                                    	<th>Date Of Birth</th>
                                    	<th>Photo</th>
                                    </thead>
                                    <tbody>
                                        <?php while($list = $result->fetch_assoc()) { ?>
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
                                            <td><button onclick="showImg(<?php echo $list['memId'] ?>)">Image</button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>


</html>