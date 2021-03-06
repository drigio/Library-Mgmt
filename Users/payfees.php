<!--Beginning Code -->
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
?> 

<!-- Main Payment Code -->
<?php
    
?>

<!doctype html>
<html lang="en">
<head>
    
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Display Image</title>

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
        .payment {
    font-size: 20px;
    font-weight: 400;
    color: #9A9A9A;
    margin-bottom: 0px;
    display: inline-block;
}
    </style>

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
                                <h4 class="title">Pay Fees</h4>
                            </div>
                            <div class="content">
                                 <form method="post" action="pay.php" name="show-Image">
                                     <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Member ID</label>
                                                <input type="text" class="form-control" placeholder="Member ID" name="memId">
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" placeholder="Mobile No" name="mob">                                             
                                            </div>
                                        </div>   
                                         <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Payment Mode</label>
                                                <input type="text" class="form-control" placeholder="Payment Mode" name="mode">                                             
                                            </div>
                                        </div>     
                                     </div>
                                     
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Payment Type</label><br>
                                                <input type = "radio" value="1" name="paymentType" style="margin:1%;"> <h5 class="payment">1 Month</h5>
                                                <input type = "radio" value="3" name="paymentType" style="margin:1%;"> <h5 class="payment">3 Month</h5>
                                                <input type = "radio" value="6" name="paymentType" style="margin:1%;"> <h5 class="payment">6 Month</h5>
                                                <input type = "radio" value="12" name="paymentType" style="margin:1%;"> <h5 class="payment">12 Month</h5>
                                            </div>
                                         </div>
                                     </div>
                                     
                                     <div class="row">
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Actual Fee</label>
                                                <input type="text" class="form-control" placeholder="Actual Fee" name="afee">
                                            </div>
                                         </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Admission Fee</label>
                                                <input type="text" class="form-control" placeholder="Admission Fee" name="adm">
                                            </div>
                                         </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Deposit Fee</label>
                                                <input type="text" class="form-control" placeholder="Deposit Fee" name="deposit">
                                            </div>
                                         </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Discount Amount</label>
                                                <input type="text" class="form-control" placeholder="Discount" name="discount">
                                            </div>
                                         </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Gap/Fine Amount</label>
                                                <input type="text" class="form-control" placeholder="Gap Fee" name="gapfee">
                                            </div>
                                         </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Locker Rent</label>
                                                <input type="text" class="form-control" placeholder="Locker Rent" name="locker">
                                            </div>
                                         </div>
                                         <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input type="text" class="form-control" placeholder="Balance" name="balance">
                                            </div>
                                         </div>
                                     </div>
                                     <button type="submit" class="btn btn-info btn-fill pull-right" style="margin-top:2%;">Next</button>
                                     <div class="clearfix"></div>
                                </form>
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