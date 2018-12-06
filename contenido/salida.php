<?php
	session_start();
	$_SESSION['login'];
	//$IdUsuario = ;
	$_SESSION['idUsuario'];
	include ("../back_code/Mysql.class.php");
	conectar();
	//Iniciamos Sesion
	
	
	$ssql = 'update ave_t_session set ACTIVO = 0, HR_SALIDA = CURRENT_TIMESTAMP where ACTIVO = 1 and ID_USUARIO = '.$_SESSION['idUsuario'];
	mysql_query($ssql);
	
	/*
	echo "<SCRIPT LANGUAGE='javascript'>
		 alert('";
	echo $ssql;
	echo "'); 
		 </SCRIPT>";*/
		 
	//Destruimos la Sesion
	unset($_SESSION['login']);
	$_SESSION['login'] = '';

	session_destroy();

	//Se redirecciona a index.php para que ingrese el usuario y contraseÃ±a
	echo "<SCRIPT LANGUAGE='javascript'>
		 alert('Cerro sesion";
	echo $_SESSION['login'];
	echo "'); location='../index.php';
		 </SCRIPT>";

?>