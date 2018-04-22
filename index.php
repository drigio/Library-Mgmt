<?php 
session_start();
if(isset($_SESSION["mobile"])) {
    header("location: ./Users/");
    echo $_SESSION['mobile'];
}
else
    header("location: ./Login/");
    echo $_SESSION['mobile'];

?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  
  
      <link rel="stylesheet" href="assets/css/style-index.css">

  
</head>

<body>
  <body>
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Login</h1>
			</div>

			<div class="login-form">
				<div class="control-group">
				<input type="text" class="login-field" value="" placeholder="username" id="login-name">
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
				<input type="password" class="login-field" value="" placeholder="password" id="login-pass">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

				<a class="btn btn-primary btn-large btn-block" href="#">login</a>
				<a class="login-link" href="#">Lost your password?</a>
			</div>
		</div>
	</div>
</body>
  
  
</body>
</html>