<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <title>Fuzzy AHP</title>
	<link href="assets/img/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">    
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>   
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-1.7.2.min.js"></script>  
	<link rel="stylesheet" href="assets/css/style2.css">
    <script type="text/javascript">
		
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$(this).toggleClass('active');
		});
	});
    </script>	 

</head>
<body>
<?php
	if(empty($_SESSION['user'])or($_SESSION['user']=="")){
		require("login.php");
	} else { 
		require("admin.php");
	}
?>
</body>
</html>