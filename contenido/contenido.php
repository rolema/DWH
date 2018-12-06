<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="../js/combo.js"></script>
<script src="../js/menu_jquery.js"></script>

<link rel="stylesheet" type="text/css" href="../css/master.css">

</head>

<body>
<?php
	session_start();
	
	//version 5.4 trae false, version 5.2 trae verdadero por lo cual se invierte para v 5.4
	if(isset($_SESSION['login'])){
		echo "<SCRIPT LANGUAGE='javascript'> alert(";
		echo $_SESSION['login'];
		echo "); javascript:window.location='.../index.php'; </SCRIPT>";
	}
?>


<?php include ("menu.php"); ?>
</body>

    <div id="imagen">
    	<img src="../img/AVE.png" alt="ave" width="192" height="100"/>     
	</div>

</html>
