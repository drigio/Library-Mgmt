<?php
require 'db.php';
session_start();
$list = null;


if ($_SESSION['userType'] != 0) {
  $_SESSION['message'] = "You are not authorised to see this page";
  header("location: ../Login/error.php");    
}
else {
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $mobile = $_SESSION['mobile'];
    echo $_SESSION['userType'];
}
?> 

<?php 

if(isset($_POST['date'])) {
    $input = $_POST['date'];
    $time = strtotime($input);
    $month = date('m',$time);
    $year = date('Y',$time);
    $print = date('F, Y', strtotime($input));
    
    $sql = "SELECT * from records WHERE YEAR(date) = '$year' AND MONTH(date) = '$month' ORDER BY date";
    
    $sql2 = "SELECT SUM(profit),SUM(income),SUM(expense) from records WHERE YEAR(date) = '$year' AND MONTH(date) = '$month' ";
    
    $result = $mysqli->query($sql);
    
    if($result->num_rows > 0){
        
        $result2 = $mysqli->query($sql2);
        $row = $result2->fetch_array();
    }
    else
    {
        echo '<script>alert("No records Found");</script>';
        $row = array(0,0,0);
    }
}
else {
    $print = "";
    $result = "";
    $row = array(0,0,0);
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
    
    <style>
        .last {
            font-size: 27px;
            height: 6%;
        }
    </style>

    
    <script>
    
        function currDate() {
            var dat = document.getElementById("date");
            var d = new Date();
            dat.value = d.getFullYear() + "-" + (d.getMonth() + 1);
        }
    </script>
    
    
</head>
<body onload="currDate()">

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
                                <h4 class="title"><i class="pe-7s-search"></i> Show Records</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="showrecords.php">
                                    <input type="month" class="form-control" placeholder = "Choose Month" name="date" id="date">
                                    <br>
                                    <input type="submit" value="Show" class="btn btn-fill btn-info">
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo  $print; ?> </h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Date</th>
                                    	<th>Added By</th>
                                    	<th>Income</th>
                                    	<th>Income Name</th>
                                    	<th>Expense</th>
                                    	<th>Expense Name</th>
                                    	<th>Profit</th>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($result)) { while($list = $result->fetch_assoc()) { ?>
                                        <tr>
                                        	<td><?php echo $list['id'];?></td>
                                        	<td><?php echo date('d',strtotime($list['date']));?></td>
                                        	<td><?php echo $list['userId'];?></td>
                                        	<td><?php echo $list['income'];?></td>
                                        	<td><?php echo $list['incomename'];?></td>
                                            <td><?php echo $list['expense'];?></td>
                                        	<td><?php echo $list['expensename'];?></td>
                                        	<td><?php echo $list['profit'];?></td>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Total Profit For the Month <?php echo  $print; ?>  </h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Total Income</label>
                                        <input type="text" class="form-control last" value="<?php echo "Rs"." ".$row[1];?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Total Expense</label>
                                        <input type="text" class="form-control last" value="<?php echo "Rs"." ".$row[2];?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Total Profit</label>
                                        <input type="text" class="form-control last" value="<?php echo "Rs"." ".$row[0];?>" readonly>
                                    </div>
                                </div>
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