<?php
require 'db.php';
session_start();
$list = null;


if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Cannot Find Page";
  header("location: ../Login/error.php");    
}
else {
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $mobile = $_SESSION['mobile'];
}
?> 

<?php
    if(isset($_POST['memId'])) {
        $memId = $_POST['memId'];
        
        $sql = "Select * from members where memId = '$memId'";
        $result = $mysqli->query($sql);
        if(mysqli_num_rows($result) > 0){
            $list = $result->fetch_assoc();
            $sql2 = "DELETE FROM members where memId = '$memId'";
            if($mysqli->query($sql2))
            {
                echo "<script>alert('Member Deleted Successfully');</script>";
            }
        }
        else
            echo '<script>alert("Invalid Member ID");</script>';
    }
?>
<html>
<head>
	<title>Delete Users</title>
    
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
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><i class="pe-7s-search"></i> Delete Member</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="deleteUsers.php">
                                    <input type="text" class="form-control" placeholder = "Member ID" name="memId">
                                    <br>
                                    <input type="submit" value="Delete" class="btn btn-fill btn-info">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Member who has been deleted</h4>
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
                                    	<th>Parent's Occupation</th>
                                    	<th>Type Of Study</th>
                                    	<th>Email</th>
                                    	<th>Car/Bike Number</th>
                                    	<th>Date Of Birth</th>
                                    	<th>Photo</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td><?php echo $list['memId'];?></td>
                                        	<td><?php echo $list['firstName']." ".$list['lastName'];?></td>
                                        	<td><?php echo $list['mobile'];?></td>
                                        	<td><?php echo $list['taddress'];?></td>
                                        	<td><?php echo $list['paddress'];?></td>
                                        	<td><?php echo $list['middleName']." ".$list['lastName'];?></td>
                                        	<td><?php echo $list['pcontact'];?></td>
                                            <td><?php echo $list['poccupation'];?></td>
                                        	<td><?php echo $list['studytype'];?></td>
                                        	<td><?php echo $list['email'];?></td>
                                        	<td><?php echo $list['numPlate'];?></td>
                                        	<td><?php echo $list['dob'];?></td>
                                            <td><button onclick="showImg(<?php echo $list['memId'] ?>)">Image</button></td>
                                        </tr>
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